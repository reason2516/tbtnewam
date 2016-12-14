<?php $this->pageTitle = '成员首页' ?>

<div>活动名称：<?php echo $modelLottery->name ?> <?php echo CHtml::button('新增奖项', array('class' => 'submit', 'id' => 'lotteryItemAdd')) ?></div>
<?php if (!empty($list)) { ?>
    <table class="table">
        <tr>
            <?php
            $this->widget('application.widgets.TheadWidget', array(
                'items' => array(
                    $model->getAttributeLabel('id'),
                    $model->getAttributeLabel('name'),
                    $model->getAttributeLabel('total'),
                    $model->getAttributeLabel('sort'),
                ),
            ));
            ?>
        </tr>
        <?php foreach ($list as $item) : ?>
            <tr>
                <td><?php echo $item->id ?></td>
                <td><?php echo $item->name ?></td>
                <td><?php echo $item->total ?></td>
                <td><?php echo $item->sort ?></td>
                <td>
                    <?php echo Chtml::link('编辑', Yii::app()->createUrl('admin/lottery/itemUpdate', array('id' => $item->id, 'lotteryId' => $modelLottery->id))) ?>
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
        $('#lotteryItemAdd').click(function () {
            window.location.href = '<?php echo Yii::app()->createUrl('admin/lottery/itemAdd', array('lotteryId' => $modelLottery->id)) ?>';
        });
    });
</script>