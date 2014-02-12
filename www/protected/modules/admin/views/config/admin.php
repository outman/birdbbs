<div class="row">
    <div class="col-md-12">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo $this->createUrl("default/index"); ?>">Dashboard</a></li>
                <li><a href="<?php echo $this->createUrl("admin") ?>">系统设置</a></li>
                <li class="active">设置参数</li>
            </ol>
        </div>
        <?php if (Yii::app()->user->hasFlash(':notice')): ?>
        <div class="row">
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php echo CHtml::encode(Yii::app()->user->getFlash(':notice')); ?>
            </div>
        </div>
        <?php endif; ?>
        <div class="row">
            <div class="well">
            <?php echo CHtml::form($this->createUrl('admin'), 'POST', array(
                'class' => 'form-horizontal',
                'role' => 'form',
            )); ?>
                <?php foreach ($model->metas() as $k => $v): ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo CHtml::encode($v); ?></label>
                    <div class="col-sm-5">
                        <input type="input" class="form-control" name="<?php echo CHtml::encode($k); ?>" value="<?php echo isset($metas[$k])?$metas[$k]:""; ?>">
                    </div>
                </div>
                <?php endforeach; ?>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" class="btn btn-primary" value="提交保存">
                    </div>
                </div>
            <?php echo CHtml::endForm(); ?>
            </div>
        </div>
    </div>
</div>