<?php 

include 'db/config.sigpes.php';
include 'db/postgresql.php';

$dbdrv=new PostgreDB (DB_DATABASE, DB_SERVER, 5432, DB_USER, DB_PASS, 1);
/* construct connection to database $dbname, with URL: $host, username is $user, password is $pass. If $persistent!=0 then function pg_pconnect is used otherwise pg_connect. */

$dbdrv->Begin();// Begin transaction block

$sql="select * from sigpes_interface.public.militares inner join sigpes_interface.public.organizacoes on (sigpes_interface.public.organizacoes.cd_org=sigpes_interface.public.militares.cd_org) where nr_ordem='{$_POST['ordem']}' and nr_cpf='{$_POST['cpf']}' LIMIT 10 OFFSET 0";
if (!$dbdrv->ExecQuery($sql)) // Execute query or die if error is occured
	die ($dbdrv->Error());

$result=$dbdrv->FetchResult($row, PGSQL_ASSOC);


//$sql="select * from sigpes_interface.public.militares where nr_ordem='{$_GET['ordem']}' and nr_cpf='{$_GET['cpf']}' LIMIT 10 OFFSET 0";

//print_r($result);

echo json_encode($result);


for ($row=0; $result=$dbdrv->FetchResult($row, PGSQL_BOTH); $row++)
{
	//... do something with result
}
$dbdrv->Commit();// Commit transaction

$dbdrv->DBClose();// Close connection with database


?>