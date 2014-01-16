<div class="row">
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
            <?php if ($nodes) foreach ($nodes as $v): ?>
            <a href="<?php echo $this->createUrl("home/node", array("id"=>$v->id)) ?>" class="label label-default"><?php echo CHtml::encode($v->name); ?></a>
            <?php endforeach; ?>
            </div>
            <div class="panel-body">
            Panel content
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <?php //if (!Yii::app()->user->isGuest): ?>
        <div class="panel panel-default">
            <div class="panel-body">
                <p>不想说</p>
                <span>什么都不想说，就当我没来过.</span>
                <hr>
                <div class="login-btn">
                    <div class="btn-group">
                        <a href="<?php echo $this->createUrl("home/login"); ?>" class="btn btn-primary">登录</a>
                        <a href="<?php echo $this->createUrl("home/register"); ?>" class="btn btn-primary">注册</a>
                    </div>
                </div>
            </div>
        </div>
        <?php //else: ?>
        <div class="panel panel-default">
            <div class="panel-body">
                <a href="<?php echo $this->createUrl("home/post") ?>" class="btn btn-block btn-primary">发表话题</a>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="<?php echo $this->createUrl("home/user") ?>"><h5><?php echo Yii::app()->user->name; ?></h5></a>
            </div>
            <div class="panel-body">
                <span>发帖：<a href="">1000</a></span><br>
                <span>回帖：<a href="">353</a></span>
            </div>
        </div>
        <?php //endif; ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <span>热门节点</span>
            </div>
            <div class="panel-body">
                <span>发帖：<a href="">1000</a></span><br>
                <span>回帖：<a href="">353</a></span>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <span>社区动态</span>
            </div>
            <div class="panel-body">
                <span>发帖：<a href="">1000</a></span><br>
                <span>回帖：<a href="">353</a></span>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <span>友情链接</span>
            </div>
            <div class="panel-body">
                <span><a href="">1000</a></span>
                <span><a href="">353</a></span>
            </div>
        </div>
    </div>
</div>