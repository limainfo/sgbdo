<center>
<div class="atas view">
<h2><?php  __('Ata');?>
		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$ata['Ata']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$ata['Ata']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				
</h2>


	<dl><?php $i = 0; $class = ' class="altrow"';?>

		<dt  class="altrow"><?php __('Numero'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $ata['Ata']['numero']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Observacao'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $ata['Ata']['observacao']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Data Reuniao'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $ata['Ata']['data_reuniao']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Unidade'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($ata['Unidade']['sigla_unidade'], array('controller' => 'unidades', 'action' => 'view', $ata['Unidade']['id'])); ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Boletiminterno'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($ata['Boletiminterno']['numero'], array('controller' => 'boletiminternos', 'action' => 'view', $ata['Boletiminterno']['id'])); ?>
			&nbsp;
		</dt>
                <hr>
		<dt  class="altrow"><?php __('Conteudo'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $ata['Ata']['conteudo_ata']; ?>
			&nbsp;
		</dt>
	</dl>
</div>
</center>
