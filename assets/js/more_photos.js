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

    $('.load-more-button').on('click', function(e) {
        e.preventDefault();

        $.ajax({
            url: ajax_object.ajaxurl,
            type: 'POST',
            data: {
                action: 'load_more_photos',
                offset: offset,
                loaded_photo_ids: loadedPhotoIds // Passer les IDs des photos déjà chargées à la requête AJAX
            },
            success: function(response) {
                if (response.length > 0) {
                    // Boucle sur chaque nouvelle photo dans la réponse
                    $.each(response, function(index, photo) {
                        // Crée un élément pour chaque nouvelle photo
                        var newPhoto = '<div class="related-photo" data-photo-id="' + photo.id + '"><a href="' + photo.permalink + '" class="related-photo-link"><img src="' + photo.image + '" class="related-photo-thumbnail" alt="' + photo.title + '"></a><div class="related-photo-overlay"><a href="' + photo.permalink + '" class="related-photo-info"><img src="' + photo.icon_eye + '" class="icon_eye" alt="Icon en forme d\'oeil"></a><a href="#" class="open-lightbox related-photo-lightbox" data-image-url="' + photo.image + '"><img src="' + photo.icon_fullscreen + '" class="icon_fullscreen" alt="Icon plein écran"></a></div></div>';
                        // Ajoute la nouvelle photo à la grille
                        $('.related-photos-grid').append(newPhoto);
                        // Ajoute l'ID de la nouvelle photo à la liste des photos chargées
                        loadedPhotoIds.push(photo.id);
                    });

                    // Incrémente l'offset
                    offset += 8;
                } else {
                    // Masque le bouton s'il n'y a plus de photos à charger
                    $('.load-more-container').hide();
                }
            },
        });
    });
});


