<?php
@mysql_connect("localhost","root",""); // Connexió al  servidorde BD Mysql
@mysql_select_db("minerals"); // Connexció a la BD que volem emprar
$llista = array();
if($_REQUEST["op"]=="llista")
{
	$res = mysql_query("SELECT nom FROM minerals"); // Fem la consulta que ens mostri el nom de tots els minerals
	for($x=0;$x < mysql_num_rows($res); $x++)
	{
		$llista[] = utf8_encode(mysql_result($res,$x,"nom"));
	}
}
else
{
	$mine=$_REQUEST["op"]; // Assignem el nom del mineral que volem coneixer les dades
	$res = mysql_query("SELECT * FROM minerals WHERE nom = '" . $mine ."'"); // Fem la consulta filtrant pel mineral indicat
	$id=utf8_encode(mysql_result($res,0,'Id'));
	$nom=utf8_encode(mysql_result($res,0,'nom'));
	$duresa=utf8_encode(mysql_result($res,0,'duressa'));
	$densitat=utf8_encode(mysql_result($res,0,'densitat'));
	// ....
	$llista = array('id'=> $id, 'nom'=> $nom, 'duresa'=> $duresa, 'densitat'=> $densitat);
}
header('Content-Type: application/json');
echo json_encode($llista); // Converteix un array al format JSON
?>