<?php
$dataProvider = $model->search();
$data = $dataProvider->getData();
$page = $dataProvider->getPagination();
?>
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
          <?php $form = $this->beginWidget("CActiveForm", array(
            
          )); ?>

          <?php $this->endWidget(); ?>        </div>
        <div class="row">
            <table class="table table-bordered table-condensed">
            <tr>
                        <th><?php echo $model->getAttributeLabel("id"); ?></th>
                        <th><?php echo $model->getAttributeLabel("username"); ?></th>
                        <th><?php echo $model->getAttributeLabel("password"); ?></th>
                        <th><?php echo $model->getAttributeLabel("email"); ?></th>
                        <th><?php echo $model->getAttributeLabel("siteUrl"); ?></th>
                        <th><?php echo $model->getAttributeLabel("qq"); ?></th>
                        <th><?php echo $model->getAttributeLabel("location"); ?></th>
                        <th><?php echo $model->getAttributeLabel("flag"); ?></th>
                        <th><?php echo $model->getAttributeLabel("intro"); ?></th>
                        <th><?php echo $model->getAttributeLabel("status"); ?></th>
                        <th><?php echo $model->getAttributeLabel("avatar"); ?></th>
                        <th><?php echo $model->getAttributeLabel("createTime"); ?></th>
                        <th><?php echo $model->getAttributeLabel("lastIp"); ?></th>
                        </tr>
            <?php  if ($data): ?>
            <?php  foreach ($data as $v): ?>
            <tr>
                            <td><?php echo CHtml::encode($v->id); ?></td>
                            <td><?php echo CHtml::encode($v->username); ?></td>
                            <td><?php echo CHtml::encode($v->password); ?></td>
                            <td><?php echo CHtml::encode($v->email); ?></td>
                            <td><?php echo CHtml::encode($v->siteUrl); ?></td>
                            <td><?php echo CHtml::encode($v->qq); ?></td>
                            <td><?php echo CHtml::encode($v->location); ?></td>
                            <td><?php echo CHtml::encode($v->flag); ?></td>
                            <td><?php echo CHtml::encode($v->intro); ?></td>
                            <td><?php echo CHtml::encode($v->status); ?></td>
                            <td><?php echo CHtml::encode($v->avatar); ?></td>
                            <td><?php echo CHtml::encode($v->createTime); ?></td>
                            <td><?php echo CHtml::encode($v->lastIp); ?></td>
                        </tr>
            <?php endforeach; ?>            <?php else: ?>            <tr>
              <td colspan="99" style="text-align: center;">暂时没有数据。</td>
            </tr>
            <?php endif; ?>            </table>
        </div>
    </div>
</div>
