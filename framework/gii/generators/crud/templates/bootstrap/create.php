<div class="row">
    <div class="col-md-2">
        <ul class="nav nav-list">
            <li><a href="<?php echo '<?php echo $this->createUrl("admin"); ?>'; ?>">管理</a></li>
            <li><a href="<?php echo '<?php echo $this->createUrl("create"); ?>'; ?>">添加</a></li>
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
        <?php echo "<?php \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>
        </div>
    </div>
</div>

