<?php


abstract class AbstractRepository
{
    protected static $instance = null;
    protected $con;
    protected $table;

    function __construct($table) {
        $this->con = ConnectDB::getInstance()->getConnection();

        $this->table = $table;
    }

    public static function getInstance() {
        $current_class = get_called_class();

        if(!self::$instance) {
            self::$instance = new $current_class();
        }

        return self::$instance;
    }

    protected function execute($prep_sth, $params = []) {
        $pdo_sth = $this->con->prepare($prep_sth);
        if($pdo_sth->execute($params) == false) {
            return false;
        }

        return $pdo_sth;
    }

    protected function fetchOne($prep_sth, $params = []) {
        $pdo_sth = $this->execute($prep_sth, $params);
        return $pdo_sth->fetch();
    }

    protected function fetchAll($prep_sth, $params = []) {
        $pdo_sth = $this->execute($prep_sth, $params);
        return $pdo_sth->fetchAll();
    }

    public function insert($values)
    {
        $prep_sth = 'INSERT INTO ' . $this->table .
            ' (' . implode(', ', array_keys($values)) . ') ' .
            'VALUES (:' . implode(', :', array_keys($values)) . ');';

        $this->execute($prep_sth, $values);
        return $this->con->lastInsertId();
    }

    public function update($params , $id) {
        $prep_sth = 'UPDATE ' . $this->table . ' SET ';
        foreach (array_keys($params) as $key) {
            $prep_sth .= $key . ' = :' . $key;
            if(array_key_last($params) != $key) {
                $prep_sth .= ', ';
            }
        }
        $prep_sth .= ' WHERE id = :id;';

        $this->execute($prep_sth, array_merge($params, ['id' => $id]));
    }

    public function selectOne($id) {
        $prepSth = 'SELECT * FROM ' . $this->table . ' WHERE id = :id;';

        return $this->fetchOne($prepSth, ['id' => $id]);
    }

    public function selectAll() {
        $prepSth = 'SELECT * FROM ' . $this->table . ';';

        return $this->fetchOne($prepSth);
    }

    public function delete($id) {
        $prepSth = 'DELETE FROM ' . $this->table . ' WHERE id = :id;';

        return $this->execute($prepSth, ['id' => $id]);
    }

    public function selectAllClass() {
        $all = $this->selectAll();
        $all_class = [];

        foreach($all as $one) {
            array_push($all_class, $this->selectOneClass($one->id));
        }

        return $all_class;
    }

    abstract public function selectOneClass($id);
}