<?php

class DefaultController extends BackendController
{
    /**
     * [filters description]
     * @return [type] [description]
     */
    public function filters()
    {
        return array('accessControl');
    }

    public function init()
    {
        parent::init();
        $this->pageTitle = Yii::t('zh_CN', 'PAGE_TITLE_DASHBOARD');
    }

    /**
     * [accessRules description]
     * @return [type] [description]
     */
    public function accessRules()
    {
        return array(
            array(
                'deny',
                'actions' => array('index'),
                'users'=>array('?'),
            ),
        );
    }

    public function actionIndex()
    {
        $user = User::model()->chart();
        $post = Post::model()->chart();
        $comment = Comment::model()->chart();

        $this->render('index', array(
            "post" => $post,
            'user' => $user,
            'comment' => $comment,
        ));
    }

    public function actionLogin()
    {
        $this->pageTitle = Yii::t('zh_CN', 'PAGE_TITLE_BACKEND');
        $this->layout = "//layouts/default";

        $model = new AdminForm;
        if (isset($_POST['AdminForm'])) {
            
            $model->attributes = $_POST['AdminForm'];
            if ($model->validate() && $model->login()) {

                $uid = Yii::app()->user->id;
                Admin::model()->updateByPk($uid, array(
                    'loginIp' => Yii::app()->request->userHostAddress,
                    'updateTime' => time(),
                ),
                'id = :id', array(':id' => $uid));

                $this->redirect(array("default/index"));
            }
        }

        $this->render("login", array(
            'model' => $model,
        ));
    }

    public function actionLogout()
    {
        Yii::app()->user->logout(false);
        $this->redirect($this->createUrl("default/login"));
    }
}