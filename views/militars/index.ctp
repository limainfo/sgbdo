<center>
<div class="militars index">



<?php
echo $form->create('formFind', array('url' => 'index','id'=>'busca','onsubmit'=>'sql();'));
?>

<div id="filtro"
	style="border-color: #000000; padding: 0px; z-index: 2; border: 3px solid #000000; position: fixed; top: 10%; left: 5%; overflow: auto; height: auto; width: auto;">
<table cellspacing="0" cellpadding="0" id="filtro">
	<tbody>
		<tr>
			<td valign="center" align="center"><?php 
			$nome = 'Militar.';
			$alfanumerico = '<option value=" AND ('.$nome.'CCC LIKE \\\'||XXX||\\\') ">E - CONTENHA</option>';
			$alfanumerico .= '<option value=" AND ('.$nome.'CCC NOT LIKE \\\'||XXX||\\\') ">E - NÃO CONTENHA</option>';
			$alfanumerico .= '<option value=" AND ('.$nome.'CCC LIKE \\\'XXX||\\\') ">E - COMECE COM</option>';
			$alfanumerico .= '<option value=" AND ('.$nome.'CCC  LIKE \\\'||XXX\\\') ">E - TERMINE COM</option>';
			$alfanumerico .= '<option value=" OR ('.$nome.'CCC LIKE \\\'||XXX||\\\') ">OU - CONTENHA</option>';
			$alfanumerico .= '<option value=" OR ('.$nome.'CCC NOT LIKE \\\'||XXX||\\\') ">OU - NÃO CONTENHA</option>';
			$alfanumerico .= '<option value=" OR ('.$nome.'CCC LIKE \\\'XXX||\\\' ">OU - COMECE COM</option>';
			$alfanumerico .= '<option value=" OR ('.$nome.'CCC LIKE \\\'||XXX\\\' ">OU - TERMINE COM</option>';
			
			$setor = '<option value=" AND (Setor.sigla_setor LIKE \\\'||XXX||\\\') ">E - CONTENHA</option>';
			$setor .= '<option value=" AND (Setor.sigla_setor NOT LIKE \\\'||XXX||\\\') ">E - NÃO CONTENHA</option>';
			$setor .= '<option value=" AND (Setor.sigla_setor LIKE \\\'XXX||\\\') ">E - COMECE COM</option>';
			$setor .= '<option value=" AND (Setor.sigla_setor  LIKE \\\'||XXX\\\') ">E - TERMINE COM</option>';
			$setor .= '<option value=" OR (Setor.sigla_setor LIKE \\\'||XXX||\\\') ">OU - CONTENHA</option>';
			$setor .= '<option value=" OR (Setor.sigla_setor NOT LIKE \\\'||XXX||\\\') ">OU - NÃO CONTENHA</option>';
			$setor .= '<option value=" OR (Setor.sigla_setor LIKE \\\'XXX||\\\' ">OU - COMECE COM</option>';
			$setor .= '<option value=" OR (Setor.sigla_setor LIKE \\\'||XXX\\\' ">OU - TERMINE COM</option>';
			
			$unidade = '<option value=" AND (Unidade.sigla_unidade LIKE \\\'||XXX||\\\') ">E - CONTENHA</option>';
			$unidade .= '<option value=" AND (Unidade.sigla_unidade NOT LIKE \\\'||XXX||\\\') ">E - NÃO CONTENHA</option>';
			$unidade .= '<option value=" AND (Unidade.sigla_unidade LIKE \\\'XXX||\\\') ">E - COMECE COM</option>';
			$unidade .= '<option value=" AND (Unidade.sigla_unidade  LIKE \\\'||XXX\\\') ">E - TERMINE COM</option>';
			$unidade .= '<option value=" OR (Unidade.sigla_unidade LIKE \\\'||XXX||\\\') ">OU - CONTENHA</option>';
			$unidade .= '<option value=" OR (Unidade.sigla_unidade NOT LIKE \\\'||XXX||\\\') ">OU - NÃO CONTENHA</option>';
			$unidade .= '<option value=" OR (Unidade.sigla_unidade LIKE \\\'XXX||\\\' ">OU - COMECE COM</option>';
			$unidade .= '<option value=" OR (Unidade.sigla_unidade LIKE \\\'||XXX\\\' ">OU - TERMINE COM</option>';
			
			$posto = '<option value=" AND (Posto.sigla_posto LIKE \\\'||XXX||\\\') ">E - CONTENHA</option>';
			$posto .= '<option value=" AND (Posto.sigla_posto NOT LIKE \\\'||XXX||\\\') ">E - NÃO CONTENHA</option>';
			$posto .= '<option value=" AND (Posto.sigla_posto LIKE \\\'XXX||\\\') ">E - COMECE COM</option>';
			$posto .= '<option value=" AND (Posto.sigla_posto  LIKE \\\'||XXX\\\') ">E - TERMINE COM</option>';
			$posto .= '<option value=" OR (Posto.sigla_posto LIKE \\\'||XXX||\\\') ">OU - CONTENHA</option>';
			$posto .= '<option value=" OR (Posto.sigla_posto NOT LIKE \\\'||XXX||\\\') ">OU - NÃO CONTENHA</option>';
			$posto .= '<option value=" OR (Posto.sigla_posto LIKE \\\'XXX||\\\' ">OU - COMECE COM</option>';
			$posto .= '<option value=" OR (Posto.sigla_posto LIKE \\\'||XXX\\\' ">OU - TERMINE COM</option>';
			
			$especialidade = '<option value=" AND (Especialidade.nm_especialidade LIKE \\\'||XXX||\\\') ">E - CONTENHA</option>';
			$especialidade .= '<option value=" AND (Especialidade.nm_especialidade NOT LIKE \\\'||XXX||\\\') ">E - NÃO CONTENHA</option>';
			$especialidade .= '<option value=" AND (Especialidade.nm_especialidade LIKE \\\'XXX||\\\') ">E - COMECE COM</option>';
			$especialidade .= '<option value=" AND (Especialidade.nm_especialidade  LIKE \\\'||XXX\\\') ">E - TERMINE COM</option>';
			$especialidade .= '<option value=" OR (Especialidade.nm_especialidade LIKE \\\'||XXX||\\\') ">OU - CONTENHA</option>';
			$especialidade .= '<option value=" OR (Especialidade.nm_especialidade NOT LIKE \\\'||XXX||\\\') ">OU - NÃO CONTENHA</option>';
			$especialidade .= '<option value=" OR (Especialidade.nm_especialidade LIKE \\\'XXX||\\\' ">OU - COMECE COM</option>';
			$especialidade .= '<option value=" OR (Especialidade.nm_especialidade LIKE \\\'||XXX\\\' ">OU - TERMINE COM</option>';
			
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
			//print_r($esquema);
			foreach($esquema as $campos=>$vetor){
				$conta++;
				$campo .= '<option value="'.$campos.'">'.$campos.'</option>'; 
				switch($campos){
					case 'setor_id': 
						$tipos .= '<input type="hidden" id="tipo'.$conta.'" value="setor_id" name="data[Tipo][]" />';
						break;
					case 'posto_id': 
						$tipos .= '<input type="hidden" id="tipo'.$conta.'" value="posto_id" name="data[Tipo][]" />';
						break;
					case 'especialidade_id': 
						$tipos .= '<input type="hidden" id="tipo'.$conta.'" value="especialidade_id" name="data[Tipo][]" />';
						break;
					case 'unidade_id': 
						$tipos .= '<input type="hidden" id="tipo'.$conta.'" value="unidade_id" name="data[Tipo][]" />';
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
					<td colspan="3" style="background-color:#ff2020;font-weight:bold;height:40px;padding:10px;">CAMPOS NM_COMPLETO E NM_GUERRA NÃO DEVEM POSSUIR ACENTOS.</td>
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

function preencheFiltro(ordem) {
	var numero = '$numerico';
	var literal = '$alfanumerico';
	var data = '$data';
	var setorId = '$setor';
	var postoId = '$posto';
	var especialidadeId = '$especialidade';
	var unidadeId = '$unidade';
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
	
	if((tipo=='setor_id')){
		select_innerHTML(filtro,setorId);
	}
	if((tipo=='especialidade_id')){
		select_innerHTML(filtro,especialidadeId);
	}
	if((tipo=='unidade_id')){
		select_innerHTML(filtro,unidadeId);
	}
	if((tipo=='posto_id')){
		select_innerHTML(filtro,postoId);
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

<table cellspacing="0">
        <tr><td colspan="30">
<h1><?php __('Militares');?>	<?php
$script = "var x=(\$('find').value);x =encodeURI(x);if(x.blank()){\$('broffice').href='".$this->webroot."militars/indexExcel/';}else{\$('broffice').href='".$this->webroot."militars/indexExcel/'+x;}";

?>
&nbsp;<?php echo $this->Html->link($this->Html->image('broffice.png', array('alt'=> __('BROffice', true), 'border'=> '0', 'title'=>'Dados em planilha BROffice', 'onmouseover'=>$script )), array('action'=>'indexExcel'), array('id'=>'broffice','escape'=>false), null,false); ?>
&nbsp;<?php echo $this->Html->link($this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'add', null),array('escape'=>false, 'escape'=>false), null,false); ?></h1>
	<?php echo $form->create('formFind', array('url' => 'index','type'=>'file','action' => 'index','controller' => 'militars','id'=>'busca','onsubmit'=>'sql();')); ?>	
	<h3>
	<?php
		echo $paginator->counter(array('format' => __('Página %page%/%pages%, exibindo %current% registro(s) de %count% total, registros de %start% até %end%', true)));?>	</h3>           
                </td></tr>
                            <tr><td colspan="30">
<?php
		echo '<div id="boxsearch" ><div class="input select" style="align:right;">QTD REGISTROS:<select id="FindPaginas" name="data[formFind][paginas]" class="formulario" onchange="$(\'busca\').submit();">';
		for($i=$min_registros;$i<=$max_registros;$i+=$passo){
		echo '<option value="'.$i.'">'.$i.'</option>';
		}
		echo '<option value="'.$paginator->counter(array('format' => __('%count%', true))).'">'.$paginator->counter(array('format' => __('%count%', true))).'</option>';
		if(!empty($this->data['formFind']['paginas'])){
			echo '<option value="'.$this->data['formFind']['paginas'].'" selected="selected">'.$this->data['formFind']['paginas'].'</option>';
		}
		echo '</select>&nbsp;&nbsp;&nbsp;<img border="0" onclick="ShowContent(\'filtro\');"  title="Filtrar Dados" alt="Filtro" src="'.$this->webroot.'img/filtro.gif"  onmouseover="$(\'busca\').action=\''.$this->webroot.'militars/index/\';"/></div></div>'; ?>                
                        </td></tr>
	<tr>
		<th><?php echo 'Foto';?></th>
		<th><?php echo $paginator->sort('identidade');?></th>
		<th><?php echo $paginator->sort('rc');?></th>
		<th><?php echo $paginator->sort('Quadro','quadro_id');?></th>
		<th><?php echo $paginator->sort('Esp','especialidade_id');?></th>
		<th>Unidade</th>
		<th><?php echo $paginator->sort('setor_id');?></th>
		<th><?php echo $paginator->sort('posto_id');?></th>
		<th><?php echo $paginator->sort('saram');?></th>
<?php if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)){ ?>
		<th><?php echo $paginator->sort('cpf');?></th>
<?php } ?>	<th><?php echo $paginator->sort('nm_completo');?></th>
		<th><?php echo $paginator->sort('nm_guerra');?></th>
		<th><?php echo $paginator->sort('nr_licenca');?></th>
		<th><?php echo $paginator->sort('indicativo');?></th>
		<th><?php echo $paginator->sort('eplis_nota');?></th>
		<th><?php echo $paginator->sort('dt_licenciamento');?></th>
		<th><?php echo $paginator->sort('obs');?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
			//print_r($quadros);
	
	$i = 0;
	$conta = 0;
	
	foreach ($militars as $militar):
	
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
		if($militar['Militar']['ativa']==0){
		$td = ' style="background-color:#F0D0D0;" ';
	}else{
		$td='';
	}
	?>
	<tr   <?php echo $class.' id='.$conta; ?>>
		<td<?php echo $td;?>><?php
		if(isset($militar['Foto']['id'])){
			$img = $militar['Foto']['id'];
		    echo $this->Html->image(array('controller'=> 'fotos', 'action'=>'externodownload',$img), array( 'border'=> '0' ,'width'=>'40', 'height'=>'30')); //  
		}else{
			$img = 'sem_imagem.png';
		    echo $this->Html->image('sem_imagem.png', array( 'border'=> '0', 'width'=>'40', 'height'=>'30' )); 
		}
		?>
		</td>
		<td<?php echo $td;?>><?php echo $militar['Militar']['identidade']; ?>
		</td>
		<td<?php echo $td;?>><?php echo $militar['Militar']['rc']; ?>
		</td>
		<td<?php echo $td;?>><?php echo $militar['Quadro']['sigla_quadro']; ?>
		</td>
		<td<?php echo $td;?>><?php echo $this->Html->link($militar['Especialidade']['nm_especialidade'], array('controller'=> 'especialidades', 'action'=>'view', $militar['Especialidade']['id'])); ?>
		</td>
		<td<?php echo $td;?>><?php echo $this->Html->link($militar['Unidade']['sigla_unidade'], array('controller'=> 'unidades', 'action'=>'view', $militar['Militar']['unidade_id'])); ?>
		</td>
		<td<?php echo $td;?>><?php echo $this->Html->link($militar['Setor']['sigla_setor'], array('controller'=> 'setors', 'action'=>'view', $militar['Setor']['id'])); ?>
		</td>
		<td<?php echo $td;?>><?php echo $this->Html->link($militar['Posto']['sigla_posto'], array('controller'=> 'postos', 'action'=>'view', $militar['Posto']['id'])); ?>
		</td>
		<td<?php echo $td;?>><?php echo $militar['Militar']['saram']; ?></td>
<?php if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)){ ?>
		<td<?php echo $td;?>><?php echo str_pad($militar['Militar']['cpf'], 11, "0", STR_PAD_LEFT); ?></td>
<?php } ?>	<td<?php echo $td;?>><?php echo $militar['Militar']['nm_completo']; ?></td>
		<td<?php echo $td;?>><?php echo $militar['Militar']['nm_guerra']; ?></td>
		<td<?php echo $td;?>><?php echo $militar['Militar']['nr_licenca']; ?></td>
		<td<?php echo $td;?>><?php echo $militar['Militar']['indicativo']; ?></td>
		<td<?php echo $td;?>><?php echo $militar['Militar']['eplis_nota'].' - '.$militar['Militar']['eplis_ano']; ?></td>
		<!-- <td<?php echo $td;?>><?php echo $militar['Militar']['situacao']; ?></td> -->
		<td<?php echo $td;?>><?php echo $militar['Militar']['dt_licenciamento']; ?></td>
		<td<?php echo $td;?>><?php echo $militar['Militar']['obs']; ?></td>
		<td class="actions"<?php echo $td;?>>
		<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('controller'=> 'militars','action'=>'view', $militar['Militar']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('controller'=> 'militars','action'=>'edit', $militar['Militar']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		
		<?php 
			if($militar['Militar']['ativa']>0){
			// echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$militar['Militar']['nm_completo']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$militar['Militar']['id']."');",'onclick'=>"this.href='#';return false;", 'escape'=>false), null,false);
			$mdown = "dialogo('Deseja realmente excluir o registro #".$militar['Militar']['nm_completo']." ?' ,'".$this->webroot.'militars/delete/'.$militar['Militar']['id']."');"; 
			 echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>$mdown,'onclick'=>"this.href='#';return false;", 'escape'=>false), null,false); 
			}
		?>
		<?php echo $this->Html->link($this->Html->image('pdf2.gif', array('alt'=> __('PDF', true), 'border'=> '0', 'title'=>'PDF')), array('action'=>'indexPdf', $militar['Militar']['id']), array('escape'=>false), null,false); ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
</div>
<br>
<hr>
<div class="paging"><?php echo $paginator->prev('<< '.__('Anterior', true), array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?>
| <?php echo $paginator->numbers(array('modulus'=>200,'onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"));?> <?php echo $paginator->next(__('Próxima', true).' >>', array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?>
</div>
<?php
$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
 HideContent('filtro');
 new Draggable('filtro');
 </script>
SCRIPT;
echo $jscript;
?>
</center>