<?php
//print_r($this->data);
//print_r($u);
                function removenl($texto){
                    $texto = str_replace("\n", " ", $texto);
                    return str_replace("\r", " ", $texto);
                }

if($u[0]['Usuario']['privilegio_id']==12){
	$leitura = '"readonly"="readonly"';
}else{
	$leitura = "";
}
if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)||($u[0]['Usuario']['privilegio_id']==16)){
	$privilegio = 1;
}else{
	$privilegio = 0;
}
	?>
<div class="inspecaos index">
<h1><?php __('Inspeções');?> <?php
$script = "var x=encodeURIComponent(\$('find').value);if(x.blank()){\$('broffice').href='".$this->webroot."inspecaos/indexExcel/';}else{\$('broffice').href='".$this->webroot."inspecaos/indexExcel/'+x;}";

$script = "new Ajax.Request('".$this->webroot."inspecaos/indexExcel/', {method:'post', parameters: $('buscaajax').serialize(true) });return false; ";

$scriptexcel = "$('campos').value=$('camposelect').value;$('filtros').value=$('filtroselect').value;$('valores').value=$('Valor').value;
    $('arqexcel').action='{$this->webroot}inspecaos/indexExcel/';$('arqexcel').submit(); return false; ";

    
$scriptpdf = "$('campos').value=$('camposelect').value;$('filtros').value=$('filtroselect').value;$('valores').value=$('Valor').value;
    $('arqexcel').action='{$this->webroot}inspecaos/externopdf/';$('arqexcel').submit(); return false; ";

?> &nbsp;
<form accept-charset="utf-8" action="<?php echo $this->webroot."inspecaos/indexExcel/"; ?>" method="post" id="arqexcel"  enctype="multipart/form-data" >
<input type="hidden" name="data[campo]" id="campos" value="<?php echo $this->data['campo']; ?>">
<input type="hidden" name="data[filtro]" id="filtros" value="<?php echo $this->data['filtro']; ?>">
<input type="hidden" name="data[valor]" id="valores" value="<?php echo $this->data['valor']; ?>">
<?php 
echo $this->Html->link($this->Html->image('broffice.png', array('alt'=> __('BROffice', true), 'border'=> '0', 'title'=>'Dados em planilha BROffice', 'onclick'=>$scriptexcel)), array('action'=>'indexExcel'), array('id'=>'broffice','escape'=>false), null,false); 

echo $this->Html->link($this->Html->image('pdf2.gif', array('alt'=> __('PDF', true), 'border'=> '0', 'title'=>'Dados em PDF', 'onclick'=>$scriptpdf  )), array('action'=>'externopdf'), array('id'=>'pdf','escape'=>false), null,false); 

?></form>
&nbsp;<?php  ?>
&nbsp;<?php echo $this->Html->link($this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'add', null),array('escape'=>false, 'escape'=>false), null,false); ?>
</h1>

<h3><?php
echo $paginator->counter(array(
'format' => __('Página %page%/%pages%, exibindo %current% registro(s) de %count% total, registros de %start%, até %end%', true)
));
?></h3>
<?php
echo $form->create('buscaajax', array('url' => 'index','id'=>'buscaajax'));
?>    
<?php
echo '<div class="input select" style="align:right;">Registros por página:<select id="FindPaginas" name="data[formFind][paginas]" class="formulario" onchange="$(\'buscaajax\').submit();">';
echo '<option value="10">10</option>';
echo '<option value="15">15</option>';
echo '<option value="20">20</option>';
echo '<option value="25">25</option>';
echo '<option value="30">30</option>';
echo '<option value="TODAS">TODAS</option>';
if(!empty($this->data['formFind']['paginas'])){
	echo '<option value="'.$this->data['formFind']['paginas'].'" selected="selected">'.$this->data['formFind']['paginas'].'</option>';
}
echo '</select>&nbsp;&nbsp;&nbsp;<img border="0" onclick="$(\'filtro\').style.display = \'block\';//ShowContent(\'filtro\');"  title="Filtrar Dados" alt="Filtro" src="'.$this->webroot.'img/filtro.gif"/>'; 
echo '&nbsp;&nbsp;&nbsp;'; 

