<div class="panel panel-default">
    <div class="panel-heading">
        <span>热门帖子</span>
    </div>
    <ul class="list-group">
        <?php if ($post) foreach ($post as $v): ?>
        <li class="list-group-item"><a href="<?php echo Yii::app()->createUrl("home/view", array("id"=>$v->id)) ?>"><?php echo CHtml::encode($v->title); ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>