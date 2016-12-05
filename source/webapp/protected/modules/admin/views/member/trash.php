<?php $this->pageTitle = '回收站-成员管理' ?>
<table class="table">
    <tr>
        <?php
        $this->widget('application.widgets.TheadWidget', array(
            'model' => $model,
            'items' => array(
                'id',
                'job_number',
                'realname',
                'phonenumber',
                'status',
            ),
        ));
        ?>
    </tr>
    <?php foreach ($list as $item) : ?>
        <tr>
            <td><?php echo $item->id ?></td>
            <td><?php echo $item->job_number ?></td>
            <td><?php echo $item->realname ?></td>
            <td><?php echo $item->phonenumber ?></td>
            <td><?php echo $model->getStatusName($item->status) ?></td>
            <td>
                <?php // echo Chtml::link('编辑', Yii::app()->createUrl('admin/member/update', array('id' => $item->id))) ?>
                <?php echo Chtml::link('还原', 'javascript:;', array('class' => 'delBtn', 'delId' => $item->id)) ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>  
<div><?php echo empty($list) ? '暂无记录' : '' ?></div>
<script>
    $(function () {
        $(".delBtn").click(function () {
            $(this).myDialog({
                title: '还原',
                content: '是否确认还原',
                callBack: {
                    functionName: 'myDialogCallBack',
                    data: {id: $(this).attr('delId'), status:<?php echo Member::STATUS_NORMAL ?>},
                    url: '/admin/member/updateStatus',
                }
            });
        });
    });
</script>