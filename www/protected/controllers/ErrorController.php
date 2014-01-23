<?php 

class ErrorController extends FrontController
{
    public function actionIndex()
    {   
        $this->pageTitle = Yii::t('zh_CN', 'PAGE_ERROR_TITLE');
        $this->layout = "//layouts//default";
        if ($error = Yii::app()->errorHandler->error) {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('index', $error);
        }
    }
}