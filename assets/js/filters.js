// ********************** Gestion des champs de filtre ********************* //

// Champs de filtre catégories
jQuery(document).ready(function($) {
    // Écouteur d'événement pour le changement de valeur dans le sélecteur de catégorie
    $('#category-filter').change(function() {
        // Récupérer la valeur sélectionnée dans le sélecteur de catégorie
        var category = $(this).val();
        
        // Effectuer une requête AJAX pour filtrer les photos par catégorie
        $.ajax({
            url: ajax_object.ajaxurl,
            type: 'POST',
            data: {
                action: 'filter_photos_by_category',
                category: category,
            },
            success: function(response) {
                // Mettre à jour la grille de photos avec les nouvelles données filtrées
                updatePhotoGrid(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    // Fonction pour mettre à jour la grille de photos avec les nouvelles données
    function updatePhotoGrid(photos) {
        // Supprimer toutes les photos actuellement affichées
        $('.related-photos-grid').empty();
        
        // Boucler à travers les données des nouvelles photos et les ajouter à la grille
        $.each(photos, function(index, photo) {
            var photoHTML = '<div class="related-photo">';
            photoHTML += '<a href="' + photo.permalink + '" class="related-photo-link">';
            photoHTML += '<img src="' + photo.image + '" class="related-photo-thumbnail" alt="' + photo.title + '">';
            photoHTML += '</a>';
            photoHTML += '<div class="related-photo-overlay">';
            photoHTML += '<a href="' + photo.permalink + '" class="related-photo-info"><img src="' + photo.icon_eye + '" class="icon_eye" alt="Icon en forme d\'oeil"></a>';
            photoHTML += '<a href="#" class="open-lightbox related-photo-lightbox" data-image-url="' + photo.image + '"><img src="' + photo.icon_fullscreen + '" class="icon_fullscreen" alt="Icon plein écran"></a>';
            photoHTML += '</div></div>';
            $('.related-photos-grid').append(photoHTML);
        });
    }
});


// Champs de filtre format
jQuery(document).ready(function($) {
    // Écouteur d'événement pour le changement de valeur dans le sélecteur de format
    $('#format-filter').change(function() {
        // Récupérer la valeur sélectionnée dans le sélecteur de format
        var format = $(this).val();
        
        // Effectuer une requête AJAX pour filtrer les photos par format
        $.ajax({
            url: ajax_object.ajaxurl,
            type: 'POST',
            data: {
                action: 'filter_photos_by_format',
                format: format,
            },
            success: function(response) {
                // Mettre à jour la grille de photos avec les nouvelles données filtrées
                updatePhotoGrid(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    // Fonction pour mettre à jour la grille de photos avec les nouvelles données
    function updatePhotoGrid(photos) {
        // Supprimer toutes les photos actuellement affichées
        $('.related-photos-grid').empty();
        
        // Boucler à travers les données des nouvelles photos et les ajouter à la grille
        $.each(photos, function(index, photo) {
            var photoHTML = '<div class="related-photo">';
            photoHTML += '<a href="' + photo.permalink + '" class="related-photo-link">';
            photoHTML += '<img src="' + photo.image + '" class="related-photo-thumbnail" alt="' + photo.title + '">';
            photoHTML += '</a>';
            photoHTML += '<div class="related-photo-overlay">';
            photoHTML += '<a href="' + photo.permalink + '" class="related-photo-info"><img src="' + photo.icon_eye + '" class="icon_eye" alt="Icon en forme d\'oeil"></a>';
            photoHTML += '<a href="#" class="open-lightbox related-photo-lightbox" data-image-url="' + photo.image + '"><img src="' + photo.icon_fullscreen + '" class="icon_fullscreen" alt="Icon plein écran"></a>';
            photoHTML += '</div></div>';
            $('.related-photos-grid').append(photoHTML);
        });
    }
});


// Champ de filtre par date
jQuery(document).ready(function($) {
    // Écouteur d'événement pour le changement de valeur dans le sélecteur de tri par année
    $('#sort-filter').change(function() {
        // Récupérer la valeur sélectionnée dans le sélecteur de tri par année
        var sort = $(this).val();
        
        // Effectuer une requête AJAX pour filtrer les photos par année
        $.ajax({
            url: ajax_object.ajaxurl,
            type: 'POST',
            data: {
                action: 'filter_photos_by_year',
                sort: sort,
            },
            success: function(response) {
                // Mettre à jour la grille de photos avec les nouvelles données filtrées
                updatePhotoGrid(response);
                
                // Trier les photos en fonction de l'option sélectionnée
                if (sort === 'newest') {
                    sortPhotosByYearDescending(); // Tri du plus récent au plus ancien
                } else {
                    sortPhotosByYear(); // Tri du plus ancien au plus récent (par défaut)
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    // Fonction pour mettre à jour la grille de photos avec les nouvelles données
    function updatePhotoGrid(photos) {
        // Supprimer toutes les photos actuellement affichées
        $('.related-photos-grid').empty();
        
        // Boucler à travers les données des nouvelles photos et les ajouter à la grille
        $.each(photos, function(index, photo) {
            // Vérifier si l'année de la photo est définie
            if (photo.year) {
                var photoHTML = '<div class="related-photo" data-year="' + photo.year + '">';
                photoHTML += '<a href="' + photo.permalink + '" class="related-photo-link">';
                photoHTML += '<img src="' + photo.image + '" class="related-photo-thumbnail" alt="' + photo.title + '">';
                photoHTML += '</a>';
                photoHTML += '<div class="related-photo-overlay">';
                photoHTML += '<a href="' + photo.permalink + '" class="related-photo-info"><img src="' + photo.icon_eye + '" class="icon_eye" alt="Icon en forme d\'oeil"></a>';
                photoHTML += '<a href="#" class="open-lightbox related-photo-lightbox" data-image-url="' + photo.image + '"><img src="' + photo.icon_fullscreen + '" class="icon_fullscreen" alt="Icon plein écran"></a>';
                photoHTML += '</div></div>';
                $('.related-photos-grid').append(photoHTML);
            }
        });
    }

    // Fonction pour trier les photos par année (du plus ancien au plus récent)
    function sortPhotosByYear() {
        // Récupérer toutes les photos dans la grille
        var $photos = $('.related-photo');
        
        // Trier les photos en fonction de l'année
        $photos.sort(function(a, b) {
            var yearA = $(a).data('year');
            var yearB = $(b).data('year');
            return yearA - yearB; // Tri croissant (du plus ancien au plus récent)
        });

        // Réorganiser les photos dans la grille
        $('.related-photos-grid').empty().append($photos);
    }
    
    // Fonction pour trier les photos par année (du plus récent au plus ancien)
    function sortPhotosByYearDescending() {
        // Récupérer toutes les photos dans la grille
        var $photos = $('.related-photo');
        
        // Trier les photos en fonction de l'année (du plus récent au plus ancien)
        $photos.sort(function(a, b) {
            var yearA = $(a).data('year');
            var yearB = $(b).data('year');
            return yearB - yearA; // Tri décroissant (du plus récent au plus ancien)
        });

        // Réorganiser les photos dans la grille
        $('.related-photos-grid').empty().append($photos);
    }
});


