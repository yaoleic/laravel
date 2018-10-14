$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var E = window.wangEditor;
var editor = new E('#div1', '#div2');

// 配置服务器端地址
editor.customConfig.uploadImgServer = '/posts/image/upload';

// 设置文件的name值
editor.customConfig.uploadFileName = 'wangEditorH5File';

// 设置 headers（举例）
editor.customConfig.uploadImgHeaders = {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
};
// 上传文件监听
editor.customConfig.uploadImgHooks = {
    customInsert: function (insertImg, result, editor) {
        var url = result.data;
        //上传图片回填富文本编辑器
        insertImg(url);
    }
};
editor.create();

document.getElementById('btn').addEventListener('click', function () {
    var res = editor.txt.html();
    var title = $("input[name=title]").val();
    $.ajax({
        url: '/posts',
        method: 'POST',
        dataType: "json",
        data: {
            'content': res,
            'title': title
        },
        success: function (data) {
            if (data.error != 0) {
                return;
            }
            //js 跳转
            window.location.href = '/posts';
        }, error: function (data) {
            var json = JSON.parse(data.responseText);
            // 动态在页面添加错误提示信息
            str = '<div class="alert alert-danger" role="alert">';
            $.each(json, function (i, n) {
                str += '<li>' + n[0] + '</li>';
            });
            str += '</div>';
            $(".alert").remove();
            $("#btn").before(str);
        }
    });

}, false);
