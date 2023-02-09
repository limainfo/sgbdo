<center>
<div class="necessidades form">
<div id="impressao" style="border-width: 2px medium solid #000030;">
<?php

	$limiteano=(date('Y')+1);
	for($i=2021;$i<=$limiteano;$i++){
		$anos[$i]=$i;
	}

echo $form->create('Necessidade', array('action'=>'externopdf', 'type'=>'file','target'=>'_blank', 'inputDefaults'=>array('label'=>false, 'div'=>false)));
?>
	<fieldset>
 		<legend style="background-color:#c0c0c0;"><?php __('Cabeçalho para impressão')?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link($this->Html->image('btsair.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'width'=> '25px', 'height'=> '25px', 'title'=>'Excluir')), array(), array('onclick'=>"this.href='#';HideContent('impressao');return false;",'escape'=>false, 'escape'=>false), null,false); ?>
 		</legend>
	<?php
	$divisoes ='';
	foreach($solicitantes as $indice=>$valor){
		//print_r($valor);
		$divisoes[$valor['Necessidade']['divisao_solicitante']] = $valor['Necessidade']['divisao_solicitante'];
	}
	//print_r($anos);
	//print_r($divisoes);
		echo $form->input('ano',array('class'=>'formulario','options'=>$anos, 'default'=>date('Y'))).'<br>';
		echo $form->input('solicitantes',array('class'=>'formulario','options'=>$divisoes, 'default'=>date('Y')));
		echo $form->input('unidade_responsavel',array('class'=>'formulario','value'=>'CINDACTA IV'));
		echo $form->input('siat',array('class'=>'formulario','value'=>'SIAT-MN'));
		echo $form->input('chefe',array('class'=>'formulario','size'=>'50', 'value'=>'ALESSANDRO SILVA Ten Cel Av'));
		echo $form->input('divisao_solicitante',array('class'=>'formulario','value'=>'Chefe da Divisão de Operações'));
		echo $form->end(array('label'=>'Imprimir fichas', 'class'=>'botoes'));
		?>
	</fieldset>
<?php ?>

</div>
<div id="filtro"
	style="border-color: #000000; padding: 0px; z-index: 2; border: 3px solid #000000; position: fixed; top: 10%; left: 5%; overflow: auto; height: auto; width: auto;"
	>
<?php
//echo $form->create('Necessidade', array('action'=>'externoadd','onsubmit'=>'submitForm(this,"externofiltro"); return false;','type'=>'file'));
echo $form->create('Necessidade', array('action'=>'externofiltro','onsubmit'=>'return false;','type'=>'file'));
?>	
<table cellspacing="0" cellpadding="0" id="filtro">
	<tbody>
		<tr>
			<td valign="center" align="center"><?php 
			$nome = '';
			$alfanumerico = '<option value=" AND ('.$nome.'CCC LIKE \\\'%XXX%\\\') ">E - CONTENHA</option>';
			$alfanumerico .= '<option value=" AND ('.$nome.'CCC NOT LIKE \\\'%XXX%\\\') ">E - NÃO CONTENHA</option>';
			$alfanumerico .= '<option value=" AND ('.$nome.'CCC LIKE \\\'XXX%\\\') ">E - COMECE COM</option>';
			$alfanumerico .= '<option value=" AND ('.$nome.'CCC  LIKE \\\'%XXX\\\') ">E - TERMINE COM</option>';
			$alfanumerico .= '<option value=" OR ('.$nome.'CCC LIKE \\\'%XXX%\\\') ">OU - CONTENHA</option>';
			$alfanumerico .= '<option value=" OR ('.$nome.'CCC NOT LIKE \\\'%XXX%\\\') ">OU - NÃO CONTENHA</option>';
			$alfanumerico .= '<option value=" OR ('.$nome.'CCC LIKE \\\'XXX%\\\' ">OU - COMECE COM</option>';
			$alfanumerico .= '<option value=" OR ('.$nome.'CCC LIKE \\\'%XXX\\\' ">OU - TERMINE COM</option>';
			
			$numerico = '<option value=" AND ('.$nome.'CCC=XXX) ">E - IGUAL A</option>';
			$numerico .= '<option value=" AND ('.$nome.'CCC<>XXX) ">E - DIFERENTE DE</option>';
			$numerico .= '<option value=" AND ('.$nome.'CCC>XXX) ">E - MAIOR QUE</option>';
			$numerico .= '<option value=" AND ('.$nome.'CCC<XXX) ">E - MENOR QUE</option>';
			$numerico .= '<option value=" OR ('.$nome.'CCC=XXX) ">OU - IGUAL A</option>';
			$numerico .= '<option value=" OR ('.$nome.'CCC<>XXX) ">OU - DIFERENTE DE</option>';
			$numerico .= '<option value=" OR ('.$nome.'CCC>XXX) ">OU - MAIOR QUE</option>';
			$numerico .= '<option value=" OR ('.$nome.'CCC<XXX) ">OU - MENOR QUE</option>';
			
			$data = '<option value=" AND ('.$nome.'CCC=\\\'XXX\\\') ">E - IGUAL A</option>';
			$data .= '<option value=" AND ('.$nome.'CCC<>\\\'XXX\\\') ">E - DIFERENTE DE</option>';
			$data .= '<option value=" AND ('.$nome.'CCC>\\\'XXX\\\') ">E - MAIOR QUE</option>';
			$data .= '<option value=" AND ('.$nome.'CCC<\\\'XXX\\\') ">E - MENOR QUE</option>';
			$data .= '<option value=" OR ('.$nome.'CCC=\\\'XXX\\\') ">OU - IGUAL A</option>';
			$data .= '<option value=" OR ('.$nome.'CCC<>\\\'XXX\\\') ">OU - DIFERENTE DE</option>';
			$data .= '<option value=" OR ('.$nome.'CCC>\\\'XXX\\\') ">OU - MAIOR QUE</option>';
			$data .= '<option value=" OR ('.$nome.'CCC<\\\'XXX\\\') ">OU - MENOR QUE</option>';
			
			$tipos = '';
			$conta = 0;
			$campo = '<option value=""></option>';
			
			$esquema = array('ano'=>array('type'=>'integer','valor'=>'Necessidade.ano'),'Classe'=>array('type'=>'string','valor'=>'Necessidade.classe'),'Curso'=>array('type'=>'string','valor'=>'Curso.codigo'),'Especialidade'=>array('type'=>'string','valor'=>'Especialidade.nm_especialidade'),'Necessidade'=>array('type'=>'integer','valor'=>'Necessidade.necessario'),'Quadro'=>array('type'=>'string','valor'=>'Quadro.sigla_quadro'),'Setor'=>array('type'=>'string','valor'=>'Setor.sigla_setor'),'Unidade'=>array('type'=>'string','valor'=>'Unidade.sigla_unidade'),'Divisão Solicitante'=>array('type'=>'string','valor'=>'Necessidade.divisao_solicitante'));
			//asort($esquema, SORT_STRING);
			foreach($esquema as $campos=>$vetor){
				$conta++;
				$campo .= '<option value="'.$vetor['valor'].'">'.$campos.'</option>'; 
				$tipos .= '<input type="hidden" id="tipo'.$conta.'" value="'.$vetor['type'].'" name="data[Tipo][]" />'; 
			}
			
			echo '<input type="hidden" id="find" value="'.$this->data['formFind']['find'].'" name="data[formFind][find]"/>';
			echo $tipos;
			
			?>
			<table cellspacing="0" cellpadding="0" id="filtro" width="100%">
				<tr>
					<th width="10%"><a href="#"
						onclick="javascript: $('filtro').hide();">X</a></th>
					<th width="90%" align="center" colspan="2"><?php __('Filtro(s) a ser(em) aplicado(s)');?></th>
				</tr>
				<tr>
					<td width="33%">Campo da Tabela</td>
					<td width="33%">Filtro</td>
					<td width="33%">Valor do Filtro</td>
				</tr>
				<?php for($qtd=1;$qtd<=8;$qtd++){ ?>
				<tr>
					<td width="33%"><select id="campo<?php echo $qtd; ?>"
						name="data[campo][]" class="formulario" onchange="preencheFiltro(<?php echo $qtd; ?>);">
						<?php echo $campo; ?>
					</select> </td>
					<td width="33%"><select id="filtro<?php echo $qtd; ?>"
						name="data[filtro][]" class="formulario">
						<option value="" selected="selected"></option>
					</select> </td>
					<td width="33%"><input type="text" id="valor<?php echo $qtd; ?>"
						value="" maxlength="20" class="formulario"
						name="data[valor][]" onchange="preencheSQL(<?php echo $qtd; ?>);" />
						<input type="hidden" id="sql<?php echo $qtd; ?>" value="" name="data[sql][]"/>
						</td>						
				</tr>
				<?php } ?>
				<tr>
					<td width="33%"></td>
					<td width="33%"><?php 
					echo '<center>'.$ajax->submit('APLICAR FILTRO', array('url'=> array('controller'=>'necessidades', 'action'=>'externofiltro'), 'update' => 'atuais', 'create' => '$("carregando").show();', 'success' => 'HideContent("carregando");', 'class'=>'botoes')).'</center>';
				
					echo $form->end();
					?></td>
					<td width="33%"></td>
				</tr>

			</table>
			</td>
		</tr>
	</tbody>
</table>
</div><br><br>
<?php 

/*
echo $form->create('Necessidade', array('action'=>'externofiltro','onsubmit'=>'submitForm(this,"externofiltro"); return false;','type'=>'file'));
echo '<div id="limiteDias" style="text-align:left;padding:0;vertical-align:top;border:0;background-color:#A0A0A0;">';

$estiloCaixas = 'padding:2px;vertical-align:middle;float:none;';
$estiloSelect = 'font-size:0.6em;padding:2px;vertical-align:middle;float:none;';
$estiloLabel = array('style'=>'padding:2px;vertical-align:middle;float:none;padding:0px;font-size:0.6em;');
$opcoes .= $form->label('Filtros','Filtros=>(',array('style'=>'padding:2px;vertical-align:middle;float:none;')).$form->select('opunidade',array(' AND '=>'E',' OR '=>'OU'),null,array('style'=>$estiloSelect)).$form->label('Unidade','Unidade',$estiloLabel).'|   ';
$opcoes .= $form->select('opsetor',array(' AND '=>'E',' OR '=>'OU'),null,array('style'=>$estiloSelect)).$form->label('Setor','setor',$estiloLabel).'|   ';
$opcoes .= $form->select('opquadro',array(' AND '=>'E',' OR '=>'OU'),null,array('style'=>$estiloSelect)).$form->label('Quadro','quadro',$estiloLabel).'|   ';
$opcoes .= $form->select('opespecialidade',array(' AND '=>'E',' OR '=>'OU'),null,array('style'=>$estiloSelect)).$form->label('Especialidade','especialidade',$estiloLabel).'|   ';
$opcoes .= $form->select('opcurso',array(' AND '=>'E',' OR '=>'OU'),null,array('style'=>$estiloSelect)).$form->label('Curso','curso',$estiloLabel).')';

echo $opcoes;

echo $form->end(array('label'=>'Filtrar','class'=>'botoes'));
echo $form->create('Necessidade', array('action'=>'externoadd','onsubmit'=>'submitForm(this,"externoadd"); return false;','type'=>'file'));
echo '</div>';
*/
echo $form->create('Necessidade', array('action'=>'externoadd','onsubmit'=>"return false;",'type'=>'file'));
?>
	<fieldset>
 		<legend><?php __('Cadastro de Necessidades')?><?php 		
	    $link = $this->webroot.'necessidades/externopdf/\'';
	    $caminho = $this->webroot.'necessidades/externopdf';
 		$imagem = $this->Html->image('print.gif', array('alt'=> __('PDF', true), 'border'=> '0', 'title'=>'Gerar PDF para impressão.', 'id'=>'pdf'));
 		$conteudo.='&nbsp;&nbsp;<a 	onclick="$(\'impressao\').show();">'.$imagem."</a></label>".'&nbsp;&nbsp;&nbsp;&nbsp;<img border="0" onclick="ShowContent(\'filtro\');"  title="Filtrar Dados" alt="Filtro" src="'.$this->webroot.'img/filtro.gif"/>';
 		echo $conteudo;
	?>
 		
 		&nbsp;&nbsp;&nbsp;
		<?php //
		//$link = 
		//echo $this->Html->link($this->Html->image('pdf2.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice','onmouseover'=>"$('link').href='".$this->webroot."militarscursoscorrigidos/externoPdf/'+$('MilitarscursoscorrigidoUnidadeId').value+'/'+$('MilitarscursoscorrigidoSetorId').value+'/'+$('MilitarscursoscorrigidoMilitarId').value;")), array('action'=>'externoPdf', null),array('id'=>'link', 'escape'=>false), null,false); ?>
 		</legend>
 		
 		
	<?php
	//echo ($u[0]['Usuario']['militar_id']==905);
	$unidades[0]='Selecione uma Unidade';
	$quadros[0]='Selecione um quadro';
	echo $form->input('ano',array('class'=>'formulario','options'=>$anos, 'default'=>2012));
		echo $form->input('quadro_id',array('class'=>'formulario','onchange'=>'javascript:tratamento(\'lista_especialidades\',\'NecessidadeQuadroId\',\'NecessidadeEspecialidadeId\');','options'=>$quadros, 'default'=>0));
		echo $form->input('especialidade_id',array('class'=>'formulario','readonly'=>'readonly','onchange'=>'javascript:tratamento(\'lista_unidades\',\'NecessidadeEspecialidadeId\',\'NecessidadeUnidadeId\');'));
//		echo $form->input('especialidade_id',array('class'=>'formulario','readonly'=>'readonly'));
		echo $form->input('unidade_id',array('class'=>'formulario','options'=>'', 'default'=>0));
//		echo $form->input('unidade_id',array('class'=>'formulario','onchange'=>'javascript:tratamento(\'lista_setores\',\'NecessidadeUnidadeId\',\'NecessidadeSetorId\');','options'=>$unidades, 'default'=>0));
		//echo $form->input('setor_id',array('class'=>'formulario','readonly'=>'readonly'));
		echo $this->Form->input('curso_id',array('class'=>'formulario','onchange'=>'javascript:tratamento(\'lista_cursos\',\'NecessidadeCursoId\',\'NecessidadeReferencia\');'));
		echo '<center>'.$ajax->submit('Listar militares com o curso na unidade', array('url'=> array('controller'=>'necessidades', 'action'=>'externoconsultas'), 'update' => 'existentes', 'create' => '$("carregando").show();', 'success' => 'HideContent("carregando");', 'class'=>'botoes')).'</center>';
		echo $ajax->div('existentes',array('style'=>"border-color: #000000; padding: 0px; z-index: 2; position: relative; height: auto; width: auto;"));
		echo $ajax->divEnd('existentes');
		//echo '<center>'.$ajax->submit('-----> LISTAR MILITARES QUE POSSUEM O CURSO CONFORME SETOR <-----', array('url'=> array('controller'=>'necessidades', 'action'=>'externomilitarscursos'), 'update' => 'militarescursos', 'class'=>'botoes')).'</center>';
		//echo '<center>'.$ajax->submit('--> LISTAR NECESSIDADES CADASTRADAS CONFORME CURSO E SETOR <--', array('url'=> array('controller'=>'necessidades', 'action'=>'externolistagem'), 'update' => 'militarescursos', 'class'=>'botoes')).'</center>';
		//echo $this->Form->input('necessario');
		for($i=1;$i<=70;$i++){
			$necessario[$i]=$i;
		}
		
		echo $this->Form->input('divisao_solicitante',array('class'=>'formulario','default'=>'DIVISÃO DE OPERAÇÕES >> '));
		echo $form->input('necessario',array('class'=>'formulario','options'=>$necessario, 'default'=>'1'));

		
		$classe['C']='COMPULSÓRIO';
		$classe['E']='ELEVAÇÃO DE NÍVEL';
		echo $this->Form->input('valor_diaria',array('class'=>'formulario'));
		echo $this->Form->input('valor_ajuda_custo',array('class'=>'formulario'));
		echo $this->Form->input('valor_passagem',array('class'=>'formulario'));
		echo $form->input('classe',array('class'=>'formulario','options'=>$classe, 'default'=>'C'));
		echo $this->Form->input('referencia',array('class'=>'formulario'));
		?>
	</fieldset>
<?php echo $form->end(array('label'=>'Registrar','onclick'=>"submitForm('externoadd');",'class'=>'botoes'));?>
</div>
<div class="actions">
	<ul>
		</ul>
</div>
<?php

	echo $ajax->div('militarescursos',array('style'=>"border-color: #000000; padding: 0px; z-index: 2; position: fixed; top: 10%; left: 5%; overflow: auto; height: auto; width: auto;"));
	echo $ajax->divEnd('militarescursos');

	echo $ajax->div('carregando',array('style'=>"border-color: #000000;background-color: #fff; padding: 0px; z-index: 100; position: fixed; top: 50%; left: 50%;  overflow: auto;line-height: 1px; position: absolute; margin-top: -98px; margin-left: -98px;"));
	echo $this->Html->image('ajax-loader.gif', array('alt'=> __('PDF', true),   'title'=>'Gerar PDF para impressão.', 'id'=>'pdf'));	
	echo $ajax->divEnd('carregando');

	$raiz = $this->webroot;

$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[

function select_innerHTML(objetoId,innerHTML){
/******
* select_innerHTML - corrige o bug do InnerHTML em selects no IE
* Veja o problema em: http://support.microsoft.com/default.aspx?scid=kb;en-us;276228
* Versão: 2.1 - 04/09/2007
* Autor: Micox - Náiron José C. Guimarães - micoxjcg@yahoo.com.br
* @objeto(tipo HTMLobject): o select a ser alterado
* @innerHTML(tipo string): o novo valor do innerHTML
*******/
	objeto = $(objetoId);
    objeto.innerHTML = ""
    var selTemp = document.createElement("micoxselect")
    var opt;
    selTemp.id="micoxselect1"
    document.body.appendChild(selTemp)
    selTemp = document.getElementById("micoxselect1")
    selTemp.style.display="none"
    if(innerHTML.toLowerCase().indexOf("<option")<0){//se não é option eu converto
        innerHTML = "<option>" + innerHTML + "</option>"
    }
    //innerHTML = innerHTML.toLowerCase().replace(/<option/g,"<span").replace(/<\/option/g,"</span")
    innerHTML = innerHTML.replace(/<option/g,"<span").replace(/<\/option/g,"</span")
    selTemp.innerHTML = innerHTML
      
    
    for(var i=0;i<selTemp.childNodes.length;i++){
  var spantemp = selTemp.childNodes[i];
  
        if(spantemp.tagName){     
            opt = document.createElement("OPTION")
    
   if(document.all){ //IE
    objeto.add(opt)
   }else{
    objeto.appendChild(opt)
   }       
    
   //getting attributes
   for(var j=0; j<spantemp.attributes.length ; j++){
    var attrName = spantemp.attributes[j].nodeName;
    var attrVal = spantemp.attributes[j].nodeValue;
    if(attrVal){
     try{
      opt.setAttribute(attrName,attrVal);
      opt.setAttributeNode(spantemp.attributes[j].cloneNode(true));
     }catch(e){}
    }
   }
   //getting styles
   if(spantemp.style){
    for(var y in spantemp.style){
     try{opt.style[y] = spantemp.style[y];}catch(e){}
    }
   }
   //value and text
   opt.value = spantemp.getAttribute("value")
   opt.text = spantemp.innerHTML
   //IE
   opt.selected = spantemp.getAttribute('selected');
   opt.className = spantemp.className;
  } 
 }    
 document.body.removeChild(selTemp)
 selTemp = null
}

function limpaSelect(nomeSelect) {
	var conteudo = '<option selected="selected" value=""></option>'
	var filtro = nomeSelect;
	select_innerHTML(filtro,conteudo);
}
    
	
function carregando(){
	ShowContent('carregando');
}	

function sucesso(){
	HideContent('carregando');
}	

		//]]>

</script>
SCRIPT;
echo $jscript;

	
$observaUnidade=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[

function confirma(id){

var sn=confirm("Confirma ação ?");
 if(sn){
var dados = Form.serialize($('NecessidadeExternoaddForm'));
 new Ajax.Request('{$this->webroot}necessidades/externoconfirma/'+id, {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			
			 if (resultado.ok==0){
			    alert(resultado.mensagem);
			    $(id).checked = false;
				$(id).show();
			}else{
				alert(resultado.mensagem);
				$(id).hide();
			}
		}
				})
    }
    
}

function trataUnidade(campomodificado, acao, id1, campoformulario){
	new Ajax.Updater(campomodificado,'{$raiz}militarscursoscorrigidos/externoupdatesetor/'+acao+'/'+id1, {asynchronous:false, evalScripts:false, parameters:Form.Element.serialize(campoformulario), requestHeaders:['X-Update', campomodificado]})
	new Ajax.Updater('MilitarscursoscorrigidoMilitarId','{$raiz}militarscursoscorrigidos/externoupdate/setor/0', {asynchronous:false, evalScripts:false, parameters:Form.Element.serialize('MilitarscursoscorrigidoSetorId'), requestHeaders:['X-Update', 'MilitarscursoscorrigidoMilitarId']})
}


function tratamento(acao, campoformulario, campomodificado){
var id1 = $('NecessidadeQuadroId').value;
var id2 = $('NecessidadeUnidadeId').value;
var id3 = $('NecessidadeEspecialidadeId').value;
var id4 = $('NecessidadeCursoId').value;

if(acao=='lista_especialidades'){
	limpaSelect('NecessidadeEspecialidadeId');
	new Ajax.Updater(campomodificado,'{$raiz}necessidades/externoupdateespecialidade/'+id1, {asynchronous:false, evalScripts:false, parameters:Form.Element.serialize(campoformulario), requestHeaders:['X-Update', campomodificado]})
}
if(acao=='lista_setores'){
	limpaSelect('NecessidadeSetorId');
	new Ajax.Updater(campomodificado,'{$raiz}necessidades/externoupdatesetor/'+id2, {asynchronous:true, evalScripts:true, parameters:Form.Element.serialize(campoformulario), requestHeaders:['X-Update', campomodificado]})
}
        
if(acao=='lista_unidades'){
	limpaSelect('NecessidadeUnidadeId');
	new Ajax.Updater(campomodificado,'{$raiz}necessidades/externoupdateunidade/'+id3, {asynchronous:true, evalScripts:true, parameters:Form.Element.serialize(campoformulario), requestHeaders:['X-Update', campomodificado]})
}
if(acao=='lista_cursos'){
	new Ajax.Updater(campomodificado,'{$raiz}necessidades/externoupdatecurso/'+id4, {asynchronous:false, evalScripts:false, parameters:Form.Element.serialize(campoformulario), requestHeaders:['X-Update', campomodificado]})
}

}
//]]>
</script>
SCRIPT;
echo $observaUnidade;


$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
function retorno(){
	var c = $('MilitarscursoscorrigidoMilitarId');
//	c.options[0].selected = true;	
 
}
function submitForm(direcao) {
var dados = Form.serialize($('NecessidadeExternoaddForm'));
new Ajax.Request('{$this->webroot}necessidades/externoadd', {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);

			$('atuais').innerHTML = resultado.registros;
			if(resultado.ok=1){
				$('alertaSistema').innerHTML = resultado.mensagem;
			}else{
				$('alertaSistema').innerHTML = resultado.mensagem;
			}
			ShowContent('mensagem');

			//$('atuais').innerHTML = transport.responseText;
			ShowContent('atuais');
		}
				})
        
		//retorno();
        
        return false;
    }
    
function excluiRegistro(id) {
/*
usa método request() da classe Form da prototype, que serializa os campos
do formulário e submete (por POST como default) para a action especificada no form
*/
var dados = Form.serialize($('NecessidadeExternofiltroForm'));

new Ajax.Request('{$this->webroot}necessidades/delete/'+id, {
			method: 'get',
			postBody: dados,
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			$('atuais').innerHTML = resultado.registros;
                        if(resultado.ok=1){
                            $('alertaSistema').innerHTML = "<p>Registro excluído!</p>";
                        }else{
                            $('alertaSistema').innerHTML = "<p>Registro não excluído!</p>";
                        }
		 	ShowContent('mensagem');

					
		}
				})
        
		//retorno();
				
    }

