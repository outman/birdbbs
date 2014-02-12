<?php 
$staticUrl = Yii::app()->request->baseUrl; 
$version = "?20140114";
?>
<!DOCTYPE html>
<html lang="zh_CN">
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="<?php echo CHtml::encode(Util::config('site_keywords')); ?>" />
    <meta name="description" content="<?php echo CHtml::encode(Util::config('site_description')); ?>" />
    <title> <?php echo CHtml::encode(Yii::app()->name . ' - ' . $this->pageTitle); ?> </title>
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="stylesheet" href="<?php echo $staticUrl; ?>/public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo $staticUrl; ?>/public/css/style.css" />
    <script type="text/javascript" src="<?php echo $staticUrl; ?>/public/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $staticUrl; ?>/public/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    var IMAGE_UPLOAD_URL = <?php echo json_encode($this->createUrl("upload/index")); ?>;
    </script>
    <!--[if lt IE 9]>
    <script type="text/javascript">
        window.location.href = "<?php echo Yii::app()->createUrl("home/browser"); ?>";
    </script>
    <![endif]-->
</head>
<body>
<?php echo $content; ?>
<div class="container" style="text-align: center;">
    <hr>
    <p>&copy; <?php echo date("Y"), ' ', CHtml::link(Util::config('site_title'), Util::config('site_url')), ' ', Yii::powered(), ' ', CHtml::link(Util::config('site_beian'), 'http://www.miitbeian.gov.cn'); ?></p>
</div>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-15506010-4', 'buxiangshuo.cn');
ga('send', 'pageview');
</script>
</body>
</html>