?>
<div id="filtro" style="border-color: #000000; padding: 0px; border: 3px solid #000000; position: absolute;">
<?php //echo $form->create('buscaajax', array('url' => 'index','id'=>'buscaajax')); ?>
<table cellspacing="0" cellpadding="0" id="conteudofiltro">
	<tbody>
		<tr>
			<td valign="center" align="center"><?php 
			$alfanumerico = '<option value="'.$this->data['filtro'].'"  selected="selected">FILTRO ATIVO</option>';
			$alfanumerico .=  '<option value=" LIKE \'%++++%\' ">CONTENHA</option>';
			$alfanumerico .= '<option value=" NOT LIKE \'%++++%\' ">NÃO CONTENHA</option>';
			$alfanumerico .= '<option value=" LIKE \'%++++\' ">COMECE COM</option>';
			$alfanumerico .= '<option value=" LIKE \'++++%\' ">TERMINE COM</option>';
			$alfanumerico .= '<option value=" = ++++ ">IGUAL A</option>';
			$alfanumerico .= '<option value=" <> ++++ ">DIFERENTE DE</option>';
			$alfanumerico .= '<option value=" > ++++ ">MAIOR QUE</option>';
			$alfanumerico .= '<option value=" < ++++ ">MENOR QUE</option>';

			

			
			$conta = 0;
			$campo = '<option value="'.$this->data['campo'].'" selected="selected">'.$this->data['campo'].'</option>';
			foreach($esquema as $campos=>$vetor){
				$conta++;
				$campo .= '<option value="'.$campos.'">'.$campos.'</option>'; 
			}
			
			
			?>
			<table cellspacing="0" cellpadding="0" id="filtros" >
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
				<?php //for($qtd=1;$qtd<=8;$qtd++){ ?>
				<tr>
					<td width="33%">
                                        <select id="camposelect" name="data[campo01]" class="formulario" >
						<?php echo $campo; ?>
					</select> 
                                        </td>
					<td width="33%">
                                        <select id="filtroselect" name="data[filtro01]" class="formulario" >
						<?php echo $alfanumerico; ?>
					</select> </td>
					<td width="33%">
                                        	<?php echo $ajax->autoComplete('valor01', 'externoautoComplete01',array('callback'=>"function(element, querystring) {return querystring + $('buscaajax').serialize();}"));
//	echo $ajax->link($this->Html->image('network_transmit.png', array('alt'=> __('Exibir', true), 'border'=> '0','float'=> 'right', 'title'=>'Visualizar')), array('action'=>'externoatualiza', null),array('escape'=>false, 'update'=>'formularios', 'create' => "var t=new Dialog({content:'<img alt=\"\" width=\"15\" height=\"15\" src=\"".$this->webroot."img/spinner.gif\"> Aguarde ...',title:'Atualizando tabelas', close:{link:false,overlay:false,esc:false}});t.open();", 'success' => 'Dialogs.close();','method'=>'post', 'with'=>"$('AditivoAddForm').serialize()"), null,false);
                                                ?>
                                        </td>                                            
				</tr>
				<tr>
					<td width="33%">
                                        <select id="camposelect" name="data[campo02]" class="formulario" >
						<?php echo $campo; ?>
					</select> 
                                        </td>
					<td width="33%">
                                        <select id="filtroselect" name="data[filtro02]" class="formulario" >
						<?php echo $alfanumerico; ?>
					</select> </td>
					<td width="33%">
                                        	<?php echo $ajax->autoComplete('valor02', 'externoautoComplete02',array('callback'=>"function(element, querystring) {return querystring + $('buscaajax').serialize();}"));
