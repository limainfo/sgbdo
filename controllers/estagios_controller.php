<?php
class EstagiosController extends AppController {

	var $name = 'Estagios';
	var $helpers = array('Html', 'Form');

	function index() {
		$sql = "select concat( Posto.sigla_posto,' ', Militar.nm_completo) as nome  FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
		INNER JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) where Posto.antiguidade>118 and Posto.antiguidade<123 order by Posto.antiguidade asc";

		$chefes = $this->Estagio->query($sql);



		$cont = 0;
			
		foreach ($chefes as $chf){
			$chefe[$cont] = iconv('UTF-8','UTF-8',$chf[0]['nome']);
			//array($chefe,$chf['nome']);
			$cont++;

		}

		$this->set(compact('chefe'));
	}


}
?>