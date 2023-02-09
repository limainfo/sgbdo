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

<div class="pimos form">
<?php echo $form->create('Pimo', array('type'=>'file','onsubmit'=>'return false;'));?>
	<fieldset>
 		<legend><?php __('Cadastrar Pimo');?>&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
 		</legend>
	<?php
	//echo '<pre>'.print_r($u).'</pre>';
	//echo '<label for="Consultanomes">Nome</label><input class="formulario" type="text" name="nome" id="nomeparaconsulta" value=""><input type="submit" value="Buscar" name="btnConsultaNome" onclick="consultanome();" class="botoes">';

	echo $form->input('setor_id',array('class'=>'formulario','onchange'=>'consultaescala();','label'=>'Escala')); 

//($setors);
	echo '<div id="mes"><label>Mês:</label>'.$form->select('escala_id', $escalasselect ,'' ,array('class'=>'formulario','onchange'=>'consultamilitar();',), false).'</div>';
	echo '<div id="militarid"><label>Militar:</label>'.$form->select('militar_id', $escalasselect ,'' ,array('class'=>'formulario','size'=>'5','multiple'=>'multiple'), false).'</div>';
	
 
	//print_r($u);
	
	if(($u[0]['Usuario']['privilegio_id']=1)||($u[0]['Usuario']['privilegio_id']=1)){
		//$oaple = '<OPTION value="INCLUSÃO" label="INCLUSÃO">INCLUSÃO EM ESCALA</OPTION>';
	}else{
		$oaple = '';
	}
     $motivos = array(
         ' '=>'',
         'INSTRUÇÃO ESPECIALIZADA TEÓRICA'=>'INSTRUÇÃO ESPECIALIZADA TEÓRICA',
         'INSTRUÇÃO ESPECIALIZADA PRÁTICA'=>'INSTRUÇÃO ESPECIALIZADA PRÁTICA',
         'AULAS DE LÍNGUA INGLESA'=>'AULAS DE LÍNGUA INGLESA',
         'PALESTRAS SOBRE ASSUNTOS TÉCNICO-OPERACIONAIS'=>'PALESTRAS SOBRE ASSUNTOS TÉCNICO-OPERACIONAIS',
         'AULAS DE LEGISLAÇÃO E REGULAMENTOS MILITARES'=>'AULAS DE LEGISLAÇÃO E REGULAMENTOS MILITARES',
         'INSTRUÇÃO DE TIRO'=>'INSTRUÇÃO DE TIRO',
         'CONDICIONAMENTO FÍSICO'=>'CONDICIONAMENTO FÍSICO',
         'INSTRUÇÃO DE ORDEM UNIDA, FORMATURAS E SOLENIDADES'=>'INSTRUÇÃO DE ORDEM UNIDA, FORMATURAS E SOLENIDADES',
         'MARCHAS E ACAMPAMENTOS'=>'MARCHAS E ACAMPAMENTOS',
         'PALESTRAS RELATIVAS À ATIVIDADE MILITAR'=>'PALESTRAS RELATIVAS À ATIVIDADE MILITAR',
         'INSTRUÇÃO DE ÉTICA E CIDADANIA'=>'INSTRUÇÃO DE ÉTICA E CIDADANIA',
         'OUTRAS JULGADAS CABÍVEIS PELA OM'=>'OUTRAS JULGADAS CABÍVEIS PELA OM'
     );
//      <OPTION value="INSPEÇÃO DE SAÚDE" label="INSPEÇÃO DE SAÚDE">4.15 INSPEÇÃO DE SAÚDE (SOMENTE CZ, GM, MQ, RB, SL, SN, TT, UA, BV(BCT) e PV(BCT))</OPTION>
      
//echo $selectOption;
//echo $form->hidden('motivo',array('class'=>'formulario')).$select1;
echo $form->input('motivo',array('class'=>'formulario','type'=>'select','options'=>$motivos));


