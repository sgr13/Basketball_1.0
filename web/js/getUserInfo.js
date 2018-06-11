$(document).ready(function () {

    $('#playerSelect').change(function () {
        var userId = $(this).find(":selected").attr('value');
        $.ajax({
            type: 'POST',
            url: '/addPlayerToUser',
            data: {
                userId: userId
            },
            dataType: 'json',
            success: function(success) {


                if (success.slice(0,1) == 'p') {
                    window.location.replace("playerEditByAdmin/" + success.match(/\d+/));
                } else {
                    $('#addPlayerToUserForm').css('visibility', 'visible');
                    assignUserIdToForm(success.match(/\d+/));
                }
            }
        });
    });

    function assignUserIdToForm(userId)
    {
        $('#basketball_bundle_player_type_user option:first').val(userId);
        $('#basketball_bundle_player_type_user option:first').attr('selected','selected');
    }

});