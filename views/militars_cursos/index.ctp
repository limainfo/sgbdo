
<div class="escalas form"><?php 
echo '<pre>';
//print_r($this->data);
echo '</pre>';

$anos = array();
$ano = date('Y')+1;
$anoa = date('Y')-1;
for ($inicio=$anoa; $inicio<=$ano;$inicio++){
	$anos[$inicio]=$inicio;
}

if(empty($this->data['Escala']['mes'])){
	$this->data['Escala']['mes'] = date('n');
	$this->data['Escala']['ano'] = date('Y');
}
$script = "var url = '{$this->webroot}militars_cursos/add';	window.open(url,'','toolbar=0,scrollbars=1,directories=0,status=0');";

echo $form->create('MilitarsCurso',array('action'=>'geraescala'));
echo $form->select('rotulo', $anos ,$this->data['MilitarsCurso']['rotulo'] ,array('onChange'=>"",'class'=>'formulario'), false);
echo "<a onclick=\"$script\" value='popup' href='#'>Cadastrar</a><input type=\"submit\" value=\"Cadastrar rótulo\" class=\"botoes\" onmousedown=\"\$('MilitarsCursoGeraescalaForm').action='{$this->webroot}escalas/add';\" />";
echo "<input type=\"submit\" value=\"Imprimir\" class=\"botoes\" onmousedown=\"\$('EscalaGeraescalaForm').action='{$this->webroot}escalas/geraescala';\" style=\"float:right;\" />";
echo $form->end();

echo $form->create('MilitarsCurso',array('onsubmit'=>'return false;','action'=>'index'));
echo "<input	type='hidden'  id='total' name='total' value='3'  >";
?>
<fieldset><legend><?php __('Cadastrar Rótulos');?>&nbsp;&nbsp;&nbsp;&nbsp;
</legend> 
<?php 		

$script=<<<HARD
		
if (1==1){
	$('MilitarsCursoIndexForm').submit();
}else{

	//alert('Não esqueça de cadastrar turnos, militares, datas previstas e verifique se não existem legendas duplicadas !!');
	return false;
}


HARD;

$qtd_colunas = count($colunas);
$todas_colunas = '<div class="input select required"><label for="MilitarsCursoCursoId">Curso</label><select id="curso" name="data[MilitarsCurso][curso_id]" class="formulario">';

for($y=0;$y<$qtd_colunas;$y++){
		$todas_colunas.= "<option value='".$colunas[$y]['Curso']['id']."'>".$colunas[$y]['Curso']['codigo']."</option>";
}
$todas_colunas.= "</select>";

echo $todas_colunas;

echo "</label>&nbsp;
<input type='button' value='Acrescentar curso' onmousedown=\"".'if(isNaN(Number($(\'total\').value))){$(\'total\').value=Number(3);}$(\'total\').value = Number($(\'total\').value)+1;var id=$(\'curso\').options[$(\'curso\').options.selectedIndex].value;var nome=$(\'curso\').options[$(\'curso\').options.selectedIndex].text;inserirColunaTabela(id,nome);'."\" class='botoes'>&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' value='Registrar alterações' onmousedown=\"$('MilitarsCursoIndexForm').submit();\" class='botoes'>
</div>";

echo "<div class=\"formulario\"><table id='tabela'><tr><th>Unidade</th><th>Setor</th><th>Esp.</th><th>opção</th></tr>";

$conta = 0;
foreach($linhas as $linha){
	echo '<tr><td>'.$linha['Unidade']['sigla_unidade'].'</td><td>'.$linha['Setor']['sigla_setor'].'</td><td>'.$linha['Quadro']['sigla_quadro'].'-'.$linha['Especialidade']['nm_especialidade'].'</td>'."<td><input	type='checkbox'  id='chk".$linha['Unidade']['id'].$linha['Setor']['id'].$linha['Especialidade']['id']."' size='3' name='data[Planejamento][especialidade_id][]'	class='formulario'	onclick=\"if(this.checked){\$('chkh".$linha['Unidade']['id'].$linha['Setor']['id'].$linha['Especialidade']['id']."').value=Number(".$linha['Unidade']['id'].$linha['Especialidade']['id'].");}else{\$('chkh".$linha['Unidade']['id'].$linha['Setor']['id'].$linha['Especialidade']['id']."').value=Number(0);}\" value=0	><input	type='hidden'  id='unidade".$linha['Unidade']['id'].$linha['Setor']['id'].$linha['Especialidade']['id']."' value='".$linha['Unidade']['id']."' name='data[Unidade][id][]' ><input	type='hidden'  id='especialidade".$linha['Unidade']['id'].$linha['Setor']['id'].$linha['Especialidade']['id']."' value='".$linha['Especialidade']['id']."' name='data[Especialidade][id][]' ><input	type='hidden'  id='setor".$linha['Unidade']['id'].$linha['Setor']['id'].$linha['Especialidade']['id']."' value='".$linha['Setor']['id']."' name='data[Setor][id][]' ><input	type='hidden'  id='chkh".$linha['Unidade']['id'].$linha['Setor']['id'].$linha['Especialidade']['id']."' value='0' name='data[Posicao][]' ></td></tr>";
	$conta++;
	if($conta>10){break;}
}
echo "</table></div><br><br>";
					



	
		/*
		 echo '<pre>';
		 print_r($linhas);
		 echo '</pre>';
		 */
		
				?>

