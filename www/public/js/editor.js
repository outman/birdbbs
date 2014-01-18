(function(){
var options = {
    container: 'epiceditor',
    textarea: 'Post_content',
    theme: {
        base: siteUrl + '/public/markdown/themes/base/epiceditor.css',
        editor: siteUrl + '/public/markdown/themes/editor/epic-dark.css',
        preview: siteUrl + '/public/markdown/themes/preview/bartik.css'
    },
    button: {
        preview: true,
        fullscreen: true,
        bar: "auto"
    },
    string: {
        togglePreview: 'Preview',
        toggleEdit: 'Edit',
        toggleFullscreen: 'FullScreen'
    },
    autogrow: {
        minHeight: 480
    }
};
var editor = new EpicEditor(options).load();
})();