<?php 
$staticUrl = Yii::app()->request->baseUrl; 
$version = "?20140114";
?>
<!DOCTYPE html>
<html lang="zh_CN">
<head>
    <meta charset="utf-8">
    <title> <?php echo CHtml::encode(Yii::app()->name . ' - ' . $this->pageTitle); ?> </title>
    <link rel="stylesheet" href="<?php echo $staticUrl; ?>/public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo $staticUrl; ?>/public/css/style.css" />
    <script type="text/javascript" src="<?php echo $staticUrl; ?>/public/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $staticUrl; ?>/public/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    var siteUrl = <?php echo json_encode(Yii::app()->request->hostInfo); ?>;
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
    <p>&copy; <?php echo date("Y"), '. <a href="http://buxiangshuo.cn">不想说网</a> ', Yii::powered(); ?></p>
</div>
</body>
</html>