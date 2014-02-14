<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo Util::config('site_title'); ?>
    </div>
    <div class="panel-body">
        <span>什么都不想说，就当我没来过.</span>
        <hr>
        <div class="text-center">
            <div class="btn-group">
                <a href="<?php echo Yii::app()->createUrl("home/login"); ?>" class="btn btn-primary">登录</a>
                <a href="<?php echo Yii::app()->createUrl("home/register"); ?>" class="btn btn-primary">注册</a>
            </div>
        </div>
    </div>
</div>