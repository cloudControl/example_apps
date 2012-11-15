<?php
/**
 * This is core configuration file.
 *
 * Use it to configure core behaviour of Cake.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * In this file you set up your database connection details.
 *
 * @package       cake.config
 */
/**
 * Database configuration class.
 * You can specify multiple configurations for production, development and testing.
 *
 * datasource => The name of a supported datasource; valid options are as follows:
 *		Database/Mysql 		- MySQL 4 & 5,
 *		Database/Sqlite		- SQLite (PHP5 only),
 *		Database/Postgres	- PostgreSQL 7 and higher,
 *		Database/Sqlserver	- Microsoft SQL Server 2005 and higher
 *
 * You can add custom database datasources (or override existing datasources) by adding the
 * appropriate file to app/Model/Datasource/Database.  Datasources should be named 'MyDatasource.php',
 *
 *
 * persistent => true / false
 * Determines whether or not the database should use a persistent connection
 *
 * host =>
 * the host you connect to the database. To add a socket or port number, use 'port' => #
 *
 * prefix =>
 * Uses the given prefix for all the tables in this database.  This setting can be overridden
 * on a per-table basis with the Model::$tablePrefix property.
 *
 * schema =>
 * For Postgres specifies which schema you would like to use the tables in. Postgres defaults to 'public'.
 *
 * encoding =>
 * For MySQL, Postgres specifies the character encoding to use when connecting to the
 * database. Uses database default not specified.
 *
 * unix_socket =>
 * For MySQL to connect via socket specify the `unix_socket` parameter instead of `host` and `port`
 */
# read the credentials file, if exists


class DATABASE_CONFIG {

    public function __construct(){
        if(isset($_ENV['CRED_FILE'])){
            $string = file_get_contents($_ENV['CRED_FILE'], false);
            if ($string == false) {
                new Exception("Credentials file not found!");
            } else {
                # the file contains a JSON string, decode it and return an associative array
                $creds = json_decode($string, true);
                $mysqls_config = $creds['MYSQLS'];
            }
        }
        else {
            $mysqls_config = array();
            $mysqls_config['MYSQLS_HOSTNAME'] = 'localhost';
            $mysqls_config['MYSQLS_USERNAME'] = 'cakephp';
            $mysqls_config['MYSQLS_PASSWORD'] = 'cakephp';
            $mysqls_config['MYSQLS_DATABASE'] = 'cakephp';
        }

        $this->default['host'] = $mysqls_config['MYSQLS_HOSTNAME'];
        $this->default['login'] = $mysqls_config['MYSQLS_USERNAME'];
        $this->default['password'] = $mysqls_config['MYSQLS_PASSWORD'];
        $this->default['database'] = $mysqls_config['MYSQLS_DATABASE'];
    }

	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => null,
		'login' => null,
		'password' => null,
		'database' => null,
		'prefix' => '',
		'encoding' => 'utf8',
	);

	public $test = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => null,
		'login' => null,
		'password' => null,
		'database' => null,
		'prefix' => '',
		'encoding' => 'utf8',
	);
}
