<?php $this->beginContent('//layouts/layout'); ?>
<div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo Yii::app()->request->baseUrl; ?>/">不想说</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="<?php echo Yii::app()->createUrl("home/index") ?>">首页</a></li>
                <?php $this->widget('NodeNavWidget'); ?>
            </ul>
            <?php if (!Yii::app()->user->isGuest): ?>
            <ul class="nav navbar-nav pull-right">
                <li class="active">
                    <a href="<?php echo Yii::app()->createUrl("home/user"); ?>"><?php echo CHtml::encode(Yii::app()->user->name); ?></a>
                </li>
                <li><a href="<?php echo Yii::app()->createUrl("home/logout") ?>">退出</a></li>
            </ul>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="container">
<?php echo $content; ?>
</div>
<?php
$this->endContent();