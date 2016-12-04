<?php $this->pageTitle = '登录'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php echo $this->pageTitle ?></title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
        <link rel="stylesheet" href="/resource/admin/css/public.css"/>
        <link rel="stylesheet" href="/resource/admin/css/login.css"/>
        <script type="text/javascript" src="/resource/admin/js/login.js"></script>
    </head>
    <body>
        <div id="top"></div>
        <div class="login">
            <div class="title">
                <?php echo Yii::app()->name ?> | 登录后台
            </div>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'login-form',
                'method' => 'POST',
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => false,
                ),
            ));
            ?>
            <table border="1" width="100%">
                <tr>
                    <th><?php echo $form->labelEx($model, 'username') ?></th>
                    <td>
                        <?php echo $form->textField($model, 'username', array('maxlength' => '10', 'class' => 'len250', 'placeholder' => '请输入密码')) ?>
                        <?php echo $form->error($model, 'username'); ?>
                    </td>
                </tr>
                <tr>
                    <th><?php echo $form->labelEx($model, 'password') ?></th>
                    <td>
                        <?php echo $form->passwordField($model, 'password', array('class' => 'len250', 'placeholder' => '请输入密码')) ?>
                        <?php echo $form->error($model, 'password'); ?>
                    </td>
                </tr>
                <tr>
                    <th><?php echo $form->labelEx($model, 'verifyCode') ?></th>
                    <td>
                        <?php echo $form->textField($model, 'verifyCode', array('class' => 'len100', 'placeholder' => '请输入验证码')); ?>
                        <?php $this->widget('CCaptcha', array('showRefreshButton' => true, 'clickableImage' => true, 'buttonType' => 'link', 'buttonLabel' => '换一张', 'imageOptions' => array('alt' => '点击换图', 'align' => 'absmiddle'))); ?>
                        <?php echo $form->error($model, 'verifyCode'); ?>
                    </td>
                </tr>
                <tr>

                    <td colspan="2" style="padding-left:160px;">
                        <?php echo CHtml::submitButton('登录', array('class' => 'submit')) ?>
                    </td>
                </tr>
            </table>
            <?php $form = $this->endWidget(); ?>
        </div>
    </body>
</html>