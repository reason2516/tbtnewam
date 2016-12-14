<?php $this->pageTitle = '回收站-成员管理' ?>
<?php if (!empty($list)) { ?>
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
                    <?php echo Chtml::link('还原', 'javascript:;', array('class' => 'delBtn', 'delId' => $item->id)) ?>
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