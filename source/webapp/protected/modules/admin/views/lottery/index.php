<?php $this->pageTitle = '成员首页' ?>
<?php if (!empty($list)) { ?>
    <table class="table">
        <tr>
            <?php
            $this->widget('application.widgets.TheadWidget', array(
                'items' => array(
                    $model->getAttributeLabel('id'),
                    $model->getAttributeLabel('name'),
                    $model->getAttributeLabel('time_start'),
                    $model->getAttributeLabel('time_end'),
                    $model->getAttributeLabel('status'),
                ),
            ));
            ?>
        </tr>
        <?php foreach ($list as $item) : ?>
            <tr>
                <td><?php echo $item->id ?></td>
                <td><?php echo $item->name ?></td>
                <td><?php echo $item->time_start ?></td>
                <td><?php echo $item->time_end ?></td>
                <td><?php echo $model->getStatusName($item->time_start, $item->time_end) ?></td>
                <td>
                    <?php echo Chtml::link('奖项管理', Yii::app()->createUrl('admin/lottery/itemList', array('lotteryId' => $item->id))) ?>
                    <?php echo Chtml::link('编辑', Yii::app()->createUrl('admin/lottery/update', array('id' => $item->id))) ?>
                    <?php echo Chtml::link('删除', 'javascript:;', array('class' => 'delBtn', 'delId' => $item->id)) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php $this->widget('application.widgets.PagerWidget', array('pages' => $pager)); ?>
<?php } else { ?>
    <div><?php echo empty($list) ? '暂无记录' : '' ?></div>
<?php } ?>
<script>
    $(function () {
        $(".delBtn").click(function () {
            $(this).myDialog({
                title: '成员删除',
                content: '是否确认删除',
                callBack: {
//                    functionName: 'myDialogCallBack',
//                    data: {id: $(this).attr('delId'), status:<?php echo Member::STATUS_DELETE ?>},
//                    url: '/admin/lottery/updateStatus',
////                    backUrl: '<?php Yii::app()->request->getUrl() ?>',
                }
            });
        });
    });
</script>