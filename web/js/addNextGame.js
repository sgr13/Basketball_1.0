$(document).ready(function () {
   $('.js-datepicker').datepicker({
       firstDay: 1,
       monthNames: ["Styczen", "Luty", "Marzec", "Kwiecien", "Maj", "Czerwiec", "Lipiec", "Spierpien", "Wrzesien", "Pazdziernik", "Listopad", "Grudzien"],
       dayNamesMin: [ "Nd","Pon", "Wt", "Śr", "Czw", "Pt", "Sob"],
       onSelect: function(date) {
           alert(date);
       }
   });
});