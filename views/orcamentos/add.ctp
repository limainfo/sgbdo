<div class="militars form" id="formularios"></div>

<div class="militars form" id="edicao"></div>

<div class="actions">
	<ul>
	</ul>
</div>
<div id="carregando">
    <?php 
    
    //echo $this->Html->image('spinner.gif');

    $definicao['campo']['nome']= 'inicio';
    $definicao['campo']['caption']= 'Início';
    $definicao['campo']['name']= 'data[]';
    
    ?>
</div>
<form accept-charset="utf-8" action="/sgbdo/orcamentos/edit" method="post" enctype="multipart/form-data" id="facilidade" onsubmit="return false;">
<table>
<tr>
<td><b>ANO</b><input type="text" id="ChamadaNomeChamada" maxlength="150" readonly="readonly"
			value="EXPEDIENTE" class="formulario"
			name="nome_chamada"></td>
<td><b>INÍCIO</b><input type="text" id="ChamadaNomeChamada" maxlength="150" readonly="readonly"
			value="EXPEDIENTE" class="formulario"
			name="nome_chamada"></td>
<td><b>TÉRMINO</b><input type="text" id="ChamadaDia"
			class="formulario" readonly="readonly" name="dia"  value="<?php echo $dia; ?>"></td>			
<td><input type="submit" value="Incluir" url=""></td>
</tr>
</table>
		Chamada
		&nbsp;&nbsp;&nbsp;Dia
</form>
<?php 	
	$compara = $u[0]['Usuario']['privilegio_id'];
	if(($compara==1)||($compara==17)){
?>
<?php 

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
    



		HideContent('carregando');
		
//]]>	
	
	    
		//]]>		
</script>
SCRIPT;
echo $jscript;


?>

<?php
	echo $ajax->div('listagem');
?>
<form accept-charset="utf-8" action="/sgbdo/chamadas/edit" method="post" enctype="multipart/form-data" id="facilidade" onsubmit="return false;">

<table cellpadding="0" cellspacing="0">
	<tr style="vertical-align: middle;">
		<th colspan="20"
			style="vertical-align: middle; border: 1px solid #000; background-color: #000060; color: #fff;"><center>TAREFAS PLANEJADAS&nbsp;&nbsp;&nbsp;&nbsp;
<?php 
	echo $ajax->link($this->Html->image('novo.gif', array('alt'=> __('Exibir', true), 'border'=> '0','float'=> 'right', 'title'=>'Visualizar')), array('action'=>'externoadd', null),array('escape'=>false, 'update'=>'formularios'), null,false);
	?>
</center></th>
	</tr>
	<tr>
		<th>Data</th>
		<th>Chamada</th>
		<th>Divisão</th>
		<th>Setor</th>
		<th>Nome</th>
		<th>Início</th>
		<th>Justificativa</th>
		<th>Término</th>
		<th>Justificativa</th>
		<th>Ações</th>
	</tr>
	<?php 
$i=0;
		$dados = $this->requestAction('chamadas/externolista/'.$nome_chamada.'/'.$dia);
		$presencas = array(''=>'','P'=>'P','F'=>'F');
		
		foreach($dados as $dado){
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
				echo "<tr {$class}><td>{$dado['Chamada']['dia']}</td>";
				echo "<td>{$dado['Chamada']['nome_chamada']}</td>";
				echo "<td>{$dado['Chamada']['divisao']}</td>";
				echo "<td><b>{$dado['Chamada']['setor']}</b></td>";
				$tmp = str_replace($dado['Chamada']['nome_guerra'],'<b>'.$dado['Chamada']['nome_guerra'].'</b>',$dado['Chamada']['nome_completo']);
				echo "<td>{$tmp}</td>";
				echo '<td>'.$form->input('presenca_inicio',array('class'=>'formulario','type' => 'select', 'options' => $presencas, 'default'=>$dado['Chamada']['presenca_inicio'], 'label'=>false, 'onChange'=>'marcapresenca("'.$dado['Chamada']['id'].'","I");', 'id'=>'I'.$dado['Chamada']['id'])).'</td>';
				echo "<td>{$form->input('justificativa_inicio',array('class'=>'formulario','type' => 'textarea', 'rows' => '3', 'value'=>$dado['Chamada']['justificativa_inicio'], 'label'=>false, 'onChange'=>'alterajustificativa("'.$dado['Chamada']['id'].'","JI");', 'id'=>'JI'.$dado['Chamada']['id']))}</td>";

				echo '<td>'.$form->input('presenca_termino',array('class'=>'formulario','type' => 'select', 'options' => $presencas, 'default'=>$dado['Chamada']['presenca_termino'], 'label'=>false, 'onChange'=>'marcapresenca("'.$dado['Chamada']['id'].'","T");', 'id'=>'T'.$dado['Chamada']['id'])).'</td>';
				echo "<td>{$form->input('justificativa_termino',array('class'=>'formulario','type' => 'textarea', 'rows' => '3', 'value'=>$dado['Chamada']['justificativa_termino'], 'label'=>false, 'onChange'=>'alterajustificativa("'.$dado['Chamada']['id'].'","JT");', 'id'=>'JT'.$dado['Chamada']['id']))}</td>";
				echo "<td>";
				//echo $ajax->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'index', $testeopprova['Testeopprova']['id']),array('escape'=>false, 'update'=>'View'), null,false);
				echo $ajax->link($this->Html->image('lapis.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'externoedit', $dado['Chamada']['id']),array('escape'=>false, 'update'=>'edicao','method'=>'post', 'with'=>'\'data[id]='.$dado['Chamada']['id'].'&value=help\'' ), null,false);
				echo '&nbsp;&nbsp;&nbsp;';
				echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$dado['Chamada']['nome_completo']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$dado['Chamada']['id'].'/'.$nome_chamada.'/'.$dia."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false); 
				echo "<td></td></tr>";
			
		}
				
?>
</table>

</form> 
<?php  
	echo $ajax->divEnd('listagem');
	


?>

<?php 
	}else{
		
		echo '<center><h1><a href="../usuarios/logout">ACESSO NÃO AUTORIZADO!</a></h1></center>';
	}
