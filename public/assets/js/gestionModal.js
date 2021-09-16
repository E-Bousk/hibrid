// ################################################################## //
// #####              MODAL -- DELETE CONFIRMATION              ##### //
// #####                      RENTAL SPACE                      ##### //
// ################################################################## //  
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

// ################################################################## //
// #####              MODAL -- DELETE CONFIRMATION              ##### //
// #####                   RENTAL SPACE TYPE                    ##### //
// ################################################################## //  
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

// ################################################################## //
// #####              MODAL -- DELETE CONFIRMATION              ##### //
// #####                          CITY                          ##### //
// ################################################################## //
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

// ################################################################## //
// #####                   MODAL -- ADD FORM                    ##### //
// #####                   RENTAL SPACE TYPE                    ##### //
// ################################################################## //
function addRentalSpaceType() {
   // Get data from TWIG view
   var csrfTokenRentalSpaceType= $("#modalFooterForm").data("csrf-token-rental-space-type");

   // Modal title
   $(".modal-header").css({"background-color": "green"});
   $(".modal-title").css({"color": "white"});
   $(".modal-title").html("Ajout d'un type d'espace locatif");
   
   // Modal Main text
   $("#modalBodyText").html("<form name=\"rental_space_type_form\" method=\"post\" action=\"/admin/gestion/types/ajouter\" novalidate=\"novalidate\"><div id=\"rental_space_type_form\"><div class=\"form-group\"><label for=\"rental_space_type_form_designation\" class=\"mb-3 required\">Type d'espace locatif :</label><input type=\"text\" id=\"rental_space_type_form_designation\" name=\"rental_space_type_form[designation]\" required=\"required\" placeholder=\"Renseigner ici le type d'espace locatif\" class=\"form-control\"></div><input type=\"hidden\" id=\"rental_space_type_form__token\" name=\"rental_space_type_form[_token]\" value=\"" + csrfTokenRentalSpaceType + "\"></div><button id=\"formButton\" class=\"d-none\">Enregister</button></form>");

   // Modal footer
   $("#modalFooterForm").html("<button id=\"validationButton\" class=\"btn btn-success\">Enregister</button>");

   // Use the modal footer 'validate' button to trigger the hidden 'form' button
   $('#validationButton').click(function(){
      $("#formButton").click();
   })
}

// ################################################################## //
// #####                   MODAL -- ADD FORM                    ##### //
// #####                         CITY                           ##### //
// ################################################################## //
function addCity() {
   // Get data from TWIG view
   var csrfTokenCity= $("#modalFooterForm").data("csrf-token-city");

   // Modal title
   $(".modal-header").css({"background-color": "green"});
   $(".modal-title").css({"color": "white"});
   $(".modal-title").html("Ajout d'une ville");
   
   // Modal Main text
   $("#modalBodyText").html("<form id=\"cityForm\" name=\"city_form\" method=\"post\" action=\"/admin/gestion/villes/ajouter\"><div id=\"city_form\"><div class=\"form-group\"><label for=\"city_form_name\" class=\"required\">Ville :<span id=\"validateMessageName\" class=\"d-block\"></span></label><input type=\"text\" id=\"city_form_name\" name=\"city_form[name]\" NOrequired=\"NOrequired\" placeholder=\"Moulinsart\" class=\"form-control\"></div><div class=\"form-group\"><label for=\"city_form_postalCode\">Code postal :<span id=\"validateMessagePostalCode\" class=\"d-block\"></span></label><input type=\"text\" id=\"city_form_postalCode\" name=\"city_form[postalCode]\" NOrequired=\"NOrequired\" placeholder=\"12345\" class=\"form-control\"></div><input type=\"hidden\" id=\"city_form__token\" name=\"city_form[_token]\" value=\"" + csrfTokenCity + "\"></div><button id=\"formButton\" class=\"d-none\">Enregister</button></form>");

   // Modal footer
   $("#modalFooterForm").html("<button onclick=\"validateData()\" id=\"validationButton\" class=\"btn btn-success\">Enregister</button>");

   // Use the modal footer 'validate' button to trigger the hidden 'form' button
   // $('#validationButton').click(function(){
   //    $("#formButton").click();
   // })
}

// ################################################################## //
// #####                MODAL -- VALIDATION FORM                ##### //
// #####                         CITY                           ##### //
// ################################################################## //

function validateData(){
   var regExPostalCode= /^(?:[0-8]\d|9[0-8])\d{3}$/;
   var regExName= /^[^0-9]+$/;
   var dataName= $("#city_form_name").val();
   var dataPostalCode= $("#city_form_postalCode").val();

   var dataNameOK= false;
   var dataPostalCodeOK= false;

   if (!dataName) {
      $("#validateMessageName").html("<span class=\"d-block\"><span class=\"form-error-icon badge badge-danger text-uppercase\">Erreur</span><span class=\"form-error-message\">Veuillez saisir une ville</span></span>");
      console.error('EMPTY name');
   } else {
      if (dataName.match(regExName)) {
         $("#validateMessageName").html("");
         console.error('OK name');
         dataNameOK= true;
      } else {
         $("#validateMessageName").html("Seules les lettres sont autorisées");
         console.error('WRONG name');
      }
   }
   
   if (!dataPostalCode) {
      $("#validateMessagePostalCode").html("<span class=\"d-block\"><span class=\"form-error-icon badge badge-danger text-uppercase\">Erreur</span><span class=\"form-error-message\">Veuillez saisir un code postal</span></span>");
      console.error('EMPTY code');
   } else {
      if (dataPostalCode.match(regExPostalCode)) {
         console.log('OK code');
         dataPostalCodeOK= true;
      } else {
         $("#validateMessagePostalCode").html("Ce code postal n'est pas valide");
         console.log('WRONG code');
      }
   }
   
   if (dataNameOK === true && dataPostalCodeOK === true) {
      console.log("GOGO !!");
      $("#formButton").click();
   }
   
   // $("#city_form_postalCode").val("blblblbl");

}































// ////////////////////////////////////////////////////////////////////////

// $('#cityForm').validate({ // initialize the plugin
//    rules: {
//       "city_form[postalCode]": {
//          required: true,
//          minlength: 5,
//          maxlength: 5,
//          // regex: /^(\+33\.|0)[0-9]{9}$/
//       },
//       "city_form[name]": {
//             required: true,
//             minlength: 5
//         },
//    },
//    // submitHandler: function (form) { // for demo
//    //     alert('valid form submitted'); // for demo
//    //     return false; // for demo
//    // }
// });



// jQuery.extend(jQuery.validator.messages, {
//    required: "Ce champs ne peut pas être vide",
//    number: "votre message",
//    digits: "votre message",
//    accept: "votre message",
//    maxlength: jQuery.validator.format("Le code postal doit faire {0} caractéres max."),
//    minlength: jQuery.validator.format("Le code postal doit faire {0} caractéres min."),
//    rangelength: jQuery.validator.format("votre message  entre {0} et {1} caractéres."),
//    range: jQuery.validator.format("votre message  entre {0} et {1}."),
//    max: jQuery.validator.format("votre message  inférieur ou égal à {0}."),
//    min: jQuery.validator.format("votre message  supérieur ou égal à {0}.")
//  });