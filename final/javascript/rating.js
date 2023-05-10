//barvy hvězd
function star(star_location) {
   //vybere všechny elementy menší a rovny zakliknuté hvězdě a označí je
   for (var i = 1; i <= star_location; i++) {
      var id_name = "star_" + i;
      document.getElementById(id_name).attributes[0].value = "star_on";
   }
   //vybere všechny elementy větší zakliknuté hvězdě a odnačí je
   for (var i = star_location + 1; i <= 5; i++) {
      var id_name = "star_" + i;
      document.getElementById(id_name).attributes[0].value = "star_off";
   }
}
