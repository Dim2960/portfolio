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
                // On considère que la première ligne contient les en-têtes, on la saute
                $firstRow = true;
                foreach ($rows as $row) {
                    if ($firstRow) {
                        $firstRow = false;
                        continue;
                    }
                    if (!isset($row[0])) {
                        break;
                    }
                    
                    // Adapter les indices en fonction de votre fichier Excel
                    $id       = isset($row[0]) ? $row[0] : 0;
                    $titre       = isset($row[1]) ? $row[1] : 'Titre non défini';
                    $description = isset($row[2]) ? $row[2] : 'Description non disponible';
                    $image_url = isset($row[3]) ? $row[3] : 'url image non disponible';
                    $image_alt = isset($row[4]) ? $row[4] : 'alt image non disponible';
                    $tags = isset($row[5]) ? $row[5] : 'tags image non disponible';
                    ?>
                    <div class="projet-card-frame">
                        <form action="fiche_projet.php" method="POST" style="display:inline;">
                            <div class="projet-card" onclick="this.closest('form').submit();" style="cursor: pointer;">
                                <!-- Zone d'image -->
                                <div class="card-image">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
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