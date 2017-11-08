// Adds an icon toggle to the bootstrap collapse toggle icons

$(document).ready(function() {
    $('.toggle').click(function() {
        $(this).find('i').toggleClass('fa-plus-circle fa-minus-circle')
    });
});