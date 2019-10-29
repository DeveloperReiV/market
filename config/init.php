<?php

define("DEBUG", true);
define("ROOT", dirname(__DIR__));
define("WWW", ROOT . "/public");
define("APP", ROOT . "/app");
define("CORE", ROOT . "/vendor/market/core");
define("LIBS", ROOT . "/vendor/market/core/libs");
define("CACHE", ROOT . "/tmp/cache");
define("CONFIG", ROOT . "/config");
define("LAYOUT", "luxury_watches");

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != "off" ? "https://" : "http://";
$app_path = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];		//Полный путь к индекснему файлу public/index.php
$app_path = preg_replace("#[^/]+$#", "", $app_path);		//Убираем из пути index.php (регулярка - все, кроме / начиная с конца строки )
$app_path = str_replace("/public/", "", $app_path);			//Убираем /public
define("PATH", $app_path);
define("ADMIN", PATH . "/admin");

require_once ROOT . "/vendor/autoload.php";