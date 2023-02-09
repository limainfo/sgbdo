
<div class="cargosconselhos view">
<h2><?php  __('Cargosconselho');?>
		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$cargosconselho['Cargosconselho']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$cargosconselho['Cargosconselho']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				
</h2>


	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt  class="altrow"><?php __('Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $cargosconselho['Cargosconselho']['id']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Nm Cargo'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $cargosconselho['Cargosconselho']['nm_cargo']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Descricao'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $cargosconselho['Cargosconselho']['descricao']; ?>
			&nbsp;
		</dt>
	</dl>
</div>

