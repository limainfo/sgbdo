<div class="calendariorotinas index">
<h2><?php __('Calendariorotinas');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Página %page%/%pages%, exibindo %current% registro(s) de %count% total, registros de %start%, até %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('rotina_id');?></th>
	<th><?php echo $paginator->sort('rubrica');?></th>
	<th><?php echo $paginator->sort('obs');?></th>
	<th><?php echo $paginator->sort('dt_inicio_previsto');?></th>
	<th><?php echo $paginator->sort('updated');?></th>
	<th class="actions"><?php __('Ações');?></th>
</tr>
<?php
$i = 0;
foreach ($calendariorotinas as $calendariorotina):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $calendariorotina['Calendariorotina']['id']; ?>
		</td>
		<td>
			<?php echo $this->Html->link($calendariorotina['Rotina']['acao'], array('controller'=> 'rotinas', 'action'=>'view', $calendariorotina['Rotina']['id'])); ?>
		</td>
		<td>
			<?php echo $calendariorotina['Calendariorotina']['rubrica']; ?>
		</td>
		<td>
			<?php echo $calendariorotina['Calendariorotina']['obs']; ?>
		</td>
		<td>
			<?php echo $calendariorotina['Calendariorotina']['dt_inicio_previsto']; ?>
		</td>
		<td>
			<?php echo $calendariorotina['Calendariorotina']['updated']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $calendariorotina['Calendariorotina']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit', $calendariorotina['Calendariorotina']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array('action'=>'delete', $calendariorotina['Calendariorotina']['id']), array('escape'=>false), sprintf(__('Tem certeza que deseja excluir # %s?', true), $calendariorotina['Calendariorotina']['id']),false); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('Anterior', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('Próxima', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Cadastrar Calendariorotina', true), array('action'=>'add'),array('class'=>'button')); ?></li>
		<li><?php echo $this->Html->link(__('Exibir Rotinas', true), array('controller'=> 'rotinas', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Rotina', true), array('controller'=> 'rotinas', 'action'=>'add'),array('class'=>'button')); ?> </li>
	</ul>
</div>
