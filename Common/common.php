<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2012 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------


/**
 * Think 基础函数库
 * @category   Think
 * @package  Common
 * @author   liu21st <liu21st@gmail.com>
 */

/**
 * 获取模版文件 格式 项目://分组@主题/模块/操作
 * @param string $name 模版资源地址
 * @param string $layer 视图层（目录）名称
 * @return string
 */
function UID(){
    return 1;
}

function URLSafeBase64Encode($str) // URLSafeBase64Encode
{
	$find = array('+', '/');
	$replace = array('-', '_');
	return str_replace($find, $replace, base64_encode($str));
}

