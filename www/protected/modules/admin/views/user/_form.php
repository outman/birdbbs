<div class="well">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'user-form',
    'htmlOptions' => array(
        'class' => 'form-horizontal',
        'role' => 'form',
    ),
)); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model,'username'); ?>
        <div class="col-sm-6">
        <?php echo $form->textField($model,'username',array('size'=>32,'maxlength'=>32)); ?>
        <?php echo $form->error($model,'username', array('class'=>'help-inline')); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'password'); ?>
        <div class="col-sm-6">
        <?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'password', array('class'=>'help-inline')); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'email'); ?>
        <div class="col-sm-6">
        <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'email', array('class'=>'help-inline')); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'siteUrl'); ?>
        <div class="col-sm-6">
        <?php echo $form->textField($model,'siteUrl',array('size'=>60,'maxlength'=>512)); ?>
        <?php echo $form->error($model,'siteUrl', array('class'=>'help-inline')); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'qq'); ?>
        <div class="col-sm-6">
        <?php echo $form->textField($model,'qq',array('size'=>20,'maxlength'=>20)); ?>
        <?php echo $form->error($model,'qq', array('class'=>'help-inline')); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'location'); ?>
        <div class="col-sm-6">
        <?php echo $form->textField($model,'location',array('size'=>32,'maxlength'=>32)); ?>
        <?php echo $form->error($model,'location', array('class'=>'help-inline')); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'flag'); ?>
        <div class="col-sm-6">
        <?php echo $form->textField($model,'flag',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'flag', array('class'=>'help-inline')); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'intro'); ?>
        <div class="col-sm-6">
        <?php echo $form->textField($model,'intro',array('size'=>60,'maxlength'=>256)); ?>
        <?php echo $form->error($model,'intro', array('class'=>'help-inline')); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'status'); ?>
        <div class="col-sm-6">
        <?php echo $form->textField($model,'status'); ?>
        <?php echo $form->error($model,'status', array('class'=>'help-inline')); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'avatar'); ?>
        <div class="col-sm-6">
        <?php echo $form->textField($model,'avatar',array('size'=>60,'maxlength'=>512)); ?>
        <?php echo $form->error($model,'avatar', array('class'=>'help-inline')); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'createTime'); ?>
        <div class="col-sm-6">
        <?php echo $form->textField($model,'createTime',array('size'=>10,'maxlength'=>10)); ?>
        <?php echo $form->error($model,'createTime', array('class'=>'help-inline')); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'lastIp'); ?>
        <div class="col-sm-6">
        <?php echo $form->textField($model,'lastIp',array('size'=>60,'maxlength'=>64)); ?>
        <?php echo $form->error($model,'lastIp', array('class'=>'help-inline')); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-6">
        <?php echo CHtml::submitButton($model->isNewRecord ? '添加' : '修改', array('class'=>'btn btn-primary')); ?>
        </div>
    </div>

<?php $this->endWidget(); ?>
</div>