<?php 
include($caminhoAditivos);
include('../views/funcoes_henrique.ctp');
echo $this->Html->script('jscalendar/calendar.js');
echo $this->Html->script('jscalendar/lang/calendar-br.js');
echo $this->Html->script('common.js');
echo $this->Html->css('../js/jscalendar/skins/aqua/theme');

echo("<div id='carregando'>".$this->Html->image('spinner.gif')."</div>");

$raiz = $this->webroot;

$variaveis = 'var divisao=new Array();';
$conta = 0;

foreach($organizacaos as $divisao=>$subdivisoes){
        $divisoes[$divisao] = $divisao;
        $conta++;
        $valores='';
        foreach($subdivisoes as $valor){
                $separador = explode('||',$valor);
                $valores .= '<option value="'.$separador[0].'">'.$separador[1].'</option>';
        }
        $variaveis .= ' divisao["'.$divisao.'"]=\''.$valores.'\';'."\r\n";
}


$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[

function select_innerHTML(objetoId,innerHTML){

	objeto = $(objetoId);
    objeto.innerHTML = ""
    var selTemp = document.createElement("micoxselect")
    var opt;
    selTemp.id="micoxselect1"
    document.body.appendChild(selTemp)
    selTemp = document.getElementById("micoxselect1")
    selTemp.style.display="none"
    if(innerHTML.toLowerCase().indexOf("<option")<0){//se não é option eu converto
        innerHTML = "<option>" + innerHTML + "</option>"
    }
    //innerHTML = innerHTML.toLowerCase().replace(/<option/g,"<span").replace(/<\/option/g,"</span")
    innerHTML = innerHTML.replace(/<option/g,"<span").replace(/<\/option/g,"</span")
    selTemp.innerHTML = innerHTML
      
    
    for(var i=0;i<selTemp.childNodes.length;i++){
  var spantemp = selTemp.childNodes[i];
  
        if(spantemp.tagName){     
            opt = document.createElement("OPTION")
    
   if(document.all){ //IE
    objeto.add(opt)
   }else{
    objeto.appendChild(opt)
   }       
    
   //getting attributes
   for(var j=0; j<spantemp.attributes.length ; j++){
    var attrName = spantemp.attributes[j].nodeName;
    var attrVal = spantemp.attributes[j].nodeValue;
    if(attrVal){
     try{
      opt.setAttribute(attrName,attrVal);
      opt.setAttributeNode(spantemp.attributes[j].cloneNode(true));
     }catch(e){}
    }
   }
   //getting styles
   if(spantemp.style){
    for(var y in spantemp.style){
     try{opt.style[y] = spantemp.style[y];}catch(e){}
    }
   }
   //value and text
   opt.value = spantemp.getAttribute("value")
   opt.text = spantemp.innerHTML
   //IE
   opt.selected = spantemp.getAttribute('selected');
   opt.className = spantemp.className;
  } 
 }    
 document.body.removeChild(selTemp)
 selTemp = null
}

function listasetores(CampoSetores,UnidadeID){
	new Ajax.Updater(CampoSetores,'{$this->webroot}setors/externosetores/'+UnidadeID, {asynchronous:false, evalScripts:false, requestHeaders:['X-Update', CampoSetores]})
}	

		
//]]>	
	
	    
		//]]>		
</script>
SCRIPT;
echo $jscript;

echo("<div class='Relatorios index'>");
Menu_Barra('grupo16','relatorio16','CONSULTA PERSONALIZADA PARA EFETIVO/CURSOS/TEMPO DE SVC');
echo $form->create('R16', array('url'=>array('controller'=>'aditivos', 'action'=>'externocsv'), 'type'=>'file', 
	'inputDefaults' => array('label' => false, 'div' => false)));

$campos['Unidade.sigla_unidade']='Unidade';
$campos['Setor.sigla_setor']='Setor';
$campos['Posto.sigla_posto']='Posto';
$campos['Quadro.sigla_quadro']='Quadro';
$campos['Especialidade.nm_especialidade']='Especialidade';
$campos['Militar.nm_completo']='Nome';
$campos['Militar.sexo']='Sexo';
$campos['datediff(now(),Militar.dt_admissao)/365']='Tempo de Serviço';
$campos['Curso.codigo']='Curso';
$campos['Habilitacao.validade_cht_atual']='Data de Validade da CHT';
$campos['Exame.data_validade']='Data de Validade da CCF';

$tipos['Especialidade.nm_especialidade']='literal';
$tipos['Quadro.sigla_quadro']='literal';
$tipos['Posto.sigla_posto']='literal';
$tipos['Militar.nm_completo']='literal';
$tipos['Militar.sexo']='literal';
$tipos['TempoSVC']='numerico';
$tipos['Curso.codigo']='literal';

$literal[0]='E - CONTENHA';
$literal[1] ='E - NÃO CONTENHA';
$literal[2]='E - COMECE COM';
$literal[3]='E - TERMINE COM';
$literal[4]='OU - CONTENHA';
$literal[5] ='OU - NÃO CONTENHA';
$literal[6]='OU - COMECE COM';
$literal[7]='OU - TERMINE COM';

$literais='';
foreach($literal as $dadoliteral){
	$literais .= "<option value=\"{$dadoliteral}\">{$dadoliteral}</option>";
}
$numerico[0]='E - IGUAL A';
$numerico[1] ='E - DIFERENTE DE';
$numerico[2]='E - MAIOR QUE';
$numerico[3]='E - MENOR QUE';
$numerico[4]='OU - IGUAL A';
$numerico[5] ='OU - DIFERENTE DE';
$numerico[6]='OU - MAIOR QUE';
$numerico[7]='OU - MENOR QUE';

$numericos='';
foreach($numerico as $dadonumerico){
	$numericos .= "<option value=\"{$dadonumerico}\">{$dadonumerico}</option>";
}          
echo("<table align='center'><tr><th width='33%'>Campo</th><th width='33%'>Condição</th><th width='33%'>Valor</th></tr>");
for($i=0;$i<10;$i++) {
    echo("<tr><td width='33%'>");
	echo $form->input(null,array('class'=>'', 'type'=>'select', 'options'=>$campos, 'name'=>'data[R16][campo][]', 'label'=>false, 'id'=>'campo'.$i, 'onchange'=>'preencheFiltro('.$i.');' ));
	echo("</td><td width='33%'>");
	echo $form->input(null,array('class'=>'', 'type'=>'select', 'options'=>'', 'name'=>'data[R16][condicao][]', 'label'=>false, 'id'=>'condicao'.$i ));
	echo("</td><td width='33%'>");
	echo $form->input(null,array('class'=>'', 'type'=>'text', 'size'=>'30', 'name'=>'data[R16][valor][]', 'label'=>false, 'id'=>'valor'.$i ));
	echo("</td></tr>");
}
echo("</table>");
//echo("<tr><td colspan=3>");

echo $form->hidden('id',array('name'=>'data[id]', 'value'=>'R16'));
//echo '<center>'.$ajax->submit('Gerar Ajax', array('url'=> array('controller'=>'aditivos', 'action'=>'externocsv'), 'class'=>'botoes')).'</center>';
echo $form->end(array('label'=>'Gerar Relatório','class'=>'botoes'));
//echo '<center>'.$ajax->submit('Gerar Ajax', array('url'=> array('controller'=>'aditivos', 'action'=>'externocsv'), 'class'=>'botoes')).'</center>';
//echo $form->end(array('label'=>'Gerar Relatório','class'=>'botoes'));

//echo("</td></tr>");
echo("</table></div></div>\n");


Menu_Barra('grupo15','relatorio15','MEMBROS DO CONSELHO TÉCNICO/OPERACIONAL');
echo $form->create('R15', array('url'=>array('controller'=>'aditivos','action'=>'externocsv'),  'type'=>'file'));
echo $form->input('organizacao',array('class'=>'formulario','options'=>$unidades, 'label'=>'Organização', 'multiple'=>'multiple', 'size'=>'5'));
echo $form->input('cargo_conselho',array('class'=>'formulario','options'=>$cargosconselhos,  'label'=>'Cargo no Conselho', 'multiple'=>'multiple', 'size'=>'5'));
//echo $form->input('tipo_licenca',array('class'=>'formulario','options'=>$tipos_licencas,  'label'=>'Tipo de Licença', 'multiple'=>'multiple', 'size'=>'5'));
echo $form->hidden('id',array('name'=>'data[id]', 'value'=>'R15'));
//echo '<center>'.$ajax->submit('Gerar Ajax', array('url'=> array('controller'=>'aditivos', 'action'=>'externocsv'), 'class'=>'botoes','onmouseover'=>'$("R1Id").value="R15";')).'</center>';
echo $form->end(array('label'=>'Gerar Relatório','class'=>'botoes'));
echo("</td></tr></table></div>\n");

Menu_Barra('grupo14','relatorio14','NÍVEL DE INGLÊS');
echo $form->create('R14', array('url'=>array('controller'=>'aditivos','action'=>'externocsv'),  'type'=>'file'));
echo $form->input('fase',array('class'=>'formulario','options'=>array('fase01'=>'Fase 1','fase02'=>'Fase 2'), 'default'=>0,  'label'=>'Fase'));
echo $form->input('organizacao_tecnico',array('class'=>'formulario','options'=>$unidades, 'default'=>0,'onChange'=>'javascript:listasetores(\'R14Setor\',$(\'R14OrganizacaoTecnico\').value);', 'label'=>'Organização do Técnico/ATCO'));
echo $form->input('setor',array('class'=>'formulario',  'label'=>'Setor', 'default'=>0,'options'=>array('Selecione a Divisão'=>'Selecione a Unidade do ATCO/Técnico'), 'multiple'=>'multiple', 'size'=>'5'));
echo $form->input('anos',array('class'=>'formulario','options'=>array('2011'=>'2011','2010'=>'2010','2009'=>'2009'), 'default'=>0, 'label'=>'Ano', 'multiple'=>'multiple', 'size'=>'5'));
echo $form->hidden('id',array('name'=>'data[id]', 'value'=>'R14'));
//echo '<center>'.$ajax->submit('Gerar Ajax', array('url'=> array('controller'=>'aditivos', 'action'=>'externocsv'), 'class'=>'botoes','onmouseover'=>'$("R1Id").value="R14";')).'</center>';
echo $form->end(array('label'=>'Gerar Relatório','class'=>'botoes'));
echo("</td></tr></table></div>\n");

Menu_Barra('grupo01','relatorio01','LICENÇAS CONCEDIDAS');
echo $form->create('R1', array('url'=>array('controller'=>'aditivos','action'=>'externocsv'),  'type'=>'file'));
echo $form->input('organizacao',array('class'=>'formulario','options'=>$unidades, 'default'=>0,'onChange'=>'javascript:listasetores(\'R1Setor\',$(\'R1Organizacao\').value);', 'label'=>'Organização do Técnico/ATCO'));
echo $form->input('setor',array('class'=>'formulario',  'label'=>'Setor', 'default'=>0,'options'=>array('Selecione a Divisão'=>'Selecione a Unidade do ATCO/Técnico'), 'multiple'=>'multiple', 'size'=>'5'));
echo $form->input('qualificacao',array('class'=>'formulario', 'default'=>0,  'label'=>'Qualificações', 'multiple'=>'multiple', 'size'=>'5'));
echo $form->input('empresa',array('class'=>'formulario', 'default'=>0, 'label'=>'Empresas', 'multiple'=>'multiple', 'size'=>'5'));
echo $form->hidden('id',array('name'=>'data[id]', 'value'=>'R1'));
//echo '<center>'.$ajax->submit('Gerar Ajax', array('url'=> array('controller'=>'aditivos', 'action'=>'externocsv'), 'class'=>'botoes','onmouseover'=>'$("R1Id").value="R1";')).'</center>';
echo $form->end(array('label'=>'Gerar Relatório','class'=>'botoes'));
echo("</td></tr></table></div>\n");

Menu_Barra('grupo02','relatorio02','CHT CONCEDIDAS');
echo $form->create('R2', array('url'=>array('controller'=>'aditivos','action'=>'externocsv'),  'type'=>'file'));
echo $form->input('licenca',array('class'=>'formulario','size'=>'50',  'label'=>'No. da Licença'));
echo $form->input('nome',array('class'=>'formulario','size'=>'50',  'label'=>'Nome'));
echo $datePicker->picker('admissao_inicio',array('readonly'=>'readonly','class'=>'formulario',  'label'=>'Data de Admissão (Início)'));
echo $datePicker->picker('admissao_termino',array('readonly'=>'readonly','class'=>'formulario',  'label'=>'Data de Admissão (Término)'));
echo $form->input('organizacao',array('class'=>'formulario','options'=>$unidades, 'default'=>0, 'onChange'=>'javascript:listasetores(\'R2Setor\',$(\'R2Organizacao\').value);', 'label'=>'Organização do Técnico/ATCO'));
echo $form->input('setor',array('class'=>'formulario',  'label'=>'Setor','options'=>array('Selecione a Divisão'=>'Selecione a Unidade do ATCO/Técnico'), 'multiple'=>'multiple', 'size'=>'5'));
echo $form->input('empresa',array('class'=>'formulario',  'label'=>'Empresas', 'multiple'=>'multiple', 'size'=>'5'));
echo $form->input('qualificacao',array('class'=>'formulario',  'label'=>'Qualificações', 'multiple'=>'multiple', 'size'=>'5'));
echo $form->input('atividade',array('class'=>'formulario',  'label'=>'Atividades', 'multiple'=>'multiple', 'size'=>'5'));
//echo $form->input('area',array('class'=>'formulario', 'type'=>'select','options'=>'',  'label'=>'Area', 'multiple'=>'multiple', 'size'=>'5'));
//echo $form->input('equipamento',array('class'=>'formulario', 'type'=>'select', 'options'=>'',  'label'=>'Equipamento', 'multiple'=>'multiple', 'size'=>'5'));
//echo $form->label('<u>Teste</u><br>');
echo $form->input('valida',array('class'=>'formulario','label'=>'Válida','type'=>'checkbox'));
echo $form->input('vencida',array('class'=>'','label'=>'Vencida','type'=>'checkbox','before'=>'<p>','after'=>'</p>'));
echo $form->input('suspensa',array('class'=>'','label'=>'Suspensa','type'=>'checkbox'));
echo $form->input('perdida',array('class'=>'','label'=>'Perdida','type'=>'checkbox'));
//echo $form->input('status[]',array('class'=>'','label'=>'Incluir Técnicos Afastados','type'=>'checkbox'));
//echo $form->input('status[]',array('class'=>'','label'=>'Somente equipamentos / Sistemas válidos','type'=>'checkbox'));
//echo $form->input('status[]',array('class'=>'','label'=>'PDF / XLS','type'=>'checkbox'));
//echo $form->input('status[]',array('div'=>false,'label'=>'Status da Habilitação','type'=>'checkbox','before' => '','after' => ''));
//echo $form->input('chefe',array('class'=>'formulario','size'=>'50', 'value'=>'CARLOS ANDRÉ BITTENCOURT DA SILVA - TCEL AV.'));
echo $form->hidden('id',array('name'=>'data[id]', 'value'=>'R2'));
//echo '<center>'.$ajax->submit('Gerar Ajax', array('url'=> array('controller'=>'aditivos', 'action'=>'externocsv'), 'class'=>'botoes','onmouseover'=>'$("R2Id").value="R2";')).'</center>';
echo $form->end(array('label'=>'Gerar Relatório','class'=>'botoes'));
echo("</td></tr></table></div>\n");

Menu_Barra('grupo03','relatorio03','CHT VENCIDAS E A VENCER');
echo $form->create('R3', array('url'=>array('controller'=>'aditivos','action'=>'externocsv'),  'type'=>'file'));
echo $form->input('vencimento',array('class'=>'formulario','size'=>'50',  'label'=>'Vencimento (em dias)'));
echo $form->input('organizacao',array('class'=>'formulario','options'=>$unidades, 'default'=>0, 'onChange'=>'javascript:listasetores(\'R3Setor\',$(\'R3Organizacao\').value);', 'label'=>'Organização do Técnico/ATCO'));
echo $form->input('setor',array('class'=>'formulario',  'label'=>'Setor','options'=>array('Selecione a Divisão'=>'Selecione a Unidade do ATCO/Técnico'), 'multiple'=>'multiple', 'size'=>'5'));
echo $form->input('atividade',array('class'=>'formulario', 'default'=>0, 'label'=>'Atividades', 'multiple'=>'multiple', 'size'=>'5'));
echo $form->hidden('id',array('name'=>'data[id]', 'value'=>'R1'));
//echo '<center>'.$ajax->submit('Gerar Ajax', array('url'=> array('controller'=>'aditivos', 'action'=>'externocsv'), 'class'=>'botoes','onmouseover'=>'$("R3Id").value="R3";')).'</center>';
echo $form->end(array('label'=>'Gerar Relatório','class'=>'botoes'));
echo("</td></tr></table></div>\n");

Menu_Barra('grupo04','relatorio04','TÉCNICOS HABILITADOS');
echo $form->create('R4', array('url'=>array('controller'=>'aditivos','action'=>'externocsv'),  'type'=>'file'));
echo $form->input('organizacao_tecnico',array('class'=>'formulario','options'=>$unidades, 'default'=>0, 'onChange'=>'javascript:listasetores(\'R4Setor\',$(\'R4OrganizacaoTecnico\').value);', 'label'=>'Organização do Técnico/ATCO'));
echo $form->input('setor',array('class'=>'formulario',  'label'=>'Setor','options'=>array('Selecione a Divisão'=>'Selecione a Unidade do ATCO/Técnico'), 'multiple'=>'multiple', 'size'=>'5'));
echo $form->input('atividade',array('class'=>'formulario', 'default'=>0,  'label'=>'Atividades', 'multiple'=>'multiple', 'size'=>'5'));
//echo $form->input('qualificacao',array('class'=>'formulario', 'default'=>0,  'label'=>'Qualificações', 'multiple'=>'multiple', 'size'=>'5'));
//echo $form->input('area',array('class'=>'formulario', 'type'=>'select', 'default'=>0,  'label'=>'Area', 'multiple'=>'multiple', 'size'=>'5'));
//echo $form->input('equipamento',array('class'=>'formulario', 'type'=>'select', 'default'=>0,  'label'=>'Equipamento', 'multiple'=>'multiple', 'size'=>'5'));
echo $form->hidden('id',array('name'=>'data[id]', 'value'=>'R4'));
//echo '<center>'.$ajax->submit('Gerar Ajax', array('url'=> array('controller'=>'aditivos', 'action'=>'externocsv'), 'class'=>'botoes','onmouseover'=>'$("R4Id").value="R4";')).'</center>';
echo $form->end(array('label'=>'Gerar Relatório','class'=>'botoes'));
echo("</td></tr></table></div>\n");

Menu_Barra('grupo05','relatorio05','SITUAÇÃO DE TÉCNICOS');
echo $form->create('R5', array('url'=>array('controller'=>'aditivos','action'=>'externocsv'),  'type'=>'file'));
echo $form->input('licenca',array('class'=>'formulario','size'=>'50',  'label'=>'No. da Licença'));
echo $form->input('nome',array('class'=>'formulario','size'=>'50',  'label'=>'Nome'));
echo $form->input('situacao',array('class'=>'formulario','options'=>array('SUSPENSA'=>'SUSPENSA','PERDA'=>'PERDA','CONCEDIDA'=>'CONCEDIDA','0'=>'Selecione'), 'default'=>0, 'label'=>'Situação'));
echo $datePicker->picker('admissao_inicio',array('readonly'=>'readonly','class'=>'formulario',  'label'=>'Data de Admissão (Início)'));
echo $datePicker->picker('admissao_termino',array('readonly'=>'readonly','class'=>'formulario',  'label'=>'Data de Admissão (Término)'));
echo $form->input('organizacao',array('class'=>'formulario','options'=>$unidades, 'default'=>0, 'onChange'=>'javascript:listasetores(\'R5Setor\',$(\'R5Organizacao\').value);', 'label'=>'Organização do Técnico/ATCO'));
echo $form->input('setor',array('class'=>'formulario',  'label'=>'Setor','options'=>array('Selecione a Divisão'=>'Selecione a Unidade do ATCO/Técnico'), 'multiple'=>'multiple', 'size'=>'5'));
echo $form->input('qualificacao',array('class'=>'formulario',  'label'=>'Qualificações', 'multiple'=>'multiple', 'size'=>'5'));
echo $form->input('atividade',array('class'=>'formulario',  'label'=>'Atividades', 'multiple'=>'multiple', 'size'=>'5'));
//echo $form->input('area',array('class'=>'formulario', 'type'=>'select',  'label'=>'Area', 'multiple'=>'multiple', 'size'=>'5'));
//echo $form->input('equipamento',array('class'=>'formulario', 'type'=>'select',  'label'=>'Equipamento', 'multiple'=>'multiple', 'size'=>'5'));
//echo $form->input('empresa',array('class'=>'formulario', 'label'=>'Empresas', 'multiple'=>'multiple', 'size'=>'5'));
echo $form->hidden('id',array('name'=>'data[id]', 'value'=>'R5'));
//echo '<center>'.$ajax->submit('Gerar Ajax', array('url'=> array('controller'=>'aditivos', 'action'=>'externocsv'), 'class'=>'botoes','onmouseover'=>'$("R5Id").value="R5";')).'</center>';
echo $form->end(array('label'=>'Gerar Relatório','class'=>'botoes'));
echo("</td></tr></table></div>\n");

Menu_Barra('grupo06','relatorio06','CONSULTA EFETIVO DO SISCEAB');
echo $form->create('R6', array('url'=>array('controller'=>'aditivos','action'=>'externocsv'),  'type'=>'file'));
echo $form->input('organizacao',array('class'=>'formulario','options'=>$unidades, 'label'=>'Organização', 'multiple'=>'multiple', 'size'=>'5'));
echo $form->input('setor',array('class'=>'formulario','options'=>$siglas_setores,  'label'=>'Setor', 'multiple'=>'multiple', 'size'=>'5'));
//echo $form->input('situacao',array('class'=>'formulario','options'=>$situacaoMilitar,  'label'=>'Situação', 'multiple'=>'multiple', 'size'=>'5'));
echo $form->hidden('id',array('name'=>'data[id]', 'value'=>'R6'));
//echo '<center>'.$ajax->submit('Gerar Ajax', array('url'=> array('controller'=>'aditivos', 'action'=>'externocsv'), 'class'=>'botoes','onmouseover'=>'$("R6Id").value="R6";')).'</center>';
echo $form->end(array('label'=>'Gerar Relatório','class'=>'botoes'));
echo("</td></tr></table></div>\n");

Menu_Barra('grupo07','relatorio07','IMPRESSÃO DE LICENÇAS');
echo $form->create('R7', array('url'=>array('controller'=>'aditivos','action'=>'externopdf'),  'type'=>'file'));
echo $form->input('licenca_inicial',array('class'=>'formulario','size'=>'50'));
echo $form->input('licenca_final',array('class'=>'formulario','size'=>'50'));
echo $form->input('tipo_licenca',array('class'=>'formulario','options'=>$tipos_licencas, 'multiple'=>'multiple', 'size'=>'5'));
//echo $form->input('licenca',array('class'=>'formulario',  'label'=>'Licenca','options'=>array('4000'=>'4000','4001'=>'4001','4002'=>'4002','4003'=>'4003'), 'multiple'=>'multiple', 'size'=>'5'));
echo $datePicker->picker('expedicao_inicio',array('readonly'=>'readonly','class'=>'formulario',  'label'=>'Data de Expedição (Início)'));
echo $datePicker->picker('expedicao_termino',array('readonly'=>'readonly','class'=>'formulario',  'label'=>'Data de Expedição (Término)'));
echo $datePicker->picker('validade_inicio',array('readonly'=>'readonly','class'=>'formulario',  'label'=>'Data de Validade (Início)'));
echo $datePicker->picker('validade_termino',array('readonly'=>'readonly','class'=>'formulario',  'label'=>'Data de Validade (Término)'));
echo $form->input('organizacao_tecnico',array('class'=>'formulario','options'=>$unidades, 'default'=>'0', 'onChange'=>'javascript:listasetores(\'R7Setor\',$(\'R7OrganizacaoTecnico\').value);', 'label'=>'Organização do <br>Técnico/ATCO'));
echo $form->input('setor',array('class'=>'formulario',  'label'=>'Setor','options'=>array('Selecione a Divisão'=>'Selecione a Unidade do ATCO/Técnico'), 'multiple'=>'multiple', 'size'=>'5'));
echo $form->hidden('id',array('name'=>'data[id]', 'value'=>'R7'));
//echo '<center>'.$ajax->submit('Gerar Ajax', array('url'=> array('controller'=>'aditivos', 'action'=>'externopdf'), 'class'=>'botoes','onmouseover'=>'$("R7Id").value="R7";')).'</center>';
echo $form->end(array('label'=>'Gerar Relatório','class'=>'botoes'));
echo("</td></tr></table></div>\n");

Menu_Barra('grupo08','relatorio08','IMPRESSÃO DE CHT');
echo $form->create('R8', array('url'=>array('controller'=>'aditivos','action'=>'externopdf'),  'type'=>'file'));
echo $form->input('licenca_inicial',array('class'=>'formulario','size'=>'50'));
echo $form->input('licenca_final',array('class'=>'formulario','size'=>'50'));
echo $datePicker->picker('admissao_inicio',array('readonly'=>'readonly','class'=>'formulario',  'label'=>'Data de Expedição (Início)'));
echo $datePicker->picker('admissao_termino',array('readonly'=>'readonly','class'=>'formulario',  'label'=>'Data de Expedição (Término)'));
echo $form->input('organizacao_tecnico',array('class'=>'formulario','options'=>$unidades, 'default'=>0, 'onChange'=>'javascript:listasetores(\'R8Setor\',$(\'R8OrganizacaoTecnico\').value);', 'label'=>'Organização do Técnico/ATCO'));
echo $form->input('tipo_licenca',array('class'=>'formulario','options'=>$tipos_licencas,'default'=>0, 'label'=>'Tipo de Licença'));
echo $form->input('setor',array('class'=>'formulario',  'label'=>'Setor','options'=>array('Selecione a Divisão'=>'Selecione a Unidade do ATCO/Técnico'), 'multiple'=>'multiple', 'size'=>'5'));
echo $form->hidden('id',array('name'=>'data[id]', 'value'=>'R8'));

//echo '<center>'.$ajax->submit('Gerar Ajax', array('url'=> array('controller'=>'aditivos', 'action'=>'externopdf'), 'class'=>'botoes','onmouseover'=>'$("R8Id").value="R8";')).'</center>';
echo $form->end(array('label'=>'Gerar Relatório','class'=>'botoes'));
echo("</td></tr></table></div>\n");


echo("</td></tr></table></div></div><ul>");

$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
function preencheSelect(nomeSelect) {
    var conteudo = '<option selected="selected" value=""></option>'
    var filtro = nomeSelect;
    select_innerHTML(filtro,conteudo);
}
function preencheFiltro(ordem) {
    var numero = '$numericos';
    var literal = '$literais';
    var data = '$data';
    var filtro = 'condicao'+ordem;
    var obcampo = 'campo'+ordem;
    var valor = $(obcampo).value;
    var tipo = literal;    
    select_innerHTML(filtro,'');
    valor.scan(/365/, function(match){ tipo=numero;});
    valor.scan(/validade/, function(match){ tipo=numero;});
    select_innerHTML(filtro,tipo);
}
</script>
SCRIPT;
echo $jscript;

?>
<script>

HideContent('carregando');
HideContent('relatorio01');
HideContent('relatorio02');
HideContent('relatorio03');
HideContent('relatorio04');
HideContent('relatorio05');
HideContent('relatorio06');
HideContent('relatorio07');
HideContent('relatorio08');
HideContent('relatorio09');
HideContent('relatorio10');
HideContent('relatorio11');
HideContent('relatorio12');
HideContent('relatorio13');
HideContent('relatorio14');
HideContent('relatorio15');
HideContent('relatorio16');

</script>	
