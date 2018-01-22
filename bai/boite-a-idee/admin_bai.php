<head>
    <link href="../../wp-content/themes/lana-blog enfant/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>

<h3>Vos idées !</h3>
<div id="refresh">
    <a href="admin_bai.php"><button id="refresh-button" type="button" class="btn btn-primary glyphicon glyphicon-refresh"></button></a>
</div>
    <!-- À appeler plusieurs fois en créant une classe -->
    <?php 
    $bdd = new PDO('mysql:host=localhost;dbname=indemodable;charset=utf8', 'root', '');

    $reponse = $bdd->query("SELECT * FROM boite_a_idees"); 
    while($donnees = $reponse->fetch())
    {
    ?>
    	<table id="idee" align="center">
        	<tr>
            	<td><?php echo $donnees['texte'];?></td>
        	</tr>
    	</table>
        <div id="buttons">
            <a href="../app/delete.php?id=<?php echo $donnees['id'];?>"><input id="inputbuttons" type="submit" name="delete" value="X" class="btn btn-danger"></a><?php if($donnees['valide'] == '0'){ ?><a href="../app/confirm.php?id=<?php echo $donnees['id'];?>"><input id="inputbuttons" type="submit" name="valide" value="O" class="btn btn-success"></a><?php } else { };?>
        </div>
    <?php
	}
    ?>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- JavaScript Boostrap plugin -->
    <script src="../../wp-content/plugins/lana-widgets/assets/js/bootstrap.min.js"></script>