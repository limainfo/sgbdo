<div class="versoescalas form">
<?php echo $form->create('Versoescala');?>
	<fieldset>
 		<legend><?php __('Add Versoescala');?></legend>
	<?php
		echo $form->input('escalasmonth_id');
		echo $form->input('item1');
		echo $form->input('item2');
		echo $form->input('item3');
		echo $form->input('item4');
		echo $form->input('item5');
		echo $form->input('item6');
	?>
	</fieldset>
<?php echo $form->end('Registrar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Exibir Versoescalas', true), array('action'=>'index'),array('class'=>'button'));?></li>
	</ul>
</div>
