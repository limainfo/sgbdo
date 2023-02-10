<div class="setorsUsuarios view">
<h2><?php  __('SetorsUsuario');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $setorsUsuario['SetorsUsuario']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Usuario Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $setorsUsuario['SetorsUsuario']['usuario_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Setor Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $setorsUsuario['SetorsUsuario']['setor_id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<br>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Editar SetorsUsuario', true), array('action'=>'edit', $setorsUsuario['SetorsUsuario']['id']),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Excluir SetorsUsuario', true), array('action'=>'delete', $setorsUsuario['SetorsUsuario']['id']), array('class'=>'button'), sprintf(__('Tem certeza que deseja excluir  # %s?', true), $setorsUsuario['SetorsUsuario']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir SetorsUsuarios', true), array('action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar SetorsUsuario', true), array('action'=>'add'),array('class'=>'button')); ?> </li>
	</ul>
</div>
