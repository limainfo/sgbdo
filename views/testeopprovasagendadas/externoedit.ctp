
<?php
echo '<p class="message" id="atencao"><b>Formulário pronto para edição.</b></p><script language="javascript">new Effect.Fade(\'atencao\',{delay: 5});window.scroll(0,0);</script>';

echo $form->create('Testeopprovasagendada', array('action'=>'edit','onsubmit'=>'submitForm(this); return false;','type'=>'file'));
?>
	<fieldset>
 		<legend><?php __('Cadastrar Provas Agendadas');?><?php 		
	echo $this->Html->link($this->Html->image('btsair.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onclick'=>"this.href='#';HideContent('formularios');return false;",'escape'=>false, 'escape'=>false), null,false); 
	
 		?>
&nbsp;&nbsp;&nbsp;&nbsp;
</legend>
 		
 		
<?php
for($i=2011;$i<=(date('Y')+2);$i++){
	$anos[$i]=$i;
}
		foreach($organizacoes as $divisao=>$subdivisoes){
			$divisoes[$divisao] = $divisao;
			foreach($subdivisoes as $chave=>$valor){
				$subdivisao[$divisao][]=$valor;
			}
		}
		
		//print_r($subdivisao);
		
		echo $form->input('id');
		echo $form->input('ano',array('class'=>'formulario','type' => 'select', 'options' => $anos, 'label' => 'Ano', 'empty' => 'Informe o ano'));
		echo $form->input('divisao',array('class'=>'formulario','type'=>'select','options'=>$divisoes,'default'=>$this->data['Testeopprovasagendada']['divisao'],'onChange'=>'javascript:listasetores(\'TesteopprovasagendadaSubdivisao\',$(\'TesteopprovasagendadaDivisao\').value);'));
		//echo $form->select('unidade_id', $unidades ,null ,array('onChange'=>'javascript:listasetores();','class'=>'formulario','style'=>'vertical-align:top;'), false);
		echo $form->input('subdivisao',array('class'=>'formulario','type'=>'select','options'=>array($this->data['Testeopprovasagendada']['subdivisao']=>$this->data['Testeopprovasagendada']['subdivisao']),'default'=>$this->data['Testeopprovasagendada']['subdivisao']));
		
		echo $form->input('testeopprova_id',array('class'=>'formulario', 'label' => 'Tipo de Prova'));
		echo $form->input('especialidade_id',array('class'=>'formulario'));
		echo $datePicker->Timer('data_chamada01',array('readonly'=>'readonly','class'=>'formulario'),'%Y-%m-%d %H:%M');
		echo $datePicker->Timer('data_chamada02',array('readonly'=>'readonly','class'=>'formulario'),'%Y-%m-%d %H:%M');
		echo $datePicker->Timer('data_chamada03',array('readonly'=>'readonly','class'=>'formulario'),'%Y-%m-%d %H:%M');
		echo $datePicker->Timer('data_chamada04',array('readonly'=>'readonly','class'=>'formulario'),'%Y-%m-%d %H:%M');
		echo '<center>'.$ajax->submit('Cadastrar', array('url'=> array('controller'=>'testeopprovasagendadas', 'action'=>'externoeditgrava'), 'update' => 'listagem', 'class'=>'botoes')).'</center>';



?>
	</fieldset>
	
<?php 
//echo $ajax->submit('Registrar', array('url'=> array('controller'=>'militars', 'action'=>'externoeditgrava'), 'update' => 'militares', 'class'=>'botoes'));	

echo $form->end();


?>
<script>
ShowContent('formularios');</script>
