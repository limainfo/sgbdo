<div class="privilegiosUsuarios index">
<h2><?php __('PrivilegiosUsuarios');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Página %page%/%pages%, exibindo %current% registro(s) de %count% total, registros de %start%, até %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('usuario_id');?></th>
	<th><?php echo $paginator->sort('privilegio_id');?></th>
	<th class="actions"><?php __('Ações');?></th>
</tr>
<?php
$i = 0;
foreach ($privilegiosUsuarios as $privilegiosUsuario):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $privilegiosUsuario['PrivilegiosUsuario']['id']; ?>
		</td>
		<td>
			<?php echo $privilegiosUsuario['PrivilegiosUsuario']['usuario_id']; ?>
		</td>
		<td>
			<?php echo $privilegiosUsuario['PrivilegiosUsuario']['privilegio_id']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $privilegiosUsuario['PrivilegiosUsuario']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit', $privilegiosUsuario['PrivilegiosUsuario']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array('action'=>'delete', $privilegiosUsuario['PrivilegiosUsuario']['id']), array('escape'=>false), sprintf(__('Tem certeza que deseja excluir # %s?', true), $privilegiosUsuario['PrivilegiosUsuario']['id']),false); ?>
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
		<li><?php echo $this->Html->link(__('Cadastrar PrivilegiosUsuario', true), array('action'=>'add'),array('class'=>'button')); ?></li>
	</ul>
</div>
