<div class="rotinas form">
<?php echo $this->Form->create('Rotina');?>
	<fieldset>
 		<legend><?php __('Cadastrar Rotina'); ?> 		&nbsp;&nbsp;&nbsp;
 		
 				&nbsp;&nbsp;&nbsp;
 		
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false), null,false); ?>
				
 		
 		</legend>
	<?php
		echo $this->Form->input('orgao_id',array('class'=>'formulario'));
		echo $this->Form->input('setor_id',array('class'=>'formulario'));
		echo $this->Form->input('doc_referencia',array('class'=>'formulario'));
		echo $this->Form->input('acao',array('class'=>'formulario'));
		echo $this->Form->input('responsavel',array('class'=>'formulario'));
		echo $this->Form->input('periodicidade_id',array('class'=>'formulario'));
		echo $this->Form->input('dia_previsto',array('class'=>'formulario'));
		echo $this->Form->input('mes_previsto',array('class'=>'formulario'));
		echo $this->Form->input('rotina_id',array('class'=>'formulario'));
		echo $this->Form->input('ativa',array('class'=>'formulario'));
		echo $this->Form->input('dt_referencia',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
