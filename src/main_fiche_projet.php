<?php

$folderPathDataProjets = '../data/projets/';
$allDataProject = readAllExcelFilesInFolder($folderPathDataProjets);

// fetch du nombre de nom de projet
$nbFile = count($allDataProject);
// on recupere le nom de chaque projet
// et on les met dans un tableau associatif
// avec un index du projet comme clé et le nom du fichier comme valeur
$fileNameCount = 0;
$assoCountName = [];

foreach ($allDataProject as $fileNameArray => $rows) {
    $assoCountName[$fileNameCount] = $fileNameArray;
    $fileNameCount = $fileNameCount+ 1;
}

// on recupere les informations pour le bouton du projet précédent projet
$numeroProjet = $fileName[0];

if ($numeroProjet == 0) {
    $fileNamePrev = $assoCountName[$nbFile-1];
} else {
    $fileNamePrev = $assoCountName[$numeroProjet - 1];
}

if ($numeroProjet == $nbFile-1) {
    $fileNameNext = $assoCountName[0];
} else {
    $fileNameNext = $assoCountName[$numeroProjet + 1];
}

$filePath = '../data/projets/' . $fileName;
$dataprojet = readExcelData($filePath);

// récupération des variables du projet
$titre                  = isset($dataprojet['title']) ? $dataprojet['title'] : 'Titre non défini';
$description            = isset($dataprojet['description']) ? $dataprojet['description'] : 'Description non disponible';
$image_url              = isset($dataprojet['image_url']) ? $dataprojet['image_url'] : 'url image non disponible';
$image_alt              = isset($dataprojet['image_alt']) ? $dataprojet['image_alt'] : 'alt image non disponible';
$tags                   = isset($dataprojet['tags']) ? $dataprojet['tags'] : 'tags non disponible';
$description_detail     = isset($dataprojet['description_detail']) ? $dataprojet['description_detail'] : 'Information non disponible';
$objectif               = isset($dataprojet['objectif_projet']) ? $dataprojet['objectif_projet'] : 'Information non disponible';
$Probleme_resolu        = isset($dataprojet['Probleme_resolu']) ? $dataprojet['Probleme_resolu'] : 'Information non disponible';
$data_source            = isset($dataprojet['data_source']) ? $dataprojet['data_source'] : 'Information non disponible';
$data_size              = isset($dataprojet['data_size']) ? $dataprojet['data_size'] : 'Information non disponible';
$data_type              = isset($dataprojet['data_type']) ? $dataprojet['data_type'] : 'Information non disponible';
$data_remark            = isset($dataprojet['data_remark']) ? $dataprojet['data_remark'] : 'Information non disponible';
$url_img_data           = isset($dataprojet['url_img_data']) ? $dataprojet['url_img_data'] : 'url image non disponible';
$alt_img_data           = isset($dataprojet['alt_img_data']) ? $dataprojet['alt_img_data'] : 'url image non disponible';
$project_steps          = isset($dataprojet['project_steps']) ? $dataprojet['project_steps'] : 'Information non disponible';
$technos                = isset($dataprojet['techno']) ? $dataprojet['techno'] : 'Information non disponible';
$results                = isset($dataprojet['result']) ? $dataprojet['result'] : 'Information non disponible';
$img_url_results        = isset($dataprojet['img_results']) ? $dataprojet['img_results'] : 'url image non disponible';
$alt_img_results        = isset($dataprojet['alt_img_results']) ? $dataprojet['alt_img_results'] : 'alt image non disponible';
$powerbi_link           = isset($dataprojet['powerbi_link']) ? $dataprojet['powerbi_link'] : 'lien non disponible';
$github_link            = isset($dataprojet['github_link']) ? $dataprojet['github_link'] : 'lien non disponible';
$streamlit_link         = isset($dataprojet['streamlit_link']) ? $dataprojet['streamlit_link'] : 'lien non disponible';
$video_link             = isset($dataprojet['video_link']) ? $dataprojet['video_link'] : 'lien non disponible';
$webApp_link            = isset($dataprojet['webApp_link']) ? $dataprojet['webApp_link'] : 'lien non disponible';
$difficulties_learns    = isset($dataprojet['difficulties_learns']) ? $dataprojet['difficulties_learns'] : 'Information non disponible';
$potential_improvements = isset($dataprojet['potential_improvement']) ? $dataprojet['potential_improvement'] : 'Information non disponible';
$project_status         = isset($dataprojet['Etat_projet']) ? $dataprojet['Etat_projet'] : 'Done';


