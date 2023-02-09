<style>
<!--
.tooltiptstyle{
    background-color:#333;
    padding: 1px 3px;
    color: #fff;
    font-size:9px;
    position: absolute;
}
#wrapper label {
width: 190px;
}
.botoes {
    height: 30px;
    padding: 0 0 0;
}
select {
	font-size:12px;
}
input.formulario {
	font-size: 12px;
}
div#mensagem{
 width: 40%;
}
-->
</style>
<script>
 $('mensagem').setStyle({width:"auto"});
</script>
<div class="afastamentos index">

<?php


echo $form->create('Escala', array('action' => 'externoBoletim', 'onsubmit' => 'javascript:return false;', 'type' => 'file'));
echo '<fieldset><legend>Cadastrar/Modificar Legendas&nbsp;&nbsp;&nbsp;</legend><hr>';
echo '<label for="Consultanomes">Ano:</label>';
echo $form->select('ano', $escalasmonth, null, array('onChange' => 'javascript:listaescalas(\'EscalaAno\',\'EscalaEscala\');', 'class' => 'formulario', 'style' => 'vertical-align:top;'), false);
echo '<br><label for="Consultanomes">Escala:</label>';
echo $form->select('escala', null, null, array('onChange' => 'javascript:listadadosescala(\'EscalaExternoBoletimForm\',\'EscalaEscala\');', 'class' => 'formulario'), false);

echo '<br><hr><label for="Consultanomes">Carga de Trabalho Base:</label>';
echo '<input type="text" name="data[Escalasmonth][carga_base]" size="5" id="EscalasmonthCargaBase" width="10%" onchange="mudacarga(\'base\');">';
echo "<div id='EscalasmonthCargaBase01' style='float: left;position: relative;'>".$this->Html->image('spinner.gif',array('width'=>'15px','height'=>'15px'))."</div>";
echo '<br><label for="Consultanomes">Carga de Trabalho Máxima:</label>';
echo '<input type="text" name="data[Escalasmonth][carga_maxima]"  size="5" id="EscalasmonthCargaMaxima" width="10%" onchange="mudacarga(\'maxima\');">';
echo "<div id='EscalasmonthCargaMaxima01' style='float: left;position: relative;'>".$this->Html->image('spinner.gif',array('width'=>'15px','height'=>'15px'))."</div>";
echo '<br><hr><label for="Consultanomes">Escalante Prevista:</label>';

