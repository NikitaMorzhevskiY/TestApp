<?php 




session_start();

require_once __DIR__. '/../vendor/autoload.php';
require dirname(__DIR__) . '/config/config.php';
require_once __DIR__ . '/bootstrap.php';
require CORE . '/funcs.php';

$db= \myfrm\App::get('\myfrm\Db');
dump($db);

dump(db());
die;
//require CORE .'/classes/Db.php';

$db_config = require CONFIG . '/db.php';
$db = (Db::getInstance())->getConnection($db_config);




// require CORE .'/router.php';
$router = new \myfrm\Router();
require CONFIG .'/routes.php';

$router->match();


 