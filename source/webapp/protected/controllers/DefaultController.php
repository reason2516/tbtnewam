<?php

class DefaultController extends BaseController {

    /**
     * 首页
     */
    public function actionIndex() {
        $this->render('index');
    }

    /**
     * 错误页面
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

}
