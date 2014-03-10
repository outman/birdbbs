<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
        'host' => '127.0.0.1',
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

            $hash = hash_password($_POST['adminpwd']);
            $time = time();

            $admin_sql = "insert into {$prefix}admin (email, password, createTime) values ('%s', '%s', '%d')";
            $admin_sql = sprintf($admin_sql, $_POST['email'], $hash, $time);
            $affected = $pdo->exec($admin_sql);

            if ($affected) {
                
                $conf  = '<?php' . "\n";
                $conf .= '$CONF = array();' . "\n" ;
                $conf .= '$CONF[\'db\'] = array(' . "\n";
                $conf .= "    'connectionString' => 'mysql:host={$host};dbname={$_POST['dbname']};port={$port}'," . "\n";
                $conf .= "    'emulatePrepare' => true," . "\n";
                $conf .= "    'username' => '{$_POST['username']}'," . "\n";
                $conf .= "    'password' => '{$_POST['password']}'," . "\n";
                $conf .= "    'charset' => 'utf8'," . "\n";
                $conf .= "    'tablePrefix' => '{$prefix}'," . "\n";
                $conf .= "    'schemaCachingDuration' => 3600" . "\n";
                $conf .= ');' . "\n";
                $conf .= '$CONF[\'params\'] = array(' . "\n";
                $conf .= "    'adminEmail'=>'{$_POST['email']}'," . "\n";
                $conf .= "    'mail' => array(" . "\n";
                $conf .= "    'noreply' => '{$_POST['smtpemail']}'," . "\n";
                $conf .= "    'smtp' => '{$_POST['smtp']}'," . "\n";
                $conf .= "    'password' => '{$_POST['smtppwd']}'," . "\n";
                $conf .= "));" . "\n";
                
                $status = file_put_contents(__DIR__ . '/protected/config/config.php', $conf);
                if ($status) {
                    file_put_contents($install_lock_file, '');
                    exit('INSTALL SUCCESS. ADMIN PANEL is /admin');
                }
            }
        }
    }
    catch (Exception $e) {
        exit($e->getMessage());
    }
}

/**
 * [gen_random_bytes description]
 * @param  [type]  $length                  [description]
 * @param  boolean $cryptographicallyStrong [description]
 * @return [type]                           [description]
 */
function gen_random_bytes($length,$cryptographicallyStrong=true)
{
    $bytes='';
    if(function_exists('openssl_random_pseudo_bytes'))
    {
        $bytes=openssl_random_pseudo_bytes($length,$strong);
        if(ex_strlen($bytes)>=$length && ($strong || !$cryptographicallyStrong))
            return ex_substr($bytes,0,$length);
    }

    if(function_exists('mcrypt_create_iv') &&
        ($bytes=mcrypt_create_iv($length, MCRYPT_DEV_URANDOM))!==false &&
        ex_strlen($bytes)>=$length)
    {
        return ex_substr($bytes,0,$length);
    }

    if(($file=@fopen('/dev/urandom','rb'))!==false &&
        ($bytes=@fread($file,$length))!==false &&
        (fclose($file) || true) &&
        ex_strlen($bytes)>=$length)
    {
        return ex_substr($bytes,0,$length);
    }

    $i=0;
    while(ex_strlen($bytes)<$length &&
        ($byte=gen_session_random_block())!==false &&
        ++$i<3)
    {
        $bytes.=$byte;
    }
    if(ex_strlen($bytes)>=$length)
        return ex_substr($bytes,0,$length);

    if ($cryptographicallyStrong)
        return false;

    while(ex_strlen($bytes)<$length)
        $bytes.=gen_pseudo_random_block();
    return ex_substr($bytes,0,$length);
}

/**
 * [gen_pseudo_random_block description]
 * @return [type] [description]
 */
function gen_pseudo_random_block()
{
    $bytes='';

    if (function_exists('openssl_random_pseudo_bytes')
        && ($bytes=openssl_random_pseudo_bytes(512))!==false
        && ex_strlen($bytes)>=512)
    {
        return ex_substr($bytes,0,512);
    }

    for($i=0;$i<32;++$i)
        $bytes.=pack('S',mt_rand(0,0xffff));

    // On UNIX and UNIX-like operating systems the numerical values in `ps`, `uptime` and `iostat`
    // ought to be fairly unpredictable. Gather the non-zero digits from those.
    foreach(array('ps','uptime','iostat') as $command) {
        @exec($command,$commandResult,$retVal);
        if(is_array($commandResult) && !empty($commandResult) && $retVal==0)
            $bytes.=preg_replace('/[^1-9]/','',implode('',$commandResult));
    }

    // Gather the current time's microsecond part. Note: this is only a source of entropy on
    // the first call! If multiple calls are made, the entropy is only as much as the
    // randomness in the time between calls.
    $bytes.=ex_substr(microtime(),2,6);

    // Concatenate everything gathered, mix it with sha512. hash() is part of PHP core and
    // enabled by default but it can be disabled at compile time but we ignore that possibility here.
    return hash('sha512',$bytes,true);
}

function gen_session_random_block()
{
    ini_set('session.entropy_length',20);
    if(ini_get('session.entropy_length')!=20)
        return false;

    // These calls are (supposed to be, according to PHP manual) safe even if
    // there is already an active session for the calling script.
    @session_start();
    @session_regenerate_id();

    $bytes=session_id();
    if(!$bytes)
        return false;

    // $bytes has 20 bytes of entropy but the session manager converts the binary
    // random bytes into something readable. We have to convert that back.
    // SHA-1 should do it without losing entropy.
    return sha1($bytes,true);
}

/**
 * [strlen description]
 * @param  [type] $string [description]
 * @return [type]         [description]
 */
function ex_strlen($string) {
    return mb_strlen($string,'8bit');
}

/**
 * [ex_substr description]
 * @param  [type] $string [description]
 * @param  [type] $start  [description]
 * @param  [type] $length [description]
 * @return [type]         [description]
 */
function ex_substr($string,$start,$length) {
    return mb_substr($string,$start,$length,'8bit');
}

/**
 * [hash_password description]
 * @param  [type] $password [description]
 * @return [type]           [description]
 */
function hash_password($password) {

    $length = 22;
    if(($randomBytes=gen_random_bytes($length+2,true))!==false)
        $random = strtr(ex_substr(base64_encode($randomBytes),0,$length),array('+'=>'_','/'=>'~'));
    else 
        exit("ERROR: Generate salt failed.");

    $salt = sprintf('$2a$%02d$',13).strtr($random,array('_'=>'.','~'=>'/'));
    return crypt($password,$salt);
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