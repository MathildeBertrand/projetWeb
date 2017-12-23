#!/usr/bin/perl -w

#-------------------------------------------------------------------------------------
#author : Mathilde Bertrand
#Purpose: Ce script nous permet de parser le fichier intenz.txt
#qui nous servent pour le projet de programmation web.
#la sortie est un fichier de requtes sql
#Usage: perl parseur_intenz.pl
#-------------------------------------------------------------------------------------


open CODE2,"intenz.txt"; #Importation des donnees du premier fichier parse
open (FICHIER, ">publiInsertion.txt") || die ("Vous ne pouvez pas créer le fichier \"publiInsertion.txt\"");


while(<CODE2>)
{
    chomp;
    @tmp=split(/\t/,$_);#Tableau qui contient les differents champs de la ligne
   
    @synonym=();
	@comment=();
	$title='';
	$authors='';
	$volume=0;
	$first_page=0;
	$last_page=0;
	$pubmed='';
	$medline=0;
	
	$t=; #compteur des titres
	$p=0; #compteur des numeros pubmed

    #Pour chaque champs, on va recuperer la balise et son contenu
    foreach $valeur(@tmp){
			
			
            @res2 = split(/</,$valeur);
            @rescontenu=split(/>/,$res2[1]);
            $contenu=$rescontenu[1]; #Contenu de la balise
            $balise=$rescontenu[0]; #nom de la balise
            
            #On stocke les differents champs dans les variables
            if($balise=~/ec/){
                $EC=$contenu;    
            }elsif($balise=~/accepted_name/){
                $accepted_name=$contenu;
            }elsif($balise=~/systematic_name/){
                $systemactic=$contenu;
            }elsif($balise=~/synonym/){
				push(@synonym,$contenu);
            }elsif($balise=~/comment/){
                push(@comment,$contenu);
            }elsif($balise=~/title/){
                $title=$title.'<'.$contenu; #On fait une concatenation de lensemble des titres, separes par >
                $t++;
            }elsif($balise=~/authors/){
                $authors=$authors.'<'.$contenu;
            }elsif($balise=~/year/){
                 $year=$year.'<'.$contenu;
            }elsif($balise=~/volume/){
                 $volume=$volume.'<'.$contenu;
            }elsif($balise=~/first_page/){
                 $first_page=$first_page.'<'.$contenu;
            }elsif($balise=~/last_page/){
                $last_page=$last_page.'<'.$contenu;
            }elsif($balise=~/pubmed/){
                $pubmed=$pubmed.'<'.$contenu;
                $p++;
            }elsif($balise=~/medline/){
                $medline=$medline.'<'.$contenu;
            }elsif($balise=~/history/){
                $history=$contenu;
            }
          
            
    }
	
  
    
    #Parcours des tableaux et ecriture dans le fichier de sortie
	print FICHIER "UPDATE Enzyme SET accepted_name='".$accepted_name."',history='".$history."' WHERE Enzyme.num_EC='".$EC."'\n";
	
    foreach $val(@synonym){
        print FICHIER "INSERT INTO Names(num_EC,synonym_name) VALUES ('".$EC."','".$val."')"."\n";  
    }

     foreach $val(@comment){
        print FICHIER "INSERT INTO Comments(num_EC,comment) VALUES ('".$EC."','".$val."')"."\n";
	}
	 
	 @titre = split(/</,$title);
	 @auteur = split(/</,$authors);
	 @an=split(/</,$year);
	 @vol=split(/</,$volume);
	 @first=split(/</,$first_page);
	 @last=split(/</,$last_page);
	 @pub=split(/</,$pubmed);
	 @med=split(/</,$medine);
	
	 
	 $i=0;
	 foreach $val (@titre){
		 
		 #Si pas de trucs presents, on met la valeur NULL car ce sont des int et pas des chaines de caracteres
		 if ($pub[$i] eq ''){
			 $pub[$i]=0;
		 }
		
		 print FICHIER "INSERT INTO Publication(num_EC,titre,auteurs,first_page,last_page,volume,pubmed,year) VALUES ('".$EC."','".$val."','".$auteur[$i]."','".$first[$i]."','".$last[$i]."','".$vol[$i]."','".$pub[$i]."','".$an[$i]."')"."\n";  
		 $i=$i +1;
	 }
   
   #probleme insertion medline =>je sais pas ce que cest en plus =>est ce necessaire ? car nest pas present partout en plus
}
close CODE2;


  	


