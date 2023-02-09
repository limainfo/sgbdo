

<?php echo $form->create('Paeatsindicado', array('action'=>'externoconsulta','onsubmit'=>'return false;','type'=>'file'));?>
<table cellspacing="0" cellpadding="0" id="login">
	<tbody>
		<tr>
			<td valign="middle" align="center">
			<table cellspacing="0" cellpadding="0" id="login" width="100%">
				<tr>
					<th width="10%" colspan="2"><p id="campoinclusao" style="padding:0px;height:20px;background-color: #a0abbc; color: #fff; margin: 0px; vertical-align: top;text-align:center; border: 2px; border-color: #000;">CONSULTA INDICAÇÃO</p>
                        					<select class="formulario"	id="PaeatAno"	name="ano" />
						<?php
                                                $anoInicial = 2011;
                                                $anoFinal = date('Y');
						for(;$anoInicial<=$anoFinal; $anoInicial++){
							echo '<option value="'.$anoInicial.'">'.$anoInicial.'</option>';
						} 
					
					?></select>
</th>
				</tr>
				<?php
					$titulo = '10%';
					$campo = '90%';
				?>
				<tr>
					<td width="<?php echo $titulo; ?>">Nome ou Curso:<input type="hidden" id="opcao" name="data[Paeatsindicado][opcao]">
					</td>
					<td width="<?php echo $campo; ?>"><input 
						type="text"   value=""
						size="25" class="formulario"
						id="PaeatNome"
						name="data[Paeatsindicado][nome]" />
                                        
                                        <?php echo '<input type="submit" value="Busca" class="botoes" onclick="if(verificaNome()){$(\'opcao\').value=\'nome\';cursosrealizados();}">';?></td>
				</tr>
				<tr>
					<td width="<?php echo $titulo; ?>">Unidade:</td>
					<td width="<?php echo $campo; ?>">
					<select 
						class="formulario"
						id="PaeatNome"
						name="data[Paeatsindicado][unidade]" />
						<?php
						foreach($unidades as $unidade){
							echo '<option value="'.$unidade['unidades']['id'].'">'.$unidade['unidades']['sigla_unidade'].'</option>';
						} 
					
					?></select>
					<?php echo '<input type="submit" value="Busca" class="botoes" onclick="{$(\'opcao\').value=\'unidade\';cursosrealizados();}">';?></td>
				</tr>
				<tr>
					<td width="<?php echo $titulo; ?>"></form>Escala:</td>
					<td width="<?php echo $campo; ?>">
				<?php 
echo $form->create('Escala', array('action'=>'externopaeat','onsubmit'=>'return false;','type'=>'file'));
echo $form->select('escala', $escalas ,null,array('onChange'=>'javascript:listameses(\'EscalaEscala\',\'EscalaAno\');','class'=>'formulario'), false);
echo $form->select('ano', $escalasmonth ,null ,array('class'=>'formulario'), false);
?>
<?php
echo '<input type="submit" value="Busca" onClick="$(\'opcao\').value=\'escala\';cursosrealizados();" class="botoes">';

?></td>
				</tr>
				
				<tr>
					<td width="<?php echo $titulo; ?>">Indicações:</td>
					<td width="<?php echo $campo; ?>">
					<div id='cursos'>
					</div>
					</td>
				</tr>
				<tr>
					<td  colspan="2">
					<div id="paeatobjetivo">
					</div>
					</td>
				</tr>

			</table>
			</td>
		</tr>
	</tbody>
</table>
<script type="text/javascript">
//<!--
new Draggable('inclusao');
$('inclusao').hide();
//-->
</script>


<div style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 20%; border: 2px solid rgb(0, 0, 0); z-index: 1010" id="mensagemtela">
<p  style="padding:0px;height:20px;background-color: #800000; color: #fff; margin: 0px; vertical-align: top;text-align:center; border: 2px; border-color: #000;">MENSAGEM DO SISTEMA<a href="javascript:HideContent('mensagemtela');"  style="float:right;background-color:#ffffff;" id="msgfechar">X</a></p>
<div id='mensagemerro'>
</div>
<script type="text/javascript">
<!--
new Draggable('mensagemtela');
//-->
</script>
</div>


<script type="text/javascript">
HideContent('mensagemtela');
</script>



</div>
	<?php
	$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[

function verificaNome(){
  var conteudo=$('PaeatNome').value;
  var dados=conteudo.toArray();
  var tamanho=dados.size();
  if(tamanho<4){
    $('mensagemerro').innerHTML = '<p	style="margin: 0px; background-color: #ffffff; border: 1px solid #000;"><br>A busca deve possuir no mínimo 4 caracteres!<br><br></p>';
  	ShowContent('mensagemtela');
  	return false;
  }else{
  	return true;
  }
  
}


function cursosrealizados() {
	var dados = Form.serialize($('PaeatsindicadoExternoconsultaForm'));
	new Ajax.Request('{$this->webroot}paeatsindicados/externocursosrealizados', {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {
			var resultado = transport.responseText.evalJSON(true);
			
    		 if (resultado.ok==0){
			 	$(id).innerHTML = "<p>Registro não atualizado!</p>";
			}else{
			 	$('cursos').innerHTML = unescape(resultado.mensagem);
					}
				}})
        
    
    return false;
}

function cursosrealizadosescala() {
	var dados = Form.serialize($('EscalaExternopaeatForm'));
	new Ajax.Request('{$this->webroot}paeatsindicados/externocursosrealizados', {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {
			var resultado = transport.responseText.evalJSON(true);
			
    		 if (resultado.ok==0){
			 	$(id).innerHTML = "<p>Registro não atualizado!</p>";
			}else{
			 	$('cursos').innerHTML = unescape(resultado.mensagem);
					}
				}})
        
    
    return false;
}

 //]]>
</script>
 
SCRIPT;


echo $jscript;

?>
<?php 

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
    

  
function listameses(campoformulario, campomodificado){
	var id1 = $('EscalaEscala').value;
	limpaSelect('EscalaAno');
	new Ajax.Updater(campomodificado,'{$raiz}escalas/externoupdateano/'+id1, {asynchronous:false, evalScripts:false, parameters:Form.Element.serialize(campoformulario), requestHeaders:['X-Update', campomodificado]})

}
function listamilitares(campoformulario, campomodificado){
	var id1 = $('EscalaAno').value;
	limpaSelect('EscalaMilitar');
	new Ajax.Updater(campomodificado,'{$raiz}escalas/externoupdatemilitar/'+id1, {asynchronous:false, evalScripts:false, parameters:Form.Element.serialize(campoformulario), requestHeaders:['X-Update', campomodificado]})

}



    
		//]]>

</script>
SCRIPT;
echo $jscript;


?>
