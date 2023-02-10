<div class="turnos index">
<h2><?php __('Turnos');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Página %page%/%pages%, exibindo %current% registro(s) de %count% total, registros de %start%, até %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('escala_id');?></th>
	<th><?php echo $paginator->sort('hora_inicio');?></th>
	<th><?php echo $paginator->sort('hora_terminio');?></th>
	<th><?php echo $paginator->sort('qtd');?></th>
	<th><?php echo $paginator->sort('dt_escala');?></th>
	<th class="actions"><?php __('Ações');?></th>
</tr>
<?php
$i = 0;
foreach ($turnos as $turno):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $turno['Turno']['id']; ?>
		</td>
		<td>
			<?php echo $this->Html->link($turno['Escala']['id'], array('controller'=> 'escalas', 'action'=>'view', $turno['Escala']['id'])); ?>
		</td>
		<td>
			<?php echo $turno['Turno']['hora_inicio']; ?>
		</td>
		<td>
			<?php echo $turno['Turno']['hora_terminio']; ?>
		</td>
		<td>
			<?php echo $turno['Turno']['qtd']; ?>
		</td>
		<td>
			<?php echo $turno['Turno']['dt_escala']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $turno['Turno']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit', $turno['Turno']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array('action'=>'delete', $turno['Turno']['id']), array('escape'=>false), sprintf(__('Tem certeza que deseja excluir # %s?', true), $turno['Turno']['id']),false); ?>
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
		<li><?php echo $this->Html->link(__('Cadastrar Turno', true), array('action'=>'add'),array('class'=>'button')); ?></li>
		<li><?php echo $this->Html->link(__('Exibir Escalas', true), array('controller'=> 'escalas', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Escala', true), array('controller'=> 'escalas', 'action'=>'add'),array('class'=>'button')); ?> </li>
	</ul>
</div>