//récupération des données pour les balises meta
$filePathDataMeta = '../data/data_meta.xlsx';
$dataMeta = readExcelData($filePathDataMeta);

?>

    <main>

        <div class="wrapper-fiche-projet">
            <section id="fiche-projet">
                <div class="fiche-projet-frame">

                    <div class="fiche-projet-frame-header">

                        <div class="fiche-projet-frame-btn-prev">
                            <form action="index" method="POST"><!-- en local mettre fiche_projet.php -- cause .htaccess -->
                                <input type="hidden" name="id" value="99">
                                <input type="hidden" name="fileName" value="<?php echo htmlspecialchars($fileNamePrev); ?>">
                                <input type="hidden" name="theme" class="hidden-theme" value="<?php echo $_COOKIE['theme']; ?>">
                                <input type="submit" class="button-prev-next button-scale" name="prev" value="<" />
                            </form>
                        </div>

                        <div class="fiche-projet-frame-title">
                            <div class="fiche-projet-title">
                                <h1><?php echo htmlspecialchars($titre); ?></h1>
                                <!-- <h3>Sous-titre précisant le domaine </h3> -->
                            </div>
                        </div>

                        <div class="fiche-projet-frame-btn-next">
                            <form action="index" method="POST"><!-- en local mettre fiche_projet.php -- cause .htaccess -->
                                <input type="hidden" name="id" value="99">
                                <input type="hidden" name="fileName" value="<?php echo htmlspecialchars($fileNameNext); ?>">
                                <input type="hidden" name="theme" class="hidden-theme" value="<?php echo $_COOKIE['theme']; ?>">
                                <input type="submit" class="button-prev-next button-scale" name="next" value=">" />
                            </form>
                        </div>

                    </div>

                    <div class="fiche-projet-frame-context">

                        <div class="fiche-projet-frame-context-content">
                            <h2>Contexte</h2>
                            <p>
                                <?php echo htmlspecialchars($description_detail); ?>
                            </p>
                        </div>
                        
                        <div class="fiche-projet-frame-context-image">
                            <img src="images/projets/global/<?php echo htmlspecialchars($image_url); ?>" alt="<?php echo htmlspecialchars($image_alt); ?>" />
                        </div>

                    </div>

                    <div class="fiche-projet-frame-issueTarget">
                        <?php 
                        if ($Probleme_resolu != 'Information non disponible') { 
                        ?>
                        <div class="fiche-projet-frame-issue">
                            <h4>🗨️ Problématique : </h4><?php echo htmlspecialchars($Probleme_resolu); ?>
                        </div>
                        <?php 
                        } 

                        if ($objectif != 'Information non disponible') { 
                        ?>
                        <div class="fiche-projet-frame-target">
                            <h4>🎯 Objectif : </h4><?php echo htmlspecialchars($objectif); ?>
                        </div>
                        <?php 
                        } 
                        ?>
                    </div>

                    <div class="fiche-projet-frame-data-methodo">
                        
                    <div class="fiche-projet-frame-data-methodo-data">
                            <div class="fiche-projet-frame-data-methodo-data-content">
                                <div class="fiche-projet-frame-data-methodo-data-title">
                                    <h2>Données</h2>
                                </div>

                                <div class="fiche-projet-frame-data-methodo-data-table">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Source</th>
                                                <th>Taille</th>
                                                <th>Type de données</th>
                                                <th>Particularités</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo htmlspecialchars($data_source); ?></td>
                                                <td><?php echo htmlspecialchars($data_size); ?></td>
                                                <td><?php echo htmlspecialchars($data_type); ?></td>
                                                <td><?php echo htmlspecialchars($data_remark); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="fiche-projet-frame-data-methodo-data-table-list">
                                    
                                    <div class="list-puce">
                                            <ul>
                                                <li>Source : <?php echo htmlspecialchars($data_source); ?></li>
                                                <li>Taille : <?php echo htmlspecialchars($data_size); ?></li>
                                                <li>Type de données : <?php echo htmlspecialchars($data_type); ?></li>
                                                <li>Particularités : <?php echo htmlspecialchars($data_remark); ?></li>
                                            </ul>
                                    </div>
                                </div>
                                
                                <?php
                                if ($url_img_data != 'url image non disponible') {
                                ?>
                                <div class="fiche-projet-frame-data-methodo-data-img">
                                    <img src="images/projets/data/<?php echo htmlspecialchars($url_img_data); ?>" alt="<?php echo htmlspecialchars($alt_img_data); ?>" />
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div class="fiche-projet-frame-data-methodo-methodo">
                            <h2>
                                <?php 
                                if (($project_steps !== 'Information non disponible') & ($technos !== 'Information non disponible')) {
                                    echo 'Méthodologie et Outils';
                                    $jeton_project_steps = 1;
                                    $jeton_technos = 1;
                                    } 
                                elseif (($project_steps != 'Information non disponible') & ($technos === 'Information non disponible')) {
                                    echo 'Méthodologie';
                                    $jeton_project_steps = 1;
                                    $jeton_technos = 0;
                                    }
                                elseif (($project_steps === 'Information non disponible') & ($technos !== 'Information non disponible')) {
                                    echo 'Outils et technologies';
                                    $jeton_project_steps = 0;
                                    $jeton_technos = 1;
                                    }
                                ?>
                            </h2>
                            <?php
                            if ($jeton_project_steps == 1) {
                            ?>
                            <h3>Étapes de réalisation :</h3>
                            <div class="list-steps">
                                <ol>
                                    <?php 
                                    // Convertir la chaîne de tags en tableau, en séparant par la virgule
                                    $project_stepsArray = explode('|-|', $project_steps); 

                                    // Parcourir chaque tag et l'afficher dans une balise <span>
                                    foreach($project_stepsArray as $project_step) {
                                        $project_step = trim($project_step);
                                        
                                        // Remplacement de ##on-going## par une image HTML
                                        $project_step = htmlspecialchars($project_step);
                                        $project_step = str_replace('##on-going##', '<div class="on-going">On going</div>', $project_step);
                                        $project_step = str_replace('##done##', '<div class="done">Done</div>', $project_step);
                                        
                                        echo '<li>' . $project_step . '</li>';
                                    }
                                    ?>
                                </ol>
                            </div>
                            
                            </br>
                            <?php
                            }
                            if ($jeton_technos == 1) {
                                if ($jeton_project_steps == 1) {
                                ?>
                                <h3>Outils et technologies utilisés :</h3>
                                <?php
                                }
                                ?>
                            <div class="list-box">
                                <ul>
                                    <?php 
                                    // Convertir la chaîne de tags en tableau, en séparant par la virgule
                                    $technoArray = explode('|-|', $technos); 

                                    // Parcourir chaque tag et l'afficher dans une balise <span>
                                    foreach($technoArray as $techno) {
                                        echo '<li>' . trim(htmlspecialchars($techno)) . '</li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                            <?php
                            }   
                            ?>
                        </div>

                    </div>

                    <div class="fiche-projet-frame-results">

                        <div class="fiche-projet-frame-results-header">
                            <h2>Résultats</h2>
                        </div>

                        <div class="fiche-projet-frame-results-content">

                            <div class="fiche-projet-frame-results-list list-puce">
                                <ul>
                                    <?php 
                                    // Convertir la chaîne de tags en tableau, en séparant par la virgule
                                    $resultsArray = explode('|-|', $results); 

                                    // Parcourir chaque tag et l'afficher dans une balise <span>
                                    foreach($resultsArray as $result) {
                                        echo '<li><p>' . trim(htmlspecialchars($result)) . '</p></li>';
                                    }
                                    ?>
                                </ul>
                            </div>

                            <div class="fiche-projet-frame-results-img-container">

                                <div class="fiche-projet-frame-results-img">
                                    <?php
                                    if ($img_url_results != 'url image non disponible') {
                                        ?>
                                        <img src="images/projets/results/<?php echo htmlspecialchars($img_url_results); ?>" alt="<?php echo htmlspecialchars($alt_img_results); ?>" />
                                        <?php
                                    }
                                    ?>
                                </div>

                                <div class="fiche-projet-frame-results-links">
                                    <?php
                                    if ($powerbi_link != 'lien non disponible') {
                                        echo '<div class="ctn-icon button-scale">
                                                    <a href="' . htmlspecialchars($powerbi_link) . '" target="_blank">
                                                        <img src="images/icons/icons8-power-bi-2021-48.png" alt="Lien vers Power BI" />
                                                    </a>
                                                </div>';
                                    }   
                                    if ($github_link != 'lien non disponible') {
                                        echo '<div class="ctn-icon button-scale">
                                                    <a href="' . htmlspecialchars($github_link) . '" target="_blank">
                                                        <img src="images/icons/icons8-github-48.png" alt="Lien vers GitHub" />
                                                    </a>
                                                </div>';
                                    }
                                    if ($streamlit_link != 'lien non disponible') {
                                        echo '<div class="ctn-icon button-scale">
                                                    <a href="' . htmlspecialchars($streamlit_link) . '" target="_blank">
                                                        <img src="images/icons/icons8-streamlit-48.png" alt="Lien vers Streamlit" />
                                                    </a>
                                                </div>';
                                    }
                                    if ($video_link != 'lien non disponible') {
                                        echo '<div class="ctn-icon button-scale">
                                                    <a href="videos/' . htmlspecialchars($video_link) . '" target="_blank">
                                                        <img src="images/icons/icons8-video-48.png" alt="Lien vers Vidéo" />
                                                    </a>
                                                </div>';
                                    }
                                    if ($webApp_link != 'lien non disponible') {
                                        echo '<div class="ctn-icon button-scale">
                                                    <a href="' . htmlspecialchars($webApp_link) . '" target="_blank">
                                                        <img src="images/icons/icons8-weblink-48.png" alt="Lien vers Vidéo" />
                                                    </a>
                                                </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="fiche-projet-frame-group-dif-improv">

                        <?php if ($difficulties_learns != 'Information non disponible') { ?>    
                        <div class="fiche-projet-frame-difficulties-learns">
                            <h2>Difficultés</h2>
                            <div class="list-puce">
                                <ul>
                                    <?php 
                                    // Convertir la chaîne de tags en tableau, en séparant par la virgule
                                    $difficulties_learnsArray = explode('|-|', $difficulties_learns); 

                                    // Parcourir chaque tag et l'afficher dans une balise <span>
                                    foreach($difficulties_learnsArray as $difficulty_learn) {
                                        echo '<li>' . trim(htmlspecialchars($difficulty_learn)) . '</li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if ($potential_improvements != 'Information non disponible') { ?>
                        <div class="fiche-projet-frame-improvements">
                            <h2>Perspectives d'amélioration</h2>
                            <div class="list-puce">
                                <ul>
                                    <?php 
                                    // Convertir la chaîne de tags en tableau, en séparant par la virgule
                                    $potential_improvementsArray = explode('|-|', $potential_improvements); 

                                    // Parcourir chaque tag et l'afficher dans une balise <span>
                                    foreach($potential_improvementsArray as $potential_improvement) {
                                        echo '<li>' . trim(htmlspecialchars($potential_improvement)) . '</li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <?php } ?>
                    </div>

                </div>

            </section>
        </div>

    </main>