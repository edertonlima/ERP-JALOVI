<?php
	include 'include/login.php';
	include 'include/function.php';

	global $mysqli;

	$query = "SELECT * FROM `marca` WHERE (sonatualizar_li='S') LIMIT 1";

	$result = $mysqli->query($query);
	$count = 0;
    
    while ($row = $result->fetch_object()){
        $nova_categoria[] = $row;
        $count = $count+1;

        if($row->intmarca_li == NULL){

        	echo '<br>NULL';
        	marca(NULL,$row);

        }else{
        	echo '<br>'.$row->intmarca_li;
        }

        echo '<br><br>';
        var_dump($row);

    }

/*if($_GET['qtd'] == 's'){
	echo '<font color="red">' . $count . '</font> NOVAS MARCAS<BR>';
}

if($_GET['log'] == 's'){
	var_dump($nova_categoria);
}

	//echo(json_encode($user_arr));
	//var_dump($user_arr);



	$query = "SELECT * FROM `marca` WHERE (sonatualizar_li='S') AND (intmarca_li IS NOT NULL)";

	$result = $mysqli->query($query);
	$count = 0;
    
    while ($row = $result->fetch_object()){
        $atualiza_categoria[] = $row;
        $count = $count+1;


        var_dump($row);
    }*/

/*
if($_GET['qtd'] == 's'){
	echo '<font color="red">' . $count . '</font> ATUALIZAÇÃO DE MARCAS<BR>';
}

if($_GET['log'] == 's'){
	var_dump($atualiza_categoria);
}*/
	



/*	$query = "SELECT * FROM `marca` WHERE (sonatualizar_li='S') AND (sonremovido = 'S')";

	$result = $mysqli->query($query);
	$count = 0;
    
    while ($row = $result->fetch_object()){
        $remove_categoria[] = $row;
        $count = $count+1;
    }


if($_GET['qtd'] == 's'){
	echo '<font color="red">' . $count . '</font> MARCAS PARA EXCLUIR<BR>';
}

if($_GET['log'] == 's'){
	var_dump($remove_categoria);
}*/
	
?>