
<div class="empreendimentos view">
<h2><?php  __('Empreendimento');?>
		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$empreendimento['Empreendimento']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$empreendimento['Empreendimento']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				
</h2>


	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt  class="altrow"><?php __('Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $empreendimento['Empreendimento']['id']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Controle'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $empreendimento['Empreendimento']['controle']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Localidade'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $empreendimento['Empreendimento']['localidade']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Projeto'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $empreendimento['Empreendimento']['projeto']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Tarefa'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $empreendimento['Empreendimento']['tarefa']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Prazo'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $empreendimento['Empreendimento']['prazo']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Responsavel'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $empreendimento['Empreendimento']['responsavel']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Status'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $empreendimento['Empreendimento']['status']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Observacao'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $empreendimento['Empreendimento']['observacao']; ?>
			&nbsp;
		</dt>
	</dl>
</div>

