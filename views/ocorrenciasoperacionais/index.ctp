

<div class="ocorrenciasoperacionais index">
<h1><?php __('Ocorrenciasoperacionais');?><?php
$script = "var x=\$('find').value;if(x.blank()){\$('broffice').href='".$this->webroot."Ocorrenciasoperacionais/indexExcel/';}else{\$('broffice').href='".$this->webroot."Ocorrenciasoperacionais/indexExcel/'+x;}";?>
&nbsp;<?php echo $this->Html->link($this->Html->image('broffice.png', array('alt'=> __('BROffice', true), 'border'=> '0', 'title'=>'Dados em planilha BROffice', 'onmouseover'=>$script )), array('action'=>'indexExcel'), array('id'=>'broffice','escape'=>false), null,false); ?>
&nbsp;<?php echo $this->Html->link($this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'add', null),array('escape'=>false, 'escape'=>false), null,false); ?></h1><?php
echo $form->create('formFind', array('url' => 'index','id'=>'busca'));
echo '<div class="input text"><label for="find">Informe os dados a serem pesquisados</label><input type="text" maxlength="100" size="30" class="formulario" id="find" value="'.$this->data['formFind']['find'].'" name="data[formFind][find]"/>
<input type="submit" value="Buscar" class="botoes"/></div>';
?><h3>

<?php
$paginator->options(array('update' => 'wrapper', 'indicator' => 'spinner'));
echo $paginator->counter(array(
'format' => __('Página %page%/%pages%, exibindo %current% registro(s) de %count% total, registros de %start%, até %end%', true)
));
?>
</h3>
<?php
	
		echo '<div class="input select" style="align:right;">Registros por página:<select id="FindPaginas" name="data[formFind][paginas]" class="formulario" onchange="$(\'busca\').submit();">';
		for($i=$min_registros;$i<=$max_registros;$i+=$passo){
		echo '<option value="'.$i.'">'.$i.'</option>';
		}
		echo '<option value="TODAS">TODAS</option>';
		if(!empty($this->data['formFind']['paginas'])){
			echo '<option value="'.$this->data['formFind']['paginas'].'" selected="selected">'.$this->data['formFind']['paginas'].'</option>';
		}
		echo '</select></div>';
?>
<?php echo $form->end(); ?><table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('tabela');?></th>
	<th><?php echo $paginator->sort('registroid');?></th>
	<th><?php echo $paginator->sort('inicio');?></th>
	<th><?php echo $paginator->sort('termino');?></th>
	<th class="actions"><?php __('Ações');?></th>
</tr>
<?php
$i = 0;
foreach ($ocorrenciasoperacionais as $ocorrenciasoperacionai):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $ocorrenciasoperacionai['Ocorrenciasoperacionai']['id']; ?>
		</td>
		<td>
			<?php echo $ocorrenciasoperacionai['Ocorrenciasoperacionai']['tabela']; ?>
		</td>
		<td>
			<?php echo $ocorrenciasoperacionai['Ocorrenciasoperacionai']['registroid']; ?>
		</td>
		<td>
			<?php echo $ocorrenciasoperacionai['Ocorrenciasoperacionai']['inicio']; ?>
		</td>
		<td>
			<?php echo $ocorrenciasoperacionai['Ocorrenciasoperacionai']['termino']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $ocorrenciasoperacionai['Ocorrenciasoperacionai']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>			<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit', $ocorrenciasoperacionai['Ocorrenciasoperacionai']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>			<?php  echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$ocorrenciasoperacionai['Ocorrenciasoperacionai']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$ocorrenciasoperacionai['Ocorrenciasoperacionai']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);?>		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('Anterior', true), array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?>	| <?php echo $paginator->numbers(array('modulus'=>200,'onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"));?> 
	<?php echo $paginator->next(__('Próxima', true).' >>', array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?></div>

