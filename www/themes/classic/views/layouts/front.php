<?php $this->beginContent('//layouts/layout'); ?>
<div class="navbar navbar-fixed-top navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo Yii::app()->request->baseUrl; ?>/"><?php echo CHtml::encode(Util::config('site_title')); ?></a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo Yii::app()->createUrl("home/index") ?>">首页</a></li>
                <?php $this->widget('NodeNavWidget'); ?>
            </ul>
            <ul class="nav navbar-nav pull-right">
                <?php if (Yii::app()->user->isGuest): ?>
                <li><a href="<?php echo Yii::app()->createUrl("home/login"); ?>">登录</a></li>
                <li><a href="<?php echo Yii::app()->createUrl("home/register"); ?>">注册</a></li>
                <?php else: ?>
                <li>
                    <a href="<?php echo Yii::app()->createUrl("home/user"); ?>"><?php echo CHtml::encode(Yii::app()->user->name); ?></a>
                </li>
                <li><a href="<?php echo Yii::app()->createUrl("home/logout") ?>">退出</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<div class="container">
<?php echo $content; ?>
</div>
<?php
$this->endContent();