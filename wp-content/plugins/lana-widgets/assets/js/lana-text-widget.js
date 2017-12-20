/**
 * Lana TinyMCE initialize
 * function
 *
 * @param element
 */
function lanaWidgetsTinyMCE(element){

    var textfieldId = jQuery(element).attr('id');

    window.tinyMCEPreInit.mceInit[textfieldId] = _.extend({}, tinyMCEPreInit.mceInit['content']);

    if(_.isUndefined(tinyMCEPreInit.qtInit[textfieldId])){
        window.tinyMCEPreInit.qtInit[textfieldId] = _.extend({}, tinyMCEPreInit.qtInit['replycontent'], {id: textfieldId})
    }
    quicktags(window.tinyMCEPreInit.qtInit[textfieldId]);
    QTags._buttonsInit();

    window.switchEditors.go(textfieldId, 'tmce');
    tinymce.execCommand('mceRemoveEditor', true, textfieldId);
    tinymce.execCommand('mceAddEditor', true, textfieldId);
}
