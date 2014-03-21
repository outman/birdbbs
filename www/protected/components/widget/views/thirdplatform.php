<div class="panel panel-default">
    <div class="panel-heading">
        <span>第三方登录</span>
    </div>
    <div class="panel-body" style="text-align: center;">
        <?php if ($sinaLoginUrl): ?>
        <a href="<?php echo $sinaLoginUrl; ?>"><img class="third-login-btn" src="<?php echo Yii::app()->request->baseUrl; ?>/public/img/weibo_login.png" alt="新浪微博登录"></a>
        <?php endif; ?>
    </div>
</div>