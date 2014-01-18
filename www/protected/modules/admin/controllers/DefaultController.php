<?php

class DefaultController extends BackendController
{
    public $pageTitle = "Dashboard";
    /**
     * [filters description]
     * @return [type] [description]
     */
    public function filters()
    {
        return array('accessControl');
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
        $this->pageTitle = '管理员后台';
        $this->layout = "//layouts/default";

        $model = new AdminForm;
        if (isset($_POST['AdminForm'])) {
            
            $model->attributes = $_POST['AdminForm'];
            if ($model->validate() && $model->login()) {
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