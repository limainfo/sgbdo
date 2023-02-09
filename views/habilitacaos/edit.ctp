<?php 
include $caminhoAditivos;
?><div class="habilitacaos form">
<?php echo $form->create('Habilitacao');?>
	<fieldset>
 		<legend><?php __('Modificar dados de Habilitação');?>&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
 		</legend>
<table width="749" border="0" cellpadding="0" cellspacing="0"
	class="content">		
		<tr>
		<td widht="20%">
		<?php echo $form->input('militar_id',array('class'=>'formulario')); ?>
		</td>
		<td widht="80%">
		<?php	echo $this->Html->link($this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar novo Militar','style'=>'float:left;text-padding:0px;text-align:left;')), array('controller'=>'militars','action'=>'add', null),array('escape'=>false, 'escape'=>false), null,false);
		?> 
		</td>
		</tr>
</table>		
 		
	<?php
		echo $form->input('id');
		echo $form->input('cht',array('class'=>'formulario'));
		echo $datePicker->picker('validade_cht',array('class'=>'formulario'));
                echo $form->input('funcao',array('class'=>'formulario','options'=>$tipos_licencas, 'selected'=>$this->data['Habilitacao']['funcao']));
                
		echo $form->input('localidade',array('class'=>'formulario'));
		echo $form->input('nome_emitente',array('class'=>'formulario','value'=>'TEN CEL AV RAFAEL','size'=>'50'));
		echo $datePicker->picker('dt_concessao',array('class'=>'formulario'));
		echo $form->input('reponsavel_concessao',array('class'=>'formulario','readonly'=>'readonly'));
		echo $datePicker->picker('dt_suspensao',array('class'=>'formulario'));
		echo $form->input('reponsavel_suspensao',array('class'=>'formulario','readonly'=>'readonly'));
		echo $form->input('motivo_suspensao',array('class'=>'formulario'));
		echo $datePicker->picker('dt_perda',array('class'=>'formulario'));
		echo $form->input('reponsavel_perda',array('class'=>'formulario','readonly'=>'readonly'));
		echo $form->input('motivo_perda',array('class'=>'formulario'));
		echo $this->Form->input('ata_id',array('class'=>'formulario'));
		echo $this->Form->input('boletiminterno_id',array('class'=>'formulario'));
		
	?>
	</fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
		