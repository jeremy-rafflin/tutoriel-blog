#!/cli/php
<?php
/*
* On lit le fichier livre.csv et on met en forme dans un tableau
*/
if($fichier = @fopen('livre.csv','r')) {//on ouvre le fichier en lecture

	$info=array();
	while(($data=fgetcsv($fichier)) != false) {
		$info[]=$data;//on met les informations dans un tableau
	}
	fclose($fichier);
}
/*
*On affiche toutes les informations avec un ID pour que l'utilisateur choisisse quel livre il souhaite modifier
*/
$id=1;//on initialise l'ID à incrémenter
echo "\nListe des livres présents dans le fichier : \n\n\n";
echo " Nom du livre | Nom auteur | public visé \n\n";
foreach($info as $ligne) {//On liste toutes les infos qui étaient dans le fichier
	echo "$id : ".$ligne[0]." | ".$ligne[1].' | '.$ligne[2]."\n";
	$id++;
}
echo "Entrez l'ID du livre que vous souhaitez modifier : \n";
$val=(int)trim(fgets(STDIN));//on récupère l'id au format entier
if($val==0||$val>($id-1)) { //on vérifie que l'id est compris entre 1 et le nombre de livres
	echo "ID invalide \n";
} else { //ici on propose de modifier les données du livre
	echo "Entrez le nouveau nom du livre (qui remplacera '".$info[$val-1][0]."'): \n";
	$nom_livre=trim(fgets(STDIN));
	echo "Entrez le nouveau nom d'auteur (qui remplacera '".$info[$val-1][1]."'): \n";
	$nom_auteur=trim(fgets(STDIN));
	echo "Entrez le public concerné (qui remplacera '".$info[$val-1][2]."'): \n";
	$public=trim(fgets(STDIN));
	$donnees = array($nom_livre,$nom_auteur,$public);/*on met les données dans un tableau pour les écrire dans le fichier csv*/
	/*
	*On insère les données dans le fichier avec les nouvelles données
	*/
	if($fichier = @fopen('livre.csv','w')){
		foreach($info as $ligne) {//On liste toutes les infos qui étaient dans le fichier
			if($id==$val)
				fputcsv($fichier, $donnees);
			else
				fputcsv($fichier, $ligne);
			$id++;
		}
	}
	fclose($fichier);
	echo "Modifications enregistrées. \n";
}
?> 
