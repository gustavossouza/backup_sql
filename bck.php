<?php

	include_once "classe.php";
	$bck = new backup_bd();
	
	// Nome do banco dados
	$bck -> bancodados="autogest_sistema";
	// Se você comentar $bck -> tabelas irá fazer backup banco dados inteiro, caso contrário irá fazer backup especifico tabelas.
	$bck -> tabelas ="tbl_gestor";
	// HOST
	$bck -> host="localhost";
	// USER
	$bck -> user="root";
	// PASSWORD/SENHA
	$bck -> pass="";
	// CAMINHO PARA SALVAR, DEIXAR EM BRANCO... IRÁ SALVAR LOCAL AONDE ESTÁ O ARQUIVO.
	// $bck -> patch ="../" <- IRÁ SALVAR PASTA ANTERIOR.
	$bck -> path="../";
	// CHAMANDO O CLASS PARA EXECUTAR BACKUP
	$bck->backup_bd();




	// DEVELOPER : GUSTAVO HENRIQUE COPYRIGHT
	// EMPRESA : CREATIVE CTECH DESIGN
	// EMAIL DO RESPONSÁVEL : gustavohsantos2009@hotmail.com
	// PARA ALTERAR OS CÓDIGOS NÃO É NECESSÁRIO COMUNICAR COMIGO!
?>
