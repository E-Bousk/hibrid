// ########################################################### //
// #####                      MODAL                      ##### //
// #####             DELETE CONFIRMATION PART            ##### //
// ########################################################### // 

// ################################## //
// ###    DELETE RENTAL SPACE     ### //
// ################################## //  
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

// ################################## //
// ###  DELETE RENTAL SPACE TYPE  ### //
// ################################## //  
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

// ################################## //
// ###        DELETE CITY         ### //
// ################################## //
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

// ################################# //
// ###   ADD RENTAL SPACE TYPE   ### //
// ################################# //
function addRentalSpaceType() {
   // Get data from TWIG view
   var csrfTokenRentalSpaceType= $("#modalFooterForm").data("csrf-token-rental-space-type");

   // Modal title
   $(".modal-header").css({"background-color": "green"});
   $(".modal-title").css({"color": "white"});
   $(".modal-title").html("Ajout d'un type d'espace locatif");
   
   // Modal Main text
   $("#modalBodyText").html("<form id=\"addRentalSpaceTypeForm\" name=\"rental_space_type_form\" method=\"post\" action=\"/admin/gestion/types/ajouter\" novalidate=\"novalidate\"><div id=\"rental_space_type_form\"><div class=\"form-group\"><label for=\"rental_space_type_form_designation\" class=\"mb-2 required\">Type d'espace locatif :<span id=\"validateMessageDesignation\" class=\"invalid-feedback d-block\"></span></label><input type=\"text\" id=\"rental_space_type_form_designation\" name=\"rental_space_type_form[designation]\" required=\"required\" placeholder=\"Renseigner ici le type d'espace locatif\" class=\"form-control\"></div><input type=\"hidden\" id=\"rental_space_type_form__token\" name=\"rental_space_type_form[_token]\" value=\"" + csrfTokenRentalSpaceType + "\"></div><input id=\"submitRentalSpaceTypeForm\" type=\"submit\" class=\"d-none\"></form>");

   // Modal footer
   $("#modalFooterForm").html("<button id=\"validationRentalSpaceTypeButton\" class=\"btn btn-success\">Enregister</button>");
   
   // Use the modal footer 'validate' button to trigger the hidden 'form' input
   $('#validationRentalSpaceTypeButton').click(function() {
      $("#submitRentalSpaceTypeForm").click();
   });
   
   // #################################
   // ###    VALIDATION CONTROL     ###
   // #################################
   $("#addRentalSpaceTypeForm").on("submit", function(e) {
      var error;
      var dataDesignation= $("#rental_space_type_form_designation").val();
      var regExDesignation= /^[^@&"()<>!_$*€£`+=\/\\;:?#]+$/;
      var minSizeDesignation= 3;
      var maxSizeDesignation= 255;

      if (!dataDesignation) {
         error= "<span class=\"d-block\"><span class=\"me-1 form-error-icon badge badge-danger-modal text-uppercase\">Erreur</span><span class=\"form-error-message\">Veuillez saisir un type d'espace locatif</span></span>";
      } else if (!dataDesignation.match(regExDesignation)) {
         error= "<span class=\"d-block\"><span class=\"me-1 form-error-icon badge badge-danger-modal text-uppercase\">Erreur</span><span class=\"form-error-message\">Les caractères spéciaux ne sont pas autorisés</span></span>";
      } else if (dataDesignation.length < minSizeDesignation) {
         error= "<span class=\"d-block\"><span class=\"me-1 form-error-icon badge badge-danger-modal text-uppercase\">Erreur</span><span class=\"form-error-message\">Ce champ ne peut contenir moins de 3 caractères</span></span>";
      } else if (dataDesignation.length > maxSizeDesignation) {
         error= "<span class=\"d-block\"><span class=\"me-1 form-error-icon badge badge-danger-modal text-uppercase\">Erreur</span><span class=\"form-error-message\">Ce champ ne peut contenir plus de 255 caractères</span></span>";
      } else {
         $("#validateMessageDesignation").html("");
      }

      if (error) {
         $("#validateMessageDesignation").html(error);
         e.preventDefault();
         return false;
      }
   });
}



// ################################# //
// ###         ADD CITY          ### //
// ################################# //
function addCity() {
   // Get data from TWIG view
   var csrfTokenCity= $("#modalFooterForm").data("csrf-token-city");

   // Modal title
   $(".modal-header").css({"background-color": "green"});
   $(".modal-title").css({"color": "white"});
   $(".modal-title").html("Ajout d'une ville");
   
   // Modal Main text
   $("#modalBodyText").html("<form id=\"addCityForm\" name=\"city_form\" method=\"post\" action=\"/admin/gestion/villes/ajouter\" novalidate=\"novalidate\"><div id=\"city_form\"><div class=\"form-group\"><label for=\"city_form_name\" class=\"required\">Ville :<span id=\"validateMessageName\" class=\"invalid-feedback d-block\"></span></label><input type=\"text\" id=\"city_form_name\" name=\"city_form[name]\" required=\"required\" placeholder=\"Moulinsart\" class=\"form-control\"></div><div class=\"form-group mt-3\"><label for=\"city_form_postalCode\" class=\"required\">Code postal :<span id=\"validateMessagePostalCode\" class=\"invalid-feedback d-block\"></span></label><input type=\"text\" id=\"city_form_postalCode\" name=\"city_form[postalCode]\" required=\"required\" placeholder=\"12345\" class=\"form-control\"></div><input type=\"hidden\" id=\"city_form__token\" name=\"city_form[_token]\" value=\"" + csrfTokenCity + "\"></div><input id=\"submitCityForm\" type=\"submit\" class=\"d-none\"></form>");

   // Modal footer
   $("#modalFooterForm").html("<button id=\"validationCityButton\" class=\"btn btn-success\">Enregister</button>");

   // Use the modal footer 'validate' button to trigger the hidden 'form' button
   $('#validationCityButton').click(function(){
      $("#submitCityForm").click();
   })

   // #################################
   // ###    VALIDATION CONTROL     ###
   // #################################
   $("#addCityForm").on("submit", function(e) {
      var errorName;
      var errorPostalCode;
      var dataName= $("#city_form_name").val();
      var dataPostalCode= $("#city_form_postalCode").val();
      var regExName= /^[^0-9@&"()<>!_$*€£`+=\/;:?#]+$/;
      var regExPostalCode= /^(?:[0-8]\d|9[0-8])\d{3}$/;
      var maxSizeDesignation= 255;

      if (!dataName) {
         errorName= "<span class=\"d-block\"><span class=\"me-1 form-error-icon badge badge-danger-modal text-uppercase\">Erreur</span><span class=\"form-error-message\">Veuillez saisir une ville</span></span>";
      } else if (!dataName.match(regExName)) {
         errorName= "<span class=\"d-block\"><span class=\"me-1 form-error-icon badge badge-danger-modal text-uppercase\">Erreur</span><span class=\"form-error-message\">Ce nom n'est pas valide</span></span>";
      } else if (dataName.length > maxSizeDesignation) {
         errorName= "<span class=\"d-block\"><span class=\"me-1 form-error-icon badge badge-danger-modal text-uppercase\">Erreur</span><span class=\"form-error-message\">Ce champ ne peut contenir plus de 255 caractères</span></span>";
      } else {
         $("#validateMessageName").html("");
      }

      if (!dataPostalCode) {
         errorPostalCode= "<span class=\"d-block\"><span class=\"me-1 form-error-icon badge badge-danger-modal text-uppercase\">Erreur</span><span class=\"form-error-message\">Veuillez saisir un code postal</span></span>";
      } else if (!dataPostalCode.match(regExPostalCode)) {
         errorPostalCode= "<span class=\"d-block\"><span class=\"me-1 form-error-icon badge badge-danger-modal text-uppercase\">Erreur</span><span class=\"form-error-message\">Ce code postal n'est pas valide</span></span>";
      } else {
         $("#validateMessagePostalCode").html("");
      }
      
      if (errorName || errorPostalCode) {
         $("#validateMessageName").html(errorName);
         $("#validateMessagePostalCode").html(errorPostalCode);
         e.preventDefault();
         return false;
      }
   });
}
// ########################################################### //
// #####                  END OF MODAL                   ##### //
// ########################################################### // 

// ########################################################### //
// #####                RENTAL SPACE PAGE                ##### //
// #####              last entry on SELECT               ##### //
// ########################################################### // 

$(document).ready(function () {
   
   var idCityToSelect= $("#idCityToSelect").data("id-city-to-select");
   var idTypeToSelect= $("#idTypeToSelect").data("id-type-to-select");

   console.log('City ID : ' + idCityToSelect)
   console.log('Type ID : ' + idTypeToSelect);

   if (idCityToSelect) {

      console.log("dans le if " + idCityToSelect);

      $('#rental_space_form_city option[value=' + idCityToSelect + ']').prop('selected', true);
   
   }
   
   if (idTypeToSelect) {

      console.log("dans le if " + idTypeToSelect);

      $('#rental_space_form_rentalSpaceType option[value=' + idTypeToSelect + ']').prop('selected', true);
   
   } 
});
