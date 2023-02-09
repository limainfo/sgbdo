<div style="display: none; position: absolute;top:20px; border-style: solid; background-color: white; padding: 0px; width: 20%; border: 2px solid rgb(0, 0, 0); z-index: 2000" id="detalhes">
<p id="campo" style="padding:0px;height:40px;background-color: #a0abbc; color: #fff; margin: 0px; vertical-align: top;text-align:center; border: 2px; border-color: #000;"></p>
<p	style="margin: 0px; background-color: #ffff00; border: 1px solid #000;"><div id="detalhe"></div></p>
<script type="text/javascript">
<!--
new Draggable('detalhes');
$('wrapper').setStyle='#wrapper table tr:hover td {}';
$('wrapper').removeClassName('#wrapper table tr:hover td');
//-->
</script>
</div>

<div class="manutencaooperacionals form">
<?php echo $form->create('Manutencaooperacional', array('type'=>'file','onsubmit'=>'return false;'));?>
	<fieldset>
 		<legend><?php __('Cadastrar Manutencaooperacional');?>&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
 		</legend>
	<?php
	//echo '<pre>'.print_r($u).'</pre>';
	echo '<label for="Consultanomes">Nome</label><input class="formulario" type="text" name="nome" id="nomeparaconsulta"><input type="submit" value="Buscar" name="btnConsultaNome" onclick="consultanome();" class="botoes">';

	echo $form->input('militar_id',array('class'=>'formulario','onchange'=>'consultaescala();')); 


	echo '<div id="setor_id"><label>Escala:</label>'.$form->select('setor_id', $escalasselect ,'' ,array('class'=>'formulario'), false).'</div>';
	
 
	//print_r($u);
	
	if(($u[0]['Usuario']['privilegio_id']=1)||($u[0]['Usuario']['privilegio_id']=1)){
		//$oaple = '<OPTION value="INCLUSÃO" label="INCLUSÃO">INCLUSÃO EM ESCALA</OPTION>';
	}else{
		$oaple = '';
	}
	
$select1 = '<label for="ManutencaooperacionalMotivo">Motivo</label><select id="origemcomplete" name="origemcomplete" class="formulario">';
$select1 .= '</select>';
$selectOption =<<<FIM
FIM;
//      <OPTION value="INSPEÇÃO DE SAÚDE" label="INSPEÇÃO DE SAÚDE">4.15 INSPEÇÃO DE SAÚDE (SOMENTE CZ, GM, MQ, RB, SL, SN, TT, UA, BV(BCT) e PV(BCT))</OPTION>
      
//echo $selectOption;
//echo $form->hidden('motivo',array('class'=>'formulario')).$select1;
echo $form->hidden('motivo',array('class'=>'formulario')).$selectOption;


//		echo $datePicker->picker('dt_inicio',array('class'=>'formulario','label'=>'Data Início  (YYYY-mm-dd):', 'onchange'=>"var valor=this.value; validaData(valor);"));
//		echo $datePicker->picker('dt_termino',array('class'=>'formulario','label'=>'Data Término (YYYY-mm-dd):'));
		echo $form->input('dt_inicio',array('class'=>'formulario','type'=>'text','label'=>'Data Início  (YYYY-mm-dd):', 'onchange'=>"var valor=this.value; validaData(valor);"));
		echo $form->input('prazo_dias',array('class'=>'formulario','type'=>'text','label'=>'Prazo Manutenção','value'=>'120'));
		echo $form->input('horas_monitoradas',array('class'=>'formulario','type'=>'text','value'=>'60'));
		echo $form->input('horas_fora_sede',array('class'=>'formulario','type'=>'text','value'=>'0'));
		echo $form->input('motivo_fora_sede',array('class'=>'formulario'));
		echo $form->hidden('created',array('class'=>'formulario'));
		
		echo $form->hidden('id',array('class'=>'formulario', 'id'=>'manutencaooperacionalid', 'name'=>'manutencaooperacionalid'));

		$raiz=$this->webroot;
		
$jscript=<<<SCRIPT
<script type="text/javascript">
$('setor_id').hide();
</script>
SCRIPT;

//echo $jscript;		

$jscript=<<<SCRIPT
<script type="text/javascript">

