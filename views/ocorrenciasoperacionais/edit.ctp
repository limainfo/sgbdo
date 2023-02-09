<div class="ocorrenciasoperacionais form">
<?php echo $form->create('Ocorrenciasoperacionai');?>
	<fieldset>
 		<legend><?php __('Edit Ocorrenciasoperacionai');?>		&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$this->data['Ocorrenciasoperacionai']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$this->data['Ocorrenciasoperacionai']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);?>		&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?> 		
 		</legend>
 		
 		
	<?php
		echo $form->input('id',array('class'=>'formulario'));
		echo $form->input('tabela',array('class'=>'formulario'));
		echo $form->input('registroid',array('class'=>'formulario'));
		echo $datePicker->picker('inicio',array('readonly'=>'','class'=>'formulario'));
		echo $datePicker->picker('termino',array('readonly'=>'','class'=>'formulario'));
	?>
	</fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
<div class="actions">
	<ul>
		</ul>
</div>
