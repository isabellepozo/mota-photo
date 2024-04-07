// ********** Gestion de la modale ********** //
let contactModal = document.querySelector("#contact-modal");
let contactButtonSingle = document.querySelector(".bouton-contact a"); // Bouton contact sur la page de détail des photos
let contactButtonMenu = document.querySelector("#menu-item-49 a"); // Lien contact dans le menu

// Vérifie si l'élément #contact-modal existe dans le DOM
if (contactModal) {
    // Fonction pour ouvrir la modale
    function openModal() {
        contactModal.style.display = "block";
    }

    // Fonction pour fermer la modale
    function closeModal() {
        contactModal.style.display = "none";
    }

    // Gestion de l'ouverture de la modale depuis le bouton contact sur la page de détail des photos
    if (contactButtonSingle) {
        contactButtonSingle.addEventListener("click", function (event) {
            event.preventDefault(); // Empêche le comportement par défaut du lien
            openModal();
        });
    }

    // Gestion de l'ouverture de la modale depuis le lien contact dans le menu
    if (contactButtonMenu) {
        contactButtonMenu.addEventListener("click", function (event) {
            event.preventDefault(); // Empêche le comportement par défaut du lien
            openModal();
        });
    }

    // Gestion de la fermeture de la modale
    window.onclick = function (event) {
        if (event.target == contactModal) {
            closeModal();
        }
    };
}

// ********** Gestion du Hover flèches single-photos.php ********** //
document.addEventListener('DOMContentLoaded', function () {
    var linkPrevious = document.querySelector(".fleche-gauche a");
    var linkNext = document.querySelector(".fleche-droite a");
    var thumbnailContainer = document.querySelector(".image-container");
    var currentImage = null;

    function loadImage(link) {
        var imageUrl = link.getAttribute('data-image-url');

        // Vérifier si l'image actuelle est différente de celle qui charge
        if (currentImage !== imageUrl) {
            // Créer une nouvelle balise d'image
            var newImage = new Image();
            newImage.src = imageUrl;
            newImage.alt = "Image chargée";

            // Vider le conteneur actuel
            thumbnailContainer.innerHTML = "";

            // Ajouter la nouvelle image au conteneur
            thumbnailContainer.appendChild(newImage);

            // Mettre à jour l'image actuelle
            currentImage = imageUrl;
        }
    }

    // Fonction pour charger l'image suivante au chargement initial de la page
    function loadNextImageOnPageLoad() {
        if (linkNext) {
            loadImage(linkNext);
        }
    }

    // Appeler la fonction au chargement initial de la page
    loadNextImageOnPageLoad();

    if (linkNext) {
        linkNext.addEventListener("mouseover", function (event) {
            event.preventDefault(); // Empêche la navigation vers le lien
            loadImage(linkNext);
        });
    }

    if (linkPrevious) {
        linkPrevious.addEventListener("mouseover", function (event) {
            event.preventDefault(); // Empêche la navigation vers le lien
            loadImage(linkPrevious);
        });
    }
});

// ************************* Menu burger ************************* //
document.addEventListener('DOMContentLoaded', function() {
    const burgerMenu = document.querySelector('.burger-menu');
    const closeMenu = document.querySelector('.close-menu'); // Sélectionner l'élément de fermeture du menu
    const navMenu = document.querySelector('.nav-header ul');

    burgerMenu.addEventListener('click', function() {
        navMenu.classList.toggle('active'); // Ajouter la classe "active" pour afficher le menu
        burgerMenu.classList.toggle('hidden'); // Ajouter la classe "hidden" pour cacher le menu burger
        closeMenu.classList.toggle('hidden'); 
        document.body.classList.toggle('menu-open'); // Ajouter une classe au body pour empêcher le défilement lorsque le menu est ouvert
    });

    // Ajoutez un écouteur d'événements au bouton de fermeture du menu
    closeMenu.addEventListener('click', function() {
        navMenu.classList.remove('active');
        burgerMenu.classList.remove('hidden'); 
        closeMenu.classList.remove('hidden'); // Supprimer la classe pour afficher la croix 
        closeMenu.classList.toggle('hidden'); // Réactiver la classe pour cacher la croix
        document.body.classList.remove('menu-open'); // Supprimer la classe pour réactiver le défilement
    });
});



























