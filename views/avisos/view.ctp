
<div class="paises view">
<h2><?php  __('Paise');?>
		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$paise['Paise']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$paise['Paise']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				
</h2>


	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt  class="altrow"><?php __('Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $paise['Paise']['id']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Sigla'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $paise['Paise']['sigla']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Idioma'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $paise['Paise']['idioma']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Nome'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $paise['Paise']['nome']; ?>
			&nbsp;
		</dt>
	</dl>
</div>

