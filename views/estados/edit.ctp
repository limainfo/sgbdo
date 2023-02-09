<center>
<div class="estados form">
<?php echo $this->Form->create('Estado');?>
	<fieldset>
 		<legend><?php __('Modificados dados de  Estado'); ?> &nbsp;&nbsp;&nbsp;
<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$this->data['Estado']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$this->data['Estado']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
&nbsp;&nbsp;&nbsp;
<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false), null,false); ?>
 		</legend>
<?php
    echo $this->Form->input('id',array('class'=>'formulario'));
    echo $this->Form->input('nome',array('class'=>'formulario'));
    echo $this->Form->input('uf',array('class'=>'formulario'));
    echo $this->Form->input('paise_id',array('class'=>'formulario', 'label'=>'País'));
?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
</center>    
