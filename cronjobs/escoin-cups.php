<?php
	include "../conexao-banco.php";
		
	// TERÇA-FERIA: HEARTHSTONE

	$inicioCamp = date("Y-m-d")." 19:25:00";
	// $inicioCamp = date("Y-m-d H:i:s", strtotime("+9days", strtotime($inicio)));
	$fim = date("Y-m-d H:i:s", strtotime("+4hours 59minutes", strtotime($inicioCamp)));
	$inicioInscricao = date("Y-m-d H:i:s", strtotime("-7days", strtotime($inicioCamp)));
	$fimInscricao = date("Y-m-d H:i:s", strtotime("-5minutes", strtotime($inicioCamp)));

	$descricao = "<p>A eSCoin Cup &eacute; um torneio que visa premiar o usu&aacute;rio com eSCoins. Ajudando-o a acumular recursos muito mais r&aacute;pido.</p>";
	$regulamento = "
	<ol>
		<li><strong>Formato do Torneio</strong>
		<ul>
			<li>Elimina&ccedil;&atilde;o Simples</li>
			<li>Conquest - 4 escolhas e 1 banimento</li>
			<li>Partidas MD 5 (Melhor de 5)<br />
			&nbsp;</li>
		</ul>
		</li>
		<li><strong>Sobre as Partidas</strong>
		<ul>
			<li>Partidas MD 5</li>
			<li>Ap&oacute;s ganhar com 1 her&oacute;i, n&atilde;o &eacute; poss&iacute;vel mais jogar com ele</li>
			<li>Caso um jogador inicie uma partida com um baralho fora da sele&ccedil;&atilde;o final, ele receber&aacute; derrota nesta partida.</li>
			<li>Caso a tela de desafio seja cancelada por um dos dois jogadores, o mesmo ir&aacute; receber derrota na S&eacute;rie<br />
			&nbsp;</li>
		</ul>
		</li>
		<li><strong>ScreenShots</strong>
		<ul>
			<li>Recomendamos a todos os jogadores a realizarem uma captura de tela das seguintes situa&ccedil;&otilde;es:
			<ol>
				<li>Tela de desafio antes de iniciar a disputa pela s&eacute;rie.</li>
				<li>Final da partida (tanto vit&oacute;ria quanto derrota).</li>
				<li>Seu oponente cancelou o desafio (ou foi derrubado pelo jogo).</li>
				<li>Seu oponente cancelou desafio e abriu sua cole&ccedil;&atilde;o.</li>
				<li>Qualquer situa&ccedil;&atilde;o que voc&ecirc; julgar necess&aacute;ria para poss&iacute;veis disputas.</li>
			</ol>
			</li>
			<li>A troca de printscreens antes do in&iacute;cio da s&eacute;rie &eacute; opcional, por&eacute;m, caso um dos jogadores solicite, &eacute; obrigat&oacute;rio seu envio para o advers&aacute;rio.</li>
		</ul>
		</li>
	</ol>
	";
	$premiacao = "<p><strong>1st&nbsp;</strong>- e$ 800<br />
	<strong>2nd</strong>&nbsp;- e$ 400<br />
	<strong>3rd~4th</strong>&nbsp;- e$ 200<br />
	";
	$cronograma = "
	<p><strong>Pré check-in:</strong> ".date("d/m", strtotime($inicioCamp))." - ".date("H:i", strtotime("-60minutes", strtotime($inicioCamp)))." ~ ".date("H:i", strtotime($inicioCamp))."<br />
	<strong>W.O.:</strong> ".date("d/m - H:i", strtotime("+15minutes", strtotime($inicioCamp)))."</p>
	";

	$thumb = "../img/campeonatos/escoincup/hs.png";

	mysqli_query($conexao, "
		INSERT INTO campeonato VALUES
		(NULL, 11, 639282, 369, 'eSCoin Cup Hearthstone', 32, 1, 0, 0, '$inicioInscricao', '$fimInscricao', '$inicioCamp', '$fim', 'Américas', '$descricao', '$regulamento', '$premiacao', '$cronograma', '$thumb', 0, 'Horário de Brasília', NULL, 'Brasil', 'Online', 0, 0, 1, 4, 1, 'PC', 60)
	");

	$id = mysqli_insert_id($conexao);
	mysqli_query($conexao, "INSERT INTO campeonato_premiacao VALUES ($id, 1, 800, 0)");
	mysqli_query($conexao, "INSERT INTO campeonato_premiacao VALUES ($id, 2, 400, 0)");
	mysqli_query($conexao, "INSERT INTO campeonato_premiacao VALUES ($id, 3, 200, 0)");
	mysqli_query($conexao, "INSERT INTO campeonato_premiacao VALUES ($id, 4, 200, 0)");

	
?>