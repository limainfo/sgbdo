<div class="consoles form">
<?php echo $this->Form->create('Console');?>
	<fieldset>
 		<legend><?php __('Cadastrar Console'); ?> 		&nbsp;&nbsp;&nbsp;
 		
 				&nbsp;&nbsp;&nbsp;
 		
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false), null,false); ?>
				
 		
 		</legend>
	<?php
		echo $this->Form->input('regiao_id',array('class'=>'formulario'));
		echo $this->Form->input('numero_console',array('class'=>'formulario'));
		echo $this->Form->input('qtd_posicao_principal',array('class'=>'formulario'));
		echo $this->Form->input('qtd_posicao_auxiliar',array('class'=>'formulario'));
		echo $this->Form->input('aeronaves_controladas',array('class'=>'formulario'));
		echo $this->Form->input('aeronaves_autorizadas',array('class'=>'formulario'));
		echo $this->Form->input('dt_obs',array('class'=>'formulario'));
		echo $this->Form->input('aeronaves_visuais',array('class'=>'formulario'));
		echo $this->Form->input('aeronaves_nao_identificadas',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
