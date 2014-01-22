<?php 

class AjaxController extends FrontController
{
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
                'actions' => array('postView'),
            ),
        );
    }

    public function actionPostView($id)
    {
        $ret = array(
            'code' => 1000,
            'message' => '',
        );
        $affected = Post::model()->updateByPk($id,
            array(
                'hits' => new CDbExpression('hits + 1')
            ), 
            'id = :id', 
            array(
                ":id" => $id
            ));

        if (!$affected) {
            $ret['code'] = 10001;
        }

        echo json_encode($ret);
        Yii::app()->end();
    }
}