<?php
session_start();

//recupération des element pour traiter le message dans dossier data
// fetch des données depuis data_accueil.xlsx
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

// Charger le fichier Excel
$spreadsheet = IOFactory::load('../data/data_accueil.xlsx');
$sheet = $spreadsheet->getActiveSheet();
$data = [];

// Lire les données du fichier Excel
foreach ($sheet->getRowIterator() as $row) {
    $cells = $row->getCellIterator();
    $cells->setIterateOnlyExistingCells(true);
    $values = [];
    foreach ($cells as $cell) {
        $values[] = $cell->getValue();
    }
    if (!empty($values[0]) && !empty($values[1]) && strtolower(trim($values[0])) === 'email de communication') {
        $data['email de communication'] = $values[1];
        break; 
    }
}

// Chargement et conversion du fichier DOCX en HTML
$docxFile = '../data/data_contact.docx';
try {
    // Charger le DOCX
    $phpWord = \PhpOffice\PhpWord\IOFactory::load($docxFile);
    
    // Créer un writer HTML pour générer le HTML
    $htmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');

    // Capturer la sortie HTML
    ob_start();
    $htmlWriter->save('php://output');
    $htmlContent = ob_get_clean();

    // Utiliser DOMDocument pour extraire uniquement le contenu de la balise <body>
    $dom = new DOMDocument();
    libxml_use_internal_errors(true); // Pour ignorer les erreurs de parsing HTML
    $dom->loadHTML($htmlContent);
    libxml_clear_errors();

    // Extraire le contenu intérieur de la balise <body>
    $body = $dom->getElementsByTagName('body')->item(0);
    $cleanHtmlContent = '';
    foreach ($body->childNodes as $child) {
        $cleanHtmlContent .= $dom->saveHTML($child);
    }
    // On utilise ce contenu nettoyé comme message automatique
    $htmlContent = $cleanHtmlContent;

} catch (Exception $e) {
    echo 'Erreur lors du chargement du fichier DOCX : ', $e->getMessage();
    exit;
}


// Génération d'un token CSRF unique s'il n'existe pas déjà
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier la présence et la validité du token CSRF
    if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['notification'] = "Erreur de validation du formulaire.";
        header("Location: index.php#contact");
        exit;
    }

    // Récupération et nettoyage des données du formulaire
    $titre     = trim($_POST['titre']);
    $nom     = trim($_POST['nom']);
    $prenom     = trim($_POST['prenom']);
    $email   = trim($_POST['email']);
    $message = trim($_POST['message']);

    // Vérifier que les champs ne sont pas vides
    if (empty($titre) || empty($nom) || empty($prenom) || empty($email) || empty($message)) {
        $_SESSION['notification'] = "Tous les champs sont requis.";
        header("Location: index.php#contact");
        exit;
    }

    // Validation de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['notification'] = "Adresse email invalide.";
        header("Location: index.php#contact");
        exit;
    }

    // Vérifier l'existence du domaine via un enregistrement MX
    $domain = substr(strrchr($email, "@"), 1);
    if (!checkdnsrr($domain, "MX")) {
        $_SESSION['notification'] = "Le domaine de l'adresse email n'est pas configuré pour recevoir des emails.";
        header("Location: index.php#contact");
        exit;
    }

    // Prévenir l'injection d'en-têtes en supprimant les retours à la ligne
    $email = str_replace(["\r", "\n", "%0a", "%0d"], '', $email);

    // Optionnel : assainir davantage les autres champs
    $titre = filter_var($titre, FILTER_SANITIZE_STRING);
    $nom = filter_var($nom, FILTER_SANITIZE_STRING);
    $prenom = filter_var($prenom, FILTER_SANITIZE_STRING);
    $message = filter_var($message, FILTER_SANITIZE_STRING);

    // Adresse email destinataire
    $destinataire = $data['email de communication']; //"contact@datadriven-dynamix.fr"; //$data['email de communication'];

    // Préparation de l'email
    $sujet   = "Contact portfolio - Nouveau message";
    $contenu = "Titre : $titre\nNom : $nom\nPrenom : $prenom\nEmail : $email\nMessage :\n$message";
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

    // Tentative d'envoi de l'email
    if (mail($destinataire, $sujet, $contenu, $headers)) {
        $_SESSION['notification'] = "Message envoyé avec succès";
        
        // Envoi d'une réponse automatique à l'expéditeur
        $autoSujet = "Accusé de réception de votre message";
        $autoMessage = $htmlContent;
        $autoHeaders = "From: " . $destinataire  ."\r\n";
        $autoHeaders .= "Reply-To: " . $destinataire  ."\r\n";
        $autoHeaders .= "MIME-Version: 1.0\r\n";
        $autoHeaders .= "Content-Type: text/html; charset=utf-8\r\n";
        
        mail($email, $autoSujet, $autoMessage, $autoHeaders);

    } else {
        $_SESSION['notification'] = "Erreur lors de l'envoi du message";
    }

    // Invalider le token CSRF après utilisation pour éviter les réutilisations
    unset($_SESSION['csrf_token']);

    // Redirection vers la page de formulaire
    header("Location: index.php#contact");
    exit;
}
?>