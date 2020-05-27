<?php

session_start();
require 'config.php';

if(isset($_SESSION['banco'])&& empty($_SESSION)== false){
	
	$id=$_SESSION['banco'];

	$sql = $pdo->prepare("SELECT * FROM contas Where id = :id");
	$sql->bindValue(":id",$id);
	$sql->execute();

	if($sql->rowCount() > 0){
		$info = $sql->fetch();
	}else{
		header("Location: login.php");
	exit;
	}
}else{
	header("Location: login.php");
	exit;
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Caixa Eletrônico</title>
</head>
<body>
	<h1>Banco XYZ</h1>
	Titular: <?php echo $info['titular']; ?><br/>
	Agencia:<?php echo $info['agencia']; ?><br/>
	Conta:<?php echo $info['conta']; ?><br/>
	Saldo:<?php echo $info['saldo']; ?><br/>
	<a href="Sair.php">Sair</a>
	<hr/>
	<h3>Movimentação/Extrato</h3>

	<a href="add-transacao.php">Adicionar Transação</a><br/><br/>

		<table border="1" width="400px">
			<tr>
				<th>Data</th>
				<th>Valor</th>
			</tr>
			<?php 
      		$sql = $pdo->prepare("SELECT * FROM historico WHERE id_conta = :id_conta");
      		$sql->bindValue(":id_conta",$id);
      		$sql->execute();

      		if($sql->rowCount() > 0){

      			foreach ($sql->fetchAll() as $item) {
      				?>
      				<tr>
      					<td><?php echo date('d/m/Y H:i', strtotime($item['data_operacao'])); ?></td>
      					<td>
      						<?php if($item['tipo'] == '0'):?>
      						<font color="green">R$ <?php echo $item['valor'];?></span>
      						<?php else: ?>
      							<font color="red">-R$ <?php echo $item['valor'];?></span>
      						<?php endif; ?>
      					</td>
      				</tr>
      				<?php

      				
      			}
      		}
      		?>
		</table>
</body>
</html>