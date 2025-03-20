
<section id="contact">  
    <div class="container-contact">
        
        <div class="image-contact">
            <img src="images/illustrations/contact.webp" alt="image d'illustration contact">
        </div>
        <div class="form-container">
            <h2>Contactez-moi</h2>
            <form action="index" method="post">
                <select id="titre" name="titre" required>
                    <option value="">Sélectionnez votre titre *</option>
                    <option value="monsieur">Monsieur</option>
                    <option value="madame">Madame</option>
                    <option value="non précisé">Ne souhaite pas préciser</option>
                </select>
                
                <!-- Champs prénom et nom sur la même ligne, avec astérisque dans les placeholder -->
                <div class="input-row">
                <input type="text" id="prenom" name="prenom" placeholder="Votre prénom *" required>
                <input type="text" id="nom" name="nom" placeholder="Votre nom *" required>
                </div>
                
                <input type="email" id="email" name="email" placeholder="Votre email *" required>
                <textarea id="message" name="message" placeholder="Votre message *" required></textarea>
                
                <div style ="text-align: left;">* champs obligatoires</div>
                <br/>
                <button type="submit">Envoyer</button>
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            </form>
            <?php  if (!empty($notification)): ?>
                <div class="notification <?php echo (strpos($notification, 'succès') !== false) ? 'success' : 'error'; ?>">
                <?php 
                    echo htmlspecialchars($notification); 
                    unset($_SESSION['notification']); // Supprimer la notification après l'avoir affichée
                ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
