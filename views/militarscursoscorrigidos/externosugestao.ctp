<div class="cursos form">
<?php
echo $form->create('Militarscursoscorrigido', array('action'=>'externosugestaoadd','onsubmit'=>'submitForm(this); return false;','type'=>'file'));

?>
	<fieldset>
 		<legend><?php __('Cadastrar sugestão');?>&nbsp;&nbsp;&nbsp;
 		</legend>
	<?php
	$opcoes[$sugestaos['setor_id']]=$sugestaos['setor_id'];
		echo $form->hidden('setor_id',array('class'=>'formulario','value'=>$sugestaos['setor_id'],'options'=>$opcoes));
		echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$sugestaos['militar_id']));
		echo $form->input('nm_militar',array('class'=>'formulario','value'=>$sugestaos['nm_militar'],'readonly'=>'readonly','size'=>50));
		echo $form->hidden('dt_sugestao',array('class'=>'formulario','value'=>$sugestaos['dt_sugestao'],'readonly'=>'readonly'));
		echo $form->hidden('responsavel',array('class'=>'formulario','value'=>$sugestaos['responsavel'],'readonly'=>'readonly'));
		$tipos['ALTERAÇÃO NO POSTO/GRADUAÇÃO']='ALTERAÇÃO NO POSTO/GRADUAÇÃO';
		$tipos['ALTERAÇÃO NO SETOR']='ALTERAÇÃO NO SETOR';
		$tipos['TRANSFERIDO']='TRANSFERIDO';
		$tipos['RESERVA']='RESERVA';
		$tipos['OUTROS']='OUTROS';
		echo $form->input('tipo_sugestao',array('class'=>'formulario','value'=>'','options'=>$tipos));
		echo $form->input('sugestao',array('class'=>'formulario','value'=>'','rows'=>'5','cols'=>'40'));
		//echo $form->input('Militar',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));

$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
function submitForm(form) {
/*
usa método request() da classe Form da prototype, que serializa os campos
do formulário e submete (por POST como default) para a action especificada no form
*/
var dados = Form.serialize($('MilitarscursoscorrigidoExternosugestaoaddForm'));
new Ajax.Request('{$this->webroot}militarscursoscorrigidos/externosugestaoadd/', {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			
			 if (resultado.ok==0){
				alert('Registro não atualizado!');
			}else{
				alert(resultado.mensagem);
				self.close();
			}
		}
				})
        
        
        return false;
 }
    
    
    
		//]]>

</script>
SCRIPT;
echo $jscript;


?>
</div>