<?php
$dataProvider = $model->search();
$data = $dataProvider->getData();
$page = $dataProvider->getPagination();
?>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo $this->createUrl("default/index"); ?>">Dashboard</a></li>
                <li><a href="<?php echo $this->createUrl("admin") ?>">帖子管理</a></li>
                <li class="active">帖子列表</li>
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
                <?php echo $form->textField($model, 'userId',array('class'=>'form-control', 'placeholder'=>'用户ID')); ?>
            </div>
            <input type="submit" class="btn btn-primary" value="搜索">
            </div>
            <?php $this->endWidget(); ?>
      </div>
        <div class="row">
            <table class="table table-bordered table-condensed">
            <tr>
                <th style="width: 80px;"><?php echo $model->getAttributeLabel("id"); ?></th>
                <th style="width: 180px;">ID/<?php echo $model->getAttributeLabel("userId"); ?></th>
                <th><?php echo $model->getAttributeLabel("title"); ?></th>
                <th style="width: 140px;"><?php echo $model->getAttributeLabel("nodeId"); ?></th>
                <th style="width: 80px;"><?php echo $model->getAttributeLabel("status"); ?></th>
                <th style="width: 80px;"><?php echo $model->getAttributeLabel("createTime"); ?></th>
                <th style="width: 120px;"></th>
            </tr>
            <?php  if ($data): ?>
            <?php  foreach ($data as $v): ?>
            <tr>
                <td><?php echo CHtml::encode($v->id); ?></td>
                <td><?php echo $v->userId, '/', CHtml::encode(isset($v->user->username)?$v->user->username:$v->userId); ?></td>
                <td><a target="_blank" href="<?php echo $this->createUrl("/home/view", array("id"=>$v->id)); ?>"><?php echo CHtml::encode($v->title); ?></a></td>
                <td><?php echo CHtml::encode(isset($v->node->name)?$v->node->name:$v->nodeId); ?></td>
                <td><?php echo CHtml::encode($v->displayStatus()); ?></td>
                <td><?php echo CHtml::encode(Util::timeElapsedStr($v->createTime)); ?></td>
                <td style="text-align: center;">
                    <div class="btn-group">
                        <a class="btn btn-xs btn-info" href="javascript:;" group="up" rel="<?php echo $v->id; ?>"><?php if ($v->sort > 0): ?>取消<?php else: ?>置顶<?php endif; ?></a>
                        <a class="btn btn-xs btn-danger" href="<?php echo $this->createUrl("post/delete", array("id"=>$v->id)) ?>">删除</a>
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
<script type="text/javascript">
$(function(){
    $('a[group="up"]').on('click', function(){
        var _this = this;
        $.ajax({
            url: <?php echo json_encode($this->createUrl("post/up")); ?>,
            type: 'POST',
            data: {id: $(this).attr('rel'), <?php echo Yii::app()->request->csrfTokenName, ': ', json_encode(Yii::app()->request->csrfToken); ?>},
            dataType: 'json'
        })
        .done(function(resp){
            var opts = [];
            opts[1] = "取消";
            opts[2] = "置顶";

            if (resp.code == 200) {
                $(_this).text(opts[resp.opts]);
            }
            else {
                alert("操作失败，请检查.");
            }

            return false;
        })
        .error(function(resp){
            alert("错误：" + resp);
            return false;
        });
    });
});
</script>