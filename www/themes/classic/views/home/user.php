<?php 
$dataProvider = $model->search();
$data = $dataProvider->getData();
$page = $dataProvider->getPagination(); ?>
<div class="row">
    <div class="col-md-9">
        <ul class="nav nav-tabs">
            <li class="active"><a href="<?php echo $this->createUrl("home/user"); ?>" class="label label-default">我的帖子</a></li>
            <li><a href="<?php echo $this->createUrl("home/comment"); ?>" class="label label-default">我的回复</a></li>
            <li><a href="<?php echo $this->createUrl("home/info") ?>" class="label label-default">我的资料</a></li>
            <li><a href="<?php echo $this->createUrl("home/password") ?>" class="label label-default">修改密码</a></li>
        </ul>
        
        <div class="panel panel-default">
            <ul class="list-group">
                <li class="list-group-item">
                    <span class="label label-default">ID</span>
                    <span>标题</span>
                    <span class="badge">操作</span>
                </li>
            <?php if ($data): ?>
            <?php foreach ($data as $key => $v): ?>
                <li class="list-group-item">
                    <span class="label label-default"><?php echo $v->id; ?></span>
                    <span><a target="_blank" href="<?php echo $this->createUrl("home/view", array("id"=>$v->id)) ?>"><?php echo CHtml::encode($v->title); ?></a></span>
                    <span class="badge">
                        <a style="color:#fff;" href="<?php echo $this->createUrl("home/delete", array("id"=>$v->id)); ?>">删除</a>
                    </span>
                </li>
            <?php endforeach; ?>
            <?php else: ?>
                <li class="list-group-item">暂时没有数据.</li>
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