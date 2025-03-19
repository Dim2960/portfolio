<?php
// Inclusion de l'autoloader de Composer pour charger PhpSpreadsheet
require '../vendor/autoload.php'; // Assurez-vous que PhpSpreadsheet est installé
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
    if (!empty($values[0]) && !empty($values[1])) {
        $data[$values[0]] = $values[1];
    }
}

?>

    <section id="accueil">
        <h1>
            <?php foreach (str_split($data['Prénom'] . ' ' . $data['Nom']) as $char): ?>
                <span class="animate-once"><?php echo htmlspecialchars($char); ?></span>
            <?php endforeach; ?>
        </h1>
        <h3><?php echo htmlspecialchars($data['Fonction']); ?></h3>
        <p><?php echo htmlspecialchars($data['Phrase d\'accroche']); ?></p>
        <div>
            <button>
                <a href="#contact" class="relative block px-4 py-2">
                    <span>Me contacter</span>
                </a>
            </button>
            <a href="<?php echo htmlspecialchars($data['GitHub']); ?>" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"></path>
                    <path d="M9 18c-4.51 2-5-2-7-2"></path>
                </svg>
            </a>
            <a href="<?php echo htmlspecialchars($data['LinkedIn']); ?>" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                    <rect width="4" height="12" x="2" y="9"></rect>
                    <circle cx="4" cy="4" r="2"></circle>
                </svg>
            </a>
        </div>
    </section>