//	echo $ajax->link($this->Html->image('network_transmit.png', array('alt'=> __('Exibir', true), 'border'=> '0','float'=> 'right', 'title'=>'Visualizar')), array('action'=>'externoatualiza', null),array('escape'=>false, 'update'=>'formularios', 'create' => "var t=new Dialog({content:'<img alt=\"\" width=\"15\" height=\"15\" src=\"".$this->webroot."img/spinner.gif\"> Aguarde ...',title:'Atualizando tabelas', close:{link:false,overlay:false,esc:false}});t.open();", 'success' => 'Dialogs.close();','method'=>'post', 'with'=>"$('AditivoAddForm').serialize()"), null,false);
                                                ?>
                                        </td>                                            
				</tr>
				<?php //} ?>
				<tr>
					<td width="33%"></td>
					<td width="33%"><input type="submit" value="APLICAR FILTRO" class="botoes"/></td>
					<td width="33%"></td>
				</tr>

			</table>
			</td>
		</tr>
	</tbody>
</table>
          
<?php

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
	
	
    
		//]]>

</script>
SCRIPT;
echo $jscript;


?>
</div>

<?php
echo $form->end();

$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
	function submitForm(form) {
	/*
	usa método request() da classe Form da prototype, que serializa os campos
	do formulário e submete (por POST como default) para a action especificada no form
	*/
	var dados = Form.serialize($('InspecaoVersoForm'));
	var id = $('InspecaoId').value;
	new Ajax.Request('{$this->webroot}inspecaos/verso/', {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			
			 if (resultado.ok==0){
				alert('Registro não atualizado!');
			}else{
				//$(resultado.id).innerHTML = resultado.mensagem;
				alert('Registro atualizado!');
				location.reload(true);
							
			}
		}
				})
        
        
        return false;
    }
		
		//]]>

</script>
SCRIPT;
						echo $jscript;



						?>

<table cellpadding="0" cellspacing="0">
	<tr>	
		 <th><?php echo $paginator->sort('numero');?></th> 		
		 <th><?php echo $paginator->sort('organizacao');?></th> 		
		<th><?php echo $paginator->sort('tipo');?></th>
		<th><?php echo $paginator->sort('orgao');?></th>
		<th><?php echo $paginator->sort('item');?></th>
		<th><?php echo $paginator->sort('descricao');?></th>
		<th><?php echo $paginator->sort('meta');?></th>
<!-- <th><?php echo $paginator->sort('status_meta');?></th> -->		
		<th><?php echo $paginator->sort('gestor');?></th>
		<th><?php echo $paginator->sort('acao_recomendada');?></th>
		<th><?php echo $paginator->sort('obs_chf_d_o');?></th>
		<th><?php echo $paginator->sort('plano_acao_gestor');?></th>
		<th><?php echo $paginator->sort('acoes_executadas');?></th>
		<th><?php echo $paginator->sort('status');?></th>
		<th><?php echo $paginator->sort('prazo');?></th>
		<th><?php echo $paginator->sort('proxima_acao');?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($inspecaos as $inspecao):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	if($inspecao['Inspecao']['status']=='PENDENTE'){
		$td = ' style="background-color:#F0D0D0;" ';
	}else{
		$td='';
	}
	if(($inspecao['Inspecao']['plano_acao_gestor_status']=="MODIFICADO")||($inspecao['Inspecao']['acao_recomendada_status']=="MODIFICADO")||($inspecao['Inspecao']['acoes_executadas_status']=="MODIFICADO")){
		$td = ' style="background-color:#A0A0B0;" ';
	}

	?>
	<tr <?php echo $class;?> <?php echo $td;?>  id='<?php echo $inspecao['Inspecao']['id']; ?>'>
		<td <?php echo $td;?>><?php echo $inspecao['Inspecao']['numero']; ?></td>
		<td <?php echo $td;?>><?php echo $inspecao['Inspecao']['organizacao']; ?></td>
		<td <?php echo $td;?>><?php echo $inspecao['Inspecao']['tipo']; ?></td>
		<td <?php echo $td;?>><?php echo $inspecao['Inspecao']['orgao']; ?></td>
		<td <?php echo $td;?>><?php echo $inspecao['Inspecao']['item']; ?></td>
		<td <?php echo $td;?>><?php
				if(strlen($inspecao['Inspecao']['descricao'])>0){
			echo '<a  onclick="exibeDetalhes(\''.($inspecao['Inspecao']['descricao']).'\',\'Descrição\');" ><img border="0" style="cursor:hand;cursor:pointer;" src="img/despacho.gif"></a>';
		} 
		?>
		</td>
		<td <?php echo $td;?>><?php echo $inspecao['Inspecao']['meta']; ?></td>
