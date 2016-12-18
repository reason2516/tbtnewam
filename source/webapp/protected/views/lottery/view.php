<?php
$this->pageTitle = $lotteryModel->name;
?>
<?php echo CHtml::textField('inputLottery', '', array('class' => 'inputLottery', 'itemId' => '', 'style' => 'width:500px;')) ?>
<?php foreach ($lotteryModel->LotteryItem as $lotteryItem) { ?>
    <ul>
        <li><?php echo $lotteryItem->name ?></li>
        <li><?php
            echo Chtml::button('开始', array(
                'id' => 'btnLottery' . $lotteryItem->id,
                'class' => 'btnLottery',
                'itemId' => $lotteryItem->id,
                'btnStatus' => 'start',
                'disabled' => count($lotteryItem->Member) >= $lotteryItem->total ? TRUE : FALSE,
            ))
            ?>
        </li>
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
    var btnLottery = $('.btnLottery');
    var inputLottery = $('.inputLottery');

    var members = {};
    var ids = [];
<?php foreach ($members as $key => $val) { // 动态为members 与 ids 赋值                   ?>
        members['<?php echo $key ?>'] = '<?php echo $val['realname'] ?>';
        ids.push('<?php echo $key ?>');
<?php } ?>

    function randomMember() {
        var randomId = ids[Math.floor(Math.random() * ids.length)];
        inputLottery.val(members[randomId]);
        inputLottery.attr('itemId', randomId);
    }

    /**
     * 移除已中奖人的信息
     * @param {type} id
     * @returns {undefined}
     */
    function removeMembers(id) {
        delete members[id]; //  删除对象中的指定元素
        $.each(ids, function (key, val) { // 删除ids中的被抽中id
            if (val == id) {
                ids.splice(key, 1);
            }
        });
    }
    
    $(function () {
        btnLottery.click(function () {
            if ($(this).attr('btnStatus') === 'start') {
                $(this).val('停止');
                $(this).attr('btnStatus', 'stop');
                inputRandom = setInterval(randomMember, 30);
                btnLottery.not('#'+ $(this).attr('id')).attr('disabled', 'disabled');
            } else {
                $(this).val('开始');
                $(this).attr('btnStatus', 'start');
                btnLottery.not('#'+ $(this).attr('id')).removeAttr('disabled', 'disabled');
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
                            $('#lotteryBox' + ret.data.itemId).show();
                            clearInterval(inputRandom); // 清除定时任务
                            var names = '';
                            for (var key in ret.data.members) {
                                var tmp = "<tr><td>" + ret.data.members[key].realname + "</td> <td>" + ret.data.members[key].job_number + "</td> <td>" + ret.data.members[key].phonenumber + "</td> </tr>"
                                $('#lotteryTable' + ret.data.itemId).append(tmp);
                                removeMembers(ret.data.members[key].id);
                                names += ret.data.members[key].realname + ' , ';
                            }
                            inputLottery.val(names);
                        }
                    }

                });
            }
        });
    });
</script>