/**
 * Lana Widgets
 * with WordPress Media
 */
jQuery(function () {
    'use strict';

    jQuery('body').on('click', '.lana-widgets-media-image[data-widget="lana-thumbnail"]', function () {

        var $lanaWidgetsThumbnailWidget = jQuery(this).closest('.lana-widgets-thumbnail-widget');
        var $image = $lanaWidgetsThumbnailWidget.find('.lana-widgets-image');
        var $imageUrl = $lanaWidgetsThumbnailWidget.find('.lana-widgets-image-url');

        wp.media.editor.send.attachment = function (props, attachment) {
            $image.attr('src', attachment.url);
            $imageUrl.val(attachment.url);
        };
        wp.media.editor.open(jQuery(this));

        return false;
    });
});
