//menu burger
jQuery(document).ready(function ($) {
  $(".burger-menu").click(function () {
    $(".menu").slideToggle();
  });

  //affichage automatique des reférences photo
  // Lorsque le bouton "Contact" est cliqué
  $(".contact-button").click(function () {
    // Récupérer la valeur de la référence de la photo
    var refPhoto = $(".content-container p:contains('REFERENCE')")
      .text()
      .trim()
      .split(":")[1]
      .trim();
    // Pré-remplir le champ Réf photo dans le formulaire de contact
    $("[name='your-subject']").val(refPhoto);
  });

  //la modale lightbox
  var currentIndex = 0;
  var images = [];
  var references = [];
  var categories = [];

  $(".fullscreen-btn").click(function () {
    openModal();

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
      openModal(
        images[currentIndex],
        references[currentIndex],
        categories[currentIndex]
      );
    });

    nextLink.addEventListener("click", function () {
      currentIndex = currentIndex === images.length - 1 ? 0 : currentIndex + 1;
      openModal(
        images[currentIndex],
        references[currentIndex],
        categories[currentIndex]
      );
    });

    modalContent.innerHTML = "";
    modalContent.appendChild(imageContainer);
    modal.style.display = "block";
  }

  $(".close").click(function () {
    closeModal();
  });

  function closeModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
  }
});
