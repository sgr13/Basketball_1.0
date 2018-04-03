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
                $('#addPlayerToUserForm').css('visibility', 'visible');
            }
        });
    });

});