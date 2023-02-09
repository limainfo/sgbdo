<? include ($caminhoAditivos); ?>

<div class="eptaEptas form">
<?php echo $this->Form->create('EptaEpta');?>
	<fieldset>
 		<legend><?php __('Modificados dados de  Epta Epta'); ?> 		&nbsp;&nbsp;&nbsp;
 		
 		
 		<?php	echo $html->link($html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$this->data['EptaEpta']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$this->data['EptaEpta']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				&nbsp;&nbsp;&nbsp;
 		
		<?php echo $html->link($html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false), null,false); ?>
				
 		
 		</legend>
	<?php
		echo $this->Form->input('id',array('class'=>'formulario'));
		echo $this->Form->input('base_indic_loc_id',array('class'=>'formulario'));
		echo $this->Form->input('entidade',array('class'=>'formulario'));
		echo $this->Form->input('cidade',array('class'=>'formulario'));
		echo $this->Form->input('local',array('class'=>'formulario'));
		echo $this->Form->input('estado_id',array('class'=>'formulario'));
		//echo $this->Form->input('categoria',array('class'=>'formulario'));
                //echo $this->Form->input('categoria',array('class'=>'formulario','options'=>$categorias, 'default'=>0, 'onChange'=>'javascript:listasetores(\'R2Setor\',$(\'R2Organizacao\').value);', 'label'=>'Organização do Técnico/ATCO'));
                echo $this->Form->input('categoria',array('class'=>'formulario','options'=>$categorias ));
		echo $this->Form->input('portaria',array('class'=>'formulario'));
		echo $this->Form->input('portaria_dt',array('class'=>'formulario'));
		echo $this->Form->input('bca',array('class'=>'formulario'));
		echo $this->Form->input('bca_dt',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
