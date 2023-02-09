<div id="login"
	style="border-color: rgb(0, 0, 0); padding: 0px; z-index: 2; border: 3px solid #000000; position: fixed; top: 10%; left: 5%; overflow: auto; height: auto; width: auto;">
<?php echo $form->create('CursosRotulo', array('action'=>'edit','onsubmit'=>'editaForm(this); return false;','type'=>'file'));?>
<table cellspacing="0" cellpadding="0" id="login">
	<tbody>
		<tr>
			<td valign="center" align="center">
			<table cellspacing="0" cellpadding="0" id="login" width="100%">
				<tr>
					<th width="10%"><a href="#"
						onclick="javascript: $('login').hide();">X</a></th>
					<th width="90%" align="center" colspan="2"><?php __('Modificar dados de Cursos x Rótulos');?></th>
				</tr>
				<tr>
					<td width="100%" colspan="3">
					Rótulo:
					<input	type="text"  id="rotulo" value="" readonly="readonly"	maxlength="40" class="formulario" name="data[Complemento][rotulo]" /><br>
					Curso:<input type="text" id="curso" value="" readonly="readonly" maxlength="20" class="formulario" name="data[Complemento][curso]" /><br>
					<input type="hidden" id="CursosRotuloId" value="" readonly="readonly" name="data[CursosRotulo][id]" />						
					<input type="hidden" id="rotuloId" value="" readonly="readonly" name="data[CursosRotulo][rotulo_id]" />						
					<input type="hidden" id="cursoId" value="" readonly="readonly" name="data[CursosRotulo][curso_id]" />
					Necessário:<input type="text" id="necessario" value="" maxlength="4" class="formulario" name="data[CursosRotulo][necessario]" />
											
					</td>
				</tr>
				<tr>
					<td width="33%"></td>
					<td width="33%"></td>
					<td width="33%"><?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
					</td>
				</tr>

			</table>
			</td>
		</tr>
	</tbody>
</table>
</div>


<div class="cursosRotulos form"><?php 
echo $form->create('CursosRotulo', array('action'=>'verso','onsubmit'=>'submitForm(this); return false;','type'=>'file'));
?>
<fieldset><legend> <?php __('Cadastrar  Cursos x Rótulo');?>
&nbsp;&nbsp;&nbsp; <?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
</legend> <?php
echo $form->input('rotulo_id',array('class'=>'formulario','onchange'=>'javascript:lista();'));
echo $form->input('curso_id',array('class'=>'formulario'));
echo $form->input('necessario',array('class'=>'formulario'));
?></fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
<?php
$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
    function editaForm(form) {
					/*
					usa método request() da classe Form da prototype, que serializa os campos
					do formulário e submete (por POST como default) para a action especificada no form
					*/
					var dados = Form.serialize($('CursosRotuloEditForm'));
					var id = $('rotuloId').value;
					new Ajax.Request('{$this->webroot}cursos_rotulos/edit/'+id, {
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
var dados = Form.serialize($('CursosRotuloVersoForm'));
var id = $('CursosRotuloRotuloId').value;
new Ajax.Request('{$this->webroot}cursos_rotulos/verso/'+id, {
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
    var dados = Form.serialize($('CursosRotuloVersoForm'));
    var filtro = $('CursosRotuloRotuloId').value;

    new Ajax.Request('{$this->webroot}cursos_rotulos/delete/'+id+'/'+filtro, {
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

    var filtro = $('CursosRotuloRotuloId').value;

    new Ajax.Request('{$this->webroot}cursos_rotulos/verso/'+filtro, {
			method: 'get',
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			
				$('dados').innerHTML = resultado.mensagem;
			
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
    <?php
    $jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
function exibe(id, rotulo_id, curso_id, rotulo, curso, necessario) {

$('CursosRotuloId').value = id;
$('rotuloId').value = rotulo_id;
$('cursoId').value = curso_id;
$('necessario').value = necessario;
$('curso').value = decodeURIComponent(curso);
$('rotulo').value = decodeURIComponent(rotulo);

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
