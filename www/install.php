<?php 

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> BirdBBS install - BirdBBS 安装 http://bbs.buxiangshuo.cn </title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <script src="public/js/jquery.min.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <style type="text/css">
    body {
        padding-top: 40px;
    }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4>BirdBBS install - BirdBBS 安装</h4>
            </div>
        </div>
        <div class="panel-body">
            <form action="" class="form-horizontal" role="form" method="POST">
                <div class="form-group">
                    <label for="database" class="col-md-2 control-label">数据库名称</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="database" id="database">
                    </div>
                </div>
                <div class="form-group">
                    <label for="database" class="col-md-2 control-label">数据库用户名</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="database" id="database">
                    </div>
                </div>
                <div class="form-group">
                    <label for="database" class="col-md-2 control-label">数据库密码</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="database" id="database">
                    </div>
                </div>
                <div class="form-group">
                    <label for="database" class="col-md-2 control-label">数据表前缀</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="database" id="database">
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label for="database" class="col-md-2 control-label">管理员邮箱</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="database" id="database">
                    </div>
                    <div class="col-md-4">
                        <span class="help-block">管理员后台登录邮箱，创建后不能删除</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="database" class="col-md-2 control-label">密码</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="database" id="database">
                    </div>
                    <div class="col-md-4">
                        <span class="help-block">管理员后台登录密码</span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-md-3">
                        <input type="submit" class="btn btn-primary" value="安装">
                    </div>
                </div>
            </form>
        </div>
        <div class="panel-footer">
            &copy; 2014 All rights reserved by <a target="_blank" href="http://bbs.buxiangshuo.cn">BirdBBS .</a>
        </div>
    </div>
</div>
</body>
</html>

