tinymce.PluginManager.add('lana_progress_bar', function (editor, url) {
    editor.addButton('lana_progress_bar', {
        tooltip: 'Progress Bar Shortcode',
        icon: 'lana-progress_bar',
        onclick: function () {
            tinymce.activeEditor.windowManager.open({
                title: 'Progress Bar',
                url: url + '/../html/progress_bar.html',
                width: 480,
                height: 320
            });
        }
    });
});
