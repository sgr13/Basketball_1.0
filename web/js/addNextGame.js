$(document).ready(function () {
   $('.js-datepicker').datepicker({
       firstDay: 1,
       dateFormat: "yy-mm-dd",
       monthNames: ["Styczen", "Luty", "Marzec", "Kwiecien", "Maj", "Czerwiec", "Lipiec", "Spierpien", "Wrzesien", "Pazdziernik", "Listopad", "Grudzien"],
       dayNamesMin: [ "Nd","Pon", "Wt", "Śr", "Czw", "Pt", "Sob"],
       onSelect: function(date) {
            $('#finalData').attr('date', date);
            confirmSelection();
       }
   });

   $('#placeSelector').change(function () {
       $('#finalData').attr('place', $(this).find(":selected").attr('value'));
       confirmSelection();
   });

   $('#acceptButton').click(function() {
       var selectedDate = $('#finalData').attr('date');
       var selectedPlace = $('#finalData').attr('place');
       window.location.href = '/stepTwo/' + selectedDate + '/' + selectedPlace;
   });

   function confirmSelection() {
       if ($('#finalData').attr('date') !== '' && $('#finalData').attr('place') !== '') {
            $('#acceptButton').css('visibility', 'visible');
       } else {
           $('#acceptButton').css('visibility', 'hidden');
       }
   }

});