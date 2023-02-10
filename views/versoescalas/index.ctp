<div class="versoescalas index">
<h2><?php __('Versoescalas');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Página %page%/%pages%, exibindo %current% registro(s) de %count% total, registros de %start%, até %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('escalasmonth_id');?></th>
	<th><?php echo $paginator->sort('item1');?></th>
	<th><?php echo $paginator->sort('item2');?></th>
	<th><?php echo $paginator->sort('item3');?></th>
	<th><?php echo $paginator->sort('item4');?></th>
	<th><?php echo $paginator->sort('item5');?></th>
	<th><?php echo $paginator->sort('item6');?></th>
	<th class="actions"><?php __('Ações');?></th>
</tr>
<?php
$i = 0;
foreach ($versoescalas as $versoescala):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $versoescala['Versoescala']['id']; ?>
		</td>
		<td>
			<?php echo $versoescala['Versoescala']['escalasmonth_id']; ?>
		</td>
		<td>
			<?php echo $versoescala['Versoescala']['item1']; ?>
		</td>
		<td>
			<?php echo $versoescala['Versoescala']['item2']; ?>
		</td>
		<td>
			<?php echo $versoescala['Versoescala']['item3']; ?>
		</td>
		<td>
			<?php echo $versoescala['Versoescala']['item4']; ?>
		</td>
		<td>
			<?php echo $versoescala['Versoescala']['item5']; ?>
		</td>
		<td>
			<?php echo $versoescala['Versoescala']['item6']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $versoescala['Versoescala']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit', $versoescala['Versoescala']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array('action'=>'delete', $versoescala['Versoescala']['id']), array('escape'=>false), sprintf(__('Tem certeza que deseja excluir # %s?', true), $versoescala['Versoescala']['id']),false); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('Anterior', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers(array('modulus'=>200));?>
	<?php echo $paginator->next(__('Próxima', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Cadastrar Versoescala', true), array('action'=>'add'),array('class'=>'button')); ?></li>
	</ul>
</div>
