
<div class="exames view">
<h2><?php  __('Exame');?>
		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$exame['Exame']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$exame['Exame']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				
</h2>


	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt  class="altrow"><?php __('Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $exame['Exame']['id']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Militar'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($exame['Militar']['nm_completo'], array('controller' => 'militars', 'action' => 'view', $exame['Militar']['id'])); ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Data Exame'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $exame['Exame']['data_exame']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Parecer'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $exame['Exame']['parecer']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Data Validade'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $exame['Exame']['data_validade']; ?>
			&nbsp;
		</dt>
	</dl>
</div>

