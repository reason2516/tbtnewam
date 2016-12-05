<?php $this->pageTitle = '成员首页' ?>
<div>    
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
                    <?php echo Chtml::link('编辑', Yii::app()->createUrl('admin/member/update', array('id' => $item->id))) ?>
                    <?php echo Chtml::link('删除', 'javascript:;', array('class' => 'delBtn', 'delId' => $item->id)) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>  
    <?php $this->widget('application.widgets.PagerWidget', array('pages' => $pager)); ?>
</div>
<script>
    $(function () {
        $(".delBtn").click(function () {
            $(this).myDialog({
                title: '成员删除',
                content: '是否确认删除',
                callBack: {
                    functionName: 'myDialogCallBack',
                    data: {id: $(this).attr('delId')},
                    url: '/admin/member/delete',
                    backUrl: '<?php Yii::app()->request->getUrl() ?>',
                }
            });
        });
    });
</script>