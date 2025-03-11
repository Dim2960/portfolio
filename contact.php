<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération et assainissement des données du formulaire
    $nom     = htmlspecialchars($_POST['nom']);
    $email   = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Adresse email destinataire
    $destinataire = "contact@datadriven-dynamix.fr"; // Remplacez par votre adresse email

    // Préparation de l'email
    $sujet   = "Nouveau message de votre site web";
    $contenu = "Nom : $nom\nEmail : $email\nMessage :\n$message";
    $headers = "From: $email\r\nReply-To: $email\r\n";

    // Tentative d'envoi de l'email
    if (mail($destinataire, $sujet, $contenu, $headers)) {
        // Redirection en cas de succès avec un message dans l'URL
        header("Location: index.html?message=" . urlencode("Message envoyé avec succès") . "#contact");
        exit;
    } else {
        // Redirection en cas d'erreur avec un message dans l'URL
        header("Location: index.html?message=" . urlencode("Erreur lors de l'envoi du message") . "#contact");
        exit;
    }
}
?>
