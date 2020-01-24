$(document).ready(function() {
    $('.collapse').on('shown.bs.collapse', function() {
        $('.navbar .container, .navbar .container .nav li a, .memad-logo-nav, .navbar-toggle span.icon-bar').addClass('menu-collapse');
    });

    $('.collapse').on('hidden.bs.collapse', function() {
        $('.navbar .container, .navbar .container .nav li a, .memad-logo-nav, .navbar-toggle span.icon-bar').removeClass('menu-collapse');
    });
});