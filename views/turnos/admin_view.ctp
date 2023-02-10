<div class="turnos view">
<h2><?php  __('Turno');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $turno['Turno']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nm Turno'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $turno['Turno']['nm_turno']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Inicio Turno'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $turno['Turno']['inicio_turno']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fim Turno'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $turno['Turno']['fim_turno']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Qtd Militares'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $turno['Turno']['qtd_militares']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<br>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Editar Turno', true), array('action'=>'edit', $turno['Turno']['id']),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Excluir Turno', true), array('action'=>'delete', $turno['Turno']['id']), array('class'=>'button'), sprintf(__('Tem certeza que deseja excluir  # %s?', true), $turno['Turno']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir Turnos', true), array('action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Turno', true), array('action'=>'add'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir Escalas Turnos', true), array('controller'=> 'escalas_turnos', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Escalas Turnos', true), array('controller'=> 'escalas_turnos', 'action'=>'add'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir Escalas', true), array('controller'=> 'escalas', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Escala', true), array('controller'=> 'escalas', 'action'=>'add'),array('class'=>'button')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __(' Escalas Turnos Relacionados');?></h3>
	<?php if (!empty($turno['EscalasTurnos'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Escala Id'); ?></th>
		<th><?php __('Turno Id'); ?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($turno['EscalasTurnos'] as $escalasTurnos):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $escalasTurnos['id'];?></td>
			<td><?php echo $escalasTurnos['escala_id'];?></td>
			<td><?php echo $escalasTurnos['turno_id'];?></td>
			<td class="actions">
			<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('controller'=> 'escalas_turnos', 'action'=>'view', $escalasTurnos['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('controller'=> 'escalas_turnos', 'action'=>'edit', $escalasTurnos['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array('controller'=> 'escalas_turnos', 'action'=>'delete', $turno['Turno']['id']), array('escape'=>false), sprintf(__('Tem certeza que deseja excluir # %s?', true), $escalasTurnos['id']),false); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Cadastrar Escalas Turnos', true), array('controller'=> 'escalas_turnos', 'action'=>'add'),array('class'=>'button'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __(' Escalas Relacionados');?></h3>
	<?php if (!empty($turno['Escala'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Orgao Id'); ?></th>
		<th><?php __('Nm Escala'); ?></th>
		<th><?php __('Tipo Escala'); ?></th>
		<th><?php __('Nm Escalante'); ?></th>
		<th><?php __('Hora Instrucao'); ?></th>
		<th><?php __('Efetivo Total'); ?></th>
		<th><?php __('Dt Limite Cumprida'); ?></th>
		<th><?php __('Dt Limite Previsao'); ?></th>
		<th><?php __('Nm Comandante'); ?></th>
		<th><?php __('Qtd Militares'); ?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($turno['Escala'] as $escala):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $escala['id'];?></td>
			<td><?php echo $escala['orgao_id'];?></td>
			<td><?php echo $escala['nm_escala'];?></td>
			<td><?php echo $escala['tipo_escala'];?></td>
			<td><?php echo $escala['nm_escalante'];?></td>
			<td><?php echo $escala['hora_instrucao'];?></td>
			<td><?php echo $escala['efetivo_total'];?></td>
			<td><?php echo $escala['dt_limite_cumprida'];?></td>
			<td><?php echo $escala['dt_limite_previsao'];?></td>
			<td><?php echo $escala['nm_comandante'];?></td>
			<td><?php echo $escala['qtd_militares'];?></td>
			<td class="actions">
			<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('controller'=> 'escalas', 'action'=>'view', $escala['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('controller'=> 'escalas', 'action'=>'edit', $escala['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array('controller'=> 'escalas', 'action'=>'delete', $turno['Turno']['id']), array('escape'=>false), sprintf(__('Tem certeza que deseja excluir # %s?', true), $escala['id']),false); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Cadastrar Escala', true), array('controller'=> 'escalas', 'action'=>'add'),array('class'=>'button'));?> </li>
		</ul>
	</div>
</div>
