<?php
namespace App;
use PDO;
use PDOException;

class DataBase{

    private const HOST = 'localhost';
    private const USER = 'root';
    private const PASSWORD = '123';
    private const DBNAME = 'supermercado';

    private $connection;
    private $table;

    public function __construct($table = null){
        $this->table = $table;
        $this->setConnection();
    }
    //metodo que cria conexao com o banco
    public function setConnection(){
        $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::DBNAME,self::USER,self::PASSWORD);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    public function execute($query, $values = null){
         try{
            echo'<pre>';
            print_r($query); //query são os comandos sql.
            echo'</pre>';
            $statement = $this->connection->prepare($query);
            $statement->execute($values);
            return $statement;
         }catch(PDOException $e){
            die('ERROR: '.$e);
         }
    }

    public function insert($array){
        $fields = array_keys($array); //extrair as chaves do array
        $binds = array_pad([],count($array),'?'); //criar um array com valores =  ?
        $query = 'INSERT INTO '.$this->table.' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')'; //criar a query
        $this->execute($query, array_values($array)); //executar a query
        return $this->connection->lastInsertId();
    }
    public function select($where = null,$order=null,$limit=null,$fields='*'){

        $where = strlen($where) ? 'WHERE '.$where : '';
        $order = strlen($order) ? 'ORDER BY '.$order : '';
        $limit = strlen($limit) ? 'LIMIT '.$limit : '';
        $query = 'SELECT '.$fields.' FROM '. $this->table.' '.$where.' '.$order.' '.$limit;
        return $this->execute($query);
    }
    public function update($where, $array){
        $fields = array_keys($array); //extrair as chaves do array
        $query = ' UPDATE '.$this->table.' SET '.implode('=?,',$fields).' WHERE '.$where; //montar query
        $this->execute($query, array_values($array)); //executar a query
        return true;
    }
    public function delete($where){
        $query = 'DELETE FROM '.$this->table.' WHERE '.$where;
        $this->execute($query);
        return true;
    }
}

$db = new DataBase('fornecedor');
$g = $db->select(null,'cnpj',2,'nome, cnpj')->fetchAll(PDO::FETCH_CLASS);
echo'<pre>';
print_r($g);
echo'</pre>';
$db->delete('id=1');
$g = $db->select(null,'cnpj',2,'nome, cnpj')->fetchAll(PDO::FETCH_CLASS);
echo'<pre>';
print_r($g);
echo'</pre>';





// $db->update('id=4',
// [
//     'nome'=>'carlin',
//     'cnpj'=>'5858585285858',
//     'telefone'=>'(63) 9 5425-3234',
//     'email'=>'sinto@muito.com',
//     'endereco'=>'RUA DA PIEDADE'
// ]);
// $f = $db->select(null,'cnpj',2,'nome, cnpj')->fetchAll(PDO::FETCH_CLASS);
// echo'<pre>';
// print_r($f);
// echo'</pre>';
?>