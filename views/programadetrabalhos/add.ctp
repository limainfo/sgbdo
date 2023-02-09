<div class="programadetrabalhos form">
<?php echo $this->Form->create('Programadetrabalho');?>
	<fieldset>
 		<legend><?php __('Cadastrar Programadetrabalho'); ?> 		&nbsp;&nbsp;&nbsp;
 		
 				&nbsp;&nbsp;&nbsp;
 		
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false), null,false); ?>
				
 		
 		</legend>
	<?php
		echo $this->Form->input('meta_decea',array('class'=>'formulario'));
		echo $this->Form->input('origem',array('class'=>'formulario'));
		echo $this->Form->input('stat',array('class'=>'formulario'));
		echo $this->Form->input('meta_unidade',array('class'=>'formulario'));
		echo $this->Form->input('etapa_unidade',array('class'=>'formulario'));
		echo $this->Form->input('descricao_meta_geral',array('class'=>'formulario'));
		echo $this->Form->input('descricao_etapa_especifica',array('class'=>'formulario'));
		echo $this->Form->input('descricao_meta_div_oper',array('class'=>'formulario'));
		echo $this->Form->input('projeto_basico',array('class'=>'formulario'));
		echo $this->Form->input('naj',array('class'=>'formulario'));
		echo $this->Form->input('pam',array('class'=>'formulario'));
		echo $this->Form->input('pag',array('class'=>'formulario'));
		echo $this->Form->input('licitacao',array('class'=>'formulario'));
		echo $this->Form->input('divisao_responsavel',array('class'=>'formulario'));
		echo $this->Form->input('setor_responsavel',array('class'=>'formulario'));
		echo $this->Form->input('ed14',array('class'=>'formulario'));
		echo $this->Form->input('ed15',array('class'=>'formulario'));
		echo $this->Form->input('ed30',array('class'=>'formulario'));
		echo $this->Form->input('ed39',array('class'=>'formulario'));
		echo $this->Form->input('ed39spub',array('class'=>'formulario'));
		echo $this->Form->input('ed39can',array('class'=>'formulario'));
		echo $this->Form->input('ed51',array('class'=>'formulario'));
		echo $this->Form->input('ed52',array('class'=>'formulario'));
		echo $this->Form->input('total_meta',array('class'=>'formulario'));
		echo $this->Form->input('providencia',array('class'=>'formulario'));
		echo $this->Form->input('status',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
