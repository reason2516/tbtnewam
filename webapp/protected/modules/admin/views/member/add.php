<?php $this->pageTitle = '添加成员'; ?>
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
        <td align="right" width='45%'><?php echo $form->labelEx($model, 'realname') ?></td>
        <td>
            <?php echo $form->textField($model, 'realname', array('maxlength' => '10', 'class' => 'len250', 'placeholder' => '请输入' . $model->getAttributeLabel('realname'))) ?>
            <?php echo $form->error($model, 'realname'); ?>
        </td>
    </tr>
    <tr>
        <td align="right"><?php echo $form->labelEx($model, 'job_number') ?></td>
        <td>
            <?php echo $form->textField($model, 'job_number', array('maxlength' => '10', 'class' => 'len250', 'placeholder' => '请输入' . $model->getAttributeLabel('job_number'))) ?>
            <?php echo $form->error($model, 'job_number'); ?>
        </td>
    </tr>
    <tr>
        <td align="right"><?php echo $form->labelEx($model, 'phonenumber') ?></td>
        <td>
            <?php echo $form->textField($model, 'phonenumber', array('maxlength' => '11', 'class' => 'len250', 'placeholder' => '请输入' . $model->getAttributeLabel('phonenumber'))) ?>
            <?php echo $form->error($model, 'phonenumber'); ?>
        </td>
    </tr>
    <tr>
        <td align="right"><?php echo $form->labelEx($model, 'status') ?></td>
        <td>	
            <?php echo $form->dropDownList($model, 'status', $model->statusList()); ?>
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
