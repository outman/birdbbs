<?php 
$dataProvider = $model->search();
$data = $dataProvider->getData();
$page = $dataProvider->getPagination(); ?>
<div class="row">
    <div class="col-md-9">
        <ul class="nav nav-tabs">
            <li><a href="<?php echo $this->createUrl("home/user"); ?>" class="label label-default">我的帖子</a></li>
            <li class="active"><a href="<?php echo $this->createUrl("home/comment"); ?>" class="label label-primary">我的回复</a></li>
            <li><a href="<?php echo $this->createUrl("home/info") ?>" class="label label-default">我的资料</a></li>
            <li><a href="<?php echo $this->createUrl("home/password") ?>" class="label label-default">修改密码</a></li>
        </ul>
        <div class="panel panel-default">
            <ul class="list-group">
                <li class="list-group-item">
                    <span class="label label-default">ID</span>
                    <span>标题</span>
                </li>
            <?php if ($data): ?>
            <?php foreach ($data as $key => $v): ?>
                <li class="list-group-item">
                    <span class="label label-default"><?php echo $v->id; ?></span>
                    <a target="_blank" href="<?php echo $this->createUrl("home/view", array("id"=>$v->postId)) ?>"><?php echo CHtml::encode($v->post->title); ?></a>
                </li>
            <?php endforeach; ?>
            <?php else: ?>
                <li class="list-group-item">
                    <span>暂时没有数据.</span>
                </li>
            <?php endif; ?>
            </ul>
        </div>
        <?php $this->widget('CLinkPager', Util::page($page)); ?>
    </div>
    <div class="col-md-3">
        <?php $this->widget("SideHotPostWidget"); ?>
        <?php $this->widget("SideSiteWidget"); ?>
        <?php $this->widget("SideOutlinkWidget"); ?>
    </div>
</div>