<div class="ocorrenciastecnicas form">
<?php echo $form->create('Ocorrenciastecnica');?>
	<fieldset>
 		<legend><?php __('Edit Ocorrenciastecnica');?>		&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$this->data['Ocorrenciastecnica']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$this->data['Ocorrenciastecnica']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);?>		&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?> 		
 		</legend>
 		
 		
	<?php
		echo $form->input('id',array('class'=>'formulario'));
		echo $form->input('equipamento_id',array('class'=>'formulario'));
		echo $datePicker->picker('inicio',array('readonly'=>'','class'=>'formulario'));
		echo $datePicker->picker('termino',array('readonly'=>'','class'=>'formulario'));
		echo $form->input('nr_sci',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
<div class="actions">
	<ul>
			<li><?php echo $this->Html->link(__('List Equipamentos', true), array('controller'=> 'equipamentos', 'action'=>'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Equipamento', true), array('controller'=> 'equipamentos', 'action'=>'add')); ?> </li>
	</ul>
</div>
