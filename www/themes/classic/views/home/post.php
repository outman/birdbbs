
<div class="row">
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span>发表话题</span>
            </div>
            <div class="panel-body">
                
                <?php if ($model->hasErrors()): ?>
                <div class="alert alert-warning">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php foreach ($model->getErrors() as $v): ?>
                    <?php foreach ($v as $value): ?>
                        <?php echo CHtml::encode($value); ?><br>
                    <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <?php $form = $this->beginWidget("CActiveForm", array(
                    "id" => 'post-form',
                    "htmlOptions" => array(
                        'role' => "form",
                    ),
                )); ?>
                <div class="form-group">
                    <?php echo $form->textField($model, "title", array("class"=>"form-control", "placeholder"=>"标题")); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->dropDownList($model, "nodeId", CHtml::listData($nodes, "id", "name"), array("class"=>"form-control", 'style'=>'width:220px;')); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->hiddenField($model, "content"); ?>
                    <div id="epiceditor"></div>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="发布">
                    <a class="btn btn-default" href="<?php $this->createUrl("index"); ?>">取消</a>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span>发帖说明</span>
            </div>
            <div class="panel-body">
                <ul style="padding-left: 16px;">
                <li>请明确填写标题</li>
                <li>请选择正确的节点</li>
                <li>发帖内容支持Markdown格式</li>
                </ul>
            </div>
        </div>
        <?php $this->widget("SideHotPostWidget"); ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/public/markdown/js/epiceditor.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/public/js/editor.js"></script>