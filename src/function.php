<?php
require '../vendor/autoload.php'; // Assurez-vous que PhpSpreadsheet est installé
use PhpOffice\PhpSpreadsheet\IOFactory as SpreadsheetIOFactory;
use PhpOffice\PhpWord\IOFactory;

function readExcelData($filePath) {
    //**
    // * Lit les données d'un fichier Excel et les retourne sous forme de tableau associatif.
    // *
    // * Cette fonction charge un fichier Excel, extrait les données de la feuille active 
    // * et les stocke sous forme de tableau associatif en utilisant les valeurs des deux
    // * premières colonnes (clé => valeur).
    // *
    // * @param string $filePath Chemin du fichier Excel à lire.
    // * @return array Tableau associatif contenant les données extraites (clé => valeur).
    // * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception Si le fichier ne peut pas être lu.
    // */

    try {
        // Charger le fichier Excel
        $spreadsheet = SpreadsheetIOFactory::load($filePath);
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

            // Vérifier si les colonnes existent avant d'ajouter au tableau associatif
            if (!empty($values[0]) && !empty($values[1])) {
                $data[$values[0]] = $values[1];
            }
        }
        return $data;
    } catch (\Exception $e) {
        die("Erreur lors de la lecture du fichier Excel : " . $e->getMessage());
    }
}


function readAllExcelFilesInFolder($folderPath) {
    ///**
    // * Lit tous les fichiers Excel dans un dossier donné et retourne les données extraites.
    // *
    // * @param string $folderPath Chemin du dossier contenant les fichiers Excel.
    // * @return array Tableau associatif contenant les données de tous les fichiers.
    // */
    $allData = [];

    // Vérifier si le dossier existe
    if (!is_dir($folderPath)) {
        die("Le dossier spécifié n'existe pas.");
    }

    // Scanner les fichiers du dossier
    $files = scandir($folderPath);
    
    foreach ($files as $file) {
        $filePath = $folderPath . DIRECTORY_SEPARATOR . $file;

        // Vérifier si c'est un fichier Excel (extension .xlsx)
        if (is_file($filePath) && pathinfo($filePath, PATHINFO_EXTENSION) === 'xlsx') {
            // echo "Lecture du fichier : $file\n"; // Debugging
            // Lire les données du fichier et stocker dans le tableau
            $allData[$file] = readExcelData($filePath);
        }
    }
    
    return $allData;
}


function convertDocxToCleanHtml($docxFile, $removeStyles = true) {
    // **
    // * Convertit un fichier DOCX en HTML avec option de suppression des styles.
    // *
    // * @param string $docxFile Chemin du fichier DOCX à convertir.
    // * @param bool $removeStyles Si true, supprime les styles et les balises <style>.
    // * @return string HTML généré à partir du fichier DOCX.
    // * @throws Exception Si le fichier ne peut pas être chargé.
    // */
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

        // Si on ne veut pas supprimer les styles, on retourne directement le HTML généré
        if ($removeStyles) {
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
        }

    // Extraire le contenu intérieur de la balise <body>
    $body = $dom->getElementsByTagName('body')->item(0);
    $innerHTML = '';
    foreach ($body->childNodes as $child) {
        $innerHTML .= $dom->saveHTML($child);
        }

        return $innerHTML;
    } catch (Exception $e) {
        return "Erreur lors de la conversion du fichier DOCX : " . $e->getMessage();
    }
}

?>