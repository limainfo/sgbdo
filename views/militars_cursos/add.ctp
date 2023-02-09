<div class="militarsCursos form">
<?php echo $form->create('MilitarsCurso', array('action'=>'verso','onsubmit'=>'submitForm(this); return false;','type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Cadastrar Militares/Curso');?></legend>
	<?php
		echo $form->input('curso_id',array('class'=>'formulario','onchange'=>'javascript:lista();'));
		echo $form->input('militar_id',array('class'=>'formulario','onchange'=>'javascript:lista(1);'));
		echo $datePicker->picker('dt_inicio_curso');
		echo $datePicker->picker('dt_fim_curso');
		echo $form->input('local_realizacao');
		echo $form->input('documento');
	?>
	</fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
<?php
$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
function retorno(){
	var c = $('MilitarsCursoMilitarId');
	c.options[0].selected = true;	
}

function submitForm(form) {
/*
usa método request() da classe Form da prototype, que serializa os campos
do formulário e submete (por POST como default) para a action especificada no form
*/
var dados = Form.serialize($('MilitarsCursoVersoForm'));
var id = $('MilitarsCursoCursoId').value;
new Ajax.Request('{$this->webroot}militars_cursos/verso/'+id, {
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
var dados = Form.serialize($('MilitarsCursoVersoForm'));
var filtro = $('MilitarsCursoCursoId').value;

new Ajax.Request('{$this->webroot}militars_cursos/delete/'+id+'/'+filtro, {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {

				$('dados').innerHTML = transport.responseText;
					}
				})
        
        
    }

function lista(acao) {

var id1 = $('MilitarsCursoCursoId').value;
var id2 = $('MilitarsCursoMilitarId').value;
var url = "";
if(acao==1){
	url = "/"+id2;
}

new Ajax.Request('{$this->webroot}militars_cursos/edit/'+id1+url, {
			method: 'get',
			onSuccess: function(transport) {
				$('dados').innerHTML = transport.responseText;
		}
				})
        
if(acao!=1){
	retorno();
}
				
    }    
		
		//]]>

</script>
SCRIPT;
echo $jscript;


		echo $ajax->div('dados');
		echo $ajax->end('dados');


?>