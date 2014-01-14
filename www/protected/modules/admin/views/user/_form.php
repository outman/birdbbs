<div class="well">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id' => 'user-form',
    'htmlOptions' => array(
        'class' => 'form-horizontal',
        'role' => 'form',
    ),
)); ?>
    <div class="form-group">
        <?php echo $form->labelEx($model,'username', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-3">
        <?php echo $form->textField($model,'username',array('class'=>'form-control','maxlength'=>32)); ?>
        <?php echo $form->error($model,'username', array('class'=>'help-block')); ?>
        </div>
    </div>
    <?php if ($model->isNewRecord): ?>
    <div class="form-group">
        <?php echo $form->labelEx($model,'password', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-3">
        <?php echo $form->passwordField($model,'password',array('class'=>'form-control','maxlength'=>128)); ?>
        <?php echo $form->error($model,'password', array('class'=>'help-block')); ?>
        </div>
    </div>
    <?php endif; ?>
    <div class="form-group">
        <?php echo $form->labelEx($model,'email', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-3">
        <?php echo $form->textField($model,'email',array('class'=>'form-control','maxlength'=>128)); ?>
        <?php echo $form->error($model,'email', array('class'=>'help-block')); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'qq', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-3">
        <?php echo $form->textField($model,'qq',array('class'=>'form-control','maxlength'=>20)); ?>
        <?php echo $form->error($model,'qq', array('class'=>'help-block')); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'location', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-3">
        <?php echo $form->textField($model,'location',array('class'=>'form-control','maxlength'=>32)); ?>
        <?php echo $form->error($model,'location', array('class'=>'help-block')); ?>
        </div>
    </div>
    
    <div class="form-group">
        <?php echo $form->labelEx($model,'siteUrl', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-6">
        <?php echo $form->textField($model,'siteUrl',array('class'=>'form-control','maxlength'=>512)); ?>
        <?php echo $form->error($model,'siteUrl', array('class'=>'help-block')); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'flag', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-6">
        <?php echo $form->textField($model,'flag',array('class'=>'form-control','maxlength'=>128)); ?>
        <?php echo $form->error($model,'flag', array('class'=>'help-block')); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'intro', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-6">
        <?php echo $form->textArea($model,'intro',array('class'=>'form-control','maxlength'=>256)); ?>
        <?php echo $form->error($model,'intro', array('class'=>'help-block')); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'status', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-2">
        <?php echo $form->dropDownList($model,'status', $model->statusList(), array('class'=>'form-control')); ?>
        <?php echo $form->error($model,'status', array('class'=>'help-block')); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-6">
            <?php echo CHtml::submitButton($model->isNewRecord ? '添加' : '修改', array('class'=>'btn btn-primary')); ?>
            <a class="btn btn-default" href="<?php echo $this->createUrl("admin"); ?>">返回列表</a>
        </div>
    </div>

<?php $this->endWidget(); ?>
</div>