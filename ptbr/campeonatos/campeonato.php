<?php
    include "../../enderecos.php";
    include "../../session.php";

    $campeonato = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM campeonato WHERE codigo = ".$_GET['codigo'].""));
	$organizacao = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM organizacao WHERE codigo = ".$campeonato['cod_organizacao'].""));
	$jogo = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM jogos WHERE codigo = ".$campeonato['cod_jogo']." "));

	$datahora = date("Y-m-d H:i:s");

	if(isset($usuario['codigo'])){
		$pesquisaFuncao = mysqli_query($conexao, "SELECT * FROM jogador_organizacao WHERE cod_organizacao = ".$organizacao['codigo']." AND cod_jogador = ".$usuario['codigo']." ");
		$funcao = mysqli_fetch_array($pesquisaFuncao);	
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

        <title><?php echo $campeonato['nome']; ?> | e-Sports Cups</title>
    </head>
    <body>
        <?php include "../header.php"; ?>
        <?php include "campeonato-perfil.php"; ?>
        
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-7">
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <h2>Descrição</h2>                        
                            <?php echo $campeonato['descricao']; ?>	
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <h2>Descrição</h2>                        
                            <?php echo $campeonato['regulamento']; ?>	
                        </div>	
                    </div>
                </div>
                <div class="col-12 col-md-1">
                    
                </div>
                <div class="col-12 col-md-4">
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <h2>Etapas</h2>                        
                            <?php echo $campeonato['descricao']; ?>	
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <h2>Fuso Horário</h2>                        
                            <?php echo $campeonato['fuso_horario']; ?>	
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <h2>Premiação</h2>                        
                            <?php echo $campeonato['premiacao']; ?>	
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include "../footer.php"; ?>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="<?php echo $js; ?>jquery.js"></script>
        <script src="<?php echo $js; ?>bootstrap.js"></script>
        <script>
            jQuery(function($){
                $(".informacoes").addClass("ativo");
            });
        </script>
    </body>
</html>