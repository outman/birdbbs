<div class="row">
    <div class="col-md-9">
        <ul class="nav nav-tabs">
            <li><a href="<?php echo $this->createUrl("home/user"); ?>" class="label label-default">我的帖子</a></li>
            <li><a href="<?php echo $this->createUrl("home/comment"); ?>" class="label label-default">我的回复</a></li>
            <li class="active"><a href="<?php echo $this->createUrl("home/info") ?>" class="label label-default">我的资料</a></li>
            <li><a href="<?php echo $this->createUrl("home/password") ?>" class="label label-default">修改密码</a></li>
        </ul>
        <div class="panel panel-default">
            <div class="panel-body">
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
                
                <?php if (User::UNDEFINED_PWD !== $model->password): ?>
                <div class="form-group">
                    <?php echo $form->label($model, 'email', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-3">
                        <div class="form-control" style="background: #ccc;">
                        <?php echo CHtml::encode($model->email); ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <div class="form-group">
                    <?php echo $form->label($model, 'qq', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-3">
                        <?php echo $form->textField($model, 'qq', array('class'=>'form-control')); ?>
                        <?php echo $form->error($model, 'qq', array('class' => 'help-block')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->label($model, 'location', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-3">
                        <?php echo $form->textField($model, 'location', array('class'=>'form-control')); ?>
                        <?php echo $form->error($model, 'location', array('class' => 'help-block')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->label($model, 'flag', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->textField($model, 'flag', array('class'=>'form-control')); ?>
                        <?php echo $form->error($model, 'flag', array('class' => 'help-block')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->label($model, 'siteUrl', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-6">
                        <?php echo $form->textField($model, 'siteUrl', array('class'=>'form-control')); ?>
                        <?php echo $form->error($model, 'siteUrl', array('class' => 'help-block')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->label($model, 'intro', array('class' => 'col-sm-2 control-label')); ?>
                    <div class="col-sm-7">
                        <?php echo $form->textArea($model, 'intro', array('class'=>'form-control')); ?>
                        <?php echo $form->error($model, 'intro', array('class' => 'help-block')); ?>
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
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <?php $this->widget("SideHotPostWidget"); ?>
        <?php $this->widget("SideSiteWidget"); ?>
        <?php $this->widget("SideOutlinkWidget"); ?>
    </div>
</div>