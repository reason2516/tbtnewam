<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class AdminBaseController extends CController {

    /**
     * init
     * @author wangmingxu
     */
    public function init() {
        
    }

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = ''; //
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    public function actions() {
        return array(
            'captcha' => array(
                'class' => 'MyCaptchaAction',
//                'backColor' => 0xff6600,
//                'foreColor'=>0xffffff,
                'maxLength' => '4',
                'minLength' => '4',
                'height' => '36',
                'width' => '70',
                'padding' => 0,
            ),
        );
    }

}
