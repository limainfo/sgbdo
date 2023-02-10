<?php 	
	$compara = $u[0]['Usuario']['privilegio_id'];
	if(($compara==1)||($compara==4)){
		
		
?>
	<fieldset>
 		<legend><?php __('Filtrar Dados');?>
&nbsp;&nbsp;&nbsp;&nbsp;
</legend>

<?php
echo $form->create('Testeopcandidato', array('action'=>'externoatribui','onsubmit'=>'submitForm(this); return false;','type'=>'file'));

?>

<table cellspacing="0" cellpadding="0" id="filtro" width="100%">
	<tbody>
		<tr>
			<td valign="center" align="center"><?php 
			$nome = 'Militar.';
			$alfanumerico = '<option value=" AND ('.$nome.'CCC LIKE \\\'||XXX||\\\') ">E - CONTENHA</option>';
			$alfanumerico .= '<option value=" AND ('.$nome.'CCC NOT LIKE \\\'||XXX||\\\') ">E - NÃO CONTENHA</option>';
			$alfanumerico .= '<option value=" AND ('.$nome.'CCC LIKE \\\'XXX||\\\') ">E - COMECE COM</option>';
			$alfanumerico .= '<option value=" AND ('.$nome.'CCC  LIKE \\\'||XXX\\\') ">E - TERMINE COM</option>';
			$alfanumerico .= '<option value=" OR ('.$nome.'CCC LIKE \\\'||XXX||\\\') ">OU - CONTENHA</option>';
			$alfanumerico .= '<option value=" OR ('.$nome.'CCC NOT LIKE \\\'||XXX||\\\') ">OU - NÃO CONTENHA</option>';
			$alfanumerico .= '<option value=" OR ('.$nome.'CCC LIKE \\\'XXX||\\\' ">OU - COMECE COM</option>';
			$alfanumerico .= '<option value=" OR ('.$nome.'CCC LIKE \\\'||XXX\\\' ">OU - TERMINE COM</option>';
			
			$setor = '<option value=" AND (Setor.sigla_setor LIKE \\\'||XXX||\\\') ">E - CONTENHA</option>';
			$setor .= '<option value=" AND (Setor.sigla_setor NOT LIKE \\\'||XXX||\\\') ">E - NÃO CONTENHA</option>';
			$setor .= '<option value=" AND (Setor.sigla_setor LIKE \\\'XXX||\\\') ">E - COMECE COM</option>';
			$setor .= '<option value=" AND (Setor.sigla_setor  LIKE \\\'||XXX\\\') ">E - TERMINE COM</option>';
			$setor .= '<option value=" OR (Setor.sigla_setor LIKE \\\'||XXX||\\\') ">OU - CONTENHA</option>';
			$setor .= '<option value=" OR (Setor.sigla_setor NOT LIKE \\\'||XXX||\\\') ">OU - NÃO CONTENHA</option>';
			$setor .= '<option value=" OR (Setor.sigla_setor LIKE \\\'XXX||\\\' ">OU - COMECE COM</option>';
			$setor .= '<option value=" OR (Setor.sigla_setor LIKE \\\'||XXX\\\' ">OU - TERMINE COM</option>';
			
			$unidade = '<option value=" AND (Unidade.sigla_unidade LIKE \\\'||XXX||\\\') ">E - CONTENHA</option>';
			$unidade .= '<option value=" AND (Unidade.sigla_unidade NOT LIKE \\\'||XXX||\\\') ">E - NÃO CONTENHA</option>';
			$unidade .= '<option value=" AND (Unidade.sigla_unidade LIKE \\\'XXX||\\\') ">E - COMECE COM</option>';
			$unidade .= '<option value=" AND (Unidade.sigla_unidade  LIKE \\\'||XXX\\\') ">E - TERMINE COM</option>';
			$unidade .= '<option value=" OR (Unidade.sigla_unidade LIKE \\\'||XXX||\\\') ">OU - CONTENHA</option>';
			$unidade .= '<option value=" OR (Unidade.sigla_unidade NOT LIKE \\\'||XXX||\\\') ">OU - NÃO CONTENHA</option>';
			$unidade .= '<option value=" OR (Unidade.sigla_unidade LIKE \\\'XXX||\\\' ">OU - COMECE COM</option>';
			$unidade .= '<option value=" OR (Unidade.sigla_unidade LIKE \\\'||XXX\\\' ">OU - TERMINE COM</option>';
			
			$posto = '<option value=" AND (Posto.sigla_posto LIKE \\\'||XXX||\\\') ">E - CONTENHA</option>';
			$posto .= '<option value=" AND (Posto.sigla_posto NOT LIKE \\\'||XXX||\\\') ">E - NÃO CONTENHA</option>';
			$posto .= '<option value=" AND (Posto.sigla_posto LIKE \\\'XXX||\\\') ">E - COMECE COM</option>';
			$posto .= '<option value=" AND (Posto.sigla_posto  LIKE \\\'||XXX\\\') ">E - TERMINE COM</option>';
			$posto .= '<option value=" OR (Posto.sigla_posto LIKE \\\'||XXX||\\\') ">OU - CONTENHA</option>';
			$posto .= '<option value=" OR (Posto.sigla_posto NOT LIKE \\\'||XXX||\\\') ">OU - NÃO CONTENHA</option>';
			$posto .= '<option value=" OR (Posto.sigla_posto LIKE \\\'XXX||\\\' ">OU - COMECE COM</option>';
			$posto .= '<option value=" OR (Posto.sigla_posto LIKE \\\'||XXX\\\' ">OU - TERMINE COM</option>';
			
			$especialidade = '<option value=" AND (Especialidade.nm_especialidade LIKE \\\'||XXX||\\\') ">E - CONTENHA</option>';
			$especialidade .= '<option value=" AND (Especialidade.nm_especialidade NOT LIKE \\\'||XXX||\\\') ">E - NÃO CONTENHA</option>';
			$especialidade .= '<option value=" AND (Especialidade.nm_especialidade LIKE \\\'XXX||\\\') ">E - COMECE COM</option>';
			$especialidade .= '<option value=" AND (Especialidade.nm_especialidade  LIKE \\\'||XXX\\\') ">E - TERMINE COM</option>';
			$especialidade .= '<option value=" OR (Especialidade.nm_especialidade LIKE \\\'||XXX||\\\') ">OU - CONTENHA</option>';
			$especialidade .= '<option value=" OR (Especialidade.nm_especialidade NOT LIKE \\\'||XXX||\\\') ">OU - NÃO CONTENHA</option>';
			$especialidade .= '<option value=" OR (Especialidade.nm_especialidade LIKE \\\'XXX||\\\' ">OU - COMECE COM</option>';
			$especialidade .= '<option value=" OR (Especialidade.nm_especialidade LIKE \\\'||XXX\\\' ">OU - TERMINE COM</option>';
			
			$numerico = '<option value=" AND ('.$nome.'CCC=XXX) ">E - IGUAL A</option>';
			$numerico .= '<option value=" AND ('.$nome.'CCC<>XXX) ">E - DIFERENTE DE</option>';
			$numerico .= '<option value=" AND ('.$nome.'CCC>XXX) ">E - MAIOR QUE</option>';
			$numerico .= '<option value=" AND ('.$nome.'CCC<XXX) ">E - MENOR QUE</option>';
			$numerico .= '<option value=" OR ('.$nome.'CCC=XXX) ">OU - IGUAL A</option>';
			$numerico .= '<option value=" OR ('.$nome.'CCC<>XXX) ">OU - DIFERENTE DE</option>';
			$numerico .= '<option value=" OR ('.$nome.'CCC>XXX) ">OU - MAIOR QUE</option>';
			$numerico .= '<option value=" OR ('.$nome.'CCC<XXX) ">OU - MENOR QUE</option>';
			
			$data = '<option value=" AND ('.$nome.'CCC=\\\'XXX\\\') ">E - IGUAL A</option>';
			$data .= '<option value=" AND ('.$nome.'CCC<>\\\'XXX\\\') ">E - DIFERENTE DE</option>';
			$data .= '<option value=" AND ('.$nome.'CCC>\\\'XXX\\\') ">E - MAIOR QUE</option>';
			$data .= '<option value=" AND ('.$nome.'CCC<\\\'XXX\\\') ">E - MENOR QUE</option>';
			$data .= '<option value=" OR ('.$nome.'CCC=\\\'XXX\\\') ">OU - IGUAL A</option>';
			$data .= '<option value=" OR ('.$nome.'CCC<>\\\'XXX\\\') ">OU - DIFERENTE DE</option>';
			$data .= '<option value=" OR ('.$nome.'CCC>\\\'XXX\\\') ">OU - MAIOR QUE</option>';
			$data .= '<option value=" OR ('.$nome.'CCC<\\\'XXX\\\') ">OU - MENOR QUE</option>';
			
			$bol = '<option value=" AND ('.$nome.'ativa=1) "></option>';
			$bol .= '<option value=" AND ('.$nome.'ativa=1) ">SIM</option>';
			$bol .= '<option value=" AND ('.$nome.'ativa=0) ">NÃO</option>';
			
			$tipos = '';
			$conta = 0;
			$campo = '<option value=""></option>';
			//print_r($esquema);
			foreach($esquema as $campos=>$vetor){
				$conta++;
				if($campo=='testeopprovasagendada_id'){
						$campo .= '<option value="'.$campos.'">Prova</option>'; 
				}else{
					if($campo=='testeopprovasagendada_id'){
						$campo .= '<option value="'.$campos.'">'.$campos.'</option>'; 
					}else{
						$campo .= '<option value="'.$campos.'">'.$campos.'</option>'; 
					}
				}
				switch($campos){
					case 'setor_id': 
						$tipos .= '<input type="hidden" id="tipo'.$conta.'" value="setor_id" name="data[Tipo][]" />';
						break;
					case 'posto_id': 
						$tipos .= '<input type="hidden" id="tipo'.$conta.'" value="posto_id" name="data[Tipo][]" />';
						break;
					case 'especialidade_id': 
						$tipos .= '<input type="hidden" id="tipo'.$conta.'" value="especialidade_id" name="data[Tipo][]" />';
						break;
					case 'unidade_id': 
						$tipos .= '<input type="hidden" id="tipo'.$conta.'" value="unidade_id" name="data[Tipo][]" />';
						break;
					default: 
						$tipos .= '<input type="hidden" id="tipo'.$conta.'" value="'.$vetor['type'].'" name="data[Tipo][]" />';
									 
				}
			}
			
			echo '<input type="hidden" id="find" value="'.$this->data['formFind']['find'].'" name="data[formFind][find]"/>';
			echo $tipos;
			
			?>
			<table cellspacing="0" cellpadding="0" id="filtro" width="100%">
				<tr>
					<th width="100%" align="center" colspan="3"><?php __('Filtro(s) a ser(em) aplicado(s)');?></th>
				</tr>
				<tr>
					<td width="33%">Campo da Tabela</td>
					<td width="33%">Filtro</td>
					<td width="33%">Valor do Filtro</td>
				</tr>
				<?php for($qtd=1;$qtd<=8;$qtd++){ ?>
				<tr>
					<td width="33%"><select id="campo<?php echo $qtd; ?>"
						name="data[campo][]" class="formulario" onchange="preencheFiltro(<?php echo $qtd; ?>);">
						<?php echo $campo; ?>
					</select> </td>
					<td width="33%"><select id="filtro<?php echo $qtd; ?>"
						name="data[filtro][]" onchange="if($('filtro<?php echo $qtd; ?>').value=='SIM'){$('valor<?php echo $qtd; ?>').value=1;preencheSQL(<?php echo $qtd; ?>);}else{$('valor<?php echo $qtd; ?>').value=1;preencheSQL(<?php echo $qtd; ?>);}" class="formulario">
						<option value="" selected="selected"></option>
					</select> </td>
					<td width="33%"><input type="text" id="valor<?php echo $qtd; ?>"
						value="" maxlength="20" class="formulario"
						name="data[valor][]" onchange="preencheSQL(<?php echo $qtd; ?>);" />
						<input type="hidden" id="sql<?php echo $qtd; ?>" value="" name="data[sql][]"/>
						</td>						
				</tr>
				<?php } ?>
				<tr>
					<td colspan="3" style="background-color:#ff2020;font-weight:bold;height:40px;padding:10px;text-align:center;">CAMPOS NM_COMPLETO E NM_GUERRA NÃO DEVEM POSSUIR ACENTOS.</td>
				</tr>
				<tr>
					<td width="33%"></td>
					<td width="33%"><input type="submit" value="APLICAR FILTRO" class="botoes"/></td>
					<td width="33%"></td>
				</tr>

			</table>
			</td>
		</tr>
	</tbody>
</table>

 		
 		
<div class="militars form" id="formularios">
</div>

<div class="actions">
	<ul>
		</ul>
</div>
<div id="carregando" >
    <?php echo $this->Html->image('spinner.gif'); ?>
</div> 

<?php
	echo $ajax->div('listagem');
?>
<?php  
	echo $ajax->divEnd('listagem');
	
echo $form->end();
	
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
    







function listamilitares(){
	new Ajax.Updater('TesteopcandidatoMilitarId','{$this->webroot}testeopcandidatos/externomilitares', {asynchronous:false, evalScripts:false, parameters:Form.Element.serialize('TesteopcandidatoEspecialidadeId'), requestHeaders:['X-Update', 'TesteopcandidatoMilitarId']})
}	


function listasetores(){
	new Ajax.Updater('TesteopcandidatoSetorId','{$this->webroot}testeopcandidatos/externosetores', {asynchronous:false, evalScripts:false, parameters:Form.Element.serialize('TesteopcandidatoUnidadeId'), requestHeaders:['X-Update', 'TesteopcandidatoSetorId']})
}	




		HideContent('carregando');
		
//]]>	
	
	    
		//]]>		
</script>
SCRIPT;
echo $jscript;

	


?>
<script>
ShowContent('formularios');


Event.observe('TesteopcandidatoTesteopprovasagendadaId', 'change', function(event) { 
	new Ajax.Request('<?php echo $this->webroot;?>testeopcandidatos/externoespecialidadeid/', {
				method: 'post',
				postBody: Form.serialize($('TesteopcandidatoExternoatribuiForm')),
				onSuccess: function(transport) {
	
				var resultado = transport.responseText.evalJSON(true);
				
				 
				var c = $('TesteopcandidatoEspecialidadeId'), i=0;
				for (; i<c.options.length; i++){
				if (c.options[i].value == resultado.especialidadeid){
				c.options[i].selected = true;}}
				listamilitares();
			}
					})
}, false);

</script>

<?php 
	}else{
		
		echo '<center><h1><a href="../usuarios/logout">ACESSO NÃO AUTORIZADO!</a></h1></center>';
	}
