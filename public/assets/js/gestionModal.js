   
function deleteRentalSpace() {
   // Get data from TWIG view
   var rentalSpace= $(".dataRentalSpace").data("rental-space");
   var rentalSpaceCity= $(".dataRentalSpace").data("rental-space-city");
   var rentalSpaceQuantity= $(".dataRentalSpace").data("rental-space-quantity");
   var actionPath= $("#footerForm").data("action-path");
   var csrfToken= $("#footerForm").data("csrf-token");

   // Modal title
   $(".modal-header").css({"background-color": "#dc3545", "color": "white"});
   $(".modal-title").html("Suppression d'un espace locatif");
   
   // Modal Main text
   $("#modalText").html("<p class=\"redWarning\">Attention : cette action est irréversible !</p><p>Suppression de <b>" 
                        + rentalSpace + "</b> qui se trouve à <b>" 
                        + rentalSpaceCity + "</b>.<br><small>(quantité : " 
                        + rentalSpaceQuantity + ")</small></p><p>Confirmez-vous ?</p>"
   );

   // Modal footer
   // $(".modal-footer").css({"background-color": "gray", "color": "white"});
   $("#footerForm").html("<form method=\"post\" action=\"" + actionPath + "\"><input type=\"hidden\" name=\"_token\" value=\"" + csrfToken + "\"><button class=\"btn btn-success\">Confirmer</button></form>");
}

function deleteRentalSpaceType() {
   // Get data from TWIG view
   var rentalSpaceType= $(".dataRentalSpaceType").data("rental-space-type");
   var actionPath= $("#footerForm").data("action-path");
   var csrfToken= $("#footerForm").data("csrf-token");

   // Modal title
   $(".modal-header").css({"background-color": "#dc3545", "color": "white"});
   $(".modal-title").html("Suppression d'un type d'espace locatif");
   
   // Modal Main text
   $("#modalText").html("<p class=\"redWarning\">Attention : cette action est irréversible !</p><p>Suppression de <b>" 
                        + rentalSpaceType + "</b>.</p><p>Confirmez-vous ?</p>"
   );

   // Modal footer
   // $(".modal-footer").css({"background-color": "gray", "color": "white"});
   $("#footerForm").html("<form method=\"post\" action=\"" + actionPath + "\"><input type=\"hidden\" name=\"_token\" value=\"" + csrfToken + "\"><button class=\"btn btn-success\">Confirmer</button></form>");
}

function deleteCity() {
   // Get data from TWIG view
   var city= $(".dataCity").data("city");
   var cityPostalCode= $(".dataCity").data("city-postal-code");
   var actionPath= $("#footerForm").data("action-path");
   var csrfToken= $("#footerForm").data("csrf-token");

   // Modal title
   $(".modal-header").css({"background-color": "#dc3545", "color": "white"});
   $(".modal-title").html("Suppression d'une ville");

   // Modal Main text
   $("#modalText").html("<p class=\"redWarning\">Attention : cette action est irréversible !</p><p>Suppression de <b>" 
                        + city + "</b> (code postal <b>" 
                        + cityPostalCode + ")</b>.<br></p><p>Confirmez-vous ?</p>"
   );

   // Modal footer
   // $(".modal-footer").css({"background-color": "gray", "color": "white"});
   $("#footerForm").html("<form method=\"post\" action=\"" + actionPath + "\"><input type=\"hidden\" name=\"_token\" value=\"" + csrfToken + "\"><button class=\"btn btn-success\">Confirmer</button></form>");
}