<!-- <td <?php echo $td;?>><?php echo $inspecao['Inspecao']['status_meta']; ?> -->		
		</td>
		<td <?php echo $td;?>><?php echo $inspecao['Inspecao']['gestor']; ?></td>
		<td <?php echo $td;?>><?php 
		if(strlen($inspecao['Inspecao']['acao_recomendada'])>0){
			echo '<a  onclick="exibeDetalhes(\''.($inspecao['Inspecao']['acao_recomendada']).'\',\'Ação Recomendada\');" ><img border="0" style="cursor:hand;cursor:pointer;" src="img/despacho.gif"></a>';
		} 
		?>
		</td>
		<td <?php echo $td;?>><?php echo $inspecao['Inspecao']['obs_chf_d_o']; ?>
		</td>
		<td <?php echo $td;?>><?php 
		if(strlen($inspecao['Inspecao']['plano_acao_gestor'])>0){
			echo '<a  onclick="exibeDetalhes(\''.($inspecao['Inspecao']['plano_acao_gestor']).'\',\'Plano de ação do gestor\');" ><img border="0" style="cursor:hand;cursor:pointer;" src="img/despacho.gif"></a>';
		} 
		?>
		</td>
		<td <?php echo $td;?>><?php 
		if(strlen($inspecao['Inspecao']['acoes_executadas'])>0){
			echo '<a  onclick="exibeDetalhes(\''.($inspecao['Inspecao']['acoes_executadas']).'\',\'Ações executadas\');" ><img border="0" style="cursor:hand;cursor:pointer;" src="img/despacho.gif"></a>';
		} 
		?>
		</td>
		<td <?php echo $td;?>><?php echo $inspecao['Inspecao']['status']; ?></td>
		<td <?php echo $td;?>><?php echo $inspecao['Inspecao']['prazo']; ?></td>
		<td <?php echo $td;?>><?php echo $inspecao['Inspecao']['proxima_acao']; ?></td>
		<td class="actions" <?php echo $td;?>><?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $inspecao['Inspecao']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php //echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit', $inspecao['Inspecao']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
                    
		<?php
                $inspecao['Inspecao']['organizacao'] = strip_tags(removenl($inspecao['Inspecao']['organizacao']));
                $inspecao['Inspecao']['numero'] = strip_tags(removenl($inspecao['Inspecao']['numero']));
                $inspecao['Inspecao']['orgao'] = strip_tags(removenl($inspecao['Inspecao']['orgao']));
                $inspecao['Inspecao']['tipo'] = strip_tags(removenl($inspecao['Inspecao']['tipo']));
                $inspecao['Inspecao']['item'] = strip_tags(removenl($inspecao['Inspecao']['item']));
                $inspecao['Inspecao']['descricao'] = strip_tags(removenl($inspecao['Inspecao']['descricao']));
                $inspecao['Inspecao']['meta'] = strip_tags(removenl($inspecao['Inspecao']['meta']));
                $inspecao['Inspecao']['status_meta'] = strip_tags(removenl($inspecao['Inspecao']['status_meta']));
                $inspecao['Inspecao']['controle_oaple'] = strip_tags(removenl($inspecao['Inspecao']['controle_oaple']));
                $inspecao['Inspecao']['gestor'] = strip_tags(removenl($inspecao['Inspecao']['gestor']));
                $inspecao['Inspecao']['acao_recomendada'] = strip_tags(removenl($inspecao['Inspecao']['acao_recomendada']));
                $inspecao['Inspecao']['plano_acao_gestor'] = strip_tags(removenl($inspecao['Inspecao']['plano_acao_gestor']));
                $inspecao['Inspecao']['acoes_executadas'] = strip_tags(removenl($inspecao['Inspecao']['acoes_executadas']));
                $inspecao['Inspecao']['obs_chf_d_o'] = strip_tags(removenl($inspecao['Inspecao']['obs_chf_d_o']));
                $inspecao['Inspecao']['status'] = strip_tags(removenl($inspecao['Inspecao']['status']));
                $inspecao['Inspecao']['plano_acao_gestor_status'] = strip_tags(removenl($inspecao['Inspecao']['plano_acao_gestor_status']));
                $inspecao['Inspecao']['acoes_executadas_status'] = strip_tags(removenl($inspecao['Inspecao']['acoes_executadas_status']));
                $inspecao['Inspecao']['acao_recomendada_status'] = strip_tags(removenl($inspecao['Inspecao']['acao_recomendada_status']));
                $inspecao['Inspecao']['proxima_acao'] = strip_tags(removenl($inspecao['Inspecao']['proxima_acao']));
                $inspecao['Inspecao']['prazo_proxima_acao'] = strip_tags(removenl($inspecao['Inspecao']['prazo_proxima_acao']));
                
                echo $this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar','onclick'=>"exibe('{$inspecao['Inspecao']['id']}' ,'{$inspecao['Inspecao']['organizacao']}', '{$inspecao['Inspecao']['data']}', '{$inspecao['Inspecao']['numero']}', '{$inspecao['Inspecao']['orgao']}', '{$inspecao['Inspecao']['tipo']}', '{$inspecao['Inspecao']['item']}', '{$inspecao['Inspecao']['descricao']}', '{$inspecao['Inspecao']['meta']}', '{$inspecao['Inspecao']['status_meta']}', '{$inspecao['Inspecao']['controle_oaple']}', '{$inspecao['Inspecao']['gestor']}', '{$inspecao['Inspecao']['acao_recomendada']}', '{$inspecao['Inspecao']['plano_acao_gestor']}', '{$inspecao['Inspecao']['acoes_executadas']}', '{$inspecao['Inspecao']['obs_chf_d_o']}', '{$inspecao['Inspecao']['prazo']}', '{$inspecao['Inspecao']['status']}', '{$inspecao['Inspecao']['plano_acao_gestor_status']}', '{$inspecao['Inspecao']['acoes_executadas_status']}', '{$inspecao['Inspecao']['acao_recomendada_status']}', '{$inspecao['Inspecao']['proxima_acao']}', '{$inspecao['Inspecao']['prazo_proxima_acao']}');"));  ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$inspecao['Inspecao']['organizacao']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$inspecao['Inspecao']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);	?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
