<?php
//表单
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'product-form',
    'htmlOptions' => array('enctype' => 'multipart/form-data'), //关键是这一行
    'enableAjaxValidation' => false,));
?>
<table>
<tr>
        <td width="159">&nbsp;<?php echo $form->labelEx($model, 'name'); ?>：</td>
        <td width='901'><?php echo $form->textField($model, 'name'); ?>
<?php echo $form->error($model, 'name'); ?></td>
    </tr>
    <tr>
        <td width="159">&nbsp;<?php echo $form->labelEx($model, 'pdftest1'); ?>：</td>
        <td width='901'><?php echo $form->fileField($model, 'pdftest1'); ?>
<?php echo $form->error($model, 'pdftest1'); ?></td>
    </tr>
    <tr>
        <td width="159">&nbsp;<?php echo $form->labelEx($model, 'pdftest2'); ?>：</td>
        <td width='901'><?php echo $form->fileField($model, 'pdftest2'); ?>
<?php echo $form->error($model, 'pdftest2'); ?></td>
    </tr>
    <tr>
        <td width="159">&nbsp;<?php echo $form->labelEx($model, 'pdftest3'); ?>：</td>
        <td width='901'><?php echo $form->fileField($model, 'pdftest3'); ?>
<?php echo $form->error($model, 'pdftest3'); ?></td>
    </tr>
    <tr>
        <td width="159">&nbsp;<?php echo $form->labelEx($model, 'pdftest4'); ?>：</td>
        <td width='901'><?php echo $form->fileField($model, 'pdftest4'); ?>
<?php echo $form->error($model, 'pdftest4'); ?></td>
    </tr>
    <tr>
        <td width="159">&nbsp;<?php echo $form->labelEx($model, 'pdftest5'); ?>：</td>
        <td width='901'><?php echo $form->fileField($model, 'pdftest5'); ?>
<?php echo $form->error($model, 'pdftest5'); ?></td>
    </tr>
    <tr>
        <td width="159">&nbsp;<?php echo $form->labelEx($model, 'pdftest6'); ?>：</td>
        <td width='901'><?php echo $form->fileField($model, 'pdftest6'); ?>
<?php echo $form->error($model, 'pdftest6'); ?></td>
    </tr>
    <?php
        echo $form->checkBoxList($model,'checkBoxTest',array('test1','test2','test3'),array(
            'container'=>'ul',
            'checkAll'=>'全选',
            'separator'=>''
        ));
    ?>
</table>
<?php
echo CHTML::submitButton();
?>
<?php
$this->endWidget();
?>