<div class="cursosSetors form">
<?php echo $form->create('CursosSetor');?>
	<fieldset>
 		<legend>
 		 		 		<?php __('Cadastrar  CursosSetor');?>				
 		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
</legend>
	<?php
		echo $form->input('setor_id',array('class'=>'formulario'));
		echo $form->input('curso_id',array('class'=>'formulario'));
		echo $form->input('previsto',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
<!-- 
<?php  
$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
function submitForm(form) {
/*
usa método request() da classe Form da prototype, que serializa os campos
do formulário e submete (por POST como default) para a action especificada no form
*/
var mes = $dtm;
var ano = $dta;
var prevista = $('EscalaPrevista').value;
var dados = Form.serialize($('EscalaVersoForm'));
new Ajax.Request('{$this->webroot}escalas/verso/{$escala['Escala']['id']}/'+mes+'/'+ano+'/'+prevista, {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			 if (resultado.ok==0){
				alert('Registro não atualizado! \\n'+resultado.mensagem);
			}else{
				alert('Registro atualizado! \\n'+resultado.mensagem);
			
			}
			$('data[Verso][obscmt]').value = resultado.obscmt;
			 $('data[Verso][obs]').value = resultado.obs;
			 $('data[Verso][alteracoes]').value = resultado.alteracoes;
		}
				})
        
        
        return false;
    }
		
		
		//]]>

</script>
SCRIPT;

echo $jscript;
	echo $form->create('Escala', array('action'=>'verso','onsubmit'=>'submitForm(this); return false;','type'=>'file'));
	echo $form->end(array('label'=>'Registrar','class'=>'botoes'));
?>
-->