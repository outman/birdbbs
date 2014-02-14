(function(reqToken){
    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('#Post_content', {
            formatUploadUrl: false,
            themeType: "simple",
            filePostName: 'upload',
            uploadJson: IMAGE_UPLOAD_URL,
            items : [
                'forecolor', 'hilitecolor', 'bold', 'underline', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'image', 'link', 'code'
            ],
            cssData: 'body { font-size: 14px; }',
            extraFileUploadParams: reqToken
        });
    });
})(REQ_CSRF_TOKEN);