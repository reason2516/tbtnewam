<?php

/**
 * 成员
 */
class MemberController extends AdminBaseController {

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
                'actions' => array('index', 'add', 'update', 'UpdateStatus', 'trash'),
                'users' => array('@'),
            ),
            array(
                'deny',
                'users' => array('*'),
            )
        );
    }

    /**
     * 成员 - 首页
     */
    public function actionIndex() {
        $model = new Member();
        $model->status = array(Member::STATUS_NORMAL, Member::STATUS_PAUSAL);
        $model->pageSize = 30;
        $dataProvider = $model->search();
        $list = $dataProvider->getData();
        $pager = $dataProvider->pagination;
        $this->render('index', array('model' => $model, 'pager' => $pager, 'list' => $list));
    }

    /**
     * 成员 - 新增
     */
    public function actionAdd() {
        $model = new Member();
        if (Yii::app()->request->isPostRequest) {
            $model->attributes = Yii::app()->request->getParam('Member', '');
            if ($model->save()) {
                $this->redirect(Yii::app()->createUrl('admin/member/index'));
            }
        }
        $this->render('add', array('model' => $model));
    }

    /**
     * 成员 - 更新
     */
    public function actionUpdate() {
        $id = Yii::app()->request->getParam('id', '');
        $model = Member::model()->findByPk($id);
        if (Yii::app()->request->isPostRequest) {
            $model->attributes = Yii::app()->request->getParam('Member', '');
            if ($model->save()) {
                $this->redirect(Yii::app()->createUrl('admin/member/index'));
            }
        }
        $this->render('add', array('model' => $model));
    }

    /**
     * 成员 - 删除
     */
    public function actionUpdateStatus() {
        $id = Yii::app()->request->getParam('id', '');
        $status = Yii::app()->request->getParam('status', '');
        My::emptyParamsCheck($id, TRUE);
        $model = Member::model()->findByPk($id)->updateByPk($id, array('status' => $status));
        My::outPut($model);
    }

    /**
     * 成员信息回收站
     */
    public function actionTrash() {
        $model = new Member();
        $model->status =  Member::STATUS_DELETE;
        $model->pageSize = 10;
        $dataProvider = $model->search();
        $list = $dataProvider->getData();
        $pager = $dataProvider->pagination;
        $this->render('trash', array('model' => $model, 'pager' => $pager, 'list' => $list));
    }

}
