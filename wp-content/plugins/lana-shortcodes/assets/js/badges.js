tinymce.PluginManager.add('lana_badges', function (editor, url) {
    editor.addButton('lana_badges', {
        tooltip: 'Badges Shortcode',
        icon: 'lana-badges',
        onclick: function () {
            tinymce.activeEditor.windowManager.open({
                title: 'Badges',
                url: url + '/../html/badges.html',
                width: 480,
                height: 130
            });
        }
    });
});