function setor() {
var id3 = $('MilitarscursoscorrigidoSetorId').value;


new Ajax.Request('{$this->webroot}militarscursoscorrigidos/externoverso/setor/'+id3, {
			method: 'get',
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			
			 if (resultado.ok==0){
				//alert('Registro não excluído!');
			}else{
				//alert('Registro excluído!');
				$('dados').innerHTML = resultado.mensagem;
				$('atuais').innerHTML = resultado.atual;
							
			}
		}
				})
        
}
    
function militar() {
var id2 = $('MilitarscursoscorrigidoMilitarId').value;
var id3 = $('MilitarscursoscorrigidoSetorId').value;


new Ajax.Request('{$this->webroot}militarscursoscorrigidos/externoverso/militar/'+id2+'/'+id3, {
			method: 'get',
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			
			 if (resultado.ok==0){
				//alert('Registro não excluído!');
			}else{
				//alert('Registro excluído!');
				$('dados').innerHTML = resultado.mensagem;
				$('atuais').innerHTML = resultado.atual;
							
			}
		}
				})
				
    }    
    
		//]]>

</script>
<div id="atuais"></div>

<div id="dados"></div>
SCRIPT;
echo $jscript;



		
?>

<?php
$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
 $('filtro').hide();
 
 
 Event.observe('btfechar','click',function(event){
    $('mouseY2').value = $('mouseY1').value;
    $('mouseX2').value = $('mouseX1').value;
 	$('login').hide();
     });
 