</div>
<div class="paging"><?php echo $paginator->prev('<< '.__('Anterior', true), array('onmouseover'=>"\$('buscaajax').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('buscaajax').submit();"), null, array('class'=>'disabled'));?>
| <?php echo $paginator->numbers(array('modulus'=>200,'onmouseover'=>"\$('buscaajax').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('buscaajax').submit();"));?>
	<?php echo $paginator->next(__('Próxima', true).' >>', array('onmouseover'=>"\$('buscaajax').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('buscaajax').submit();"), null, array('class'=>'disabled'));?>
</div>
<!-- overflow: auto;  -->
<div id="login" style="border-color: rgb(0, 0, 0); padding: 0px; z-index: 2; border: 3px solid #000000; position: absolute; top: 10%; left: 5%; height: auto; width: auto;">
<?php echo $form->create('Inspecao', array('action'=>'verso','onsubmit'=>'submitForm(this); return false;','type'=>'file'));?>
<table cellspacing="0" cellpadding="0" id="login" bgcolor="#ffffff">
	<tbody>
		<tr>
			<td valign="center" align="center"  bgcolor="#ffffff">
			<table cellspacing="0" cellpadding="0" id="logins" width="100%">
				<tr bgcolor="#8080f0">
					<th width="10%"><a href="#" id="btfechar">X</a></th>
					<th width="90%" align="center" colspan="2"><?php __('Modificar dados de Inspecao');?></th>
				</tr>
				<tr>
					<td width="33%"><?php echo $form->input('id'); ?>Organização:<input
						type="text" <?php echo $leitura;  ?> id="InspecaoOrigem" value=""
						maxlength="40" 0="0" class="formulario"
						name="data[Inspecao][organizacao]" /></td>
					<td width="33%">Número:<input type="text" <?php echo $leitura;  ?>
						id="InspecaoNumero" value="" maxlength="20"
						0="0" class="formulario" name="data[Inspecao][numero]" /></td>
					<td width="33%">Tipo:<input type="text" <?php echo $leitura;  ?>
						id="InspecaoTipo" value="" maxlength="30"  class="formulario"
						name="data[Inspecao][tipo]" /></td>
				</tr>
				<tr>
					<td width="33%">Data:<input type="text" <?php echo $leitura;  ?>
						id="InspecaoData" value="" 0="0" class="formulario"
						name="data[Inspecao][data]" /></td>
					<td width="33%">Órgão<input type="text" <?php echo $leitura;  ?>
						id="InspecaoOrgao" value="" maxlength="20"
						0="0" class="formulario" name="data[Inspecao][orgao]" /></td>
					<td width="33%">Item:<input type="text" <?php echo $leitura;  ?>
						id="InspecaoItem" value="" maxlength="30" class="formulario"
						name="data[Inspecao][item]" /></td>
				</tr>

				<tr>
					<td width="33%">Descricao:<br>
					<textarea id="InspecaoDescricao" <?php echo $leitura;  ?>
						class="formulario" rows="3" cols="20"
						name="data[Inspecao][descricao]" /></textarea></td>
					<td width="33%">Meta:<br>
					<input type="text" <?php echo $leitura;  ?> id="InspecaoMeta"
						value="" maxlength="10" class="formulario"
						name="data[Inspecao][meta]" /><br>
					Status Meta:<br>
					<input type="text" <?php echo $leitura;  ?> id="InspecaoStatusMeta"
						value="" maxlength="10" class="formulario"
						name="data[Inspecao][status_meta]" /><br>
					Controle Oaple:<br>
					<input type="text" <?php echo $leitura;  ?>
						id="InspecaoControleOaple" value="" maxlength="30"
						class="formulario" name="data[Inspecao][controle_oaple]" /></td>
					<td width="33%">Gestor:<br>
					<input type="text" <?php echo $leitura;  ?> id="InspecaoGestor"
						value="" maxlength="20" class="formulario"
						name="data[Inspecao][gestor]" /><br>
					Ação Recomendada:<br>
					<textarea id="InspecaoAcaoRecomendada" 
						class="formulario" rows="3" cols="20"
						name="data[Inspecao][acao_recomendada]"   onkeyup="muda('InspecaoAcaoRecomendadaStatus');"/></textarea>
					<div id="modificacao03">
					<br>
					<select id="InspecaoAcaoRecomendadaStatus" class="formulario" rows="3" cols="20"
						name="data[Inspecao][acao_recomendada_status]" ><option value="MODIFICADO">MODIFICADO</option><option value="LIDO" selected="selected">LIDO</option></select>
					</div>	
						</td>
				</tr>

				<tr>
					<td width="33%">Plano Ação Gestor:<br>
					<textarea id="InspecaoPlanoAcaoGestor" 
						class="formulario" rows="3" cols="20"
						name="data[Inspecao][plano_acao_gestor]" onkeyup="muda('InspecaoPlanoAcaoGestorStatus');" /></textarea>
					<div id="modificacao01" >
					<br>
					<select id="InspecaoPlanoAcaoGestorStatus" class="formulario" rows="3" cols="20"
						name="data[Inspecao][plano_acao_gestor_status]" ><option value="MODIFICADO">MODIFICADO</option><option value="LIDO" selected="selected">LIDO</option></select>
					</div>	
						</td>
					<td width="33%">Ações Executadas:<br>
					<textarea id="InspecaoAcoesExecutadas" 
						class="formulario" rows="3" cols="20"
						name="data[Inspecao][acoes_executadas]"  onkeyup="muda('InspecaoAcoesExecutadasStatus');" /></textarea>
					<div id="modificacao02">
					<br>
					<select id="InspecaoAcoesExecutadasStatus" class="formulario" rows="3" cols="20"
						name="data[Inspecao][acoes_executadas_status]" ><option value="MODIFICADO">MODIFICADO</option><option value="LIDO" selected="selected">LIDO</option></select>
					</div>	
						</td>
					<td width="33%">Obs Chf D O:<br>
					<textarea id="InspecaoObsChfDO" <?php echo $leitura;  ?>
						class="formulario" rows="3" cols="20"
						name="data[Inspecao][obs_chf_d_o]" /></textarea>
					<script type="text/javascript">
					<?php
					 if($privilegio==0){echo "\$('modificacao01').hide();\$('modificacao02').hide();\$('modificacao03').hide();"; } ?>
										</script>
						</td>
				</tr>

				<tr>
					<td width="33%">Prazo:<br>
					<input type="text" <?php echo $leitura;  ?> id="InspecaoPrazo"
						value="" maxlength="20" class="formulario"
						name="data[Inspecao][prazo]" /></td>
					<td width="33%">Status:<br>
										<?php
					if(empty($leitura)){
$selectstatus = '						
<select id="InspecaoStatus" name="data[Inspecao][status]">
<option value="CANCELADO">CANCELADO</option>
<option value="CANCELAMENTO SOLICITADO">CANCELAMENTO SOLICITADO</option>
<option value="CONCLUÍDO">CONCLUÍDO</option>
<option selected="selected" value="EM ANDAMENTO">EM ANDAMENTO</option>
</select>			
';			
						$opcoes['CANCELADO'] = 'CANCELADO';
						$opcoes['CANCELAMENTO SOLICITADO'] = 'CANCELAMENTO SOLICITADO';
						$opcoes['CONCLUÍDO'] = 'CONCLUÍDO';
						$opcoes['EM ANDAMENTO'] = 'EM ANDAMENTO';
						//echo $form->select('status', $opcoes ,'EM ANDAMENTO' ,array());
						echo $selectstatus;
						echo '<br>Valor Anterior:<div id="statusanterior"></div>';
						
						
					}else{ 
					?>
					
					<input type="text" <?php echo $leitura;  ?> id="InspecaoStatus"
						value="" maxlength="20" class="formulario"
						name="data[Inspecao][status]" />
					<?php
					}
					?>
					<input type="hidden" id="mouseY1" name="mouseY1" value="" >
					<input type="hidden" id="mouseX1" name="mouseX1" value="" >
					<input type="hidden" id="mouseY2" name="mouseY2" value="" >
					<input type="hidden" id="mouseX2" name="mouseX2" value="" >
					</td>
					<td   width="33%">Próxima Ação:<br>
					<textarea id="InspecaoProximaAcao" <?php echo $leitura;  ?>
						class="formulario" rows="3" cols="20"
						name="data[Inspecao][proxima_acao]" />						<br></textarea>
						Prazo da Próxima Ação:<br>
					<input type="text" <?php echo $leitura;  ?>
						id="InspecaoPrazoProximaAcao" value="" 0="0" class="formulario"
						name="data[Inspecao][prazo_proxima_acao]" /></td>
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
	<?php
	$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
