<?php
// (A) DATABASE CLASS
class DB {
  // (A1) CONSTRUCTOR - CONNECT TO THE DATABASE
  private $pdo = null;
  private $stmt = null;
  public $error;
  function __construct () {
    try {
      $this->pdo = new PDO(
        "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,
        DB_USER, DB_PASSWORD, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
      ]);
    } catch (Exception $ex) { exit($ex->getMessage()); }
  }

  // (A2) DESTRUCTOR - CLOSE DATABSE CONNECTION
  function __destruct () {
    if ($this->stmt !== null) { $this->stmt = null; }
    if ($this->pdo !== null) { $this->pdo = null; }
  }

  // (A3) EXECUTE SQL QUERY
  function exec ($sql, $data=null) {
    try {
      $this->stmt = $this->pdo->prepare($sql);
      $this->stmt->execute($data);
      return true;
    } catch (Exception $ex) {
      $this->error = $ex->getMessage();
      return false;
    }
  }

  // (A4) FETCH (SINGLE ROW)
  function fetch ($sql, $data=null) {
    if ($this->exec($sql, $data) === false) { return false; }
    return $this->stmt->fetch();
  }

  // (A5) FETCH ALL (MULTIPLE ROWS)
  function fetchAll ($sql, $data=null) {
    if ($this->exec($sql, $data) === false) { return false; }
    return $this->stmt->fetchAll();
  }
}

 function checkpermission ($pid) {
  return in_array($pid, $_SESSION["user"]["permissions"]);
}

// (B) DATABASE SETTINGS - CHANGE TO YOUR OWN!
define("DB_HOST", "localhost");
define("DB_NAME", "techup_lab_test");
define("DB_CHARSET", "utf8");
define("DB_USER", "root");
define("DB_PASSWORD", "");

// (C) START!
$DB = new DB();
$baseurl='http://localhost/test';
session_start();