function preencheFiltro(ordem) {
	var numero = '$numerico';
	var literal = '$alfanumerico';
	var data = '$data';
	var nome = 'campo'+ordem;
	var valorSelect = $(nome).value;
	var indice = $(nome).options.selectedIndex;
	var filtro = 'filtro'+ordem;
	var valor = 'valor'+ordem;
	$(valor).value = '';
	var sql = 'sql'+ordem;
	$(sql).value = '';
	select_innerHTML(filtro,'');
	
	if(indice>0){
	var nometipo = 'tipo'+indice;
	var tipo = $(nometipo).value;
	
	if((tipo=='string')||(tipo=='text')){
		select_innerHTML(filtro,literal);
		
	}
	if((tipo=='integer')||(tipo=='float')||(tipo=='money')){
		select_innerHTML(filtro,numero);
	}
	if((tipo=='date')||(tipo=='datetime')||(tipo=='time')){
		select_innerHTML(filtro,data);
	}
	
	}
	
    }
    
function preencheSQL(ordem) {
	var nome = 'campo'+ordem;
	var valorCampo = $(nome).value;
	var indice = $(nome).options.selectedIndex;
	var filtro = 'filtro'+ordem;
	var valorFiltro = $(filtro).value;
	
	var sql = 'sql'+ordem;
	$(sql).value = '';
	var valor = 'valor'+ordem;
	var valorValor = $(valor).value;
	
	valorFiltro = valorFiltro.gsub('CCC',valorCampo);
	valorFiltro = valorFiltro.gsub('XXX',valorValor);
	
	$(sql).value = encodeURIComponent(valorFiltro);
	
	
	}
	
