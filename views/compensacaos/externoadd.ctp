<?php
echo '<p class="message" id="atencao"><b>Formulário pronto para adição.</b></p><script language="javascript">new Effect.Fade(\'atencao\',{delay: 5});window.scroll(0,0);</script>';

echo $form->create('Compensacao', array('action'=>'edit','onsubmit'=>'return false;','type'=>'file'));
?>
	<fieldset>
 		<legend><?php __('Cadastrar Efetivo');?><?php 		
	echo $this->Html->link($this->Html->image('btsair.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onclick'=>"this.href='#';HideContent('formularios');return false;",'escape'=>false, 'escape'=>false), null,false); 
	
 		?>
&nbsp;&nbsp;&nbsp;&nbsp;
</legend>
 		
 		
<?php
		echo '<label for="Consultanomes">Nome</label><input class="formulario" type="text" name="nome" id="nomeparaconsulta" value=""><input type="submit" value="Buscar" name="btnConsultaNome" onclick="consultanome();" class="botoes">';
	
		echo $form->input('militar_id',array('class'=>'formulario','onchange'=>'setanome();')); 

		$u=$this->Session->read('Usuario');
		//print_r($u);
		//echo $u[0][0]['nome'].'<br>';
		//echo $u[0]['Usuario']['militar_id'];

		echo $form->hidden('usuario_id',array('class'=>'formulario','value'=>$u[0]['Usuario']['militar_id'])); 
		echo $form->hidden('usuarionome',array('class'=>'formulario','value'=>$u[0][0]['nome'])); 

		echo $form->input('nmcompleto',array('class'=>'formulario','size'=>80));
		echo '<center>'.$ajax->submit('Cadastrar', array('url'=> array('controller'=>'compensacaos', 'action'=>'externoeditgrava'), 'update' => 'listagem', 'class'=>'botoes')).'</center>';
			
?>
	</fieldset>
	
<?php 
//echo $ajax->submit('Registrar', array('url'=> array('controller'=>'militars', 'action'=>'externoeditgrava'), 'update' => 'militares', 'class'=>'botoes'));	

echo $form->end();


?>
<script>
ShowContent('formularios');</script>

<script type="text/javascript">
HideContent('detalhes');

</script>

