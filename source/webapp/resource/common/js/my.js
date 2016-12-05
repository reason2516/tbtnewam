/**
 * 封装自己常用的方法
 */
$.fn.myDialog = function (params) {
    var default_params = {
        title: params.title != null ? params.title : '审核',
        content: params.content != null ? '<div id="myDialogContent"><p>' + params.content + '</p></div>' : '<div id="myDialogContent"><p>是否确认通过?</p></div>',
        callBack: params.callBack != null ? params.callBack : null,
        close: function (event, ui) { // 重写close方法,移除append到body中的Dom元素
            $(this).dialog("destroy");
            $(this).remove();
        },
        buttons: [
            {
                html: params.yesButton != null ? params.yesButton : '通过',
                class: '',
                click: function () {
                    $(this).dialog('close');
                    if (default_params.callBack != null || default_params.callBack.functionName != '') {
                        eval(default_params.callBack.functionName)(default_params.callBack); // 生成回调方法,传入回调参数
                    }
                }
            },
            {
                html: params.noButton != null ? params.noButton : '退回',
                class: '',
                click: function () {
                    $(this).dialog('close');
                }
            },
        ],
    }
    $('body').append(default_params.content);
    $('#myDialogContent').dialog(default_params);
}

/**
 * 回调方法
 * @param {type} params
 * @returns {undefined}
 */
function myDialogCallBack(params) {
    $.getJSON(params.url, params.data, function (data) {
        if (data.status == 10000) {
            $('#myDialogContent').myDialog({
                title: '操作结果',
                content: '操作成功',
                callBack: {
                    functionName: 'goUrl',
                    data: {url: params.backUrl}
                },
            });
        }
    });
}

/**
 * 页面跳转
 * @returns {undefined}
 */
function goUrl(params) {
    if (params.data.url == undefined || params.data.url == '') {
        window.location.reload();
    } else {
        window.location.href = params.data.url;
    }
}