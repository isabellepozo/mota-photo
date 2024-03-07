// lightbox.js

document.addEventListener("DOMContentLoaded", function () {
    const openLightboxButtons = document.querySelectorAll('.open-lightbox');
    const lightbox = document.getElementById('lightbox');
    const closeButton = lightbox.querySelector('.lightbox__close');
    const imageContainer = lightbox.querySelector('.lightbox__container img');

    openLightboxButtons.forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            // Récupérer l'URL de l'image depuis l'attribut data-image-url
            const imageUrl = button.getAttribute('data-image-url');

            // Mettre à jour la source de l'image dans la lightbox
            imageContainer.src = imageUrl;

            // Afficher la lightbox seulement si elle n'est pas déjà affichée
            if (lightbox.style.display !== 'block') {
                lightbox.style.display = 'block';
            }
        });
    });

    closeButton.addEventListener('click', function () {
        // Cacher la lightbox
        lightbox.style.display = 'none';
    });
});



