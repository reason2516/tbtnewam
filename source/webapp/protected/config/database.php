<?php

// This is the database connection configuration.
return array(
//	'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
    'connectionString' => 'mysql:host=127.0.0.1;dbname=testdb',
    'emulatePrepare' => true,
    'username' => 'root',
    'password' => '123456',
    'charset' => 'utf8',
    'tablePrefix' => 'am_', //加入前缀名称fc_
    'enableProfiling' => true,
    'enableParamLogging' => true,
);
