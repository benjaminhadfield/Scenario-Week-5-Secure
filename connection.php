<?php

if (getenv('env') == 'PRODUCTION') {

  // PHP Data Objects(PDO) Sample Code:
  try {
    $DB_SERVER_PASSWORD = getenv('DB_SERVER_PASSWORD');
    echo 'DB_SERVER_PASSWORD: ' . $DB_SERVER_PASSWORD;

    $conn = new PDO("sqlsrv:server = tcp:comp205p-ae.database.windows.net,1433; Database = comp205p-ae-secure", "comp205p-ae", "${$DB_SERVER_PASSWORD}");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
  }

  // SQL Server Extension Sample Code:
  $connectionInfo = array("UID" => "comp205p-ae@comp205p-ae", "pwd" => "${$DB_SERVER_PASSWORD}", "Database" => "comp205p-ae-secure", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
  $serverName = "tcp:comp205p-ae.database.windows.net,1433";
  $conn = sqlsrv_connect($serverName, $connectionInfo);
} else {

  // Singleton pattern
  class Db {
    private static $instance = NULL;
    private function __construct() {}
    private function __clone() {}

    public static function getInstance() {
      if (!isset(self::$instance)) {
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        self::$instance = new PDO('mysql:host=localhost;dbname=ucl_scenario_week_5_secure','ucl_sw_5_admin','FCQYxUFDWNrCtBYr', $pdo_options);
      }
      return self::$instance;
    }
  }
}
