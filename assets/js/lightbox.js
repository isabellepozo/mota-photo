//   lightbox.js
document.addEventListener("DOMContentLoaded", function () {
    const lightbox = document.getElementById('lightbox');
    const closeButton = lightbox.querySelector('.lightbox__close');
    const nextButton = lightbox.querySelector('.lightbox__next');
    const prevButton = lightbox.querySelector('.lightbox__prev');
    const imageContainer = lightbox.querySelector('.lightbox__container img');
    const referenceElement = lightbox.querySelector('.lightbox__reference');
    const categoryElement = lightbox.querySelector('.lightbox__category');

    let currentIndex = 0; // Index de l'image actuellement affichée

    // Fonction pour afficher une image dans la lightbox
    function displayImage(index) {
        const imageUrl = imageUrls[index];
        imageContainer.src = imageUrl;

        // Récupérer les métadonnées de l'image
        const imageDataItem = imageData[index];

        // Mettre à jour les métadonnées de l'image
        referenceElement.textContent = "Référence : " + imageDataItem.reference;

        let categories = "";
        if (imageDataItem.categories) {
            imageDataItem.categories.forEach(function(category) {
                categories += category.name + ", ";
            });
            categories = categories.slice(0, -2); // Retire la dernière virgule et l'espace
        }
        categoryElement.textContent = "Catégorie : " + categories;

        currentIndex = index;
    }

    // Ajouter un écouteur d'événement pour ouvrir la lightbox avec l'image correspondante
    function openLightbox(index) {
        displayImage(index);
        // Afficher la lightbox
        lightbox.style.display = 'block';
    }

    // Précharger les URLs des images et ajouter les écouteurs d'événement pour ouvrir la lightbox
    const imageUrls = [];
    const openLightboxButtons = document.querySelectorAll('.open-lightbox');
    openLightboxButtons.forEach(function (button, index) {
        const imageUrl = button.getAttribute('data-image-url');
        imageUrls.push(imageUrl);
        // Ajouter un écouteur d'événement pour ouvrir la lightbox avec l'image correspondante
        button.addEventListener('click', function (event) {
            event.preventDefault();
            openLightbox(index);
        });
    });

    // Afficher la première image lorsque la lightbox est ouverte
    displayImage(0);

    closeButton.addEventListener('click', function () {
        // Cacher la lightbox
        lightbox.style.display = 'none';
    });

    // Ajouter la logique de navigation avec les flèches
    nextButton.addEventListener('click', function () {
        currentIndex = (currentIndex + 1) % imageUrls.length;
        displayImage(currentIndex);
    });

    prevButton.addEventListener('click', function () {
        currentIndex = (currentIndex - 1 + imageUrls.length) % imageUrls.length;
        displayImage(currentIndex);
    });

});




