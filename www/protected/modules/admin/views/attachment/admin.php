<?php
$formater = new CFormatter;
$dataProvider = $model->search();
$data = $dataProvider->getData();
$page = $dataProvider->getPagination();
?>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo $this->createUrl("default/index"); ?>">Dashboard</a></li>
                <li><a href="<?php echo $this->createUrl("admin") ?>">文件管理</a></li>
                <li class="active">文件列表</li>
            </ol>
        </div>
        <div class="row">
        <?php $form = $this->beginWidget("CActiveForm", array(
                'id' => 'search-form',
                'htmlOptions' => array(
                    'class' => 'form-inline well',
                ),
                'method' => 'GET',
                'action' => $this->createUrl("admin"),
            )); ?>
            <div class="row">
            <div class="col-xs-2">
                <?php echo $form->textField($model, 'id', array('class'=>'form-control', 'placeholder'=>'id')); ?>
            </div>
            <div class="col-xs-2">
                <?php echo $form->textField($model, 'name',array('class'=>'form-control', 'placeholder'=>'名称')); ?>
            </div>
            <input type="submit" class="btn btn-primary" value="搜索">
            </div>
        <?php $this->endWidget(); ?>
        </div>
        <div class="row">
            <table class="table table-bordered table-condensed">
            <tr>
                <th style="width: 80px;"><?php echo $model->getAttributeLabel("id"); ?></th>
                <th><?php echo $model->getAttributeLabel("name"); ?></th>
                <th style="width: 160px;"><?php echo $model->getAttributeLabel("size"); ?></th>
                <th style="width: 300px;"><?php echo $model->getAttributeLabel("mime"); ?></th>
                <th style="width: 60px;"></th>
                </tr>
            <?php  if ($data): ?>
            <?php  foreach ($data as $v): ?>
            <tr>
                <td><?php echo CHtml::encode($v->id); ?></td>
                <td><?php echo CHtml::encode($v->name); ?></td>
                <td><?php echo CHtml::encode($formater->size($v->size)); ?></td>
                <td><?php echo CHtml::encode($v->mime); ?></td>
                <td style="text-align: center;">
                    <div class="btn-group">
                        <a class="btn btn-xs btn-danger" href="<?php echo $this->createUrl("attachment/delete", array("id"=>$v->id)) ?>">删除</a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
              <td colspan="99" style="text-align: center;">暂时没有数据。</td>
            </tr>
            <?php endif; ?>
            </table>
        </div>
        <div class="row">
            <?php $this->widget('CLinkPager', Util::page($page)); ?>
        </div>
    </div>
</div>
