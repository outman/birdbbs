<div class="panel panel-default">
    <div class="panel-heading">
        <a href="<?php echo Yii::app()->createUrl("home/user"); ?>">
            <?php echo CHtml::encode(Yii::app()->user->name); ?>
        </a>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3">
                <a href="<?php echo Yii::app()->createUrl("home/user"); ?>"><img style="width:36px;" src="<?php echo $user['avatar']; ?>"></a>
            </div>
            <div class="col-md-9">
                <span>发帖：<?php echo $user['post']; ?></span><br>
                <span>回帖：<?php echo $user['comment']; ?></span>
            </div>
        </div>
    </div>
</div>