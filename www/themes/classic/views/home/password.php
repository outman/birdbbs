<div class="row">
    <div class="col-md-9">
        <ul class="nav nav-tabs">
            <li><a href="<?php echo $this->createUrl("home/user"); ?>" class="label label-default">我的帖子</a></li>
            <li><a href="<?php echo $this->createUrl("home/comment"); ?>" class="label label-default">我的回复</a></li>
            <li><a href="<?php echo $this->createUrl("home/info") ?>" class="label label-default">我的资料</a></li>
            <li class="active"><a href="<?php echo $this->createUrl("home/password") ?>" class="label label-default">修改密码</a></li>
        </ul>
        <div class="panel panel-default">
            <div class="panel-body">
                <?php if ($model->password !== User::UNDEFINED_PWD): ?>
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'user-form',
                    'htmlOptions' => array(
                        'class' => 'form-horizontal',
                        'role' => 'form',
                    ),
                )); ?>

                <div class="form-group">
                    <?php echo $form->label($model, 'username', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-3">
                        <div class="form-control" style="background: #ccc;">
                            <?php echo CHtml::encode($model->username); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->label($model, 'email', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-3">
                        <div class="form-control" style="background: #ccc;">
                        <?php echo CHtml::encode($model->email); ?>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <?php echo $form->label($model, 'password', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-3">
                        <?php echo $form->passwordField($model, 'password', array('class'=>'form-control', 'value' => '')); ?>
                        <?php echo $form->error($model, 'password', array('class' => 'help-block')); ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" class="btn btn-primary" value="修改">
                    </div>
                </div>

                <?php if (Yii::app()->user->hasFlash(":notice")): ?>
                <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo CHtml::encode(Yii::app()->user->getFlash(":notice")); ?>
                </div>
                <?php endif; ?>
                
                <?php $this->endWidget(); ?>
                <?php else: ?>
                <div class="alert alert-warning alert-dismissable">
                    第三方绑定帐号，无需登录密码.
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <?php $this->widget("SideHotPostWidget"); ?>
        <?php $this->widget("SideSiteWidget"); ?>
        <?php $this->widget("SideOutlinkWidget"); ?>
    </div>
</div>