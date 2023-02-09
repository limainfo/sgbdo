<div class="militarsEscalas view">
<h2><?php  __('MilitarsEscala');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $militarsEscala['MilitarsEscala']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Escala'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($militarsEscala['Escala']['nm_escala'], array('controller'=> 'escalas', 'action'=>'view', $militarsEscala['Escala']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Militar'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($militarsEscala['Militar']['nm_completo'], array('controller'=> 'militars', 'action'=>'view', $militarsEscala['Militar']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Codigo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $militarsEscala['MilitarsEscala']['codigo']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<br>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Editar MilitarsEscala', true), array('action'=>'edit', $militarsEscala['MilitarsEscala']['id']),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Excluir MilitarsEscala', true), array('action'=>'delete', $militarsEscala['MilitarsEscala']['id']), array('class'=>'button'), sprintf(__('Tem certeza que deseja excluir  # %s?', true), $militarsEscala['MilitarsEscala']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir MilitarsEscalas', true), array('action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar MilitarsEscala', true), array('action'=>'add'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir Escalas', true), array('controller'=> 'escalas', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Escala', true), array('controller'=> 'escalas', 'action'=>'add'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir Militars', true), array('controller'=> 'militars', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Militar', true), array('controller'=> 'militars', 'action'=>'add'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir Execs Escalas', true), array('controller'=> 'execs_escalas', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Execs Escala', true), array('controller'=> 'execs_escalas', 'action'=>'add'),array('class'=>'button')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __(' Execs Escalas Relacionados');?></h3>
	<?php if (!empty($militarsEscala['ExecsEscala'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Escalas Turno Id'); ?></th>
		<th><?php __('Militars Escala Id'); ?></th>
		<th><?php __('Dt Prevista'); ?></th>
		<th><?php __('Militar Id Cumprida'); ?></th>
		<th><?php __('Obs Prevista'); ?></th>
		<th><?php __('Obs Cumprida'); ?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($militarsEscala['ExecsEscala'] as $execsEscala):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $execsEscala['id'];?></td>
			<td><?php echo $execsEscala['escalas_turno_id'];?></td>
			<td><?php echo $execsEscala['militars_escala_id'];?></td>
			<td><?php echo $execsEscala['dt_prevista'];?></td>
			<td><?php echo $execsEscala['militar_id_cumprida'];?></td>
			<td><?php echo $execsEscala['obs_prevista'];?></td>
			<td><?php echo $execsEscala['obs_cumprida'];?></td>
			<td class="actions">
			<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('controller'=> 'execs_escalas', 'action'=>'view', $execsEscala['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('controller'=> 'execs_escalas', 'action'=>'edit', $execsEscala['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array('controller'=> 'execs_escalas', 'action'=>'delete', $militarsEscala['MilitarsEscala']['id']), array('escape'=>false), sprintf(__('Tem certeza que deseja excluir # %s?', true), $execsEscala['id']),false); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Cadastrar Execs Escala', true), array('controller'=> 'execs_escalas', 'action'=>'add'),array('class'=>'button'));?> </li>
		</ul>
	</div>
</div>
