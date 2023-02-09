<div class="militarsEscalas index">
<h2><?php __('MilitarsEscalas');?></h2>
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
	<th><?php echo $paginator->sort('militar_id');?></th>
	<th><?php echo $paginator->sort('codigo');?></th>
	<th class="actions"><?php __('Ações');?></th>
</tr>
<?php
$i = 0;
foreach ($militarsEscalas as $militarsEscala):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $militarsEscala['MilitarsEscala']['id']; ?>
		</td>
		<td>
			<?php echo $this->Html->link($militarsEscala['Escala']['nm_escala'], array('controller'=> 'escalas', 'action'=>'view', $militarsEscala['Escala']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($militarsEscala['Militar']['nm_completo'], array('controller'=> 'militars', 'action'=>'view', $militarsEscala['Militar']['id'])); ?>
		</td>
		<td>
			<?php echo $militarsEscala['MilitarsEscala']['codigo']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $militarsEscala['MilitarsEscala']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit', $militarsEscala['MilitarsEscala']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array('action'=>'delete', $militarsEscala['MilitarsEscala']['id']), array('escape'=>false), sprintf(__('Tem certeza que deseja excluir # %s?', true), $militarsEscala['MilitarsEscala']['id']),false); ?>
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
		<li><?php echo $this->Html->link(__('Cadastrar MilitarsEscala', true), array('action'=>'add'),array('class'=>'button')); ?></li>
		<li><?php echo $this->Html->link(__('Exibir Escalas', true), array('controller'=> 'escalas', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Escala', true), array('controller'=> 'escalas', 'action'=>'add'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir Militars', true), array('controller'=> 'militars', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Militar', true), array('controller'=> 'militars', 'action'=>'add'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir Execs Escalas', true), array('controller'=> 'execs_escalas', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Execs Escala', true), array('controller'=> 'execs_escalas', 'action'=>'add'),array('class'=>'button')); ?> </li>
	</ul>
</div>
