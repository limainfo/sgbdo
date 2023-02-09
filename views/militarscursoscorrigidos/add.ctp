<div class="militarscursoscorrigidos form">
<?php 
echo $form->create('Militarscursoscorrigido', array('action'=>'externoadd','onsubmit'=>'submitForm(this); return false;','type'=>'file'));
?>
	<fieldset>
 		<legend><?php __('Atualização dos dados (Militares x Cursos)');?><?php 		
	    $link = $this->webroot.'militarscursoscorrigidos/externosugestao/\'';
 		$imagem = $this->Html->image('sugestao.png', array('alt'=> __('PDF', true), 'border'=> '0', 'title'=>'Cadastrar sugestão.', 'id'=>'pdf'));
 		$conteudo.='&nbsp;&nbsp;<a 	onclick="var m=$(\'MilitarscursoscorrigidoMilitarId\').value;var s=$(\'MilitarscursoscorrigidoSetorId\').value;if(m==0||s==0){alert(\'É necessário informar o Setor e Nome do Militar!\');}else{window.open(\''.$link."+m+'/'+s,'','height=300,width=400,toolbar=0,scrollbars=0,directories=0,status=0');}\">".$imagem."</a></label>";
 		echo $conteudo;
	?>
 		
 		&nbsp;&nbsp;&nbsp;
		<?php //
		//$link = 
		//echo $this->Html->link($this->Html->image('pdf2.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice','onmouseover'=>"$('link').href='".$this->webroot."militarscursoscorrigidos/externoPdf/'+$('MilitarscursoscorrigidoUnidadeId').value+'/'+$('MilitarscursoscorrigidoSetorId').value+'/'+$('MilitarscursoscorrigidoMilitarId').value;")), array('action'=>'externoPdf', null),array('id'=>'link', 'escape'=>false), null,false); ?>
 		</legend>
 		
 		
	<?php
	//echo ($u[0]['Usuario']['militar_id']==905);
		echo $form->input('unidade_id',array('class'=>'formulario','onchange'=>'javascript:tratamento(\'unidade\',\'MilitarscursoscorrigidoUnidadeId\',\'MilitarscursoscorrigidoSetorId\');','options'=>$unidades, 'default'=>0));
		echo $form->input('setor_id',array('class'=>'formulario','onchange'=>'javascript:tratamento(\'setor\',\'MilitarscursoscorrigidoSetorId\',\'MilitarscursoscorrigidoMilitarId\');','readonly'=>'readonly'));
		echo $form->input('militar_id',array('class'=>'formulario','onchange'=>'javascript:militar();'));
		echo $form->input('curso_id',array('class'=>'formulario'));
		echo $datePicker->picker('dt_inicio_curso',array('class'=>'formulario','readonly'=>'readonly'));
		echo $datePicker->picker('dt_fim_curso',array('class'=>'formulario','readonly'=>'readonly'));
		echo $form->input('local_realizacao',array('class'=>'formulario'));
		//echo $form->input('documento',array('class'=>'formulario','label'=>'RÁDIO MATRÍCULA OU CONCLUSÃO'));
		//echo $form->input('periodo',array('class'=>'formulario'));
		$opcoes = array('INCLUIR'=>'INCLUIR','RETIFICAR'=>'RETIFICAR','EXCLUIR'=>'EXCLUIR');
		echo $form->input('acao',array('class'=>'formulario','readonly'=>'readonly','options'=>$opcoes));
		if($u[0]['Usuario']['privilegio_id']==5){
			echo $form->hidden('escalante',array('class'=>'formulario','value'=>$u[0][0]['nome']));
			echo $form->hidden('dt_escalante',array('class'=>'formulario','value'=>date('Y-m-d h:i:s')));
			//echo $form->hidden('aprova_dados',array('class'=>'formulario'));
			//echo $form->hidden('dt_aprova',array('class'=>'formulario'));
		}
		if($u[0]['Usuario']['privilegio_id']==6){
			//echo $form->hidden('escalante',array('class'=>'formulario'));
			//echo $form->hidden('dt_escalante',array('class'=>'formulario'));
			echo $form->hidden('aprova_dados',array('class'=>'formulario','value'=>$u[0][0]['nome']));
			echo $form->hidden('dt_aprova',array('class'=>'formulario','value'=>date('Y-m-d h:i:s')));
		}
		if(($u[0]['Usuario']['privilegio_id']!=5)&&($u[0]['Usuario']['privilegio_id']!=6)){
			echo $form->hidden('escalante',array('class'=>'formulario','value'=>$u[0][0]['nome']));
			echo $form->hidden('dt_escalante',array('class'=>'formulario','value'=>date('Y-m-d h:i:s')));
			echo $form->hidden('aprova_dados',array('class'=>'formulario','value'=>$u[0][0]['nome']));
			echo $form->hidden('dt_aprova',array('class'=>'formulario','value'=>date('Y-m-d h:i:s')));
		}
			?>
	</fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
<div class="actions">
	<ul>
		</ul>
</div>
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

