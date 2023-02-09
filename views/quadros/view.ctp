
<div class="quadros view">
<h2><?php  __('Quadro');?>
		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$quadro['Quadro']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$quadro['Quadro']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				
</h2>


	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt  class="altrow"><?php __('Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $quadro['Quadro']['id']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Nm Quadro'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $quadro['Quadro']['nm_quadro']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Sigla Quadro'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $quadro['Quadro']['sigla_quadro']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Semespec'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $quadro['Quadro']['semespec']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Codq'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $quadro['Quadro']['codq']; ?>
			&nbsp;
		</dt>
	</dl>
</div>

<div class="related">
	<h3><?php __('Related Especialidades');?></h3>
	<?php if (!empty($quadro['Especialidade'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Quadro Id'); ?></th>
		<th><?php __('Nm Especialidade'); ?></th>
		<th><?php __('Desc Especialidade'); ?></th>
		<th><?php __('Numeracao'); ?></th>
		<th><?php __('Equivalente Drhu'); ?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($quadro['Especialidade'] as $especialidade):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $especialidade['id'];?></td>
			<td><?php echo $especialidade['quadro_id'];?></td>
			<td><?php echo $especialidade['nm_especialidade'];?></td>
			<td><?php echo $especialidade['desc_especialidade'];?></td>
			<td><?php echo $especialidade['numeracao'];?></td>
			<td><?php echo $especialidade['equivalente_drhu'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'especialidades', 'action' => 'view', $especialidade['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'especialidades', 'action' => 'edit', $especialidade['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'especialidades', 'action' => 'delete', $especialidade['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $especialidade['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Especialidade', true), array('controller' => 'especialidades', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