function validaData (data) {
    var formatoValido = /^\d{4}-\d{2}-\d{2}$/; 
    var valido = false;
    if(!formatoValido.test(data))
      alert("A data está no formato errado.  Padrão YYYY-mm-dd.");
    else{
      var ano = data.split("-")[0];
      var mes = data.split("-")[1];
      var dia = data.split("-")[2];
      var MyData = new Date(ano, mes - 1, dia);
      if((MyData.getMonth() + 1 != mes)||
         (MyData.getDate() != dia)||
         (MyData.getFullYear() != ano))
       alert("Valores inválidos para o dia, mês ou ano. Padrão YYYY-mm-dd.");
      else{
        valido = true;
        $('ManutencaooperacionalDtTermino').value=$('ManutencaooperacionalDtInicio').value;
        }
    }

    return valido;
}
//$('ProgramadetrabalhoOrigem').hide();
//<![CDATA[

 
 
Event.observe('origemcomplete', 'change', function(event) { 
$('ManutencaooperacionalMotivo').value = $('origemcomplete').options[$('origemcomplete').options.selectedIndex].value;
var exibe = 0;
if(exibe==1){
 	var excluir = '<a style="float: right; margin: 0px;" href="javascript:HideContent(\'detalhes\');"	onclick="HideContent(\'detalhes\');" 	href="javascript:HideContent(\'detalhes\');"><img border="0" width="15"	height="15" title="Fechar" alt="Fechar" 	src="{$raiz}img/lixo.gif" /> </a>';
 	$('campo').innerHTML = $('ManutencaooperacionalMotivo').value+excluir;
	ShowContent('detalhes');
}

}, false);

//]]>


</script>
SCRIPT;

echo $jscript;		

	?>
	</fieldset>
<?php
echo $form->hidden('militar_responsavel',array('value'=>$u[0]['Usuario']['militar_id']));
echo $ajax->submit('Registrar', array('url'=> array('controller'=>'manutencaooperacionals', 'action'=>'externocadastramanutencaooperacionals'), 'update' => 'cadastrados', 'create' => '$("carregando").show();', 'success' => 'HideContent("carregando");', 'class'=>'botoes'));

//echo $form->end(array('label'=>'Registrar','class'=>'botoes', 'onclick'=>'registraafastamento();'));?>
</div>

<script type="text/javascript">
HideContent('detalhes');
function consultanome() {
	/*
	usa método request() da classe Form da prototype, que serializa os campos
	do formulário e submete (por POST como default) para a action especificada no form
	*/
    	
	var dados = Form.serialize($('ManutencaooperacionalAddForm'));
	new Ajax.Request('<?php echo $this->webroot; ?>manutencaooperacionals/externoconsultanomes', {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {
			var resultado = transport.responseText;
			    	$('ManutencaooperacionalMilitarId').innerHTML = unescape(resultado);
			}
				})
        
    
    return false;
}
function consultaescala(){
	new Ajax.Updater('ManutencaooperacionalSetorId','<?php echo $this->webroot; ?>manutencaooperacionals/externoconsultaescalas', {asynchronous:true, evalScripts:true, parameters:Form.Element.serialize('ManutencaooperacionalMilitarId'), requestHeaders:['X-Update', 'ManutencaooperacionalSetorId']})			    	
	return false;
}
function registramanutencaooperacional() {
	/*
	usa método request() da classe Form da prototype, que serializa os campos
	do formulário e submete (por POST como default) para a action especificada no form
	*/
    	
	var dados = Form.serialize($('ManutencaooperacionalAddForm'));
	new Ajax.Request('<?php echo $this->webroot; ?>manutencaooperacionals/externocadastramanutencaooperacionals', {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {
			var resultado = transport.responseText.evalJSON(true);
			    	$('cadastrados').innerHTML = resultado.mensagem;
			}
				})
        
    
    return false;
}
function excluiManutencaooperacional(){
	var id = $('manutencaooperacionalid').value;
	var completo = '';
	new Ajax.Updater('cadastrados','<?php echo $this->webroot; ?>manutencaooperacionals/externoexcluimanutencaooperacionals', {asynchronous:true, evalScripts:true, parameters:{excluiId: id }, requestHeaders:['X-Update', 'cadastrados']})			    	
	
    return false;		
}

$('ManutencaooperacionalAddForm').observe('manutencaooperacionalid:exclui', function(event) {excluiManutencaooperacional();});

</script>
<?php
	echo $ajax->div('carregando',array('style'=>"border-color: #000000;background-color: #fff; padding: 0px; z-index: 100; position: fixed; top: 50%; left: 50%;  overflow: auto;line-height: 1px; position: absolute; margin-top: -98px; margin-left: -98px;"));
	echo $this->Html->image('ajax-loader.gif', array('alt'=> __('Carregando', true),   'title'=>'Carregando.'));	
	echo $ajax->divEnd('carregando');

 ?>
<div id="cadastrados"></div>
<script>HideContent('carregando');</script>

