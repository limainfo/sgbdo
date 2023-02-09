<div class="privilegios view">
<h2><?php  __('Privilegio');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $privilegio['Privilegio']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Acesso'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $privilegio['Privilegio']['acesso']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descricao'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $privilegio['Privilegio']['descricao']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<br>
<div class="actions">
	<ul>
		<li><?php //echo $this->Html->link(__('Editar Privilegio', true), array('action'=>'edit', $privilegio['Privilegio']['id']),array('class'=>'button')); ?> </li>
		<li><?php //echo $this->Html->link(__('Excluir Privilegio', true), array('action'=>'delete', $privilegio['Privilegio']['id']), array('class'=>'button'), sprintf(__('Tem certeza que deseja excluir  # %s?', true), $privilegio['Privilegio']['id'])); ?> </li>
		<li><?php //echo $this->Html->link(__('Exibir Privilegios', true), array('action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php //echo $this->Html->link(__('Cadastrar Privilegio', true), array('action'=>'add'),array('class'=>'button')); ?> </li>
		<li><?php //echo $this->Html->link(__('Exibir Tabelas', true), array('controller'=> 'tabelas', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php //echo $this->Html->link(__('Cadastrar Tabela', true), array('controller'=> 'tabelas', 'action'=>'add'),array('class'=>'button')); ?> </li>
		<li><?php //echo $this->Html->link(__('Exibir Usuarios', true), array('controller'=> 'usuarios', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php //echo $this->Html->link(__('Cadastrar Usuario', true), array('controller'=> 'usuarios', 'action'=>'add'),array('class'=>'button')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo 'Quantidade: ( '.count($posto['Militar']).' )';  ?><?php __(' Tabelas Relacionados');?></h3>
	<?php if (!empty($privilegio['Tabela'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Tabela'); ?></th>
		<th><?php __('Desc Tabela'); ?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($privilegio['Tabela'] as $tabela):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $tabela['tabela'];?></td>
			<td><?php echo $tabela['desc_tabela'];?></td>
			<td class="actions">
			<?php //echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('controller'=> 'tabelas', 'action'=>'view', $tabela['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php //echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('controller'=> 'tabelas', 'action'=>'edit', $tabela['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php // echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array('controller'=> 'tabelas', 'action'=>'delete', $privilegio['Privilegio']['id']), array('escape'=>false), sprintf(__('Tem certeza que deseja excluir # %s?', true), $tabela['id']),false); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php //echo $this->Html->link(__('Cadastrar Tabela', true), array('controller'=> 'tabelas', 'action'=>'add'),array('class'=>'button'));?> </li>
		</ul>
	</div>
</div>
<!-- <div class="related">
	<h3><?php __(' Usuarios Relacionados');?></h3>
	<?php if (!empty($privilegio['Usuario'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Militar Id'); ?></th>
		<th><?php __('Senha'); ?></th>
		<th><?php __('Privilegio Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Updated'); ?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($privilegio['Usuario'] as $usuario):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $usuario['id'];?></td>
			<td><?php echo $usuario['militar_id'];?></td>
			<td><?php echo $usuario['senha'];?></td>
			<td><?php echo $usuario['privilegio_id'];?></td>
			<td><?php echo $usuario['created'];?></td>
			<td><?php echo $usuario['updated'];?></td>
			<td class="actions">
			<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('controller'=> 'usuarios', 'action'=>'view', $usuario['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('controller'=> 'usuarios', 'action'=>'edit', $usuario['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array('controller'=> 'usuarios', 'action'=>'delete', $privilegio['Privilegio']['id']), array('escape'=>false), sprintf(__('Tem certeza que deseja excluir # %s?', true), $usuario['id']),false); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Cadastrar Usuario', true), array('controller'=> 'usuarios', 'action'=>'add'),array('class'=>'button'));?> </li>
		</ul>
	</div>
</div>
 -->
