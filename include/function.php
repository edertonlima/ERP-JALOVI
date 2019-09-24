<?php
	function marca($id,$date){
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, "https://api.awsli.com.br/v1/marca?format=json&chave_api=1c3e5a085f0ba391a22e&chave_aplicacao=f5486b82-8b01-405b-a277-3e529207a1ec");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);

		curl_setopt($ch, CURLOPT_POST, TRUE);

		curl_setopt($ch, CURLOPT_POSTFIELDS, "{
		  \"id_externo\": null,
		  \"nome\": \"" . $date->desnome . "\",
		  \"apelido\": \"" . $date->desapelido . "\",
		  \"descricao\": \"" . $date->desdescricao . "\"
		}");

		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		  "Content-Type: application/json"
		));

		$response = curl_exec($ch);
		curl_close($ch);

		var_dump($response);
	}
?>