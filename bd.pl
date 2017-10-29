#!/usr/bin/perl -w

#------------------------------------------------------
#author : Mathilde Bertrand
#But : Creation des tables SQL et insertion des données
#------------------------------------------------------

use DBI;
#use uft8;
use DBD::mysql;
use vars qw/ $VERSION /;
$VERSION='1.0';

#Parametres de connections a la bd-----------------------------------------

my $bd ='ProjetWeb2017';
my $serveur='localhost';
my $identifiant='root';
#my $password = 'Zneio9W:=K12';
my $password = 'beike_mysql';
my $port='';

#Connection a la bd-----------------------------------------
	
print "Connexion à la base de données $bd\n";
my $dbh= DBI->connect( "DBI:mysql:database=$bd;host=$serveur;port=$port",
	$identifiant, $password, {
	RaiseError=>1,
}
) or die "Connection impossible a la base de données $bd !\n $! \n $@\n$DBI::errstr";

#Creation des tables-----------------------------------------

print "Creation de la table Enzyme";
my $sql_create_table_enzyme= <<"SQL";
CREATE TABLE Enzyme (
	num_EC VARCHAR(20) NOT NULL,
	reaction VARCHAR(50) NOT NULL,
	comments TEXT NOT NULL,
	cofactor VARCHAR(20) NOT NULL,
	PRIMARY KEY (num_EC)
)
SQL
#$dbh->do('DROP TABLE IF EXISTS Enzyme;') or die "Impossible de supprimer la table Enzyme\n\n";
$dbh->do($sql_create_table_enzyme) or die "Impossible de créer la table Enzyme";

print "Creation de la table Disease";
my $sql_create_table_disease= <<"SQL";
CREATE TABLE Disease (
	disease_name VARCHAR(20) NOT NULL,
	PRIMARY KEY (disease_name)
)
SQL
#$dbh->do('DROP TABLE IF EXISTS Disease;') or die "Impossible de supprimer la table Disease\n\n";
$dbh->do($sql_create_table_disease) or die "Impossible de créer la table Disease";

print "Creation de la table Publication";
my $sql_create_table_publication= <<"SQL";
CREATE TABLE Publication (
	titre VARCHAR(100) NOT NULL,
	auteurs VARCHAR(100) NOT NULL,
	first_page INT NOT NULL,
	last_page INT NOT NULL,
	volume INT NOT NULL,
	pubmed INT NOT NULL,
	
	PRIMARY KEY (titre,auteurs)
)
SQL
#$dbh->do('DROP TABLE IF EXISTS Publication;') or die "Impossible de supprimer la table Publication\n\n";
$dbh->do($sql_create_table_publication) or die "Impossible de créer la table Publication";


print "Creation de la table Names";
my $sql_create_table_names= <<"SQL";
CREATE TABLE Names (
	accepted_name VARCHAR(50) NOT NULL,
	synonym_name VARCHAR(50) NOT NULL,
	o_name VARCHAR(50) NOT NULL,
	PRIMARY KEY (accepted_name)
)
SQL
#$dbh->do('DROP TABLE IF EXISTS Names;') or die "Impossible de supprimer la table Names\n\n";
$dbh->do($sql_create_table_names) or die "Impossible de créer la table Names";


print "Creation de la table ProteinFamilie";
my $sql_create_table_protein= <<"SQL";
CREATE TABLE ProteinFamilie (
	SP VARCHAR(10) NOT NULL,
	PROSITE VARCHAR(10) NOT NULL,
	PRIMARY KEY (SP)
)
SQL
#$dbh->do('DROP TABLE IF EXISTS ProteinFamilie;') or die "Impossible de supprimer la table ProteinFamilie\n\n";
$dbh->do($sql_create_table_protein) or die "Impossible de créer la table ProteinFamilie";

print "Creation de la table impliqueDisease";
my $sql_create_table_implique_disease= <<"SQL";

CREATE TABLE ImpliqueDisease (
	disease_name VARCHAR(20) NOT NULL,
	num_EC VARCHAR(20) NOT NULL,
	
	PRIMARY KEY (disease_name,num_EC),
	FOREIGN KEY (disease_name) REFERENCES Disease(disease_name),
	FOREIGN KEY (num_EC) REFERENCES Enzyme(num_EC)
)
SQL
#$dbh->do('DROP TABLE IF EXISTS ImpliqueDisease;') or die "Impossible de supprimer la table ImpliqueDisease\n\n";
$dbh->do($sql_create_table_implique_disease) or die "Impossible de créer la table ImpliqueDisease";



print "Creation de la table ecrire";
my $sql_create_table_ecrire= <<"SQL";

CREATE TABLE Ecrire (
	num_EC VARCHAR(20) NOT NULL,
	titre VARCHAR(100) NOT NULL,
	auteurs VARCHAR(100) NOT NULL,
	PRIMARY KEY (titre,auteurs,num_EC),
	FOREIGN KEY (titre, auteurs) REFERENCES Publication(titre, auteurs),
	FOREIGN KEY (num_EC) REFERENCES Enzyme(num_EC)
)
SQL
#$dbh->do('DROP TABLE IF EXISTS Ecrire;') or die "Impossible de supprimer la table Ecrire\n\n";
$dbh->do($sql_create_table_ecrire) or die "Impossible de créer la table Ecrire";

print "Creation de la table Appartient";
my $sql_create_table_appartient= <<"SQL";

CREATE TABLE Appartient (
	num_EC VARCHAR(20) NOT NULL,
	SP VARCHAR(10) NOT NULL,
	PRIMARY KEY (num_EC,SP),
	FOREIGN KEY (num_EC) REFERENCES Enzyme(num_EC),
	FOREIGN KEY (SP) REFERENCES Enzyme(ProteinFamilie)
)
SQL
#$dbh->do('DROP TABLE IF EXISTS Appartient;') or die "Impossible de supprimer la table Appartient\n\n";
$dbh->do($sql_create_table_appartient) or die "Impossible de créer la table Appartient";

print "Creation de la table PossedeNom";
my $sql_create_table_PossedeNom= <<"SQL";

CREATE TABLE PossedeNom (
	num_EC VARCHAR(20) NOT NULL,
	accepted_name VARCHAR(50) NOT NULL,
	PRIMARY KEY (num_EC,accepted_name),
	FOREIGN KEY (num_EC) REFERENCES Enzyme(num_EC),
	FOREIGN KEY (accepted_name) REFERENCES Enzyme(Names)
)
SQL
#$dbh->do('DROP TABLE IF EXISTS PossedeNom;') or die "Impossible de supprimer la table PossedeNom\n\n";
$dbh->do($sql_create_table_PossedeNom) or die "Impossible de créer la table PossedeNom";

#Lecture des fichiers et insertions des données-----------------------------------------
