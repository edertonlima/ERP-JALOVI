<?php
	include 'login.php';

	global $mysqli;

	$query = "SELECT * FROM `categoria` WHERE (sonatualizar_li='S') AND (intcategoria_li IS NULL)";

	$result = $mysqli->query($query);
	$count = 0;
	$nova_categoria = '';
    
    if($result->num_rows > 0){
	    while ($row = $result->fetch_object()){
	        $log_nova_categoria[] = $row;

	        /*$categorias .= "{
	        	\"id_externo\": null, 
	        	\"nome\": ". $row->desnome .", 
	        	\"descricao\": ". $row->desdescricao .", 
	        	\"categoria_pai\": null
	        }";*/

	        $id = $row->codcategoria;
	        //echo '<br>';

	        $nova_categoria = "{
				\"id_externo\": null,
				\"nome\": \"".$row->desnome."\",
				\"descricao\": \"".$row->desdescricao.".\",
				\"categoria_pai\": null
			}";
	        $count = $count+1;


			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, "https://api.awsli.com.br/v1/categoria?format=json&chave_api=1c3e5a085f0ba391a22e&chave_aplicacao=f5486b82-8b01-405b-a277-3e529207a1ec");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);

			curl_setopt($ch, CURLOPT_POST, TRUE);

			curl_setopt($ch, CURLOPT_POSTFIELDS, $nova_categoria);
			//curl_setopt($ch, CURLOPT_POSTFIELDS, "");

			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			  "Content-Type: application/json"
			));

			$response = curl_exec($ch);
			curl_close($ch);

			var_dump($response);
			echo '<br><br>';

					$categoria = json_decode($response, true);
					//var_dump($categoria);
					//echo $categoria['id'];

					//echo $response->id;
					$query_update = "UPDATE categoria SET sonatualizar_li='N', intcategoria_li= '{$categoria['id']}' WHERE codcategoria='{$id}'"; 

					if ($mysqli->query($query_update) === TRUE) {
						//$editar = array('ct_id' => $ct_id, 'ct_nome' => $ct_nome, 'ct_color' => $ct_color);
						//return $editar;
						//echo json_encode($editar);
						//echo '<br>ok<br>';
					} else {
						echo(json_encode($mysqli->error));
					}

	    }
	}

	if($_GET['qtd'] == 's'){
		echo '<BR><font color="red">' . $count . '</font> CATEGORIAS CRIADAS<BR>';
	}

	if($_GET['log'] == 's'){
		var_dump($log_nova_categoria);
	}











	$query = "SELECT * FROM `categoria` WHERE (sonatualizar_li='S') AND (intcategoria_li IS NOT NULL)";

	$result = $mysqli->query($query);
	$count = 0;
	$nova_categoria = '';
    
    if($result->num_rows > 0){
	    while ($row = $result->fetch_object()){
	        $log_nova_categoria[] = $row; var_dump($row);

	        //echo '<br><br>';
	        $id = $row->codcategoria;
	        //echo '<br><br>';
	        //echo $row->intcategoria_li;

	        if(empty($row->intcategoria_pai_li)){
	        	$cat_pai = 'null';
	        	echo '<br> não tem PAI<br><br>';
	        }else{
	        	$cat_pai = $row->intcategoria_pai_li;
	        	echo '<br> tem PAI<br><br>';
	        }

	        $nova_categoria = "{
				\"nome\": \"".$row->desnome."\",
				\"descricao\": \"".$row->desdescricao.".\",
				\"categoria_pai\": ".$cat_pai."
			}";
	        $count = $count+1;

			$ch = curl_init();

			$url_categoria = "https://api.awsli.com.br/v1/categoria/".$row->intcategoria_li."?format=json&chave_api=1c3e5a085f0ba391a22e&chave_aplicacao=f5486b82-8b01-405b-a277-3e529207a1ec";
			curl_setopt($ch, CURLOPT_URL, $url_categoria);

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);

			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

			curl_setopt($ch, CURLOPT_POSTFIELDS, "{
			  \"nome\": \"Camisetas decorativas\",
			  \"categoria_pai\": null
			}");

			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			  "Content-Type: application/json"
			));

			$response = curl_exec($ch);
			curl_close($ch);

			echo '<br><br>';
			var_dump($response);
			echo '<br><br>';

					$categoria = json_decode($response, true);
					//var_dump($categoria);
					//echo $categoria['id'];

					//echo $response->id;
					$query_update = "UPDATE categoria SET sonatualizar_li='N' WHERE codcategoria='{$id}'"; 

					if ($mysqli->query($query_update) === TRUE) {
						//$editar = array('ct_id' => $ct_id, 'ct_nome' => $ct_nome, 'ct_color' => $ct_color);
						//return $editar;
						//echo json_encode($editar);
						//echo '<br>ok<br>';
					} else {
						echo(json_encode($mysqli->error));
					}

	    }
	}

	if($_GET['qtd'] == 's'){
		echo '<BR><font color="red">' . $count . '</font> CATEGORIAS ATUALIZADAS<BR>';
	}

	if($_GET['log'] == 's'){
		var_dump($log_nova_categoria);
	}
	



/*


	$query = "SELECT * FROM `categoria` WHERE (sonatualizar_li='S') AND (sonremovido = 'S')";

	$result = $mysqli->query($query);
	$count = 0;
    
    while ($row = $result->fetch_object()){
        $remove_categoria[] = $row;
        $count = $count+1;
    }


if($_GET['qtd'] == 's'){
	echo '<BR><font color="red">' . $count . '</font> CATEGORIAS PARA EXCLUIR<BR>';
}

if($_GET['log'] == 's'){
	var_dump($remove_categoria);
}
	*/

	$mysqli->close();	

?>