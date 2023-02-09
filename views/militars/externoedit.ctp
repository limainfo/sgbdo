<?php 	
	$compara = $u[0]['Usuario']['privilegio_id'];
	if(($compara==1)||($compara==4)||($compara==12)){
?>

<div class="militars form">
<?php 
echo $form->create('Militar', array('action'=>'externoedit','onsubmit'=>'submitForm(this); return false;','type'=>'file'));
//echo $ajax->form('externoedit','post', array('id'=>'Militars','name'=>'Militars','model'=>'militar','update'=>'militares','url'=>array('controller'=>'militars','action'=>'externoeditgrava')));
?>
	<fieldset>
 		<legend><?php __('Efetivo das Divisões');?><?php 		
	    $link = $this->webroot.'militarscursoscorrigidos/externosugestao/\'';
 		$imagem = $this->Html->image('sugestao.png', array('alt'=> __('PDF', true), 'border'=> '0', 'title'=>'Cadastrar sugestão.', 'id'=>'pdf'));
 		$conteudo.='&nbsp;&nbsp;<a 	onclick="var m=$(\'MilitarscursoscorrigidoMilitarId\').value;var s=$(\'MilitarscursoscorrigidoSetorId\').value;if(m==0||s==0){alert(\'É necessário informar o Setor e Nome do Militar!\');}else{window.open(\''.$link."+m+'/'+s,'','height=300,width=400,toolbar=0,scrollbars=0,directories=0,status=0');}\">".$imagem."</a></label>";
 		//echo $conteudo;
	?>
&nbsp;<?php echo $this->Html->link($this->Html->image('broffice.png', array('alt'=> __('BROffice', true), 'border'=> '0', 'title'=>'Dados em planilha BROffice', 'onmouseover'=>"var consulta=' 1=1 AND (Militar.divisao LIKE \'||'+$('MilitarDivisao').value+'||\') AND (Militar.subdivisao LIKE \'||'+$('MilitarSubdivisao').value+'||\')';$('broffice').href='/operacional/militars/indexExcel/'+encodeURI(consulta);" )), array('action'=>'indexExcel'), array('id'=>'broffice','escape'=>false), null,false); ?>
 		&nbsp;&nbsp;&nbsp;
 		</legend>
 		
 		
<?php
$select1 = '<select id="divisao" name="divisao" class="formulario">';
$select1 = '<select id="divisao" name="divisao" class="formulario" onchange="javascript:$(\'MilitarDivisao\').value = $(\'divisao\').options[$(\'divisao\').options.selectedIndex].value;">';
foreach($divisoes as $dado){
	$select1 .= '<option value="'.$dado['Militar']['divisao'].'">'.$dado['Militar']['divisao'].'</option>';
}
$select1 .= '<option value="" selected="selected"></option></select>';


$select2 = '<select id="subdivisao" name="subdivisao" class="formulario" onchange="javascript:$(\'MilitarSubdivisao\').value = $(\'subdivisao\').options[$(\'subdivisao\').options.selectedIndex].value;">';
foreach($subdivisoes as $dado){
	$select2 .= '<option value="'.$dado['Militar']['subdivisao'].'">'.$dado['Militar']['subdivisao'].'</option>';
}
$select2 .= '<option value="" selected="selected"></option></select>';

$select2 = '<select id="subdivisao" name="subdivisao" class="formulario" onchange="javascript:$(\'MilitarSubdivisao\').value = $(\'subdivisao\').options[$(\'subdivisao\').options.selectedIndex].value;">';
	$select2 .= '<option value="AIS">AIS</option>';
	$select2 .= '<option value="ATM">ATM</option>';
	$select2 .= '<option value="COM">COM</option>';
	$select2 .= '<option value="MET">MET</option>';
	$select2 .= '<option value="OPG">OPG</option>';
	$select2 .= '<option value="OPM">OPM</option>';
	$select2 .= '<option value="SAR">SAR</option>';
$select2 .= '</select>';

		echo $form->input('posto_id',array('class'=>'formulario','onchange'=>'javascript:tratamento(\'MilitarPostoId\',\'MilitarMilitarId\');','options'=>$unidades, 'default'=>0));
		echo $form->input('militar_id',array('class'=>'formulario'));
		echo $form->input('setor_id',array('class'=>'formulario', 'label'=>'Unidade/Setor'));
		//echo '<table  style="border:0px none;"><tr><td  style="border:0px none;background-color:#d8eefd;">'.$form->input('divisao',array('class'=>'formulario','readonly'=>'readonly', 'value'=>'DO')).'</td><td  style="border:0px none;background-color:#d8eefd;">'.$select1.'</td></tr></table>';
		echo '<table  style="border:0px none;"><tr><td  style="border:0px none;background-color:#d8eefd;">'.$form->input('divisao',array('class'=>'formulario','readonly'=>'readonly', 'value'=>'DO')).'</td><td  style="border:0px none;background-color:#d8eefd;"></td></tr></table>';
		echo '<table  style="border:0px none;"><tr><td  style="border:0px none;background-color:#d8eefd;">'.$form->input('subdivisao',array('class'=>'formulario','readonly'=>'readonly')).'</td><td  style="border:0px none;background-color:#d8eefd;">'.$select2.'</td></tr></table>';
		echo '<center>'.$ajax->submit('Listar efetivo com base na informação de DIVISÃO e SUBDIVISÃO', array('url'=> array('controller'=>'militars', 'action'=>'externoeditlista'), 'update' => 'militares', 'class'=>'botoes')).'</center>';
			
?>
	</fieldset>
	
<?php 
echo $ajax->submit('Registrar', array('url'=> array('controller'=>'militars', 'action'=>'externoeditgrava'), 'update' => 'militares', 'class'=>'botoes'));	

echo $form->end();


?>
</div>
<div class="actions">
	<ul>
		</ul>
</div>
<?php
	echo $ajax->div('militares');
	echo $ajax->divEnd('militares');
	$raiz = $this->webroot;

$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[

function select_innerHTML(objetoId,innerHTML){
/******
* select_innerHTML - corrige o bug do InnerHTML em selects no IE
* Veja o problema em: http://support.microsoft.com/default.aspx?scid=kb;en-us;276228
* Versão: 2.1 - 04/09/2007
* Autor: Micox - Náiron José C. Guimarães - micoxjcg@yahoo.com.br
* @objeto(tipo HTMLobject): o select a ser alterado
* @innerHTML(tipo string): o novo valor do innerHTML
*******/
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

function preencheSelect(nomeSelect) {
	var conteudo = '<option selected="selected" value=""></option>'
	var filtro = nomeSelect;
	select_innerHTML(filtro,conteudo);
}
    

function tratamento(campoformulario, campomodificado){
	new Ajax.Updater(campomodificado,'{$raiz}militars/externoposto/', {asynchronous:true, evalScripts:true, parameters:Form.Element.serialize(campoformulario), requestHeaders:['X-Update', campomodificado]})
}


//]]>	
	
	    
		//]]>

</script>
SCRIPT;
echo $jscript;

	


?>

<?php 
	}else{
		
		echo '<center><h1><a href="../usuarios/logout">ACESSO NÃO AUTORIZADO!</a></h1></center>';
	}
?>