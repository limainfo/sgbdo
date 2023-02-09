<div class="equipamentos form">
<?php echo $form->create('Equipamento', array('action'=>'edit','onsubmit'=>'editaForm(this); return false;','type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Cadastrar Equipamento');?>&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
 		<a id='todos' onclick="detalhes(0,0,0);" href="#"><img  border="0" title="Exibe Todos" alt="Índice" src="<?php echo $this->webroot; ?>img/lupa.gif"/></a> 		
 		
 		
	<?php
		echo $form->input('nome',array('class'=>'formulario'));
		echo $form->input('tipo',array('class'=>'formulario'));
		echo $form->input('descricao',array('class'=>'formulario'));
		echo $form->input('localidade_id',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>

<?php
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
	new Ajax.Updater(campomodificado,'{$raiz}equipamentos/update/'+acao+'/'+completaURL, {asynchronous:true, evalScripts:true, parameters:Form.Element.serialize(campoformulario), requestHeaders:['X-Update', campomodificado]})
}

function detalhes(valorsetor, valorcurso, destino){
    alert('Clicou');
	new Ajax.Updater(destino,'{$raiz}equipamentos/view/'+valorsetor+'/'+valorcurso, {asynchronous:true, evalScripts:true, requestHeaders:['X-Update', 'orientacao']})
}

//]]>
</script>
SCRIPT;
echo $observaUnidade;


$observaSetor=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
new Form.Element.EventObserver('todos', function(element, value){detalhes(0,0,'orientacao');})
//]]>
</script>
SCRIPT;
echo $observaSetor;


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
 
</script>
SCRIPT;

    echo $jscript;
    ?>
<?php
$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
    function editaForm(form) {
			var dados = Form.serialize($('EquipamentoEditForm'));
			var id = $('id').value;
			new Ajax.Request('{$this->webroot}equipamentos/edit/'+id, {
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
	var dados = Form.serialize($('EquipamentoEditForm'));
	var id = $('id').value;
	new Ajax.Request('{$this->webroot}equipamentos/verso/cadastrar', {
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

    new Ajax.Request('{$this->webroot}equipamentos/delete/'+id+'/', {
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



new Ajax.Request('{$this->webroot}equipamentos/'+tabela+'/'+id, {
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

