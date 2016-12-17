<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php echo $this->pageTitle . '-' . Yii::app()->name; ?></title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
        <link rel="stylesheet" href="/resource/common/plugs/jqueryUI/jquery-ui.min.css"/>
        <script type="text/javascript" src="/resource/common/plugs/jqueryUI/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/resource/common/js/my.js"></script>
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    </head>
    <body>
        <?php Yii::app()->user; ?>
        <?php echo $content ?>
    </body>
</html>