<div class="privilegiosTabelas view">
<h2><?php  __('PrivilegiosTabela');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $privilegiosTabela['PrivilegiosTabela']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Privilegio'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($privilegiosTabela['Privilegio']['id'], array('controller'=> 'privilegios', 'action'=>'view', $privilegiosTabela['Privilegio']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tabela'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($privilegiosTabela['Tabela']['id'], array('controller'=> 'tabelas', 'action'=>'view', $privilegiosTabela['Tabela']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Dia Inicio'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $privilegiosTabela['PrivilegiosTabela']['dia_inicio']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Dia Fim'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $privilegiosTabela['PrivilegiosTabela']['dia_fim']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ver'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $privilegiosTabela['PrivilegiosTabela']['ver']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Editar'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $privilegiosTabela['PrivilegiosTabela']['editar']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Adicionar'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $privilegiosTabela['PrivilegiosTabela']['adicionar']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Deletar'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $privilegiosTabela['PrivilegiosTabela']['deletar']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<br>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Editar PrivilegiosTabela', true), array('action'=>'edit', $privilegiosTabela['PrivilegiosTabela']['id']),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Excluir PrivilegiosTabela', true), array('action'=>'delete', $privilegiosTabela['PrivilegiosTabela']['id']), array('class'=>'button'), sprintf(__('Tem certeza que deseja excluir  # %s?', true), $privilegiosTabela['PrivilegiosTabela']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir PrivilegiosTabelas', true), array('action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar PrivilegiosTabela', true), array('action'=>'add'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir Privilegios', true), array('controller'=> 'privilegios', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Privilegio', true), array('controller'=> 'privilegios', 'action'=>'add'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir Tabelas', true), array('controller'=> 'tabelas', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Tabela', true), array('controller'=> 'tabelas', 'action'=>'add'),array('class'=>'button')); ?> </li>
	</ul>
</div>
