<?php 
class SideUserWidget extends CWidget {


    public function run()
    {
        $uid =  (int) Yii::app()->user->id;
        $criteria = new CDbCriteria;
        $criteria->compare('userId' , $uid);

        $model = User::model()->findByPk($uid);

        $user['avatar'] = $model->avatar ? $model->avatar : Util::gavatar($model->email, 36);
        $user['post'] = Post::model()->count($criteria);
        $user['comment'] = Comment::model()->count($criteria);

        $this->render("sideuser", array(
            'user' => $user,
        ));
    }
}