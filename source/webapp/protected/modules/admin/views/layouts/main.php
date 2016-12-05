<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php echo $this->pageTitle . '-' . Yii::app()->name; ?></title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
        <link rel="stylesheet" href="/resource/common/plugs/jqueryUI/jquery-ui.min.css"/>
        <link rel="stylesheet" href="/resource/admin/css/public.css"/>
        <link rel="stylesheet" href="/resource/admin/css/index.css"/>
        <script type="text/javascript" src="/resource/admin/js/index.js"></script>
        <script type="text/javascript" src="/resource/common/plugs/jqueryUI/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/resource/common/js/my.js"></script>
        <?php Yii::app()->clientScript->registerCoreScript('jquery');?>
    </head>
    <body>
        <div id="top">
            <div class="menu">
                <?php $this->widget('application.widgets.NavWidget',array('items' => $this->getModule()->navItems()))?>
            </div>
            <div class="exit">
                <a href="<?php echo Yii::app()->createUrl('/admin/default/logout') ?>">退出</a>
            </div>
        </div>
        <div id="left">
            <?php $this->widget('application.widgets.SideBarWidget',array('items' => $this->getModule()->sideBarItems(Yii::app()->controller->id)))?>
        </div>
        <div id="right">
            <?php echo $content ?>
        </div>
    </body>
</html>