
<div class="localidades view">
<h2><?php  __('Localidade');?>
		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$localidade['Localidade']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$localidade['Localidade']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				
</h2>


	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt  class="altrow"><?php __('Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $localidade['Localidade']['id']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Sigla Localidade'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $localidade['Localidade']['sigla_localidade']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Desc Localidade'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $localidade['Localidade']['desc_localidade']; ?>
			&nbsp;
		</dt>
	</dl>
</div>

<div class="related">
	<h3><?php __('Related Unidades');?></h3>
	<?php if (!empty($localidade['Unidade'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Comando'); ?></th>
		<th><?php __('Codarea'); ?></th>
		<th><?php __('Area'); ?></th>
		<th><?php __('Estado Id'); ?></th>
		<th><?php __('Nm Unidade'); ?></th>
		<th><?php __('Sigla Unidade'); ?></th>
		<th><?php __('Nm Cmt Unidade'); ?></th>
		<th><?php __('Tel Unidade'); ?></th>
		<th><?php __('Inicio Numero Licenca'); ?></th>
		<th><?php __('Fim Numero Licenca'); ?></th>
		<th><?php __('Numero Licenca Atual'); ?></th>
		<th><?php __('Letra Licenca Atual'); ?></th>
		<th><?php __('Nv Manutencao'); ?></th>
		<th><?php __('Numero Replicacao'); ?></th>
		<th><?php __('Militar Sn'); ?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($localidade['Unidade'] as $unidade):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $unidade['id'];?></td>
			<td><?php echo $unidade['comando'];?></td>
			<td><?php echo $unidade['codarea'];?></td>
			<td><?php echo $unidade['area'];?></td>
			<td><?php echo $unidade['estado_id'];?></td>
			<td><?php echo $unidade['nm_unidade'];?></td>
			<td><?php echo $unidade['sigla_unidade'];?></td>
			<td><?php echo $unidade['nm_cmt_unidade'];?></td>
			<td><?php echo $unidade['tel_unidade'];?></td>
			<td><?php echo $unidade['inicio_numero_licenca'];?></td>
			<td><?php echo $unidade['fim_numero_licenca'];?></td>
			<td><?php echo $unidade['numero_licenca_atual'];?></td>
			<td><?php echo $unidade['letra_licenca_atual'];?></td>
			<td><?php echo $unidade['nv_manutencao'];?></td>
			<td><?php echo $unidade['numero_replicacao'];?></td>
			<td><?php echo $unidade['militar_sn'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'unidades', 'action' => 'view', $unidade['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'unidades', 'action' => 'edit', $unidade['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'unidades', 'action' => 'delete', $unidade['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $unidade['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Unidade', true), array('controller' => 'unidades', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
