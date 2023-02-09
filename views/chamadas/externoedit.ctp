
<?php
echo '<p class="message" id="atencao"><b>Formulário pronto para edição.</b></p><script language="javascript">new Effect.Fade(\'atencao\',{delay: 5});window.scroll(0,0);</script>';

echo $form->create('Chamada', array('action'=>'edit','onsubmit'=>'submitForm(this); return false;','type'=>'file'));
?>
	<fieldset>
 		<legend><?php __('Atualizar dados da chamada');?><?php 		
	echo $this->Html->link($this->Html->image('btsair.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onclick'=>"this.href='#';HideContent('formularios');HideContent('edicao');return false;",'escape'=>false, 'escape'=>false), null,false); 
	
 		?>
&nbsp;&nbsp;&nbsp;&nbsp;
</legend>
 		
 		
<?php
		$presencas = array(''=>'','P'=>'P','F'=>'F');
		echo $form->input('id',array( 'value' => $this->data['Chamada']['id']));
		echo $form->hidden('chamadaefetivo_id',array('value' => $this->data['Chamada']['chamadaefetivo_id']));
		echo $form->input('dia',array('class'=>'formulario', 'type'=>'text', 'value' => $this->data['Chamada']['dia'], 'readonly'=>'readonly'));
		echo $form->input('divisao',array('class'=>'formulario', 'value' => $this->data['Chamada']['divisao'], 'readonly'=>'readonly'));
		echo $form->input('presenca_inicio',array('class'=>'formulario','type' => 'select', 'options' => $presencas, 'default'=>$this->data['Chamada']['presenca_inicio']));
		echo $form->input('justificativa_inicio',array('class'=>'formulario', 'type'=>'textarea', 'value' => $this->data['Chamada']['justificativa_inicio']));
		echo $form->input('presenca_termino',array('class'=>'formulario','type' => 'select', 'options' => $presencas, 'default'=>$this->data['Chamada']['presenca_termino']));
		echo $form->input('justificativa_termino',array('class'=>'formulario', 'type'=>'textarea', 'value' => $this->data['Chamada']['justificativa_termino']));
		echo '<center>'.$ajax->submit('Cadastrar', array('url'=> array('controller'=>'chamadas', 'action'=>'externoeditgrava'), 'update' => 'listagem', 'class'=>'botoes')).'</center>';

		

?>
	</fieldset>
	
<?php 
//echo $ajax->submit('Registrar', array('url'=> array('controller'=>'militars', 'action'=>'externoeditgrava'), 'update' => 'militares', 'class'=>'botoes'));	

echo $form->end();


?>
<script>
ShowContent('edicao');</script>
