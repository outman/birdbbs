<div class="well">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'node-form',
    'htmlOptions' => array(
        'class' => 'form-horizontal',
        'role' => 'form',
    ),
)); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model,'name', array('class'=>"col-sm-2 control-label")); ?>
        <div class="col-sm-3">
        <?php echo $form->textField($model,'name',array('class'=>"form-control",'maxlength'=>64)); ?>
        <?php echo $form->error($model,'name', array('class'=>'help-inline')); ?>
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
        <?php echo $form->labelEx($model,'sort', array('class'=>"col-sm-2 control-label")); ?>
        <div class="col-sm-3">
        <?php echo $form->textField($model,'sort',array('class'=>'form-control','maxlength'=>10)); ?>
        <?php echo $form->error($model,'sort', array('class'=>'help-inline')); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'description', array('class'=>"col-sm-2 control-label")); ?>
        <div class="col-sm-3">
        <?php echo $form->textArea($model,'description',array('class'=>'form-control','maxlength'=>256, 'style'=>'width:400px;height:60px;resize:none;')); ?>
        <?php echo $form->error($model,'description', array('class'=>'help-inline')); ?>
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
