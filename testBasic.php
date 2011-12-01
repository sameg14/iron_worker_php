<?php
include("SimpleWorker.class.php");

$name = "testBasic.php-helloPHP-".microtime(true);

$sw = new SimpleWorker('config_sw.ini');
//$sw = new SimpleWorker('config_production.ini');
$sw->debug_enabled = true;

$project_id = ""; # using default project_id from config
$zipName = $name.'.zip';
$files_to_zip = array('testTask.php');
# if true, good; if false, zip creation failed
$zipFile = SimpleWorker::createZip($files_to_zip, $zipName, true);
$res = $sw->postCode($project_id, 'testTask.php', $zipName, $name);
$task_id = $sw->postTask($project_id, $name);
echo "task_id = $task_id \n";
sleep(15);
$log = $sw->getLog($project_id, $task_id);

print_r($log);

