#!/usr/bin/perl -w

#-------------------------------------------------------------------------------------
#author : Mathilde Bertrand
#Purpose: Ce script nous permet de parser le fichier intenz.txt
#qui nous servent pour le projet de programmation web.
#la sortie de ce script est une table de hash qui pour chaque EC number contient les differentes informations qui lui sont associees
#Usage: perl parseur_intenz.pl
#-------------------------------------------------------------------------------------

#Importation des donnees du premier fichier parse
open CODE2,"intenz.txt";

#Ecriture dans les fichier de sortie
open (FICHIER, ">publiInsertion.txt") || die ("Vous ne pouvez pas créer le fichier \"publiInsertion.txt\""); #pour les tables Publication et Ecrire
open (FICHIER1, ">NamesInsertion.txt") || die ("Vous ne pouvez pas créer le fichier \"NamesInsertion.txt\""); #pour la table Names et a pour possedNom

while(<CODE2>)
{
	chomp;
	@tmp=split(/\t/,$_);#Tableau qui contient les differents champs de la ligne
	
	#Pour chaque champs, on va recuperer la balise et son contenu
	foreach $valeur(@tmp){
			@res2 = split(/</,$valeur);
			@rescontenu=split(/>/,$res2[1]);
		
			$contenu=$rescontenu[1]; #Contenu de la balise
			$balise=$rescontenu[0];
			
			#On stocke les differents champs dans les variables
			if($balise=~/ec/){
				$EC=$contenu;	
			}elsif($balise=~/accepted_name/){
				$accepted_name=$contenu;
				print "$accepted_name\n";
			}elsif($balise=~/systematic_name/){
				$systemactic=$contenu;
				
			}elsif($balise=~/synonym/){
				$synonym=$contenu;
			}elsif($balise=~/comment/){
				$comment=$contenu;
			}elsif($balise=~/authors/){
				$authors=$contenu;
			}elsif($balise=~/title/){
				$title=$contenu;
			}elsif($balise=~/year/){
				$year=$contenu;
			}elsif($balise=~/volume/){
				$volume=$contenu;
			}elsif($balise=~/first_page/){
				$first_page=$contenu;
			}elsif($balise=~/last_page/){
				$last_page=$contenu;
			}elsif($balise=~/pubmed/){
				$pubmed=$contenu;
			}elsif($balise=~/medline/){
				$medline=$contenu;
			}elsif($balise=~/history/){
				$history=$contenu;
			}
				

	}
	#Ecriture dans le fichier de sortie
	print FICHIER "INSERT INTO Publication(titre,auteurs,first_page,last_page,volume,pubmed,medline) VALUES('".$title."','".$authors."','".$first_page."','".$last_page."','".$volume."','".$pubmed."','".$medline."')". "\n";
	#print FICHIER "INSERT INTO Ecrire (num_EC,pubmed)VALUES('".$EC."','".$pubmed. "')". "\n";
	
	#print FICHIER1 "INSERT INTO Names(accepted_name,synonym_name) VALUES('".$accepted_name."','".$synonym. "')". "\n";
	#print FICHIER1 "INSERT INTO PossedeNom (num_EC,accepted_name)VALUES('".$EC."','".$accepted_name. "')". "\n";
}
close CODE2;






