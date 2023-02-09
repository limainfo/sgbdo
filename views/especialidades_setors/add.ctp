<div class="especialidadesSetors form">
<?php
echo $form->create('EspecialidadesSetor', array('action'=>'verso','onsubmit'=>'submitForm(this); return false;','type'=>'file'));
?>
	<fieldset>
 		<legend><?php __('Relacionar Especialidades, Setores e Cursos');?></legend>
	<?php
		echo $form->input('setor_id',array('class'=>'formulario'));
		echo $form->input('especialidade_id',array('class'=>'formulario','onchange'=>'javascript:lista();'));
		echo $form->input('curso_id',array('class'=>'formulario','onchange'=>'javascript:lista();'));
		//,'onchange'=>'javascript:lista();'
		echo $form->input('necessario',array('class'=>'formulario'));
		?>
	</fieldset>
<?php
echo $form->end(array('label'=>'Registrar','class'=>'botoes'));
?>
</div>
<?php
$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
function submitForm(form) {
/*
usa método request() da classe Form da prototype, que serializa os campos
do formulário e submete (por POST como default) para a action especificada no form
*/
var dados = Form.serialize($('EspecialidadesSetorVersoForm'));
var id = $('EspecialidadesSetorEspecialidadeId').value;
new Ajax.Request('{$this->webroot}especialidades_setors/verso/'+id, {
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
var dados = Form.serialize($('EspecialidadesSetorVersoForm'));
var filtro = $('EspecialidadesSetorCursoId').value;

new Ajax.Request('{$this->webroot}especialidades_setors/delete/'+id+'/'+filtro, {
			method: 'post',
			postBody: dados,
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

function lista(id) {

var id1 = $('EspecialidadesSetorEspecialidadeId').value;
var id2 = $('EspecialidadesSetorSetorId').value;
var id3 = $('EspecialidadesSetorCursoId').value;

new Ajax.Request('{$this->webroot}especialidades_setors/edit/'+id1+'/'+id2+'/'+id3+'/', {
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


		echo $ajax->div('dados');
		echo $ajax->end('dados');


?>
