<?php
$install_lock_file = __DIR__ . '/protected/data/install.lock';

if (file_exists($install_lock_file)) {
    exit('403 ERROR, SYSTEM INSTALLED. REMOVE install.lock to REINSTALL.');
}

if (version_compare(PHP_VERSION, '5.3.0') < 0) {
    exit('ERROR: PHP VERSION AT LEAST 5.3.0');
}

$need_module = array(
    'mcrypt',
    'gd',
    'mbstring',
    'PDO',
    'pdo_mysql',
);

$load_module = get_loaded_extensions();
foreach ($need_module as $v) {
    if (!in_array($v, $load_module)) {
        exit('ERROR: NEED INSTALL MODULE -> ' . $v);
    }
}

if (isset($_POST['install']) && !empty($_POST)) {

    $default = array(
        'host' => 'localhost',
        'port' => 3306,
        'prefix' => 'bird_',
    );

    $required = array(
        'username',
        'password',
        'dbname',
        'email',
        'adminpwd',
        'smtp',
        'smtpemail',
        'smtppwd',
    );

    foreach ($_POST as $k => $v) {
        $_POST[$k] = trim($v);
    }

    foreach ($required as $v) {
        if (!isset($_POST[$v]) || empty($_POST[$v])) {
            exit('ERROR: THE VALUE REQUIRED -> ' . $v);
        }
    }

    $pattern = '/^[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/';
    if (!preg_match($pattern, $_POST['email'])) {
        exit('ERROR: ADMIN EMAIL INVALID');
    }

    $len = mb_strlen(trim($_POST['adminpwd']));
    if ($len < 6 || $len > 16) {
        exit('ERROR: ADMIN PASSWORD LENGTH BETWEEN 6 - 16');
    }

    $dsn = 'mysql:dbname=%s;host=%s;port=%d';

    try {

        $host = $default['host'];
        if (!empty($_POST['host'])) {
            $host = $_POST['host'];
        }

        $port = $default['port'];
        if (!empty($_POST['port'])) {
            $port = (int) $_POST['port'];
        }

        $file = __DIR__ . '/protected/data/database.sql';
        $sql  = explode(';', file_get_contents($file));

        $dsn  = sprintf($dsn, $_POST['dbname'], $host, $port);
        $pdo = new PDO($dsn, $_POST['username'], $_POST['password'], array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'utf8\''
        ));

        if ($pdo && $sql) {
            
            $prefix = $default['prefix'];
            if (!empty($_POST['prefix'])) {
                $prefix = $_POST['prefix'];
            }

            foreach ($sql as $v) {
                $pdo->exec(str_replace('bbs_', $prefix, $v) . ';');
            }

            require_once dirname(__DIR__) . '/framework/utils/CPasswordHelper.php';
            $hash = CPasswordHelper::hashPassword($_POST['adminpwd']);
            $time = time();

            $admin_sql = "insert into {$prefix}admin (email, password, createTime) values ('%s', '%s', '%d')";
            $admin_sql = sprintf($admin_sql, $_POST['email'], $hash, $time);
            $affected = $pdo->exec($admin_sql);

            if ($affected) {
                
                $conf  = '<?php' . "\n";
                $conf .= '$conf = array();' . "\n" ;
                $conf .= '$conf[\'db\'] = array(' . "\n";
                $conf .= "'connectionString' => 'mysql:host={$host};dbname={$_POST['dbname']}';port={$port}" . "\n";
                $conf .= "'emulatePrepare' => true" . "\n";
                $conf .= "'username' => '{$_POST['username']}'" . "\n";
                $conf .= "'password' => '{$_POST['password']}'" . "\n";
                $conf .= "'charset' => 'utf8'" . "\n";
                $conf .= "'tablePrefix' => '{$prefix}'" . "\n";
                $conf .= "'schemaCachingDuration' => 3600" . "\n";
                $conf .= ');' . "\n";
                $conf .= '$conf[\'params\'] = array(' . "\n";
                $conf .= "'adminEmail'=>'{$_POST['email']}'," . "\n";
                $conf .= "'mail' => array(" . "\n";
                $conf .= "'noreply' => '{$_POST['smtpemail']}'," . "\n";
                $conf .= "'smtp' => '{$_POST['smtp']}'," . "\n";
                $conf .= "'password' => '{$_POST['smtppwd']}'," . "\n";
                $conf .= ");" . "\n";
                
                $status = file_put_contents(__DIR__ . '/protected/config/config.php', $conf);
                if ($status) {
                    file_put_contents(install_lock_file, '');
                    exit('INSTALL SUCCESS. ADMIN PANEL is /admin');
                }
            }
        }
    }
    catch (Exception $e) {
        exit($e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <title> BirdBBS - 系统安装 </title>
    <style type="text/css">
    body {
        padding-top: 16px;
    }
    </style>
    <script type="text/javascript" src="public/js/jquery.min.js"></script>
    <script type="text/javascript" src="public/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><a target="_blank" href="http://www.oschina.net/p/birdbbs">BirdBBS</a>系统安装</h4>
            </div>
            <div class="panel-body">
                <form action="install.php" method="POST">
                    <input type="hidden" name="install" value="1">
                    <label>数据库相关信息，不填写则为默认值</label>
                    <input type="text" name="host" class="form-control" placeholder="链接地址默认为 localhost">
                    <input type="text" name="username" class="form-control" placeholder="用户名">
                    <input type="text" name="password" class="form-control" placeholder="密码">
                    <input type="text" name="dbname" class="form-control" placeholder="数据库名称">
                    <input type="text" name="prefix" class="form-control" placeholder="表前缀默认为 bird_">
                    <input type="text" name="port" class="form-control" placeholder="端口号默认为 3306">
                    <hr>
                    <label>后台管理员</label>
                    <input type="text" name="email" class="form-control" placeholder="设置后台登录的邮箱">
                    <input type="text" name="adminpwd" class="form-control" placeholder="设置后台登录的密码6-16个字符">
                    <hr>
                    <label>邮件发送服务相关（用于用户找回密码等服务）</label>
                    <input type="text" name="smtp" class="form-control" placeholder="邮件发送服务器例如 smtp.exmail.qq.com">
                    <input type="text" name="smtpemail" class="form-control" placeholder="邮箱名">
                    <input type="text" name="smtppwd" class="form-control" placeholder="密码">
                    <hr>
                    <input type="submit" value="填写完毕，马上安装！" class="btn btn-success">
                </form>
            </div>
            <div class="panel-footer">
                &copy; <?php echo date('Y'); ?> All rights reserved by <a target="_blank" href="http://www.oschina.net/p/birdbbs">BirdBBS.</a>
            </div>
        </div>
        </div>
        </div>
    </div>
</body>
</html>