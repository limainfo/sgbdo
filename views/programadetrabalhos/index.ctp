



<div class="programadetrabalhos index">
	<h1><?php __('Programadetrabalhos');?>	&nbsp;<?php echo $this->Html->link($this->Html->image('broffice.png', array('alt'=> __('BROffice', true), 'border'=> '0', 'title'=>'Dados em planilha BROffice', 'onmouseover'=>"\$('busca').action='".$this->webroot."programadetrabalhos/indexExcel/';", 'onclick'=>'$("busca").submit();' )), '#', array('id'=>'broffice','escape'=>false), null,false); ?>	
    &nbsp;<?php echo $this->Html->link($this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'add', null),array('escape'=>false, 'escape'=>false), null,false); ?>	</h1>
	<?php echo $form->create('formFind', array('url' => 'index','type'=>'file','action' => 'index','controller' => 'programadetrabalhos','id'=>'busca','onsubmit'=>'sql();')); ?>	
	<h3>
	<?php
		echo $paginator->counter(array('format' => __('Página %page%/%pages%, exibindo %current% registro(s) de %count% total, registros de %start% até %end%', true)));?>	</h3>
	
	
<?php
		echo '<div class="input select" style="align:right;">Registros por página:<select id="FindPaginas" name="data[formFind][paginas]" class="formulario" onchange="$(\'busca\').submit();">';
		for($i=$min_registros;$i<=$max_registros;$i+=$passo){
		echo '<option value="'.$i.'">'.$i.'</option>';
		}
		echo '<option value="'.$paginator->counter(array('format' => __('%count%', true))).'">'.$paginator->counter(array('format' => __('%count%', true))).'</option>';
		if(!empty($this->data['formFind']['paginas'])){
			echo '<option value="'.$this->data['formFind']['paginas'].'" selected="selected">'.$this->data['formFind']['paginas'].'</option>';
		}
		echo '</select>&nbsp;&nbsp;&nbsp;<img border="0" onclick="ShowContent(\'filtro\');"  title="Filtrar Dados" alt="Filtro" src="'.$this->webroot.'img/filtro.gif"  onmouseover="$(\'busca\').action=\''.$this->webroot.'programadetrabalhos/index/\';"/></div>'; ?>
		
		
		

<div id="filtro"
	style="border-color: #000000; padding: 0px; z-index: 2; border: 3px solid #000000; position: fixed; top: 10%; left: 5%; overflow: auto; height: auto; width: auto;">
