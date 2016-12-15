<?php
$this->pageTitle = '抽奖活动首页'
?>
<?php if (!empty($list)) { ?>
    <table class="table">
        <tr>
            <?php
            $this->widget('application.widgets.TheadWidget', array(
                'items' => array(
                    $model->getAttributeLabel('id'),
                    $model->getAttributeLabel('name'),
                    $model->getAttributeLabel('status'),
                ),
            ));
            ?>
        </tr>
        <?php foreach ($list as $item) : ?>
            <tr>
                <td><?php echo $item->id ?></td>
                <td><?php echo $item->name ?></td>
                <td><?php echo $model->getStatusName($item->time_start, $item->time_end) ?></td>
                <td>
                    <?php echo Chtml::link('活动页面', Yii::app()->createUrl('lottery/view', array('id' => $item->id))) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php $this->widget('application.widgets.PagerWidget', array('pages' => $pager)); ?>
<?php } else { ?>
    <div><?php echo empty($list) ? '暂无记录' : '' ?></div>
<?php } ?>