<?php 

class UploadController extends FrontController {

    public function filters()
    {
        return array('accessControl');
    }

    public function accessRules()
    {
        return array(
            array(
                'deny',
                'actions' => array('index'),
                'users' => array('?'),
            ),
        );
    }

    /**
     * [$allowType description]
     * @var array
     */
    private $allowType = array(
        'image/png' ,
        'image/jpeg',
        'image/gif',
        'image/jpg',
    );

    /**
     * [actionIndex description]
     * @return [type] [description]
     */
    public function actionIndex()
    {
        $ret = array(
            'error' => 1,
            'message' => Yii::t('zh_CN', 'UPLOAD_FAILED'),
        );

        if (!isset($_FILES['upload']) 
            || $_FILES['upload']['error'] > 0) {
            echo CJSON::encode($ret);
            Yii::app()->end();
        }

        $tmpName = $_FILES['upload']['tmp_name'];
        
        if (!is_uploaded_file($tmpName)) {
            echo CJSON::encode($ret);
            Yii::app()->end();
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime  = strtolower(finfo_file($finfo, $tmpName));
        finfo_close($finfo);

        if (!in_array($mime, $this->allowType)) {
            $ret['message'] = Yii::t('zh_CN', 'UPLOAD_TYPE');
            echo CJSON::encode($ret);
            Yii::app()->end();
        }

        $ext  = array_pop(explode('.', $_FILES['upload']['name']));
        $base = dirname(Yii::app()->basePath);
        $path = 'upload/' . date("Y/m/d");
        $dir  = $base . '/' . $path;

        if (!file_exists($dir) && !is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        $newFileName = md5(uniqid('buxiangshuo.cn', true)) . ".{$ext}";
        if (!move_uploaded_file($tmpName, "{$dir}/{$newFileName}")) {
            echo CJSON::encode($ret);
            Yii::app()->end();
        }

        $attachment = new Attachment;
        $attachment->path = "{$path}/{$newFileName}";
        $attachment->name = $newFileName;
        $attachment->mime = $mime;
        $attachment->size = $_FILES['upload']['size'];
        $attachment->url  = Yii::app()->request->getBaseUrl(true);

        if ($attachment->save()) {
            $ret['url']   = $attachment->url . '/' . $attachment->path;
            $ret['error'] = 0;
        }
        
        echo CJSON::encode($ret);
        Yii::app()->end();
    }
}