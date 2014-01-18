<?php 

class HomeController extends FrontController
{
    public function filters()
    {
        return array('accessControl');
    }

    public function accessRules()
    {
        return array(
            array(
                'deny',
                'actions' => array('post'),
                'users' => array('?'),
            ),
            array(
                'deny',
                'actions' => array('view'),
                'users' => array('?'),
                'verbs' => array('POST'),
            ),
        );
    }

    /**
     * [actionPost description]
     * @return [type] [description]
     */
    public function actionPost()
    {
        $model = new Post;

        if (isset($_POST['Post'])) {
            
            $model->attributes = $_POST["Post"];
            $model->userId = (int) Yii::app()->user->id;

            if ($model->save()) {
                $this->redirect($this->createUrl("home/view", array("id" => $model->id)));
            }
        }

        $nodes = Node::model()->findAllByAttributes(array(
            "status" => Node::STATUS_NORMAL,
        ));

        $this->render("post", array(
            "model" => $model,
            "nodes" => $nodes,
        ));
    }

    /**
     * [actionIndex description]
     * @return [type] [description]
     */
    public function actionIndex()
    {
        $nodes = Node::model()->findAllByAttributes(array(
            "status" => Node::STATUS_NORMAL,
        ));

        $model = new Post('search');
        $model->unsetAttributes();

        if (isset($_GET['Post'])) {
            $model->attributes = $_GET['Post'];
        }
        
        $model->status = Post::STATUS_NORMAL;

        $this->render("index", array(
            "nodes" => $nodes,
            "model" => $model,
        ));
    }

    /**
     * [actionLogin description]
     * @return [type] [description]
     */
    public function actionLogin()
    {
        $this->layout = "//layouts/default";

        $model = new LoginForm;
        if (isset($_POST['LoginForm'])) {
            
            $model->attributes = $_POST['LoginForm'];
            if ($model->validate() && $model->login()) {
                $this->redirect(array("home/index"));
            }
        }

        $this->render("login", array(
            'model' => $model,
        ));
    }

    /**
     * [actionRegister description]
     * @return [type] [description]
     */
    public function actionRegister()
    {
        $this->layout = "//layouts/default";

        $model = new User;
        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->validate()) {
                $model->password = CPasswordHelper::hashPassword($model->password);
                if ($model->save()) {
                    $this->redirect($this->createUrl("home/login"));
                }
                
            }
        }

        $this->render("register", array(
            'model' => $model,
        ));
    }

    public function actionNode()
    {

    }

    /**
     * [actionView description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function actionView($id) {

        $userId = (int) Yii::app()->user->id;
        $post = Post::model()->findByPk($id);
        if (empty($post)) {
            throw new CHttpException(404, "该记录不存在或已删除.");
        }

        $comment = new Comment;
        if (isset($_POST['Comment'])) {
            $comment->attributes = $_POST['Comment'];
            $comment->userId = $userId;
            if ($comment->save()) {
                $post->lastUpdateUserId = $userId;
                $post->reply += 1;
                $post->save();
                $this->redirect(array('home/view', 'id' => $post->id));
            }
        }

        $post->hits += 1;
        $post->save();

        $this->render("view", array(
            "model" => $post,
            "comment" => $comment,
        ));
    }

    /**
     * [actionLogout description]
     * @return [type] [description]
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect($this->createUrl("home/index"));
    }
}