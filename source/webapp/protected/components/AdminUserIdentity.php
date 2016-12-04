<?php

class AdminUserIdentity extends CUserIdentity {
    public $user;
    public function authenticate() {
        $admin = Admin::model()->find('LOWER(username)=?', array(strtolower($this->username)));
        if ($admin == NULL) { // username error
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else if (!$admin->checkPassword($this->password)) { // password error
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else { // 
            $this->setUser($admin);
            $this->setState('id', $admin->id);
            $this->username = $admin->username;
            $this->errorCode = self::ERROR_NONE;
        }
        return $this->errorCode == self::ERROR_NONE;
    }
    
    public function getUser(){
        return $this->user;
    }
    
    public function setUser(CActiveRecord $user) {
        $this->user = $user->attributes;
    }

}
