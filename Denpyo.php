<?php

namespace MyApp;

class Denpyo {
  private $_db;

  public function __construct() {
    $this->_createToken();

    try {
      $this->_db = new \PDO(DSN, DB_USERNAME, DB_PASSWORD);
      $this->_db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    } catch (\PDOException $e) {
      echo $e->getMessage();
      exit;
    }
  }

  private function _createToken() {
    if (!isset($_SESSION['token'])) {
      $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
    }
  }

  public function getAll() {
    $stmt = $this->_db->query("select * from denpyo order by id desc");
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  public function getOmiseName($omise_cd) {
    $sql = sprintf("select omise_name from imtok where omise_cd = %d", $omise_cd);
    $stmt = $this->_db->query($sql);
    $omise_name = $stmt->fetch();
    return $omise_name[omise_name];
  }

  public function getSirName($sir_cd) {
    $sql = sprintf("select sir_name from imsir where sir_cd = %d", $sir_cd);
    $stmt = $this->_db->query($sql);
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  public function getItemName($item_cd) {
    $sql = sprintf("select item_name from imsho where item_cd = %s", $item_cd);
    $stmt = $this->_db->query($sql);
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  public function post() {
    $this->_validateToken();

    if (!isset($_POST['mode'])) {
      throw new \Exception('mode not set!');
    }

    switch ($_POST['mode']) {
      case 'set':
        return $this->_set();
      case 'update':
        return $this->_update();
      case 'create':
        return $this->_create();
      case 'delete':
        return $this->_delete();
      case 'omise_name_set':
        return $this->getOmiseName($_POST['omise_cd']);
      }
    }

    private function _validateToken() {
      if (
        !isset($_SESSION['token']) ||
        !isset($_POST['token']) ||
        $_SESSION['token'] !== $_POST['token']
       ) {
         throw new \Exception('invalid token!');
       }
    }

    private function _set() {
      if (!isset($_POST['id'])) {
        throw new \Exception('[update] id not set!');
      }

    }
    
    private function _update() {
      if (!isset($_POST['id'])) {
        throw new \Exception('[update] id not set!');
      }
      
      $this->_db->beginTransaction();

      $sql = sprintf("update denpyo set tanto = '%s', yyyymmdd = %d,
                      omise_cd = %d, sir_cd = %d, item_cd = '%s', 
                      jtanka = %d, gtanka = %d , stanka = %d, 
                      lease = %d, status = %d 
                      where id = %d", $_POST['tanto'],$_POST['ymd'],$_POST['omise_cd'],$_POST['sir_cd'],
                      $_POST['item_cd'],$_POST['jyodai'],$_POST['gedai'],$_POST['siire'],
                      $_POST['lease'], $_POST['status'],$_POST['id']);

      $stmt = $this->_db->prepare($sql);
      $stmt->execute();

      $this->_db->commit();

      return [];
    }

    private function _create() {
      if (!isset($_POST['tanto']) || $_POST['tanto'] === '') {
        throw new \Exception('[create] tanto not set!');
      }

      $sql = "insert into denpyo (tanto,yyyymmdd,omise_cd,sir_cd,item_cd,
              jtanka,gtanka,stanka,lease,status) values 
              (:tanto,:yyyymmdd,:omise_cd,:sir_cd,:item_cd,
              :jtanka,:gtanka,:stanka,:lease,:status)";
      $stmt = $this->_db->prepare($sql);
      $stmt->execute([':tanto' => $_POST['tanto'], ':yyyymmdd' => $_POST['ymd'],
                     ':omise_cd' => $_POST['omise_cd'], ':sir_cd' => $_POST['sir_cd'],
                     ':item_cd' => $_POST['item_cd'], ':jtanka' => $_POST['jyodai'],
                     ':gtanka' => $_POST['gedai'], ':stanka' => $_POST['siire'],
                     ':lease' => $_POST['lease'], ':status' => $_POST['status']]);

      return [
        'id' => $this->_db->lastInsertId()
      ];
    }
    

    private function _delete() {
      if (!isset($_POST['id'])) {
        throw new \Exception('[delete] id not set!');
      }

      $sql = sprintf("delete from todos  where id = %d", $_POST['id']);
      $stmt = $this->_db->prepare($sql);
      $stmt->execute();

      return [];
    }
}