echo $form->select('escalanteprevista', null, null, array('onChange' => 'javascript:mudanome(\'EscalaAno\',\'EscalaEscalanteprevista\');', 'class' => 'formulario'), false)."<div id='EscalaEscalanteprevista01' style='float: left;position: relative;'>".$this->Html->image('spinner.gif',array('width'=>'15px','height'=>'15px'))."</div>";
echo '<br><label for="Consultanomes">Aprova Escala Prevista:</label>';
echo $form->select('aprovaescalaprevista', null, null, array('onChange' => 'javascript:mudanome(\'EscalaAno\',\'EscalaAprovaescalaprevista\');', 'class' => 'formulario'), false)."<div id='EscalaAprovaescalaprevista01' style='float: left;position: relative;'>".$this->Html->image('spinner.gif',array('width'=>'15px','height'=>'15px'))."</div>";
echo '<br><label for="Consultanomes">Escalante Cumprida:</label>';
echo $form->select('escalantecumprida', null, null, array('onChange' => 'javascript:mudanome(\'EscalaAno\',\'EscalaEscalantecumprida\');', 'class' => 'formulario'), false)."<div id='EscalaEscalantecumprida01' style='float: left;position: relative;'>".$this->Html->image('spinner.gif',array('width'=>'15px','height'=>'15px'))."</div>";
echo '<br><label for="Consultanomes">Aprova Escala Cumprida:</label>';
echo $form->select('aprovaescalacumprida', null, null, array('onChange' => 'javascript:mudanome(\'EscalaAno\',\'EscalaAprovaescalacumprida\');', 'class' => 'formulario'), false)."<div id='EscalaAprovaescalacumprida01' style='float: left;position: relative;'>".$this->Html->image('spinner.gif',array('width'=>'15px','height'=>'15px'))."</div>";
echo '<br><hr><label for="Consultanomes">Busca:</label><input class="formulario" type="text" name="nome" id="nomeparaconsulta"><input type="submit" value="Buscar" name="btnConsultaNome" onclick="consultanome();" class="botoes">';
echo '<br><label for="Consultanomes">Nome:</label><select id="EscalaSelectMilitares"  class="formulario" name="data[Escala][militar]" onchange="verificaexistencia()">';
echo '<option value="'.$dados['Militar']['id'].'">'.$dados[0]['nome'].'</option>';
echo '</select><br>'; 
echo '<label>Legenda Prevista:</label><input id="EscalaLegendap" type="text" size="3" name="data[Escala][legendap]" onkeyup="$(\'EscalaLegendap\').value=$(\'EscalaLegendap\').value.toUpperCase();" class="formulario">&nbsp;&nbsp;&nbsp;<input	type="checkbox"  id="EscalaPrevista" size="3" name="data[Escala][prevista]"	class="formulario" checked="checked" value="1"><br>';
echo '<label>Legenda Cumprida:</label><input id="EscalaLegendac" type="text" size="3" name="data[Escala][legendac]" onkeyup="$(\'EscalaLegendac\').value=$(\'EscalaLegendac\').value.toUpperCase();" class="formulario">&nbsp;&nbsp;&nbsp;<input	type="checkbox"  id="EscalaCumprida" size="3" name="data[Escala][cumprida]"	class="formulario" checked="checked" value="1"><br>';
echo '<hr><label>Comandante Prevista:</label><p style="margin-top:19px;padding:0px;" id="EscalaComandantePrevista" class="formulario">Nome do Chefe da Divisão</p><hr>';
echo '<label>Comandante Cumprida:</label><p style="margin-top:19px;padding:0px;" id="EscalaComandanteCumprida" class="formulario">Nome do Chefe da Divisão</p>'."<div id='EscalaComandanteCumprida01' style='float: right;margin: -30px 210px -30px -30px;position: relative;'>".$this->Html->image('spinner.gif',array('width'=>'15px','height'=>'15px'))."</div>".'&nbsp;&nbsp;&nbsp;'."<div id='EscalaComandantePrevista01' style='float: right;margin: -30px 210px -30px -30px;position: relative;'>".$this->Html->image('spinner.gif',array('width'=>'15px','height'=>'15px'))."</div>".'&nbsp;&nbsp;&nbsp;';
echo '<hr><p><label>Procedimentos:</label></p><span style="display:block;">';
echo '&nbsp;&nbsp;<input type="submit" value="CADASTRAR LEGENDA" id="btcadastra" name="btcadastra" onclick="cadastralegenda();" class="botoes">';
echo '&nbsp;&nbsp;<input type="submit" value="MODIFICAR LEGENDA" id="btmodifica" name="btmodifica" class="botoes" onclick="modificalegenda();" >';
echo '&nbsp;&nbsp;<input type="submit" value="EXCLUIR LEGENDA" id="btexclui" name="btexclui"  class="botoes"  onclick="this.href=\'#\';return false;" onmousedown="HideContent(\'fundolegendas\');dialogo(\'Deseja realmente excluir as legendas de  \'+$(\'EscalaSelectMilitares\')[$(\'EscalaSelectMilitares\').selectedIndex].text+\' ?\' ,\'functionexcluilegenda();\');">'; 
echo '</span>';
echo '';
echo '</fieldset><hr><br>';
?>
   
