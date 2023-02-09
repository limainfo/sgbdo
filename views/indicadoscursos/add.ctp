<div id="login"
	style="border-color: rgb(0, 0, 0); padding: 0px; z-index: 2; border: 3px solid #000000; position: fixed; top: 10%; left: 5%; overflow: auto; height: auto; width: auto;">
<?php echo $form->create('Indicadoscurso', array('action'=>'edit','onsubmit'=>'editaForm(this); return false;','type'=>'file'));?>
<table cellspacing="0" cellpadding="0" id="login">
	<tbody>
		<tr>
			<td align="center">
			<table cellspacing="0" cellpadding="0" id="login" width="100%">
				<tr>
					<th width="2%"><a href="#"
						onclick="javascript: $('login').hide();">X</a></th>
					<th width="98%" align="center"><?php __('Modificar dados de Cursos x Rótulos');?></th>
				</tr>
				<tr>
					<td width="100%" colspan="2">
					<input type="text" id="militar" value="" readonly="readonly" size="50" class="formulario" name="militar" /><br>
					Turma:
					<select	 id="turma" class="formulario" name="data[Indicadoscurso][cursoativo_id]" ><option>1</option></select><br>
					Prioridade:<input type="text" id="prioridade" value="" maxlength="20" class="formulario" name="data[Indicadoscurso][prioridade]" /><br>
					Tipo:
					<select	 id="tipo" class="formulario" name="data[Indicadoscurso][tipo]" >
					<option value="INSTRUTOR">INSTRUTOR</option>
					<option value="ALUNO" selected="selected" >ALUNO</option>
					</select><br>
					<input type="hidden" id="id" value="" readonly="readonly" name="data[Indicadoscurso][id]" />						
					<input type="hidden" id="militarId" value="" readonly="readonly" name="data[Indicadoscurso][militar_id]" />						
					<input type="hidden" id="status" value="" readonly="readonly" name="data[Indicadoscurso][status]" />
											
					</td>
				</tr>
				<tr>
					<td width="33%"></td>
					<td width="66%"><?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
					</td>
				</tr>

			</table>
			</td>
		</tr>
	</tbody>
</table>
</div>


