/**
 * Lana Widgets
 * with WordPress Media Gallery
 */
jQuery(function () {
    'use strict';

    jQuery('body').on('click', '.lana-widgets-media-gallery[data-widget="lana-carousel"]', function () {

        var $lanaWidgetsCarouselWidget = jQuery(this).closest('.lana-widgets-carousel-widget');
        var $gallery = $lanaWidgetsCarouselWidget.find('.lana-gallery-id');

        var selection = lanaWidgetsGetGallerySelectionFromShortcode($gallery.val());

        var frame = wp.media({
            frame: 'post',
            title: wp.media.view.l10n.editGalleryTitle,
            multiple: false,
            state: 'gallery-edit',
            editing: true,
            selection: selection
        });

        frame.on('update', function () {
                var controller = frame.states.get('gallery-edit');
                var library = controller.get('library');
                var galleryShortcode = wp.media.gallery.shortcode(library).string();

                $gallery.val(galleryShortcode);
                lanaWidgetsAjaxGetGalleryHtmlFromShortcode($lanaWidgetsCarouselWidget, galleryShortcode);
            })
            .on('close', function () {
                jQuery('.supports-drag-drop').remove();
                jQuery('.wp-uploader-browser').remove();
            });

        frame.open();
        return false;
    });

});

/**
 * Ajax get gallery html
 *
 * @param $container
 * @param galleryShortcode
 */
function lanaWidgetsAjaxGetGalleryHtmlFromShortcode($container, galleryShortcode) {
    jQuery.post(
        ajaxurl,
        {
            action: 'lana_widgets_get_gallery_html_from_shortcode',
            _ajax_nonce: lana_widgets_ajax.get_gallery_html_from_shortcode_nonce,
            gallery_shortcode: galleryShortcode
        },
        function (data) {
            $container.find('#lana-widgets-gallery').html(data);
        },
        'html'
    );
}

/**
 * Get gallery selection from shortcode
 *
 * @param galleryShortcode
 * @returns {*}
 */
function lanaWidgetsGetGallerySelectionFromShortcode(galleryShortcode) {

    galleryShortcode = wp.shortcode.next('gallery', galleryShortcode);

    if (!galleryShortcode) {
        return null;
    }
    galleryShortcode = galleryShortcode.shortcode;

    var galleryId = wp.media.gallery.defaults.id;
    var attachments;
    var selection;

    if (typeof galleryShortcode.get('id') !== 'undefined' && typeof galleryId !== 'undefined') {
        galleryShortcode.set('id', galleryId);
    }

    attachments = wp.media.gallery.attachments(galleryShortcode);
    selection = new wp.media.model.Selection(attachments.models, {
        props: attachments.props.toJSON(),
        multiple: true
    });

    selection.gallery = attachments.gallery;

    selection.more().done(function () {
        selection.props.set({
            query: false
        });
        selection.unmirror();
        selection.props.unset('link');
        selection.props.unset('orderby');
    });
    return selection;
}