<div id="cadastrados">
</div>   
    
    
<script language="javascript">
	HideContent('EscalaEscalanteprevista01');
	HideContent('EscalaAprovaescalaprevista01');
	HideContent('EscalaEscalantecumprida01');
	HideContent('EscalaAprovaescalacumprida01');
	HideContent('EscalaComandantePrevista01');
	HideContent('EscalaComandanteCumprida01');
	HideContent('EscalasmonthCargaBase01');
	HideContent('EscalasmonthCargaMaxima01');
</script>	


 

<script language="javascript">
    function ExibeDica(mensagem){

        $('alertaSistemaTitulo').setStyle('tooltiptstyle');
        $('alertaSistemaTitulo').setStyle({
            backgroundColor: '#ff0000',
            color: 'yelow',
            fontSize: '20px',
            width: '40%'
        });
        $('mensagem').setStyle('tooltipstyle');
        $('mensagem').setStyle({
            backgroundColor: '#ff0000',
            color: 'yelow',
            fontSize: '20px',
            width: '40%'
        });
        $('alertaSistemaTitulo').innerHTML = '';
        $('alertaSistema').innerHTML = mensagem;
        ShowContent('mensagem');

    }
    function EscondeDica(){
        HideContent('mensagem');
    }
</script>
<?php
$raiz = $this->webroot;

$jscript = <<<SCRIPT
<script type="text/javascript">
//<![CDATA[

function consultanome() {
    /*
    usa método request() da classe Form da prototype, que serializa os campos
    do formulário e submete (por POST como default) para a action especificada no form
    */

    var dados = Form.serialize($('EscalaExternoBoletimForm'));
    new Ajax.Request('{$this->webroot}escalas/externoconsultanomes', {
                    method: 'post',
                    postBody: dados,
                    onSuccess: function(transport) {
                    var resultado = transport.responseText;
                            $('EscalaSelectMilitares').innerHTML = unescape(resultado);
                    }
     })


	return false;
}

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



function listaescalas(campoformulario, campomodificado01){
	HideContent('mensagem');
	var id1 = $('EscalaAno').value;
    limpaSelect('EscalaEscala');
    new Ajax.Updater(campomodificado01,'{$raiz}escalas/externoupdateescalas/'+id1, {asynchronous:false, evalScripts:false, parameters:Form.Element.serialize(campoformulario), requestHeaders:['X-Update', campomodificado01]})
}


