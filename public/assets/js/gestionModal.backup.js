// ########################################################### //
// #####                      MODAL                      ##### //
// #####             DELETE CONFIRMATION PART            ##### //
// ########################################################### // 

// ############################# //
// ###     RENTAL SPACE      ### //
// ############################# //  
function deleteRentalSpace() {
   // Get data from TWIG view
   var rentalSpace= $(".dataRentalSpace").data("rental-space");
   var rentalSpaceCity= $(".dataRentalSpace").data("rental-space-city");
   var rentalSpaceQuantity= $(".dataRentalSpace").data("rental-space-quantity");
   var actionPath= $("#modalFooterForm").data("action-path");
   var csrfToken= $("#modalFooterForm").data("csrf-token");

   // Modal title
   $(".modal-title").html("Suppression d'un espace locatif");
   
   // Modal Main text
   $("#modalBodyText").html("<p class=\"redWarning\">Attention : cette action est irréversible !</p><p>Suppression de <b>" 
                        + rentalSpace + "</b> qui se trouve à <b>" 
                        + rentalSpaceCity + "</b>.<br><small>(quantité : " 
                        + rentalSpaceQuantity + ")</small></p><p>Confirmez-vous ?</p>"
   );

   // Modal footer
   $("#modalFooterForm").html("<form method=\"post\" action=\""
                        + actionPath + "\"><input type=\"hidden\" name=\"_token\" value=\""
                        + csrfToken + "\"><button class=\"btn btn-success\">Confirmer</button></form>"
   );
}

// ############################# //
// ###   RENTAL SPACE TYPE   ### //
// ############################# //  
function deleteRentalSpaceType() {
   // Get data from TWIG view
   var rentalSpaceType= $(".dataRentalSpaceType").data("rental-space-type");
   var actionPath= $("#modalFooterForm").data("action-path");
   var csrfToken= $("#modalFooterForm").data("csrf-token");

   // Modal title
   $(".modal-title").html("Suppression d'un type d'espace locatif");
   
   // Modal Main text
   $("#modalBodyText").html("<p class=\"redWarning\">Attention : cette action est irréversible !</p><p>Suppression de <b>" 
                        + rentalSpaceType + "</b>.</p><p>Confirmez-vous ?</p>"
   );

   // Modal footer
   $("#modalFooterForm").html("<form method=\"post\" action=\"" + actionPath
                        + "\"><input type=\"hidden\" name=\"_token\" value=\""
                        + csrfToken + "\"><button class=\"btn btn-success\">Confirmer</button></form>"
   );
}

// ############################# //
// ###         CITY          ### //
// ############################# //
function deleteCity() {
   // Get data from TWIG view
   var city= $(".dataCity").data("city");
   var cityPostalCode= $(".dataCity").data("city-postal-code");
   var actionPath= $("#modalFooterForm").data("action-path");
   var csrfToken= $("#modalFooterForm").data("csrf-token");

   // Modal title
   $(".modal-title").html("Suppression d'une ville");

   // Modal Main text
   $("#modalBodyText").html("<p class=\"redWarning\">Attention : cette action est irréversible !</p><p>Suppression de <b>" 
                        + city + "</b> (code postal <b>" 
                        + cityPostalCode + ")</b>.<br></p><p>Confirmez-vous ?</p>"
   );

   // Modal footer
   $("#modalFooterForm").html("<form method=\"post\" action=\""
                        + actionPath + "\"><input type=\"hidden\" name=\"_token\" value=\""
                        + csrfToken + "\"><button class=\"btn btn-success\">Confirmer</button></form>"
   );
}


// ########################################################### //
// #####                      MODAL                      ##### //
// #####                  ADD FORM PART                  ##### //
// ########################################################### // 

// ############################# //
// ###   RENTAL SPACE TYPE   ### //
// ############################# //
function addRentalSpaceType() {
   // Get data from TWIG view
   var csrfTokenRentalSpaceType= $("#modalFooterForm").data("csrf-token-rental-space-type");

   // Modal title
   $(".modal-header").css({"background-color": "green"});
   $(".modal-title").css({"color": "white"});
   $(".modal-title").html("Ajout d'un type d'espace locatif");
   
   // Modal Main text
   $("#modalBodyText").html("<form name=\"rental_space_type_form\" method=\"post\" action=\"/admin/gestion/types/ajouter\" novalidate=\"novalidate\"><div id=\"rental_space_type_form\"><div class=\"form-group\"><label for=\"rental_space_type_form_designation\" class=\"mb-2 required\">Type d'espace locatif :<span id=\"validateMessageDesignation\" class=\"invalid-feedback d-block\"></span></label><input type=\"text\" id=\"rental_space_type_form_designation\" name=\"rental_space_type_form[designation]\" required=\"required\" placeholder=\"Renseigner ici le type d'espace locatif\" class=\"form-control\"></div><input type=\"hidden\" id=\"rental_space_type_form__token\" name=\"rental_space_type_form[_token]\" value=\"" + csrfTokenRentalSpaceType + "\"></div><button id=\"formButton\" class=\"d-none\">Enregister</button></form>");

   // Modal footer
   $("#modalFooterForm").html("<button onclick=\"validateData()\" id=\"validationButton\" class=\"btn btn-success\">Enregister</button>");

//    // Use the modal footer 'validate' button to trigger the hidden 'form' button
//    $('#validationButton').click(function(){
//       $("#formButton").click();
//    })
}

