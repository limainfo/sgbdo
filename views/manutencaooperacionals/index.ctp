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
<h1><?php __('Afastamentos');?>
<?php
$setores = explode(',',$u[0][0]['setores']);
//print_r($setores);
//print_r($u[0]['Usuario']);
//print_r($afastamentos);

?>
&nbsp;<?php echo $this->Html->link($this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'add', null),array('escape'=>false, 'escape'=>false), null,false); ?>
&nbsp;<?php //echo $this->Html->link($this->Html->image('cadeado_aberto.gif', array('alt'=> __('PADRONIZAR AFASTAMENTOS', true), 'border'=> '0', 'title'=>'PADRONIZAR AFASTAMENTOS')), array('action'=>'edit', null),array('escape'=>false, 'escape'=>false), null,false); ?>
</h1>
<?php
//print_r($escalas);
//echo $form->end(array('label'=>'Imprimir relação','class'=>'botoes'));

echo $form->create('formFind', array('url' => 'index','id'=>'busca'));



echo '<div class="input text"><label for="find">Informe os dados a serem pesquisados</label><input type="text" maxlength="100" size="30" class="formulario" id="find" value="'.$this->data['formFind']['find'].'" name="data[formFind][find]"/>
<input type="submit" value="Buscar" class="botoes"/></div>';
		?>
<h3>
<?php
//$paginator->options(array('update' => 'wrapper', 'indicator' => 'spinner'));
echo $paginator->counter(array(
'format' => __('Página %page%/%pages%, exibindo %current% registro(s) de %count% total, registros de %start% até %end%', true)
));
?></h3>
<?php
		echo '<div class="input select" style="align:right;">Registros por página:<select id="FindPaginas" name="data[formFind][paginas]" class="formulario" onchange="$(\'busca\').submit();">';
		echo '<option value="10">10</option>';
		echo '<option value="15">15</option>';
		echo '<option value="20">20</option>';
		echo '<option value="25">25</option>';
		echo '<option value="30">30</option>';
		echo '<option value="TODAS">TODAS</option>';
		if(!empty($this->data['formFind']['paginas'])){
			echo '<option value="'.$this->data['formFind']['paginas'].'" selected="selected">'.$this->data['formFind']['paginas'].'</option>';
		}
		echo '</select></div>';
?>
<?php echo $form->end();
echo $form->create('Afastamento', array('action'=>'externofiltro','onsubmit'=>'javascript:pdf();return false;','type'=>'file'));
echo $form->select('escala', $escalas ,null,array('onChange'=>'javascript:tratamento(\'AfastamentoEscala\',\'AfastamentoAno\');','class'=>'formulario'), false);
echo $form->select('ano', $escalasmonth ,null ,array('onChange'=>'','class'=>'formulario'), false).'<input type="submit" value="Imprimir relação" class="botoes">';

?>
<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo $paginator->sort('militar_id');?></th>
		<th><?php echo $paginator->sort('motivo');?></th>
		<th><?php echo $paginator->sort('dt_inicio');?></th>
		<th><?php echo $paginator->sort('dt_termino');?></th>
		<th><?php echo $paginator->sort('obs');?></th>
		<th><span>Escala</span></th>
		<th><?php echo $paginator->sort('tipo_escala');?></th>
		<th>Mês</th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
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
	$i = 0;
	foreach ($afastamentos as $afastamento):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	?>
	<tr <?php echo $class;?>>
		<td onmouseover='ExibeDica("<br><b>Responsável:</b><?php echo $responsavel[0][$afastamento['Afastamento']['militar_responsavel']];?><br><b>Identidade:</b><?php echo $responsavel[1][$afastamento['Afastamento']['militar_responsavel']];?><br><br>");' onmouseout="EscondeDica();">
			<?php echo $this->Html->link($afastamento['Militar']['Posto']['sigla_posto'].' '.$afastamento['Militar']['Especialidade']['nm_especialidade'].' '.$afastamento['Militar']['nm_completo'], array('controller'=> 'militars', 'action'=>'view', $afastamento['Militar']['id']),array('rel'=>'tooltip')); ?>
