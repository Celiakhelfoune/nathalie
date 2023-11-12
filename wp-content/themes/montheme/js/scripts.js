//menu burger
jQuery(document).ready(function ($) {
  $(".burger-menu").click(function () {
    $(this).find(".fa-bars").toggleClass("hide");
    $(this).find(".fa-xmark").toggleClass("active");
    $(".menu").slideToggle();
  });

  //Affichage automatique des reférences photo
  // Lorsque le bouton "Contact" est cliqué
  $(".contact-button").click(function () {
    // Récupérer la valeur de la référence de la photo
    var refPhoto = $(".content-container p:contains('REFERENCE')")
      .text() // récupérer tout le text contenu dans cet element HTML
      .trim() // supprimer les éspaces vides au debut et a la fin du texte récupéré
      .split(":")[1] // récupérer la deuxiemme partie qui correspond à la valeur de la référence
      .trim(); // supprimer les espaces vides avant et apres la valeur de la référence
    // Pré-remplir le champ Réf dans le formulaire de contact
    $("[name='your-subject']").val(refPhoto);
  });

  //La modale lightbox
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


// zoom des miniatures 
jQuery(document).ready(function ($) {
// Ajouter un événement "mouseover" à chaque image avec la classe "zoom-image"
var images = document.getElementsByClassName("zoom-image");
  
for (var i = 0; i < images.length; i++) {
  images[i].addEventListener("mouseover", function() {
    // Modifier le style de l'image pour l'agrandir
    this.style.transform = "scale(1.2)";
  });
  
  images[i].addEventListener("mouseout", function() {
    // Réinitialiser le style de l'image
    this.style.transform = "scale(1)";
  });
}
});

jQuery(document).ready(function($) {
  // Récupérer la hauteur de la fenêtre
  var windowHeight = $(window).height();

  // Ajouter un événement de défilement à la fenêtre
  $(window).scroll(function() {
    // Récupérer la position de défilement
    var scrollPosition = $(window).scrollTop();

    // Vérifier si la position de défilement dépasse la hauteur de la fenêtre
    if (scrollPosition > windowHeight) {
      // Modifier la position du formulaire
      $('.formulaire').css('margin-top', '0');
    } else {
      // Réinitialiser la position du formulaire
      $('.formulaire').css('margin-top', '200px');
    }
  });
});