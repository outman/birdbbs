<?php

class AdminModule extends CWebModule
{
    public function init()
    {
        // import the module-level models and components
        $this->setImport(array(
            'admin.models.*',
            'admin.components.*',
        ));
    }

    public function beforeControllerAction($controller, $action)
    {   
        $log = new Log;
        $log->type = Log::TYPE_BACKEND;
        $log->url = "{$this->id}.{$controller->id}.{$action->id}";
        $log->userKey = (int) Yii::app()->user->id;
        $log->content = serialize(array_merge($_GET, $_POST));
        $log->createTime = time();
        $log->save(false);
        
        if(parent::beforeControllerAction($controller, $action))
        {
            return true;
        }
        else
            return false;
    }
}
