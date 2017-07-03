function menuActive($controller) {
    $('a[href*="' + $controller + '"]').parent('li').addClass('active');
}
