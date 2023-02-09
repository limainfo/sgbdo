<div class="privilegiosUsuarios view">
<h2><?php  __('PrivilegiosUsuario');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $privilegiosUsuario['PrivilegiosUsuario']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Usuario Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $privilegiosUsuario['PrivilegiosUsuario']['usuario_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Privilegio Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $privilegiosUsuario['PrivilegiosUsuario']['privilegio_id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<br>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Editar PrivilegiosUsuario', true), array('action'=>'edit', $privilegiosUsuario['PrivilegiosUsuario']['id']),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Excluir PrivilegiosUsuario', true), array('action'=>'delete', $privilegiosUsuario['PrivilegiosUsuario']['id']), array('class'=>'button'), sprintf(__('Tem certeza que deseja excluir  # %s?', true), $privilegiosUsuario['PrivilegiosUsuario']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir PrivilegiosUsuarios', true), array('action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar PrivilegiosUsuario', true), array('action'=>'add'),array('class'=>'button')); ?> </li>
	</ul>
</div>
