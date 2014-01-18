<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <span>用户登录</span>
            </div>
            <div class="panel-body">
                <?php $form = $this->beginWidget("CActiveForm", array(
                    'id' => 'login-form',
                    'htmlOptions' => array(
                        'role'=>'form',
                    )
                )); ?>
                <div class="form-group">
                    <?php echo $form->textField($model, 'username', array("class"=>'form-control', 'placeholder'=>'用户名')) ?>
                    <?php echo $form->error($model, 'username', array('class' => 'help-block')) ?>
                </div>
                <div class="form-group">
                    <?php echo $form->passwordField($model, 'password', array("class"=>'form-control', 'placeholder'=>'密码')) ?>
                    <?php echo $form->error($model, 'password', array('class' => 'help-block')) ?>
                </div>
                <div class="checkbox">
                    <label>
                        <?php echo $form->checkBox($model, 'rememberMe'); ?>
                        <?php echo $model->getAttributeLabel("rememberMe"); ?>
                    </label>
                </div>
                <div class="form-group">
                    <input type="submit" value="登录" class="btn btn-primary">
                </div>
                <?php $this->endWidget(); ?>
            </div>
            <div class="panel-footer">
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/">> 返回首页</a>
            </div>
        </div>
    </div>
</div>