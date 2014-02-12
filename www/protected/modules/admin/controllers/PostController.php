<?php

class PostController extends BackendController
{
    public $defaultAction = "admin";
    public function init() {
        parent::init();
        $this->pageTitle = Yii::t('zh_CN', 'PAGE_TITLE_POST_ADMIN');
    }
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
                'allow',
                'users'=>array('@'),
            ),
            array(
                'deny',
            )
        );
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $model = $this->loadModel($id);
        $model->status = Post::STATUS_FROZEN;
        $model->save(false);

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Post('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Post']))
            $model->attributes=$_GET['Post'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Post the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Post::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404, Yii::t('zh_CN', 'HTTP_STATUS_404'));
        return $model;
    }

    /**
     * 帖子置顶
     * @return [type] [description]
     */
    public function actionUp() {

        $ret = array(
            'code' => 201,
            'opts' => 1,
        );
        
        if (Yii::app()->request->isAjaxRequest) {

            $id = (int) Yii::app()->request->getPost('id');
            $model = Post::model()->findByPk($id);
            if (!empty($model)) {


                if ($model->sort > 0) {
                    $ret['opts'] = 2;
                    $model->sort = 0;
                }
                else {
                    $model->sort = time();
                }

                if ($model->save()) {
                    $ret['code'] = 200;
                }
            }
        }

        echo json_encode($ret);
        Yii::app()->end();
    }
}
