<?php  

try{
$pdo = new PDO("mysql:dbname=projeto_caixaeletronico; host=localhost","root","");

}catch(PDOExcepetion $e){
	echo "Erro".$e->getMessage();
}

?>