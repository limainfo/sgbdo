
<div class="cidades view">
<h2><?php  __('Cidade');?>
		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$cidade['Cidade']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$cidade['Cidade']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				
</h2>


	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt  class="altrow"><?php __('Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $cidade['Cidade']['id']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Estado'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($cidade['Estado']['nome'], array('controller' => 'estados', 'action' => 'view', $cidade['Estado']['id'])); ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Nome'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $cidade['Cidade']['nome']; ?>
			&nbsp;
		</dt>
	</dl>
</div>

