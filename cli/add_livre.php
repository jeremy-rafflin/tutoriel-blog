#!/cli/php
<?php
//on vérifie qu'il y a bien le nombre d'arguments attendus
if($argc != 4) { //si le nombre d'arguments est différent de 4
	echo "Erreur, vous devez fournir au moins 3 arguments au script.\n";
} else {//s'il y a le bon nombre d'arguments
	$titre = $argv[1];//on récupère le titre
	$auteur = $argv[2];//on récupère l'auteur
	$public=$argv[3];//on récupère le public concerné
	$donnees = array($titre,$auteur,$public);/*on les met dans un tableau pour l'écrire dans le fichier csv*/
	/*
	*On ouvre le fichier afin de lire son contenu et ensuite pouvoir le réinsérer
	*/
	if($fichier = @fopen('livre.csv','r')) {//on ouvre le fichier en lecture
		$info=array();
		while(($data=fgetcsv($fichier)) != false)
			$info[]=$data;
		fclose($fichier);
	}
		
	if($fichier = @fopen('livre.csv','w')) {
		foreach($info as $ligne)//on réinsère les données qui étaient déja présentes dans le fichier
			fputcsv($fichier, $ligne);
		fputcsv($fichier, $donnees);//on insère les données qui sont passées en arguments au script
		echo "Vous venez d'ajouter : \n".$titre.' | '.$auteur.' | '.$public."\n";
	}
}
?> 