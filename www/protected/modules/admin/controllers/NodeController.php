<?php

class NodeController extends BackendController
{

    public function init()
    {
        parent::init();
        $this->pageTitle = Yii::t('zh_CN', 'PAGE_TITLE_NODE');
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
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new Node;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Node']))
        {
            $model->attributes=$_POST['Node'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Node']))
        {
            $model->attributes=$_POST['Node'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
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
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Node');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Node('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Node']))
            $model->attributes=$_GET['Node'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Node the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Node::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404, Yii::t('zh_CN', 'HTTP_STATUS_404'));
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Node $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='node-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
