<div class="parecerestecnicos form">
<?php echo $form->create('Parecerestecnico',array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Modificar dados do Parecer técnico');?>	&nbsp;&nbsp;&nbsp;
 					<?php
		echo $yahooUi->generateScriptForSimpleDialog('del'.$this->data['Parecerestecnico']['id'], array('body'=>'Tem certeza que deseja excluir # '.$this->data['Parecerestecnico']['oficio'].' ?'));
		echo $yahooUi->imgForSimpleDialog('del'.$this->data['Parecerestecnico']['id'],'lixo.gif',array('function'=>'delete','id'=>$this->data['Parecerestecnico']['id'])); 
		?>
	&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
 		</legend>
	<?php
		echo $form->input('id');
		echo $form->input('oficio',array('class'=>'formulario'));
		echo $form->input('sereng',array('class'=>'formulario'));
		echo $datePicker->picker('entrada_cindacta',array('class'=>'formulario'));
		echo $datePicker->picker('entrada_opats',array('class'=>'formulario'));
		
$qtds["EM ANDAMENTO"]="EM ANDAMENTO";
$qtds["DESFAVORÁVEL"]="DESFAVORÁVEL";
$qtds["FAVORÁVEL"]="FAVORÁVEL";
	
echo $form->input('situacao',array('type'=>'select','options'=>array($qtds),'selected'=>$data['Parecerestecnico']['situacao'],'class'=>'formulario'));
		
		//echo $form->input('situacao');
		echo $form->input('parecer',array('class'=>'formulario'));
echo '<label for="ParecerestecnicoArquivo">Arquivo</label>'.$form->file('arquivos',array('class'=>'formulario'));
echo '<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;O arquivo informado deve estar no formato html ou pdf.</h3>';
			?>
	</fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
<br>
