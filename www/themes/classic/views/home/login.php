<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>用户登录</h4>
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

                <?php if (Yii::app()->user->hasFlash(':notice')): ?>
                <div class="alert alert-warning small">
                    <?php echo CHtml::encode(Yii::app()->user->getFlash(':notice')); ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="panel-footer">
                <a href="<?php echo $this->createUrl("home/index") ?>">> 返回首页</a>
                <a class="pull-right" href="<?php echo $this->createUrl("forget/index") ?>">忘记密码？</a>
            </div>
        </div>
    </div>
</div>