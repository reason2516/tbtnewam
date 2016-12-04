<?php

// This is the database connection configuration.
return array(
//	'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
    'connectionString' => 'mysql:host=localhost;dbname=testdb',
    'emulatePrepare' => true,
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',
    'tablePrefix' => 'am_', //加入前缀名称fc_
    'enableProfiling' => true,
    'enableParamLogging' => true,
);
