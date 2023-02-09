<div class="carimbos form">
<?php echo $this->Form->create('Carimbo',array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Modificados dados de  Carimbo'); ?> 		&nbsp;&nbsp;&nbsp;
 		
 		
 		<?php	echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$this->data['Carimbo']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$this->data['Carimbo']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
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
		echo $this->Form->input('id');
		echo '<label>Imagem do Carimbo:</label>'.$form->file('dados',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>

<?php
			$img = $this->data['Carimbo']['id'];
		    echo $this->Html->image(array('controller'=> 'carimbos', 'action'=>'externostream',$img), array( 'border'=> '0' )); //  
?>
