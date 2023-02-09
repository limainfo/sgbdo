<div class="paises form">
<?php echo $this->Form->create('Paise');?>
 		<h3><b><?php __('Converte Campos das Tabelas de Latin1 para UTF8'); ?></b></h3>
	<fieldset>
 		
	<?php
	
	//for (i=$('PaiseCampos').options.length-1; i>=0; i--){\$('PaiseCampos').removeChild(options[i]);}		
		echo $this->Form->input('tabelas',array('class'=>'formulario','type'=>'select','options'=>$tabelas,'onchange'=>"for (i=\$('PaiseCampos').options.length-1; i>=0; i--){\$('PaiseCampos').removeChild(\$('PaiseCampos').options[i]);}"));
		echo $this->Form->input('campos',array('class'=>'formulario', 'multiple'=>'multiple', 'size'=>'5'));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Converter','class'=>'botoes'));?>
</div>