function preencheSelect(nomeSelect) {
	var conteudo = '<option selected="selected" value=""></option>'
	var filtro = nomeSelect;
	select_innerHTML(filtro,conteudo);
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
var dados = Form.serialize($('MilitarscursoscorrigidoExternoaddForm'));
 new Ajax.Request('{$this->webroot}militarscursoscorrigidos/externoconfirma/'+id, {
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
    }else{
    	var teste = id;
    	$(id).checked = false;
    	var opcao=prompt("Digite (e) para EXCLUIR, (i) para INCLUIR, (r) para RETIFICAR :");
   opcao = opcao.capitalize();
   var f = 0;
   if((opcao!='E')&&(opcao!='I')&&(opcao!='R')){
   	 opcao = '';
   }
  if(opcao=='E'){opcao = 'EXCLUIR';f=1;}
  if(opcao=='I'){opcao = 'INCLUIR';f=1;}
  if(opcao=='R'){opcao = 'RETIFICAR';f=1;}
 
  if(f==1){
    new Ajax.Request('{$this->webroot}militarscursoscorrigidos/externoconfirma/'+id+'/'+opcao, {
			method: 'get',
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
}

function trataUnidade(campomodificado, acao, id1, campoformulario){
	new Ajax.Updater(campomodificado,'{$raiz}militarscursoscorrigidos/externoupdatesetor/'+acao+'/'+id1, {asynchronous:false, evalScripts:false, parameters:Form.Element.serialize(campoformulario), requestHeaders:['X-Update', campomodificado]})
	new Ajax.Updater('MilitarscursoscorrigidoMilitarId','{$raiz}militarscursoscorrigidos/externoupdate/setor/0', {asynchronous:false, evalScripts:false, parameters:Form.Element.serialize('MilitarscursoscorrigidoSetorId'), requestHeaders:['X-Update', 'MilitarscursoscorrigidoMilitarId']})
}


function tratamento(acao, campoformulario, campomodificado){
var id1 = $('MilitarscursoscorrigidoUnidadeId').value;
var id2 = $('MilitarscursoscorrigidoSetorId').value;

if(acao=='unidade'){
//preencheSelect('MilitarscursoscorrigidoSetorId');
//new Ajax.Updater(campomodificado,'{$raiz}militarscursoscorrigidos/externoupdate/'+acao+'/'+id1, {asynchronous:true, evalScripts:true, parameters:Form.Element.serialize(campoformulario), requestHeaders:['X-Update', campomodificado]})
trataUnidade(campomodificado, acao, id1, campoformulario);

}
if(acao=='setor'){
new Ajax.Updater(campomodificado,'{$raiz}militarscursoscorrigidos/externoupdate/'+acao+'/'+id2, {asynchronous:true, evalScripts:true, parameters:Form.Element.serialize(campoformulario), requestHeaders:['X-Update', campomodificado]})
setor();
}

}

//new Form.Element.EventObserver('MilitarscursoscorrigidoSetorId', function(element, value){tratamento('setor','MilitarscursoscorrigidoSetorId','MilitarscursoscorrigidoMilitarId');})
//new Form.Element.EventObserver('MilitarscursoscorrigidoUnidadeId', function(element, value){tratamento('unidade','MilitarscursoscorrigidoUnidadeId','MilitarscursoscorrigidoSetorId');})
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
function submitForm(form) {
/*
usa método request() da classe Form da prototype, que serializa os campos
do formulário e submete (por POST como default) para a action especificada no form
*/
var dados = Form.serialize($('MilitarscursoscorrigidoExternoaddForm'));
var idU = $('MilitarscursoscorrigidoUnidadeId').value;
var idS = $('MilitarscursoscorrigidoSetorId').value;
new Ajax.Request('{$this->webroot}militarscursoscorrigidos/externoadd/soma/'+idU+'/'+idS, {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			
			 if (resultado.ok==0){
				alert('Registro não atualizado!');
				//$('dados').innerHTML = resultado.mensagem;
				//$('atuais').innerHTML = resultado.atual;
			}else{
				alert('Registro atualizado!');
				//$('dados').innerHTML = resultado.mensagem;
				//$('atuais').innerHTML = resultado.atual;
							
			}
			militar();
		}
				})
        
		retorno();
        
        return false;
    }
    
function excluiRegistro(id) {
/*
usa método request() da classe Form da prototype, que serializa os campos
do formulário e submete (por POST como default) para a action especificada no form
*/
var dados = Form.serialize($('MilitarscursoscorrigidoExternoaddForm'));
var filtro = $('MilitarscursoscorrigidoSetorId').value;

new Ajax.Request('{$this->webroot}militarscursoscorrigidos/delete/'+id+'/'+filtro, {
			method: 'get',
			postBody: dados,
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			
			 if (resultado.ok==0){
				alert('Registro não excluído!');
			}else{
				alert('Registro excluído!');
				$('dados').innerHTML = resultado.mensagem;
				$('atuais').innerHTML = resultado.atual;
				
			}
		}
				})
        
		retorno();
				
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