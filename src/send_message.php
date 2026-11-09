<?php
// Traitement du formulaire de contact.
// La notification part uniquement vers l'adresse du site : aucun mail n'est
// envoyé à l'adresse saisie dans le formulaire, qui reste une donnée non vérifiée.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titresAutorises = ['monsieur', 'madame', 'non précisé'];
    $delaiMinimalSecondes = 3;
    $messagesMaxParHeure = 5;

    $terminer = static function (string $notification): void {
        $_SESSION['notification'] = $notification;
        header("Location: index#contact");
        exit;
    };

    $champ = static function (string $nom): string {
        return is_string($_POST[$nom] ?? null) ? trim($_POST[$nom]) : '';
    };

    // Vérifier la présence et la validité du token CSRF
    $tokenRecu = $champ('csrf_token');
    if ($tokenRecu === '' || !hash_equals((string) ($_SESSION['csrf_token'] ?? ''), $tokenRecu)) {
        $terminer("Erreur de validation du formulaire.");
    }

    // Anti-robot : champ invisible rempli ou envoi trop rapide.
    // La réponse reste « succès » pour ne pas renseigner le robot.
    $afficheA = (int) ($_SESSION['contact_affiche_a'] ?? 0);
    if ($champ('reference_interne') !== '' || $afficheA === 0 || time() - $afficheA < $delaiMinimalSecondes) {
        unset($_SESSION['csrf_token']);
        $terminer("Message envoyé avec succès");
    }

    $titre   = $champ('titre');
    $nom     = $champ('nom');
    $prenom  = $champ('prenom');
    $email   = $champ('email');
    $message = $champ('message');

    if ($titre === '' || $nom === '' || $prenom === '' || $email === '' || $message === '') {
        $terminer("Tous les champs sont requis.");
    }

    // Le titre doit être une des valeurs proposées par la liste
    if (!in_array($titre, $titresAutorises, true)) {
        $terminer("Veuillez sélectionner votre titre.");
    }

    if (mb_strlen($nom) > 100 || mb_strlen($prenom) > 100 || mb_strlen($message) > 5000) {
        $terminer("Votre message ou votre nom est trop long.");
    }

    // filter_var refuse aussi les retours à la ligne : pas d'injection d'en-têtes
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $terminer("Adresse email invalide.");
    }

    // Vérifier l'existence du domaine via un enregistrement MX
    $domaine = substr(strrchr($email, "@"), 1);
    if (!checkdnsrr($domaine, "MX")) {
        $terminer("Le domaine de l'adresse email n'est pas configuré pour recevoir des emails.");
    }

    if (!contactAutoriseParIp($_SERVER['REMOTE_ADDR'] ?? '', $messagesMaxParHeure)) {
        $terminer("Trop de messages envoyés. Merci de réessayer plus tard.");
    }

    // Adresse unique du site, utilisée pour l'envoi et la réception
    $adresseSite = trim((string) ($data['email de communication'] ?? ''));
    if (!filter_var($adresseSite, FILTER_VALIDATE_EMAIL)) {
        error_log("Formulaire de contact : adresse du site invalide dans data_accueil.xlsx");
        $terminer("Erreur lors de l'envoi du message");
    }

    $sujet   = "Contact portfolio - Nouveau message";
    $contenu = "Titre : $titre\nNom : $nom\nPrenom : $prenom\nEmail : $email\nMessage :\n$message";

    // Le visiteur va en Reply-To : mettre son adresse en From ferait échouer DMARC
    $headers  = "From: Portfolio <" . $adresseSite . ">\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

    $envoye = mail($adresseSite, $sujet, $contenu, $headers);

    // Invalider le token CSRF après utilisation pour éviter les réutilisations
    unset($_SESSION['csrf_token']);

    $terminer($envoye ? "Message envoyé avec succès" : "Erreur lors de l'envoi du message");
}

/**
 * Limite le nombre de messages par IP sur une heure glissante.
 * L'IP n'est pas conservée en clair. Si le compteur est indisponible, l'envoi
 * reste autorisé : un vrai message ne doit pas être perdu pour cette raison.
 */
function contactAutoriseParIp(string $ip, int $maximum): bool
{
    $dossier = dirname(__DIR__) . '/var/contact';
    if (!is_dir($dossier) && !@mkdir($dossier, 0700, true) && !is_dir($dossier)) {
        error_log("Formulaire de contact : dossier du compteur indisponible");
        return true;
    }

    $maintenant = time();
    foreach (glob($dossier . '/*.json') ?: [] as $ancien) {
        if ($maintenant - (int) @filemtime($ancien) > 3600) {
            @unlink($ancien);
        }
    }

    $fichier = @fopen($dossier . '/' . hash('sha256', $ip) . '.json', 'c+');
    if ($fichier === false || !flock($fichier, LOCK_EX)) {
        error_log("Formulaire de contact : compteur illisible");
        return true;
    }

    $envois = json_decode((string) stream_get_contents($fichier), true);
    $envois = array_values(array_filter(
        is_array($envois) ? $envois : [],
        static fn ($instant) => is_int($instant) && $maintenant - $instant < 3600
    ));

    $autorise = count($envois) < $maximum;
    if ($autorise) {
        $envois[] = $maintenant;
    }

    ftruncate($fichier, 0);
    rewind($fichier);
    fwrite($fichier, json_encode($envois));
    fflush($fichier);
    flock($fichier, LOCK_UN);
    fclose($fichier);

    return $autorise;
}
