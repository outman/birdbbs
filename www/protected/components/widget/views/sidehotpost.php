<div class="panel panel-default">
    <div class="panel-heading">
        <span>热门帖子</span>
    </div>
    <div class="panel-body">
        <ul style="padding-left: 16px;">
        <?php if ($post) foreach ($post as $v): ?>
        <li><a href="<?php echo Yii::app()->createUrl("home/view", array("id"=>$v->id)) ?>"><?php echo CHtml::encode($v->title); ?></a></li>
        <?php endforeach; ?>
        </ul>
    </div>
</div>