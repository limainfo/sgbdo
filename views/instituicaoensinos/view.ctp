
<div class="instituicaoensinos view">
<h2><?php  __('Instituicaoensino');?>
		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$instituicaoensino['Instituicaoensino']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$instituicaoensino['Instituicaoensino']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				
</h2>


	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt  class="altrow"><?php __('Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $instituicaoensino['Instituicaoensino']['id']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Nm Instituicao'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $instituicaoensino['Instituicaoensino']['nm_instituicao']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Descricao'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $instituicaoensino['Instituicaoensino']['descricao']; ?>
			&nbsp;
		</dt>
	</dl>
</div>

