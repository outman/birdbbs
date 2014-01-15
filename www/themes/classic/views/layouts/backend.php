<?php $this->beginContent('//layouts/admin'); ?>
<div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo Yii::app()->request->baseUrl; ?>/">Birdbbs</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <?php $id = strtolower(Yii::app()->controller->id); ?>
                <li<?php if ($id == "default"): ?> class="active"<?php endif; ?>><a href="<?php echo Yii::app()->createUrl("admin/default/index") ?>">Dashboard</a></li>
                <li<?php if ($id == "user"): ?> class="active"<?php endif; ?>><a href="<?php echo Yii::app()->createUrl("admin/user/admin") ?>">用户管理</a></li>
                <li<?php if ($id == "post"): ?> class="active"<?php endif; ?>><a href="<?php echo Yii::app()->createUrl("admin/post/admin") ?>">帖子管理</a></li>
                <li<?php if ($id == "comment"): ?> class="active"<?php endif; ?>><a href="<?php echo Yii::app()->createUrl("admin/comment/admin") ?>">评论管理</a></li>
                <li<?php if ($id == "attachment"): ?> class="active"<?php endif; ?>><a href="<?php echo Yii::app()->createUrl("admin/attachment/admin") ?>">文件管理</a></li>
                <li<?php if ($id == "admin"): ?> class="active"<?php endif; ?>><a href="<?php echo Yii::app()->createUrl("admin/admin/admin") ?>">管理员</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container">
<?php echo $content; ?>
</div>
<?php
$this->endContent();