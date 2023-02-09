<div class="parecerestecnicos view">
<h2><?php  __('Parecerestecnico');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $parecerestecnico['Parecerestecnico']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Oficio'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $parecerestecnico['Parecerestecnico']['oficio']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sereng'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $parecerestecnico['Parecerestecnico']['sereng']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Entrada Cindacta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $parecerestecnico['Parecerestecnico']['entrada_cindacta']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Entrada Opats'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $parecerestecnico['Parecerestecnico']['entrada_opats']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Situacao'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $parecerestecnico['Parecerestecnico']['situacao']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Parecer'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $parecerestecnico['Parecerestecnico']['parecer']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Arquivo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $parecerestecnico['Parecerestecnico']['arquivo']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<br>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Editar Parecerestecnico', true), array('action'=>'edit', $parecerestecnico['Parecerestecnico']['id']),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Excluir Parecerestecnico', true), array('action'=>'delete', $parecerestecnico['Parecerestecnico']['id']), array('class'=>'button'), sprintf(__('Tem certeza que deseja excluir  # %s?', true), $parecerestecnico['Parecerestecnico']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir Parecerestecnicos', true), array('action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Parecerestecnico', true), array('action'=>'add'),array('class'=>'button')); ?> </li>
	</ul>
</div>
