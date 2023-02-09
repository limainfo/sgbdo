
<div class="consoles view">
<h2><?php  __('Console');?>
		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$console['Console']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$console['Console']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				
</h2>


	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt  class="altrow"><?php __('Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $console['Console']['id']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Regiao Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $console['Console']['regiao_id']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Numero Console'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $console['Console']['numero_console']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Qtd Posicao Principal'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $console['Console']['qtd_posicao_principal']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Qtd Posicao Auxiliar'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $console['Console']['qtd_posicao_auxiliar']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Aeronaves Controladas'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $console['Console']['aeronaves_controladas']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Aeronaves Autorizadas'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $console['Console']['aeronaves_autorizadas']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Dt Obs'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $console['Console']['dt_obs']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Aeronaves Visuais'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $console['Console']['aeronaves_visuais']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Aeronaves Nao Identificadas'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $console['Console']['aeronaves_nao_identificadas']; ?>
			&nbsp;
		</dt>
	</dl>
</div>

