
<div class="atividadelicencas view">
<h2><?php  __('Atividadelicenca');?>
		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$atividadelicenca['Atividadelicenca']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$atividadelicenca['Atividadelicenca']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				
</h2>


	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt  class="altrow"><?php __('Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $atividadelicenca['Atividadelicenca']['id']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Atividade'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $atividadelicenca['Atividadelicenca']['atividade']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Desc Atividade'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $atividadelicenca['Atividadelicenca']['desc_atividade']; ?>
			&nbsp;
		</dt>
	</dl>
</div>

