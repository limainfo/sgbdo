
<div class="membrosconselhos view">
<h2><?php  __('Membrosconselho');?>
		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$membrosconselho['Membrosconselho']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$membrosconselho['Membrosconselho']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				
</h2>


	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt  class="altrow"><?php __('Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $membrosconselho['Membrosconselho']['id']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Militar'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($membrosconselho['Militar']['nm_completo'], array('controller' => 'militars', 'action' => 'view', $membrosconselho['Militar']['id'])); ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Cargosconselho'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($membrosconselho['Cargosconselho']['nm_cargo'], array('controller' => 'cargosconselhos', 'action' => 'view', $membrosconselho['Cargosconselho']['id'])); ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Tipo Licenca'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $membrosconselho['Membrosconselho']['tipo_licenca']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Dt Inicio'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $membrosconselho['Membrosconselho']['dt_inicio']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Dt Termino'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $membrosconselho['Membrosconselho']['dt_termino']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Unidade'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($membrosconselho['Unidade']['sigla_unidade'], array('controller' => 'unidades', 'action' => 'view', $membrosconselho['Unidade']['id'])); ?>
			&nbsp;
		</dt>
	</dl>
</div>