function sql() {
	$('find').value = ' 1=1';

  for(i=1;i<=5;i++){
	var nome = 'campo'+i;
	var valorCampo = $(nome).value;

	var filtro = 'filtro'+i;
	var valorFiltro = $(filtro).value;
	
	var sql = 'sql'+i;
	var valorsql = $(sql).value;
	
	if((valorCampo!=null)&&(valorFiltro!=null)&&(valorsql!=null)){
		$('find').value = $('find').value + valorsql;
	
	}
		
	
	
	}
	
	}
     
 
</script>
SCRIPT;

echo $jscript;
?>
<script type="text/javascript">
<!--
new Draggable('filtro');
new Draggable('militarescursos');
//-->
</script>

<div id="login"
	style="border-color: rgb(0, 0, 0); padding: 0px; z-index: 0; border: 3px solid #000000; position: absolute; top: 10%; left: 5%; height: auto; width: auto;">
						<?php echo $form->create('Necessidade', array('action'=>'externoupdate','onsubmit'=>'atualizaForm(this); return false;','type'=>'file'));?>
<table cellspacing="0" cellpadding="0" id="login">
	<tbody>
		<tr>
			<td valign="center" align="center">
			<table cellspacing="0" cellpadding="0" id="login" width="100%">
				<tr>
					<th width="10%" colspan="2"><a href="javascript:HideContent('login');" id="btfechar">X</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php __('Modificar dados de necessidades de cursos');?></th>
				</tr>
				<?php
					$titulo = '30%';
					$campo = '80%';
				?>
				<tr>
					<td width="<?php echo $titulo; ?>">Ano:</td>
					<td width="<?php echo $campo; ?>"><input
						type="text" readonly="readonly" id="NecessidadeAnual" value=""
						size="50" class="formulario"
						name="data[Necessidade][ano]" /></td>
				</tr>
				<tr>
					<td width="<?php echo $titulo; ?>">Quadro:</td>
					<td width="<?php echo $campo; ?>"><input
						type="text" readonly="readonly" id="NecessidadeQuadro" value=""
						size="50" class="formulario"
						name="data[Necessidade][Quadro]" /><input
						type="hidden" <?php echo $leitura;  ?> id="NecessidadeId" value=""
						name="data[Necessidade][id]" /></td>
				</tr>
				<tr>
					<td width="<?php echo $titulo; ?>">Especialidade:</td>
					<td width="<?php echo $campo; ?>"><input
						type="text" readonly="readonly" id="NecessidadeEspecialidade" value=""
						size="50" class="formulario"
						name="data[Necessidade][Especialidade]" /></td>
				</tr>
				<tr>
					<td width="<?php echo $titulo; ?>">Unidade:</td>
					<td width="<?php echo $campo; ?>"><input
						type="text" readonly="readonly" id="NecessidadeUnidade" value=""
						size="50" class="formulario"
						name="data[Necessidade][Unidade]" /></td>
				</tr>
				<tr>
					<td width="<?php echo $titulo; ?>">Setor:</td>
					<td width="<?php echo $campo; ?>"><input
						type="text" readonly="readonly" id="NecessidadeSetor" value=""
						size="50" class="formulario"
						name="data[Necessidade][Setor]" /></td>
				</tr>
				<tr>
					<td width="<?php echo $titulo; ?>">Curso:</td>
					<td width="<?php echo $campo; ?>"><input
						type="text" readonly="readonly" id="NecessidadeCurso" value=""
						size="30" class="formulario"
						name="data[Necessidade][Curso]" /></td>
				</tr>
				<tr>
					<td width="<?php echo $titulo; ?>" style="background-color:#EBF09E;">Necessário:</td>
					<td width="<?php echo $campo; ?>" style="background-color:#EBF09E;"><input
						type="text" id="NecessidadeNecessidade" value=""
						size="30" class="formulario"
						name="data[Necessidade][Necessario]" /></td>
				</tr>
				<tr>
					<td width="<?php echo $titulo; ?>" style="background-color:#EBF09E;">Valor Diária:</td>
					<td width="<?php echo $campo; ?>" style="background-color:#EBF09E;"><input
						type="text" id="NecessidadeValor_Diaria" value=""
						size="30" class="formulario"
						name="data[Necessidade][ValorDiaria]" /></td>
				</tr>
				<tr>
					<td width="<?php echo $titulo; ?>" style="background-color:#EBF09E;">Valor Ajuda Custo:</td>
					<td width="<?php echo $campo; ?>" style="background-color:#EBF09E;"><input
						type="text" id="NecessidadeValor_Ajuda_Custo" value=""
						size="30" class="formulario"
						name="data[Necessidade][ValorAjudaCusto]" /></td>
				</tr>
				<tr>
					<td width="<?php echo $titulo; ?>" style="background-color:#EBF09E;">Valor Passagem:</td>
					<td width="<?php echo $campo; ?>" style="background-color:#EBF09E;"><input
						type="text" id="NecessidadeValor_Passagem" value=""
						size="30" class="formulario"
						name="data[Necessidade][ValorPassagem]" /></td>
				</tr>
				<tr>
					<td width="<?php echo $titulo; ?>" style="background-color:#EBF09E;">Divisão Solicitante:</td>
					<td width="<?php echo $campo; ?>" style="background-color:#EBF09E;"><input
						type="text" id="NecessidadeDivisao_Solicitante" value=""
						size="30" class="formulario"
						name="data[Necessidade][DivisaoSolicitante]" /></td>
				</tr>
				<tr>
					<td width="<?php echo $titulo; ?>">Classe:</td>
					<td width="<?php echo $campo; ?>"><input
						type="text" <?php echo $leitura;  ?> id="NecessidadeCategoria" value=""
						size="50" class="formulario"
						name="data[Necessidade][Classe]" /></td>
				</tr>
				<tr>
					<td width="<?php echo $titulo; ?>" style="background-color:#EBF09E;">Referência:</td>
					<td width="<?php echo $campo; ?>" style="background-color:#EBF09E;"><textarea <?php echo $leitura;  ?> id="NecessidadeRef" value=""
						cols="40" rows="3" class="formulario"
						name="data[Necessidade][Referencia]" /></textarea></td>
				</tr>
				<tr>
					<td colspan="3" width="33%"><?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
					</td>
				</tr>

			</table>
			</td>
		</tr>
	</tbody>
