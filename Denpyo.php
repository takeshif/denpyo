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
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
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
    $this->validateToken();

    if (!isset($_POST['mode'])) {
      throw new \Exception('mode not set!');
    }

    switch ($_POST['mode']) {
      case 'update':
        return $this->_update();
      case 'create':
        return $this->_create();
      case 'delete':
        return $this->_delete();
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

    private function _update() {
      if (!isset($_POST['id'])) {
        throw new \Exception('[update] id not set!');
      }

      $this->_db->beginTranction();

      $sql = sprintf("update denpyo set state = (state + 1) %% 2 where id = %d", $_POST['id']);
      $stmt = $this->_db->prepare($sql);
      $stmt->execute();

      $sql = sprintf("select state from todos where id = %d", $_POST['id']);
      $stmt = $this->_db->query($sql);
      $state = $stmt->fetchColumn();

      $this->_db->commit();

      return [
        'state' => $state
      ];
    }

    private function _create() {
      if (!isset($_POST['title']) || $_POST['title'] === '') {
        throw new \Exception('[create] title not set!');
      }

      $sql = "insert into todos (title) values (:title)";
      $stmt = $this->_db->prepare($sql);
      $stmt->execute([':title' => $_POST['title']]);

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
