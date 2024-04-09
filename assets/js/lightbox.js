document.addEventListener("DOMContentLoaded", function () {
    const lightbox = document.getElementById('lightbox');
    const closeButton = lightbox.querySelector('.lightbox__close');
    const nextButton = lightbox.querySelector('.lightbox__next');
    const prevButton = lightbox.querySelector('.lightbox__prev');
    const imageContainer = lightbox.querySelector('.lightbox__container img');
    const referenceElement = lightbox.querySelector('.lightbox__reference');
    const categoryElement = lightbox.querySelector('.lightbox__category');

    // Sélecteur pour le conteneur global des photos
    const photosContainer = document.querySelector('.related-photos-grid');

    let currentIndex = 0;

    function displayImage(index) {
        if (index >= 0 && index < imageData.length) {
            const imageUrl = imageData[index].url;
            imageContainer.src = imageUrl;
            currentIndex = index;
    
            const reference = imageData[index].reference || 'N/A';
            const categories = imageData[index].categories.map(c => c.name).join(', ') || 'N/A';
    
            referenceElement.textContent = `Référence : ${reference}`;
            categoryElement.textContent = `Catégorie : ${categories}`;
        }
    }

    function openLightbox(index) {
        displayImage(index);
        lightbox.style.display = 'block';
    }

    photosContainer.addEventListener('click', function (event) {
        let target = event.target;
        while (target != photosContainer) {
            if (target.matches('.open-lightbox')) {
                event.preventDefault();
                const index = Array.from(photosContainer.querySelectorAll('.open-lightbox')).indexOf(target);
                openLightbox(index);
                return;
            }
            target = target.parentNode;
        }
    });

    closeButton.addEventListener('click', function () {
        lightbox.style.display = 'none';
    });

    // Lorsque le bouton précédent est cliqué
    document.querySelector('.lightbox__prev').addEventListener('click', function() {
        displayImage((currentIndex - 1 + imageData.length) % imageData.length);
    });

    // Lorsque le bouton suivant est cliqué
    document.querySelector('.lightbox__next').addEventListener('click', function() {
        displayImage((currentIndex + 1) % imageData.length);
    });

    function initializeImages() {
        imageUrls.length = 0;
    
        const lightboxButtons = document.querySelectorAll('.related-photo .open-lightbox');
        console.log('Nombre de boutons trouvés:', lightboxButtons.length); // Pour le débogage
    
        lightboxButtons.forEach(function (button, index) {
            console.log('Bouton:', button); // Vérifier l'élément bouton
            const imageUrl = button.getAttribute('data-image-url');
            console.log(`ImageUrl pour l'index ${index}:`, imageUrl); // Pour le débogage
            if (imageUrl) {
                imageUrls.push(imageUrl);
            } else {
                console.error('Attribut data-image-url manquant ou incorrect pour le bouton à l\'index', index);
            }
        });
    }

    initializeImages();
});