</table>
</div>
	
<script type="text/javascript">
<!--
new Draggable('login');
//-->
</script>
	<?php
	$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[

HideContent('login');
HideContent('carregando');
HideContent('militarescursos');
HideContent('impressao');

function atualizaForm(form) {
	/*
	usa método request() da classe Form da prototype, que serializa os campos
	do formulário e submete (por POST como default) para a action especificada no form
	*/
  var dados = Form.serialize(form);
	new Ajax.Request('{$this->webroot}necessidades/externosave', {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			$('atuais').innerHTML=resultado.registros;
    		 if (resultado.ok==0){
			 	$('alertaSistema').innerHTML = "<p>Registro não atualizado!</p>";
			 	ShowContent('mensagem');
			}else{
			 	$('alertaSistema').innerHTML = "<p>Registro atualizado!</p>";
			 	ShowContent('mensagem');
    		 	HideContent('login');
					}
				}})
        
        
        return false;
    }
		


 
 function exibe(id, ano, quadro, especialidade, unidade, setor, curso, necessario, classe, referencia, valor_diaria, valor_passagem, divisao_solicitante, valor_ajuda_custo) {

	$('NecessidadeId').value = id;
	$('NecessidadeAnual').value = ano;
	$('NecessidadeQuadro').value = decodeURIComponent(quadro);
	$('NecessidadeEspecialidade').value = decodeURIComponent(especialidade);
	$('NecessidadeUnidade').value = decodeURIComponent(unidade);
	$('NecessidadeSetor').value = decodeURIComponent(setor);
	$('NecessidadeCurso').value = decodeURIComponent(curso);
	$('NecessidadeValor_Diaria').value = decodeURIComponent(valor_diaria);
	$('NecessidadeValor_Ajuda_Custo').value = decodeURIComponent(valor_ajuda_custo);
	$('NecessidadeValor_Passagem').value = decodeURIComponent(valor_passagem);
	$('NecessidadeDivisao_Solicitante').value = decodeURIComponent(divisao_solicitante);
	$('NecessidadeNecessidade').value = decodeURIComponent(necessario);
	$('NecessidadeCategoria').value = decodeURIComponent(classe);
	$('NecessidadeRef').value = decodeURIComponent(referencia);
	ShowContent('login');
 }
 
 //]]>
 </script>
 
SCRIPT;


echo $jscript;

?>
</center>