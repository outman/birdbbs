<div class="well">
<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
    'id'=>'".$this->class2id($this->modelClass)."-form',
    'htmlOptions' => array(
        'class' => 'form-horizontal',
        'role' => 'form',
    ),
)); ?>\n"; ?>

<?php
foreach($this->tableSchema->columns as $column)
{
    if($column->autoIncrement)
        continue;
?>
    <div class="form-group">
        <?php echo "<?php echo ".$this->generateActiveLabel($this->modelClass,$column)."; ?>\n"; ?>
        <div class="col-sm-6">
        <?php echo "<?php echo ".$this->generateActiveField($this->modelClass,$column)."; ?>\n"; ?>
        <?php echo "<?php echo \$form->error(\$model,'{$column->name}', array('class'=>'help-inline')); ?>\n"; ?>
        </div>
    </div>

<?php
}
?>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-6">
            <?php echo "<?php echo CHtml::submitButton(\$model->isNewRecord ? '添加' : '修改', array('class'=>'btn btn-primary')); ?>\n"; ?>
            <a class="btn btn-default" href="<?php echo '<?php echo $this->createUrl("admin"); ?>'; ?>">返回列表</a>
        </div>
    </div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>
</div>
