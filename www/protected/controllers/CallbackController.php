<?php 

class CallbackController extends FrontController {

    public function actionSina() {

        $this->pageTitle = Yii::t('zh_CN', 'PAGE_TITLE_BIND_REGISTER');
        $this->layout = "//layouts/default";

        if (Yii::app()->request->isPostRequest) {

            $user = new User('register');
            $user->attributes = $_POST['User'];
            $user->password   = User::UNDEFINED_PWD;
            $user->email      = Yii::app()->params['mail']['noreply'];
            $user->avatar     = Yii::app()->session['__SINA_AVATAR'];

            if ($user->save()) {

                $platform = Platform::model()->findByAttributes(array(
                    'uniqid' => Yii::app()->session['__SINA_UID'],
                    'platform' => 'sina',
                ));

                if (empty($platform)) {
                    $platform = new Platform;
                    $platform->userId = $user->id;
                    $platform->createTime = time();
                    $platform->platform = 'sina';
                    $platform->uniqid = Yii::app()->session['__SINA_UID'];
                }
                else {
                    $platform->updateTime = time();
                }

                if ($platform->save()) {
                    unset(Yii::app()->session['__SINA_UID'], Yii::app()->session['__SINA_AVATAR']);
                    $userIdentity = new UserIdentity('__SINA_UID', '__SINA_UID');
                    $userIdentity->resetUserInfo($platform->userId, $platform->user->username);
                    Yii::app()->user->login($userIdentity);
                    $this->redirect($this->createUrl("home/index"));
                }
                else {
                    $user->delete();
                }
            }
            
            $this->render('sina', array(
                'user' => $user,
            ));
        }
        else {

            $o = new SaeTOAuthV2(
                Yii::app()->params['sina']['appKey'], 
                Yii::app()->params['sina']['appSecrectKey']
            );

            $code = Yii::app()->request->getQuery('code');
            $keys = array(
                'code' => $code,
                'redirect_uri' => Yii::app()->params['sina']['callbackUrl'],
            );

            $token = null;
            try {
                $token = $o->getAccessToken('code', $keys) ;
            } catch (SaeTOAuthException $e) {
                Yii::log('error', $e->getMessage());
            }

            if ($token) {

                $c = new SaeTClientV2(
                    Yii::app()->params['sina']['appKey'], 
                    Yii::app()->params['sina']['appSecrectKey'],
                    $token['access_token']
                );

                $uidGet = $c->get_uid();
                $uid = $uidGet['uid'];
                $userInfo = $c->show_user_by_id($uid);

                if ($userInfo) {

                    $platformUser = Platform::model()->findByAttributes(array(
                        'uniqid' => $userInfo['id'],
                        'platform' => 'sina',
                    ));

                    if (empty($platformUser) || empty($platformUser->user)) {
                        
                        Yii::app()->session['__SINA_UID'] = $userInfo['id'];
                        Yii::app()->session['__SINA_AVATAR'] = $userInfo['profile_image_url'];
                        
                        $user = new User('register');
                        $user->username = $userInfo['screen_name'];

                        $this->render('sina', array(
                            'user' => $user,
                        ));

                        Yii::app()->end();
                    }
                    else {
                        
                        $platformUser->user->avatar = $userInfo['profile_image_url'];
                        $platformUser->user->save(false);

                        $user = new UserIdentity('__SINA_UID', '__SINA_UID');
                        $user->resetUserInfo($platformUser->userId, $platformUser->user->username);
                        Yii::app()->user->login($user);
                        $this->redirect($this->createUrl("home/index"));
                    }
                }
            }

            throw new CHttpException(403, Yii::t('zh_CN', 'HTTP_STATUS_PLATFORM_403'));
        }
    }
}