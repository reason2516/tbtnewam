/**
 * 封装自己常用的方法
 */
$.fn.myDialog = function (params) {
    var default_params = {
        title: params.title != null ? params.title : '审核',
        content: params.content != null ? '<div id="myDialogContent"><p>' + params.content + '</p></div>' : '<div id="myDialogContent"><p>是否确认通过?</p></div>',
        callBack: params.callBack != null ? params.callBack : null,
        buttons: [
            {
                html: params.yesButton != null ? params.yesButton : '通过',
                class: '',
                click: function () {
                    $(this).dialog('close');
                    removeDialog();
                    if (default_params.callBack!= null || default_params.callBack.functionName != '') {
                        myDialogCallBack(default_params.callBack); // 默认回调
                    } else {
//                        default_params.callBack.functionName.apply(this, default_params.callBack);
                    }
                }
            },
            {
                html: params.noButton != null ? params.noButton : '退回',
                class: '',
                click: function () {
                    $(this).dialog('close');
                    removeDialog()
                }
            },
        ],
    }
    $('body').append(default_params.content);
    $('#myDialogContent').dialog(default_params);
}
function removeDialog() {
    $('#myDialogContent').remove();
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