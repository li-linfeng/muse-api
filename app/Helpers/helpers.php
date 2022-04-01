<?php

use Owenoj\LaravelGetId3\GetId3;

if (!function_exists('object2Array')) {
    function object2Array($array)
    {
        if (is_object($array)) {
            $array = (array) $array;
        }
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                $array[$key] = object2Array($value);
            }
        }
        return $array;
    }
}



if (!function_exists('camelize')) {
    function camelize($uncamelizedWords, $separator = '_')
    {
        $uncamelizedWords = $separator . str_replace($separator, " ", strtolower($uncamelizedWords));
        return ltrim(str_replace(" ", "", ucwords($uncamelizedWords)), $separator);
    }
}


if (!function_exists('transformTime')) {
    function transformTime($time)
    {
        $hour = floor($time / 3600) ?: "00";
        $min =  floor(($time - $hour * 3600) / 60) ?: "00";
        $second = ($time - $hour * 3600 - $min * 60) ?: "00";
        return  sprintf("%02d:%02d:%02d", $hour, $min, $second);
    }
}


if (!function_exists('getResourceTotalTime')) {
    function getResourceTotalTime($filename)
    {
        $track = GetId3::fromDiskAndPath('public', "/" . $filename);
        $total_time = $track->getPlaytime();
        $data = explode(":", $total_time);
        switch (count($data)) {
            case 3:
                $total_time =  $data[0] * 3600 + $data[1] * 60 + $data[1];
                break;
            case 2:
                $total_time =  $data[0] * 60 + $data[1];
                break;
            case 1:
                $total_time =  $data[0];
                break;
            default:
                $total_time =  0;
        }
        return $total_time;
    }
}


if (!function_exists('generateShareCode')) {
    function generateShareCode($num)
    {
        // $charSet = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charSet = 'XAE4ZS7JBCD3FGH8KLMWN9PQR6TU2VY';
        // 个位以内，直接返回
        if ($num < strlen($charSet)) {
            return substr($charSet, $num, 1);
        }
        // 递归个位以上的部分
        $high = floor($num / strlen($charSet));
        $unit = $num % strlen($charSet);
        return generateShareCode($high) . substr($charSet, $unit, 1);
    }
}


if (!function_exists('encryptUrl')) {
    function encryptUrl($origin_url, $key)
    {
        $key = md5($key);
        return base64_encode(openssl_encrypt($origin_url, 'AES-256-ECB', $key, OPENSSL_RAW_DATA));
    }
}


if (!function_exists('decryptUrl')) {
    function decryptUrl($url, $key)
    {
        $key = md5($key);
        return openssl_decrypt(base64_decode($url), 'AES-256-ECB', $key, OPENSSL_RAW_DATA);
    }
}