//		echo $datePicker->picker('dt_inicio',array('class'=>'formulario','label'=>'Data Início  (YYYY-mm-dd):', 'onchange'=>"var valor=this.value; validaData(valor);"));
//		echo $datePicker->picker('dt_termino',array('class'=>'formulario','label'=>'Data Término (YYYY-mm-dd):'));
		echo $form->input('inicio',array('class'=>'formulario','type'=>'text','label'=>'Início  (YYYY-mm-dd hh:mm):', 'onchange'=>"var valor=this.value; validaData(valor);"));
		echo $form->input('termino',array('class'=>'formulario','type'=>'text','label'=>'Término (YYYY-mm-dd hh:mm):', 'onchange'=>"var valor=this.value; validaData(valor);"));
		echo $form->input('obs',array('class'=>'formulario','rows'=>'3'));
		echo $form->hidden('created',array('class'=>'formulario'));
		

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
    var formatoValido = /^\d{4}-\d{2}-\d{2} \d{2}:\d{2}$/; 
    var valido = false;
    if(!formatoValido.test(data))
      alert("A data está no formato errado.  Padrão YYYY-mm-dd hh:mm.");
    else{
      var tmp = data.split(" ")[0];
      var ano = tmp.split("-")[0];
      var mes = tmp.split("-")[1];
      var dia = tmp.split("-")[2];
       tmp = data.split(" ")[1];
      var hor = tmp.split(":")[0];
      var min = tmp.split(":")[1];
      var MyData = new Date(ano, mes - 1, dia);
      if((MyData.getMonth() + 1 != mes)||
         (MyData.getDate() != dia)||
         (MyData.getFullYear() != ano))
       alert("Valores inválidos para o dia, mês ou ano. YYYY-mm-dd hh:mm.");
      else{
        valido = true;
        $('PimoDtTermino').value=$('PimoDtInicio').value;
        }
    }

    return valido;
}

</script>
SCRIPT;

echo $jscript;		

	?>
	</fieldset>
<?php
echo $form->hidden('militar_responsavel',array('value'=>$u[0]['Usuario']['militar_id']));
echo $ajax->submit('Registrar', array('url'=> array('controller'=>'pimos', 'action'=>'externocadastrapimos'), 'update' => 'cadastrados', 'create' => '$("carregando").show();', 'success' => 'HideContent("carregando");', 'class'=>'botoes'));

?>
</div>

<script type="text/javascript">
HideContent('detalhes');
function consultanome() {
	/*
	usa método request() da classe Form da prototype, que serializa os campos
	do formulário e submete (por POST como default) para a action especificada no form
	*/
    	
	var dados = Form.serialize($('PimoAddForm'));
	new Ajax.Request('<?php echo $this->webroot; ?>pimos/externoconsultanomes', {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {
			var resultado = transport.responseText;
			    	$('PimoMilitarId').innerHTML = unescape(resultado);
			}
				})
        
    
    return false;
}
function consultaescala(){
	new Ajax.Updater('PimoEscalaId','<?php echo $this->webroot; ?>pimos/externoconsultaescalas', {asynchronous:true, evalScripts:true, parameters:$('PimoAddForm').serialize(), requestHeaders:['X-Update', 'PimoEscalaId']})			    	
	return false;
}
function consultamilitar(){
	new Ajax.Updater('PimoMilitarId','<?php echo $this->webroot; ?>pimos/externoconsultanomes', {asynchronous:true, evalScripts:true, parameters:$('PimoAddForm').serialize(), requestHeaders:['X-Update', 'PimoMilitarId']})			    	
	return false;
}
function registrapimo() {
	/*
	usa método request() da classe Form da prototype, que serializa os campos
	do formulário e submete (por POST como default) para a action especificada no form
	*/
    	
	var dados = Form.serialize($('PimoAddForm'));
	new Ajax.Request('<?php echo $this->webroot; ?>pimos/externocadastrapimos', {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {
			var resultado = transport.responseText.evalJSON(true);
			    	$('cadastrados').innerHTML = resultado.mensagem;
			}
				})
        
    
    return false;
}
function excluiPimo(){
	var id = $('pimoid').value;
	var completo = '';
	new Ajax.Updater('cadastrados','<?php echo $this->webroot; ?>pimos/externoexcluipimos', {asynchronous:true, evalScripts:true, parameters:{excluiId: id }, requestHeaders:['X-Update', 'cadastrados']})			    	
	
    return false;		
}

$('PimoAddForm').observe('pimoid:exclui', function(event) {excluiPimo();});

</script>
<?php
	echo $ajax->div('carregando',array('style'=>"border-color: #000000;background-color: #fff; padding: 0px; z-index: 100; position: fixed; top: 50%; left: 50%;  overflow: auto;line-height: 1px; position: absolute; margin-top: -98px; margin-left: -98px;"));
	echo $this->Html->image('ajax-loader.gif', array('alt'=> __('Carregando', true),   'title'=>'Carregando.'));	
	echo $ajax->divEnd('carregando');

 ?>
<div id="cadastrados"></div>
<script>HideContent('carregando');
$('flashMessage').update('');
</script>

