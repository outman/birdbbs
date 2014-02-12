<?php 

class ErrorController extends BackendController {

    public function init()
    {
        parent::init();
        $this->pageTitle = Yii::t('zh_CN', 'PAGE_TITLE_ERROR');
    }
    
    public function actionIndex()
    {
        $this->layout = "//layouts//default";
        if ($error = Yii::app()->errorHandler->error) {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('index', $error);
        }
    }
}