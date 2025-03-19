
<?php


require '../vendor/autoload.php';

use PhpOffice\PhpWord\IOFactory;


// Chemin vers le fichier DOCX
$docxFile = '../data/a_propos.docx';

try {
    // Charger le fichier DOCX
    $phpWord = IOFactory::load($docxFile);

    // Créer un writer HTML pour générer le HTML
    $htmlWriter = IOFactory::createWriter($phpWord, 'HTML');

    // Capturer la sortie HTML
    ob_start();
    $htmlWriter->save('php://output');
    $htmlContent = ob_get_clean();

    // Utiliser DOMDocument pour manipuler le HTML généré
    $dom = new DOMDocument();
    libxml_use_internal_errors(true); // Ignore les erreurs de parsing HTML
    $dom->loadHTML($htmlContent);
    libxml_clear_errors();

    // Supprimer les balises <style>
    $styles = $dom->getElementsByTagName('style');
    while ($styles->length > 0) {
        $style = $styles->item(0);
        $style->parentNode->removeChild($style);
    }

    // Supprimer les attributs inline "style" sur tous les éléments
    $xpath = new DOMXPath($dom);
    $nodes = $xpath->query('//*[@style]');
    foreach ($nodes as $node) {
        $node->removeAttribute('style');
    }

    // Extraire le contenu intérieur de la balise <body>
    $body = $dom->getElementsByTagName('body')->item(0);
    $innerHTML = '';
    foreach ($body->childNodes as $child) {
        $innerHTML .= $dom->saveHTML($child);
    }

    // Afficher le contenu HTML généré
?>
    <section id="a-propos">
    <h2>À mon propos</h2>
<?php
    echo $innerHTML;
?>
    </section>
<?php


} catch (Exception $e) {
    echo 'Erreur lors du chargement du fichier DOCX : ', $e->getMessage();
}
?>
