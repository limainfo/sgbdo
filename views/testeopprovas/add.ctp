<?php 	
	$compara = $u[0]['Usuario']['privilegio_id'];
	if(($compara==1)||($compara==4)||($compara==12)){
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
<table cellpadding="0" cellspacing="0">
<tr style="vertical-align:middle;"><th colspan="2" style="vertical-align:middle;border: 1px solid #000;background-color:#000060;color:#fff;"><center>LISTAGEM DAS PROVAS PARA TESTE OPERACIONAL&nbsp;&nbsp;&nbsp;&nbsp;
<?php 
	echo $ajax->link($this->Html->image('novo.gif', array('alt'=> __('Exibir', true), 'border'=> '0','float'=> 'right', 'title'=>'Visualizar')), array('action'=>'externoadd', null),array('escape'=>false, 'update'=>'formularios'), null,false);
	?>
</center>
</th></tr>
<tr><th>Provas</th><th>Ações</th></tr>
	<?php 
$i=0;
		$testeopprovas = $this->requestAction('testeopprovas/externolista');
		foreach($testeopprovas as $dado){
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
				echo "<tr {$class}><td>{$dado['Testeopprova']['nm_prova']}</td>";
				echo "<td>";
				//echo $ajax->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'index', $testeopprova['Testeopprova']['id']),array('escape'=>false, 'update'=>'View'), null,false);
				echo $ajax->link($this->Html->image('lapis.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'externoedit', $dado['Testeopprova']['id']),array('escape'=>false, 'update'=>'formularios','method'=>'post', 'with'=>'\'data[id]='.$dado['Testeopprova']['id'].'&value=help\'' ), null,false);
				echo '&nbsp;&nbsp;&nbsp;';
				echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$dado['Testeopprova']['nm_prova']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$dado['Testeopprova']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false); 
				echo "<td></td></tr>";
			
		}
				
?>
</table>
<?php  
	echo $ajax->divEnd('listagem');
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
	
	    
		//]]>

		HideContent('carregando');
</script>
SCRIPT;
echo $jscript;

	


?>

<?php 
	}else{
		
		echo '<center><h1><a href="../usuarios/logout">ACESSO NÃO AUTORIZADO!</a></h1></center>';
	}
?>