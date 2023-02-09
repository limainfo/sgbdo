<div class="englishtowns form">
<?php echo $this->Form->create('Englishtown');?>
	<fieldset>
 		<legend><?php __('Cadastrar Englishtown'); ?> 		&nbsp;&nbsp;&nbsp;
 		
 				&nbsp;&nbsp;&nbsp;
 		
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false), null,false); ?>
				
 		
 		</legend>
	<?php
		echo $this->Form->input('mes',array('class'=>'formulario'));
		echo $this->Form->input('ano',array('class'=>'formulario'));
		echo $this->Form->input('posto',array('class'=>'formulario'));
		echo $this->Form->input('especialidade',array('class'=>'formulario'));
		echo $this->Form->input('nome_completo',array('class'=>'formulario'));
		echo $this->Form->input('nome_guerra',array('class'=>'formulario'));
		echo $this->Form->input('orgao',array('class'=>'formulario'));
		echo $this->Form->input('Local',array('class'=>'formulario'));
		echo $this->Form->input('email',array('class'=>'formulario'));
		echo $this->Form->input('nivel_atual',array('class'=>'formulario'));
		echo $this->Form->input('meta_icao',array('class'=>'formulario'));
		echo $this->Form->input('atividades',array('class'=>'formulario'));
		echo $this->Form->input('unidades',array('class'=>'formulario'));
		echo $this->Form->input('horas',array('class'=>'formulario'));
		echo $this->Form->input('evolucao',array('class'=>'formulario'));
		echo $this->Form->input('meta_npa',array('class'=>'formulario'));
		echo $this->Form->input('observacoes_tutoria',array('class'=>'formulario'));
		echo $this->Form->input('militar_id',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
