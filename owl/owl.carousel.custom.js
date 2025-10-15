function convertRemToPixels(rem) {    
    return rem * parseFloat(getComputedStyle(document.documentElement).fontSize);
}
jQuery(function($) {
    if ($('.ws-ingredients-slider').length > 0) {
        $('.ws-ingredients-slider').owlCarousel({
            center: true,
            items:4,
            loop:true,
            margin:convertRemToPixels(4.5)
        });
    } 
})