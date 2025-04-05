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
require_once 'includes/classes/class.band.php';
require_once 'includes/classes/class.sponsor.php';
require_once 'includes/classes/class.merchant.php';

generateToken();

if (isset($_SESSION['form'])) {
    unset($_SESSION['form']);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?= fetchHead(); ?>
</head>

<body>

    <?= fetchHeader('', 'nav__lnk--current'); ?>

    <main class="main">
        <div class="container">
            <h1 class="ttl" id="where-ttl">Où sommes-nous ?</h1>
            <section class="section" aria-labelledby="where-ttl">
                <img class="tourism__img" src="img/festival.webp" alt="Photo du festival">
                <div class="section section--left">
                    <p>Le Tilly American Festival, situé à Tilly-sur-Seulles en Normandie (Calvados), bénéficie d’un emplacement exceptionnel.
                        À proximité immédiate de Caen et Bayeux, ainsi que des célèbres plages du Débarquement, le festival se trouve au cœur d’une région riche en histoire.
                        De l’époque médiévale à l’héritage de la Seconde Guerre mondiale, la Normandie offre un cadre unique qui allie culture, patrimoine et commémorations historiques, faisant du festival une expérience ancrée dans un lieu symbolique et touristique.</p>
                    <p>Enfin, la Normandie est réputée pour sa gastronomie exceptionnelle : les fromages locaux (comme le camembert ou le livarot), le cidre, le calvados et les fruits de mer ajoutent une dimension gourmande à l’expérience, offrant une combinaison parfaite de découvertes historiques, culturelles et culinaires.</p>
                    <p>De nombreuses solutions d’hébergement sont disponibles à proximité du festival : campings, Airbnb, maisons d’hôtes, et bien d’autres, idéales pour les visiteurs venant de loin !</p>
                </div>
                <a class="web__lnk" href="https://www.calvados-tourisme.com" target="_blank"><img class="web__logo" src="img/web.svg" alt="Symbole web">Calvados Tourisme ⮕</a>
            </section>

            <section class="section" aria-labelledby="caen-ttl">
                <h2 class="ttl" id="caen-ttl">Caen</h2>
                <img class="tourism__img" src="img/caen.webp" alt="Photo de Caen">
                <div class="section section--left">
                    <p>Caen, capitale historique de la Normandie, est une ville riche en histoire et en patrimoine. Marquée par Guillaume le Conquérant, elle abrite des monuments emblématiques comme le Château de Caen et les abbayes aux Hommes et aux Dames. Pendant la Seconde Guerre mondiale, la ville a joué un rôle central lors de la Bataille de Normandie, un héritage commémoré au Mémorial de Caen, musée incontournable. Aujourd’hui, Caen séduit par son dynamisme culturel, ses espaces verts et sa proximité avec les plages du Débarquement, en faisant un lieu à la fois historique, vivant et attractif.</p>
                </div>
                <a class="web__lnk" href="https://www.caenlamer-tourisme.fr" target="_blank"><img class="web__logo" src="img/web.svg" alt="Symbole web">Tourisme à Caen ⮕</a>
            </section>

            <section class="section" aria-labelledby="bayeux-ttl">
                <h2 class="ttl" id="bayeux-ttl">Bayeux</h2>
                <img class="tourism__img" src="img/bayeux.webp" alt="Photo de Bayeux">
                <div class="section section--left">
                    <p>Bayeux, joyau de la Normandie, est une ville au charme médiéval célèbre pour sa Tapisserie de Bayeux, chef-d'œuvre classé au patrimoine mondial de l'UNESCO, qui raconte l’épopée de Guillaume le Conquérant. Épargnée par les destructions de la Seconde Guerre mondiale, la ville offre un riche patrimoine architectural avec sa magnifique cathédrale Notre-Dame et ses rues pittoresques. Située à proximité des plages du Débarquement, Bayeux joue également un rôle clé dans le souvenir du D-Day, avec notamment le Musée Mémorial de la Bataille de Normandie. Alliant histoire, culture et authenticité, Bayeux est une destination incontournable de la région.</p>
                </div>
                <a class="web__lnk" href="https://bayeux-bessin-tourisme.com" target="_blank"><img class="web__logo" src="img/web.svg" alt="Symbole web">Tourisme à Bayeux ⮕</a>
            </section>

            <section class="section" aria-labelledby="dday-ttl">
                <h2 class="ttl" id="dday-ttl">Plages du débarquement</h2>
                <img class="tourism__img" src="img/BeachCJB.webp" alt="Plages du débarquement">
                <p>Crédit photo : ©CJB</p>
                <div class="section section--left">
                    <p>Les plages du Débarquement, situées sur la côte normande, sont un lieu emblématique de l’Histoire moderne. Le 6 juin 1944, elles furent le théâtre de l’une des opérations militaires les plus importantes de la Seconde Guerre mondiale : le Débarquement allié, qui marqua le début de la libération de l’Europe occupée.
                        Parmi les plages principales, on trouve Omaha Beach, surnommée "Bloody Omaha" en raison des lourdes pertes subies, Utah Beach, où les forces américaines ont débarqué, et Gold, Juno et Sword, où Britanniques et Canadiens ont mené l’assaut.
                        Aujourd’hui, ces plages sont des lieux de mémoire, accompagnés de musées, de cimetières militaires (comme celui de Colleville-sur-Mer) et de vestiges, tels que les batteries de Longues-sur-Mer et le port artificiel d’Arromanches. Elles attirent chaque année des milliers de visiteurs, venus rendre hommage et découvrir ce site chargé d’histoire.
                    </p>
                </div>
            </section>


        </div>

        <?= displayCowquitaf(); ?>
    </main>

    <footer class="footer">
        <?= fetchFooter($activeSponsors); ?>
    </footer>
</body>

<script>
    AOS.init();
</script>
<script type="module" src="js/burger.js"></script>

</html>