jQuery(document).ready(function($) {
    $('.voirPlusbtn').on('click', function(e) {
        e.preventDefault();
        var page = parseInt($('.voirPlusbtn').data('page')) + 1; // Récupère la page suivante à charger
        var ajaxurl = custom_scripts_vars.ajaxurl; // URL de l'API AJAX de WordPress

        $.ajax({
            url: ajaxurl,
            type: 'post',
            data: {
                action: 'load_more_photos',
                page: page
            },
            success: function(response) {
                if (response) {
                    $('#photo-section').append(response); // Ajoute les nouvelles images à la section existante
                    $('.voirPlusbtn').data('page', page); // Met à jour le numéro de page pour la prochaine requête
                } else {
                    $('.voirPlusbtn').hide(); // Cache le bouton s'il n'y a plus d'images à charger
                }
            }
        });
    });
});