function listadadosescala(campoformulario, campomodificado01){
	HideContent('mensagem');
	var id1 = $('EscalaEscala').value;
    limpaSelect('EscalaEscalanteprevista');
    limpaSelect('EscalaEscalantecumprida');
    limpaSelect('EscalaAprovaescalaprevista');
    limpaSelect('EscalaAprovaescalacumprida');
    $('EscalaLegendap').value = '';
    $('EscalaLegendac').value = '';
    $('EscalaComandantePrevista').value = '';
    $('EscalaComandanteCumprida').value = '';
    $('EscalaLegendap').value = '';
    $('EscalaLegendac').value = '';

    new Ajax.Updater(EscalasmonthCargaBase,'{$raiz}escalas/externoupdatecarga/'+$('EscalaEscala').value + '/base', {asynchronous:false, evalScripts:false,onCreate:function(request, xhr) {\$("EscalasmonthCargaBase01").show();}, onSuccess:function(request) {HideContent("EscalasmonthCargaBase01");var resultado = request.responseText;
		$('EscalasmonthCargaBase').value = resultado;}, parameters:Form.Element.serialize(campoformulario), requestHeaders:['X-Update', EscalasmonthCargaBase]})

    new Ajax.Updater(EscalasmonthCargaMaxima,'{$raiz}escalas/externoupdatecarga/'+$('EscalaEscala').value + '/maxima', {asynchronous:false, evalScripts:false,onCreate:function(request, xhr) {\$("EscalasmonthCargaMaxima01").show();}, onSuccess:function(request) {HideContent("EscalasmonthCargaMaxima01");var resultado = request.responseText;$('EscalasmonthCargaMaxima').value = resultado;}, parameters:Form.Element.serialize(campoformulario), requestHeaders:['X-Update', EscalasmonthCargaMaxima]})
	
    
    new Ajax.Updater(EscalaEscalanteprevista,'{$raiz}escalas/externoupdatenomes/'+$('EscalaEscala').value + '/0', {asynchronous:false, evalScripts:false,onCreate:function(request, xhr) {\$("EscalaEscalanteprevista01").show();}, onSuccess:function(request) {HideContent("EscalaEscalanteprevista01");}, parameters:Form.Element.serialize(campoformulario), requestHeaders:['X-Update', EscalaEscalanteprevista]})
    new Ajax.Updater(EscalaAprovaescalaprevista,'{$raiz}escalas/externoupdatenomes/'+$('EscalaEscala').value + '/1', {asynchronous:false, evalScripts:false,onCreate:function(request, xhr) {\$("EscalaAprovaescalaprevista01").show();}, onSuccess:function(request) {HideContent("EscalaAprovaescalaprevista01");}, parameters:Form.Element.serialize(campoformulario), requestHeaders:['X-Update', EscalaAprovaescalaprevista]})
    new Ajax.Updater(EscalaEscalantecumprida,'{$raiz}escalas/externoupdatenomes/'+$('EscalaEscala').value + '/2', {asynchronous:false, evalScripts:false,onCreate:function(request, xhr) {\$("EscalaEscalantecumprida01").show();}, onSuccess:function(request) {HideContent("EscalaEscalantecumprida01");}, parameters:Form.Element.serialize(campoformulario), requestHeaders:['X-Update', EscalaEscalantecumprida]})
    new Ajax.Updater(EscalaAprovaescalacumprida,'{$raiz}escalas/externoupdatenomes/'+$('EscalaEscala').value + '/3', {asynchronous:false, evalScripts:false,onCreate:function(request, xhr) {\$("EscalaAprovaescalacumprida01").show();}, onSuccess:function(request) {HideContent("EscalaAprovaescalacumprida01");}, parameters:Form.Element.serialize(campoformulario), requestHeaders:['X-Update', EscalaAprovaescalacumprida]})
	new Ajax.Request('{$this->webroot}escalas/externoupdatenomes/'+$('EscalaEscala').value + '/4', {
                 	method: 'get',
                 	onCreate:function(request, xhr) {\$("EscalaComandantePrevista01").show();},
                    onSuccess: function(transport) {
	                    var resultado = transport.responseText;
	                    $('EscalaComandantePrevista').value = resultado.cmtprevista;
	                    HideContent("EscalaComandantePrevista01");
		            }
		           
    });
	new Ajax.Request('{$this->webroot}escalas/externoupdatenomes/'+$('EscalaEscala').value + '/5', {
                 	method: 'get',
                 	onCreate:function(request, xhr) {\$("EscalaComandanteCumprida01").show();},
                 	onSuccess: function(transport) {
	                    var resultado = transport.responseText;
	                    $('EscalaComandanteCumprida').value = resultado.cmtcumprida;
	                    HideContent("EscalaComandanteCumprida01");
				}
    });
    
    new Ajax.Updater(mensagem,'{$raiz}escalas/externolegendas/'+$('EscalaEscala').value, {asynchronous:false, evalScripts:false,onCreate:function(request, xhr) {\$("EscalaAprovaescalacumprida01").show();}, onSuccess:function(request) {HideContent("EscalaAprovaescalacumprida01");}, parameters:Form.Element.serialize(campoformulario), requestHeaders:['X-Update', mensagem]})
    ShowContent('mensagem');
    
    
}

