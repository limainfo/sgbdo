<div class="carimbos form">
<?php echo $this->Form->create('Carimbo',array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Cadastrar Carimbo'); ?> 		&nbsp;&nbsp;&nbsp;
 		
 				&nbsp;&nbsp;&nbsp;
 		
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false), null,false); ?>
				
 		
 		</legend>
<?php
	
$select ='<div class="input select required"><label>Emitente:</label><select id="CarimboMilitarId" class="formulario" name="data[Carimbo][militar_id]" onchange="$(\'CarimboEmitente\').value=$(\'CarimboMilitarId\').options[$(\'CarimboMilitarId\').options.selectedIndex].text;">';
	foreach($militars as $key=>$value){
		if($key==$id){
			$selecionado = '<option value="'.$key.'" selected>'.$value.'</option>';
		}
		$select .= '<option value="'.$key.'" >'.$value.'</option>';
	}
$select = $select.$selecionado.'</select></div>';
	
echo $select;
		echo $this->Form->input('emitente',array('class'=>'formulario','size'=>'60','label'=>'Nome','readonly'=>'readonly'));
		echo $this->Form->input('funcao',array('class'=>'formulario','size'=>'60'));
		echo $this->Form->hidden('id');
		echo '<label>Imagem do Carimbo:</label>'.$form->file('dados',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