<table cellspacing="0" cellpadding="0" id="filtro">
	<tbody>
		<tr>
			<td valign="center" align="center"><?php 
			$nome = 'Programadetrabalho.';
			$alfanumerico = '<option value=" AND ('.$nome.'CCC LIKE \\\'||XXX||\\\') ">E - CONTENHA</option>';
			$alfanumerico .= '<option value=" AND ('.$nome.'CCC NOT LIKE \\\'||XXX||\\\') ">E - NÃO CONTENHA</option>';
			$alfanumerico .= '<option value=" AND ('.$nome.'CCC LIKE \\\'XXX||\\\') ">E - COMECE COM</option>';
			$alfanumerico .= '<option value=" AND ('.$nome.'CCC  LIKE \\\'||XXX\\\') ">E - TERMINE COM</option>';
			$alfanumerico .= '<option value=" OR ('.$nome.'CCC LIKE \\\'||XXX||\\\') ">OU - CONTENHA</option>';
			$alfanumerico .= '<option value=" OR ('.$nome.'CCC NOT LIKE \\\'||XXX||\\\') ">OU - NÃO CONTENHA</option>';
			$alfanumerico .= '<option value=" OR ('.$nome.'CCC LIKE \\\'XXX||\\\' ">OU - COMECE COM</option>';
			$alfanumerico .= '<option value=" OR ('.$nome.'CCC LIKE \\\'||XXX\\\' ">OU - TERMINE COM</option>';
			
			
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
			
			$bol = '<option value=" AND ('.$nome.'ativa=1) "></option>';
			$bol .= '<option value=" AND ('.$nome.'ativa=1) ">SIM</option>';
			$bol .= '<option value=" AND ('.$nome.'ativa=0) ">NÃO</option>';
			
			$tipos = '';
			$conta = 0;
			$campo = '<option value=""></option>';
			foreach($esquema as $campos=>$vetor){
				$conta++;
				$campo .= '<option value="'.$campos.'">'.$campos.'</option>'; 
				switch($campos){
					default: 
						$tipos .= '<input type="hidden" id="tipo'.$conta.'" value="'.$vetor['type'].'" name="data[Tipo][]" />';
									 
				}
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
						name="data[filtro][]" onchange="if($('filtro<?php echo $qtd; ?>').value=='SIM'){$('valor<?php echo $qtd; ?>').value=1;preencheSQL(<?php echo $qtd; ?>);}else{$('valor<?php echo $qtd; ?>').value=1;preencheSQL(<?php echo $qtd; ?>);}" class="formulario">
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
					<td colspan="3" style="background-color:#ff2020;font-weight:bold;height:40px;padding:10px;">CAMPOS NÃO DEVEM POSSUIR ACENTOS.</td>
				</tr>
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
   if(spantemp.style){
    for(var y in spantemp.style){
     try{opt.style[y] = spantemp.style[y];}catch(e){}
    }
   }
   opt.value = spantemp.getAttribute("value")
   opt.text = spantemp.innerHTML
   opt.selected = spantemp.getAttribute('selected');
   opt.className = spantemp.className;
  } 
 }    
 document.body.removeChild(selTemp)
 selTemp = null
}