function mudacarga(tipo){

	if(tipo=='base'){
	    new Ajax.Updater(EscalasmonthCargaBase,'{$raiz}escalas/externoupdatecarga/'+$('EscalaEscala').value + '/base/'+$('EscalasmonthCargaBase').value, {asynchronous:false, evalScripts:false,onCreate:function(request, xhr) {\$("EscalasmonthCargaBase01").show();}, onSuccess:function(request) {HideContent("EscalasmonthCargaBase01");var resultado = request.responseText;
		$('EscalasmonthCargaBase').value = resultado;}, parameters:Form.Element.serialize(EscalasmonthCargaBase), requestHeaders:['X-Update', EscalasmonthCargaBase]})
	}
	
	if(tipo=='maxima'){
    	new Ajax.Updater(EscalasmonthCargaMaxima,'{$raiz}escalas/externoupdatecarga/'+$('EscalaEscala').value + '/maxima/'+$('EscalasmonthCargaMaxima').value, {asynchronous:false, evalScripts:false,onCreate:function(request, xhr) {\$("EscalasmonthCargaMaxima01").show();}, onSuccess:function(request) {HideContent("EscalasmonthCargaMaxima01");var resultado = request.responseText;$('EscalasmonthCargaMaxima').value = resultado;}, parameters:Form.Element.serialize(EscalasmonthCargaMaxima), requestHeaders:['X-Update', EscalasmonthCargaMaxima]})
	}

}

function mudanome(campoformulario, selectid){
    var id1 = $('EscalaEscala').value;
    var selecionado = $(selectid).value;
    HideContent('mensagem');
    
    
  	var tipoescala = 'Cumprida';
    if(selectid.indexOf('prevista')>-1){
  		tipoescala = 'Prevista';
	}

	new Ajax.Request('{$this->webroot}escalas/externoescalaverifica/'+$('EscalaEscala').value + '/'+tipoescala, {
                    method: 'get',
                    onSuccess: function(transport) {
	                    var resultado = transport.responseText.evalJSON(true);
	                    if(resultado.ok==1){
	   				    	new Ajax.Updater(selectid,'{$raiz}escalas/externoupdatedadosescala/'+$('EscalaEscala').value + '/'+selectid, {asynchronous:false, evalScripts:false, parameters:Form.Element.serialize($(selectid)), requestHeaders:['X-Update', selectid]})
	                    	exibeMensagem('Campo atualizado com sucesso!');
						}else{
	                    	exibeMensagem(resultado.mensagem);
	                    }
					}
    });

    
    
}

function listamilitares(campoformulario, campomodificado){
    var id1 = $('EscalaAno').value;
	HideContent('mensagem');
    limpaSelect('EscalaMilitar');
    new Ajax.Updater(campomodificado,'{$raiz}escalas/externoupdatemilitar/'+id1, {asynchronous:false, evalScripts:false, parameters:Form.Element.serialize(campoformulario), requestHeaders:['X-Update', campomodificado]})
}

function cadastralegenda(){
	var dados = Form.serialize($('EscalaExternoBoletimForm'));
	HideContent('mensagem');
	new Ajax.Request('{$this->webroot}escalas/externomilitarescalaadd/', {
                    method: 'post',
                    postBody: dados,
                    onSuccess: function(transport) {

                    var resultado = transport.responseText.evalJSON(true);

					HideContent('mensagem');
                    exibeMensagem(resultado.mensagem);
					$('btcadastra').setStyle({display:null, top:null});
			        $('btmodifica').setStyle({display:null, top:null});
					$('btexclui').setStyle({display:null, top:null});
			        //ShowContent('mensagem');
                      //$('cadastrados').innerHTML = resultado.registros;
                      //unescape(resultado.mensagem);
                      new Ajax.Updater(mensagem,'{$raiz}escalas/externolegendas/'+$('EscalaEscala').value+'/'+$('EscalaSelectMilitares').value, {asynchronous:false, evalScripts:false,onCreate:function(request, xhr) {\$("EscalaAprovaescalacumprida01").show();}, onSuccess:function(request) {HideContent("EscalaAprovaescalacumprida01");}, parameters:Form.Element.serialize(EscalaExternoBoletimForm), requestHeaders:['X-Update', mensagem]})
					    ShowContent('mensagem');
}
    });

}

