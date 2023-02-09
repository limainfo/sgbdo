<div class="indicadoscursos form">
<?php echo $form->create('Indicadoscurso');?>
	<fieldset>
 		<legend><?php __('Edit Indicadoscurso');?>		&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$this->data['Indicadoscurso']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$this->data['Indicadoscurso']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);?>		&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?> 		
 		</legend>
 		
 		
	<?php
		echo $form->input('id',array('class'=>'formulario'));
		echo $form->input('cursoativo_id',array('class'=>'formulario'));
		echo $form->input('militar_id',array('class'=>'formulario'));
		echo $form->input('prioridade',array('class'=>'formulario'));
		echo $form->input('indicado',array('class'=>'formulario'));
		echo $form->input('status',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
<div class="actions">
	<ul>
			<li><?php echo $this->Html->link(__('List Cursoativos', true), array('controller'=> 'cursoativos', 'action'=>'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cursoativo', true), array('controller'=> 'cursoativos', 'action'=>'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Militars', true), array('controller'=> 'militars', 'action'=>'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Militar', true), array('controller'=> 'militars', 'action'=>'add')); ?> </li>
	</ul>
</div>
