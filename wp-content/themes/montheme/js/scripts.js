//menu burger
jQuery(document).ready(function ($) {
  $(".burger-menu").click(function () {
    $(this).toggleClass("active");
    $(".monmenu ul").toggleClass("left-align");
    $(".monmenu ul").slideToggle();
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







  
  // modal
  $(".fullscreen-btn").click(function () {
    
    openModal();
    
  });
 $(".close").click(function () {
  closeModal();
});
  function openModal() {
    document.getElementById("myModal").style.display = "block";
    
  }

  function closeModal() {
    document.getElementById("myModal").style.display = "none";
  }


});


