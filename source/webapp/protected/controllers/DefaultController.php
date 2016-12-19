<?php

class DefaultController extends BaseController {

    /**
     * 首页
     */
    public function actionIndex() {
//        $message = 'Hello World!';
//        $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
//        $mailer->Host = 'smtp.126.com';
//        $mailer->IsSMTP();
//        $mailer->SMTPAuth = true;
//        $mailer->From = 'gteachers@126.com';
//        $mailer->AddReplyTo('gteachers@126.com');
//        $mailer->AddAddress('176275042@qq.com');
//        $mailer->FromName = 'myName';
//        $mailer->Username = 'gteachers@126.com';    //这里输入发件地址的用户名
//        $mailer->Password = 'enke2013';    //这里输入发件地址的密码
//        $mailer->SMTPDebug = FALSE;   //设置SMTPDebug为true，就可以打开Debug功能，根据提示去修改配置
//        $mailer->ContentType = 'text/html'; // 自定义类型
//        $mailer->CharSet = 'UTF-8';
//        $mailer->Subject = '测试';
//        $mailer->Body = $message;
//        $mailer->getView('test');
//        $mailer->Send();
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
