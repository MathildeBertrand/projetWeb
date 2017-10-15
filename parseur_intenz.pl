#!/usr/bin/perl -w

#author : Mathilde Bertrand

#Purpose: Ce script nous permet de parser le fichier intenz.txt
#qui nous servent pour le projet de programmation web.
#la sortie de ce script est une table de hash qui pour chaque EC number contient les differentes informations qui lui sont associees

#Usage: perl parseur_intenz.pl


open CODE2,"intenz.txt";
while(<CODE2>)
{
	chomp;
	@tmp=split(/\t/,$_);#Tableau qui contient les differents champs de la ligne
	
	#Pour chaque champs, on va recuperer la balise et son contenu
	foreach $valeur(@tmp){
			@res2 = split(/</,$valeur);
			@rescontenu=split(/>/,$res2[1]);
		
			$contenu=$rescontenu[1]; #Contenu de la balise
			#print "$contenu\n";
			
			$balise=$rescontenu[0];
			#print "$balise\n";
			
			#On stocke les differents champs dans les variables
			if($balise=~/ec/){
				#print "$balise\n";
				$EC=$contenu;
				#print "$EC\n";
				
			}elsif($balise=~/accepted_name/){
				#print "$balise\n";
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
			
			#On stocke toutes les information dans un tableau de hash
		
	
			if (exists $hash{$EC}){	#Si le numero EC a deja ete vu, on ne remplit pas la table de hash
				print 1;
			}else{#sinon on remplit la table
				$hash[0]{$EC}=$EC;
				$hash[1]{$EC}=$accepted_name;
				$hash[2]{$EC}=$comment;
				$hash[3]{$EC}=$authors;
				$hash[4]{$EC}=$title;
				$hash[5]{$EC}=$year;
				$hash[6]{$EC}=$volume;
				$hash[7]{$EC}=$first_page;
				$hash[8]{$EC}=$last_page;
				$hash[9]{$EC}=$pubmed;
				$hash[10]{$EC}=$medline;
				$hash[11]{$EC}=$history;
			}
			
	}

}
close CODE2;
