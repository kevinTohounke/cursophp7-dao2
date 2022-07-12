<?php

require_once("config.php");

//Carrega um usuario :
/*
$root = new Usuario();

$root->loadById(3);

echo $root;
*/

//Carrega uma lista; de usuario:
/*
$lista = Usuario::getList();

echo json_encode($lista);
*/

//Carrega uma lista buscando pelo Login:
/*
$busca = Usuario::search("Big K");

echo json_encode($busca);
*/
// Carrega uma lista usando login e senha

$user = new Usuario();

$user->login("Bigfasdf","acredita");

echo $user;


 ?>