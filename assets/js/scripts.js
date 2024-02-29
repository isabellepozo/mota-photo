// ********** Gestion de la modale ********** //
let contactModal = document.querySelector("#contact-modal")
let menuItem = document.querySelector("#menu-item-49 a")
let contactButton = document.querySelector(".bouton-contact a");

menuItem.addEventListener("click", function (){
    contactModal.style.display = "block"
})

contactButton.addEventListener("click", function (event) {
    event.preventDefault(); // Empêche le comportement par défaut du lien
    contactModal.style.display = "block";
});

window.onclick = function(event) {
    if (event.target == contactModal) {
        contactModal.style.display = "none";
    }
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


// ********** Gestion de la ligthbox  ********** //

// Fonction pour ouvrir la lightbox
function openLightbox(imageUrl) {
    // Afficher la lightbox et charger l'image
    document.getElementById('lightbox').style.display = 'block';
    document.getElementById('lightbox-image').src = imageUrl;
}

// Fonction pour fermer la lightbox
function closeLightbox() {
    // Masquer la lightbox
    document.getElementById('lightbox').style.display = 'none';
}

// Ajouter des écouteurs d'événements pour ouvrir et fermer la lightbox
document.addEventListener('DOMContentLoaded', function () {
    // Écouteur d'événement pour ouvrir la lightbox lorsqu'on clique sur l'icône plein écran
    document.getElementById('open-lightbox').addEventListener('click', function (event) {
        event.preventDefault(); // Empêcher le comportement par défaut du lien
        openLightbox(this.getAttribute('data-image-url'));
    });

    // Écouteur d'événement pour fermer la lightbox lorsqu'on clique sur le bouton de fermeture
    document.getElementById('close-lightbox').addEventListener('click', function () {
        closeLightbox();
    });

    // Écouteur d'événement pour fermer la lightbox lorsqu'on clique en dehors de l'image
    window.onclick = function (event) {
        var lightbox = document.getElementById('lightbox');
        if (event.target == lightbox) {
            closeLightbox();
        }
    };
});



























