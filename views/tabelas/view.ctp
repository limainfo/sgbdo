<div class="tabelas view">
<h2><?php  __('Tabela');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tabela['Tabela']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tabela'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tabela['Tabela']['tabela']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Desc Tabela'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tabela['Tabela']['desc_tabela']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<br>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Editar Tabela', true), array('action'=>'edit', $tabela['Tabela']['id']),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Excluir Tabela', true), array('action'=>'delete', $tabela['Tabela']['id']), array('class'=>'button'), sprintf(__('Tem certeza que deseja excluir  # %s?', true), $tabela['Tabela']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir Tabelas', true), array('action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Tabela', true), array('action'=>'add'),array('class'=>'button')); ?> </li>
	</ul>
</div>
