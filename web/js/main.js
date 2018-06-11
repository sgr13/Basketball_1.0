$(document).ready(function () {
    $('#menu_icon').click(function () {
        $('.side_bar_container').addClass('parallelogram');
        $('.side_bar_container').removeClass('side_bar_container');

        // $('#menu_list').css('display', 'inline');

        $("#menu_list").delay(350).fadeIn();

    })

    $('#close_button').click(function () {
        $('.parallelogram').addClass('side_bar_container');
        $('.parallelogram').removeClass('parallelogram');
        $('#menu_list').css('display', 'none');
    })
});