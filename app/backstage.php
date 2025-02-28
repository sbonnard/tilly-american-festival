<?php
session_start();

require_once 'includes/_database.php';
require_once 'includes/_config.php';
require_once 'includes/_security.php';
require_once 'includes/_functions.php';
require_once 'includes/_datas.php';
require_once 'includes/_message.php';
require_once 'includes/templates/_head.php';
require_once 'includes/templates/_header.php';
require_once 'includes/templates/_footer.php';

require_once 'includes/classes/class.event.php';
require_once 'includes/classes/class.band.php';
require_once 'includes/classes/class.merchant.php';
require_once 'includes/classes/class.sponsor.php';


generateToken();

checkConnection($_SESSION);

$allBands = fetchAllBands($dbCo);
$allEvents = fetchAllEvents($dbCo);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?= fetchHead(); ?>
</head>

<body>

    <?= fetchHeader('', '', '', '', '', '', '', 'nav__lnk--current'); ?>

    <main class="main">
        <div class="container">
            <h1 class="ttl" id="partner-ttl">Les backstages</h1>
            <?= getErrorMessage($errors); ?>
            <?= getSuccessMessage($messages); ?>

            <section class="section--buttons">
                <a href="event-form.php" class="button button--contact">Nouvel Évènement</a>
                <a href="band-form.php" class="button button--contact">Nouveau Groupe</a>
                <a href="sponsor-form.php" class="button button--contact">Nouveau Sponsor</a>
                <a href="merchant-form.php" class="button button--contact">Nouvel Exposant</a>
            </section>

            <div class="dropdown__container">
                <section class="section" aria-labelledby="event-ttl">
                    <button id="event-dropdown" class="dropdown-banner" aria-label="Afficher ou masquer la liste des groupes" aria-expanded="false">
                        <h2 class="ttl ttl--red" id="event-ttl">Les Évènements</h2>
                        <img src="img/arrow-down.svg" alt="Flèche descendante">
                    </button>

                    <div class="sponsor__container hidden" id="event-dropdown-content">
                        <ul class="band__list">
                            <?= getAllEventsAsList($allEvents) ?>
                        </ul>
                    </div>
                </section>

                <section class="section" aria-labelledby="band-ttl">
                    <button id="band-dropdown" class="dropdown-banner" aria-label="Afficher ou masquer la liste des groupes" aria-expanded="false">
                        <h2 class="ttl ttl--red" id="band-ttl">Les Groupes</h2>
                        <img src="img/arrow-down.svg" alt="Flèche descendante">
                    </button>

                    <div class="sponsor__container hidden" id="band-dropdown-content">
                        <ul class="band__list">
                            <?= getAllBandsAsList($allBands) ?>
                        </ul>
                    </div>
                </section>

                <section class="section" aria-labelledby="sponsor-ttl">
                    <button id="sponsor-dropdown" class="dropdown-banner" aria-label="Afficher ou masquer la liste des sponsors" aria-expanded="false">
                        <h2 class="ttl ttl--red">Nos Sponsors</h2>
                        <img src="img/arrow-down.svg" alt="Flèche descendante">
                    </button>

                    <div class="sponsor__container hidden" id="sponsor-dropdown-content">
                        <?= listSponsorsHTML($allSponsors, '', $_SESSION); ?>
                    </div>
                </section>

                <section class="section" aria-labelledby="merchant-ttl">
                    <button id="merchant-dropdown" class="dropdown-banner" aria-label="Afficher ou masquer la liste des commerçants" aria-expanded="false">
                        <h2 class="ttl ttl--red">Les exposants</h2>
                        <img src="img/arrow-down.svg" alt="Flèche descendante">
                    </button>

                    <div class="sponsor__container hidden" id="merchant-dropdown-content">
                        <?= listMerchantsHTML($activeMerchants, $_SESSION); ?>
                    </div>
                </section>

            </div>
        </div>

        </div>

    </main>

    <footer class="footer">
        <p>Les sponsors actifs :</p>
        <?= fetchFooter($activeSponsors); ?>
    </footer>
</body>

<script>
    AOS.init();
</script>
<script type="module" src="js/burger.js"></script>
<script type="module" src="js/dropdown.js"></script>
<script type="module" src="js/notifs.js"></script>
<script type="module" src="js/ajaxxxx.js"></script>
<script>
    function confirmDeleteMerchant(button) {
    // Demander confirmation
    const isConfirmed = confirm("Êtes-vous sûr de vouloir supprimer l'exposant ? Cette action est IRREVERSIBLE.");

    if (isConfirmed) {
        // Si l'utilisateur confirme, on récupère l'ID du marchand
        const merchantId = button.getAttribute("data-merchant-id");

        // Envoi de la requête AJAX pour supprimer le marchand
        const data = { id_merchant: merchantId };
        
        console.log(data)

        fetch("api.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            // Vérification du statut HTTP
            console.log(response); // Affiche la réponse HTTP dans la console
            if (!response.ok) {
                throw new Error('Erreur de réponse HTTP: ' + response.status);
            }
            return response.json();
        })
        .then(result => {
            console.log(result); // Affiche le résultat du serveur
            if (result.success) {
                // Si la suppression est réussie, on peut faire quelque chose (par exemple, supprimer l'élément du DOM)
                alert("Exposant supprimé avec succès.");
                button.closest("li").remove(); // Enlève le li contenant le bouton
            } else {
                // Si la suppression échoue
                alert("Erreur lors de la suppression de l'exposant.");
            }
        })
        .catch(error => {
            console.error("Erreur AJAX :", error);
            location.reload();
        });
    } else {
        // Si l'utilisateur annule, rien ne se passe
        console.log("Suppression annulée");
    }
}
</script>

</html>