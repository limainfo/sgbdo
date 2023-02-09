<?php
include('../views/funcoes_henrique.ctp');
?>
<div class="habilitacaos index">
<h1><?php 
__($total.' Habilitações');
?>
&nbsp;<?php echo $this->Html->link($this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'add', null),array('escape'=>false, 'escape'=>false), null,false); ?>
</h1>
	<?php echo $form->create('formFind', array('url' => 'index','type'=>'file','action' => 'index','controller' => 'habilitacaos','id'=>'busca','onsubmit'=>'sql();')); ?>	
	
<?php
		echo '<div class="input select" style="align:right;">';
		echo '&nbsp;&nbsp;&nbsp;<img border="0" onclick="ShowContent(\'filtro\');"  title="Filtrar Dados" alt="Filtro" src="'.$this->webroot.'img/filtro.gif"  onmouseover="$(\'busca\').action=\''.$this->webroot.'habilitacaos/index/\';"/></div>'; ?>
		
		
		

<div id="filtro"
	style="border-color: #000000; padding: 0px; z-index: 2; border: 3px solid #000000; position: fixed; top: 10%; left: 5%; overflow: auto; height: auto; width: auto;">
<table cellspacing="0" cellpadding="0" id="filtro">
	<tbody>
		<tr>
			<td valign="center" align="center"><?php 
			$nome = 'Habilitacao.';
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
			
			$militar = '<option value=" AND (Militar.nm_completo LIKE \\\'||XXX||\\\') ">E - CONTENHA</option>';
			$militar .= '<option value=" AND (Militar.nm_completo NOT LIKE \\\'||XXX||\\\') ">E - NÃO CONTENHA</option>';
			$militar .= '<option value=" AND (Militar.nm_completo LIKE \\\'XXX||\\\') ">E - COMECE COM</option>';
			$militar .= '<option value=" AND (Militar.nm_completo  LIKE \\\'||XXX\\\') ">E - TERMINE COM</option>';
			$militar .= '<option value=" OR (Militar.nm_completo LIKE \\\'||XXX||\\\') ">OU - CONTENHA</option>';
			$militar .= '<option value=" OR (Militar.nm_completo NOT LIKE \\\'||XXX||\\\') ">OU - NÃO CONTENHA</option>';
			$militar .= '<option value=" OR (Militar.nm_completo LIKE \\\'XXX||\\\' ">OU - COMECE COM</option>';
			$militar .= '<option value=" OR (Militar.nm_completo LIKE \\\'||XXX\\\' ">OU - TERMINE COM</option>';
			
			$ata = '<option value=" AND (Ata.numero LIKE \\\'||XXX||\\\') ">E - CONTENHA</option>';
			$ata .= '<option value=" AND (Ata.numero NOT LIKE \\\'||XXX||\\\') ">E - NÃO CONTENHA</option>';
			$ata .= '<option value=" AND (Ata.numero LIKE \\\'XXX||\\\') ">E - COMECE COM</option>';
			$ata .= '<option value=" AND (Ata.numero  LIKE \\\'||XXX\\\') ">E - TERMINE COM</option>';
			$ata .= '<option value=" OR (Ata.numero LIKE \\\'||XXX||\\\') ">OU - CONTENHA</option>';
			$ata .= '<option value=" OR (Ata.numero NOT LIKE \\\'||XXX||\\\') ">OU - NÃO CONTENHA</option>';
			$ata .= '<option value=" OR (Ata.numero LIKE \\\'XXX||\\\' ">OU - COMECE COM</option>';
			$ata .= '<option value=" OR (Ata.numero LIKE \\\'||XXX\\\' ">OU - TERMINE COM</option>';
			
			$boletim = '<option value=" AND (Boletiminterno.numero LIKE \\\'||XXX||\\\') ">E - CONTENHA</option>';
			$boletim .= '<option value=" AND (Boletiminterno.numero NOT LIKE \\\'||XXX||\\\') ">E - NÃO CONTENHA</option>';
			$boletim .= '<option value=" AND (Boletiminterno.numero LIKE \\\'XXX||\\\') ">E - COMECE COM</option>';
			$boletim .= '<option value=" AND (Boletiminterno.numero  LIKE \\\'||XXX\\\') ">E - TERMINE COM</option>';
			$boletim .= '<option value=" OR (Boletiminterno.numero LIKE \\\'||XXX||\\\') ">OU - CONTENHA</option>';
			$boletim .= '<option value=" OR (Boletiminterno.numero NOT LIKE \\\'||XXX||\\\') ">OU - NÃO CONTENHA</option>';
			$boletim .= '<option value=" OR (Boletiminterno.numero LIKE \\\'XXX||\\\' ">OU - COMECE COM</option>';
			$boletim .= '<option value=" OR (Boletiminterno.numero LIKE \\\'||XXX\\\' ">OU - TERMINE COM</option>';
			
			
			$tipos = '';
			$conta = 0;
			$campo = '<option value=""></option>';
			
			
			foreach($esquema as $campos=>$vetor){
				$conta++;
				$campo .= '<option value="'.$campos.'">'.$campos.'</option>'; 
				switch($campos){
					case 'militar_id': 
						$tipos .= '<input type="hidden" id="tipo'.$conta.'" value="militar_id" name="data[Tipo][]" />';
						break;
					case 'ata_id': 
						$tipos .= '<input type="hidden" id="tipo'.$conta.'" value="ata_id" name="data[Tipo][]" />';
						break;
					case 'boletim_id': 
						$tipos .= '<input type="hidden" id="tipo'.$conta.'" value="boletim_id" name="data[Tipo][]" />';
						break;
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
	var militar = '$militar';
	var ata = '$ata';
	var boletim = '$boletim';
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
	if((tipo=='militar_id')){
		select_innerHTML(filtro,militar);
	}	
	if((tipo=='ata_id')){
		select_innerHTML(filtro,ata);
	}	
	if((tipo=='boletiminterno_id')){
		select_innerHTML(filtro,boletim);
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
<?php
echo $form->end(); 
Menu_Barra('grupo01','relatorio01',count($habilitacaosvencidas).' HABILITAÇÕES VENCIDAS',0);
?>
<table cellpadding="0" cellspacing="0" id="relatorio01" style="align:center;" width="100%" >
	<tr>
		<th><?php echo ('militar_id');?></th>
		<th><?php //echo $paginator->sort('cht_anterior');?></th>
		<th><?php echo ('cht');?></th>
		<th><?php //echo $paginator->sort('validade_cht_anterior');?></th>
		<th><?php echo ('validade_cht');?></th>
		<th><?php echo ('funcao');?></th>
		<th><?php //echo $paginator->sort('setor');?></th>
		<th><?php //echo $paginator->sort('dt_designacao');?></th>
		<th><?php echo ('localidade');?></th>
		<th><?php echo ('dt_concessao');?></th>
		<th><?php echo ('dt_suspensao');?></th>
		<th><?php echo ('dt_perda');?></th>
		<th><?php echo ('nome_emitente');?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
	$i = 0;
	foreach($habilitacaosvencidas as $habilitacao){
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	?>
	<tr <?php echo $class;?>>
		<td><?php echo $this->Html->link($habilitacao['Militar']['Posto']['sigla_posto'].' '.$habilitacao['Militar']['Especialidade']['nm_especialidade'].' '.$habilitacao['Militar']['nm_completo'], array('controller'=> 'militars', 'action'=>'view', $habilitacao['Militar']['id'])); ?>
		</td>
		<td><?php //echo $habilitacao['Habilitacao']['cht_anterior']; ?></td>
		<td><?php echo $habilitacao['Habilitacao']['cht']; ?></td>
		<td><?php //echo $habilitacao['Habilitacao']['validade_cht_anterior']; ?>
		</td>
		<td><?php echo (empty($habilitacao['Habilitacao']['validade_cht']))?  '':date('d-m-Y',strtotime($habilitacao['Habilitacao']['validade_cht'])); ?></td>
		<td><?php echo $habilitacao['Habilitacao']['funcao']; ?></td>
		<td><?php //echo $habilitacao['Habilitacao']['setor']; ?></td>
		<td><?php //echo $habilitacao['Habilitacao']['dt_designacao']; ?></td>
		<td><?php echo $habilitacao['Habilitacao']['localidade']; ?>
		<td><?php echo (empty($habilitacao['Habilitacao']['dt_concessao']))?  '':date('d-m-Y',strtotime($habilitacao['Habilitacao']['dt_concessao'])); ?>
		<td><?php echo (empty($habilitacao['Habilitacao']['dt_suspensao']))?  '':date('d-m-Y',strtotime($habilitacao['Habilitacao']['dt_suspensao'])); ?>
		<td><?php echo (empty($habilitacao['Habilitacao']['dt_perda']))?  '':date('d-m-Y',strtotime($habilitacao['Habilitacao']['dt_perda'])); ?>
		</td>
		<td><?php echo $habilitacao['Habilitacao']['nome_emitente']; ?></td>
		<td class="actions"><?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $habilitacao['Habilitacao']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit', $habilitacao['Habilitacao']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$habilitacao['Habilitacao']['cht_atual']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$habilitacao['Habilitacao']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('pdf2.gif', array('alt'=> __('PDF', true), 'border'=> '0', 'title'=>'PDF')), array('action'=>'indexPdf', $habilitacao['Habilitacao']['id']), array('escape'=>false), null,false); ?>
                    <?php echo $this->Html->link($this->Html->image('revalidar.gif', array('alt'=> __('Revalidar', true), 'border'=> '0', 'title'=>'Revalidar')), array('action'=>'externoRevalidar', $habilitacao['Habilitacao']['id']), array('escape'=>false), null,false); ?>
		</td>
	</tr>
	<?php } ?>
</table>
</div>
<hr>
<?php
Menu_Barra('grupo02','relatorio02',count($habilitacaos1mes).' HABILITAÇÕES DENTRO DO PRAZO DE 30 DIAS',0);
?>	
<table cellpadding="0" cellspacing="0" id="relatorio02" style="align:center;" width="100%" >
	<tr>
		<th><?php echo ('militar_id');?></th>
		<th><?php //echo $paginator->sort('cht_anterior');?></th>
		<th><?php echo ('cht');?></th>
		<th><?php //echo $paginator->sort('validade_cht_anterior');?></th>
		<th><?php echo ('validade_cht');?></th>
		<th><?php echo ('funcao');?></th>
		<th><?php //echo $paginator->sort('setor');?></th>
		<th><?php //echo $paginator->sort('dt_designacao');?></th>
		<th><?php echo ('localidade');?></th>
		<th><?php echo ('dt_concessao');?></th>
		<th><?php echo ('dt_suspensao');?></th>
		<th><?php echo ('dt_perda');?></th>
		<th><?php echo ('nome_emitente');?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
	$i = 0;
	foreach($habilitacaos1mes as $habilitacao){
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	?>
	<tr <?php echo $class;?>>
		<td><?php echo $this->Html->link($habilitacao['Militar']['Posto']['sigla_posto'].' '.$habilitacao['Militar']['Especialidade']['nm_especialidade'].' '.$habilitacao['Militar']['nm_completo'], array('controller'=> 'militars', 'action'=>'view', $habilitacao['Militar']['id'])); ?>
		</td>
		<td><?php //echo $habilitacao['Habilitacao']['cht_anterior']; ?></td>
		<td><?php echo $habilitacao['Habilitacao']['cht']; ?></td>
		<td><?php //echo $habilitacao['Habilitacao']['validade_cht_anterior']; ?>
		</td>
		<td><?php echo (empty($habilitacao['Habilitacao']['validade_cht']))?  '':date('d-m-Y',strtotime($habilitacao['Habilitacao']['validade_cht'])); ?></td>
		<td><?php echo $habilitacao['Habilitacao']['funcao']; ?></td>
		<td><?php //echo $habilitacao['Habilitacao']['setor']; ?></td>
		<td><?php //echo $habilitacao['Habilitacao']['dt_designacao']; ?></td>
		<td><?php echo $habilitacao['Habilitacao']['localidade']; ?>
		<td><?php echo (empty($habilitacao['Habilitacao']['dt_concessao']))?  '':date('d-m-Y',strtotime($habilitacao['Habilitacao']['dt_concessao'])); ?>
		<td><?php echo (empty($habilitacao['Habilitacao']['dt_suspensao']))?  '':date('d-m-Y',strtotime($habilitacao['Habilitacao']['dt_suspensao'])); ?>
		<td><?php echo (empty($habilitacao['Habilitacao']['dt_perda']))?  '':date('d-m-Y',strtotime($habilitacao['Habilitacao']['dt_perda'])); ?>
		</td>
		<td><?php echo $habilitacao['Habilitacao']['nome_emitente']; ?></td>
		<td class="actions"><?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $habilitacao['Habilitacao']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit', $habilitacao['Habilitacao']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$habilitacao['Habilitacao']['cht_atual']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$habilitacao['Habilitacao']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('pdf2.gif', array('alt'=> __('PDF', true), 'border'=> '0', 'title'=>'PDF')), array('action'=>'indexPdf', $habilitacao['Habilitacao']['id']), array('escape'=>false), null,false); ?>
                <?php echo $this->Html->link($this->Html->image('revalidar.gif', array('alt'=> __('Revalidar', true), 'border'=> '0', 'title'=>'Revalidar')), array('action'=>'externoRevalidar', $habilitacao['Habilitacao']['id']), array('escape'=>false), null,false); ?>
		</td>
	</tr>
	<?php } ?>
</table>
</div>
<hr>
<?php
Menu_Barra('grupo03','relatorio03',count($habilitacaos2meses).' HABILITAÇÕES ENTRE 30 E 60 DIAS',0);
?>		
<table cellpadding="0" cellspacing="0" id="relatorio03" style="align:center;" width="100%" >
	<tr>
		<th><?php echo ('militar_id');?></th>
		<th><?php //echo $paginator->sort('cht_anterior');?></th>
		<th><?php echo ('cht');?></th>
		<th><?php //echo $paginator->sort('validade_cht_anterior');?></th>
		<th><?php echo ('validade_cht');?></th>
		<th><?php echo ('funcao');?></th>
		<th><?php //echo $paginator->sort('setor');?></th>
		<th><?php //echo $paginator->sort('dt_designacao');?></th>
		<th><?php echo ('localidade');?></th>
		<th><?php echo ('dt_concessao');?></th>
		<th><?php echo ('dt_suspensao');?></th>
		<th><?php echo ('dt_perda');?></th>
		<th><?php echo ('nome_emitente');?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
	$i = 0;
	foreach($habilitacaos2meses as $habilitacao){
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	?>
	<tr <?php echo $class;?>>
		<td><?php echo $this->Html->link($habilitacao['Militar']['Posto']['sigla_posto'].' '.$habilitacao['Militar']['Especialidade']['nm_especialidade'].' '.$habilitacao['Militar']['nm_completo'], array('controller'=> 'militars', 'action'=>'view', $habilitacao['Militar']['id'])); ?>
		</td>
		<td><?php //echo $habilitacao['Habilitacao']['cht_anterior']; ?></td>
		<td><?php echo $habilitacao['Habilitacao']['cht']; ?></td>
		<td><?php //echo $habilitacao['Habilitacao']['validade_cht_anterior']; ?>
		</td>
		<td><?php echo (empty($habilitacao['Habilitacao']['validade_cht']))?  '':date('d-m-Y',strtotime($habilitacao['Habilitacao']['validade_cht'])); ?></td>
		<td><?php echo $habilitacao['Habilitacao']['funcao']; ?></td>
		<td><?php //echo $habilitacao['Habilitacao']['setor']; ?></td>
		<td><?php //echo $habilitacao['Habilitacao']['dt_designacao']; ?></td>
		<td><?php echo $habilitacao['Habilitacao']['localidade']; ?>
		<td><?php echo (empty($habilitacao['Habilitacao']['dt_concessao']))?  '':date('d-m-Y',strtotime($habilitacao['Habilitacao']['dt_concessao'])); ?>
		<td><?php echo (empty($habilitacao['Habilitacao']['dt_suspensao']))?  '':date('d-m-Y',strtotime($habilitacao['Habilitacao']['dt_suspensao'])); ?>
		<td><?php echo (empty($habilitacao['Habilitacao']['dt_perda']))?  '':date('d-m-Y',strtotime($habilitacao['Habilitacao']['dt_perda'])); ?>
		</td>
		<td><?php echo $habilitacao['Habilitacao']['nome_emitente']; ?></td>
		<td class="actions"><?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $habilitacao['Habilitacao']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit', $habilitacao['Habilitacao']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$habilitacao['Habilitacao']['cht_atual']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$habilitacao['Habilitacao']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('pdf2.gif', array('alt'=> __('PDF', true), 'border'=> '0', 'title'=>'PDF')), array('action'=>'indexPdf', $habilitacao['Habilitacao']['id']), array('escape'=>false), null,false); ?>
                    <?php echo $this->Html->link($this->Html->image('revalidar.gif', array('alt'=> __('Revalidar', true), 'border'=> '0', 'title'=>'Revalidar')), array('action'=>'externoRevalidar', $habilitacao['Habilitacao']['id']), array('escape'=>false), null,false); ?>
		</td>
	</tr>
	<?php } ?>
</table>
</div>
<hr>
<?php
Menu_Barra('grupo04','relatorio04',count($habilitacaossuspensas).' HABILITAÇÕES SUSPENSAS',0);
?>		
<table cellpadding="0" cellspacing="0" id="relatorio04" style="align:center;" width="100%" >
	<tr>
		<th><?php echo ('militar_id');?></th>
		<th><?php //echo $paginator->sort('cht_anterior');?></th>
		<th><?php echo ('cht');?></th>
		<th><?php //echo $paginator->sort('validade_cht_anterior');?></th>
		<th><?php echo ('validade_cht');?></th>
		<th><?php echo ('funcao');?></th>
		<th><?php //echo $paginator->sort('setor');?></th>
		<th><?php //echo $paginator->sort('dt_designacao');?></th>
		<th><?php echo ('localidade');?></th>
		<th><?php echo ('dt_concessao');?></th>
		<th><?php echo ('dt_suspensao');?></th>
		<th><?php echo ('dt_perda');?></th>
		<th><?php echo ('nome_emitente');?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
	$i = 0;
	foreach($habilitacaossuspensas as $habilitacao){
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	?>
	<tr <?php echo $class;?>>
		<td><?php echo $this->Html->link($habilitacao['Militar']['Posto']['sigla_posto'].' '.$habilitacao['Militar']['Especialidade']['nm_especialidade'].' '.$habilitacao['Militar']['nm_completo'], array('controller'=> 'militars', 'action'=>'view', $habilitacao['Militar']['id'])); ?>
		</td>
		<td><?php //echo $habilitacao['Habilitacao']['cht_anterior']; ?></td>
		<td><?php echo $habilitacao['Habilitacao']['cht']; ?></td>
		<td><?php //echo $habilitacao['Habilitacao']['validade_cht_anterior']; ?>
		</td>
		<td><?php echo (empty($habilitacao['Habilitacao']['validade_cht']))?  '':date('d-m-Y',strtotime($habilitacao['Habilitacao']['validade_cht'])); ?></td>
		<td><?php echo $habilitacao['Habilitacao']['funcao']; ?></td>
		<td><?php //echo $habilitacao['Habilitacao']['setor']; ?></td>
		<td><?php //echo $habilitacao['Habilitacao']['dt_designacao']; ?></td>
		<td><?php echo $habilitacao['Habilitacao']['localidade']; ?>
		<td><?php echo (empty($habilitacao['Habilitacao']['dt_concessao']))?  '':date('d-m-Y',strtotime($habilitacao['Habilitacao']['dt_concessao'])); ?>
		<td><?php echo (empty($habilitacao['Habilitacao']['dt_suspensao']))?  '':date('d-m-Y',strtotime($habilitacao['Habilitacao']['dt_suspensao'])); ?>
		<td><?php echo (empty($habilitacao['Habilitacao']['dt_perda']))?  '':date('d-m-Y',strtotime($habilitacao['Habilitacao']['dt_perda'])); ?>
		</td>
		<td><?php echo $habilitacao['Habilitacao']['nome_emitente']; ?></td>
		<td class="actions"><?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $habilitacao['Habilitacao']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit', $habilitacao['Habilitacao']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$habilitacao['Habilitacao']['cht_atual']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$habilitacao['Habilitacao']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);  ?>
		<?php echo $this->Html->link($this->Html->image('pdf2.gif', array('alt'=> __('PDF', true), 'border'=> '0', 'title'=>'PDF')), array('action'=>'indexPdf', $habilitacao['Habilitacao']['id']), array('escape'=>false), null,false); ?>
                    <?php echo $this->Html->link($this->Html->image('revalidar.gif', array('alt'=> __('Revalidar', true), 'border'=> '0', 'title'=>'Revalidar')), array('action'=>'externoRevalidar', $habilitacao['Habilitacao']['id']), array('escape'=>false), null,false); ?>
		</td>
	</tr>
	<?php } ?>
</table>
</div>
<hr>
<?php
Menu_Barra('grupo05','relatorio05',count($habilitacaosperdas).' HABILITAÇÕES PERDIDAS',0);
?>
<table cellpadding="0" cellspacing="0" id="relatorio05" style="align:center;" width="100%" >
	<tr>
		<th><?php echo ('militar_id');?></th>
		<th><?php //echo $paginator->sort('cht_anterior');?></th>
		<th><?php echo ('cht');?></th>
		<th><?php //echo $paginator->sort('validade_cht_anterior');?></th>
		<th><?php echo ('validade_cht');?></th>
		<th><?php echo ('funcao');?></th>
		<th><?php //echo $paginator->sort('setor');?></th>
		<th><?php //echo $paginator->sort('dt_designacao');?></th>
		<th><?php echo ('localidade');?></th>
		<th><?php echo ('dt_concessao');?></th>
		<th><?php echo ('dt_suspensao');?></th>
		<th><?php echo ('dt_perda');?></th>
		<th><?php echo ('nome_emitente');?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
	$i = 0;
	foreach($habilitacaosperdas as $habilitacao){
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	?>
	<tr <?php echo $class;?>>
		<td><?php echo $this->Html->link($habilitacao['Militar']['Posto']['sigla_posto'].' '.$habilitacao['Militar']['Especialidade']['nm_especialidade'].' '.$habilitacao['Militar']['nm_completo'], array('controller'=> 'militars', 'action'=>'view', $habilitacao['Militar']['id'])); ?>
		</td>
		<td><?php //echo $habilitacao['Habilitacao']['cht_anterior']; ?></td>
		<td><?php echo $habilitacao['Habilitacao']['cht']; ?></td>
		<td><?php //echo $habilitacao['Habilitacao']['validade_cht_anterior']; ?>
		</td>
		<td><?php echo (empty($habilitacao['Habilitacao']['validade_cht']))?  '':date('d-m-Y',strtotime($habilitacao['Habilitacao']['validade_cht'])); ?></td>
		<td><?php echo $habilitacao['Habilitacao']['funcao']; ?></td>
		<td><?php //echo $habilitacao['Habilitacao']['setor']; ?></td>
		<td><?php //echo $habilitacao['Habilitacao']['dt_designacao']; ?></td>
		<td><?php echo $habilitacao['Habilitacao']['localidade']; ?>
		<td><?php echo (empty($habilitacao['Habilitacao']['dt_concessao']))?  '':date('d-m-Y',strtotime($habilitacao['Habilitacao']['dt_concessao'])); ?>
		<td><?php echo (empty($habilitacao['Habilitacao']['dt_suspensao']))?  '':date('d-m-Y',strtotime($habilitacao['Habilitacao']['dt_suspensao'])); ?>
		<td><?php echo (empty($habilitacao['Habilitacao']['dt_perda']))?  '':date('d-m-Y',strtotime($habilitacao['Habilitacao']['dt_perda'])); ?>
		</td>
		<td><?php echo $habilitacao['Habilitacao']['nome_emitente']; ?></td>
		<td class="actions"><?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $habilitacao['Habilitacao']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit', $habilitacao['Habilitacao']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$habilitacao['Habilitacao']['cht_atual']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$habilitacao['Habilitacao']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('pdf2.gif', array('alt'=> __('PDF', true), 'border'=> '0', 'title'=>'PDF')), array('action'=>'indexPdf', $habilitacao['Habilitacao']['id']), array('escape'=>false), null,false); ?>
                    <?php echo $this->Html->link($this->Html->image('revalidar.gif', array('alt'=> __('Revalidar', true), 'border'=> '0', 'title'=>'Revalidar')), array('action'=>'externoRevalidar', $habilitacao['Habilitacao']['id']), array('escape'=>false), null,false); ?>
		</td>
	</tr>
	<?php } ?>
</table>
</div>
<hr>
<?php
Menu_Barra('grupo06','relatorio06',count($habilitacaosconsultadas).' HABILITAÇÕES CONSULTADAS',0);
?>	
<table cellpadding="0" cellspacing="0" id="relatorio06" style="align:center;" width="100%" >
	<tr>
		<th><?php echo ('militar_id');?></th>
		<th><?php //echo $paginator->sort('cht_anterior');?></th>
		<th><?php echo ('cht');?></th>
		<th><?php //echo $paginator->sort('validade_cht_anterior');?></th>
		<th><?php echo ('validade_cht');?></th>
		<th><?php echo ('funcao');?></th>
		<th><?php //echo $paginator->sort('setor');?></th>
		<th><?php //echo $paginator->sort('dt_designacao');?></th>
		<th><?php echo ('localidade');?></th>
		<th><?php echo ('dt_concessao');?></th>
		<th><?php echo ('dt_suspensao');?></th>
		<th><?php echo ('dt_perda');?></th>
		<th><?php echo ('nome_emitente');?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
	$i = 0;
	foreach($habilitacaosconsultadas as $habilitacao){
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	?>
	<tr <?php echo $class;?>>
		<td><?php echo $this->Html->link($habilitacao['Militar']['Posto']['sigla_posto'].' '.$habilitacao['Militar']['Especialidade']['nm_especialidade'].' '.$habilitacao['Militar']['nm_completo'], array('controller'=> 'militars', 'action'=>'view', $habilitacao['Militar']['id'])); ?>
		</td>
		<td><?php //echo $habilitacao['Habilitacao']['cht_anterior']; ?></td>
		<td><?php echo $habilitacao['Habilitacao']['cht']; ?></td>
		<td><?php //echo $habilitacao['Habilitacao']['validade_cht_anterior']; ?>
		</td>
		<td><?php echo (empty($habilitacao['Habilitacao']['validade_cht']))?  '':date('d-m-Y',strtotime($habilitacao['Habilitacao']['validade_cht'])); ?></td>
		<td><?php echo $habilitacao['Habilitacao']['funcao']; ?></td>
		<td><?php //echo $habilitacao['Habilitacao']['setor']; ?></td>
		<td><?php //echo $habilitacao['Habilitacao']['dt_designacao']; ?></td>
		<td><?php echo $habilitacao['Habilitacao']['localidade']; ?>
		<td><?php echo (empty($habilitacao['Habilitacao']['dt_concessao']))?  '':date('d-m-Y',strtotime($habilitacao['Habilitacao']['dt_concessao'])); ?>
		<td><?php echo (empty($habilitacao['Habilitacao']['dt_suspensao']))?  '':date('d-m-Y',strtotime($habilitacao['Habilitacao']['dt_suspensao'])); ?>
		<td><?php echo (empty($habilitacao['Habilitacao']['dt_perda']))?  '':date('d-m-Y',strtotime($habilitacao['Habilitacao']['dt_perda'])); ?>
		</td>
		<td><?php echo $habilitacao['Habilitacao']['nome_emitente']; ?></td>
		<td class="actions"><?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $habilitacao['Habilitacao']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit', $habilitacao['Habilitacao']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$habilitacao['Habilitacao']['cht_atual']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$habilitacao['Habilitacao']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false); ?>
		<?php //echo $this->Html->link($this->Html->image('pdf2.gif', array('alt'=> __('PDF', true), 'border'=> '0', 'title'=>'PDF')), array('action'=>'indexPdf', $habilitacao['Habilitacao']['id']), array('escape'=>false), null,false); ?>
                <?php echo $this->Html->link($this->Html->image('revalidar.gif', array('alt'=> __('Revalidar', true), 'border'=> '0', 'title'=>'Revalidar')), array('action'=>'externoRevalidar', $habilitacao['Habilitacao']['id']), array('escape'=>false), null,false); ?>
		</td>
	</tr>
	<?php } ?>
</table>
</div>
</div>
<script>

HideContent('relatorio01');
HideContent('relatorio02');
HideContent('relatorio03');
HideContent('relatorio04');
HideContent('relatorio05');
HideContent('relatorio06');

</script>	
<script type="text/javascript">
<!--
new Draggable('filtro');
HideContent('filtro');
//-->
</script>
	