<?php
echo '<p class="message" id="atencao"><b>Formulário pronto para adição.</b></p><script language="javascript">new Effect.Fade(\'atencao\',{delay: 5});window.scroll(0,0);</script>';

echo $form->create('Chamadaefetivo', array('action'=>'edit','onsubmit'=>'return false;','type'=>'file','id'=>'ChamadaefetivoAddForm'));
?>
	<fieldset>
 		<legend><?php __('Cadastrar efetivo para chamada');?><?php 		
	echo $this->Html->link($this->Html->image('btsair.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onclick'=>"this.href='#';HideContent('formularios');return false;",'escape'=>false, 'escape'=>false), null,false); 
	
 		?>
&nbsp;&nbsp;&nbsp;&nbsp;
</legend>
 		
 		
<?php
for($i=2011;$i<=(date('Y')+2);$i++){
	$anos[$i]=$i;
}
	echo '<label for="Consultanomes">Nome</label><input class="formulario" type="text" name="nome" id="nomeparaconsulta" value=""><input type="submit" value="Buscar" name="btnConsultaNome" onclick="consultanome();" class="botoes">';
	echo $form->input('id');
	$valor[$this->data['Chamadaefetivo']['militar_id']]=$this->data['Chamadaefetivo']['nome_militar'];
	echo $form->input('militar_id',array('class'=>'formulario','onChange'=>'atribui();','type' => 'select', 'options' => $valor)); 
	echo $form->input('divisao',array('class'=>'formulario','value'=>'OPERACIONAL','readonly'=>'readonly')); 
	echo $form->hidden('nome_militar',array('class'=>'formulario','value'=>$this->data['Chamadaefetivo']['nome_militar'])); 
	echo $form->input('nome_chamada',array('class'=>'formulario')); 
	echo '<center>'.$ajax->submit('Cadastrar', array('url'=> array('controller'=>'chamadaefetivos', 'action'=>'externoeditgrava'), 'update' => 'listagem', 'class'=>'botoes')).'</center>';

?>
	</fieldset>
	
<?php 

echo $form->end();


?>
<script>
ShowContent('formularios');</script>
