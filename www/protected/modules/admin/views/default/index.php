<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                24小时发帖量
            </div>
            <div class="panel-body">
                <div id="post"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                24小时回帖量
            </div>
            <div class="panel-body">
                <div id="comment"></div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                30天内注册用户数
            </div>
            <div class="panel-body">
                <div id="user"></div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/public/css/morris-0.4.3.min.css" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/public/js/raphael-min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/public/js/morris-0.4.3.min.js"></script>
<script type="text/javascript">
new Morris.Line({
    element: 'post',
    data: <?php echo CJSON::encode($post); ?>,
    xkey: 'hour',
    ykeys: ['count'],
    labels: ['count']
});
new Morris.Line({
    element: 'comment',
    data: <?php echo CJSON::encode($comment); ?>,
    xkey: 'hour',
    ykeys: ['count'],
    labels: ['count']
});
new Morris.Line({
    element: 'user',
    data: <?php echo CJSON::encode($user); ?>,
    xkey: 'hour',
    ykeys: ['count'],
    labels: ['count']
});
</script>