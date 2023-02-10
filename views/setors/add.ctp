<center>
<div class="setores form">
<?php echo $this->Form->create('Setor');?>
	<fieldset>
 		<legend><?php __('Cadastrar Setor'); ?> 		&nbsp;&nbsp;&nbsp;
 		
 				&nbsp;&nbsp;&nbsp;
 		
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false), null,false); ?>
				
 		
 		</legend>
	<?php
		echo $this->Form->input('unidade_id',array('class'=>'formulario'));
		echo $this->Form->input('nm_setor',array('class'=>'formulario','size'=>60));
		echo $this->Form->input('sigla_setor',array('class'=>'formulario'));
		echo $this->Form->input('nm_chefe_setor',array('class'=>'formulario','size'=>60));
		echo $this->Form->input('tel_setor',array('class'=>'formulario'));
		echo $this->Form->input('efetivo_previsto',array('class'=>'formulario','value'=>'1'));
		//echo $this->Form->input('setor_valido',array('class'=>'formulario'));
		echo $this->Form->input('tipo',array('class'=>'formulario'));
                
//		echo $this->Form->input('parent_id',array('class'=>'formulario'));
		echo $this->Form->input('parent_id',array('type'=>'select','class'=>'formulario','options'=>$setors, 'label' => 'Setor Responsável'));
                
	?>
   
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
</center>


























