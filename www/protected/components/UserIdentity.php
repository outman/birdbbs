<?php
class UserIdentity extends CUserIdentity
{   
    /**
     * [$id description]
     * @var [type]
     */
    public $id;

    /**
     * [$name description]
     * @var [type]
     */
    public $name;

    /**
     * [authenticate description]
     * @return [type] [description]
     */
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

    /**
     * [getId description]
     * @return [type] [description]
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * [getName description]
     * @return [type] [description]
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * for third platform
     * @param  [type] $id   [description]
     * @param  [type] $name [description]
     * @return [type]       [description]
     */
    public function resetUserInfo($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }
}