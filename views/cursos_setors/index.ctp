<?php
		
$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[

function atualizaRegistros(nomecampo) {

	var linha = nomecampo.substr(nomecampo.indexOf('o')+1,(nomecampo.indexOf('c')-1)-nomecampo.indexOf('o'));
	var coluna = nomecampo.substr(nomecampo.indexOf('c',5)+1);
	var id1 = 'especialidadessetors'+linha;
	var especialidadessetorsid = $(id1).value;
	var id2 = 'cursosRotulos'+coluna;
	var cursosrotulosid = $(id2).value;
	var id3 = 'previsto'+linha+'c'+coluna;
	var valorprevisto = $(id3).value;
	//alert(linha+' - '+coluna);
	
	
	new Ajax.Request('{$this->webroot}cursos_setors/edit/'+especialidadessetorsid+'/'+cursosrotulosid+'/'+valorprevisto+'/'+linha+'/'+coluna, {
			method: 'get',
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			
			 if (resultado.ok==0){
				alert('Registro não atualizado!');
			}else{
			
				var id4  = 'saldo'+linha+'c'+coluna;
				$(id4).value = resultado.saldo;
				
				if($(id4).value<0){
					$(id4).style.backgroundColor = "red";
				}
				alert('Registro atualizado com sucesso!');
				
			}
		}
				})
	
        
    }


function submitForm(form) {
/*
usa método request() da classe Form da prototype, que serializa os campos
do formulário e submete (por POST como default) para a action especificada no form
*/
$('spinner').visible();
var id01 = $('CursosSetorsCursoId').value;
var id02 = $('CursosSetorsSetorId').value;
new Ajax.Request('{$this->webroot}cursos_setors/verso/'+id01+'/'+id02, {
			method: 'get',
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			
			 if (resultado.ok==0){
				//alert('Registro não atualizado!');
			}else{
				//alert('Registro atualizado!');
				$('dados').innerHTML = resultado.mensagem;
				
			}

			
		}
				})
        
			//	atualizaRegistros();
				
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
    
		
		//]]>

</script>
SCRIPT;
echo $jscript;
?>
<div class="cursosSetors index">
<?php
//print_r($cursos);

echo $form->create('CursosSetors', array('action'=>'verso','onsubmit'=>'submitForm(this); return false;','type'=>'file'));
?><fieldset><?php
		echo $form->input('setor_id',array('class'=>'formulario','onchange'=>'submitForm(this); return false;'));
		echo $form->input('curso_id',array('class'=>'formulario','onchange'=>'submitForm(this); return false;'));
		echo $this->Html->link($this->Html->image('broffice.png', array('alt'=> __('BROffice', true), 'border'=> '0', 'title'=>'Dados em planilha BROffice', 'onmouseover'=>$script )), array('action'=>'indexExcel'), array('id'=>'broffice','escape'=>false), null,false);
		
		?></fieldset>
<?php

		echo $ajax->div('dados');
		echo $ajax->end('dados');


echo $form->end();
		
?>
