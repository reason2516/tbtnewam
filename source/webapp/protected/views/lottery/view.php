<?php
$this->pageTitle = $lotteryModel->name;
?>
<h1><?php echo $lotteryModel->name ?></h1>
<h2>获奖者名单</h2>
<?php foreach ($lotteryModel->LotteryItem as $lotteryItem) { ?>
    <?php if (!empty($lotteryItem->Member)) { ?>
        <h3>奖项：<?php echo $lotteryItem->name ?></h3>
        <table class="table">
            <tr>
                <?php
                $this->widget('application.widgets.TheadWidget', array(
                    'lastColumn' => FALSE,
                    'items' => array(
                        $memberModel->getAttributeLabel('realname'),
                        $memberModel->getAttributeLabel('job_number'),
                        $memberModel->getAttributeLabel('phonenumber'),
                    )
                ));
                ?>
            </tr>
            <?php foreach ($lotteryItem->Member as $member) { ?>
                <tr>
                    <td><?php echo $member->realname ?></td>
                    <td><?php echo $member->job_number ?></td>
                    <td><?php echo $member->phonenumber ?></td>

                </tr>
            <?php } ?>
        </table>
    <?php } ?>
<?php } ?>