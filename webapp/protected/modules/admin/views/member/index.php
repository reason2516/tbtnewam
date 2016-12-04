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
    function dialogBtn(obj) {
        $(obj.element).click(function () {
            if (confirm(obj.title)) {
                $.ajax({
                    'dataType': 'json',
                    'url': obj.url,
                    'data': obj.data,
                    success: function (jsonData) {
                        alert(jsonData.message);
                        if(jsonData.status == 10000){
                            if(obj.callBackUrl === undefined || obj.callBackUrl ===''){
                                return TRUE;
                            }else {
                                window.location.href = obj.callBackUrl;
                            }
                        }
                    }
                });
            }
        });
    }
    $(function () {
        dialogBtn(
                {
                    'element': '.delBtn',
                    'title': '你是否确定要执行此操作?',
                    'url': '<?php echo Yii::app()->createUrl('admin/member/delete') ?>',
                    'callBackUrl': '<?php echo Yii::app()->request->getUrl() ?>',
                    'data': {'id': $('.delBtn').attr('delId')},
                }
        );
    });
</script>