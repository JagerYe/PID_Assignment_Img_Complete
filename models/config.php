<?php


class Config
{
	public function getDBConnect()
	{
		$dsn = "mysql:host=localhost;dbname=PID_Assignment;port=3306";
		$dbid = 'root';
		$dbpasswd = '';
		$dbh = new PDO($dsn, $dbid, $dbpasswd, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES latin1 COLLATE latin1_general_ci")) or die(mysqli_connect_error());
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbh->exec("SET CHARACTER SET utf8");
		return $dbh;
	}
}
