
<?php
	date_default_timezone_set('America/Sao_Paulo');
	$pdo = new PDO('mysql:host=localhost;dbname=db_fisiosys05082020','root',''); // falta criar classe de conexão
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sistema de Reserva</title>
</head>
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/estilo.css" media="screen" />
<body>
	<header>
		<div class="center">	
			<div class="logo">
				<h2>Agendamentos</h2>
			</div>
			<nav class="menu">
				<ul>
					<li><a href="">Reservas Atuais</a></li>
					<li><a href="">Sobre</a></li>
					<li><a href="">Contato</a></li>
				</ul>
			</nav>
			<div class="clear"></div>
		</div>	
	</header>
		<section class="agendamentos">
			<div class="center">	

				<?php
					if(isset($_GET['excluir'])){
						$id = (int)$_GET['excluir'];
						$pdo->exec("DELETE FROM `tb_agendados` WHERE id = $id");
						echo '<div class="sucesso">O agendamento foi removido com sucesso!</div>';

					}
					$info = $pdo->prepare("SELECT * FROM `tb_agendados`");
					$info->execute();
					$info = $info->fetchAll();
					foreach ($info as $key => $value) {
						# code...
					
				?>
				<div class="box-single-horario">
					<div class="box-single-wraper">
						Nome: <?php echo $value['nome']?><br />
						Data e Horário: <?php echo date('d/m/Y H:i:s', strtotime($value['horario']));?>
						<br />
						<a href="?excluir=<?php echo $value['id'];?>">Excluir</a>
					</div>
				</div>
				<?php }	?>
				<div class="clear"></div>
			</div>
		</section>
	
		</div>
	</section>
</body>
</html>