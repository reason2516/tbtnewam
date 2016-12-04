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
                'actions' => array('index',),
                'users' => array('@'),
            ),
            array(
                'deny',
                'users' => array('*'),
            )
        );
    }

    public function actionIndex() {
        $this->render('index');
    }

}
