<?php

/**
 * 抽奖活动
 */
class LotteryController extends BaseController {

    /**
     * 抽奖首页 - 前台
     */
    public function actionIndex() {
        $model = new Lottery();
        $model->pageSize = 10;
        $dataProvider = $model->search();
        $list = $dataProvider->getData();
        $pager = $dataProvider->pagination;
        $this->render('index', array('model' => $model, 'pager' => $pager, 'list' => $list));
    }

    /**
     * 活动页面
     */
    public function actionView() {
        $id = Yii::app()->request->getParam('id', '');
        $memberModel = Member::model();
        $lotteryModel = Lottery::model()->findByPk($id);
        $members = $lotteryModel->getLcukyMembers($memberModel, $lotteryModel->LotteryItem); // 获取抽奖候选人名单
        $this->render('view', array('lotteryModel' => $lotteryModel, 'memberModel' => $memberModel, 'members' => $members));
    }

    /**
     * 抽奖
     */
    public function actionLotteryHandler() {
        $id = Yii::app()->request->getParam('id', ''); // 本次抽奖活动id
        $itemId = $lotteryId = Yii::app()->request->getParam('itemId', ''); // 当前奖项id
        $memberModel = Member::model();
        $lotteryModel = Lottery::model()->findByPk($id);
        $members = $lotteryModel->getLcukyMembers($memberModel, $lotteryModel->LotteryItem); // 抽奖候选人名单
        $lotteryItemModel = LotteryItem::model();
        foreach ($lotteryModel->LotteryItem as $item) {
            if ($item->id == $itemId) {
                $lotteryItemModel = $item; // 在lotteryModel中获取当前奖项 active对象,减少查库次数
                break;
            }
        }
        if ($lucyMembers = $lotteryItemModel->lotteryHandler($members)) { // 抽奖并将结果保存到 $lucyMembers
            My::outPut(array('members' => $lucyMembers, 'itemId' => $itemId), ApiStatusCode::$ok);
        } else {
            My::outPut('', ApiStatusCode::$error, $lotteryItemModel->getError('lotteryHandlerError'));
        }
    }

}
