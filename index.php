
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
					<li><a href="">Reservas</a></li>
					<li><a href="">Sobre</a></li>
					<li><a href="">Contato</a></li>
				</ul>
			</nav>
			<div class="clear"></div>
		</div>	
	</header>
	<section class="reserva">
		<div class="center">
			<?php
				if(isset($_POST['acao'])){
					#quero fazer uma reserva
					$nome = $_POST['nome'];
					$dataHora = $_POST['dataHora'];
					$date = DateTime::createFromFormat('d/m/Y H:i:s', $dataHora);
					$dataHora= $date->format('Y-m-d H:i:s');
					
					$sql = $pdo->prepare('INSERT INTO `tb_agendados` VALUES (null,?,?)');
					$sql->execute(array($nome,$dataHora));
					echo '<div class="sucesso">O horário foi agendado com sucesso!</div>';
				}
			?>
			<form method="post">
				<input type="text" name="nome" placeholder="Seu nome...">
				<select name="dataHora">
					<?php
						for($i = 0; $i <= 23; $i++){
							$hora = $i;
							if($i < 10){
								$hora = '0'.$hora;
							}
							$hora.=':00:00';

							$verifica = date('Y-m-d').' '.$hora;
							$sql = $pdo->prepare("SELECT * FROM `tb_agendados` WHERE horario = '$verifica'");
							$sql->execute();

							if($sql->rowcount() == 0 && strtotime($verifica) > time()){
								$dataHora = date('d/m/Y').' '.$hora;
								echo '<option value="'.$dataHora.'">'.$dataHora.'</option>';
							}

						}
					?>
				</select>
				<input type="submit" name="acao" value="Enviar!">
			</form>
		</div>
	</section>
</body>
</html>