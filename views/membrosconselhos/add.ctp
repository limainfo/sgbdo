<?php 
include $caminhoAditivos;
?><div class="membrosconselhos form">
<?php echo $this->Form->create('Membrosconselho');?>
	<fieldset>
 		<legend><?php __('Cadastrar Membros do Conselho'); ?> 		&nbsp;&nbsp;&nbsp;
 		
 				&nbsp;&nbsp;&nbsp;
 		
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false), null,false); ?>
				
 		
 		</legend>
	<?php
		echo $this->Form->input('militar_id',array('class'=>'formulario'));
		echo $this->Form->input('cargosconselho_id',array('class'=>'formulario','label'=>'Cargo'));
		echo $this->Form->input('tipo_licenca',array('class'=>'formulario','options'=>$tipos_licencas));
		echo $datePicker->picker('dt_inicio',array('class'=>'formulario'));
		echo $datePicker->picker('dt_termino',array('class'=>'formulario'));
		echo $this->Form->input('unidade_id',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
