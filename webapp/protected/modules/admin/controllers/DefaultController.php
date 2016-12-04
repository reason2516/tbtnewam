<?php
/**
 * 系统
 */
class DefaultController extends AdminBaseController {

    /**
     * filter select
     * @return type
     */
    public function filters() {
        return array(
            'accessControl',
        );
    }

    /**
     * accessRules
     * @return type
     */
    public function accessRules() {
        return array(
            array(
                'allow',
                'actions' => array('login', 'logout', 'captcha'),
                'users' => array('*'),
            ),
            array(
                'allow',
                'actions' => array('login', 'logout', 'error','index',),
                'users' => array('@'),
            ),
            array(
                'deny',
                'users' => array('*'),
            )
        );
    }

    /**
     * 后台首页
     */
    public function actionIndex() {
        $this->render('index');
    }

    /**
     * 后台登录页面
     */
    public function actionLogin() {
        $this->layout = FALSE; // 不加载公共样式
        $model = new FormLogin();
        if (Yii::app()->request->isPostRequest) {
            $model->attributes = Yii::app()->request->getParam('FormLogin');
            if ($model->validate() && $model->login()) {
                $this->redirect(Yii::app()->createUrl('/admin/default/index'));
            }
        }
        $this->render('login', array('model' => $model));
    }

    /**
     * 后台退出
     */
    public function actionLogout() {
        Yii::app()->user->logout(FALSE);
        $this->redirect(Yii::app()->createUrl('/admin/default/login'));
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
