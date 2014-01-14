<?php 

class Util {

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
}