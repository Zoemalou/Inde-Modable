<h3>Vos idées !</h3>
    <div>
    <?php 
    $bdd = new PDO('mysql:host=localhost;dbname=indemodable;charset=utf8', 'root', '');

    $affichage = query("SELECT * FROM boite_a_idees"); 
    while($donnees = $affichage->fetch())
    {
    ?>

    	<table>
        	<tr>
            	<td><?php echo $donnees['texte'];?></td>
        	</tr>
    	</table>
	</div>
    <?php
	}
    ?>