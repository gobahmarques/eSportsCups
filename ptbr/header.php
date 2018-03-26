<script>
	function validarLogin(){
		if($("#email").val() == "" || $("#senha").val() == ""){
			$(".modal-body").html("E-mail ou senha não informados");
		}else{
			$.ajax({
				type: "POST",
				url: "ptbr/validar_login.php",
				data: $("#login").serialize(),
				success: function(resultado){
					if(resultado == "0"){						
						$(".modal-body").html("<h2>QUE BOM QUE VOCÊ ESTÁ AQUI!</h2>  RECEBA ESTA RECOMPENSA PELO SEU PRIMEIRO LOGIN DO DIA!<br> <div class='valor' style='margin: 3% 0%; font-size: 300%;'><img class='coin' src='<?php echo $img; ?>escoin.png' height='4%'> 100</div><br><a href='https://www.esportscups.com.br/ptbr/jogar/dota2/'><input type='button' value='CONTINUAR'></a> ");
					}else if(resultado == "1"){
						window.location.href = "https://www.esportscups.com.br/ptbr/jogar/dota2/";
					}else if(resultado == "2"){
						$(".modal-body").html("E-mail ou senha incorretos.<br>Tente novamente.");
						$(".modal-footer").html("<button type='button' value='Tentar Novamente' class='btn btn-primary' onClick='abrirLogin();'>Tentar Novamente</button>");
					}else{
						$(".modal-body").load("scripts/alterar-senha.php");
						setTimeout(function(){
							$("#codJogador").val(resultado);
						}, 500);						
					}				
					return false;
				}
			});
		}
		return false;
	}
	function enviarCadastro(){
		$("#cadastro").submit();
	}
	function cadastro(){
		$(".modal-title").html("<h3>Junte-se a milhares de campeões.</h3>");
		$(".modal-body").load("ptbr/cadastro.php");
		$(".modal-footer").html("<button type='button' value='Enviar' class='btn btn-primary' onClick='enviarCadastro();'>Enviar</button>");
		$(".modal").modal();
	}
	function validarCadastro(){
		if($("#nome").val() == "" || $("#sobrenome").val() == "" || $("#nick").val() == "" || $("#emailCadastro").val() == "" || $("#emailConfirmar").val() == "" || $("#senhaCadastro").val() == "" || $("#senhaConfirmar").val() == ""){
			$("#status").html("Todos os dados devem ser preenchidos!<br><br>");
			document.getElementById("status").style.display = "block";			
			return	false;
		}else if($("#emailCadastro").val() != $("#emailConfirmar").val()){
			alert($("#email").val());
			alert($("#emailConfirmar").val());
			$("#status").html("Os e-mail não conferem!<br><br>");
			document.getElementById("status").style.display = "block";			
			return	false;
		}else if($("#senhaCadastro").val() != $("#senhaConfirmar").val()){
			$("#status").html("As senhas não conferem!<br><br>");
			document.getElementById("status").style.display = "block";			
			return	false;
		}else if(!document.getElementById("termos").checked){
			$("#status").html("Você precisa aceitar nossos Termos! <br><br>");
			document.getElementById("status").style.display = "block";			
			return	false;
		}else{
			jQuery.ajax({
				type: "POST",
				url: "ptbr/cadastro-checar.php",
				data: jQuery("#cadastro").serialize(),
				success: function( data )
				{
					$("#status").html(data);
					if($("#status").text() == "0"){
						document.getElementById("status").style.display = "none";
						window.location.replace("ptbr/cadastro-enviar.php");
					}else {										
						document.getElementById("status").style.display = "block";
					}
					
				}
			});
		}
		return false;
	}
	function esqueciSenha(){
		$("#modal").load("scripts/recuperar-senha.php");
		$("#modal").modal();
	}
	function abrirNotificacoes(codJogador){
		jQuery.ajax({
			type: "POST",
			url: "scripts/usuario.php",
			data: "codjogador="+codJogador+"&funcao=notificacoes",
			success: function(data){
                $(".modal-title").html("Notificações Recentes");
				$(".modal-body").html(data);
				$(".modal-footer").html("");
                $(".modal").modal();
			}
		});
	}
	function validarNotificacao(codNotificacao){
		jQuery.ajax({
			type: "POST",
			url: "scripts/usuario.php",
			data: "codnotificacao="+codNotificacao+"&funcao=validar",
			success: function(data){
			}
		});
	}
	function enviarLogin(){
		$("#login").submit();
	}
	function abrirLogin(){
		$(".modal-title").html("<h3>Entre com seus dados cadastrados</h3>");
		$(".modal-body").html("<form action='' method='post' id='login' onSubmit='return validarLogin();' ><div class='form-group'><label for=''>E-mail</label><input type='text' name='email' id='email' placeholder='E-MAIL' class='form-control'></div><div class='form-group'><label for=''>Senha</label><input type='password' name='senha' id='senha' placeholder='SENHA' class='form-control'></div><div class='col-md-6 esqueciSenha' onClick='esqueciSenha();'>Esqueci minha senha!</div><div class='col-md-6'><input type='checkbox' name='remember' value='1' checked id='remember'>PERMANECER LOGADO</div><br></form>");
		$(".modal-footer").html("<button type='button' value='Entrar' class='btn btn-primary' onClick='enviarLogin();'>Entrar</button>");
        $(".modal").modal();
	}   
