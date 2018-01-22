<?php 
    $bdd = new PDO('mysql:host=localhost;dbname=indemodable;charset=utf8', 'root', '');

    $id = $_GET['id'];

    $bdd->exec("UPDATE `boite_a_idees` SET `valide`='1' WHERE id = $id");
    header('Location: ../boite-a-idee/admin_bai.php');
    exit();
 ?>