?>
<script type="text/javascript">
HideContent('carregando');
HideContent('detalhes');
HideContent('formularios');
HideContent('edicao');
	
function consultanome() {
	var dados = Form.serialize($('ChamadaAddForm'));
	new Ajax.Request('<?php echo $this->webroot; ?>afastamentos/externoconsultanomes/1', {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {
			var resultado = transport.responseText;
		    	$('ChamadaMilitarId').innerHTML = unescape(resultado);
						}
				})
        
    
    return false;
}

function atribui(){
	$('ChamadaNomeMilitar').value = $('ChamadaMilitarId').options[$('ChamadaMilitarId').options.selectedIndex].text; 
}

function registra() {
	$('ChamadaAddForm').submit();
}

function marcapresenca(chamada_id, inicio_ou_termino) {
	var nome = inicio_ou_termino + chamada_id;
	var selecionado = $(nome).options[$(nome).options.selectedIndex].value;
    $(nome).setStyle({backgroundColor: 'black',fontSize: '12px', color:'white'});
	
	new Ajax.Request('<?php echo $this->webroot; ?>chamadas/externogravapresenca', {
			method: 'post',
			parameters: {valor: selecionado, tipo: inicio_ou_termino, id: chamada_id },
			onSuccess: function(transport) {
			var resultado = transport.responseText;
			if(resultado=='1'){
                //$(nome).style.backgroundColor = '#008000';
                $(nome).setStyle({backgroundColor: '#008000',fontSize: '12px', color:'#ffffff'});
   			}else{
                $(nome).setStyle({backgroundColor: '#800000',fontSize: '12px', color:'#ffffff'});
   				//$(nome).style.backgroundColor = '#800000';
			}
			//var resultado = transport.responseText.evalJSON(true);
			
		    
			}
	});
        
    
    return false;
}

function alterajustificativa(chamada_id, inicio_ou_termino) {
	var nome = inicio_ou_termino + chamada_id;
	var selecionado = $(nome).value;
    $(nome).setStyle({backgroundColor: 'black',fontSize: '10px', color:'white'});
	
	new Ajax.Request('<?php echo $this->webroot; ?>chamadas/externogravajustificativa', {
			method: 'post',
			parameters: {valor: selecionado, tipo: inicio_ou_termino, id: chamada_id },
			onSuccess: function(transport) {
			var resultado = transport.responseText;
			if(resultado=='1'){
                //$(nome).style.backgroundColor = '#008000';
                $(nome).setStyle({backgroundColor: '#008000',fontSize: '10px', color:'#ffffff'});
                
                if(inicio_ou_termino == 'JI'){
                	nome = 'I' + chamada_id;
                	$(nome).value='F';
                	marcapresenca(chamada_id, 'I');
                 }else{
                 	nome = 'T' + chamada_id;
                	$(nome).value='F';
                 	marcapresenca(chamada_id, 'T');
                 }
                
   			}else{
                $(nome).setStyle({backgroundColor: '#800000',fontSize: '10px', color:'#ffffff'});
   				//$(nome).style.backgroundColor = '#800000';
			}
			//var resultado = transport.responseText.evalJSON(true);
			
		    
			}
	});
        
    
    return false;
}

</script>