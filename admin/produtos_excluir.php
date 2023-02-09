<?php 
include "../conn/connect.php";
// $conn->query("delete from tbprodutos where id_produto = ".$_GET['id_produto']);

$conn->query("update from tbprodutos where id_produto = ".$_GET['id_produto']);
header("location: produtos_lista.php")

?>