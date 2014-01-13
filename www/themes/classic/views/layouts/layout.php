<?php 
$staticUrl = Yii::app()->request->baseUrl; 
$version = "?20140114";
?>
<!DOCTYPE html>
<html lang="zh_CN">
<head>
    <meta charset="utf-8">
    <title> <?php echo CHtml::encode($this->pageTitle); ?> </title>
    <link rel="stylesheet" href="<?php echo $staticUrl; ?>/public/css/bootstrap.min.css" />
    <script type="text/javascript" src="<?php echo $staticUrl; ?>/public/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $staticUrl; ?>/public/js/bootstrap.min.js"></script>
</head>
<body>
<?php echo $content; ?>
</body>
</html>