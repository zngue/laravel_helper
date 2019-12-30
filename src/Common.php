<?php


namespace Zngue\Helper;


class Common
{
    public static function mobileReg(){
        return '/^1[345789][0-9]{9}$/';
    }
    public static function listPageNum(){
        return 15;
    }
}
