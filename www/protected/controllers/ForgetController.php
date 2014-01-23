<?php

class ForgetController extends FrontController
{
    public $layout = "//layouts/default";
    public function init()
    {
        $this->pageTitle = Yii::t('zh_CN', 'PAGE_TITLE_FORGET');
    }

    public function actionIndex()
    {
        $model = new Forget('post');
        if (isset($_POST['Forget'])) {

            $model->attributes = $_POST['Forget'];
            if ($model->validate()) {

                $user = User::model()->findByAttributes(array('email' => $model->email));
                if (empty($user)) {
                    $notice = 'FORGET_PASSWORD_USER_UNEXISTS';
                }
                else {
                    $model->token = Util::randmd5();
                    $model->expire = time() + 24*3600;
                    $model->status = Forget::STATUS_NORMAL;
                    $notice = 'FORGET_PASSWORD_RESENT_FAILED';                
                    if ($model->save()) {
                        $notice = 'FORGET_PASSWORD_RESENT_SUCCESS';
                    }
                }
                
                Yii::app()->user->setFlash(":notice", Yii::t('zh_CN', $notice));
                $this->redirect($this->createUrl("forget/index"));
            }
        }

        $this->render("index", array('model' => $model));
    }
}