<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>重置密码</h4>
            </div>
            <div class="panel-body">
                <?php echo CHtml::beginForm($this->createUrl("forget/code", array(
                    'token'=>Yii::app()->request->getQuery('token'),
                    'email'=>Yii::app()->request->getQuery('email'))), 'POST', array(
                    'id' => 'login-form',
                    'role'=>'form',
                )); ?>
                
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="输入新密码">
                </div>
                <div class="form-group">
                    <input type="submit" value="确认修改" class="btn btn-primary">
                </div>
                <?php echo CHtml::endForm(); ?>
                
                <?php if (Yii::app()->user->hasFlash(':notice')): ?>
                <div class="alert alert-warning small">
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