<!-- <div  rel='tooltip' id='i<?php echo $afastamento['Afastamento']['id']; ?>' title='<?php echo '<p style="background-color:#000;color:#fff;"><br><b>Responsável:</b>'.$responsavel[0][$afastamento['Afastamento']['militar_responsavel']]."<br><b>Identidade:</b>".$responsavel[1][$afastamento['Afastamento']['militar_responsavel']].'<br><br></p>'; ?>'>
			<?php echo $this->Html->link($afastamento['Militar']['Posto']['sigla_posto'].' '.$afastamento['Militar']['Especialidade']['nm_especialidade'].' '.$afastamento['Militar']['nm_completo'], array('controller'=> 'militars', 'action'=>'view', $afastamento['Militar']['id']),array('rel'=>'tooltip')); ?>
			</div>
 -->		
		</td>
		<td><?php echo $afastamento['Afastamento']['motivo']; ?></td>
		<td><?php echo date('d-m-Y',strtotime($afastamento['Afastamento']['dt_inicio'])); ?></td>
		<td><?php echo date('d-m-Y',strtotime($afastamento['Afastamento']['dt_termino'])); ?></td>
		<td><?php echo $afastamento['Afastamento']['obs']; ?></td>
		<td><?php echo $escalas[$afastamento['Afastamento']['setor_id']]; ?></td>
		<td><?php if($afastamento['Afastamento']['tipo_escala']=='p') {echo "PREVISTA";}if($afastamento['Afastamento']['tipo_escala']=='c') {echo "CUMPRIDA";} ?></td>
		<td><?php 
		//if(array_key_exists($afastamento['Afastamento']['setor_id'],$ativos)) {
			echo $ativos[$afastamento['Afastamento']['setor_id']];
		//}
		 ?></td>
		<td class="actions"><?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $afastamento['Afastamento']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php
		//if(array_key_exists($afastamento['Afastamento']['escala_id'],$ativos)||($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)) {
		if((array_search($afastamento['Afastamento']['setor_id'],$setores)||($afastamento['Afastamento']['setor_id']==$setores[0]))&&(($u[0]['Usuario']['privilegio_id']==5)||($u[0]['Usuario']['privilegio_id']==6))){
			$apaga=1;
		} else{
			$apaga=0;
		}
		//echo $apaga.' apagar';
		echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit/'.$afastamento['Afastamento']['id'].'/'.$afastamento['Militar']['id'], null),array('escape'=>false, 'escape'=>false), null,false); 
//		if(array_key_exists($afastamento['Afastamento']['escala_id'],$ativos)) { 
		if(($u[0]['Usuario']['militar_id']==$afastamento['Afastamento']['militar_responsavel'])||($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)||($apaga)){
			
		echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$afastamento['Afastamento']['dt_inicio']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$afastamento['Afastamento']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);
		} 
	//	}
		?>
		</td>

	</tr>
	<?php endforeach; ?>
</table>
</div>
<br><hr>
<div class="paging"><?php echo $paginator->prev('<< '.__('Anterior', true), array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?>
| <?php echo $paginator->numbers(array('modulus'=>200,'onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"));?> <?php echo $paginator->next(__('Próxima', true).' >>', array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?>
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

function limpaSelect(nomeSelect) {
	var conteudo = '<option selected="selected" value=""></option>'
	var filtro = nomeSelect;
	select_innerHTML(filtro,conteudo);
}
    

  
function tratamento(campoformulario, campomodificado){
	var id1 = $('AfastamentoEscala').value;
	limpaSelect('AfastamentoAno');
	new Ajax.Updater(campomodificado,'{$raiz}afastamentos/externoupdateano/'+id1, {asynchronous:false, evalScripts:false, parameters:Form.Element.serialize(campoformulario), requestHeaders:['X-Update', campomodificado]})

}
	
function pdf() {
var setor = $('AfastamentoEscala').value;
var escalasmonth = $('AfastamentoAno').value;

window.open('{$this->webroot}afastamentos/externopdf/'+setor+'/'+escalasmonth);
        
}


    
		//]]>

</script>
SCRIPT;
echo $jscript;


?>