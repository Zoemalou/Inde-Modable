<meta http-equiv="refresh" content="2; URL=../boite-a-idee/">

<?php

try {
// Connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=indemodable;charset=utf8', 'root', '');

// On enregistre dans une variable la valeur de l'idée

$idee = $_POST['idee'];

// On ajoute une entrée dans la table jeux_video
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = ("INSERT INTO boite_a_idees(texte, valide) VALUES ('$idee', '0')");
$bdd->exec($sql);
echo "Votre idée a bien été ajoutée à notre base de données !";
}
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$bdd = null;
?>