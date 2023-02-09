<?php 

if(strlen($msgcomunicado)>3){
	echo '<p class="message" id="mensagens"><b>'.$msgcomunicado.'</b></p><script language="javascript">ShowContent(\'listagem\');new Effect.Fade(\'mensagens\',{delay: 5});</script>';
}

?>
<div class="fotos form">
<?php echo $form->create('Chamada',array('type'=>'file'));?>
<fieldset>
<legend><?php __('Cadastrar Comunicado');?>&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
</legend>
<?php
echo '<label>Arquivo:</label>'.$form->file('dados',array('class'=>'formulario'));
?>
</fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
<?php 
include '/var/www/sgbdo/webroot/pdf/texto.txt';
?>