<div class="indicadoscursos form">
<?php echo $form->create('Indicadoscurso', array('action'=>'verso','onsubmit'=>'submitForm(this); return false;','type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Indicar Militares');?>&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link($this->Html->image('broffice.png', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'indexExcel', null),array('escape'=>false, 'escape'=>false), null,false); ?>
 		</legend>
 		
 		
	<?php
	$ano = array();
	for($i=2009;$i<=(date('Y')+1);$i++){
		$ano[$i] = $i;
	}
	echo $form->input('ano_base',array('class'=>'formulario','options'=>$ano));
	echo $form->input('unidade_id',array('class'=>'formulario','onchange'=>'var id = $(\'IndicadoscursoUnidadeId\').value;lista(\'Setor\',\'Setor\',id);'));
	
	echo $form->input('setor_id',array('class'=>'formulario'));
	echo $form->input('especialidade_id',array('class'=>'formulario'));
	echo $form->input('curso_id',array('class'=>'formulario','label'=>'Curso'));
	echo $form->input('necessidade',array('class'=>'formulario','options'=>''));
	echo $form->input('cursoativo_id',array('class'=>'formulario','label'=>'Turma/Início/Término'));
	
	$raiz = $this->webroot;
	
$observaUnidade=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
function limpeza(niveis){
var nivel = new Array();
nivel[1] = 'IndicadoscursoMilitarId';
nivel[2] = 'IndicadoscursoCursoativoId';
nivel[3] = 'IndicadoscursoNecessidade';
nivel[4] = 'IndicadoscursoCursoId';
nivel[5] = 'IndicadoscursoEspecialidadeId';
nivel[6] = 'IndicadoscursoSetorId';

for(var i=1;i<=niveis;i++){
	$(nivel[i]).innerHTML = '';
}

}
function tratamento(nivel, acao, campoformulario, campomodificado, completaURL){
	limpeza(nivel);
	new Ajax.Updater(campomodificado,'{$raiz}indicadoscursos/update/'+acao+'/'+completaURL, {asynchronous:true, evalScripts:true, parameters:Form.Element.serialize(campoformulario), requestHeaders:['X-Update', campomodificado]})
}

function detalhes(valorsetor, valorcurso, destino){
	new Ajax.Updater(destino,'{$raiz}indicadoscursos/view/'+valorsetor+'/'+valorcurso, {asynchronous:true, evalScripts:true, requestHeaders:['X-Update', destino]})
}

new Form.Element.EventObserver('IndicadoscursoUnidadeId', function(element, value){tratamento(6,'unidade','IndicadoscursoUnidadeId','IndicadoscursoSetorId','');})
//]]>
</script>
SCRIPT;
echo $observaUnidade;


$observaSetor=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
new Form.Element.EventObserver('IndicadoscursoSetorId', function(element, value){tratamento(5,'setor','IndicadoscursoSetorId','IndicadoscursoEspecialidadeId','');})
new Form.Element.EventObserver('IndicadoscursoSetorId', function(element, value){detalhes($('IndicadoscursoSetorId').value,0,'orientacao');})
//]]>
</script>
SCRIPT;
echo $observaSetor;


$observaEspecialidade=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
new Form.Element.EventObserver('IndicadoscursoEspecialidadeId', function(element, value){tratamento(4,'especialidade','IndicadoscursoEspecialidadeId','IndicadoscursoCursoId',$('IndicadoscursoSetorId').value+'/'+$('IndicadoscursoAnoBase').value);})
//]]>
</script>
SCRIPT;
echo $observaEspecialidade;

$observaCurso=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
new Form.Element.EventObserver('IndicadoscursoCursoId', function(element, value){tratamento(1,'curso','IndicadoscursoCursoId','IndicadoscursoCursoativoId',$('IndicadoscursoSetorId').value+'/'+$('IndicadoscursoAnoBase').value+'/'+$('IndicadoscursoEspecialidadeId').value);})
new Form.Element.EventObserver('IndicadoscursoCursoId', function(element, value){tratamento(1,'cursonecessidade','IndicadoscursoCursoId','IndicadoscursoNecessidade',$('IndicadoscursoSetorId').value+'/'+$('IndicadoscursoAnoBase').value+'/'+$('IndicadoscursoEspecialidadeId').value);})
new Form.Element.EventObserver('IndicadoscursoCursoId', function(element, value){tratamento(1,'cursomilicos','IndicadoscursoCursoId','IndicadoscursoMilitarId',$('IndicadoscursoSetorId').value+'/'+$('IndicadoscursoAnoBase').value+'/'+$('IndicadoscursoEspecialidadeId').value);})
new Form.Element.EventObserver('IndicadoscursoCursoId', function(element, value){detalhes($('IndicadoscursoSetorId').value,$('IndicadoscursoCursoId').value,'orientacao');})
//]]>
</script>
SCRIPT;
echo $observaCurso;

//$options = array('url' => 'update','update' => 'IndicadoscursoMilitarId');
	//echo $ajax->observeField('IndicadoscursoCursoativoId',$options);
	
	//$options = array('url' => 'verso','update' => 'dados');
	//echo $ajax->observeField('IndicadoscursoCursoativoId',$options);
	
		echo $form->input('militar_id',array('class'=>'formulario'));
		echo $form->hidden('prioridade',array('class'=>'formulario','value'=>'0'));
		echo $form->hidden('indicado',array('class'=>'formulario'));
		?>
		<div class="input text">
		<label for="IndicadoscursoTipo">Tipo</label><select	 id="IndicadoscursoTipo"  class="formulario" name="data[Indicadoscurso][tipo]" >
					<option value="INSTRUTOR">INSTRUTOR</option>
					<option value="ALUNO" selected="selected" >ALUNO</option>
					</select></div>
		
		<?php
		echo $form->hidden('status',array('class'=>'formulario','value'=>'I'));
	?>
	</fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
    <?php
//    echo $mensagem;
  //  echo $ajax->div('orientacao');
   // echo $ajax->end('orientacao');
	echo "<hr><div id='orientacao'></div>";
    
    $jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
function exibe(id, nome, militar_id, prioridade, status, turma, tipo) {

$('id').value = id;
$('militarId').value = militar_id;
$('prioridade').value = prioridade;
$('status').value = decodeURIComponent(status);
$('turma').value = decodeURIComponent(turma);
$('militar').value = decodeURIComponent(nome);
var c = $('tipo');
for (var i=0; i<c.options.length; i++){
	if (c.options[i].value == decodeURIComponent(tipo)){
		c.options[i].selected = true;
		break;
	}
}


 $('login').show();
 }
 //]]>
</script>

SCRIPT;


    echo $jscript;

    ?>
    <?php
    $jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
 $('login').hide();
 
</script>
SCRIPT;

    echo $jscript;
    ?>
<?php
$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[

function select_innerHTML(objetoId,innerHTML){
/******addslashes
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

function seleciona(html) {
	select_innerHTML('turma',decodeURIComponent(html));
    }
    
    
		//]]>

</script>
SCRIPT;
echo $jscript;


?>
<?php
$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
    function editaForm(form) {
					/*
					usa método request() da classe Form da prototype, que serializa os campos
					do formulário e submete (por POST como default) para a action especificada no form
					*/
					var dados = Form.serialize($('IndicadoscursoEditForm'));
					var id = $('id').value;
					new Ajax.Request('{$this->webroot}indicadoscursos/edit/'+id, {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			
if (resultado.ok==0){
alert('Registro não atualizado!');
			}else{
			alert('Registro atualizado!');
			$('dados').innerHTML = resultado.mensagem;
				
			}
					}
				})
        
        
        return false;
    }

function submitForm(form) {
/*
usa método request() da classe Form da prototype, que serializa os campos
do formulário e submete (por POST como default) para a action especificada no form
*/
var dados = Form.serialize($('IndicadoscursoVersoForm'));
var id = $('id').value;
new Ajax.Request('{$this->webroot}indicadoscursos/verso/cadastrar', {
method: 'post',
postBody: dados,
onSuccess: function(transport) {

var resultado = transport.responseText.evalJSON(true);
	
if (resultado.ok==0){
alert('Registro não atualizado!');
			}else{
			alert('Registro atualizado!');
			$('dados').innerHTML = resultado.mensagem;
				
			}
		}
				})


				return false;
    }

function excluiRegistro(id) {
    /*
    usa método request() da classe Form da prototype, que serializa os campos
    do formulário e submete (por POST como default) para a action especificada no form
    */
    var dados = Form.serialize($('IndicadoscursoEditForm'));

    new Ajax.Request('{$this->webroot}indicadoscursos/delete/'+id+'/', {
    method: 'get',
    onSuccess: function(transport) {

    var resultado = transport.responseText.evalJSON(true);
    	
    if (resultado.ok==0){
    alert('Registro não excluído!');
			}else{
			alert('Registro excluído!');
			$('dados').innerHTML = resultado.mensagem;
			}
		}
				})


    }

function lista(tabela, id) {



new Ajax.Request('{$this->webroot}especialidades_setors/'+tabela+'/'+id, {
			method: 'get',
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			
			 if (resultado.ok==0){
				//alert('Registro não excluído!');
			}else{
				//alert('Registro excluído!');
				$('dados').innerHTML = resultado.mensagem;
			
			}
		}
				})
        
        
    }        

    
		//]]>

</script>
SCRIPT;
    echo $jscript;

	echo "<hr><div id='dados'></div>";


    ?>
   