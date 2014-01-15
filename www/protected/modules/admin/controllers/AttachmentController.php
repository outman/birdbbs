<?php

class AttachmentController extends BackendController
{
    public $defaultAction = "admin";

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
        $model=new Attachment('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Attachment']))
            $model->attributes=$_GET['Attachment'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Attachment the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Attachment::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'该记录不存在.');
        return $model;
    }

}
