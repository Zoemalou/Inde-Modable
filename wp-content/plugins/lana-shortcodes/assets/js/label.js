tinymce.PluginManager.add('lana_label', function (editor, url) {
    editor.addButton('lana_label', {
        tooltip: 'Label Shortcode',
        icon: 'lana-label',
        onclick: function () {
            tinymce.activeEditor.windowManager.open({
                title: 'Label',
                url: url + '/../html/label.html',
                width: 480,
                height: 180
            });
        }
    });
});

