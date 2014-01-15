<div class="well">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'admin-form',
    'htmlOptions' => array(
        'class' => 'form-horizontal',
        'role' => 'form',
    ),
)); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model,'email', array('class'=>"col-sm-2 control-label")); ?>
        <div class="col-sm-3">
        <?php echo $form->textField($model,'email',array('class'=>'form-control','maxlength'=>128)); ?>
        <?php echo $form->error($model,'email', array('class'=>'help-inline')); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'password', array('class'=>"col-sm-2 control-label")); ?>
        <div class="col-sm-3">
        <?php echo $form->passwordField($model,'password',array('class'=>'form-control','maxlength'=>128, 'value'=>"")); ?>
        <?php echo $form->error($model,'password', array('class'=>'help-inline')); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'status', array('class'=>"col-sm-2 control-label")); ?>
        <div class="col-sm-3">
        <?php echo $form->dropDownList($model,'status', $model->statusList(), array('class'=>'form-control')); ?>
        <?php echo $form->error($model,'status', array('class'=>'help-inline')); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-3">
            <?php echo CHtml::submitButton($model->isNewRecord ? '添加' : '修改', array('class'=>'btn btn-primary')); ?>
            <a class="btn btn-default" href="<?php echo $this->createUrl("admin"); ?>">返回列表</a>
        </div>
    </div>

<?php $this->endWidget(); ?>
</div>
