
<div class="qualificacaos view">
<h2><?php  __('Qualificacao');?>
		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$qualificacao['Qualificacao']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$qualificacao['Qualificacao']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				
</h2>


	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt  class="altrow"><?php __('Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $qualificacao['Qualificacao']['id']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Nm Qualificacao'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $qualificacao['Qualificacao']['nm_qualificacao']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Sigla Qualificacao'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $qualificacao['Qualificacao']['sigla_qualificacao']; ?>
			&nbsp;
		</dt>
	</dl>
</div>

