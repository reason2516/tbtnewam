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
                'actions' => array('index', 'add'),
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
        $this->render('index');
    }
    
    /**
     * 创建一个新的抽奖活动
     */
    public function actionAdd() {
        $this->render('add');
    }
    
    
}