?>

<!-- <div id="filtro" 	style="border-color: #000000; padding: 0px; z-index: 2; border: 3px solid #000000; position: fixed;  overflow: auto; height: auto; width: auto;">
 -->
 <?php
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

function preencheFiltro(ordem) {
	var numero = '$numerico';
	var literal = '$alfanumerico';
	var data = '$data';
	var setorId = '$setor';
	var postoId = '$posto';
	var especialidadeId = '$especialidade';
	var unidadeId = '$unidade';
	var boleano = '$bol';
	var nome = 'campo'+ordem;
	var valorSelect = $(nome).value;
	var indice = $(nome).options.selectedIndex;
	var filtro = 'filtro'+ordem;
	var valor = 'valor'+ordem;
	$(valor).value = '';
	var sql = 'sql'+ordem;
	$(sql).value = '';
	select_innerHTML(filtro,'');
	
	if(indice>0){
	var nometipo = 'tipo'+indice;
	var tipo = $(nometipo).value;
	
	if((tipo=='string')||(tipo=='text')){
		select_innerHTML(filtro,literal);
		
	}
	if((tipo=='integer')||(tipo=='float')||(tipo=='money')){
		select_innerHTML(filtro,numero);
	}
	if((tipo=='boolean')){
		select_innerHTML(filtro,boleano);
	}
	if((tipo=='date')||(tipo=='datetime')||(tipo=='time')){
		select_innerHTML(filtro,data);
	}
	
	if((tipo=='setor_id')){
		select_innerHTML(filtro,setorId);
	}
	if((tipo=='especialidade_id')){
		select_innerHTML(filtro,especialidadeId);
	}
	if((tipo=='unidade_id')){
		select_innerHTML(filtro,unidadeId);
	}
	if((tipo=='posto_id')){
		select_innerHTML(filtro,postoId);
	}
	
	}
	
    }
    
