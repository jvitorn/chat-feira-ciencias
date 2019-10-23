<?php
	require_once 'botFunctions.php';

	$id_perg = isset($_POST['id_pergunta'])? $_POST['id_pergunta'] : 0;
	//se tiver conexao com o DB acessa o resto do script
	if(!empty($conn)){
		/* se tiver mensagem e nao tiver o id da pergunta
		 * quer dizer que nao é uma resposta a uma pergunta feita pelo bot
		 * entao o bot vai procurar uma resposta para o que o usuario falou.
		 */
		if(isset($_POST['mensagem']) && $id_perg == 0){
			echo json_encode( botResponde($_POST['mensagem'], $_POST['finalizaCiclo'] ));
		}

		//se tiver mensagem e tiver id de pergunta, quer dizer que é uma resposta
		//a uma pergunta que o bot fez.
		if(isset($_POST['mensagem']) && $id_perg > 0){

			botCapturaResposta($_POST['mensagem'], $id_perg);
			echo json_encode( botResponde($_POST['mensagem'], $_POST['finalizaCiclo']));
		}

		//se a chamada é para o bot fazer uma pergunta...
		if(isset($_POST['botPergunta'])){
			echo json_encode( botPergunta());
		}
	}
	