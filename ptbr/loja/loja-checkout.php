<?php
    include "../../enderecos.php";
    include "../../session.php";
    $produto = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM produto WHERE codigo = ".$_GET['produto'].""));
	$categoria = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM categoria WHERE codigo = ".$produto['cod_categoria'].""));
	$subCategoria = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM categoria_sub WHERE codigo = ".$produto['cod_sub_categoria'].""));
	$endereco = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM jogador_enderecos WHERE codigo = ".$_GET['endereco'].""));
	
	if(isset($usuario['codigo'])){
		$cupom = mysqli_query($conexao, "SELECT * FROM produto_cupom WHERE cod_produto = ".$produto['codigo']." AND cod_jogador = ".$usuario['codigo']." AND status = 0 ");
		if(mysqli_num_rows($cupom) == 0){
			if($usuario['pontos'] < $produto['valor']){
				header("Location: loja/");	
			}			
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

        <title>Checkout Loja eSC | e-Sports Cups</title>
    </head>
    <body>
        <?php include "../header.php"; ?>
        
        <div class="container centralizar">
            <br>
            <div class="row">
                <div class="col-3 col-md-3">
                </div>
                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <h1>RESUMO DA TROCA</h1>  <br> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 col-md-3">
                            <img src="<?php echo "http://www.esportscups.com.br/img/produtos/".$produto['codigo']."/foto.png"; ?>" alt="" width="100%">
                        </div>
                        <div class="col-8 col-md-8">
                            <div class="row">
                                <div class="col">
                                    <h3><?php echo $produto['nome']; ?></h3>
                                    <?php echo $categoria['nome']." -> ".$subCategoria['nome']; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <img src="<?php echo "http://www.esportscups.com.br/img/icones/escoin.png"; ?>" alt="" height="15px">
    				<?php echo number_format($produto['valor'], 0, '', '.'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <h3>DADOS ENTREGA</h3> <br> 
                        </div>
                        <div class="col-12 col-md-12">
                            <div>
                            <?php
                                if($produto['tipo_input'] != NULL){
                                    echo "<input type='".$produto['tipo_input']."' placeholder='".$produto['instrucao']."' name='instrucoes' class='form-control' required><br>";
                                }else{
                                    echo "<input type='hidden' name='instrucoes' class='form-control' value=''><br>";
                                }
                                echo $endereco['cep']." - ".$endereco['endereco']." ".$endereco['complemento'].", ".$endereco['numero']."<br>";
                                echo $endereco['cidade']." - ".$endereco['estado']." - ".$endereco['pais'];
                            ?>
                            </div>                        
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12 col-md">
                        <?php
                            if(mysqli_num_rows($cupom) != 0){
                                $cupom = mysqli_fetch_array($cupom);
                                echo "VALOR DA TROCA: <strong>GRÁTIS </strong>(CUPOM)";
                            }else{
                                $saldoFinal = $usuario['pontos'] - $produto['valor'];
                                ?>
                                    VALOR DA TROCA: <?php echo number_format($produto['valor'], 0, '', '.'); ?><br>
                                    SALDO ATUAL: <?php echo number_format($usuario['pontos'], 0, '', '.'); ?><br><br>
                                    <strong>SALDO FINAL:</strong> <?php echo number_format($saldoFinal, 0, '', '.'); ?>
                                <?php
                            }
                        ?>
                        </div>
                        <div class="col-12 col-md">
                            <input type="button" value="CONCLUIR TROCA" onClick="efetuarTrocar();" class="btn btn-dark">	
                        </div>
                    </div>
                </div>
                <div class="col-3 col-md-3">
                </div>
            </div>
            
        </div>
        
        <?php include "../footer.php"; ?>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="<?php echo $js; ?>jquery.js"></script>
        <script src="<?php echo $js; ?>bootstrap.js"></script>
        <script type="text/javascript">
            function efetuarTrocar(){
                $("#botaoEfetuar").html("<img src='<?php echo $img."loading.gif"; ?>'>");
                jQuery.ajax({
                    type: "POST",
                    url: "ptbr/loja/loja-checkout-enviar.php",
                    data: "produto=<?php echo $produto['codigo']; ?>&endereco=<?php echo $endereco['codigo']; ?>&valor=<?php echo $produto['valor']; ?>&instrucao="+$(".instrucao").val(),
                    success: function(data){
                        $(".modal-title").html("Troca Efetuada com sucesso!")
                        $(".modal-body").html("<br><h1>TROCA EFETUADA</h1><div class='resumo'>Sua troca foi solicitada com sucesso. <br>Em até 30 dias você estará recebendo o produto em sua casa.<br><br> Obrigado por escolher a e-Sports Cups como sua organizadora de competições. <br> Ficamos felizes por estar presente em seus resultados.</div>");
                        $(".modal").modal();
                        window.location.href("ptbr/")
                    }
                });
            }   
        </script>
    </body>
</html>