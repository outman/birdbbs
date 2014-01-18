<?php
class UserIdentity extends CUserIdentity
{
    public $id;
    public $name;

    public function authenticate()
    {
        $user = User::model()->findByAttributes(array("username" => $this->username));
        if (empty($user)) 
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        elseif (!CPasswordHelper::verifyPassword($this->password, $user->password))
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else {
            $this->id = $user->id;
            $this->name = $user->username;
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }
}