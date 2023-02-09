<div class="parecerestecnicos form"><?php echo $form->create('Bca',array('type'=>'file'));?>
<fieldset><legend><?php __('Cadastrar BCA');?>&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
 		</legend> <?php
echo $form->input('numero_bca',array('class'=>'formulario'));
echo $form->input('extrato',array('class'=>'formulario'));
echo $form->hidden('gerado',array('class'=>'formulario','value'=>date('Y-m-d H:i:s')));
//echo $form->input('situacao');
echo '<label for="BcaArquivo">Arquivo</label>'.$form->file('arquivos',array('class'=>'formulario'));
echo '<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;O arquivo informado deve estar no formato html ou pdf.</h3>';
?></fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?></div>
<br>

