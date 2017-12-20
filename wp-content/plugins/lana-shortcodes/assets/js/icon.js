tinymce.PluginManager.add('lana_icon', function (editor, url) {
    editor.addButton('lana_icon', {
        tooltip: 'Icon Shortcode',
        icon: 'lana-icon',
        onclick: function () {
            tinymce.activeEditor.windowManager.open({
                title: 'Icon',
                url: url + '/../html/icon.html',
                width: 480,
                height: 320
            });
        }
    });
});
