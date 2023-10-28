jQuery(document).ready(function ($) {
  var currentIndex = 0;
  var images = [];
  var references = [];
  var categories = [];

  function openModal(imageSrc, reference, categorie) {
    var modal = document.getElementById("myModal");
    var modalContent = modal.querySelector(".modal-content");

    var imageContainer = document.createElement("div");
    imageContainer.classList.add("image-container3");

    var image = document.createElement("img");
    image.src = imageSrc;
    imageContainer.appendChild(image);

    var referenceElement = document.createElement("p");
    referenceElement.textContent = reference;
    referenceElement.classList.add("reference-class", "same-class");
    imageContainer.appendChild(referenceElement);

    var categorieElement = document.createElement("p");
    categorieElement.textContent = categorie;
    categorieElement.classList.add("categorie-class", "same-class");
    imageContainer.appendChild(categorieElement);

    var prevLink = document.createElement("a");
    prevLink.classList.add("prev");
    prevLink.innerHTML = '<i class="fa-solid fa-arrow-left"></i> Précédente';
    imageContainer.appendChild(prevLink);

    var nextLink = document.createElement("a");
    nextLink.classList.add("next");
    nextLink.innerHTML = 'Suivante <i class="fa-solid fa-arrow-right"></i>';
    imageContainer.appendChild(nextLink);

    prevLink.addEventListener("click", function () {
      currentIndex = currentIndex === 0 ? images.length - 1 : currentIndex - 1;
      openModal(images[currentIndex], references[currentIndex], categories[currentIndex]);
    });

    nextLink.addEventListener("click", function () {
      currentIndex = currentIndex === images.length - 1 ? 0 : currentIndex + 1;
      openModal(images[currentIndex], references[currentIndex], categories[currentIndex]);
    });

    modalContent.innerHTML = "";
    modalContent.appendChild(imageContainer);
    modal.style.display = "block";
  }

  function loadPhotos() {
    var categorie = $('select[name="categorie"]').val();
    var format = $('select[name="format"]').val();
    var tri = $('select[name="tri"]').val();
    var page = 1;

    $.ajax({
      url: custom_scripts_vars.ajaxurl,
      type: "POST",
      data: {
        action: "load_more_photos",
        categorie: categorie,
        format: format,
        tri: tri,
        page: page,
      },
      success: function (response) {
        $("#photo-section").html(response);
        images = [];
        references = [];
        categories = [];
        $(".fullscreen-btn").click(function () {
          var imageContainer = $(this).closest(".image-link");
          var imageSrc = imageContainer.find("img").attr("src");
          var reference = imageContainer.data("reference");
          var categorie = imageContainer.data("categorie");
          currentIndex = images.indexOf(imageSrc);
          openModal(imageSrc, reference, categorie);
        });

        $(".image-link").each(function () {
          images.push($(this).find("img").attr("src"));
          references.push($(this).data("reference"));
          categories.push($(this).data("categorie"));
        });
      },
    });
  }

  function getTaxonomyTerms(taxonomy) {
    $.ajax({
      url: custom_scripts_vars.ajaxurl,
      type: "POST",
      data: {
        action: "get_taxonomy_terms",
        taxonomy: taxonomy,
      },
      success: function (response) {
        var select = $('select[name="' + taxonomy + '"]');
        select.empty();
        select.append('<option value="">Tous</option>');
        $.each(response, function (index, term) {
          select.append('<option value="' + term.slug + '">' + term.name + "</option>");
        });
      },
    });
  }

  function getCustomFieldValues(customField) {
    $.ajax({
      url: custom_scripts_vars.ajaxurl,
      type: "POST",
      data: {
        action: "get_custom_field_values",
        customField: customField,
      },
      success: function (response) {
        // Faire quelque chose avec les valeurs des champs personnalisés récupérées
      },
    });
  }

  $('select[name="categorie"], select[name="format"], select[name="tri"]').change(function () {
    loadPhotos();
    currentIndex = 0;
    $(".fullscreen-btn").click(function () {
      var imageContainer = $(this).closest(".image-link");
      var imageSrc = imageContainer.find("img").attr("src");
      var reference = imageContainer.data("reference");
      var categorie = imageContainer.data("categorie");
      currentIndex = images.indexOf(imageSrc);
      openModal(imageSrc, reference, categorie);
    });
    images = [];
    references = [];
    categories = [];
    $(".image-link").each(function () {
      images.push($(this).find("img").attr("src"));
      references.push($(this).data("reference"));
      categories.push($(this).data("categorie"));
    });
  });

  $(".voirPlusbtn").on("click", function (e) {
    e.preventDefault();
    var page = parseInt($(".voirPlusbtn").data("page")) + 1;

    $.ajax({
      url: custom_scripts_vars.ajaxurl,
      type: "post",
      data: {
        action: "load_more_photos",
        page: page,
      },
      success: function (response) {
        if (response) {
          $("#photo-section").append(response);
          $(".voirPlusbtn").data("page", page);
          currentIndex = 0;
          $(".fullscreen-btn").click(function () {
            var imageContainer = $(this).closest(".image-link");
            var imageSrc = imageContainer.find("img").attr("src");
            var reference = imageContainer.data("reference");
            var categorie = imageContainer.data("categorie");
            currentIndex = images.indexOf(imageSrc);
            openModal(imageSrc, reference, categorie);
          });
        } else {
          $(".voirPlusbtn").hide();
        }

        $(".image-link").each(function () {
          images.push($(this).find("img").attr("src"));
          references.push($(this).data("reference"));
          categories.push($(this).data("categorie"));
        });
      },
    });
  });

  $(".close").click(function () {
    closeModal();
  });

  function closeModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
  }

});
