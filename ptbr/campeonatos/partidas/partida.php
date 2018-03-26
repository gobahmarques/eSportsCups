<?php
    include "../../../enderecos.php";
    include "../../../session.php";

    $campeonato = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM campeonato WHERE codigo = ".$_GET['codigo'].""));
	$organizacao = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM organizacao WHERE codigo = ".$campeonato['cod_organizacao'].""));
	$jogo = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM jogos WHERE codigo = ".$campeonato['cod_jogo']." "));
	$partida = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM campeonato_partida WHERE codigo = ".$_GET['partida']." "));
	$etapa = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM campeonato_etapa WHERE cod_etapa = ".$partida['cod_etapa']." AND cod_campeonato = ".$partida['cod_campeonato']."  "));
	$datahora = date("Y-m-d H:i:s");
	$inicioCheckin = date("Y-m-d H:i:s", strtotime("-15minutes", strtotime($partida['datahora'])));
	$fimCheckin = date("Y-m-d H:i:s", strtotime("+15minutes", strtotime($partida['datahora'])));
	$datalimite = date("Y-m-d H:i:s", strtotime($partida['datalimite']));

	if(isset($usuario['codigo'])){
		$pesquisaFuncao = mysqli_query($conexao, "SELECT * FROM jogador_organizacao WHERE cod_organizacao = ".$organizacao['codigo']." AND cod_jogador = ".$usuario['codigo']." ");
		$funcao = mysqli_fetch_array($pesquisaFuncao);
		
		$pesquisaPosicao = mysqli_query($conexao, "
			SELECT * FROM campeonato_partida_semente
			INNER JOIN campeonato_etapa_semente ON campeonato_partida_semente.cod_semente = campeonato_etapa_semente.codigo
			WHERE campeonato_etapa_semente.cod_jogador = ".$usuario['codigo']."
			AND campeonato_partida_semente.cod_partida = ".$partida['codigo']."
		");
		if(mysqli_num_rows($pesquisaPosicao) == 0){
			$pesquisaPosicao = mysqli_query($conexao, "
				SELECT * FROM campeonato_partida_semente
				INNER JOIN campeonato_etapa_semente ON campeonato_partida_semente.cod_semente = campeonato_etapa_semente.codigo
				INNER JOIN campeonato_lineup ON campeonato_etapa_semente.cod_equipe = campeonato_lineup.cod_equipe
				WHERE campeonato_lineup.cod_jogador = ".$usuario['codigo']."
				AND campeonato_partida_semente.cod_partida = ".$partida['codigo']."
				AND campeonato_lineup.cod_campeonato = ".$campeonato['codigo']."
			");
			if(mysqli_num_rows($pesquisaPosicao) != 0){
				$vagaAtual = mysqli_fetch_array($pesquisaPosicao);
			}
		}else{
			$vagaAtual = mysqli_fetch_array($pesquisaPosicao);
		}
				
	}
?>
<!doctype html>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo $css; ?>bootstrap.css">
        <link rel="stylesheet" href="<?php echo $css; ?>esportscups.css">

        <title>Partida <?php echo $partida['codigo']; ?> - <?php echo $campeonato['nome']; ?> | e-Sports Cups</title>
    </head>
    <body>
        <?php include "../../header.php"; ?>
        <div class="container">
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb caminhoNavegacao">
                    <li class=""><a href="ptbr/campeonato/<?php echo $campeonato['codigo']; ?>/"><?php echo $campeonato['nome']; ?></a></li>
                    <li class=""><a href="ptbr/campeonato/<?php echo $campeonato['codigo']; ?>/etapa/<?php echo $etapa['cod_etapa']; ?>/"><?php echo $etapa['nome']; ?></a></li>
                    <li class="ativo" aria-current="page"><?php echo "Partida ".$partida['codigo']; ?></li>
                </ul>
            </nav>
        </div>      
        <?php
            include "partida-perfil.php";
            if(isset($sementeUm) && isset($sementeDois) && $partida['status'] == 1 && isset($usuario['codigo'])){
                include "painel-usuario.php";
            }
            if(isset($usuario['codigo']) && mysqli_num_rows($pesquisaFuncao) != 0){
                include "painel-admin.php";
            }
        ?>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="<?php echo $js; ?>jquery.js"></script>
        <script src="<?php echo $js; ?>bootstrap.js"></script>
    </body>
</html>