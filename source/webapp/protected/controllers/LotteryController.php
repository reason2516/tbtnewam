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
        $model = Lottery::model()->findByPk($id);
        $this->render('view', array('model' => $model));
    }

}
