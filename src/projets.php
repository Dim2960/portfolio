<section id="projets">
    <h2>Mes Projets</h2>
    <div class="projet-list">
        <div class="carousel-container">
        
            <div class="carousel-track">  
                <div class="carousel-controls">
                    <button class="carousel-btn prev">‹</button>
                    <button class="carousel-btn next">›</button>
                </div>

                <?php
                foreach ($allDataProject as $fileName => $rows) {
                    // On affiche le nom du fichier pour le débogage

                    $filePath = '../data/projets/' . $fileName;
                    $dataprojet = readExcelData($filePath);

                    // Indice en fonction de la colonne excel
                    $id = $dataprojet['id'];
                    $titre = $dataprojet['title'];
                    $description = $dataprojet['description'];
                    $image_url = $dataprojet['image_url'];
                    $image_alt = $dataprojet['image_alt'];
                    $tags = $dataprojet['tags'];
                    ?>
                    <div class="projet-card-frame">
                        <form action="fiche_projet.php" method="POST" style="display:inline;"> <!-- en local mettre fiche_projet.php -- cause .htaccess -->
                            <div class="projet-card" onclick="this.closest('form').submit();" style="cursor: pointer;">
                                <!-- Zone d'image -->
                                <div class="card-image">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                                        <input type="hidden" name="fileName" value="<?php echo htmlspecialchars($fileName); ?>">
                                        <input type="hidden" name="theme" class="hidden-theme" value="<?php echo $_COOKIE['theme']; ?>">
                                        <input type="image" src="images/projets/global/<?php echo htmlspecialchars($image_url); ?>" alt="<?php echo htmlspecialchars($image_alt); ?>" />
                                </div>
                                <!-- Zone de contenu texte -->
                                <div class="card-content">
                                    <div class="title-frame">
                                        <h3><?php echo htmlspecialchars($titre); ?></h3>
                                        
                                    </div>
                                    <p>
                                        <?php echo nl2br(htmlspecialchars($description)); ?>
                                    </p>
                                    <!-- Zone des tags -->
                                    <div class="tags">
                                    <?php 
                                    // Convertir la chaîne de tags en tableau, en séparant par la virgule
                                    $tagsArray = explode(',', $tags); 
                                    
                                    // Parcourir chaque tag et l'afficher dans une balise <span>
                                    foreach($tagsArray as $tag) {
                                        echo '<span>' . trim(htmlspecialchars($tag)) . '</span>';
                                    }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    
</section>

