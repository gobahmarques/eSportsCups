<?php
	include "../../../../conexao-banco.php";
	$jogadores = $_POST['inscricao'];
	$etapa = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM campeonato_etapa WHERE cod_etapa = ".$_POST['etapa']." AND cod_campeonato = ".$_POST['campeonato']." "));
	$campeonato = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM campeonato WHERE codigo = ".$_POST['campeonato']." "));

	$sementesDestino = mysqli_query($conexao, "SELECT * FROM campeonato_etapa_semente WHERE cod_campeonato = ".$_POST['campeonato']." AND cod_etapa = ".$_POST['etapa']." ORDER BY rand() ");

	$auxJogador = 0;

	while($seed = mysqli_fetch_array($sementesDestino)){
		$jogador = explode(" ", $jogadores[$auxJogador]);
		if($jogador[1] != 0){
			mysqli_query($conexao, "UPDATE campeonato_etapa_semente SET cod_jogador = ".$jogador[0].", cod_equipe = ".$jogador[1]." WHERE codigo = ".$seed['codigo']."");
		}else{
			mysqli_query($conexao, "UPDATE campeonato_etapa_semente SET cod_jogador = ".$jogador[0]." WHERE codigo = ".$seed['codigo']."");
		}
		$auxJogador++;
	}

	header("Location: ../../../organizacao/".$campeonato['cod_organizacao']."/painel/campeonato/".$campeonato['codigo']."/etapa/".$etapa['cod_etapa']."/");
?>