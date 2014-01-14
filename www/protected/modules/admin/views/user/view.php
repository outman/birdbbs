<div class="row">
    <div class="col-md-2">
        <ul class="nav nav-list">
            <li><a href="<?php echo $this->createUrl("admin"); ?>">管理</a></li>
            <li><a href="<?php echo $this->createUrl("create"); ?>">添加</a></li>
        </ul>
    </div>
    <div class="col-md-10">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Library</a></li>
                <li class="active">Data</li>
            </ol>
        </div>
        <div class="row">
            <table class="table table-bordered table-condensed">
                        <tr>
                <th><?php echo $model->getAttributes("id"); ?></th>
                <td><?php echo CHtml::encode($model->id); ?></td>
            </tr>
                        <tr>
                <th><?php echo $model->getAttributes("username"); ?></th>
                <td><?php echo CHtml::encode($model->username); ?></td>
            </tr>
                        <tr>
                <th><?php echo $model->getAttributes("password"); ?></th>
                <td><?php echo CHtml::encode($model->password); ?></td>
            </tr>
                        <tr>
                <th><?php echo $model->getAttributes("email"); ?></th>
                <td><?php echo CHtml::encode($model->email); ?></td>
            </tr>
                        <tr>
                <th><?php echo $model->getAttributes("siteUrl"); ?></th>
                <td><?php echo CHtml::encode($model->siteUrl); ?></td>
            </tr>
                        <tr>
                <th><?php echo $model->getAttributes("qq"); ?></th>
                <td><?php echo CHtml::encode($model->qq); ?></td>
            </tr>
                        <tr>
                <th><?php echo $model->getAttributes("location"); ?></th>
                <td><?php echo CHtml::encode($model->location); ?></td>
            </tr>
                        <tr>
                <th><?php echo $model->getAttributes("flag"); ?></th>
                <td><?php echo CHtml::encode($model->flag); ?></td>
            </tr>
                        <tr>
                <th><?php echo $model->getAttributes("intro"); ?></th>
                <td><?php echo CHtml::encode($model->intro); ?></td>
            </tr>
                        <tr>
                <th><?php echo $model->getAttributes("status"); ?></th>
                <td><?php echo CHtml::encode($model->status); ?></td>
            </tr>
                        <tr>
                <th><?php echo $model->getAttributes("avatar"); ?></th>
                <td><?php echo CHtml::encode($model->avatar); ?></td>
            </tr>
                        <tr>
                <th><?php echo $model->getAttributes("createTime"); ?></th>
                <td><?php echo CHtml::encode($model->createTime); ?></td>
            </tr>
                        <tr>
                <th><?php echo $model->getAttributes("lastIp"); ?></th>
                <td><?php echo CHtml::encode($model->lastIp); ?></td>
            </tr>
                        </table>
        </div>
    </div>
</div>