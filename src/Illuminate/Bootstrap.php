<?php

/*
 * 脚手架
 */


namespace Illuminate;

use Illuminate\Config\Config;
use Illuminate\Cache\Cache;
use Illuminate\Cache\ICache;
use Illuminate\Database\Database;
use Illuminate\Route;

//基础定义
defined("SIMPLA_PATH") or define("SIMPLA_PATH", dirname(__FILE__));

//引入帮助类
require_once(dirname(__FILE__) . '/Libs/Helper.php');

//引入其他类

class Bootstrap {
	public static function run() {
		//初始化配置文件
		Config::getInstance();

		$appConfig = Config::get('app');
		//初始化主题
		if (!empty($appConfig['theme'])) {
			defined("APP_THEME") or define("APP_THEME", PUBLIC_PATH . '/' . $appConfig['theme']);
		} else {
			defined("APP_THEME") or define("APP_THEME", PUBLIC_PATH);
		}
		//初始化应用名字
		if (!empty($appConfig['theme'])) {
			defined("APP_NAME") or define("APP_NAME", $appConfig['name']);
		} else {
			defined("APP_NAME") or define("APP_NAME", 'Simpla');
		}

		//是否开启错误提示
		if ($appConfig['debug'] == 1) {
			error_reporting(E_ALL);
		} else {
			error_reporting(0);
		}

		//初始化数据库
		Database::getInstance();

		//初始化缓存
		ICache::getInstance();
		Cache::getInstance();

		//路由处理
		Route::check();
	}
}