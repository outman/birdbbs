<?php 

class FrontController extends CController {
    public $layout = "//layouts/front";
    public function init()
    {
        Yii::app()->name = Util::config('site_title');
    }
}