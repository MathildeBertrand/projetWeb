#!/usr/bin/perl -w

#author : Mathilde Bertrand

#Purpose: Ce script nous permet de parser le fichier db_enzyme.txt
#qui nous servent pour le projet de programmation web.
#la sortie de ce script est une table de hash qui pour chaque EC number contient les differentes informations qui lui sont associees


#Usage: perl parseur1.pl

open CODE,"db_enzyme.txt";
%hash;
while(<CODE>)
{
	chomp;
	
	@tmp=split(/\t/,$_);#Tableau qui contient les differents champs de la ligne
	
	#On recupere le nom des enzymes
	$EC=shift(@tmp); 
	$EC=substr($EC,6); #On coupe<EC>
	$EC=reverse($EC);
	$EC=substr($EC,5); #On coupe</EC>
	$EC=reverse($EC);
	#print "$EC\n";
	
	#On recupere le S_Name
	$s_name=$tmp[0];
	$s_name=substr($s_name,8);
	$s_name=reverse($s_name);
	$s_name=substr($s_name,10);
	$s_name=reverse($s_name);
	#print "$s_name\n";
	
	#On recupere le o_Name : 
	$o_name=$tmp[1];
	$o_name=substr($o_name,8);
	$o_name=reverse($o_name);
	if(length($o_name)>6){
		$o_name=substr($o_name,9);
	}else{ #Cas ou il ny a pas de o_name
		$o_name=substr($o_name,6);
	}
	$o_name=reverse($o_name);
	#print "$o_name\n";
	
	
	#On recupere la reaction 
	$reac=$tmp[2];
	$reac=substr($reac,10);
	$reac=reverse($reac);
	if(length($reac)>8){ 
		$reac=substr($reac,11);
	}else{ #Cas ou il ny a pas de reactions
		$reac=substr($reac,9);
	}
	$reac=reverse($reac);
	#print "$reac\n";
	
	
	#On recupere les cofacteurs
	$cof=$tmp[3];
	$cof=substr($cof,11);
	$cof=reverse($cof);
	if(length($cof)>10){
		$cof=substr($cof,12);
	}else{
		$cof=substr($cof,10);
	}
	$cof=reverse($cof);
	#print "$cof\n";
	
	
	#On recupere les commentaires
	$comments=$tmp[4];
	$comments=substr($comments,10);
	$comments=reverse($comments);
	if(length($comments)>9){
		$comments=substr($comments,11);
	}else{
		$comments=substr($comments,10);
	}
	$comments=reverse($comments);
	#print "$comments\n";
	
	#On recupere les maladies sil y en a
	$disease=$tmp[5];
	$disease=substr($disease,9);
	$disease=reverse($disease);
	if(length($disease)>8){
		$disease=substr($disease,10);
	}else{
		$disease=substr($disease,8);
	}
	$disease=reverse($disease);
	#print "$disease\n";
	
	#Champs prosite
	$prosite=$tmp[6];
	$prosite=substr($prosite,9);
	$prosite=reverse($prosite);
	if(length($prosite)>8){
		$prosite=substr($prosite,10);
	}else{
		$prosite=substr($prosite,8);
	}
	$prosite=reverse($prosite);
	#print "$prosite\n";
	
	#Champs Swissprot
	$sp=$tmp[7];
	$sp=substr($sp,11);
	$sp=reverse($sp);
	if(length($sp)>10){
		$sp=substr($sp,12);
	}else{
		$sp=substr($sp,10);
	}
	$sp=reverse($sp);
	#print "$sp\n";
	
	#On stocke toutes les information dans un tableau de hash
	#@parseur=($EC,$s_name,$o_name,$reac,$cof,$comments,$disease,$prosite,$sp);
	#push @parseur2,[@parseur];
	
	
	if (exists $hash{$EC}){	#Si le numero EC a deja ete vu, on ne remplit pas la table de hash
		print 1;
	}else{#sinon on remplit la table
		$hash[0]{$EC}=$EC;
		$hash[1]{$EC}=$s_name;
		$hash[2]{$EC}=$reac;
		$hash[3]{$EC}=$cof;
	}

}
close CODE;


for $j(keys %{$hash[$i]}){
		print "$hash[0]{$j}\n";
	}




