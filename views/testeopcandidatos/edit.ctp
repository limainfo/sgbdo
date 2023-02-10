<?php 	
	$compara = $u[0]['Usuario']['privilegio_id'];
	if(($compara==1)||($compara==4)){
?>
	<fieldset>
 		<legend><?php __('Atribuir Provas');?>
&nbsp;&nbsp;&nbsp;&nbsp;
</legend>

<?php
echo $form->create('Testeopcandidato', array('action'=>'externoatribui','onsubmit'=>'submitForm(this); return false;','type'=>'file'));

$previsao = array('PREVISTA'=>'PREVISTA','CUMPRIDA'=>'CUMPRIDA');
$tipoescala = array('OPERACIONAL'=>'OPERACIONAL','RISAER'=>'RISAER');
$assinatura = array('TODOS'=>'TODOS','SIM'=>'ASSINOU','NAO'=>'NÃO ASSINOU');

if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)){
	
	echo $form->input('testeopprovasagendada_id',array('class'=>'formulario','label'=>'Ano-Divisão-Subdivisão-Prova'));
	echo $form->input('especialidade_id',array('class'=>'formulario', 'onChange'=>'javascript:listamilitares();'));
	echo '<center>'.$ajax->submit('Listar candidatos baseado na especialidade', array('id'=>'listardados','url'=> array('controller'=>'Testeopcandidatos', 'action'=>'externoconsulta'), 'update' => 'listagem', 'create' => '$("carregando").show();', 'success' => 'HideContent("carregando");', 'class'=>'botoes')).'</center>';
}
$id_usuario = $u[0]['Usuario']['militar_id'];

?>
 		
 		
<div class="militars form" id="formularios">
</div>

<div class="actions">
	<ul>
		</ul>
</div>
<div id="carregando" >
    <?php echo $this->Html->image('spinner.gif'); ?>
</div> 

<?php
	echo $ajax->div('listagem');
?>
<?php  
	echo $ajax->divEnd('listagem');
	
echo $form->end();
	
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

function preencheSelect(nomeSelect) {
	var conteudo = '<option selected="selected" value=""></option>'
	var filtro = nomeSelect;
	select_innerHTML(filtro,conteudo);
}
    







function listamilitares(){
	new Ajax.Updater('TesteopcandidatoMilitarId','{$this->webroot}testeopcandidatos/externomilitares', {asynchronous:false, evalScripts:false, parameters:Form.Element.serialize('TesteopcandidatoEspecialidadeId'), requestHeaders:['X-Update', 'TesteopcandidatoMilitarId']})
}	


function listasetores(){
	new Ajax.Updater('TesteopcandidatoSetorId','{$this->webroot}testeopcandidatos/externosetores', {asynchronous:false, evalScripts:false, parameters:Form.Element.serialize('TesteopcandidatoUnidadeId'), requestHeaders:['X-Update', 'TesteopcandidatoSetorId']})
}	




		HideContent('carregando');
		
//]]>	
	
	    
		//]]>		
</script>
SCRIPT;
echo $jscript;

	


?>
<script>
ShowContent('formularios');


Event.observe('TesteopcandidatoTesteopprovasagendadaId', 'change', function(event) { 
	new Ajax.Request('<?php echo $this->webroot;?>testeopcandidatos/externoespecialidadeid/', {
				method: 'post',
				postBody: Form.serialize($('TesteopcandidatoExternoatribuiForm')),
				onSuccess: function(transport) {
	
				var resultado = transport.responseText.evalJSON(true);
				
				 
				var c = $('TesteopcandidatoEspecialidadeId'), i=0;
				for (; i<c.options.length; i++){
				if (c.options[i].value == resultado.especialidadeid){
				c.options[i].selected = true;}}
				listamilitares();
			}
					})
}, false);

</script>

<?php 
	}else{
		
		echo '<center><h1><a href="../usuarios/logout">ACESSO NÃO AUTORIZADO!</a></h1></center>';
	}
?>