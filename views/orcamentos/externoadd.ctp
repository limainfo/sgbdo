<?php
echo '<p class="message" id="atencao"><b>Formulário pronto para adição.</b></p><script language="javascript">new Effect.Fade(\'atencao\',{delay: 5});window.scroll(0,0);</script>';

echo $form->create('Chamada', array('action'=>'edit','onsubmit'=>'submitForm(this); return false;','type'=>'file'));
?>
	<fieldset>
 		<legend><?php __('Gerar Chamada');?><?php 		
	echo $this->Html->link($this->Html->image('btsair.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onclick'=>"this.href='#';HideContent('formularios');return false;",'escape'=>false, 'escape'=>false), null,false); 
	
 		?>
&nbsp;&nbsp;&nbsp;&nbsp;
</legend>
 		
 		
<?php
for($i=2011;$i<=(date('Y')+2);$i++){
	$anos[$i]=$i;
}

		
		//print_r($subdivisao);
		echo $form->input('divisao',array('class'=>'formulario','value'=>'OPERACIONAL','readonly'=>'readonly'));
		echo $form->input('nome_chamada',array('class'=>'formulario','value'=>'EXPEDIENTE','readonly'=>'readonly'));
		echo $datePicker->Timer('dia',array('readonly'=>'readonly','class'=>'formulario'),'%Y-%m-%d');
		echo '<center>'.$ajax->submit('Gerar', array('url'=> array('controller'=>'chamadas', 'action'=>'externoeditgrava'), 'update' => 'listagem', 'class'=>'botoes')).'</center>';



?>
	</fieldset>
	
<?php 
//echo $ajax->submit('Registrar', array('url'=> array('controller'=>'militars', 'action'=>'externoeditgrava'), 'update' => 'militares', 'class'=>'botoes'));	

echo $form->end();


?>
<script>
ShowContent('formularios');</script>
