// S'assurer que le DOM est entièrement chargé avant d'exécuter le code
document.addEventListener("DOMContentLoaded", function () {
    // Sélectionner les éléments nécessaires dans le DOM
    const lightbox = document.getElementById('lightbox'); // Sélectionner la lightbox
    const closeButton = lightbox.querySelector('.lightbox__close'); // Sélectionner le bouton de fermeture de la lightbox
    const nextButton = lightbox.querySelector('.lightbox__next'); // Sélectionner le bouton pour afficher l'image suivante
    const prevButton = lightbox.querySelector('.lightbox__prev'); // Sélectionner le bouton pour afficher l'image précédente
    const imageContainer = lightbox.querySelector('.lightbox__container img'); // Sélectionner le conteneur de l'image
    const referenceElement = lightbox.querySelector('.lightbox__reference'); // Sélectionner l'élément pour afficher la référence de l'image
    const categoryElement = lightbox.querySelector('.lightbox__category'); // Sélectionner l'élément pour afficher la catégorie de l'image

    // Sélectionner le conteneur global des photos
    const photosContainer = document.querySelector('.related-photos-grid');

    let currentIndex = 0; // Initialiser l'indice de l'image actuellement affichée dans la lightbox
    let imageData = []; // Initialiser un tableau pour stocker les données des images

    // Fonction pour afficher une image dans la lightbox
    function displayImage(index) {
        // Vérifier si l'indice est valide
        if (index >= 0 && index < imageData.length) {
            const imageUrl = imageData[index].image_url;
            // Mettre à jour l'URL de l'image dans le conteneur de l'image
            imageContainer.src = imageUrl;
            currentIndex = index;

            // Mettre à jour la référence et la catégorie de l'image dans la lightbox
            referenceElement.textContent = `Référence : ${imageData[index].reference || 'N/A'}`;
            categoryElement.textContent = `Catégorie : ${imageData[index].category || 'N/A'}`;
        }
    }

    // Fonction pour ouvrir la lightbox avec une image spécifique
    function openLightbox(index) {
        displayImage(index); // Affichez l'image spécifiée dans la lightbox
        lightbox.style.display = 'block'; // Affichez la lightbox
    }

    // Écouter les clics sur le conteneur global des photos
    photosContainer.addEventListener('click', function (event) {
        let target = event.target;
        // Parcourir les parents de l'élément cliqué pour détecter s'il s'agit d'un bouton pour ouvrir la lightbox
        while (target != photosContainer) {
            if (target.matches('.open-lightbox')) {
                event.preventDefault(); // Empêchez le comportement par défaut du lien
                const index = Array.from(photosContainer.querySelectorAll('.open-lightbox')).indexOf(target);
                openLightbox(index); // Ouvrez la lightbox avec l'image correspondante
                return;
            }
            target = target.parentNode;
        }
    });

    // Écouter les clics sur le bouton de fermeture de la lightbox
    closeButton.addEventListener('click', function () {
        lightbox.style.display = 'none'; // Masquez la lightbox
    });

    // Écouter les clics sur le bouton pour afficher l'image précédente
    prevButton.addEventListener('click', function() {
        displayImage((currentIndex - 1 + imageData.length) % imageData.length); // Affichez l'image précédente
    });

    // Écouter les clics sur le bouton pour afficher l'image suivante
    nextButton.addEventListener('click', function() {
        displayImage((currentIndex + 1) % imageData.length); // Affichez l'image suivante
    });

    // Initialiser les images en récupérant les données des boutons de la lightbox
    function initializeImages() {
        const lightboxButtons = document.querySelectorAll('.related-photo .open-lightbox');
        imageData = Array.from(lightboxButtons).map(button => ({
            image_url: button.getAttribute('data-image-url'), // Obtenez l'URL de l'image
            reference: button.getAttribute('data-reference'), // Obtenez la référence de l'image
            category: button.getAttribute('data-category') // Obtenez la catégorie de l'image
        }));
    }

    // Appeler la fonction d'initialisation des images
    initializeImages();
});
