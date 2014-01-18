<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> <?php echo CHtml::encode(Yii::app()->name . ' - ' . '浏览器推荐') ?></title>
    <style type="text/css">
    a {color: #000;}
    div.browser {
        width: 960px;
        margin: 100px auto;
    }
    div.footer {
        margin: 100px auto;
        padding: 20px;
        border-top: 1px solid #ccc;
        text-align: center;
        font-size: 14px;
        color: #000;
    }
    table {
        background: #ccc;
    }
    table td {
        background: #fff;
        padding: 16px;
    }
    div.browser table a {
        color: #000;
        font-size: 18px;
        font-weight: bold;
    }
    </style>
</head>
<body>
<div class="browser">
    <h2>为了刚好的体验，推荐您使用以下浏览器<span style="color:#ff0000;">本站不支持低于IE9版本的IE浏览器</span></h2>
    <table cellspacing="1" cellpadding="1" width="100%">
        <tr>
            <td style="width: 160px;">LOGO</td>
            <td>描述</td>
            <td style="width: 160px;">下载</td>
        </tr>
        <tr>
            <td style="text-align: center;">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/public/img/chrome.png">
            </td>
            <td>Google Chrome 浏览器在简约的外观下，蕴含了尖端的技术，让网络浏览变得更快捷、更安全且更轻松。</td>
            <td><a target="_blank" href="http://www.google.com.hk/intl/zh-CN/chrome/">Google官方下载</a></td>
        </tr>
        <tr>
            <td style="text-align: center;">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/public/img/firefox.png">
            </td>
            <td>
                火狐浏览器（Firefox）全球超过5亿用户使用的浏览器，你也来下载安装吧！
                最新推出了“一键安装”网络安装包，让安装过程更加流畅简便。当然，您依然可以根据自己的需要，在安装过程中自定义安装选项和选择扩展功能。</td>
            <td><a target="_blank" href="http://www.mozilla.org/en-US/firefox/">Firefox官方下载</a></td>
        </tr>
    </table>

    <div class="footer">
        &copy; <?php echo date("Y"); ?> <a href="http://www.buxiangshuo.cn">不想说网.</a>
        <?php echo Yii::powered(); ?>
    </div>
</div>
</body>
</html>