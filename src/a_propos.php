<?php
// extraction du docx et conversion en HTML
$docxFile = '../data/a_propos.docx';
$innerHTML = convertDocxToCleanHtml($docxFile, true);
?>
    <section id="a-propos">
    <h2>À mon propos</h2>
<?php
    echo $innerHTML;
?>
    </section>

