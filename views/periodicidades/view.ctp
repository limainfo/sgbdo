<div class="periodicidades view">
<h2><?php  __('Periodicidade');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Periodicidade'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $periodicidade['Periodicidade']['periodicidade']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Desc Periodicidade'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $periodicidade['Periodicidade']['desc_periodicidade']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nr Dias'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $periodicidade['Periodicidade']['nr_dias']; ?>
		</dt>
	</dl>
</div>
<br>
<div class="related">
	<h3><?php echo 'Quantidade: ( '.count($periodicidade['Rotina']).' )'; ?><?php __(' Rotinas Relacionados');?></h3>
	<?php if (!empty($periodicidade['Rotina'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Referencia'); ?></th>
		<th><?php __('Acao'); ?></th>
		<th><?php __('Responsavel'); ?></th>
		<th><?php __('Dia Previsto'); ?></th>
		<th><?php __('Mes Previsto'); ?></th>
		<th><?php __('Ativa'); ?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($periodicidade['Rotina'] as $rotina):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $rotina['referencia'];?></td>
			<td><?php echo $rotina['acao'];?></td>
			<td><?php echo $rotina['responsavel'];?></td>
			<td><?php echo $rotina['dia_previsto'];?></td>
			<td><?php echo $rotina['mes_previsto'];?></td>
			<td><?php echo $rotina['ativa'];?></td>
			<td class="actions">
			<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('controller'=> 'rotinas', 'action'=>'view', $rotina['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('controller'=> 'rotinas', 'action'=>'edit', $rotina['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array('controller'=> 'rotinas', 'action'=>'delete', $periodicidade['Periodicidade']['id']), array('escape'=>false), sprintf(__('Tem certeza que deseja excluir # %s?', true), $rotina['id']),false); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Cadastrar Rotina', true), array('controller'=> 'rotinas', 'action'=>'add'),array('class'=>'button'));?> </li>
		</ul>
	</div>
</div>
