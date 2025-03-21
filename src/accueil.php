
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
                <svg class="github-svg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"></path>
                    <path d="M9 18c-4.51 2-5-2-7-2"></path>
                </svg>
            </a>
            <a href="<?php echo htmlspecialchars($data['LinkedIn']); ?>" target="_blank">
                <svg class="linkedIn-svg" xmlns="http://www.w3.org/2000/svg" width="24" height="24"  fill="white"  stroke-width="1"class="bi bi-linkedin" viewBox="0 0 16 16">
                    <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
                </svg>
            </a>
        </div>
    </section>

