
<div class="boletiminternos view">
<h2><?php  __('Boletiminterno');?>
		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$boletiminterno['Boletiminterno']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$boletiminterno['Boletiminterno']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				
</h2>


	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt  class="altrow"><?php __('Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $boletiminterno['Boletiminterno']['id']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Numero'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $boletiminterno['Boletiminterno']['numero']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Data Publicacao'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $boletiminterno['Boletiminterno']['data_publicacao']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Unidade'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($boletiminterno['Unidade']['sigla_unidade'], array('controller' => 'unidades', 'action' => 'view', $boletiminterno['Unidade']['id'])); ?>
			&nbsp;
		</dt>
	</dl>
</div>

