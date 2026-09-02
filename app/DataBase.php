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
    //função que constroi a classe

    public function __construct($table = null){
        $this->table = $table;
        $this->setConnection();
    }
    //metodo que cria uma conexão com o banco de dados 
    public function setConnection(){
        $connection = new PDO('mysql:host='.self::HOST.';dbmame'.self::DBNAME,self::USER,self::PASSWORD);
    }
    //metodo que insere dados no banco
    public function insert($array){
        $query = "INSERT INTO fornecedor (nome,cnpj,telefone,email,endereco)
        VALUES ('CRISTAL','UIYUIYUIY','768687','cristal@gmail.com','rua 10')";
        $fields = array_keys($array);
        $binds = array_pad([], count($array), '?');
        $query = 'INSERT INTO'.$this->table.' ('.implode(',',$fields).');
        VALUE('.implode(',',$binds).')';
        echo $query."<br>";
        echo "<pre>";
        print_r($array);
        print_r($fields);
        print_r($binds);
        echo "</pre>";
    }

}
$db = new DataBase('fornecedor');
$db->insert(['nome'=>'Cola-cola',
'cnpj'=>'57456752', 
'telefone'=>'32546265',
'email'=> 'coca@gmail.com',
'endereco'=>'Avenida JK'
]
);
use App


?>