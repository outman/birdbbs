<?php echo "<?php\n"; ?>
$dataProvider = $model->search();
$data = $dataProvider->getData();
$page = $dataProvider->getPagination();
?>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo '<?php echo $this->createUrl("default/index"); ?>'; ?>">Dashboard</a></li>
                <li><a href="#">Library</a></li>
                <li class="active">Data</li>
                <li class="pull-right">
                    <a class="btn btn-xs btn-primary" href="<?php echo '<?php echo $this->createUrl("create"); ?>'; ?>">新建</a>
                </li>
            </ol>
        </div>
        <div class="row">
          <?php echo "<?php "; ?>$form = $this->beginWidget("CActiveForm", array(
            
          )); ?>

          <?php echo '<?php $this->endWidget(); ?>'; ?>
        </div>
        <div class="row">
            <table class="table table-bordered table-condensed">
            <tr>
            <?php foreach ($this->tableSchema->columns as $column): ?>
            <th><?php echo '<?php echo $model->getAttributeLabel("' . $column->name . '"); ?>'; ?></th>
            <?php endforeach; ?>
            </tr>
            <?php echo "<?php "; ?> if ($data): ?>
            <?php echo "<?php "; ?> foreach ($data as $v): ?>
            <tr>
            <?php foreach ($this->tableSchema->columns as $column): ?>
                <td><?php echo '<?php echo CHtml::encode($v->' . $column->name . '); ?>'; ?></td>
            <?php endforeach; ?>
            </tr>
            <?php echo "<?php endforeach; ?>"; ?>
            <?php echo "<?php else: ?>"; ?>
            <tr>
              <td colspan="99" style="text-align: center;">暂时没有数据。</td>
            </tr>
            <?php echo "<?php endif; ?>", "\n"; ?>
            </table>
        </div>
    </div>
</div>
