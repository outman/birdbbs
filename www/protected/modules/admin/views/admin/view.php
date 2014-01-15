<div class="row">
    <div class="col-md-12">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo $this->createUrl("default/index"); ?>">Dashboard</a></li>
                <li><a href="<?php echo $this->createUrl("admin"); ?>">管理员管理</a></li>
                <li class="active">浏览管理员</li>
                <li class="pull-right">
                    <a class="btn btn-xs btn-primary" href="<?php echo $this->createUrl("admin"); ?>">返回列表</a>
                </li>
            </ol>
        </div>
        <div class="row">
            <table class="table table-bordered table-condensed">
            <tr>
                <th style="width: 120px;"><?php echo $model->getAttributeLabel("id"); ?></th>
                <td><?php echo CHtml::encode($model->id); ?></td>
            </tr>
            <tr>
                <th><?php echo $model->getAttributeLabel("email"); ?></th>
                <td><?php echo CHtml::encode($model->email); ?></td>
            </tr>
            <tr>
                <th><?php echo $model->getAttributeLabel("status"); ?></th>
                <td><?php echo CHtml::encode($model->displayStatus()); ?></td>
            </tr>
            <tr>
                <th><?php echo $model->getAttributeLabel("loginIp"); ?></th>
                <td><?php echo CHtml::encode($model->loginIp); ?></td>
            </tr>
            <tr>
                <th><?php echo $model->getAttributeLabel("createTime"); ?></th>
                <td><?php echo CHtml::encode($model->createTime?Util::timeElapsedStr($model->createTime):"-"); ?></td>
            </tr>
            <tr>
                <th><?php echo $model->getAttributeLabel("updateTime"); ?></th>
                <td><?php echo CHtml::encode($model->updateTime?Util::timeElapsedStr($model->updateTime):"-"); ?></td>
            </tr>
                        </table>
        </div>
        <div class="row">
            <a class="btn btn-primary" href="<?php echo $this->createUrl("admin"); ?>">返回列表</a>
        </div>
    </div>
</div>