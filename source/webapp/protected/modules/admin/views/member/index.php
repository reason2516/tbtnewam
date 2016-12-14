<?php $this->pageTitle = '成员首页' ?>
<table class="table">
    <tr>
        <?php
        $this->widget('application.widgets.TheadWidget', array(
            'items' => array(
                $model->getAttributeLabel('id'),
                $model->getAttributeLabel('job_number'),
                $model->getAttributeLabel('realname'),
                $model->getAttributeLabel('phonenumber'),
                $model->getAttributeLabel('status'),
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
                <?php echo Chtml::link('编辑', Yii::app()->createUrl('admin/member/update', array('id' => $item->id))) ?>
                <?php echo Chtml::link('删除', 'javascript:;', array('class' => 'delBtn', 'delId' => $item->id)) ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<div><?php echo empty($list) ? '暂无记录' : '' ?></div>
<?php $this->widget('application.widgets.PagerWidget', array('pages' => $pager)); ?>
<script>
    $(function () {
        $(".delBtn").click(function () {
            $(this).myDialog({
                title: '成员删除',
                content: '是否确认删除',
                callBack: {
                    functionName: 'myDialogCallBack',
                    data: {id: $(this).attr('delId'), status:<?php echo Member::STATUS_DELETE ?>},
                    url: '/admin/member/updateStatus',
//                    backUrl: '<?php Yii::app()->request->getUrl() ?>', 
                }
            });
        });
    });
</script>