function verificaexistencia(){
	var dados = Form.serialize($('EscalaExternoBoletimForm'));
	new Ajax.Request('{$this->webroot}escalas/externoconsultanomesexiste/', {
	                    method: 'post',
	                    postBody: dados,
	                    onSuccess: function(transport) {
	                    var resultado = transport.responseText.evalJSON(true);
	                    $('EscalaLegendap').value = '';
						$('EscalaLegendac').value = '';
	                    
		                $('EscalaPrevista').checked = true;
		                $('EscalaCumprida').checked = true;
		               // if (resultado.ok=="1"){
		                  	if(resultado.legendaprevista.length>0){
								$('EscalaLegendap').value = resultado.legendaprevista;
							}else{
								$('EscalaLegendap').value = '';
							}
		                  	if(resultado.legendacumprida.length>0){
								$('EscalaLegendac').value = resultado.legendacumprida;
							}else{
								$('EscalaLegendac').value = '';
							}
							var escalaprevista = resultado.prevista;
		                    if(escalaprevista==0){
		                    	$('EscalaPrevista').checked = false;
							}
		                    var escalacumprida = resultado.cumprida;
		                    if(escalacumprida==0){
		                    	$('EscalaCumprida').checked = false;
							}
							$('EscalaComandantePrevista').innerHTML=resultado.cmtprevista;
							$('EscalaComandanteCumprida').innerHTML=resultado.cmtcumprida;
						//	exibeMensagem(resultado.mensagem);
			           // }
						if (resultado.ok=="0"){
							exibeMensagem(resultado.mensagem);
			            }
						if (resultado.ok=="-1"){
							exibeMensagem(resultado.mensagem);
			            }
			}
	    });
}

function modificalegenda(){
	var dados = Form.serialize($('EscalaExternoBoletimForm'));
	HideContent('mensagem');
	new Ajax.Request('{$this->webroot}escalas/externomodificalegenda/', {
	                    method: 'post',
	                    postBody: dados,
	                    onSuccess: function(transport) {
	                    var resultado = transport.responseText.evalJSON(true);
    					if (resultado.ok=="1"){
    						exibeMensagem(resultado.mensagem);
			            }
					    new Ajax.Updater(mensagem,'{$raiz}escalas/externolegendas/'+$('EscalaEscala').value+'/'+$('EscalaSelectMilitares').value, {asynchronous:false, evalScripts:false,onCreate:function(request, xhr) {\$("EscalaAprovaescalacumprida01").show();}, onSuccess:function(request) {HideContent("EscalaAprovaescalacumprida01");}, parameters:Form.Element.serialize(EscalaExternoBoletimForm), requestHeaders:['X-Update', mensagem]})
					    ShowContent('mensagem');
    		
			}
	    });
		
		
}


function excluilegenda(){
	var dados = Form.serialize($('EscalaExternoBoletimForm'));
	HideContent('mensagem');
	new Ajax.Request('{$this->webroot}escalas/externoexcluilegenda/', {
	                    method: 'post',
	                    postBody: dados,
	                    onSuccess: function(transport) {
	                    var resultado = transport.responseText.evalJSON(true);
    					if (resultado.ok=="1"){
    						exibeMensagem(resultado.mensagem);
			            }
					    new Ajax.Updater(mensagem,'{$raiz}escalas/externolegendas/'+$('EscalaEscala').value+'/'+$('EscalaSelectMilitares').value, {asynchronous:false, evalScripts:false,onCreate:function(request, xhr) {\$("EscalaAprovaescalacumprida01").show();}, onSuccess:function(request) {HideContent("EscalaAprovaescalacumprida01");}, parameters:Form.Element.serialize(EscalaExternoBoletimForm), requestHeaders:['X-Update', mensagem]})
					    ShowContent('mensagem');
    		
			}
	    });
		
		
}
    		



            //]]>

</script>
SCRIPT;
echo $jscript;
?>
