<?php
/*
*Query para manipulação de Banco de Dados
*@author  Eduardo Ferreira
*/
class Banco {
//iniciando class conexão com PDO
	private $pdo;
	private $numRows;
	private $array;

	public function __construct($host, $dbname, $dbuser, $dbpass){
		try{
		$this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host, $dbuser, $dbpass);
		} catch(PDOexception $e){
			echo "Falhou : ".$e->getMessage();
		}
	}

	public function query($sql){
		$query = $this->pdo->query($sql);
		$this->numRows = $query->rowCount();
		$this->array = $query->fetchAll();
	}
//função para resultado da query
	public function result(){
		return $this->array;
	}
//contar quantos dados tem no BD
	public function numRows(){
		return $this->numRows;
	}
//inserindo no BD
	public function insert($table, $data){
		if(!empty($table) && ( is_array($data) && count($data) > 0  )){
			$sql = "INSERT INTO ".$table." SET ";
			$dados = array();
			foreach($data as $chave =>$valor){
				$dados[] = $chave." = '".addslashes($valor)."'";
			}
			$sql = $sql.implode(", ", $dados);
			$this->pdo->query($sql);
		}
	}
//Atualizando no BD
public function update($table, $data, $where = array(), $where_cond = "AND"){

	if(!empty($table) && ( is_array($data) && count($data) > 0) && is_array($where)){
		$sql = "UPDATE ".$table." SET ";
			$dados = array();
			foreach($data as $chave =>$valor){
				$dados[] = $chave." = '".addslashes($valor)."'";
			}
			$sql = $sql.implode(", ", $dados);

			if(count($where) > 0){
					$dados = array();
				foreach($where as $chave =>$valor){
					$dados[] = $chave." = '".addslashes($valor)."'";
				}
				$sql = $sql." WHERE ".implode(" ".$where_cond." ", $dados);
			}
			$this->pdo->query($sql);
			
	}

}

	public function delete($table, $where, $where_cond = "AND") {
		if(!empty($table) && ( is_array($where) && count($where)> 0 )){
			$sql = "DELETE FROM ".$table;

			if(count($where) > 0){
					$dados = array();
				foreach($where as $chave =>$valor){
					$dados[] = $chave." = '".addslashes($valor)."'";
				}
				$sql = $sql." WHERE ".implode(" ".$where_cond." ", $dados);
			}
			
			$this->pdo->query($sql);

		}

	}

}
?>