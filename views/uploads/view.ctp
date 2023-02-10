
<div class="uploads view">
<h2><?php  __('Upload');?>
		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$upload['Upload']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$upload['Upload']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				
</h2>


	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt  class="altrow"><?php __('Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $upload['Upload']['id']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Type'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $upload['Upload']['type']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Name'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $upload['Upload']['name']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Size'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $upload['Upload']['size']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Data'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $upload['Upload']['data']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Created'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $upload['Upload']['created']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Modified'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $upload['Upload']['modified']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Nm Tabela'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $upload['Upload']['nm_tabela']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Id Tabela'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $upload['Upload']['id_tabela']; ?>
			&nbsp;
		</dt>
	</dl>
</div>

