<div class="englishtowns index">
<h1><?php __('Englishtown');?>&nbsp;<?php echo $this->Html->link($this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'add', null),array('escape'=>false, 'escape'=>false), null,false); ?></h1>
 
<?php
echo $form->create('formFind', array('url' => 'externoindex','id'=>'busca'));

echo $form->input('find', array('value' => $findUrlNotCleaned, 'label'
=> '', 'type' => 'text', 'id' => 'find', 'class' => 'teste',
'size' => '30', 'maxlength' => '100','class'=>'formulario'));

echo $form->end(array('label'=>'Buscar','class'=>'botoes'));
?>
<h3>
<?php
echo $paginator->counter(array(
'format' => __('Página %page%/%pages%, exibindo %current% registro(s) de %count% total, registros de %start%, até %end%', true)
));
?></h3>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('mes');?>&nbsp;</th>
	<th>&nbsp;<?php echo $paginator->sort('ano');?>&nbsp;</th>
	<th>&nbsp;<?php echo $paginator->sort('identidade');?>&nbsp;</th>
	<th>&nbsp;<?php echo $paginator->sort('orgao');?>&nbsp;</th>
	<th>&nbsp;<?php echo $paginator->sort('Local');?>&nbsp;</th>
	<th>&nbsp;<?php echo $paginator->sort('nivel_atual');?>&nbsp;</th>
	<th>&nbsp;<?php echo $paginator->sort('meta_icao');?>&nbsp;</th>
	<th>&nbsp;<?php echo $paginator->sort('atividades');?>&nbsp;</th>
	<th>&nbsp;<?php echo $paginator->sort('unidades');?>&nbsp;</th>
	<th>&nbsp;<?php echo $paginator->sort('horas');?>&nbsp;</th>
	<th>&nbsp;<?php echo $paginator->sort('evolucao');?>&nbsp;</th>
	<th>&nbsp;<?php echo $paginator->sort('meta_npa');?>&nbsp;</th>
</tr>
<?php
$i = 0;
foreach ($englishtowns as $englishtown):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' style="background-color: #e0e0f0;color: #303030;"';
	}
?>
	<tr<?php echo $class;?>>
		<td<?php echo $class;?>><?php echo $englishtown['Englishtown']['mes']; ?></td>
		<td<?php echo $class;?>><?php echo $englishtown['Englishtown']['ano']; ?></td>
		<td<?php echo $class;?>>
			<?php echo $englishtown['Militar']['identidade']; ?>
		</td>
		<td<?php echo $class;?>>
			<?php echo $englishtown['Englishtown']['orgao']; ?>
		</td>
		<td<?php echo $class;?>>
			<?php echo $englishtown['Englishtown']['Local']; ?>
		</td>
		<td<?php echo $class;?>>
			<?php echo $englishtown['Englishtown']['nivel_atual']; ?>
		</td>
		<td<?php echo $class;?>>
			<?php echo $englishtown['Englishtown']['meta_icao'].' %'; ?>
		</td>
		<td<?php echo $class;?>>
			<?php echo $englishtown['Englishtown']['atividades']; ?>
		</td>
		<td<?php echo $class;?>>
			<?php echo $englishtown['Englishtown']['unidades']; ?>
		</td>
		<td<?php echo $class;?>>
			<?php echo $englishtown['Englishtown']['horas']; ?>
		</td>
		<td<?php echo $class;?>>
			<?php echo $englishtown['Englishtown']['evolucao'].' %'; ?>
		</td>
		<td<?php echo $class;?>>
			<?php echo $englishtown['Englishtown']['meta_npa'].' %'; ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging"><?php echo $paginator->prev('<< '.__('Anterior', true), array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?>
| <?php echo $paginator->numbers(array('modulus'=>200,'onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"));?> <?php echo $paginator->next(__('Próxima', true).' >>', array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?>
</div>
