// ********** Gestion de la modale ********** //
let contactModal = document.querySelector("#contact-modal")
let menuItem = document.querySelector("#menu-item-49 a")

menuItem.addEventListener("click", function (){
    contactModal.style.display = "block"
})

window.onclick = function(event) {
    if (event.target == contactModal) {
        contactModal.style.display = "none";
    }
}





document.addEventListener('DOMContentLoaded', function () {
    var linkPrevious = document.querySelector(".fleche-gauche a");
    var linkNext = document.querySelector(".fleche-droite a");
    var thumbnailContainer = document.querySelector(".image-container");
    var currentImage = null;

    function loadImage(link) {
        var imageUrl = link.getAttribute('data-image-url');

        // Vérifier si l'image actuelle est différente de celle que vous essayez de charger
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






























