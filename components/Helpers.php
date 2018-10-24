<?php


namespace app\components;

/**
 * General app helper.
 *
 * @author Damian Brończyk <damian.bronczyk@gmail.pl>
 */
class Helpers
{
    public static function cutThis($str, $limit = 100, $strip = false)
    {
        $needles = [' ', '_', '-'];

        $str = str_replace($needles, " ", $str);

        $str = ($strip == true) ? strip_tags($str) : $str;
        if (strlen($str) > $limit) {
            $str = substr($str, 0, $limit - 3);
            return (substr($str, 0, strrpos($str, ' ')) . '...');
        }
        return trim($str);
    }
}