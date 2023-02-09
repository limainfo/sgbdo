
<div class="baseIndicLocs view">
<h2><?php  __('Base Indic Loc');//?>
		&nbsp;&nbsp;&nbsp;
		<?php echo $html->link($html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $html->link($html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$baseIndicLoc['BaseIndicLoc']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$baseIndicLoc['BaseIndicLoc']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				
</h2>


	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt  class="altrow"><?php __('Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $baseIndicLoc['BaseIndicLoc']['id']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Indicativo'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $baseIndicLoc['BaseIndicLoc']['indicativo']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Descricao'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $baseIndicLoc['BaseIndicLoc']['descricao']; ?>
			&nbsp;
		</dt>
	</dl>
</div>

<div class="related">
	<h3><?php __('Related Epta Eptas');?></h3>
	<?php if (!empty($baseIndicLoc['EptaEpta'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Base Indic Loc Id'); ?></th>
		<th><?php __('Entidade'); ?></th>
		<th><?php __('Cidade'); ?></th>
		<th><?php __('Local'); ?></th>
		<th><?php __('Estado Id'); ?></th>
		<th><?php __('Categoria'); ?></th>
		<th><?php __('Portaria'); ?></th>
		<th><?php __('Portaria Dt'); ?></th>
		<th><?php __('Bca'); ?></th>
		<th><?php __('Bca Dt'); ?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($baseIndicLoc['EptaEpta'] as $eptaEpta):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $eptaEpta['id'];?></td>
			<td><?php echo $eptaEpta['base_indic_loc_id'];?></td>
			<td><?php echo $eptaEpta['entidade'];?></td>
			<td><?php echo $eptaEpta['cidade'];?></td>
			<td><?php echo $eptaEpta['local'];?></td>
			<td><?php echo $eptaEpta['estado_id'];?></td>
			<td><?php echo $eptaEpta['categoria'];?></td>
			<td><?php echo $eptaEpta['portaria'];?></td>
			<td><?php echo $eptaEpta['portaria_dt'];?></td>
			<td><?php echo $eptaEpta['bca'];?></td>
			<td><?php echo $eptaEpta['bca_dt'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'epta_eptas', 'action' => 'view', $eptaEpta['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'epta_eptas', 'action' => 'edit', $eptaEpta['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'epta_eptas', 'action' => 'delete', $eptaEpta['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $eptaEpta['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Epta Epta', true), array('controller' => 'epta_eptas', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
