<div class="row">
    <div class="col-md-12">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3>错误：</h3>
            </div>
            <div class="panel-body">
                <div class="alert alert-danger">
                    <?php echo CHtml::encode($message); ?>
                </div>
            </div>
            <div class="panel-footer">
                <a class="btn btn-default" href="mailto:<?php echo Yii::app()->params['adminEmail']; ?>">联系管理员</a>
                <a class="btn btn-default" href="<?php echo $this->createUrl("home/index"); ?>">返回首页</a>
            </div>
        </div>
    </div>
</div>