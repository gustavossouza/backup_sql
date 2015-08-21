<?php

class backup_bd{
		public $bancodados;
		public $user;
		public $host;
		public $pass;
		public $tabelas;
		public $path;
		public $loja;
		public $salvar_bd;
		
		public function __construct(){
			$this->bancodados="";
			$this->user="";
			$this->pass="";
			$this->tabelas="";
			$this->path="";
			$this->loja=""; 
			$this->salvar_bd="";
		}
		public function backup_bd(){
			mysql_connect($this->host,$this->user,$this->pass) or die(mysql_error());
			mysql_select_db($this->bancodados) or die(mysql_error());
			$sql = "";
			$sql2= "";

			$sql .= "CREATE DATABASE IF NOT EXISTS {$this->bancodados};\n\n";
			if(!$this->tabelas){
				$listar_tbls = mysql_query("SELECT table_name as tbl FROM INFORMATION_SCHEMA.TABLES WHERE table_schema = '{$this->bancodados}'") or die(mysql_error());
			}else{
				$listar_tbls = mysql_query("SELECT table_name as tbl FROM INFORMATION_SCHEMA.TABLES WHERE table_schema = '{$this->bancodados}' and table_name = '{$this->tabelas}'") or die(mysql_error());
			}
				while($mostrar_tbls = mysql_fetch_array($listar_tbls)){
					$info_tbls = mysql_query("show create table {$mostrar_tbls['tbl']}") or die(mysql_error());
					
					while($mostrar_info = mysql_fetch_array($info_tbls)){
							$sql .= "DROP TABLE IF EXISTS {$mostrar_tbls['tbl']};\n".$mostrar_info['Create Table'].";";
							$sql .= "\n\n";
							$sql_insert = mysql_query("select * from {$mostrar_tbls['tbl']} WHERE id_loja={$this->loja} and status=1"); // LOJA 2 CABURGO
							while($listar_info = mysql_fetch_array($sql_insert)){
								$sql2 .= "(";
								for($i=0;$i<count($listar_info);$i++){
									if(isset($listar_info[$i])){
										$sql2 .= "'".$listar_info[$i]."',";
									}
								}						
								$sql2 .=".),.";
								$sql .= "INSERT INTO {$mostrar_tbls['tbl']} VALUES {$sql2} ;\n";
								$sql2 = "";
							}
					}
						$sql .= "\n\n";
				}
					$sql = str_replace(",.","",$sql);
				if($sql){
					$data = date('d-m-y');
					file_put_contents("{$this->path}{$data}_{$this->salvar_bd}.sql",$sql);
					file_put_contents("bkp_bd/backup.txt","{$data}_{$this->salvar_bd}");
				}
		}
}

	// DEVELOPER : GUSTAVO HENRIQUE COPYRIGHT
	// EMPRESA : CREATIVE CTECH DESIGN
	// EMAIL DO RESPONSÁVEL : gustavohsantos2009@hotmail.com
	// PARA ALTERAR OS CÓDIGOS NÃO É NECESSÁRIO COMUNICAR COMIGO!

?>
