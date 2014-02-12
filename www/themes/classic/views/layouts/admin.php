<?php 
$staticUrl = Yii::app()->request->baseUrl; 
$version = "?20140114";
?>
<!DOCTYPE html>
<html lang="zh_CN">
<head>
    <meta charset="utf-8">
    <title> <?php echo CHtml::encode(Yii::app()->name . ' - ' . $this->pageTitle); ?> </title>
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="stylesheet" href="<?php echo $staticUrl; ?>/public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo $staticUrl; ?>/public/css/admin.css" />
    <script type="text/javascript" src="<?php echo $staticUrl; ?>/public/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $staticUrl; ?>/public/js/bootstrap.min.js"></script>
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
</body>
</html>