<?php
require 'Phpml\Math\Distance\Euclidean.php';
require 'Phpml\Math\Distance\Manhattan.php';
require 'Phpml\Math\Distance\Chebyshev.php';
require 'Phpml\Math\Distance\Minkowski.php';
require 'Phpml\Preprocessing\Normalizer.php';
use Phpml\Math\Distance\Euclidean;
use Phpml\Math\Distance\Manhattan;
use Phpml\Math\Distance\Chebyshev;
use Phpml\Math\Distance\Minkowski;
use Phpml\Preprocessing\Normalizer;
?>

<br/>
<form>
<table align="center" border="1">
<tr><th colspan="2"> Calcul de distance entre deux mots</th></tr>
<tr>
<td>Mot 1</td><td><input type="text" name="word1"></td></tr>
<td>Mot 2</td><td><input type="text" name="word2"></td></tr>
<td>Mésure</td><td>
<select name="mesure">
	<option value="Le">Levenshtein</option>
	<option value="Eu">Euclidean</option>
	<option value="Ma">Manhattan</option>
	<option value="Ch">Chebyshev</option>
	<option value="Mi">Minkowski</option>
</select>

</td></tr>
<tr align="center"><td><input type="submit" value="Calculer"></td>
<td><input type="reset" value="Annuler"></td></tr>
</table>
</form>

<?php
if(isset($_GET['word1']) && isset($_GET['word2']) && isset($_GET['mesure'])&&(strlen($_GET['word1'])) && (strlen($_GET['word2']))&& (strlen($_GET['mesure'])))
{

	function VersVecteur($chaine,$taille)
	{
		$vecteur=array();
		for($i=0;$i<strlen($chaine);$i++) array_push($vecteur, ord($chaine[$i]));
		$tailleVect=count($vecteur);	
		if($tailleVect<$taille) for($i=0;$i<$taille-$tailleVect;$i++) array_push($vecteur, 0);
		return $vecteur; 
	}

	function normaliser($vecteur)
	{
		$normalizer = new Normalizer();
		$normalizer->normalizeL1($vecteur);
		return $vecteur;
	}

	$word1 = $_GET['word1'];
	$word2 = $_GET['word2'];

	$taille=max(strlen($word1),strlen($word2));
	$v1=VersVecteur($word1,$taille);
	$v2=VersVecteur($word2,$taille);
	$v1=normaliser($v1);
	$v2=normaliser($v2);

	$mesure = $_GET['mesure'];
	$distance=-1;
 
switch($mesure)
{
	case 'Eu' : {
					$typeMesure="Euclidean";
					$euclidean = new Euclidean();
					$distance=$euclidean->distance($v1, $v2);
					break;
				}
	case 'Ma' : {
					$typeMesure="Manhattan";
					$manhattan = new Manhattan();
					$distance=$manhattan->distance($v1, $v2);
					break;
				}
	case 'Ch' : {
					$typeMesure="Chebyshev";
					$chebyshev = new Chebyshev();
					$distance=$chebyshev->distance($v1, $v2);
					break;
				}
	case 'Mi' : {
					$typeMesure="Minkowski";
					$minkowski = new Minkowski();
					$distance=$minkowski->distance($v1, $v2);
					break;
				}
	case 'Le' : {
					$typeMesure="Levenshtein";
					$distance=levenshtein($word1,$word2)/max(strlen($word1),strlen($word2));
					break;
				}
}

echo "La distance syntaxique via la méthode ".$typeMesure." est : ".$distance;
}
?>





<br/>
<form method="post" action="dist.php" enctype="multipart/form-data">
<table align="center" border="1">
<tr><th colspan="2"> Calcul de distance entre plusieurs mots</th></tr>
<tr>
<td>Fichier 1</td><td><input type="file" name="fichier1"></td></tr>
<td>Fichier 2</td><td><input type="file" name="fichier2"></td></tr>
<td>Mésure</td><td>
<select name="mesure">
	<option value="Le">Levenshtein</option>
	<option value="Eu">Euclidean</option>
	<option value="Ma">Manhattan</option>
	<option value="Ch">Chebyshev</option>
	<option value="Mi">Minkowski</option>
</select>

</td></tr>
<tr align="center"><td><input type="submit" value="Calculer"></td>
<td><input type="reset" value="Annuler"></td></tr>
</table>
</form>