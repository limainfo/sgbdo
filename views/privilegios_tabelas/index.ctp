<div class="privilegiosTabelas index">
<h2><?php __('PrivilegiosTabelas');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Página %page%/%pages%, exibindo %current% registro(s) de %count% total, registros de %start%, até %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('privilegio_id');?></th>
	<th><?php echo $paginator->sort('tabela_id');?></th>
	<th><?php echo $paginator->sort('dia_inicio');?></th>
	<th><?php echo $paginator->sort('dia_fim');?></th>
	<th><?php echo $paginator->sort('ver');?></th>
	<th><?php echo $paginator->sort('editar');?></th>
	<th><?php echo $paginator->sort('adicionar');?></th>
	<th><?php echo $paginator->sort('deletar');?></th>
	<th class="actions"><?php __('Ações');?></th>
</tr>
<?php
$i = 0;
foreach ($privilegiosTabelas as $privilegiosTabela):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $privilegiosTabela['PrivilegiosTabela']['id']; ?>
		</td>
		<td>
			<?php echo $this->Html->link($privilegiosTabela['Privilegio']['id'], array('controller'=> 'privilegios', 'action'=>'view', $privilegiosTabela['Privilegio']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($privilegiosTabela['Tabela']['id'], array('controller'=> 'tabelas', 'action'=>'view', $privilegiosTabela['Tabela']['id'])); ?>
		</td>
		<td>
			<?php echo $privilegiosTabela['PrivilegiosTabela']['dia_inicio']; ?>
		</td>
		<td>
			<?php echo $privilegiosTabela['PrivilegiosTabela']['dia_fim']; ?>
		</td>
		<td>
			<?php echo $privilegiosTabela['PrivilegiosTabela']['ver']; ?>
		</td>
		<td>
			<?php echo $privilegiosTabela['PrivilegiosTabela']['editar']; ?>
		</td>
		<td>
			<?php echo $privilegiosTabela['PrivilegiosTabela']['adicionar']; ?>
		</td>
		<td>
			<?php echo $privilegiosTabela['PrivilegiosTabela']['deletar']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $privilegiosTabela['PrivilegiosTabela']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit', $privilegiosTabela['PrivilegiosTabela']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array('action'=>'delete', $privilegiosTabela['PrivilegiosTabela']['id']), array('escape'=>false), sprintf(__('Tem certeza que deseja excluir # %s?', true), $privilegiosTabela['PrivilegiosTabela']['id']),false); ?>
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
		<li><?php echo $this->Html->link(__('Cadastrar PrivilegiosTabela', true), array('action'=>'add'),array('class'=>'button')); ?></li>
		<li><?php echo $this->Html->link(__('Exibir Privilegios', true), array('controller'=> 'privilegios', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Privilegio', true), array('controller'=> 'privilegios', 'action'=>'add'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir Tabelas', true), array('controller'=> 'tabelas', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Tabela', true), array('controller'=> 'tabelas', 'action'=>'add'),array('class'=>'button')); ?> </li>
	</ul>
</div>
