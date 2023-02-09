<?php
class FeriasController extends AppController {

    var $name = 'Ferias';
    var $helpers = array('Html', 'Form', 'Ajax', 'Pdf');

    function add() {
        
        $this->Feria->recursive=2;
        $militars=$this->Feria->Militar->find('list');
        $militars[0]='Selecione';
        $postos=$this->Feria->Militar->Posto->find('list');
        $postos[0]='Selecione';
        //$setors=$this->Aditivo->Setor->find('list');
        $consultaespecialidades = 'select Especialidade.id, concat(Quadro.sigla_quadro," - ", Especialidade.nm_especialidade) Especialidade from especialidades Especialidade inner join quadros Quadro on (Especialidade.quadro_id=Quadro.id)  order by Quadro.sigla_quadro asc, Especialidade.nm_especialidade asc';
        $respecialidades = $this->Feria->query($consultaespecialidades);
        foreach($respecialidades as $respecialidade){
            $especialidades[$respecialidade['Especialidade']['id']] = $respecialidade[0]['Especialidade']; 
        }
        $consultaunidades = 'select Unidade.id, concat(Unidade.sigla_unidade) Unidade from unidades Unidade  order by Unidade.sigla_unidade asc';
        $runidades = $this->Feria->query($consultaunidades);
        foreach($runidades as $runidade){
            $unidades[$runidade['Unidade']['id']] = $runidade[0]['Unidade']; 
        }        
        $sql = "select Unidade.sigla_unidade, Setor.sigla_setor, Setor.id, Unidade.id
        FROM setors as Setor
        inner join unidades Unidade on (Unidade.id=Setor.unidade_id)
        where trim(Setor.sigla_setor) not like 'NA' and trim(Setor.sigla_setor) not like 'R.%' and trim(Setor.sigla_setor) not like '%EST%'
        order by  Unidade.id asc ";
        $setor = $this->Feria->query($sql);
        $conta = 0;

        $siglas_setores[0] = 'Selecione';
        foreach($setor as $conteudo){
            $organizacaos[$conteudo['Unidade']['id']][$conta]=$conteudo['Setor']['id'].'||'.$conteudo['Setor']['sigla_setor'];
            $conta++;
            if(!in_array($conteudo['Setor']['sigla_setor'],$siglas_setores)){
                $siglas_setores[$conteudo['Setor']['sigla_setor']]=$conteudo['Setor']['sigla_setor'];
            }
        }
                
        $this->set(compact('militars','postos','especialidades','unidades','siglas_setores'));
    }

}
?>