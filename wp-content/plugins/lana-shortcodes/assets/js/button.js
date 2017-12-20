tinymce.PluginManager.add('lana_button', function (editor, url) {
    editor.addButton('lana_button', {
        tooltip: 'Button Shortcode',
        icon: 'lana-button',
        onclick: function () {
            tinymce.activeEditor.windowManager.open({
                title: 'Button',
                url: url + '/../html/button.html',
                width: 480,
                height: 270
            });
        }
    });
});
