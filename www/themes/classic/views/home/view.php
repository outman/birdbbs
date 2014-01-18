<?php 
$userId = (int) Yii::app()->user->id;
$p = new CHtmlPurifier();
$p->options = array('URI.AllowedSchemes'=>array(
    'http' => true,
    'https' => true,
));
?>
<div class="row">
    <div class="col-md-9">
        <ol class="breadcrumb">
            <li><a href="<?php echo $this->createUrl("home/index") ?>">首页</a></li>
            <li><?php echo CHtml::encode(isset($model->node->name)?$model->node->name:"默认"); ?></li>
        </ol>

        <!-- view -->
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-11">
                        <h4><?php echo CHtml::encode($model->title); ?></h4>
                        <span class="light">
                            <?php echo Util::timeElapsedStr($model->createTime); ?>
                            |
                            By <a href="<?php echo $this->createUrl("home/index", array("Post[userId]"=>$model->userId)) ?>"><?php echo CHtml::encode($model->user->username); ?></a>
                            |
                            <?php echo $model->hits; ?> 次点击
                        </span>
                    </div>
                    <div class="col-md-1">
                        <a href="<?php echo $this->createUrl('home/index', array('Post[userId]'=>$model->userId)); ?>" class="pull-right">
                            <?php if ($model->user->email): ?>
                            <img src="<?php echo Util::gavatar($model->user->email); ?>" alt="<?php CHtml::encode($model->user->username); ?>">
                            <?php else: ?>
                            <div class="avatar"></div>
                            <?php endif; ?>  
                        </a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <article>
                        <?php echo $p->purify($model->content); ?>    
                        </article>
                    </div>
                </div>
            </div>
        </div>
        <!-- view // -->
        <!-- comments list -->
        <?php if ($model->comments): ?>
        <div class="panel panel-default">
        <div class="panel-body">
        <?php foreach ($model->comments as $k => $v): ?>
        <div class="row">
            <div class="col-md-1">
                <a href="<?php echo $this->createUrl("home/index", array('Post[userId]' => $v->userId)); ?>">
                    <?php if ($v->user->email): ?>
                    <img src="<?php echo Util::gavatar($v->user->email); ?>" alt="<?php CHtml::encode($v->user->username); ?>">
                    <?php else: ?>
                    <div class="avatar"></div>
                    <?php endif; ?>   
                </a>
            </div>
            <div class="col-md-11">
                <div class="row">
                    <div class="col-md-11">
                        <a group="reply" href="javascript:;"><?php echo CHtml::encode($v->user->username); ?></a>
                        <span class="light"><?php echo Util::timeElapsedStr($v->createTime); ?></span>
                        <?php if ($v->userId == $userId): ?>
                        <a href="<?php echo $this->createUrl("home/delcomment", array("id"=>$v->id)); ?>">[删除]</a>
                        <?php endif; ?>
                        <article>
                            <?php echo $p->purify($v->content); ?>
                        </article>
                    </div>
                    <div class="col-md-1">
                        <span class="badge">#<?php echo ($k + 1); ?></span>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <?php endforeach; ?>
        </div>
        </div>
        <?php else: ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning">暂时没有回复.</div>
            </div>
        </div>
        <?php endif; ?>
        <!-- comments list // -->

        <!-- comment -->
        <?php if (!Yii::app()->user->isGuest): ?>
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'comment-form',
        )); ?>
        <?php echo $form->hiddenField($comment, 'postId', array('value' => $model->id)); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="light">支持 Markdown</span>
            </div>
            <div class="panel-body">
                <?php echo $form->textArea($comment, 'content', array('class'=>'form-control', 'style'=>'height:100px;resize:none;')); ?>
                <?php echo $form->error($comment, 'content', array('class'=>'help-block')); ?>
            </div>
            <div class="panel-footer">
                <input type="submit" class="btn btn-primary" value="回复">
            </div>
        </div>
        <?php $this->endWidget(); ?>
        <?php endif; ?>
        <!-- comment // -->

    </div>
    <div class="col-md-3">
    <?php if (Yii::app()->user->isGuest): ?>
    <?php $this->widget("SideLoginWidget"); ?>
    <?php else: ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <a href="<?php echo $this->createUrl("home/post") ?>" class="btn btn-block btn-primary">发表话题</a>
        </div>
    </div>
    <?php $this->widget("SideUserWidget"); ?>
    <?php endif; ?>
    <?php $this->widget("SideHotPostWidget"); ?>
    <?php $this->widget("SideSiteWidget"); ?>
    <?php $this->widget("SideOutlinkWidget"); ?>
    </div>
</div>
<script type="text/javascript">
$(function(){
    $('a[group="reply"]').on('click', function(){
        var txt = "@" + $(this).text();
        var obj = document.getElementById('Comment_content');
        var content = $.trim(obj.value.replace(txt, ''));
        content = (content ? (content + " "): ("")) + txt + " ";
        obj.value = content;
        obj.focus();

        var len = content.length;
        if (document.selection) {
            var sel = obj.createTextRange();
            sel.moveStart('character',len);
            sel.collapse();
            sel.select();
        }
        else if (typeof obj.selectionStart == 'number' && typeof obj.selectionEnd == 'number') {
            obj.selectionStart = obj.selectionEnd = len;
        }
    });
});
</script>