
<div class="englishtowns view">
<h2><?php  __('Englishtown');?>
		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$englishtown['Englishtown']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$englishtown['Englishtown']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				
</h2>


	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt  class="altrow"><?php __('Mes'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $englishtown['Englishtown']['mes']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Ano'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $englishtown['Englishtown']['ano']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Posto'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $englishtown['Englishtown']['posto']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Especialidade'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $englishtown['Englishtown']['especialidade']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Nome Completo'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $englishtown['Englishtown']['nome_completo']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Nome Guerra'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $englishtown['Englishtown']['nome_guerra']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Orgao'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $englishtown['Englishtown']['orgao']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Local'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $englishtown['Englishtown']['Local']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Email'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $englishtown['Englishtown']['email']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Nivel Atual'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $englishtown['Englishtown']['nivel_atual']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Meta Icao'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $englishtown['Englishtown']['meta_icao']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Atividades'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $englishtown['Englishtown']['atividades']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Unidades'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $englishtown['Englishtown']['unidades']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Horas'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $englishtown['Englishtown']['horas']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Evolucao'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $englishtown['Englishtown']['evolucao']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Meta Npa'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $englishtown['Englishtown']['meta_npa']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Observacoes Tutoria'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $englishtown['Englishtown']['observacoes_tutoria']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $englishtown['Englishtown']['id']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Militar'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($englishtown['Militar']['nm_completo'], array('controller' => 'militars', 'action' => 'view', $englishtown['Militar']['id'])); ?>
			&nbsp;
		</dt>
	</dl>
</div>