</fieldset>
<script language="javascript">
        // Função responsável por inserir linhas na tabela
        function inserirColunaTabela(cursoid, cursonome) {

            // Captura a referência da tabela com id “minhaTabela”
            var table = $("tabela");
            // Captura a quantidade de linhas já existentes na tabela
            var numOfRows = table.rows.length;
            // Captura a quantidade de colunas da última linha da tabela
            var numOfCols = table.rows[numOfRows-1].cells.length;

            // Insere uma linha no fim da tabela.
           // var novaColuna = table.insertCell(numOfRows);
            //var newRow = table.insertRow(numOfRows);
 
            // Faz um loop para criar as colunas

            newCell = table.rows[0].insertCell(numOfCols);
            newCell.innerHTML = "<input type='hidden' value='"+numOfCols+"' id='coluna"+numOfCols+"'><input type='hidden' value='"+cursoid+"' id='curso"+cursoid+"' name='data[Curso]["+(numOfCols)+"][id]'>"+cursonome+" <a href='#' onclick="+'"var posicao=$(\'coluna'+(numOfCols)+'\').value;removerColunaTabela(posicao);" >X</a></div>';
            
            for (var j = 1; j < numOfRows; j++) {
                // Insere uma coluna na nova linha 
                newCell = table.rows[j].insertCell(numOfCols);
                // Insere um conteúdo na coluna
                newCell.innerHTML = "<input type='text' class='formulario' id='curso"+ cursoid +  j + "' name='data[Curso]["+numOfCols+"][]' size='2' onkeyup='if(isNaN(Number(this.value))){this.value=Number(1);}else{if(Number(this.value)==0){this.value= Number(1);}else{this.value= Number(this.value);}}' value='0' >";
            }

        }

        function removerColunaTabela(posicao) {

            // Captura a referência da tabela com id “minhaTabela”
            var table = $("tabela");
            // Captura a quantidade de linhas já existentes na tabela
            var numOfRows = table.rows.length;
            // Captura a quantidade de colunas da primeira linha da tabela
            var numOfCols = table.rows[0].cells.length;

			//alert(posicao);
            
        	var limite = Number($('total').value) + 1;
        	//alert(limite);
        	var nome = "";
        	var inicio = Number(posicao);
        	posicao = Number(posicao);
        	
        	if(posicao<=limite){
        		for(i=inicio;i<=limite;i++){
        			nome = $('coluna'+i);
        			//alert(nome);
        			if(nome !=null){
        				nome.value = Number(nome.value) - 1;
        			//alert(nome);
        			}
        		}
        	}
        	
            for (var j = 0; j < numOfRows; j++) {
                // Insere uma coluna na nova linha 
                table.rows[j].deleteCell(posicao);
            }
            $('total').value = Number($('total').value)-1;

        }
</script>
<script type="text/javascript">
function clickElement(elementid)
	{
	var e = document.getElementById(elementid);
		if (typeof e == 'object')
		{
		
			//alert( "type object" );
			if(document.createEventObject)
			{
				//alert('createEventObject');
				e.fireEvent('onclick');
				return false;
			}
			else if(document.createEvent)
			{
				//alert('createEvent');
				var evObj = document.createEvent('MouseEvents');
				evObj.initEvent('click',true,true);
				e.dispatchEvent(evObj);
				return false;
			}else
				{
					//alert('click');
					e.click();
					return false;
				}
			}
		//else
			//alert( "not type object" );
		}</script> 
<?php 


echo $form->end();?></div>

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
echo $form->create('Escala', array('action'=>'verso','onsubmit'=>'submitForm(this); return false;','type'=>'file'));
echo $form->end(array('label'=>'Registrar','class'=>'botoes'));
echo $jscript;

?>