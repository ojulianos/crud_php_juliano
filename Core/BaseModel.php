<?php
namespace Core;

use PDO;

class BaseModel extends Connection 
{

    protected string $table = 'users';
    protected string $primary_key = 'id';
    protected string $order_by = 'id DESC';
    protected string $where = '';
    protected array $fields = ['id', 'name', 'email', 'password'];
    private string $return_type = '';


    public function __construct() {
        parent::__construct();
    }

    /**
     * Método para buscar registros
     * O parametro conditions pode receber: select, where, order_by, start, end
     *
     * @param array $conditions
     * @return iterable
     */
    public function getData(array $conditions = [])
    {
        $sql = "SELECT ";
        $sql .= array_key_exists("select", $conditions) ? $conditions['select'] : ' * ';
        $sql .= " FROM {$this->table} ";

        if (array_key_exists('join', $conditions)) {
            foreach ($conditions['join'] as $value) {
                $sql .= " {$value} ";
            }
        }

        if (array_key_exists('where', $conditions)) {
            $sql .= $this->_setConditions($conditions['where']);
        }

        if (array_key_exists('group_by', $conditions)) {
            $sql .= " GROUP BY {$conditions['group_by']} ";
        }

        if (array_key_exists('order_by', $conditions)) {
            $sql .= " ORDER BY {$conditions['order_by']} ";
        }

        if (array_key_exists("start", $conditions) && array_key_exists("limit", $conditions)) {
            $sql .= ' LIMIT ' . $conditions['start'] . ',' . $conditions['limit'];
        } elseif (!array_key_exists("start", $conditions) && array_key_exists("limit", $conditions)) {
            $sql .= ' LIMIT ' . $conditions['limit'];
        }

        $query = $this->pdo->prepare($sql);
        $query->execute();

        if ($this->return_type) {
            $data = $this->return_type == 'count' ? $query->rowCount() : $query->fetch(PDO::FETCH_OBJ);
            unset($this->return_type);
        } else {
            $data = $query->rowCount() > 0 ? $query->fetchAll(PDO::FETCH_CLASS) : false;
        }
        return !empty($data) ? $data : false;
    }

    /**
     * Returna um registro
     *
     * @param array $conditions
     * @return object
     */
    public function getOne(string $id)
    {
        $this->return_type = 'single';
        $conditions = [
            'where' => [
                $this->primary_key => $id
            ]
        ];
        return $this->getData($conditions);
    }

    /**
     * Retorna a quantidade de registros
     *
     * @param array $conditions
     * @return int
     */
    public function getCount(array $conditions = [])
    {
        $this->return_type = 'count';
        unset($conditions['limit']);

        return $this->getData($conditions);
    }

    /**
     * Retorna o próximo id
     *
     * @param string $field
     * @return int
     */
    public function nextId(string $field): int
    {
        $this->return_type = 'single';
        $proximo = $this->getData([
            'select' => "{$field} as total",
            'order_by' => "{$field} DESC",
        ]);

        return ($proximo->total + 1) ?? 1;
    }

    /**
     * Método para adicionar um novo registro
     *
     * @param array $data
     * @return int|bool
     */
    public function insertData(array $data)
    {
        if (empty($data) && !is_array($data)) {
            return false;
        }

        $inputData = $this->checkInputFields($data);

        $columnString = implode(',', array_keys($inputData));
        $valueString = ":" . implode(',:', array_keys($inputData));
        $sql = "INSERT INTO {$this->table} ({$columnString}) VALUES ({$valueString})";
        $query = $this->pdo->prepare($sql);
        foreach ($inputData as $key => $val) {
            $query->bindValue(':' . $key, $val);
        }
        $insert = $query->execute();
        return $insert ? $this->pdo->lastInsertId() : false;
    }

    /**
     * Método para atualizar um ou mais registros
     *
     * @param array $data
     * @param array $conditions
     * @return int|bool
     */
    public function updateData(string | array $data, string | array $conditions)
    {
        if (empty($data) && !is_array($data)) {
            return false;
        }

        $colvalSet = $this->_setCampos(
            $this->checkInputFields($data)
        );
        $whereSql = $this->_setConditions($conditions);

        $sql = "UPDATE {$this->table} SET {$colvalSet} {$whereSql}";
        $query = $this->pdo->prepare($sql);
        $update = $query->execute();
        return $update ? $query->rowCount() : false;
    }

    /**
     * Método para excluir um ou mais registros
     *
     * @param array $conditions
     * @return int|bool
     */
    public function deleteData(array $conditions)
    {
        $whereSql = $this->_setConditions($conditions);
        $sql = "DELETE FROM {$this->table} {$whereSql}";
        $delete = $this->pdo->exec($sql);
        return $delete ? $delete : false;
    }

    /**
     * Método para definir os campos que serão para o insert ou update
     *
     * @param array $data
     * @return array
     */
    private function checkInputFields(array $data = [])
    {
        $data_new = [];
        foreach ($this->fields as $field) {
            if (array_key_exists($field, $data)) {
                $data_new[$field] = $data[$field];
            }
        }
        return $data_new;
    }
}