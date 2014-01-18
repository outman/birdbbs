<div class="panel panel-default">
    <div class="panel-heading">
        <span>友情链接</span>
    </div>
    <div class="panel-body">
        <ul style="padding-left: 16px;">
            <?php if ($link) foreach ($link as $v): ?>
            <li><a target="_blank" href="<?php echo CHtml::encode($v->url); ?>"><?php echo CHtml::encode($v->name); ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>