<div class="militarscursoscorrigidos form">
<?php echo $form->create('Militarscursoscorrigido');?>
	<fieldset>
 		<legend><?php __('Edit Militarscursoscorrigido');?>		&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$this->data['Militarscursoscorrigido']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$this->data['Militarscursoscorrigido']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);?>		&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?> 		
 		</legend>
 		
 		
	<?php
		echo $form->input('id',array('class'=>'formulario'));
		echo $form->input('setor_id',array('class'=>'formulario'));
		echo $form->input('militar_id',array('class'=>'formulario'));
		echo $form->input('curso_id',array('class'=>'formulario'));
		echo $form->input('dt_inicio_curso',array('class'=>'formulario'));
		echo $form->input('dt_fim_curso',array('class'=>'formulario'));
		echo $form->input('local_realizacao',array('class'=>'formulario'));
		echo $form->input('documento',array('class'=>'formulario'));
		echo $form->input('periodo',array('class'=>'formulario'));
		echo $form->input('acao',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
<div class="actions">
	<ul>
		</ul>
</div>
