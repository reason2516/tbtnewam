<?php

/**
 * 抽奖
 */
class LotteryController extends AdminBaseController {

    /**
     * filter select
     * @return type
     */
    public function filters() {
        return array(
            'accessControl',
        );
    }

    /**
     * accessRules
     * @return type
     */
    public function accessRules() {
        return array(
            array(
                'allow',
                'actions' => array('index', 'add', 'update', 'itemList', 'itemAdd', 'itemUpdate', 'itemUpdate'),
                'users' => array('@'),
            ),
            array(
                'deny',
                'users' => array('*'),
            )
        );
    }

    /**
     * 抽奖活动列表
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
     * 创建一个新的抽奖活动
     */
    public function actionAdd() {
        $model = new Lottery();
        if (Yii::app()->request->isPostRequest) {
            $model->attributes = Yii::app()->request->getParam('Lottery', '');
            if ($model->save()) {
                $this->redirect(Yii::app()->createUrl('admin/lottery/index'));
            }
        }
        $this->render('add', array('model' => $model));
    }

    /**
     * 编辑一个新的抽奖活动
     */
    public function actionUpdate() {
        $id = Yii::app()->request->getParam('id', '');
        $model = Lottery::model()->findByPk($id);
        if (Yii::app()->request->isPostRequest) {
            $model->attributes = Yii::app()->request->getParam('Lottery', '');
            if ($model->save()) {
                $this->redirect(Yii::app()->createUrl('admin/lottery/index'));
            }
        }
        $this->render('add', array('model' => $model));
    }

    /**
     * 抽奖活动删除
     */
    public function actionDelete() {
        
    }

    /**
     * 奖项列表管理
     */
    public function actionItemList() {
        $lotteryId = Yii::app()->request->getParam('lotteryId', '');
        $model = new LotteryItem();
        $model->pageSize = 10;
        $model->lottery_id = $lotteryId;
        $modelLottery = Lottery::model()->findByPk($lotteryId);
        $dataProvider = $model->search();
        $list = $dataProvider->getData();
        $pager = $dataProvider->pagination;
        $this->render('itemList', array('model' => $model, 'pager' => $pager, 'list' => $list, 'modelLottery' => $modelLottery));
    }

    /**
     * 奖项新增
     */
    public function actionItemAdd() {
        $lotteryId = Yii::app()->request->getParam('lotteryId', '');
        $model = new LotteryItem();
        $model->lottery_id = $lotteryId;
        if (Yii::app()->request->isPostRequest) {
            $model->attributes = Yii::app()->request->getParam('LotteryItem', '');
            if ($model->save()) {
                $this->redirect(Yii::app()->createUrl('admin/lottery/itemList/', array('lotteryId' => $lotteryId)));
            }
        }
        $this->render('itemAdd', array('model' => $model));
    }

    /**
     * 奖项编辑
     */
    public function actionItemUpdate() {
        $lotteryId = Yii::app()->request->getParam('lotteryId', '');
        $id = Yii::app()->request->getParam('id', '');
        $model = LotteryItem::model()->findByPk($id);
        $model->lottery_id = $lotteryId;
        if (Yii::app()->request->isPostRequest) {
            $model->attributes = Yii::app()->request->getParam('LotteryItem', '');
            if ($model->save()) {
                $this->redirect(Yii::app()->createUrl('admin/lottery/itemList/', array('lotteryId' => $lotteryId)));
            }
        }
        $this->render('itemAdd', array('model' => $model));
    }

    /**
     * 奖项删除
     */
    public function actionItemDelete() {
        
    }

}
