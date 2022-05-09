<?php
const DEFAULT_APP = 'Frontend';

if (!isset($_GET['app']) || !file_exists(__DIR__.'/BlogFram/'.$_GET['app'].'Application.php')) $_GET['app'] = DEFAULT_APP;

require 'BlogFram/SplClassLoader.php';
 
$BlogFramLoader = new SplClassLoader('BlogFram', __DIR__);
$BlogFramLoader->register();

$appClass = 'BlogFram\\'.$_GET['app'].'Application';

$app = new $appClass;
$app->run();