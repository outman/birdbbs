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
        <!-- view -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="<?php echo $this->createUrl("home/index") ?>">首页</a>
                <span>/</span>
                <?php echo CHtml::encode(isset($model->node->name)?$model->node->name:"默认"); ?>
            </div>
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
                            <?php if (isset($model->user->avatar) && (($avatar = $model->user->avatar) || ($avatar = Util::gavatar($model->user->email)))): ?>
                            <img class="img-circle" src="<?php echo $avatar; ?>" alt="<?php echo CHtml::encode($model->user->username); ?>">
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
                    <?php if (isset($v->user->avatar) && ($avatar = $v->user->avatar) || ($avatar = Util::gavatar($v->user->email))): ?>
                    <img class="img-circle" src="<?php echo $avatar; ?>" alt="<?php echo CHtml::encode($v->user->username); ?>">
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
                        <a class="badge" href="<?php echo $this->createUrl("home/delcomment", array("id"=>$v->id)); ?>">删除</a>
                        <?php endif; ?>
                        <a name="go<?php echo $v->id; ?>"></a>
                        <div class="dashed"></div>
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
                <span class="light">回复</span>
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
    <?php if (isset(Yii::app()->params['sina']) || isset(Yii::app()->params['qq'])): ?>
        <?php $this->widget("ThirdPlatformWidget"); ?>
    <?php endif; ?>
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
<?php if (!Yii::app()->user->isGuest): ?>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/public/ke/kindeditor-all-min.js"></script>
<script type="text/javascript">
$(function(){
    var comment;
    var UPLOAD_CSRF_TOKEN = <?php echo json_encode(Yii::app()->request->csrfToken); ?>;
    KindEditor.ready(function(K) {
        comment = K.create('#Comment_content', {
            formatUploadUrl: false,
            themeType: "simple",
            filePostName: 'upload',
            uploadJson: IMAGE_UPLOAD_URL,
            items : [
                'forecolor', 'hilitecolor', 'bold', 'underline', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'image', 'link', 'code'
            ],
            cssData: 'body { font-size: 14px; }',
            extraFileUploadParams: {
                <?php echo Yii::app()->request->csrfTokenName ?>: UPLOAD_CSRF_TOKEN
            }
        });
    });
    $('a[group="reply"]').on('click', function(){
        var txt = "@" + $(this).text();
        var content = txt + "&nbsp;";
        if (!comment.isEmpty()) {
            content = comment.html() + content;
        }
        comment.html(content);
    });
});
</script>
<?php endif; ?>
<script type="text/javascript">
$.ajax(<?php echo json_encode($this->createUrl("ajax/postView", array("id"=>$model->id))); ?>);
</script>