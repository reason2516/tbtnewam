<?php $this->pageTitle = '创建抽奖活动' ?>
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
<table class='table'>
    <tr>
        <td align="right" width='45%'><?php echo $form->labelEx($model, 'name') ?></td>
        <td>
            <?php echo $form->textField($model, 'name', array('maxlength' => '20', 'class' => 'len250', 'placeholder' => '请输入' . $model->getAttributeLabel('name'))) ?>
            <?php echo $form->error($model, 'name'); ?>
        </td>
    </tr>
    <tr>
        <td align="right"><?php echo $form->labelEx($model, 'total') ?></td>
        <td>
            <?php echo $form->textField($model, 'total', array('maxlength' => '4', 'class' => 'len250', 'placeholder' => '请选择' . $model->getAttributeLabel('total'))) ?>
            <?php echo $form->error($model, 'total'); ?>
        </td>
    </tr>
    <tr>
        <td align="right"><?php echo $form->labelEx($model, 'sort') ?></td>
        <td>
            <?php echo $form->textField($model, 'sort', array('maxlength' => '4', 'class' => 'len250', 'placeholder' => '请选择' . $model->getAttributeLabel('sort'))) ?>
            <?php echo $form->error($model, 'sort'); ?>
        </td>
    </tr>
    <tr>
        <td align="center" colspan='2'>
            <?php
            if ($model->isNewRecord) {
                echo Chtml::submitButton('添加', array('class' => 'submit'));
            } else {

                echo Chtml::submitButton('保存', array('class' => 'submit'));
            }
            ?>
        </td>
    </tr>
</table>
<?php $form = $this->endWidget(); ?>
<script>
    $(function () {
        laydate({
            elem: '#Lottery_time_start',
            format: 'YYYY-MM-DD hh:mm:ss',
            isclear: true,
            istime: true
        });
        laydate({
            elem: '#Lottery_time_end',
            format: 'YYYY-MM-DD hh:mm:ss',
            isclear: true,
            istime: true
        });
    });
</script>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resource/common/plugs/laydate/laydate.js')?>