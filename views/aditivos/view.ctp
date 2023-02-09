<div class="aditivos view">
<h2><?php  echo __('Aditivo');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($aditivo['Aditivo']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Orgao'); ?></dt>
		<dd>
			<?php echo h($aditivo['Aditivo']['orgao']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Classe'); ?></dt>
		<dd>
			<?php echo h($aditivo['Aditivo']['classe']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Carga Minima'); ?></dt>
		<dd>
			<?php echo h($aditivo['Aditivo']['carga_minima']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Carga Maxima'); ?></dt>
		<dd>
			<?php echo h($aditivo['Aditivo']['carga_maxima']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Efetivo Atco'); ?></dt>
		<dd>
			<?php echo h($aditivo['Aditivo']['efetivo_atco']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Efetivo Supervisor Setorial'); ?></dt>
		<dd>
			<?php echo h($aditivo['Aditivo']['efetivo_supervisor_setorial']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Efetivo Supervisor Equipe'); ?></dt>
		<dd>
			<?php echo h($aditivo['Aditivo']['efetivo_supervisor_equipe']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Efetivo Total'); ?></dt>
		<dd>
			<?php echo h($aditivo['Aditivo']['efetivo_total']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Efetivo Existente'); ?></dt>
		<dd>
			<?php echo h($aditivo['Aditivo']['efetivo_existente']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total Efetivo Operacional'); ?></dt>
		<dd>
			<?php echo h($aditivo['Aditivo']['total_efetivo_operacional']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total Efetivo Operacional 15'); ?></dt>
		<dd>
			<?php echo h($aditivo['Aditivo']['total_efetivo_operacional_15']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Aditivo'), array('action' => 'edit', $aditivo['Aditivo']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Aditivo'), array('action' => 'delete', $aditivo['Aditivo']['id']), null, __('Are you sure you want to delete # %s?', $aditivo['Aditivo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Aditivos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Aditivo'), array('action' => 'add')); ?> </li>
	</ul>
</div>
