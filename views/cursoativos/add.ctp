<div class="cursoativos form">
<?php echo $form->create('Cursoativo');?>
	<fieldset>
 		<legend><?php __('Mapear PAEAT/EXTRA/PACESP');?>&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?> 		
 		</legend>
 		
 		
	<?php
	$ano = array();
	for($i=2009;$i<=(date('Y')+1);$i++){
		$ano[$i] = $i;
	}
		echo $form->input('ano_base',array('class'=>'formulario','options'=>$ano));
		//
		echo $form->input('tipocurso_id',array('class'=>'formulario'));
		echo $form->input('status_atual',array('class'=>'formulario','options'=>array('ATIVADO'=>'ATIVADO','PREVISTO'=>'PREVISTO','CONCLUIDO'=>'CONCLUIDO','CANCELADO'=>'CANCELADO')));
		echo $form->input('natureza',array('class'=>'formulario','options'=>array('REGULAR'=>'REGULAR','EXTRA'=>'EXTRA')));
		echo $form->input('curso_id',array('class'=>'formulario'));
		echo $form->input('turma',array('class'=>'formulario'));
		echo $datePicker->picker('data_inicio',array('readonly'=>'','class'=>'formulario'));
		echo $datePicker->picker('data_termino',array('readonly'=>'','class'=>'formulario'));
		echo $form->input('vagas',array('class'=>'formulario'));
		echo $form->input('documento_ativacao',array('class'=>'formulario'));
		echo $form->input('local_realizacao',array('class'=>'formulario'));
		?>
	</fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
