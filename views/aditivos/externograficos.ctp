<?php 
include($caminhoAditivos);
include('../views/funcoes_henrique.ctp');
echo $this->Html->script('jscalendar/calendar.js');
echo $this->Html->script('jscalendar/lang/calendar-br.js');
echo $this->Html->script('common.js');
echo $this->Html->css('../js/jscalendar/skins/aqua/theme');

echo("<div id='carregando'>".$this->Html->image('spinner.gif')."</div>");

$raiz = $this->webroot;

$mes = array('1'=>'JAN','2'=>'FEV','3'=>'MAR','4'=>'ABR','5'=>'MAI','6'=>'JUN','7'=>'JUL','8'=>'AGO','9'=>'SET','10'=>'OUT','11'=>'NOV','12'=>'DEZ');

for($i=2007;$i<=2017;$i++){
    $ano[$i]=$i;
}

$set = array('BL0'=>'Belém', 'BL1'=>'Belém - Setor 1', 'BL2'=>'Belém - Setor 2', 'BL3'=>'Belém - Setor 3', 'BL4'=>'Belém - Setor 4', 'BL5'=>'Belém - Setor 5',
    'MU0'=>'Manaus', 'MU1'=>'Manaus - Setor 6', 'MU2'=>'Manaus - Setor 7', 'MU3'=>'Manaus - Setor 8', 'MU4'=>'Manaus - Setor 9', 'MU5'=>'Manaus - Setor 10',
    'PH0'=>'Porto Velho - Setor 11', 'PH2'=>'Porto Velho - Setor 12', 'PH3'=>'Porto Velho - Setor 12', 'PH4'=>'Porto Velho - Setor 12', 'PH5'=>'Porto Velho - Setor 13', 'PH6'=>'Porto Velho - Setor 14');

for($i=0;$i<=23;$i++){
    $hora[$i]=$i;
}

for($i=0;$i<=59;$i++){
    $minuto[$i]=$i;
}

for($i=23;$i<=0;$i++){
    $horafim[$i]=$i;
}

