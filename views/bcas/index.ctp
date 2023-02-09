<?php
/*
echo '<pre>';
print_r($this);
echo '</pre>';
*/
?>
<div class="PareceresTecnicos index">
<h1><?php __('BCAs');?>
&nbsp;<?php echo $this->Html->link($this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'add', null),array('escape'=>false, 'escape'=>false), null,false); ?>
</h1>
<?php
echo $form->create('formFind', array('url' => 'index','id'=>'busca'));

echo '<div class="input text"><label for="find">Informe os dados a serem pesquisados</label><input type="text" maxlength="100" size="30" class="formulario" id="find" value="'.$this->data['formFind']['find'].'" name="data[formFind][find]"/>
<input type="submit" value="Buscar" class="botoes"/></div>';
		?>

<h3><?php
//$paginator->options(array('update' => 'wrapper', 'indicator' => 'spinner'));
echo $paginator->counter(array(
'format' => __('Página %page%/%pages%, exibindo %current% registro(s) de %count% total, registros de %start% até %end%', true)
));
?></h3><?php
		echo '<div class="input select" style="align:right;">Registros por página:<select id="FindPaginas" name="data[formFind][paginas]" class="formulario" onchange="$(\'busca\').submit();">';
		for($i=$min_registros;$i<=$max_registros;$i+=$passo){
		echo '<option value="'.$i.'">'.$i.'</option>';
		//if($i==100)break;
		}
		echo '<option value="TODAS">TODAS</option>';
		if(!empty($this->data['formFind']['paginas'])){
			echo '<option value="'.$this->data['formFind']['paginas'].'" selected="selected">'.$this->data['formFind']['paginas'].'</option>';
		}
		echo '</select></div>';
?>
<?php echo $form->end(); ?>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('numero_bca');?></th>
	<th><?php echo $paginator->sort('extrato');?></th>
	<th><?php echo $paginator->sort('gerado');?></th>
	<th class="actions"><?php __('Ações');?></th>
</tr>
<?php
$i = 0;
//print_r($bcas);
foreach ($bcas as $parecerestecnico):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $parecerestecnico['Bca']['numero_bca']; ?>
		</td>
		<td>
			<?php echo $parecerestecnico['Bca']['extrato']; ?>
		</td>
		<td>
			<?php echo $parecerestecnico['Bca']['gerado']; ?>
		</td>
		<td class="actions">
		   <?php if(strlen($parecerestecnico['Bca']['arquivo'])>0){ ?>
			<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $parecerestecnico['Bca']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		   <?php } ?>
			<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit', $parecerestecnico['Bca']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php
			echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>'dialogo("Deseja realmente excluir o BCA #'.$parecerestecnico['Bca']['numero_bca']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$parecerestecnico['Bca']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false); 
			 ?>
			<?php
			$verifica = 0;
			foreach($parecerestecnico['Bcasassinado'] as $assinado){
				if($assinado['tipo_visto']=='V'){
					$verifica =1;
					break;
				}
			}
			if($verifica){
				echo $this->Html->link($this->Html->image('bcaassinado.png', array('alt'=> __('Assinaturas', true), 'border'=> '0', 'title'=>'Assinaturas')), array(), array('onmousedown'=>"exibeAssinaturas('".$parecerestecnico['Bca']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);
			} 
			 ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<br><hr>
<div class="paging">
  <?php echo $paginator->prev('<< '.__('Anterior', true), array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?>
| <?php echo $paginator->numbers(array('modulus'=>200,'onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"));?> 
  <?php echo $paginator->next(__('Próxima', true).' >>', array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?>
</div>

<div style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 60%; border: 2px solid rgb(0, 0, 0); z-index: 1000" id="assinaturaBcas">
<p
	style="background-color: #000080; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;">ASSINATURAS<a style="float: right; margin: 0px;"
	href="javascript:HideContent('assinaturaBcas');"
	onclick="HideContent('assinaturaBcas');"
	href="javascript:HideContent('assinaturaBcas');"><img border="0" width="15"
	height="15" title="Excluir" alt="Excluir"
	src="<?php echo $this->webroot; ?>img/lixo.gif" /> </a></p>
<p
	style="margin: 0px; background-color: #ffff00; border: 1px solid #000;">


<div id="assinaturaBca"></div>
</p>
<script type="text/javascript">
<!--
new Draggable('assinaturaBcas');
//-->
</script>
</div>

<script type="text/javascript">
$('assinaturaBcas').hide();
HideContent('assinaturaBcas');
</script>

<script type="text/javascript">
function exibeAssinaturas(id) {
new Ajax.Request('<?php echo $this->webroot; ?>bcas/externoassinados/'+id, {
			method: 'get',
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			
		
    		 if (resultado.total==0){
    		 	HideContent('assinaturaBcas');
			}else{
			 	$('assinaturaBca').innerHTML = unescape(resultado.mensagem);
			 	ShowContent('assinaturaBcas');
			}
		}
	});
}

</script>

