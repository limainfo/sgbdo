<div class="usuarios view">
<h2><?php  __('Usuario');?>&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'add', null),array('escape'=>false, 'escape'=>false), null,false); ?>
</h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt><?php __('Militar'); ?>:&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($usuario['Militar']['nm_completo'], array('controller'=> 'militars', 'action'=>'view', $usuario['Militar']['id'])); ?>
			&nbsp;
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Senha'); ?>:&nbsp;&nbsp;&nbsp;
			<?php echo $usuario['Usuario']['senha']; ?>
			&nbsp;
		</dt>
		
	</dl>
</div>
<br>
<?php /*
       * 
       *
 ?>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Editar Usuario', true), array('action'=>'edit', $usuario['Usuario']['id']),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Excluir Usuario', true), array('action'=>'delete', $usuario['Usuario']['id']), array('class'=>'button'), sprintf(__('Tem certeza que deseja excluir  # %s?', true), $usuario['Usuario']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir Usuarios', true), array('action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Usuario', true), array('action'=>'add'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir Militars', true), array('controller'=> 'militars', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Militar', true), array('controller'=> 'militars', 'action'=>'add'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir Privilegios', true), array('controller'=> 'privilegios', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Privilegio', true), array('controller'=> 'privilegios', 'action'=>'add'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir Setors', true), array('controller'=> 'setors', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Setor', true), array('controller'=> 'setors', 'action'=>'add'),array('class'=>'button')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __(' Privilegios Relacionados');?></h3>
	<?php if (!empty($usuario['Privilegio'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Acesso'); ?></th>
		<th><?php __('Descricao'); ?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($usuario['Privilegio'] as $privilegio):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $privilegio['id'];?></td>
			<td><?php echo $privilegio['acesso'];?></td>
			<td><?php echo $privilegio['descricao'];?></td>
			<td class="actions">
			<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('controller'=> 'privilegios', 'action'=>'view', $privilegio['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('controller'=> 'privilegios', 'action'=>'edit', $privilegio['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array('controller'=> 'privilegios', 'action'=>'delete', $usuario['Usuario']['id']), array('escape'=>false), sprintf(__('Tem certeza que deseja excluir # %s?', true), $privilegio['id']),false); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Cadastrar Privilegio', true), array('controller'=> 'privilegios', 'action'=>'add'),array('class'=>'button'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __(' Setors Relacionados');?></h3>
	<?php if (!empty($usuario['Setor'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Unidade Id'); ?></th>
		<th><?php __('Nm Setor'); ?></th>
		<th><?php __('Sigla Setor'); ?></th>
		<th><?php __('Nm Chefe Setor'); ?></th>
		<th><?php __('Tel Setor'); ?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($usuario['Setor'] as $setor):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $setor['id'];?></td>
			<td><?php echo $setor['unidade_id'];?></td>
			<td><?php echo $setor['nm_setor'];?></td>
			<td><?php echo $setor['sigla_setor'];?></td>
			<td><?php echo $setor['nm_chefe_setor'];?></td>
			<td><?php echo $setor['tel_setor'];?></td>
			<td class="actions">
			<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('controller'=> 'setors', 'action'=>'view', $setor['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('controller'=> 'setors', 'action'=>'edit', $setor['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array('controller'=> 'setors', 'action'=>'delete', $usuario['Usuario']['id']), array('escape'=>false), sprintf(__('Tem certeza que deseja excluir # %s?', true), $setor['id']),false); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Cadastrar Setor', true), array('controller'=> 'setors', 'action'=>'add'),array('class'=>'button'));?> </li>
		</ul>
	</div>
</div>
<?php 
*/
 ?>