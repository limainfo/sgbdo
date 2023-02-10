<div class="habilitacaos form">
<?php echo $form->create('Habilitacao');?>
	<fieldset>
 		<legend><?php __('Modificar dados de Habilitação');?>&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;
		<?php echo $html->link($html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
 		</legend>
<table width="749" border="0" cellpadding="0" cellspacing="0"
	class="content">		
		<tr>
		<td widht="20%">
		<?php echo $form->input('militar_id',array('class'=>'formulario')); ?>
		</td>
		<td widht="80%">
		<?php	echo $html->link($html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar novo Militar','style'=>'float:left;text-padding:0px;text-align:left;')), array('controller'=>'militars','action'=>'add', null),array('escape'=>false, 'escape'=>false), null,false);
		?> 
		</td>
		</tr>
</table>		
 		
	<?php
		echo $form->input('id');
		echo $form->input('cht_anterior',array('class'=>'formulario'));
		echo $form->input('cht_atual',array('class'=>'formulario'));
		echo $datePicker->picker('validade_cht_anterior',array('class'=>'formulario'));
		echo $datePicker->picker('validade_cht_atual',array('class'=>'formulario'));
		echo $form->input('funcao',array('class'=>'formulario'));
		echo $form->input('setor',array('class'=>'formulario'));
		echo $datePicker->picker('dt_designacao',array('class'=>'formulario'));
		echo $form->input('condicao_operacional',array('class'=>'formulario'));
		echo $form->input('conceito_operacional',array('class'=>'formulario'));
		echo $form->input('grau_teorico',array('class'=>'formulario'));
		echo $datePicker->picker('dt_teste_fisico',array('class'=>'formulario'));
		echo $form->input('nivel_ingles',array('class'=>'formulario'));
		echo $form->input('indicativo',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
		