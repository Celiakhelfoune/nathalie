// voir plus
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
//les filtres 
jQuery(document).ready(function($) {
    // Fonction pour récupérer les termes de taxonomie
    function getTaxonomyTerms(taxonomy) {
      $.ajax({
        url: custom_scripts_vars.ajaxurl,
        type: 'POST',
        data: {
          action: 'get_taxonomy_terms',
          taxonomy: taxonomy
        },
        success: function(response) {
          // Remplir le select avec les termes récupérés
          var select = $('select[name="' + taxonomy + '"]');
          select.empty();
          select.append('<option value="">Tous</option>');
          $.each(response, function(index, term) {
            select.append('<option value="' + term.slug + '">' + term.name + '</option>');
          });
        }
      });
    }
  
    
  
    // Écouter les changements dans les selects de catégories et de formats
    $('select[name="categorie"]').change(function() {
      var taxonomy = $(this).val();
      getTaxonomyTerms(taxonomy);
    });
  
    
  });
  function getCustomFieldValues(customField) {
    $.ajax({
      url: custom_scripts_vars.ajaxurl,
      type: 'POST',
      data: {
        action: 'get_custom_field_values',
        customField: customField
      },
      success: function(response) {
        // Faire quelque chose avec les valeurs des champs personnalisés récupérées
      }
    });
  }
  
  $('select[name="format"]').change(function () {
    var customField = $(this).val();
    getCustomFieldValues(customField);
  });

  $('select[name="tri"]').change(function() {
    var customField = $(this).val();
    getCustomFieldValues(customField);
  });
  
  jQuery(document).ready(function($) {
    // Fonction pour charger les images en fonction des filtres sélectionnés
    function loadPhotos() {
      var categorie = $('select[name="categorie"]').val();
      var format = $('select[name="format"]').val();
      var tri = $('select[name="tri"]').val();
      var page = 1; 
  
      $.ajax({
        url: custom_scripts_vars.ajaxurl,
        type: 'POST',
        data: {
        action: 'load_more_photos',
        categorie: categorie,
        format: format,
        tri: tri,
        page: page
        },
        success: function(response) {
          // Remplacer le contenu de la section des photos avec les images chargées
          $('#photo-section').html(response);
        }
      });
    }
  
    // Écouter les changements dans les selects de catégories, formats et tri
    $('select[name="categorie"], select[name="format"], select[name="tri"]').change(function() {
      loadPhotos();
    });
  
   
  });
