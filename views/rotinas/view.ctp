
<div class="rotinas view">
<h2><?php  __('Rotina');?>
		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$rotina['Rotina']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$rotina['Rotina']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				
</h2>


	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt  class="altrow"><?php __('Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $rotina['Rotina']['id']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Orgao Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $rotina['Rotina']['orgao_id']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Setor'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($rotina['Setor']['sigla_setor'], array('controller' => 'setors', 'action' => 'view', $rotina['Setor']['id'])); ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Doc Referencia'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $rotina['Rotina']['doc_referencia']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Acao'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $rotina['Rotina']['acao']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Responsavel'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $rotina['Rotina']['responsavel']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Periodicidade'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($rotina['Periodicidade']['desc_periodicidade'], array('controller' => 'periodicidades', 'action' => 'view', $rotina['Periodicidade']['id'])); ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Dia Previsto'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $rotina['Rotina']['dia_previsto']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Mes Previsto'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $rotina['Rotina']['mes_previsto']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Rotina Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $rotina['Rotina']['rotina_id']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Ativa'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $rotina['Rotina']['ativa']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Created'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $rotina['Rotina']['created']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Dt Referencia'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $rotina['Rotina']['dt_referencia']; ?>
			&nbsp;
		</dt>
	</dl>
</div>

<div class="related">
	<h3><?php __('Related Calendariorotinas');?></h3>
	<?php if (!empty($rotina['Calendariorotina'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Rotina Id'); ?></th>
		<th><?php __('Rubrica'); ?></th>
		<th><?php __('Obs'); ?></th>
		<th><?php __('Dt Inicio Previsto'); ?></th>
		<th><?php __('Updated'); ?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($rotina['Calendariorotina'] as $calendariorotina):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $calendariorotina['id'];?></td>
			<td><?php echo $calendariorotina['rotina_id'];?></td>
			<td><?php echo $calendariorotina['rubrica'];?></td>
			<td><?php echo $calendariorotina['obs'];?></td>
			<td><?php echo $calendariorotina['dt_inicio_previsto'];?></td>
			<td><?php echo $calendariorotina['updated'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'calendariorotinas', 'action' => 'view', $calendariorotina['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'calendariorotinas', 'action' => 'edit', $calendariorotina['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'calendariorotinas', 'action' => 'delete', $calendariorotina['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $calendariorotina['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Calendariorotina', true), array('controller' => 'calendariorotinas', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