</script>
<?php
	if(!isset($lobby['codigo'])){
		if(isset($usuario['codigo'])){
			$pesquisaLobby = mysqli_query($conexao, "
					SELECT * FROM lobby_equipe_semente
					INNER JOIN lobby_equipe ON lobby_equipe.codigo = lobby_equipe_semente.cod_equipe
					WHERE lobby_equipe_semente.cod_jogador = ".$usuario['codigo']."
					AND lobby_equipe.posicao = 0
				");
			if($lobby = mysqli_fetch_array($pesquisaLobby)){
				header("Location: https://www.esportscups.com.br/ptbr/lobby/".$lobby['cod_lobby']."/");
			}			
		}	
	}	
?>
<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title centralizar" id="exampleModalLabel">Modal title</h5>
      </div>
      <div class="modal-body centralizar">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<header id="menuHeader">
    <nav class="navbar navbar-expand-lg navbar-dark bg-cinza">
    <a class="navbar-brand" href="/ptbr/"><img src="<?php echo $img; ?>logo-beta.png" class="logoHeader" /></a>
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse mainMenu" id="navbarColor01" style="">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="ptbr/sobre/">Sobre Nós <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="ptbr/artigos/">Artigos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="ptbr/caixas/">Caixas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="ptbr/loja/">Loja e$</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Partidas
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="ptbr/jogar/dota2/">Dota 2</a>
                    <a class="dropdown-item" href="ptbr/jogar/gwent/">GWENT</a>
                    <a class="dropdown-item" href="ptbr/jogar/hearthstone/">Hearthstone</a>
                    <a class="dropdown-item" href="ptbr/jogar/lol/">League of Legends</a>
                    <a class="dropdown-item" href="ptbr/jogar/overwatch/">Overwatch</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="ptbr/rifas/">Rifas</a>
            </li>
        </ul>
        <?php
            if(isset($usuario['codigo'])){
            ?>
                <div class="col centralizar saldosHeader">
                    <a href="ptbr/usuario/<?php echo $usuario['codigo']; ?>/carteira-escoin/">
                        <div class="saldo">
                            e$ <?php echo number_format($usuario['pontos'], 0, '', '.'); ?>
                        </div>
                    </a>
                    <a href="ptbr/usuario/<?php echo $usuario['codigo']; ?>/carteira-real/">
                        <div class="saldo">
                            R$ <?php echo number_format($usuario['saldo'], 2, ',', '.'); ?>
                        </div>
                    </a>
                </div>
            <?php
            }
        ?>
        
        <form class="form-inline">
            <?php
                if(isset($usuario['codigo'])){
                ?>
                    <div class="caixaUsuario">
                        <div class="caixaTres">
                        <?php
                            $pesquisaNotificacoes = mysqli_query($conexao, "
                                SELECT * FROM notificacao WHERE cod_jogador = ".$usuario['codigo']." AND status = 0
                            ");
                            if(mysqli_num_rows($pesquisaNotificacoes) > 0){
                            ?>
                                <img src="img/icones/notificacao_not.png" class="fotoPerfil" onClick="abrirNotificacoes(<?php echo $usuario['codigo']; ?>);">
                            <?php
                            }else{
                            ?>
                                <img src="img/icones/notificacao.png" class="fotoPerfil">
                            <?php
                            }
                    
                            $pesquisaAmizadesPendentes = mysqli_query($conexao, "
                                SELECT * FROM jogador_amizades
                                WHERE cod_jogador2 = ".$usuario['codigo']."
                                AND status = 0
                            ");
                            if(mysqli_num_rows($pesquisaAmizadesPendentes) > 0){
                            ?>
                                <img src="img/icones/amigos_not.png" class="fotoPerfil">
                            <?php
                            }else{
                            ?>
                                <img src="img/icones/amigos.png" class="fotoPerfil">
                            <?php
                            }
                        ?>
                        </div>
                        <div class="caixaUm">
                            <?php echo $usuario['nome']." '".$usuario['nick']."' ".$usuario['sobrenome']; ?><br>
                            <div class="link">
                                <a href="ptbr/logout.php">Sair</a>
                            </div>
                            <div class="link">
                                <a href="ptbr/usuario/<?php echo $usuario['codigo']; ?>/">Minha Conta</a>
                            </div>
                        </div>
                        <div class="caixaDois">
                            <img src="img/<?php echo $usuario['foto_perfil']; ?>" class="fotoPerfil">
                        </div>  
                        
                    </div>
                <?php
                }else{
                ?>
                    <input type="button" class="btn btn-azul" value="Cadastro" onClick="cadastro();" />
                    <input type="button" class="btn btn-laranja" value="Entrar" onClick="abrirLogin();" />   
                <?php
                }
            ?>            
        </form>
    </div>
    </nav>
</header>




