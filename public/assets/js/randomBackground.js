// //////////////////////////////////////////////////////////////////////////////// //
// //                          Random background images                             //
// //////////////////////////////////////////////////////////////////////////////// //

var imagesFond = ["rooftopMarcheDuLez.jpg", "workingSpace.png", "cahute.jpg"];
$(document).ready(function () {
    $("body").css({"background": "url(../../../../assets/img/" + imagesFond[Math.floor(Math.random() * imagesFond.length)] + ") no-repeat center fixed", "background-size": "cover" });
});
