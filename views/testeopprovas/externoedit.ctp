<?php
echo '<p class="message" id="atencao"><b>Formulário pronto para edição.</b></p><script language="javascript">new Effect.Fade(\'atencao\',{delay: 5});window.scroll(0,0);</script>';

echo $form->create('Testeopprova', array('action'=>'edit','onsubmit'=>'submitForm(this); return false;','type'=>'file'));
?>
	<fieldset>
 		<legend><?php __('Cadastrar nomes de provas');?><?php 		
	echo $this->Html->link($this->Html->image('btsair.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onclick'=>"this.href='#';HideContent('formularios');return false;",'escape'=>false, 'escape'=>false), null,false); 
	
 		?>
&nbsp;&nbsp;&nbsp;&nbsp;
</legend>
 		
 		
<?php
		echo $form->input('id');
		echo $form->input('nm_prova',array('class'=>'formulario'));
		echo '<center>'.$ajax->submit('Cadastrar', array('url'=> array('controller'=>'testeopprovas', 'action'=>'externoeditgrava'), 'update' => 'listagem', 'class'=>'botoes')).'</center>';
			
?>
	</fieldset>
	
<?php 
//echo $ajax->submit('Registrar', array('url'=> array('controller'=>'militars', 'action'=>'externoeditgrava'), 'update' => 'militares', 'class'=>'botoes'));	

echo $form->end();


?>
<script>
ShowContent('formularios');</script>
