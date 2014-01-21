<?php 
$dataProvider = $model->search();
$data = $dataProvider->getData();
$page = $dataProvider->getPagination(); ?>
<div class="row">
    <div class="col-md-9">
        <ul class="nav nav-tabs">
            <li class="active"><a href="<?php echo $this->createUrl("home/user"); ?>" class="label label-default">我发的帖子</a></li>
            <li><a href="<?php echo $this->createUrl("home/comment"); ?>" class="label label-default">我参与回复的帖子</a></li>
            <li><a href="<?php echo $this->createUrl("home/info") ?>" class="label label-default">资料</a></li>
        </ul>
        
        <div class="panel panel-default">
            <table class="table table-bordered table-condensed">
                <tr>
                    <td style="width: 92px;">#</td>
                    <td>标题</td>
                    <td style="width: 80px;">操作</td>
                </tr>
            <?php if ($data): ?>
            <?php foreach ($data as $key => $v): ?>
                <tr>
                    <td><?php echo $v->id; ?></td>
                    <td><a target="_blank" href="<?php echo $this->createUrl("home/view", array("id"=>$v->id)) ?>"><?php echo CHtml::encode($v->title); ?></a></td>
                    <td style="text-align: center;">
                        <a href="<?php echo $this->createUrl("home/delete", array("id"=>$v->id)); ?>" class="label label-danger">删除</a>
                    </td>
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