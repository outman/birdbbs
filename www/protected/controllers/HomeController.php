<?php 

class HomeController extends FrontController
{
    public function actionIndex()
    {
        $nodes = Node::model()->findAllByAttributes(array(
            "status" => Node::STATUS_NORMAL,
        ));

        $this->render("index", array(
            "nodes" => $nodes,
        ));
    }


    public function actionLogin()
    {
        $this->layout = "//layouts/default";

        $model = new LoginForm;
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if ($model->validate()) {

            }
        }

        $this->render("login", array(
            'model' => $model,
        ));
    }

    public function actionRegister()
    {
        $this->layout = "//layouts/default";

        $model = new User;
        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save()) {
                $this->redirect($this->createUrl("home/login"));
            }
        }

        $this->render("register", array(
            'model' => $model,
        ));
    }

    public function actionNode()
    {

    }
}