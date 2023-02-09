<style>
<!--
.tooltiptstyle{
 background-color:#333;
 padding: 1px 3px;
 color: #fff;
 font-size:9px;
position: absolute;
}

-->
</style>
<div class="afastamentos index">
<h1><?php __('Consulta de calendário individual por escala');?>
<?php
$setores = explode(',',$u[0][0]['setores']);
//print_r($setores);
//print_r($u[0]['Usuario']);
//print_r($afastamentos);

?>
&nbsp;<?php //echo $this->Html->link($this->Html->image('cadeado_aberto.gif', array('alt'=> __('PADRONIZAR AFASTAMENTOS', true), 'border'=> '0', 'title'=>'PADRONIZAR AFASTAMENTOS')), array('action'=>'edit', null),array('escape'=>false, 'escape'=>false), null,false); ?>
</h1>
<?php
//print_r($escalas);
//echo $form->end(array('label'=>'Imprimir relação','class'=>'botoes'));


echo $form->create('Escala', array('action'=>'externofiltro','onsubmit'=>'javascript:pdf();return false;','type'=>'file'));
echo $form->select('escala', $escalas ,null,array('onChange'=>'javascript:listameses(\'EscalaEscala\',\'EscalaAno\');','class'=>'formulario'), false);
echo $form->select('ano', $escalasmonth ,null ,array('onChange'=>'javascript:listamilitares(\'EscalaAno\',\'EscalaMilitar\');','class'=>'formulario'), false);
echo $form->select('militar', $escalasmonth ,null ,array('onChange'=>'','class'=>'formulario'), false).'<input type="submit" value="gerarPdf" class="botoes">';

?>

<script language="javascript">
function ExibeDica(mensagem){

	$('alertaSistemaTitulo').setStyle('tooltiptstyle');
	$('alertaSistemaTitulo').setStyle({
		backgroundColor: '#90a000',
		fontSize: '12px',
		width: '20%'
		});
	$('mensagem').setStyle('tooltipstyle');
	$('mensagem').setStyle({
		backgroundColor: '#90a000',
		fontSize: '12px',
		width: '20%'
		});
 	$('alertaSistemaTitulo').innerHTML = 'Responsável pelo cadastro';
 	$('alertaSistema').innerHTML = mensagem;
	ShowContent('mensagem');
	
}
function EscondeDica(){
	HideContent('mensagem');
}
</script>
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
	limpaSelect('EscalaMilitar');
	new Ajax.Updater(campomodificado,'{$raiz}escalas/externoupdateano/'+id1, {asynchronous:false, evalScripts:false, parameters:Form.Element.serialize(campoformulario), requestHeaders:['X-Update', campomodificado]})

}
function listamilitares(campoformulario, campomodificado){
	var id1 = $('EscalaAno').value;
	limpaSelect('EscalaMilitar');
	new Ajax.Updater(campomodificado,'{$raiz}escalas/externoupdatemilitar/'+id1, {asynchronous:false, evalScripts:false, parameters:Form.Element.serialize(campoformulario), requestHeaders:['X-Update', campomodificado]})

}

function pdf() {
var escalasmonth = $('EscalaAno').value;
var militar = $('EscalaMilitar').value;

window.open('{$this->webroot}escalas/externopdfcalendario/'+escalasmonth+'/'+militar);
        
}


    
		//]]>

</script>
SCRIPT;
echo $jscript;


?>