function muda(id){
			var c = $(id);
			for (var i=0; i<c.options.length; i++){
			if (c.options[i].value == 'MODIFICADO'){
				c.options[i].selected = true;
				break;
			}
			}

}

function exibe(id, origem, data, numero, orgao, tipo, item, descricao, meta, status_meta, controle_oaple, gestor, acao_recomendada, plano_acao_gestor, acoes_executadas, obs_chf_d_o, prazo, status, status01, status02, status03, proximaacao, prazoproximaacao) {

$('InspecaoId').value = id;
$('InspecaoOrigem').value = decodeURIComponent(origem);
$('InspecaoData').value = decodeURIComponent(data);
$('InspecaoNumero').value = decodeURIComponent(numero);
$('InspecaoOrgao').value = decodeURIComponent(orgao);
$('InspecaoTipo').value = decodeURIComponent(tipo);
$('InspecaoItem').value = decodeURIComponent(item);
$('InspecaoDescricao').value = decodeURIComponent(descricao);
$('InspecaoMeta').value = decodeURIComponent(meta);
$('InspecaoControleOaple').value = decodeURIComponent(controle_oaple);
$('InspecaoGestor').value = decodeURIComponent(gestor);
$('InspecaoAcaoRecomendada').value = decodeURIComponent(acao_recomendada);
$('InspecaoPlanoAcaoGestor').value = decodeURIComponent(plano_acao_gestor);
$('InspecaoAcoesExecutadas').value = decodeURIComponent(acoes_executadas);
$('InspecaoObsChfDO').value = decodeURIComponent(obs_chf_d_o);
$('InspecaoPrazo').value = prazo;
$('InspecaoProximaAcao').value = decodeURIComponent(proximaacao);
$('InspecaoPrazoProximaAcao').value = decodeURIComponent(prazoproximaacao);
$('InspecaoStatusMeta').value = decodeURIComponent(status_meta);
$('InspecaoStatus').value = decodeURIComponent(status);

SCRIPT;

	
if(empty($leitura)){
$jscript3="


			$('statusanterior').innerHTML = decodeURIComponent(status);
			
			var c = $('InspecaoPlanoAcaoGestorStatus');
			for (var i=0; i<c.options.length; i++){
			if (c.options[i].value == decodeURIComponent(status01)){
				c.options[i].selected = true;
				break;
			}
			}
			var c = $('InspecaoAcaoRecomendadaStatus');
			for (var i=0; i<c.options.length; i++){
			if (c.options[i].value == decodeURIComponent(status03)){
				c.options[i].selected = true;
				break;
			}
			}
			var c = $('InspecaoAcoesExecutadasStatus');
			for (var i=0; i<c.options.length; i++){
			if (c.options[i].value == decodeURIComponent(status02)){
				c.options[i].selected = true;
				break;
			}
			}
			/*
			var c = $('InspecaoStatus');
			for (var i=0; i<c.options.length; i++){
			if (c.options[i].value == decodeURIComponent(status)){
				c.options[i].selected = true;
				break;
			}
			}
			*/
			";
}else{
	$jscript3 = '';
}

$jscript3 .= "
 ShowContent('login');
 
 }
 //]]>
