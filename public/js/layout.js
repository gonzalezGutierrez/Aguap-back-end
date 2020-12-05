function showLoading() {
    $('html').addClass('loading-overlay-shown');
    $('#loading-overlay').fadeIn(300);
}

function hideLoading () {
    $('html').removeClass('loading-overlay-shown');
    $('#loading-overlay').fadeOut(300);
}

showLoading();

$(document).ready(hideLoading());
