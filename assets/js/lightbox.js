//   lightbox.js

document.addEventListener("DOMContentLoaded", function () {
    const lightbox = document.getElementById('lightbox');
    const closeButton = lightbox.querySelector('.lightbox__close');
    const nextButton = lightbox.querySelector('.lightbox__next');
    const prevButton = lightbox.querySelector('.lightbox__prev');
    const imageContainer = lightbox.querySelector('.lightbox__container img');

    let currentIndex = 0; // Index de l'image actuellement affichée

    // Précharger les URLs des images
    const imageUrls = [];
    const openLightboxButtons = document.querySelectorAll('.open-lightbox');
    openLightboxButtons.forEach(function (button, index) {
        const imageUrl = button.getAttribute('data-image-url');
        imageUrls.push(imageUrl);
        // Ajouter un écouteur d'événement pour ouvrir la lightbox avec l'image correspondante
        button.addEventListener('click', function (event) {
            event.preventDefault();
            displayImage(index);
            // Afficher la lightbox
            lightbox.style.display = 'block';
        });
    });

    // Afficher la première image lorsque la lightbox est ouverte
    displayImage(0);

    // Fonction pour afficher une image dans la lightbox
    function displayImage(index) {
        const imageUrl = imageUrls[index];
        imageContainer.src = imageUrl;
        currentIndex = index;
        console.log('Affichage de l\'image à l\'index', index, ':', imageUrl);
    }

    closeButton.addEventListener('click', function () {
        // Cacher la lightbox
        lightbox.style.display = 'none';
    });

    // Ajouter la logique de navigation avec les flèches
    nextButton.addEventListener('click', function () {
        currentIndex = (currentIndex + 1) % imageUrls.length;
        console.log('Nouvelle valeur de currentIndex (après clic sur Next) :', currentIndex);
        displayImage(currentIndex);
    });

    prevButton.addEventListener('click', function () {
        currentIndex = (currentIndex - 1 + imageUrls.length) % imageUrls.length;
        console.log('Nouvelle valeur de currentIndex (après clic sur Previous) :', currentIndex);
        displayImage(currentIndex);
    });
});

