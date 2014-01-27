<?php

class ForgetController extends FrontController
{
    const MAX_TIME = 86400;

    public $layout = "//layouts/default";
    public function init()
    {
        $this->pageTitle = Yii::t('zh_CN', 'PAGE_TITLE_FORGET');
    }

    public function actionIndex()
    {
        $model = new Forget('post');
        if (isset($_POST['Forget'])) {

            $model->attributes = $_POST['Forget'];
            if ($model->validate()) {

                $user = User::model()->findByAttributes(array('email' => $model->email));
                if (empty($user)) {
                    $notice = 'FORGET_PASSWORD_USER_UNEXISTS';
                }
                else {
                    $model->token = Util::randmd5();
                    $model->expire = time() + 24*3600;
                    $model->status = Forget::STATUS_NORMAL;
                    $notice = 'FORGET_PASSWORD_RESENT_FAILED';                
                    if ($model->save()) {
                        
                        $link = Yii::app()->request->getBaseUrl(true) . $this->createUrl("forget/code", array('token' => $model->token, 'email' => $model->email));
                        $html = $this->renderPartial("mail", array(
                            'link' => CHtml::link($link, $link),
                        ), true);
                        
                        if ($this->sentEmail($model->email, $html)) {
                            $notice = 'FORGET_PASSWORD_RESENT_SUCCESS';    
                        }
                        else {
                            Yii::log($notice . '|' . $model->email . '|' . $model->token, 'error');
                        }
                    }
                }
                
                Yii::app()->user->setFlash(":notice", Yii::t('zh_CN', $notice));
                $this->redirect($this->createUrl("forget/index"));
            }
        }

        $this->render("index", array('model' => $model));
    }

    public function actionCode($token, $email)
    {
        if (empty($token) || empty($email)) {
            throw new CHttpException(404, Yii::t('zh_CN', 'HTTP_STATUS_404'));
        }

        $criteria = new CDbCriteria;
        $criteria->compare('email', $email);
        $criteria->compare('status', Forget::STATUS_NORMAL);
        $criteria->order = "id desc";

        $model = Forget::model()->find($criteria);
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('zh_CN', 'HTTP_STATUS_404'));
        }

        if ((time() - $model->expire) > self::MAX_TIME) {
            throw new CHttpException(403, Yii::t('zh_CN', 'FORGET_PASSWORD_TOKEN_EXPIRED'));
        }

        if ($model->token != $token) {
            throw new CHttpException(403, Yii::t('zh_CN', 'FORGET_PASSWORD_TOKEN_INVALID'));
        }

        if (Yii::app()->request->isPostRequest) {

            $password = Yii::app()->request->getPost('password');
            $password = trim($password);
            $len = strlen($password);

            if ($len >=5 && $len <= 20) {
                $user = User::model()->findByAttributes(array(
                    'email' => $email,
                ));

                if ($user) {
                    $user->password = CPasswordHelper::hashPassword($password);
                    if ($user->save()) {

                        Forget::model()->updateAll(array(
                            'status' => Forget::STATUS_FROZEN,
                        ),
                        'email = :email',
                        array(
                            ':email' => $email,
                        ));

                        Yii::app()->user->setFlash(':notice', Yii::t('zh_CN', 'FORGET_PASSWORD_OPT_SUCCESS'));
                        $this->redirect($this->createUrl("home/login"));
                    }
                    Yii::app()->user->setFlash(':notice', Yii::t('zh_CN', 'FORGET_PASSWORD_OPT_FAILED'));
                }
                throw new CHttpException(404, 'HTTP_STATUS_404');
                
            }
            else {
                Yii::app()->user->setFlash(':notice', Yii::t('zh_CN', 'FORGET_PASSWORD_LENGTH_INVALID'));
            }
        }

        $this->render('code');
    }


    private function sentEmail($to, $message)
    {
        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host = Yii::app()->params['mail']['smtp'];
        $mail->SMTPAuth = true;
        $mail->Username = Yii::app()->params['mail']['noreply'];
        $mail->Password = Yii::app()->params['mail']['password'];

        $mail->From = Yii::app()->params['mail']['noreply'];
        $mail->FromName = Yii::app()->name;
        $mail->addAddress($to);
        $mail->isHTML(true);
        $mail->Subject = Yii::app()->name . ' - ' . Yii::t('zh_CN', 'FORGET_PASSWORD_MAIL');
        $mail->Body = $message;

        if(!$mail->send()) {
           Yii::log($mail->ErrorInfo, 'error');
           return false;
        }
        return true;
    }
}