</script>
";

echo $jscript.$jscript3;

?>
<?php
$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
 $('login').hide();
 $('filtro').hide();
 
 Event.observe(document.body,'mousemove',function(event){
    var objeto = document.viewport.getScrollOffsets();
 	$('mouseY1').value = objeto.top;
 	$('mouseX1').value = objeto.left;
     });
 
 Event.observe('btfechar','click',function(event){
    $('mouseY2').value = $('mouseY1').value;
    $('mouseX2').value = $('mouseX1').value;
 	$('login').hide();
     });
 

 
</script>
SCRIPT;

echo $jscript;
?>
<script type="text/javascript">
<!--
new Draggable('login');
//-->
</script>
<div style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 20%; border: 2px solid rgb(0, 0, 0); z-index: 1000" id="detalhes">
<p id="campo" style="padding:0px;height:20px;background-color: #a0abbc; color: #fff; margin: 0px; vertical-align: top;text-align:center; border: 2px; border-color: #000;"></p>
<p	style="margin: 0px; background-color: #ffff00; border: 1px solid #000;"><div id="detalhe"></div></p>
<script type="text/javascript">
<!--
new Draggable('detalhes');
//-->
</script>
</div>

<script type="text/javascript">
$('detalhes').hide();
HideContent('detalhes');HideContent('login');
</script>

<script type="text/javascript">
 new Draggable('filtro');
    
function exibeDetalhes(detalhes, campo) {
 	$('detalhe').innerHTML = unescape(detalhes);
 	var excluir = '<a style="float: right; margin: 0px;" href="javascript:HideContent(\'detalhes\');"	onclick="HideContent(\'detalhes\');" 	href="javascript:HideContent(\'detalhes\');"><img border="0" width="15"	height="15" title="Excluir" alt="Excluir" 	src="<?php echo $this->webroot; ?>img/lixo.gif" /> </a>';
 	$('campo').innerHTML = unescape(campo)+excluir;
 	ShowContent('detalhes');
}

</script>
