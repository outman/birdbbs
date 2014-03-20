<?php
class ThirdPlatformWidget extends CWidget {
    
    public function run() {

        $sinaLoginUrl = $qqLoginUrl = "";

        if (isset(Yii::app()->params['sina'])) {
            $sina = new SaeTOAuthV2(Yii::app()->params['sina']['appKey'], Yii::app()->params['sina']['appSecrectKey']);
            $sinaLoginUrl = $sina->getAuthorizeURL(Yii::app()->params['sina']['callbackUrl']);
        }

        $this->render('thirdplatform', array(
            'sinaLoginUrl' => $sinaLoginUrl,
            'qqLoginUrl' => $qqLoginUrl,
        ));
    }
}