<?php
	require_once 'conn.php';

	$id_resp = isset($_POST['id_pergunta'])? $_POST['id_pergunta'] : 0;

	if(isset($_POST['mensagem']) && $id_resp == 0){
		
		//query para procurar a pergunta/ texto
		$sql = "SELECT * FROM pergunta WHERE nm_pergunta = '". $_POST['mensagem'] ."'";
		$res = mysqli_query($conn, $sql);
		
		//se existir essa pergunta...
		if($res->num_rows > 0){
			$pergunta_f = mysqli_fetch_assoc($res);
			$id_pergunta = $pergunta_f['id_pergunta'];

			if($pergunta_f['tem_resposta'] == "sim"){

				$sql = "SELECT * FROM resposta WHERE id_pergunta = '".$id_pergunta."' ";
				
				$res = mysqli_query($conn, $sql);
				while($fetch = mysqli_fetch_assoc($res)){
					$resposta_f[] = $fetch;
				}

				$resp_escolhida = rand(0, (count($resposta_f) -1));
				echo $resposta_f[$resp_escolhida]['nm_resposta'];

			}else{
				
				echo "Desculpe, mas eu nao sei como te responder isso... irei pesquisar sobre!";
			}
	
		}else{

			$sql = 'INSERT INTO 
						pergunta (id_pergunta, nm_pergunta, tem_resposta) 
					VALUES (null,"'.$_POST['mensagem'].'","nao")';

			mysqli_query($conn, $sql);

			echo "Desculpe, mas eu nao sei como te responder isso... irei pesquisar sobre!";
		}
	}

	if(isset($_POST['mensagem']) && $id_resp > 0){
		$sql = "INSERT INTO resposta (id_resposta, id_pergunta, nm_resposta) 
				VALUES (null,'".$id_resp."','".$_POST['mensagem']."')";

		mysqli_query($conn, $sql);

		$sql = "UPDATE pergunta SET tem_resposta = 'sim' WHERE id_pergunta = '".$id_resp."' ";

		mysqli_query($conn, $sql);		
	}

	if(isset($_POST['verificarPerguntas'])){
		
		$sql = 'SELECT * FROM pergunta WHERE nm_pergunta LIKE "%?"';
		$res = mysqli_query($conn, $sql);
		
		if($res->num_rows > 0){
			while($fetch = mysqli_fetch_assoc($res)){
				
				if(substr($fetch['nm_pergunta'],-1) == "?" ){
					$pergunta_f[] = $fetch;
				}
			}

			$resp_escolhida = rand(0, (count($pergunta_f) -1));
			$json['status'] = 1;
			$json['msg'] = 	$pergunta_f[$resp_escolhida]['nm_pergunta'];
			$json['id_pergunta'] = $pergunta_f[$resp_escolhida]['id_pergunta'];

			echo json_encode($json);	
		}
	}