// ############################# //
// ###         CITY          ### //
// ############################# //
function addCity() {
   // Get data from TWIG view
   var csrfTokenCity= $("#modalFooterForm").data("csrf-token-city");

   // Modal title
   $(".modal-header").css({"background-color": "green"});
   $(".modal-title").css({"color": "white"});
   $(".modal-title").html("Ajout d'une ville");
   
   // Modal Main text
   $("#modalBodyText").html("<form id=\"cityForm\" name=\"city_form\" method=\"post\" action=\"/admin/gestion/villes/ajouter\"><div id=\"city_form\"><div class=\"form-group\"><label for=\"city_form_name\" class=\"required\">Ville :<span id=\"validateMessageName\" class=\"invalid-feedback d-block\"></span></label><input type=\"text\" id=\"city_form_name\" name=\"city_form[name]\" NOrequired=\"required\" placeholder=\"Moulinsart\" class=\"form-control\"></div><div class=\"form-group mt-3\"><label for=\"city_form_postalCode\" class=\"required\">Code postal :<span id=\"validateMessagePostalCode\" class=\"invalid-feedback d-block\"></span></label><input type=\"text\" id=\"city_form_postalCode\" name=\"city_form[postalCode]\" NOrequired=\"required\" placeholder=\"12345\" class=\"form-control\"></div><input type=\"hidden\" id=\"city_form__token\" name=\"city_form[_token]\" value=\"" + csrfTokenCity + "\"></div><button id=\"formButton\" class=\"d-none\">Enregister</button></form>");

   // Modal footer
   $("#modalFooterForm").html("<button onclick=\"validateData()\" id=\"validationButton\" class=\"btn btn-success\">Enregister</button>");

   // Use the modal footer 'validate' button to trigger the hidden 'form' button
   // $('#validationButton').click(function(){
   //    $("#formButton").click();
   // })
}


// ########################################################### //
// #####                      MODAL                      ##### //
// #####               VALIDATION FORM PART              ##### //
// ########################################################### // 

// This is to prevent the submitting of the form when hitting the 'enter' key on the keyboard
// (to 'force' the verification with yhe 'validateData' function)
$(document).on("keydown", "form", function(event) { 
   return event.key != "Enter";
});

function validateData() {
   
   // ############################# //
   // ###   RENTAL SPACE TYPE   ### //
   // ############################# //
   var regExDesignation= /^[^@&"()<>!_$*€£`+=\/\\;:?#]+$/;
   var dataDesignation= $("#rental_space_type_form_designation").val();

   var dataDesignationOK= false;

  
   // Check for rental space type designation
   if (!dataDesignation) {
      $("#validateMessageDesignation").html("<span class=\"d-block\"><span class=\"me-1 form-error-icon badge badge-danger-modal text-uppercase\">Erreur</span><span class=\"form-error-message\">Veuillez saisir un type d'espace locatif</span></span>");
      // console.log('designation : EMPTY');
   } else {
      if (dataDesignation.match(regExDesignation)) {
         $("#validateMessageDesignation").html("");
         // console.log('designation : OK');
         dataDesignationOK= true;
      } else {
         $("#validateMessageDesignation").html("<span class=\"d-block\"><span class=\"me-1 form-error-icon badge badge-danger-modal text-uppercase\">Erreur</span><span class=\"form-error-message\">Les caractères spéciaux ne sont pas autorisés</span></span>");
         // console.log('designation : WRONG');
      }
   }

   // console.log('dataDesignationOK', dataDesignationOK);

   // Validate if designation is correct
   if (dataDesignationOK) {
      console.log("GOGOGO !!");
      // $("#formButton").click();
   }

   // ############################# //
   // ###         CITY          ### //
   // ############################# //
   var regExPostalCode= /^(?:[0-8]\d|9[0-8])\d{3}$/;
   var regExName= /^[^0-9@&"()<>!_$*€£`+=\/;:?#]+$/;
   var dataName= $("#city_form_name").val();
   var dataPostalCode= $("#city_form_postalCode").val();

   var dataNameOK= false;
   var dataPostalCodeOK= false;

   // Check for city name
   if (!dataName) {
      $("#validateMessageName").html("<span class=\"d-block\"><span class=\"me-1 form-error-icon badge badge-danger-modal text-uppercase\">Erreur</span><span class=\"form-error-message\">Veuillez saisir une ville</span></span>");
      // console.log('name : EMPTY');
   } else {
      if (dataName.match(regExName)) {
         $("#validateMessageName").html("");
         // console.log('name : OK');
         dataNameOK= true;
      } else {
         $("#validateMessageName").html("<span class=\"d-block\"><span class=\"me-1 form-error-icon badge badge-danger-modal text-uppercase\">Erreur</span><span class=\"form-error-message\">Seules les lettres sont autorisées</span></span>");
         // console.log('name : WRONG');
      }
   }

   // Check for city postal code
   if (!dataPostalCode) {
      $("#validateMessagePostalCode").html("<span class=\"d-block\"><span class=\"me-1 form-error-icon badge badge-danger-modal text-uppercase\">Erreur</span><span class=\"form-error-message\">Veuillez saisir un code postal</span></span>");
      // console.log('code : EMPTY');
   } else {
      if (dataPostalCode.match(regExPostalCode)) {
         $("#validateMessagePostalCode").html("");
         // console.log('code : OK');
         dataPostalCodeOK= true;
      } else {
         $("#validateMessagePostalCode").html("<span class=\"d-block\"><span class=\"me-1 form-error-icon badge badge-danger-modal text-uppercase\">Erreur</span><span class=\"form-error-message\">Ce code postal n'est pas valide</span></span>");
         // console.log('code : WRONG');
      }
   }
   
   // console.log('dataNameOK', dataNameOK);
   // console.log('dataPostalCodeOK', dataPostalCodeOK);

   // Validate if both data are correct
   if (dataNameOK && dataPostalCodeOK) {
      // console.log("GOGOGO !!");
      
      // Use the modal footer 'validate' button to trigger the hidden 'form' button
      $("#formButton").click();
   }
}
