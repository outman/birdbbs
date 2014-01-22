<div class="row">
    <div class="col-md-12">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo $this->createUrl("default/index") ?>">Dashboard</a></li>
                <li><a href="<?php echo $this->createUrl("user/admin"); ?>">用户管理</a></li>
                <li class="active">查看用户</li>
                <li class="pull-right"><a class="btn btn-xs btn-primary" href="<?php echo $this->createUrl("admin") ?>">返回列表</a></li>
            </ol>
        </div>
        <div class="row">
            <table class="table table-bordered table-condensed">
            <tr>
                <th style="width: 120px;"><?php echo $model->getAttributeLabel("id"); ?></th>
                <td><?php echo CHtml::encode($model->id); ?></td>
            </tr>
            <tr>
                <th><?php echo $model->getAttributeLabel("username"); ?></th>
                <td><?php echo CHtml::encode($model->username); ?></td>
            </tr>
            <tr>
                <th><?php echo $model->getAttributeLabel("email"); ?></th>
                <td><?php echo CHtml::encode($model->email); ?></td>
            </tr>
            <tr>
                <th><?php echo $model->getAttributeLabel("siteUrl"); ?></th>
                <td><?php echo CHtml::encode($model->siteUrl); ?></td>
            </tr>
            <tr>
                <th><?php echo $model->getAttributeLabel("qq"); ?></th>
                <td><?php echo CHtml::encode($model->qq); ?></td>
            </tr>
            <tr>
                <th><?php echo $model->getAttributeLabel("location"); ?></th>
                <td><?php echo CHtml::encode($model->location); ?></td>
            </tr>
            <tr>
                <th><?php echo $model->getAttributeLabel("flag"); ?></th>
                <td><?php echo CHtml::encode($model->flag); ?></td>
            </tr>
            <tr>
                <th><?php echo $model->getAttributeLabel("intro"); ?></th>
                <td><?php echo CHtml::encode($model->intro); ?></td>
            </tr>
            <tr>
                <th><?php echo $model->getAttributeLabel("status"); ?></th>
                <td><?php echo CHtml::encode($model->displayStatus()); ?></td>
            </tr>
            <tr>
                <th><?php echo $model->getAttributeLabel("avatar"); ?></th>
                <td><?php echo CHtml::encode($model->avatar); ?></td>
            </tr>
            <tr>
                <th><?php echo $model->getAttributeLabel("createTime"); ?></th>
                <td><?php echo CHtml::encode(Util::timeElapsedStr($model->createTime)); ?></td>
            </tr>
            <tr>
                <th><?php echo $model->getAttributeLabel("lastIp"); ?></th>
                <td><?php echo CHtml::encode($model->lastIp); ?></td>
            </tr>
        </table>
        </div>
        <div class="row">
            <a class="btn btn-primary" href="<?php echo $this->createUrl("admin"); ?>">返回列表</a>
        </div>
    </div>
</div>