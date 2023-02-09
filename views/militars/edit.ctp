<center>
<?php 
include $caminhoAditivos;
?><div class="militars form">
<?php echo $form->create('Militar');?>
	<fieldset>
		 <legend><?php __('Modificar dados de Militar');?>&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
 		&nbsp;&nbsp;&nbsp;
 		</legend>
	<?php
		echo $form->input('id');
		?>
		<?php echo $form->input('setor_id',array('class'=>'formulario'));  ?>
		<?php echo $form->input('posto_id',array('class'=>'formulario')); ?>
		<?php echo $form->input('especialidade_id',array('class'=>'formulario')); ?>
<?php
		echo $form->input('nr_licenca',array('class'=>'formulario'));
		echo $form->input('identidade',array('class'=>'formulario'));
		//echo $form->input('expedidor',array('class'=>'formulario'));
		echo $form->input('saram',array('class'=>'formulario'));
		//echo $form->input('rc',array('class'=>'formulario'));
		echo $form->input('cpf',array('class'=>'formulario'));
		echo $form->input('nm_completo',array('class'=>'formulario','size'=>'45','onkeyup'=>"$('MilitarNmCompleto').value=$('MilitarNmCompleto').value.toUpperCase();"));
		echo $form->input('nm_guerra',array('class'=>'formulario','size'=>'20','onkeyup'=>"$('MilitarNmGuerra').value=$('MilitarNmGuerra').value.toUpperCase();"));
		//echo $datePicker->picker('dt_nascimento',array('class'=>'formulario'));
		echo $datePicker->picker('dt_admissao',array('class'=>'formulario'));
		//echo $datePicker->picker('dt_ultima_promocao',array('class'=>'formulario'));
		//echo $datePicker->picker('dt_formacao',array('class'=>'formulario'));
		echo $form->input('telefone01',array('class'=>'formulario'));
		//echo $form->input('telefone02',array('class'=>'formulario'));
		//echo $form->input('telefone03',array('class'=>'formulario'));
		//echo $form->input('cidade',array('class'=>'formulario'));
		//echo $form->input('endereco',array('class'=>'formulario','style'=>'height:100px;'));
		//echo $form->input('bairro',array('class'=>'formulario','size'=>'45'));
		echo $form->input('email',array('class'=>'formulario','size'=>'45'));
		//echo $form->input('subdivisao',array('class'=>'formulario','size'=>'45'));
		//echo $form->input('orgao',array('class'=>'formulario','size'=>'45'));
		echo $form->input('sexo',array('class'=>'formulario', 'type'=>'select', 'options'=>$sexos, 'default'=>$this->data['Militar']['sexo']));
	   //echo $form->input('obs',array('class'=>'formulario','style'=>'height:100px;'));
		echo $form->input('indicativo',array('class'=>'formulario'));
                /*
		echo $datePicker->picker('dt_desligamento',array('class'=>'formulario'));
		echo $form->input('codarea',array('class'=>'formulario'));
		echo $form->input('pasep',array('class'=>'formulario'));
		echo $form->input('total_beneficiarios',array('class'=>'formulario'));
		echo $form->input('num_lesp',array('class'=>'formulario'));
		echo $form->input('funcao',array('class'=>'formulario'));
		echo $datePicker->picker('dt_apresentacao',array('class'=>'formulario'));
		echo $datePicker->picker('dt_apresentacao_area',array('class'=>'formulario'));
		echo $form->input('banco',array('class'=>'formulario'));
		echo $form->input('agencia',array('class'=>'formulario'));
		echo $form->input('conta',array('class'=>'formulario'));
		echo $form->input('supervisor',array('class'=>'formulario'));
		echo $datePicker->picker('data_licenciamento',array('class'=>'formulario'));
		echo $form->input('local_apresentacao',array('class'=>'formulario'));
		echo $form->input('om_anterior',array('class'=>'formulario'));
		echo $form->input('cidade_nascimento',array('class'=>'formulario'));
		echo $form->input('uf_nascimento',array('class'=>'formulario'));
		echo $form->input('nacionalidade',array('class'=>'formulario'));
                 * 
                 */
		//echo $form->input('estado_civil',array('class'=>'formulario'));
		echo $form->input('situacao',array('class'=>'formulario','options'=>$situacaoMilitar));
		if($u[0]['Usuario']['privilegio_id']==1 || $u[0]['Usuario']['privilegio_id']==4){
			echo $form->input('ativa',array('class'=>'formulario', 'type'=>'select', 'options'=>array('1'=>'ATIVADO','0'=>'DESATIVADO'), 'default'=>$this->data['Militar']['ativa']));
		}
                
		?>
	
	</fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
<?php 
	$raiz = $this->webroot;

$observaUnidade=<<<SCRIPT
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
    
function tratamento(acao, campoformulario, campomodificado){
var id2 = $('MilitarUnidadeId').value;

if(acao=='lista_setores'){
	limpaSelect('MilitarSetorId');
	new Ajax.Updater(campomodificado,'{$raiz}necessidades/externoupdatesetor/'+id2, {asynchronous:true, evalScripts:true, parameters:Form.Element.serialize(campoformulario), requestHeaders:['X-Update', campomodificado]})
}

}
//]]>
</script>
SCRIPT;
echo $observaUnidade;

?>
</center>