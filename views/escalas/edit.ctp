<div class="escalas form">
<?php echo $form->create('Escala');?>
	<fieldset>
 		<legend><?php __('Edit Escala');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('setor_id');
		echo $form->input('nm_escalante');
		echo $form->input('nm_comandante');
		echo $form->input('dt_limite_cumprida');
		echo $form->input('dt_limite_previsao');
		echo $form->input('1_turno_inicio');
		echo $form->input('2_turno_inicio');
		echo $form->input('3_turno_inicio');
		echo $form->input('4_turno_inicio');
		echo $form->input('5_turno_inicio');
		echo $form->input('6_turno_inicio');
		echo $form->input('7_turno_inicio');
		echo $form->input('Militar');
	?>
	</fieldset>
<?php echo $form->end('Registrar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Excluir', true), array('action'=>'delete', $form->value('Escala.id')), array('class'=>'button'), sprintf(__('Tem certeza que deseja excluir # %s?', true), $form->value('Escala.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Exibir Escalas', true), array('action'=>'index'),array('class'=>'button'));?></li>
		<li><?php echo $this->Html->link(__('Exibir Setors', true), array('controller'=> 'setors', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Setor', true), array('controller'=> 'setors', 'action'=>'add'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir Militars', true), array('controller'=> 'militars', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Militar', true), array('controller'=> 'militars', 'action'=>'add'),array('class'=>'button')); ?> </li>
	</ul>
</div>
