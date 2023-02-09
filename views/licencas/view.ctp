
<div class="licencas view">
<h2><?php  __('Licenca');?>
		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$licenca['Licenca']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$licenca['Licenca']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				
</h2>


	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt  class="altrow"><?php __('Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $licenca['Licenca']['id']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Unidade'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($licenca['Unidade']['sigla_unidade'], array('controller' => 'unidades', 'action' => 'view', $licenca['Unidade']['id'])); ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Militar'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($licenca['Militar']['nm_completo'], array('controller' => 'militars', 'action' => 'view', $licenca['Militar']['id'])); ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Documento Comprobatorio'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $licenca['Licenca']['documento_comprobatorio']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Numero Documento'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $licenca['Licenca']['numero_documento']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Ata'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($licenca['Ata']['numero'], array('controller' => 'atas', 'action' => 'view', $licenca['Ata']['id'])); ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Boletiminterno'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($licenca['Boletiminterno']['numero'], array('controller' => 'boletiminternos', 'action' => 'view', $licenca['Boletiminterno']['id'])); ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Numero Licenca'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $licenca['Licenca']['numero_licenca']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Tipo Licenca'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $licenca['Licenca']['tipo_licenca']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Ticket Solicitação'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $licenca['Licenca']['ticket']; ?>
			&nbsp;
		</dt>
	</dl>
</div>

