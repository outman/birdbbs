<div class="panel panel-default">
    <div class="panel-heading">
        <span>友情链接</span>
    </div>
    <ul class="list-group">
        <?php if ($link) foreach ($link as $v): ?>
        <li class="list-group-item"><a target="_blank" href="<?php echo CHtml::encode($v->url); ?>"><?php echo CHtml::encode($v->name); ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>