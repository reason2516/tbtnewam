<?php
$this->pageTitle = $lotteryModel->name;
?>
<?php foreach ($lotteryModel->LotteryItem as $lotteryItem) { ?>
    <ul>
        <li><?php echo $lotteryItem->name ?></li>
        <li><?php echo Chtml::button('开始', array('id' => 'btnLottery' . $lotteryItem->id, 'class' => 'btnLottery', 'itemId' => $lotteryItem->id)) ?></li>
    </ul>
<?php } ?>

<h1><?php echo $lotteryModel->name ?></h1>
<h2>获奖者名单</h2>
<?php foreach ($lotteryModel->LotteryItem as $lotteryItem) { ?>
    <?php if (!empty($lotteryItem->Member)) { ?>
        <div id='lotteryBox<?php echo $lotteryItem->id ?>'>
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
        </div>
    <?php } else { ?>
        <div id='lotteryBox<?php echo $lotteryItem->id ?>' style='display: none'>
            <h3>奖项：<?php echo $lotteryItem->name ?></h3>
            <table class="table" id='lotteryTable<?php echo $lotteryItem->id ?>'>
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
        </div>
    <?php } ?>
<?php } ?>

<script>
    $(function () {
        var btnLottery = $('.btnLottery');
        btnLottery.click(function () {
            $.ajax({
                url: '/lottery/lotteryHandler',
                type: 'GET',
                dataType: 'json',
                data: {id: '<?php echo $lotteryModel->id ?>', itemId: $(this).attr('itemId')},
                success: function (ret) {
                    if (ret.status !== 10000) {
                        btnLottery.myDialog({
                            title: '提示',
                            content: ret.message,
                            yesButton: '确定',
                            noButton: '取消'
                        });
                    } else {
                        $('#lotteryBox'+ret.data.itemId).show();console.log(ret.data.members);
                        for(var key in ret.data.members){
                            var tmp = "<tr><td>"+ret.data.members[key].realname+"</td> <td>"+ret.data.members[key].job_number+"</td> <td>"+ret.data.members[key].phonenumber+"</td> </tr>"
                            $('#lotteryTable'+ret.data.itemId).append(tmp);
                        }
                    }
                }

            });
        });
    });
</script>