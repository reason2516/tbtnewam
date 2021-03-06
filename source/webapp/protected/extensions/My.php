<?php

class My {

    public static function outPut($data, $status = 10000, $message = "操作成功") {
        header("Content-type: application/json");
        $arr = array('status' => $status, 'data' => $data, 'message' => $message);
        echo json_encode($arr);
        Yii::app()->end();
    }

    /**
     * 检查字符串为空跳转
     * @param type $params
     */
    public static function emptyParamsCheck($params, $jsonResult = FALSE) {
        if (empty($params)) {
            if ($jsonResult) {
                My::outPut('', ApiStatusCode::$error, '缺少必要参数');
            } else {
                throw new CHttpException(404, Yii::t('yii', 'The system is unable to find the requested action "{action}".', array('{action}' => Yii::app()->request->getUrl())));
            }
        }
    }

}
