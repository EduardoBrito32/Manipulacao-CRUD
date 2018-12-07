<?php
require 'banco.php';
//iniciaando conexao com o Baco
$banco = new Banco ("localhost", "blog", "root", "");

	$banco->query("SELECT * FROM post LIMIT 3");
print_r($banco->result());



	//Selecionando BD
$banco->query("SELECT * FROM post");
echo "Numero: ".$banco->numRows();

	//Inserindo BD
	$banco->insert("post", array(
	"titulo" => 'Fulano',
	"corpo" => 'Fulano é o bom '
));
echo "Inserido com sucesso";

	//Atualizando BD
$banco->update("post", 
	array("titulo"=>"Titulo teste updade"),
	array("id"=>"1"));

$banco->delete("post", array("id"=>"2"));
?>