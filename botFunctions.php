<?php
	require_once 'conn.php';
	function botResponde($fraseUsuario){
		$temResposta = false;

		if(strlen($fraseUsuario) > 3 && (preg_match("/\\s/", $fraseUsuario))){
			$qFrase = ' LIKE "%'. strtoupper($fraseUsuario).'%"';
		}else{
			$qFrase = ' = "'. strtoupper($fraseUsuario).'"';
		}

		//query para verificar se essa frase existe no DB
		$sql = 'SELECT * FROM frase WHERE UCASE(frase) '.$qFrase;
		$res = mysqli_query($GLOBALS['conn'], $sql);
		
		//se existir vai pegar o ID dela
		if($res->num_rows > 0){
			$pergunta_f = mysqli_fetch_assoc($res);
			$id_pergunta = $pergunta_f['id_frase'];

			//após pegar o id da pergunta, vai verificar se existe uma resposta para ela
			$sql = "SELECT * FROM resposta WHERE id_pergunta = '".$id_pergunta."' ";
			$res = mysqli_query($GLOBALS['conn'], $sql);

			//se houver resposta registrada...
			if($res->num_rows > 0){
				$temResposta = true;
				//vai passar todas as respostas para um array
				while($fetch = mysqli_fetch_assoc($res)){
					$resposta_f[] = $fetch;
				}

				$resp = [];
				$respCount = 0;

				foreach($resposta_f as $key => $value){
					
					for($i = 0; $i < $value['frequencia']; $i++ ){
						$resp[$respCount] = $key;
						$respCount++;
					}
				}

				//vai escolher um numero random para selecionar qual resposta usar
				$resp_escolhida = rand(0, ($respCount -1));
				$key = $resp[$resp_escolhida];

				$id_resposta = $resposta_f[$key]['id_resposta'];
				
				//após escolher qual resposta usar, vai pegar a frase usando o id.
				$sql = "SELECT * FROM frase WHERE id_frase = ".$id_resposta;
				$res = mysqli_query($GLOBALS['conn'], $sql);
				$resposta_f = mysqli_fetch_assoc($res);

				$ret['status'] = 1;
				$ret['msg'] = filtroPalavras($resposta_f['frase']);
				$ret['id_pergunta'] = $resposta_f['id_frase'];	
			}
		}
		//se o que o usuário digitou nao estiver registrado...
		if(!$temResposta){
			//registra no DB
			$sql = 'INSERT INTO 
						frase (id_frase, frase) 
					VALUES 
						(null,"'.$fraseUsuario.'")';

			mysqli_query($GLOBALS['conn'], $sql);
			
			$sql = "SELECT * FROM frase WHERE UCASE(frase) LIKE '%".strtoupper($fraseUsuario)."%'";
			$res = mysqli_query($GLOBALS['conn'], $sql);
			$pergunta_f = mysqli_fetch_assoc($res);
			
			$ret['status'] = 1;
			$ret['msg'] = 'Eu nao sei como responder isso, o que eu deveria dizer?';
			$ret['id_pergunta'] = $pergunta_f['id_frase'];
		}

		return $ret;
	}

	function botCapturaResposta($fraseUsuario, $perg){
		//seleciona a resposta
		$temFrase = false;
		$temConexao = false;

		$sql = "SELECT * FROM frase WHERE UCASE(frase) LIKE '%". strtoupper($fraseUsuario)."%'";
		$res = mysqli_query($GLOBALS['conn'], $sql);
		
		//se existir essa frase...
		if($res->num_rows > 0){
			$temFrase = true;
			
			$resposta_f = mysqli_fetch_assoc($res);
			
			//verifica se essa frase tem conexao com a pergunta
			$sql = "SELECT * FROM 
						resposta 
					WHERE 
						id_resposta = ".$resposta_f['id_frase']." 
					AND 
						id_pergunta = ".$perg;

			$res = mysqli_query($GLOBALS['conn'], $sql);
			//se tiver conexao, aumenta a frequencia
			if($res->num_rows > 0){
				$temConexao = true;

				$sql = "UPDATE 
						resposta 
					SET 
						frequencia = frequencia + 1 
					WHERE 
						id_resposta = ".$resposta_f['id_frase']." 
					AND 
						id_pergunta = ".$perg;
			
				mysqli_query($GLOBALS['conn'], $sql);
			//se nao tiver conexao, cria.
			}else{

			}
			
		//se a resposta que o usuario deu para o bot nao existir no DB
		}

		if(!$temFrase){
			//armazena ela e da frequencia 1 para ela, afinal essa foi a primeira vez
			//que alguem respondeu a pergunta do bot com essa resposta.

			//adiciona a frase 
			$sql = "INSERT INTO 
						frase (id_frase, frase)
					VALUES
						(null,'".$fraseUsuario."')";

			mysqli_query($GLOBALS['conn'], $sql);

			$sql = "SELECT * FROM frase WHERE frase = '".$fraseUsuario."' ";
			$res = mysqli_query($GLOBALS['conn'], $sql);
			$resposta_f = mysqli_fetch_assoc($res);
		}
			

		if(!$temConexao){
			//vincula a frase com a resposta
			$sql = "INSERT INTO 
						resposta (id_resp_perg,id_resposta, id_pergunta, frequencia)
					VALUES (null,".$resposta_f['id_frase'].",".$perg.",1)";

			mysqli_query($GLOBALS['conn'], $sql);
		}

	}

	function botPergunta(){

		//seleciona as frases que terminam com ponto de interrogação
		$sql = 'SELECT * FROM frase WHERE frase LIKE "%?"';
		$res = mysqli_query($GLOBALS['conn'], $sql);
		
		//se houver ao menos 1...
		if($res->num_rows > 0){
			//passa td pra 1 array
			while($fetch = mysqli_fetch_assoc($res)){
					$pergunta_f[] = $fetch;
			}
			//escolhe um numero aleatorio
			$resp_escolhida = rand(0, (count($pergunta_f) -1));
			//coloca td em um array
			$ret['status'] = 1;
			$ret['msg'] = 	$pergunta_f[$resp_escolhida]['frase'];
			$ret['id_pergunta'] = $pergunta_f[$resp_escolhida]['id_frase'];
			//retorna o array;
			return $ret;
		}
	}


	function filtroPalavras($mensagem){
		$filtro = [
			'puta','vadia','buceta',
			'corno','viado','cu'
		];

		foreach($filtro as $key => $value){
			$astericos = "";
			for($i = 0;$i < strlen($value); $i++){
				$astericos .= "*";
			}
			$mensagem = str_replace($value, $astericos, $mensagem);
		}
		return $mensagem;
	}