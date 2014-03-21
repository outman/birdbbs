<?php 
$dataProvider = $model->search();
$data = $dataProvider->getData();
$page = $dataProvider->getPagination();
?>
<div class="row">
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
            <a class="label label-default" href="<?php echo $this->createUrl("home/index"); ?>">全部</a>
            <?php if ($nodes) foreach ($nodes as $v): ?>
            <a href="<?php echo $this->createUrl("home/index", array("Post[nodeId]"=>$v->id)) ?>" class="label label-default"><?php echo CHtml::encode($v->name); ?></a>
            <?php endforeach; ?>
            </div>
            <div class="panel-body">
                <?php if ($data): ?>
                <?php foreach ($data as $v): ?>
                <div class="row">
                    <div class="col-md-1">
                        <a href="<?php echo $this->createUrl("home/index", array("Post[userId]"=>$v->userId)); ?>">
                        <?php if (isset($v->user->avatar) && (($avatar = $v->user->avatar) || ($avatar = Util::gavatar($v->user->email)))): ?>
                            <img class="img-circle" src="<?php echo $avatar;?>" alt="<?php echo CHtml::encode($v->user->username); ?>">
                        <?php else: ?>
                            <div class="avatar"></div>
                        <?php endif; ?>
                        </a>
                    </div>
                    <div class="col-md-10">
                        <a href="<?php echo $this->createUrl("home/view", array("id" => $v->id)); ?>">
                            <h4 class="post-title">
                                <?php echo CHtml::encode($v->title); ?>
                            </h4>
                        </a>
                        <?php if (isset($v->node->name)): ?>
                        <span><a href="<?php echo $this->createUrl("home/index", array("Post[nodeId]"=>$v->nodeId)); ?>" class="label label-default"><?php echo CHtml::encode($v->node->name); ?></a></span>
                        <?php endif; ?>
                        <?php if (isset($v->user->username)): ?>
                        <span class="light">•</span>
                        <span><a href="<?php echo $this->createUrl("home/index", array("Post[userId]"=>$v->userId)); ?>"><?php echo CHtml::encode($v->user->username); ?></a></span>
                        <?php endif; ?>

                        <span class="light">•</span>
                        <span class="light"><?php echo Util::timeElapsedStr($v->createTime); ?></span>

                        <?php if (isset($v->by->username)): ?>
                        <span class="light">•</span>
                        <span class="light">最后回复来自</span>
                        <span><a class="light" href="<?php echo $this->createUrl("home/index", array("Post[userId]"=>$v->lastUpdateUserId)); ?>"><?php echo CHtml::encode($v->by->username); ?></a></span>
                        <?php endif; ?>
                        <span class="light"><?php echo $v->hits; ?>次浏览</span>
                    </div>
                    <div class="col-md-1">
                        <span class="badge"><?php echo $v->reply; ?> <?php if ($v->sort): ?>T<?php endif; ?></span>
                    </div>
                </div>
                <div class="dashed"></div>
                <?php endforeach; ?>
                <?php else: ?>
                <div class="alert alert-warning">
                    <span>暂时没有话题.</span>
                </div>
                <?php endif; ?>
                <?php $this->widget('CLinkPager', Util::page($page)); ?>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <?php if (Yii::app()->user->isGuest): ?>
        <?php $this->widget("SideLoginWidget"); ?>
        <?php if (isset(Yii::app()->params['sina']) || isset(Yii::app()->params['qq'])): ?>
        <?php $this->widget("ThirdPlatformWidget"); ?>
        <?php endif; ?>
        <?php else: ?>
        <div class="panel panel-default">
            <div class="panel-body">
                <a href="<?php echo $this->createUrl("home/post") ?>" class="btn btn-block btn-primary">发表话题</a>
            </div>
        </div>
        <?php $this->widget("SideUserWidget"); ?>
        <?php endif; ?>
        <?php $this->widget("SideHotPostWidget"); ?>
        <?php $this->widget("SideSiteWidget"); ?>
        <?php $this->widget("SideOutlinkWidget"); ?>
    </div>
</div>