<?php
	include "../../../../conexao-banco.php";
	$etapa = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM campeonato_etapa WHERE cod_etapa = ".$_GET['etapa']." AND cod_campeonato = ".$_GET['campeonato']." "));
    $campeonato = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM campeonato WHERE codigo = ".$_GET['campeonato']." "));
?>

<div class="row">
    <div class="col-12 col-md-4">
        <div class="listagemSementes form-group">
            <h3>Sementes</h3>
            <select name="" id="" class="etapaorigem form-control" onChange="selecionarEtapa($('.etapaorigem').val(), <?php echo $_GET['campeonato']; ?>, <?php echo $etapa['vagas']; ?>);">
                <option value="0">TODAS AS INSCRIÇÕES</option>
                <?php
                    $etapas = mysqli_query($conexao, "SELECT * FROM campeonato_etapa WHERE cod_campeonato = ".$_GET['campeonato']." ORDER BY cod_etapa");
                    while($etapaInfo = mysqli_fetch_array($etapas)){
                        echo "<option value='".$etapaInfo['cod_etapa']."'>".$etapaInfo['cod_etapa']." - ".$etapaInfo['nome']."</option>";
                    }
                ?>
            </select>
            <br>
            <form action="ptbr/organizacao/paineladmin/campeonatos/painel-sementes-enviar.php" method="post" onSubmit="return validar();">
                <input type="text" name="etapa" value="<?php echo $etapa['cod_etapa']; ?>" hidden="hidden">
                <input type="text" name="campeonato" value="<?php echo $etapa['cod_campeonato']; ?>" hidden="hidden">
                
                <table class="listajogadores" id="tabelaLobbys" cellpadding="0" cellspacing="0">
                </table>
                <br>
                <input type="submit" value="CONCLUIR" class="btn-dark btn">
            </form>
        </div>
    </div>
    <div class="col-12 col-md-8">
        <div class="row-fluid">
        <?php
            require "../../../../scripts/carregar-bracket-painel-organizacao.php";
            switch($etapa['tipo_etapa']){
                case 1: // ELIMINAÇÃO SIMPLES
                    elimSimples($_GET['etapa'], $campeonato['codigo']);		
                    break;
                case 2: // GRUPOS PONTOS CORRIDOS
                    gruposPontosCorridos($etapa, $campeonato);
                    break;
                case 3:
                    elimDupla($_GET['etapa'], $campeonato['codigo']);
            }		
        ?>
        </div>
    </div>
</div>


<div class="barraCentral">
	<h1>ADICIONAR JOGADORES A ESTA ETAPA</h1>

	<!--<ul class="filtroSementes">
		<li>ALEATORIAMENTE</li>
		<li>HORA INSCRIÇÃO</li>	
	</ul>-->
</div>

<script>
    /*
	function selecionarEtapa(etapa, campeonato, vagas){        
		$.ajax({
			type: "POST",
			url: "scripts/etapa.php",
			data: "funcao=carregarjogadores&etapa="+etapa+"&campeonato="+campeonato+"&vagas="+vagas,
			success: function(resposta){
				$(".listajogadores").html(resposta);
			}
		})
	}	
    */	
</script>