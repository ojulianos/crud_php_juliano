<?php
namespace Core;

use PDO;
use PDOException;

class Connection {

    public $pdo = null;

    function __construct()
    {
        try {
            self::openDb();
        } catch ( PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * Abrir a conexão com o banco de dados comm as credenciais de config/database.php
     */
    protected function openDb()
    {

        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        $dsn = DB_TYPE . ':host=' . DB_HOST . ';port ='. DB_PORT . ';dbname=' . DB_NAME;// . $databaseEncodingenc;
        try{
            $this->pdo = new PDO($dsn , DB_USER, DB_PASS, $options);
        }catch (PDOException $e){
            echo '<div style="text-align:center"><b>Mensagem: </b>'.$e->getMessage();
            echo '<br><b>Código</b>: '.$e->getCode().'<br>';
            echo '<b>Arquivo</b>: '.$e->getFile();
            echo '<br><b>Linha: </b>'.$e->getLine();
            die('<br><br><hr><h3>Crie o banco de dados<br>Importe o script "db_my.sql" existente no raiz<br>E tente conectar novamente<h3></div>');
        }
    }


    protected function _setCampos(string | array $campos): string
    {
        return $this->_setConditions($campos, ',', false);
    }

    protected function _setConditions(string | array $conditions, $separador = 'AND', $where = true): string
    {
        $whereSql = ' ';
        if (is_array($conditions)) {
            $whereSql .= $where ? ($separador == ' AND' ? ' WHERE' : '') : '';
            $i = 0;
            foreach ($conditions as $key => $value) {
                $pre = ($i > 0) ? " {$separador} " : ($where ? ' WHERE ' : '');
                $whereSql .= " {$pre} {$key} = '{$value}' ";
                $i++;
            }

            return $whereSql;
        }

        if (empty($conditions)) {
            return '';
        }

        $whereSql .= $where ? ' WHERE ' : ' ';
        return "{$whereSql} {$conditions}";
    }
}