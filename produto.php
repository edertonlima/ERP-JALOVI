<?php
	include 'login.php';

	global $mysqli;

	$query = "SELECT * FROM `produto` WHERE (sonatualizar_produto_li='S') AND (intproduto_li IS NULL)";

	$result = $mysqli->query($query);
	$count = 0;
	$nova_categoria = '';
    
    if($result->num_rows > 0){
	    while ($row = $result->fetch_object()){
	        $log_nova_categoria[] = $row; //var_dump($row);

	        /*$categorias .= "{
	        	\"id_externo\": null, 
	        	\"nome\": ". $row->desnome .", 
	        	\"descricao\": ". $row->desdescricao .", 
	        	\"categoria_pai\": null
	        }";*/

	        echo $id = $row->codproduto;
	        //echo '<br>';

	        $nova_categoria = "{
				\"id_externo\": null,
				\"sku\": \"6\",
				\"mpn\": null,
				\"ncm\": null,
				\"nome\": \"".$row->desnome."\",
				\"descricao_completa\": \"".$row->txtdescricao."\",
				\"ativo\": false,
				\"destaque\": false,
				\"peso\": \"".$row->fltpeso."\",
				\"altura\": \"".$row->intaltura."\",
				\"largura\": \"".$row->intlargura."\",
				\"profundidade\": \"".$row->intprofundidade."\",
				\"tipo\": \"normal\",
				\"usado\": false,
				\"removido\": false
			}";
	        $count = $count+1;


			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, "https://api.awsli.com.br/v1/produto?format=json&chave_api=1c3e5a085f0ba391a22e&chave_aplicacao=f5486b82-8b01-405b-a277-3e529207a1ec");
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

					$produto = json_decode($response, true);
					//var_dump($categoria);
					echo '<br><br>'.$produto['id'];

					//echo $response->id;
					$query_update = "UPDATE produto SET sonatualizar_produto_li='S', intproduto_li= '{$produto['id']}' WHERE codproduto='{$id}'"; 

					if ($mysqli->query($query_update) === TRUE) {
						//$editar = array('ct_id' => $ct_id, 'ct_nome' => $ct_nome, 'ct_color' => $ct_color);
						//return $editar;
						//echo json_encode($editar);
						echo '<br>ok<br>';
					} else {
						echo(json_encode($mysqli->error));
					}

	    }
	}

	if($_GET['qtd'] == 's'){
		echo '<BR><font color="red">' . $count . '</font> PRODUTOS CRIADOS<BR>';
	}

	if($_GET['log'] == 's'){
		var_dump($log_nova_categoria);
	}








	$query = "SELECT * FROM `produto` WHERE (sonatualizar_produto_li='S')";

	$result = $mysqli->query($query);
	$count = 0;
	$nova_categoria = '';
    
    if($result->num_rows > 0){
	    while ($row = $result->fetch_object()){
	        $log_nova_categoria[] = $row; //var_dump($row);

	        /*$categorias .= "{
	        	\"id_externo\": null, 
	        	\"nome\": ". $row->desnome .", 
	        	\"descricao\": ". $row->desdescricao .", 
	        	\"categoria_pai\": null
	        }";*/

	        echo $id = $row->codproduto;
	        //echo '<br>';

	        /*echo $nova_categoria = "{
				\"altura\": \"".$row->intaltura."\",
				\"apelido\": \"produto-normal\",
				\"ativo\": true,,
				\"bloqueado\": false,
				\"categorias\": [],
				\"data_criacao\": \"2014-01-06T23:13:59.337504\",
				\"data_modificacao\": \"2014-04-04T13:43:20.239138\",
				\"destaque\": false,
				\"imagem_principal\": null,
				\"imagens\": [],
				\"largura\": \"".$row->intlargura."\",
				\"marca\": \"".$row->intmarca_li."\",
				\"nome\": \"".$row->desnome."\",
				\"pai\": null,
				\"peso\": \"".$row->fltpeso."\",
				\"profundidade\": \"".$row->intprofundidade."\",
				\"ncm\": null,
				\"gtin\": null,
				\"mpn\": null,
				\"removido\": false
				\"sku\": \"".$row->dessku."\",
				\"tipo\": \"normal\",
				\"url_video_youtube\": \"\",
				\"usado\": false
			}";*/

			echo $nova_categoria = "{
  \"id_externo\": null,
  \"sku\": \"prod-simples\",
  \"mpn\": null,
  \"ncm\": null,
  \"nome\": \"".$row->desnome."\",
  \"descricao_completa\": \"".$row->txtdescricao."\",
  \"ativo\": true,
  \"destaque\": false,
  \"peso\": 0.45,
  \"altura\": 2,
  \"largura\": 12,
  \"profundidade\": 6,
  \"tipo\": \"normal\",
  \"usado\": false,
  \"categorias\": [
    \"/api/v1/categoria/1492616/\"
  ],
  \"marca\": \"/api/v1/marca/872588/\",
  \"removido\": false
			}";
	        $count = $count+1;


			$ch = curl_init();

			$url_produto = "https://api.awsli.com.br/v1/produto/".$row->intproduto_li."?format=json&chave_api=1c3e5a085f0ba391a22e&chave_aplicacao=f5486b82-8b01-405b-a277-3e529207a1ec";
			curl_setopt($ch, CURLOPT_URL, $url_produto);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);

			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

			curl_setopt($ch, CURLOPT_POSTFIELDS, $nova_categoria);
			//curl_setopt($ch, CURLOPT_POSTFIELDS, "");

			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			  "Content-Type: application/json"
			));

			$response = curl_exec($ch);
			curl_close($ch);

			var_dump($response);
			echo '<br><br>';

					$produto = json_decode($response, true);
					//var_dump($categoria);
					echo '<br><br>'.$produto['id'];

					//echo $response->id;
					$query_update = "UPDATE produto SET sonatualizar_produto_li='N', intproduto_li= '{$produto['id']}' WHERE codproduto='{$id}'"; 

					if ($mysqli->query($query_update) === TRUE) {
						//$editar = array('ct_id' => $ct_id, 'ct_nome' => $ct_nome, 'ct_color' => $ct_color);
						//return $editar;
						//echo json_encode($editar);
						echo '<br>ok<br>';
					} else {
						echo(json_encode($mysqli->error));
					}

	    }
	}

	if($_GET['qtd'] == 's'){
		echo '<BR><font color="red">' . $count . '</font> PRODUTOS ATUALIZADOS<BR>';
	}

	if($_GET['log'] == 's'){
		var_dump($log_nova_categoria);
	}



/*


	$query = "SELECT * FROM `aaaaa` WHERE (sonatualizar_produto_li='S') AND (intproduto_li IS NOT NULL)";

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
				\"nome\": \"aaaaaaaaa".$row->desnome."\",
				\"descricao\": \"".$row->desdescricao.".\",
				\"categoria_pai\": ".$cat_pai."
			}";
	        $count = $count+1;

			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, "https://api.awsli.com.br/v1/categoria/2497217?format=json&chave_api=1c3e5a085f0ba391a22e&chave_aplicacao=f5486b82-8b01-405b-a277-3e529207a1ec");

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
					$query_update = "UPDATE produto SET sonatualizar_produto_li='N' WHERE codcategoria='{$id}'"; 

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