<?php 

class Util {

    /**
     * [timeElapsedStr description]
     * @param  [type] $ptime [description]
     * @return [type]        [description]
     */
    public static function timeElapsedStr($ptime) {

        $etime = time() - $ptime;

        if ($etime < 1) {
            return '0 秒';
        }

        $array = array(
            12 * 30 * 24 * 60 * 60 => '年',
            30 * 24 * 60 * 60      => '月',
            24 * 60 * 60           => '天',
            60 * 60                => '小时',
            60                     => '分钟',
            1                      => '秒'
        );

        foreach ($array as $secs => $str) {
            $d = $etime / $secs;
            if ($d >= 1) {
                $r = round($d);
                return $r . ' ' . $str . '前';
            }
        }
    }

    /**
     * [timeToStr description]
     * @param  [type] $timeStamp [description]
     * @param  [type] $startTime [description]
     * @return [type]            [description]
     */
    public static function timeToStr($timeStamp, $startTime = null)
    {
        if (empty($timeStamp)) {
            return 0;
        }

        if (null === $startTime) {
            $timeSeconds = $timeStamp;
        }
        else {
            $timeSeconds = $timeStamp  - $startTime;
        }

        $timeArray = array(
            24*3600*365 => "年",
            24*3600 => "天",
            3600 => "小时",
            60 => "分",
        );

        $str = "";
        foreach ($timeArray as $k => $v) {
            $val = floor($timeSeconds / $k);
            if ($val > 0) {
                $str .= $val . $v;
                $timeSeconds = $timeSeconds % $k;
            }
        }
        return $str;
    }

    /**
     * [page description]
     * @param  [type] $pages [description]
     * @return [type]        [description]
     */
    public static function page($pages)
    {
        return array(
            'header'               => '',
            'firstPageLabel'       => '<<',
            'lastPageLabel'        => '>>',
            'firstPageCssClass'    => '',
            'lastPageCssClass'     => '',
            'maxButtonCount'       => 8,
            'nextPageCssClass'     => '',
            'previousPageCssClass' => '',
            'prevPageLabel'        => '<',
            'nextPageLabel'        => '>',
            'selectedPageCssClass' => 'active',
            'pages'                => $pages,
            'internalPageCssClass' => '',
            'hiddenPageCssClass'   => 'disabled',
            'cssFile'              => false,
            'htmlOptions'          => array(
                'class'            => 'pagination'
            ),
        );
    }

    public static function tformat($timeStamp, $format = "Y-m-d H:i")
    {
        if ($timeStamp > 0) {
            return date($format, $timeStamp);
        }
        return "-";
    }

    public static function gavatar($email, $s = 48, $d = 'mm', $r = 'g', $img = false, $attr = array())
    {
        $url = 'http://gravatar.duoshuo.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s={$s}&d={$d}&r={$r}";
        if ($img) {
            $url = '<img src="' . $url . '"';
            foreach ( $atts as $key => $val )
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;
    }

    public static function randmd5()
    {
        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890,;:!?.$/*-+&@_+;./*&?$-!,';
        $str = str_shuffle($str);
        return md5(substr($str, 8, 16) . microtime(true));
    }

    public static function config($key = null)
    {
        $conf = array();
        $config = Config::model()->cache(3600)->findAll();
        if ($config) foreach ($config as $v) {
            $conf[$v->key] = $v->value;
        }

        if ($key !== null) {
            return isset($conf[$key]) ? $conf[$key] : "";
        }
        
        return $conf;
    }

}
