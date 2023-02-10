<div class="zprovas form">
<div id="cadastraprova">
<?php 
echo $this->Form->create('Zprova', array('action'=>'externoadd','onsubmit'=>'submitForm(this); return false;','type'=>'file'));
//print_r($regulamentos);
?>
	<fieldset>
 		<legend><a href="#" onclick="HideContent('cadastraprova');"> [-] </a><?php __('Acrescentar Prova'); ?></legend>
	<?php

	echo $this->Form->input('nome_prova');
		echo $datePicker->picker('dataprova',array('class'=>'formulario','readonly'=>'readonly'));
		echo $this->Form->input('regulamento',array('class'=>'formulario','onchange'=>'javascript:tratamento(\'ZprovaRegulamento\',\'ZprovaReferencia\');'));
		echo '<label for="ZprovaReferencia">Referência</label>'.$this->Form->select('referencia',array(''=>''),null,array('multiple'=>'multiple'));
		echo '<br><label for="ZprovaReferencia">Ordem</label>'.$this->Form->select('ordem',array('ALEATORIO'=>'ALEATÓRIO','CRESCENTE'=>'CRESCENTE','DECRESCENTE'=>'DECRESCENTE'),'ALEATORIO');
		?>
	</fieldset>
<?php echo $this->Form->end(__('Cadastrar', true));?>
</div>
</div>
<div class="actions">
	<h3><?php __(''); ?></h3>
	<ul>
<li><a href="#" onclick="ShowContent('cadastraprova');">Cadastrar Nova Prova</a></li>
<div id="seleciona">
<?php 
echo $this->Form->create('Zprova', array('action'=>'view'));
//print_r($regulamentos);
?>
	<fieldset>
 		<legend><?php __('Selecionar Prova'); ?></legend>
	<?php
		echo $this->Form->input('nomeprova',array('class'=>'formulario'));
		?>
	</fieldset>
<?php echo $this->Form->end(__('Selecionar', true));?>
</div>
	</ul>
</div>

<?php 

$raiz = $this->webroot;

$observaUnidade=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[

$('cadastraprova').hide();
function tratamento(campoformulario, campomodificado){
var id1 = $('ZprovaRegulamento').value;
new Ajax.Updater(campomodificado,'{$raiz}zprovas/externoreferencia/'+id1, {asynchronous:true, evalScripts:true, parameters:Form.Element.serialize(campoformulario), requestHeaders:['X-Update', campomodificado]})

}
function submitForm(form) {
/*
usa método request() da classe Form da prototype, que serializa os campos
do formulário e submete (por POST como default) para a action especificada no form
*/
var dados = Form.serialize($('ZprovaExternoaddForm'));
var idS = $('ZprovaRegulamento').value;
new Ajax.Request('{$this->webroot}zprovas/externoupdate/'+idS, {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			
			 if (resultado.ok==0){
				alert('Registro não atualizado!');
				//$('dados').innerHTML = resultado.mensagem;
				//$('atuais').innerHTML = resultado.atual;
			}else{
				alert('Registro atualizado!');
				//$('dados').innerHTML = resultado.mensagem;
				//$('atuais').innerHTML = resultado.atual;
							
			}
		}
				})
        
        
        return false;
    }
    
//]]>
</script>
SCRIPT;
echo $observaUnidade;
?>