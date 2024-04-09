jQuery(document).ready(function($) {
    var offset = 8; // Le nombre de photos déjà affichées
    var loadedPhotoIds = []; // Stocker les IDs des photos déjà chargées

    // Récupérer les IDs des photos déjà chargées au chargement initial
    $('.related-photo').each(function() {
        var photoId = $(this).data('photo-id');
        if (typeof photoId !== 'undefined' && photoId !== null) {
            loadedPhotoIds.push(photoId);
        }
    });

    // Fonction pour charger plus de photos lors du clic sur le bouton "Charger plus"
    $('.load-more-button').on('click', function(e) {
        e.preventDefault();

        // Envoyer une requête Ajax pour charger plus de photos
        $.ajax({
            url: ajax_object.ajaxurl,
            type: 'POST', // Utiliser la méthode POST pour passer les données
            data: {
                action: 'load_more_photos',
                offset: offset,
                loaded_photo_ids: loadedPhotoIds // Passer les IDs des photos déjà chargées à la requête AJAX
            },
            success: function(response) {
                if (response.length > 0) {
                    response.forEach(function(photo) {
                        var newPhotoHtml = `<div class="related-photo" data-photo-id="${photo.id}">
                            <a href="${photo.permalink}" class="related-photo-link">
                                <img src="${photo.image}" class="related-photo-thumbnail" alt="${photo.title}">
                            </a>
                            <div class="related-photo-overlay">
                                <a href="${photo.permalink}" class="related-photo-info">
                                    <img src="/wp-content/themes/mota-photo/assets/images/icon_eye.png" class="icon_eye" alt="Icon en forme d'oeil">
                                </a>
                                <a href="#" class="open-lightbox related-photo-lightbox" data-image-url="${photo.image}" data-reference="${photo.reference}" data-category="${photo.category}">
                                    <img src="/wp-content/themes/mota-photo/assets/images/icon_fullscreen.png" class="icon_fullscreen" alt="Icon plein écran">
                                </a>
                            </div>
                        </div>`;

                        $('.related-photos-grid').append(newPhotoHtml);
                        
                        // Assurez-vous que imageData est défini globalement avant cet endroit dans votre script global.
                        imageData.push({
                            url: photo.image,
                            reference: photo.reference,
                            categories: [{name: photo.category}]
                        });

                        loadedPhotoIds.push(photo.id);
                    });

                    offset += response.length;
                } else {
                    $('.load-more-container').hide();
                }
            },
            error: function(xhr, status, error) {
                console.error("Erreur lors du chargement des photos :", error);
            }
        });
    });
});
