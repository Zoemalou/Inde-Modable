jQuery(function () {
    'use strict';

    /**
     * Scroll top
     */
    jQuery('#scroll-top').on('click', function () {
        jQuery('body').animate({
            scrollTop: 0
        }, 'slow');

        return false;
    });

    /**
     * Min-height
     * Content
     */
    jQuery(window).load(function () {
        var html = jQuery('html');
        var html_height = html.outerHeight();
        var html_outer_height = html.outerHeight(true) - html.outerHeight();
        var navbar_in_header_height = jQuery('.navbar-in-header').find('.navbar').outerHeight(true);
        var navbar_in_content_height = jQuery('.navbar-in-content').find('.navbar').outerHeight(true);
        var header_height = jQuery('.header').outerHeight(true);
        var breadcrumb_height = jQuery('.breadcrumb-container').outerHeight(true);
        var pre_footer_height = jQuery('.pre-footer').outerHeight(true);
        var footer_height = jQuery('.footer').outerHeight(true);

        var other_height = (
            Math.floor(navbar_in_header_height) +
            Math.floor(navbar_in_content_height) +
            Math.floor(header_height) +
            Math.floor(breadcrumb_height) +
            Math.floor(pre_footer_height) +
            Math.floor(footer_height)
        );

        jQuery('.main-content').css('min-height', (html_height + html_outer_height - other_height - 1) + 'px');
    });
});
