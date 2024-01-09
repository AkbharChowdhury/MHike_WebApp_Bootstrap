$( document ).ready(function() {
    $( "#btnCheckDifficulty" ).click(function() {
        getDifficultyStatus();

    });
});

function getDifficultyStatus(){
    $.ajax({
        url: "hikeDifficulty.inc.php",
        method: 'POST',
        data: {
            distance: $('#distance').val(),
            elevation: $('#elevation').val(),
        },

        success: function(result){
            let data = JSON.parse(result);
            $('#level').html(`<h3 class="text-${data.difficultColour}">${data.difficultyName}</h3>`);
        }});
}



$('#distance').keyup(function(){
    var str = $(this).val();
     // validates as a number
    if( +str || str=='0'){
        $('#distance').text(str);
    }else{
        $("#distance")[0].value="";
    }
});


const hikeDate = '#date';
const start = flatpickr(hikeDate, {
  // format for database input
  dateFormat: 'Y-m-d', 
  altInput: true,
  // used to display the date and time in a user friendly format
  altFormat: 'l J F, Y',
  defaultDate: document.querySelector(hikeDate).value !== '' ? document.querySelector(hikeDate).value : new Date(),
  minDate: 'today'

});