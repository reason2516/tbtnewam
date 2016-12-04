<?php

class AdminModule extends CWebModule {

    public $layout = 'application.modules.admin.views.layouts.main';

    public function init() {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
            'admin.models.*',
            'admin.components.*',
            'admin.widgets.*',
        ));
        Yii::app()->setComponents(array(
            'user' => array(
                'class' => 'AdminWebUser',
                'allowAutoLogin' => true,
                'stateKeyPrefix' => 'admin',
                'loginUrl' => array('/admin/default/login')
            ),
            'errorHandler' => array(
                'errorAction' => 'admin/default/error'
            ),
        ));
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        } else
            return false;
    }

    /**
     * 项目导航
     * @return array
     */
    public function navItems() {
        return array(
            'default' => array(
                'name' => '系统设置',
                'url' => $this->createModuleUrl('default/index'),
                'subItems' => array(
                    'index' => array(
                        'name' => '后台首页',
                        'url' => $this->createModuleUrl('default/index'),
                        'subItems' => array(),
                    ),
                ),
            ),
            'member' => array(
                'name' => '成员管理',
                'url' => $this->createModuleUrl('member/index'),
                'subItems' => array(
                    'add' => array(
                        'name' => '添加成员',
                        'url' => $this->createModuleUrl('member/add'),
                        'subItems' => array(),
                    ),
                    'index' => array(
                        'name' => '成员列表',
                        'url' => $this->createModuleUrl('member/index'),
                        'subItems' => array(),
                    ),
                ),
            ),
            'lottery' => array(
                'name' => '抽奖管理',
                'url' => $this->createModuleUrl('lottery/index'),
                'subItems' => array(
                    'index' => array(
                        'name' => '抽奖管理',
                        'url' => $this->createModuleUrl('lottery/index'),
                        'subItems' => array(),
                    ),
                ),
            ),
            'vote' => array(
                'name' => '选票管理',
                'url' => $this->createModuleUrl('vote/index'),
                'subItems' => array(
                    'index' => array(
                        'name' => '选票首页',
                        'url' => $this->createModuleUrl('vote/index'),
                        'subItems' => array(),
                    ),
                ),
            ),
        );
    }

    /**
     * 获取侧栏
     * @param string $controller
     */
    public function sideBarItems($controller) {
        $navItems = $this->navItems();
        return isset($navItems[$controller]['subItems']) ? $navItems[$controller]['subItems'] : array();
    }

    /**
     * 创建模块下的url
     * @param string $url
     * @return string
     */
    public function createModuleUrl($url) {
        // substr_compare比较字符串第一位 相等返回0,不加/ 不等非0,加/
        if (substr_compare('/', $url, 0, 1) == 0) {
            $moduleUrl = Yii::app()->createUrl($this->getId() . $url);
        } else {
            $moduleUrl = Yii::app()->createUrl($this->getId() . '/' . $url);
        }
        return $moduleUrl;
    }

}