for($i=1;$i<=31;$i++){
    $dia[$i]=$i;
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

	
//]]>	
	
	    
		//]]>		
</script>
SCRIPT;
echo $jscript;
include('FusionCharts.php');

echo $strXML;

echo("<div class='Relatorios index'>");
Menu_Barra('grupo23','relatorio23','GRÁFICO CONTENDO MOVIMENTO DE AEROVIAS');
echo $form->create('R23', array('url'=>array('controller'=>'aditivos', 'action'=>'externograficos'), 'type'=>'file', 'inputDefaults' => array('label' => false, 'div' => false)));
echo $form->input('ano',array('type'=>'select','class'=>'formulario','default'=>$this->data['R23']['ano'],'options'=>$ano, 'label' => 'Ano:', 'div' => false));
echo $form->input('aeroviaentrada01',array('type'=>'select','class'=>'formulario','default'=>$this->data['R23']['aeroviaentrada01'],'options'=>$optionsentrada, 'label' => ' Aerovia Entrada:', 'div' => false));
echo $form->input('aeroviaentrada02',array('type'=>'select','class'=>'formulario','default'=>$this->data['R23']['aeroviaentrada02'],'options'=>$optionssaida, 'label' => ' Aerovia Entrada:', 'div' => false));
echo $form->hidden('id',array('name'=>'data[id]', 'value'=>'R23'));
echo $form->button('Exibir movimento',array('class'=>''));

echo $form->end(); 


	
	   echo renderChart($this->webroot . "js/FCF_MSLine.swf", "", $strXML, "id01", 600, 350);
echo("</td></tr></table></div>\n");


Menu_Barra('grupo17','relatorio17','GRÁFICO CONTENDO QUANTIDADE DE PLANOS DE VÔO');
echo $form->create('R171', array('url'=>array('controller'=>'aditivos', 'action'=>'externograficos'), 'type'=>'file', 'inputDefaults' => array('label' => false, 'div' => false)));
echo("</td></tr>");

echo("<tr><th width='33%' align='right'>");
echo $form->input('dia',array('type'=>'select','class'=>'formulario','options'=>$dia,'default'=>$this->data['R171']['dia'], 'label' => 'Dia:', 'div' => false));
echo $form->input('mes',array('type'=>'select','class'=>'formulario','options'=>$mes,'default'=>$this->data['R171']['mes'], 'label' => 'Mês:', 'div' => false));
echo $form->input('ano',array('type'=>'select','class'=>'formulario','options'=>$ano,'default'=>$this->data['R171']['ano'], 'label' => 'Ano:', 'div' => false));
echo("</th>");
echo("<th width='33%' align='right'>Planos:");
echo $form->input('tipo',array('type'=>'select', 'options'=>array( 2=>'PlanosPorDia', 3=>'PlanosPorHora', 4=>'PlanosPorSetor'),'class'=>'formulario')); 
echo("</th><th width='33%' align='right'>");
echo $form->button('Processar dados para o plano selecionado',array('class'=>''));

//echo("</th></tr></table>");
echo("</th></tr>");
echo $form->end(); 
echo("</th></tr><tr><td colspan='3'>");

if(!isset($grafico))$grafico='';
if(!isset($nomeXML))$nomeXML='';
if(($grafico!='')&&(!empty($this->data['R171']))){
    echo renderChart($grafico, $this->webroot.$nomeXML, '', 'chart1', 800, 500);
}
if((!empty($grafico2))&&(!empty($this->data['R171']))){
	echo renderChart($grafico2, $this->webroot.$nomeXML2, '', 'chart2', 800, 500);
}

echo("</td></tr><tr></table></div><td colspan=3>");
//echo("</td></tr><tr><td colspan=3>");
//echo("</td></tr></table></div>\n");

Menu_Barra('grupo18','relatorio18','QUANTITATIVO MENSAL POR REGIÃO OU SETOR');


echo $form->create('R18', array('url'=>array('controller'=>'aditivos','action'=>'externocsv'),  'type'=>'file'));
echo $form->input('mes',array('type'=>'select','class'=>'formulario','options'=>$mes, 'label' => 'Mês:', 'div' => false));
echo $form->input('ano',array('type'=>'select','class'=>'formulario','options'=>$ano, 'label' => 'Ano:', 'div' => false));
echo $form->input('setor',array('type'=>'select','class'=>'formulario','options'=>$set, 'label' => 'Setor:', 'div' => false));

echo '<br>';

echo $form->input('hora',array('type'=>'select','class'=>'formulario','options'=>$hora, 'label' => 'Intervalo de tempo (horas):', 'div' => false));
echo $form->input('minuto',array('type'=>'select','class'=>'formulario','options'=>$minuto, 'label' => 'Minutos:', 'div' => false));
echo $form->input('inicio',array('type'=>'select','class'=>'formulario','options'=>$hora, 'label' => 'Faixa de visualização (hora início):', 'div' => false));
echo $form->input('fim',array('type'=>'select','class'=>'formulario','options'=>$hora, 'label' => '(hora término):', 'div' => false));

echo $form->hidden('id',array('name'=>'data[id]', 'value'=>'R18'));
//echo '<center>'.$ajax->submit('Gerar Ajax', array('url'=> array('controller'=>'aditivos', 'action'=>'externocsv'), 'class'=>'botoes','onmouseover'=>'$("R1Id").value="R18";')).'</center>';
echo '<br><center>'.$form->end(array('label'=>'Gerar Relatório','class'=>'', 'div'=>false)).'</center>';
echo("</td></tr></table></div>\n");

Menu_Barra('grupo19a','relatorio19a','MOVIMENTO MENSAL POR NÍVEL DE VÔO');
echo $form->create('R19a', array('url'=>array('controller'=>'aditivos','action'=>'externocsv'),  'type'=>'file', 'inputDefaults' => array('label' => false,'div' => false)));
echo $form->input('mes',array('type'=>'select','class'=>'formulario','options'=>$mes, 'label' => 'Mês:', 'div' => false));
echo $form->input('ano',array('type'=>'select','class'=>'formulario','options'=>$ano, 'label' => 'Ano:', 'div' => false));
echo $form->input('nivelinicial',array('type'=>'text','size'=>'3','maxlength'=>'3', 'value'=>'130', 'class'=>'formulario', 'label' => 'Nível de vôo inicial(em flt):', 'div' => false));
echo $form->input('nivelfinal',array('type'=>'text','size'=>'3','maxlength'=>'3', 'value'=>'490','class'=>'formulario', 'label' => 'Nível de vôo final(em flt):', 'div' => false));
echo $form->hidden('id',array('name'=>'data[id]', 'value'=>'R19a'));
//echo '<center>'.$ajax->submit('Gerar Ajax', array('url'=> array('controller'=>'aditivos', 'action'=>'externocsv'), 'class'=>'botoes','onmouseover'=>'$("R1Id").value="R19a";')).'</center>';
echo '<br><center>'.$form->end(array('label'=>'Gerar Relatório','class'=>'', 'div'=>false)).'</center>';
echo("</td></tr></table></div>\n");


Menu_Barra('grupo19b','relatorio19b','MOVIMENTO MENSAL POR NÍVEL DE SOBREVÔO');
echo $form->create('R19b', array('url'=>array('controller'=>'aditivos','action'=>'externocsv'),  'type'=>'file', 'inputDefaults' => array('label' => false,'div' => false)));
echo $form->input('mes',array('type'=>'select','class'=>'formulario','options'=>$mes, 'label' => 'Mês:', 'div' => false));
echo $form->input('ano',array('type'=>'select','class'=>'formulario','options'=>$ano, 'label' => 'Ano:', 'div' => false));
echo $form->hidden('id',array('name'=>'data[id]', 'value'=>'R19b'));
//echo '<center>'.$ajax->submit('Gerar Ajax', array('url'=> array('controller'=>'aditivos', 'action'=>'externocsv'), 'class'=>'botoes','onmouseover'=>'$("R1Id").value="R19b";')).'</center>';
echo '<br><center>'.$form->end(array('label'=>'Gerar Relatório','class'=>'', 'div'=>false)).'</center>';
echo("</td></tr></table></div>\n");

Menu_Barra('grupo20','relatorio20','LOCALIZAR AERONAVE');
echo $form->create('R20', array('url'=>array('controller'=>'aditivos','action'=>'externocsv'),  'type'=>'file'));
echo $form->input('ano',array('type'=>'select','class'=>'formulario','options'=>$ano, 'label' => 'Ano:', 'div' => false));
echo $form->input('adep',array('type'=>'text','size'=>'8','maxlength'=>'8', 'class'=>'formulario', 'label' => 'ADEP: (Ex. SBBR, SBEG, SWKO)', 'div' => false));
echo $form->input('indic',array('type'=>'text','size'=>'10','maxlength'=>'10','class'=>'formulario', 'label' => 'PREFIXO: (Ex. VRG8942, GLO1726, FAB2584):', 'div' => false));
echo $form->hidden('id',array('name'=>'data[id]', 'value'=>'R20'));
//echo '<center>'.$ajax->submit('Gerar Ajax', array('url'=> array('controller'=>'aditivos', 'action'=>'externocsv'), 'class'=>'botoes','onmouseover'=>'$("R1Id").value="R20";')).'</center>';
echo '<br><center>'.$form->end(array('label'=>'Gerar Relatório','class'=>'', 'div'=>false)).'</center>';
echo("</td></tr></table></div>\n");

Menu_Barra('grupo21','relatorio21','LISTA PERSONALIZADA');
echo $form->create('R21', array('url'=>array('controller'=>'aditivos','action'=>'externocsv'),  'type'=>'file'));
echo $form->input('dia',array('type'=>'select','class'=>'formulario','options'=>$dia, 'label' => 'Dia:', 'div' => false));
echo $form->input('mes',array('type'=>'select','class'=>'formulario','options'=>$mes, 'label' => 'Mês:', 'div' => false));
echo $form->input('ano',array('type'=>'select','class'=>'formulario','options'=>$ano, 'label' => 'Ano:', 'div' => false));
echo '<br>';
echo $form->input('horainicio',array('type'=>'select','class'=>'formulario','options'=>$hora, 'label' => 'Horário de Início:', 'div' => false));
echo $form->input('minutoinicio',array('type'=>'select','class'=>'formulario','options'=>$minuto, 'label' => ':', 'div' => false));
echo $form->input('horatermino',array('type'=>'select','class'=>'formulario','options'=>$hora, 'label' => 'Horário de Término:', 'div' => false));
echo $form->input('minutotermino',array('type'=>'select','class'=>'formulario','options'=>$minuto, 'label' => ':', 'div' => false));

echo $form->hidden('id',array('name'=>'data[id]', 'value'=>'R21'));
//echo '<center>'.$ajax->submit('Gerar Ajax', array('url'=> array('controller'=>'aditivos', 'action'=>'externocsv'), 'class'=>'botoes','onmouseover'=>'$("R1Id").value="R21";')).'</center>';
echo '<br><center>'.$form->end(array('label'=>'Gerar Relatório','class'=>'', 'div'=>false)).'</center>';
echo("</td></tr></table></div>\n");

echo("</td></tr></table></div></div><ul>");



?>
<script>
HideContent('carregando');

HideContent('relatorio17');

HideContent('relatorio18');

HideContent('relatorio19a');
HideContent('relatorio19b');

HideContent('relatorio20');

HideContent('relatorio21');

HideContent('relatorio23');


<?php 
if(!empty($strXML)){
    echo 'ShowContent(\'relatorio23\')';
} 
?>


</script>	
