<div class="row">
    <div class="col-md-12">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo '<?php echo $this->createUrl("default/index"); ?>'; ?>">Dashboard</a></li>
                <li><a href="#">Library</a></li>
                <li class="active">Data</li>
                <li class="pull-right">
                    <a class="btn btn-xs btn-primary" href="<?php echo '<?php echo $this->createUrl("admin"); ?>'; ?>">返回列表</a>
                </li>
            </ol>
        </div>
        <div class="row">
            <table class="table table-bordered table-condensed">
            <?php foreach ($this->tableSchema->columns as $column): ?>
            <tr>
                <th><?php echo '<?php echo $model->getAttributeLabel("' . $column->name . '"); ?>'; ?></th>
                <td><?php echo '<?php echo CHtml::encode($model->' . $column->name . '); ?>'; ?></td>
            </tr>
            <?php endforeach; ?>
            </table>
        </div>
        <div class="row">
            <a class="btn btn-primary" href="<?php echo '<?php echo $this->createUrl("admin"); ?>'; ?>">返回列表</a>
        </div>
    </div>
</div>