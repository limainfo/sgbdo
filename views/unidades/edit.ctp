<center>
<div class="unidades form">
<?php echo $this->Form->create('Unidade');?>
	<fieldset>
 		<legend><?php __('Modificados dados de  Unidade'); ?> 		&nbsp;&nbsp;&nbsp;
 		
 		
 		<?php	echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$this->data['Unidade']['sigla_unidade']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$this->data['Unidade']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				&nbsp;&nbsp;&nbsp;
 		
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false), null,false); ?>
				
 		
 		</legend>
	<?php
		echo $this->Form->input('id',array('class'=>'formulario'));
//		echo $this->Form->input('area',array('class'=>'formulario'));
		echo $this->Form->input('cidade_id',array('class'=>'formulario'));
		echo $this->Form->input('nm_unidade',array('class'=>'formulario','size'=>'60'));
		echo $this->Form->input('sigla_unidade',array('class'=>'formulario'));
		echo $this->Form->input('nm_cmt_unidade',array('class'=>'formulario','size'=>'60'));
		echo $this->Form->input('tel_unidade',array('class'=>'formulario'));
/*                
		echo $this->Form->input('inicio_numero_licenca',array('class'=>'formulario'));
		echo $this->Form->input('fim_numero_licenca',array('class'=>'formulario'));
		echo $this->Form->input('numero_licenca_atual',array('class'=>'formulario'));
		echo $this->Form->input('letra_licenca_atual',array('class'=>'formulario'));
		echo $this->Form->input('nv_manutencao',array('class'=>'formulario'));
		echo $this->Form->input('numero_replicacao',array('class'=>'formulario'));
		echo $this->Form->input('militar_sn',array('class'=>'formulario'));
 * 
 */
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
</center>