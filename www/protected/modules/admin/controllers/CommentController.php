<?php

class CommentController extends BackendController
{
    public $defaultAction = "admin";

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
        $this->pageTitle = Yii::t('zh_CN', 'PAGE_TITLE_COMMENT');
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
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Comment('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Comment']))
            $model->attributes=$_GET['Comment'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Comment the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Comment::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404, Yii::t('zh_CN', 'HTTP_STATUS_404'));
        return $model;
    }

}
