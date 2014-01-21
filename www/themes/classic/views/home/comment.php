<?php 
$dataProvider = $model->search();
$data = $dataProvider->getData();
$page = $dataProvider->getPagination(); ?>
<div class="row">
    <div class="col-md-9">
        <ul class="nav nav-tabs">
            <li><a href="<?php echo $this->createUrl("home/user"); ?>" class="label label-primary">我发的帖子</a></li>
            <li class="active"><a href="<?php echo $this->createUrl("home/comment"); ?>" class="label label-primary">我参与回复的帖子</a></li>
        </ul>
        <div class="panel panel-default">
            <table class="table table-bordered table-condensed">
                <tr>
                    <td style="width: 92px;">#</td>
                    <td>标题</td>
                </tr>
            <?php if ($data): ?>
            <?php foreach ($data as $key => $v): ?>
                <tr>
                    <td><?php echo $v->postId; ?></td>
                    <td><a target="_blank" href="<?php echo $this->createUrl("home/view", array("id"=>$v->postId)) ?>"><?php echo CHtml::encode($v->post->title); ?></a></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="99">
                    <?php $this->widget('CLinkPager', Util::page($page)); ?>
                </td>
            </tr>
            <?php else: ?>
                <tr>
                    <td colspan="99" style="text-align: center;">暂时没有数据.</td>
                </tr>
            <?php endif; ?>
            </table>
        </div>
    </div>
    <div class="col-md-3">
        <?php $this->widget("SideHotPostWidget"); ?>
        <?php $this->widget("SideSiteWidget"); ?>
        <?php $this->widget("SideOutlinkWidget"); ?>
    </div>
</div>