<? include ($caminhoAditivos); ?>
<div class="eptaEptas view">
<h2><?php  __('Epta Epta');?>
		&nbsp;&nbsp;&nbsp;
		<?php echo $html->link($html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $html->link($html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$eptaEpta['EptaEpta']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$eptaEpta['EptaEpta']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				
</h2>


	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt  class="altrow"><?php __('Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $eptaEpta['EptaEpta']['id']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Base Indic Loc'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($eptaEpta['BaseIndicLoc']['indicativo'], array('controller' => 'base_indic_locs', 'action' => 'view', $eptaEpta['BaseIndicLoc']['id'])); ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Entidade'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $eptaEpta['EptaEpta']['entidade']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Cidade'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $eptaEpta['EptaEpta']['cidade']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Local'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $eptaEpta['EptaEpta']['local']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Estado'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($eptaEpta['Estado']['nome'], array('controller' => 'estados', 'action' => 'view', $eptaEpta['Estado']['id'])); ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Categoria'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $categorias[$eptaEpta['EptaEpta']['categoria']]; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Portaria'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $eptaEpta['EptaEpta']['portaria']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Portaria Dt'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $eptaEpta['EptaEpta']['portaria_dt']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Bca'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $eptaEpta['EptaEpta']['bca']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Bca Dt'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $eptaEpta['EptaEpta']['bca_dt']; ?>
			&nbsp;
		</dt>
	</dl>
</div>

