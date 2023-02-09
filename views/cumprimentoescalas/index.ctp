<div class="cumprimentoescalas index">
<h2><?php __('Cumprimentoescalas');?></h2>
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
	<th><?php echo $paginator->sort('dia');?></th>
	<th><?php echo $paginator->sort('turno');?></th>
	<th><?php echo $paginator->sort('previsto');?></th>
	<th><?php echo $paginator->sort('cumprido');?></th>
	<th class="actions"><?php __('Ações');?></th>
</tr>
<?php
$i = 0;
foreach ($cumprimentoescalas as $cumprimentoescala):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $cumprimentoescala['Cumprimentoescala']['id']; ?>
		</td>
		<td>
			<?php echo $this->Html->link($cumprimentoescala['Escalasmonth']['id'], array('controller'=> 'escalasmonths', 'action'=>'view', $cumprimentoescala['Escalasmonth']['id'])); ?>
		</td>
		<td>
			<?php echo $cumprimentoescala['Cumprimentoescala']['dia']; ?>
		</td>
		<td>
			<?php echo $cumprimentoescala['Cumprimentoescala']['turno']; ?>
		</td>
		<td>
			<?php echo $cumprimentoescala['Cumprimentoescala']['previsto']; ?>
		</td>
		<td>
			<?php echo $cumprimentoescala['Cumprimentoescala']['cumprido']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $cumprimentoescala['Cumprimentoescala']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit', $cumprimentoescala['Cumprimentoescala']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array('action'=>'delete', $cumprimentoescala['Cumprimentoescala']['id']), array('escape'=>false), sprintf(__('Tem certeza que deseja excluir # %s?', true), $cumprimentoescala['Cumprimentoescala']['id']),false); ?>
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
		<li><?php echo $this->Html->link(__('Cadastrar Cumprimentoescala', true), array('action'=>'add'),array('class'=>'button')); ?></li>
		<li><?php echo $this->Html->link(__('Exibir Escalasmonths', true), array('controller'=> 'escalasmonths', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Escalasmonth', true), array('controller'=> 'escalasmonths', 'action'=>'add'),array('class'=>'button')); ?> </li>
	</ul>
</div>
