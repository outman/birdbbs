<div class="panel panel-default">
    <div class="panel-heading">
        <span>第三方登录</span>
    </div>
    <div class="panel-body" style="text-align: center;">
        <?php if ($sinaLoginUrl): ?>
        <a class="btn btn-primary" href="<?php echo $sinaLoginUrl; ?>">新浪微博登录</a>
        <?php endif; ?>
    </div>
</div>