function preencheSQL(ordem) {
	var nome = 'campo'+ordem;
	var valorCampo = $(nome).value;
	var indice = $(nome).options.selectedIndex;
	var filtro = 'filtro'+ordem;
	var valorFiltro = $(filtro).value;
	
	var sql = 'sql'+ordem;
	$(sql).value = '';
	var valor = 'valor'+ordem;
	var valorValor = $(valor).value;
	
	valorFiltro = valorFiltro.gsub('CCC',valorCampo);
	valorFiltro = valorFiltro.gsub('XXX',valorValor);
	
	$(sql).value = encodeURIComponent(valorFiltro);
	
	
	}
	
function sql() {
	$('find').value = ' 1=1';

  for(i=1;i<=5;i++){
	var nome = 'campo'+i;
	var valorCampo = $(nome).value;
	valorCampo = valorCampo.replace('/',']]]');
	
	var filtro = 'filtro'+i;
	var valorFiltro = $(filtro).value;
	
	var sql = 'sql'+i;
	var valorsql = $(sql).value;
	
	if((valorCampo!=null)&&(valorFiltro!=null)&&(valorsql!=null)){
		$('find').value = $('find').value + valorsql;
	
	}
		
	
	
	}
	
	}
	
	
    
		//]]>

</script>
SCRIPT;
echo $jscript;


?>
</div>
