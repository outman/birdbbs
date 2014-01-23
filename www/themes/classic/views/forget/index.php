<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>用户找回密码</h4>
            </div>
            <div class="panel-body">
                <?php $form = $this->beginWidget("CActiveForm", array(
                    'id' => 'login-form',
                    'htmlOptions' => array(
                        'role'=>'form',
                    )
                )); ?>
                <div class="form-group">
                    <?php echo $form->textField($model, 'email', array("class"=>'form-control', 'placeholder'=>'注册的邮箱')) ?>
                    <?php echo $form->error($model, 'email', array('class' => 'help-block')) ?>
                </div>
                <div class="form-group">
                    <input type="submit" value="提交" class="btn btn-primary">
                </div>
                <?php $this->endWidget(); ?>
                <?php if (Yii::app()->user->hasFlash(':notice')): ?>
                <div class="alert alert-warning">
                    <?php echo CHtml::encode(Yii::app()->user->getFlash(':notice')); ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="panel-footer">
                <a href="<?php echo $this->createUrl("home/index") ?>">> 返回首页</a>
            </div>
        </div>
    </div>
</div>