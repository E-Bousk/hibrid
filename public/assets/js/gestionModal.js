   
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

function addRentalSpaceType() {
   // Get data from TWIG view
   var csrfTokenRentalSpaceType= $("#modalFooterForm").data("csrf-token-rental-space-type");

   // Modal title
   $(".modal-header").css({"background-color": "green", "color": "white"});
   $(".modal-title").css({"background-color": "green", "color": "white"});
   $(".modal-title").html("Ajout d'un type d'espace locatif");
   
   // Modal Main text
   $("#modalBodyText").html("<form name=\"rental_space_type_form\" method=\"post\" action=\"/admin/gestion/types/ajouter\" novalidate=\"novalidate\"><div id=\"rental_space_type_form\"><div class=\"form-group\"><label for=\"rental_space_type_form_designation\" class=\"mb-3 required\">Type d'espace locatif :</label><input type=\"text\" id=\"rental_space_type_form_designation\" name=\"rental_space_type_form[designation]\" required=\"required\" placeholder=\"Renseigner ici le type d'espace locatif\" class=\"form-control\"></div><input type=\"hidden\" id=\"rental_space_type_form__token\" name=\"rental_space_type_form[_token]\" value=\"" + csrfTokenRentalSpaceType + "\"></div><button id=\"formButton\" class=\"d-none\">Enregister</button></form>");

   // Modal footer
   $("#modalFooterForm").html("<button id=\"validationButton\" class=\"btn btn-success\">Enregister</button>");

   // Use modal footer validate button to trigger hidden form button
   $('#validationButton').click(function(){
      $("#formButton").click();
   })
}


function addCity() {
   // Get data from TWIG view
   var csrfTokenCity= $("#modalFooterForm").data("csrf-token-city");

   // Modal title
   $(".modal-header").css({"background-color": "green", "color": "white"});
   $(".modal-title").css({"background-color": "green", "color": "white"});
   $(".modal-title").html("Ajout d'une ville");
   
   // Modal Main text
   $("#modalBodyText").html("<form name=\"city_form\" method=\"post\" action=\"/admin/gestion/villes/ajouter\"><div id=\"city_form\"><div class=\"form-group\"><label for=\"city_form_name\" class=\"required\">Ville :</label><input type=\"text\" id=\"city_form_name\" name=\"city_form[name]\" required=\"required\" placeholder=\"Moulinsart\" class=\"form-control\"></div><div class=\"form-group\"><label for=\"city_form_postalCode\">Code postal :</label><input type=\"text\" id=\"city_form_postalCode\" name=\"city_form[postalCode]\" placeholder=\"12345\" class=\"form-control\"></div><input type=\"hidden\" id=\"city_form__token\" name=\"city_form[_token]\" value=\"" + csrfTokenCity + "\"></div><button id=\"formButton\" class=\"d-none\">Enregister</button></form>");

   // Modal footer
   $("#modalFooterForm").html("<button id=\"validationButton\" class=\"btn btn-success\">Enregister</button>");

   // Use modal footer validate button to trigger hidden form button
   $('#validationButton').click(function(){
      $("#formButton").click();
   })
}


