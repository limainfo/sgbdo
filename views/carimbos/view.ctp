
<div class="carimbos view">
<h2><?php  __('Carimbo');?>
		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$carimbo['Carimbo']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$carimbo['Carimbo']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				
</h2>


	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt  class="altrow"><?php __('Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $carimbo['Carimbo']['id']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Emitente'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $carimbo['Carimbo']['emitente']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Funcao'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $carimbo['Carimbo']['funcao']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Type'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $carimbo['Carimbo']['type']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Name'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $carimbo['Carimbo']['name']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Size'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $carimbo['Carimbo']['size']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Data'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php //echo $carimbo['Carimbo']['data']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Created'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $carimbo['Carimbo']['created']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Updated'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $carimbo['Carimbo']['updated']; ?>
			&nbsp;
		</dt>
	</dl>
</div>

<div class="related">
	<h3><?php __('Related Licencas');?></h3>
	<?php if (!empty($carimbo['Licenca'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Unidade Id'); ?></th>
		<th><?php __('Militar Id'); ?></th>
		<th><?php __('Documento Comprobatorio'); ?></th>
		<th><?php __('Numero Documento'); ?></th>
		<th><?php __('Ata Id'); ?></th>
		<th><?php __('Boletiminterno Id'); ?></th>
		<th><?php __('Nr Licenca'); ?></th>
		<th><?php __('Indicativo'); ?></th>
		<th><?php __('Codigo Barra'); ?></th>
		<th><?php __('Expedicao'); ?></th>
		<th><?php __('Validade'); ?></th>
		<th><?php __('Tipo Licenca'); ?></th>
		<th><?php __('Ticket'); ?></th>
		<th><?php __('Carimbo Id'); ?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($carimbo['Licenca'] as $licenca):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $licenca['id'];?></td>
			<td><?php echo $licenca['unidade_id'];?></td>
			<td><?php echo $licenca['militar_id'];?></td>
			<td><?php echo $licenca['documento_comprobatorio'];?></td>
			<td><?php echo $licenca['numero_documento'];?></td>
			<td><?php echo $licenca['ata_id'];?></td>
			<td><?php echo $licenca['boletiminterno_id'];?></td>
			<td><?php echo $licenca['nr_licenca'];?></td>
			<td><?php echo $licenca['indicativo'];?></td>
			<td><?php echo $licenca['codigo_barra'];?></td>
			<td><?php echo $licenca['expedicao'];?></td>
			<td><?php echo $licenca['validade'];?></td>
			<td><?php echo $licenca['tipo_licenca'];?></td>
			<td><?php echo $licenca['ticket'];?></td>
			<td><?php echo $licenca['carimbo_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'licencas', 'action' => 'view', $licenca['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'licencas', 'action' => 'edit', $licenca['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'licencas', 'action' => 'delete', $licenca['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $licenca['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Licenca', true), array('controller' => 'licencas', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
