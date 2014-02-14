<?php 

class ConfigController extends BackendController
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
                'users'=>array('@'),
            ),
            array(
                'deny',
            )
        );
    }

    /**
     * [init description]
     * @return [type] [description]
     */
    public function init() {
        parent::init();
        $this->pageTitle = Yii::t('zh_CN', 'PAGE_TITLE_CONFIG');
    }


    function actionAdmin()
    {
        $model = new Config;
        if (Yii::app()->request->isPostRequest) {

            foreach ($model->metas() as $k => $v) {

                $conf = Config::model()->findByAttributes(array('key' => $k));
                if (empty($conf)) {
                    $conf = new Config;
                    $conf->key = $k;
                }

                $conf->value = isset($_POST[$k])?$_POST[$k]:"";
                $conf->save(false);
            }
            
            Yii::app()->user->setFlash(':notice', Yii::t('zh_CN', 'OPTS_SUCCESS'));
            Yii::app()->cache->flush();
            $this->redirect($this->createUrl('admin'));
        }

        $metas = array();
        $all = Config::model()->findAll();
        if ($all) foreach ($all as $v) {
            $metas[$v->key] = $v->value;
        }

        $this->render('admin', array(
            'model' => $model,
            'metas' => $metas,
        ));
    }
}