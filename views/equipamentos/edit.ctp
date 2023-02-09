<div class="equipamentos form">
<?php echo $form->create('Equipamento');?>
	<fieldset>
 		<legend><?php __('Edit Equipamento');?>		&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$this->data['Equipamento']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$this->data['Equipamento']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);?>		&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?> 		
 		</legend>
 		
 		
	<?php
		echo $form->input('id',array('class'=>'formulario'));
		echo $form->input('nome',array('class'=>'formulario'));
		echo $form->input('tipo',array('class'=>'formulario'));
		echo $form->input('descricao',array('class'=>'formulario'));
		echo $form->input('localidade_id',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
<div class="actions">
	<ul>
		</ul>
</div>
