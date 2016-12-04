<?php

/**
 * 选票
 */
class VoteController extends AdminBaseController {

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array(
                'allow',
                'actions' => array('index'),
                'users' => array('@'),
            ),
            array(
                'deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * 选票首页
     */
    public function actionIndex() {
        $this->render('index');
    }

}
