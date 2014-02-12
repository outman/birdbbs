<?php 


class BackendController extends CController {
    
    public $layout = "//layouts/backend";
    
    public function init()
    {
        Yii::app()->name = Util::config('site_title');
    }
}