function preencheFiltro(ordem) {
	var numero = '$numerico';
	var literal = '$alfanumerico';
	var data = '$data';
	var boleano = '$bol';
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
	if((tipo=='boolean')){
		select_innerHTML(filtro,boleano);
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
	valorCampo = valorCampo.replace('/',']]]');
	
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
		<?php echo $form->end(); ?>


	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('meta_decea');?></th>
			<th><?php echo $this->Paginator->sort('origem');?></th>
			<th><?php echo $this->Paginator->sort('stat');?></th>
			<th><?php echo $this->Paginator->sort('meta_unidade');?></th>
			<th><?php echo $this->Paginator->sort('etapa_unidade');?></th>
			<th><?php echo $this->Paginator->sort('descricao_meta_geral');?></th>
			<th><?php echo $this->Paginator->sort('descricao_etapa_especifica');?></th>
			<th><?php echo $this->Paginator->sort('descricao_meta_div_oper');?></th>
			<th><?php echo $this->Paginator->sort('projeto_basico');?></th>
			<th><?php echo $this->Paginator->sort('naj');?></th>
			<th><?php echo $this->Paginator->sort('pam');?></th>
			<th><?php echo $this->Paginator->sort('pag');?></th>
			<th><?php echo $this->Paginator->sort('licitacao');?></th>
			<th><?php echo $this->Paginator->sort('divisao_responsavel');?></th>
			<th><?php echo $this->Paginator->sort('setor_responsavel');?></th>
			<th><?php echo $this->Paginator->sort('ed14');?></th>
			<th><?php echo $this->Paginator->sort('ed15');?></th>
			<th><?php echo $this->Paginator->sort('ed30');?></th>
			<th><?php echo $this->Paginator->sort('ed39');?></th>
			<th><?php echo $this->Paginator->sort('ed39spub');?></th>
			<th><?php echo $this->Paginator->sort('ed39can');?></th>
			<th><?php echo $this->Paginator->sort('ed51');?></th>
			<th><?php echo $this->Paginator->sort('ed52');?></th>
			<th><?php echo $this->Paginator->sort('total_meta');?></th>
			<th><?php echo $this->Paginator->sort('providencia');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($programadetrabalhos as $programadetrabalho):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $programadetrabalho['Programadetrabalho']['id']; ?>&nbsp;</td>
		<td><?php echo $programadetrabalho['Programadetrabalho']['meta_decea']; ?>&nbsp;</td>
		<td><?php echo $programadetrabalho['Programadetrabalho']['origem']; ?>&nbsp;</td>
		<td><?php echo $programadetrabalho['Programadetrabalho']['stat']; ?>&nbsp;</td>
		<td><?php echo $programadetrabalho['Programadetrabalho']['meta_unidade']; ?>&nbsp;</td>
		<td><?php echo $programadetrabalho['Programadetrabalho']['etapa_unidade']; ?>&nbsp;</td>
		<td><?php echo $programadetrabalho['Programadetrabalho']['descricao_meta_geral']; ?>&nbsp;</td>
		<td><?php echo $programadetrabalho['Programadetrabalho']['descricao_etapa_especifica']; ?>&nbsp;</td>
		<td><?php echo $programadetrabalho['Programadetrabalho']['descricao_meta_div_oper']; ?>&nbsp;</td>
		<td><?php echo $programadetrabalho['Programadetrabalho']['projeto_basico']; ?>&nbsp;</td>
		<td><?php echo $programadetrabalho['Programadetrabalho']['naj']; ?>&nbsp;</td>
		<td><?php echo $programadetrabalho['Programadetrabalho']['pam']; ?>&nbsp;</td>
		<td><?php echo $programadetrabalho['Programadetrabalho']['pag']; ?>&nbsp;</td>
		<td><?php echo $programadetrabalho['Programadetrabalho']['licitacao']; ?>&nbsp;</td>
		<td><?php echo $programadetrabalho['Programadetrabalho']['divisao_responsavel']; ?>&nbsp;</td>
		<td><?php echo $programadetrabalho['Programadetrabalho']['setor_responsavel']; ?>&nbsp;</td>
		<td><?php echo $programadetrabalho['Programadetrabalho']['ed14']; ?>&nbsp;</td>
		<td><?php echo $programadetrabalho['Programadetrabalho']['ed15']; ?>&nbsp;</td>
		<td><?php echo $programadetrabalho['Programadetrabalho']['ed30']; ?>&nbsp;</td>
		<td><?php echo $programadetrabalho['Programadetrabalho']['ed39']; ?>&nbsp;</td>
		<td><?php echo $programadetrabalho['Programadetrabalho']['ed39spub']; ?>&nbsp;</td>
		<td><?php echo $programadetrabalho['Programadetrabalho']['ed39can']; ?>&nbsp;</td>
		<td><?php echo $programadetrabalho['Programadetrabalho']['ed51']; ?>&nbsp;</td>
		<td><?php echo $programadetrabalho['Programadetrabalho']['ed52']; ?>&nbsp;</td>
		<td><?php echo $programadetrabalho['Programadetrabalho']['total_meta']; ?>&nbsp;</td>
		<td><?php echo $programadetrabalho['Programadetrabalho']['providencia']; ?>&nbsp;</td>
		<td><?php echo $programadetrabalho['Programadetrabalho']['status']; ?>&nbsp;</td>
		<td class="actions">

		<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $programadetrabalho['Programadetrabalho']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>

		<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit', $programadetrabalho['Programadetrabalho']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>

		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$programadetrabalho['Programadetrabalho']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$programadetrabalho['Programadetrabalho']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false); ?>

				</td>
	</tr>
<?php endforeach; ?>
	</table>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('Anterior', true), array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers(array('modulus'=>200,'onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"));?>
 |
		<?php echo $this->Paginator->next(__('Próxima', true) . ' >>', array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class' => 'disabled'));?>
	</div>

	
</div>
<script type="text/javascript">
<!--
new Draggable('filtro');
HideContent('filtro');
//-->
</script>
