<?php

class FormLogin extends CFormModel {

    public $username;
    public $password;
    public $rememberMe;
    public $verifyCode;
    public $_identity;

    public function rules() {
        return array(
            array('username , password', 'safe'),
            array('username , password, verifyCode', 'required'),
            // password needs to be authenticated
            array('password', 'authenticate'),
            array('verifyCode', 'captcha'),
        );
    }

    public function attributeLabels() {
        return array(
            'username' => "用户名",
            'password' => "密码",
            'verifyCode' => "验证码",
        );
    }

    /**
     * 密码验证
     */
    public function authenticate($attribute, $params) {
        if (!$this->hasErrors()) {
            $this->_identity = new AdminUserIdentity($this->username, $this->password);
            if (!$this->_identity->authenticate()) {
                $this->addError('username', '用户名或密码错误');
            }
        }
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login() {
        if ($this->_identity === null) {
            $this->_identity = new AdminUserIdentity($this->username, $this->password);
            $this->_identity->authenticate();
        }
        if ($this->_identity->errorCode === AdminUserIdentity::ERROR_NONE) {
            $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
            Yii::app()->user->login($this->_identity, $duration);
            return true;
        } else
            return false;
    }

}
