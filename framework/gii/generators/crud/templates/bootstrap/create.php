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
        <?php echo "<?php \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>
        </div>
    </div>
</div>

