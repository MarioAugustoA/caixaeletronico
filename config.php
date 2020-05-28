<?php  

try{
$pdo = new PDO("mysql:dbname=projeto_caixaeletronico; host=localhost","","");

}catch(PDOExcepetion $e){
	echo "Erro".$e->getMessage();
}

?>