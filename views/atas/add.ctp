<script>tinymce.init({selector:'textarea', 
  plugins: [
         "advlist anchor autolink autoresize autosave bbcode charmap code colorpicker contextmenu directionality emoticons example example_dependency fullpage fullscreen", 
         "hr image imagetools insertdatetime layer legacyoutput link lists importcss media nonbreaking noneditable pagebreak paste preview print save searchreplace spellchecker", 
         "tabfocus table template textcolor textpattern visualblocks visualchars wordcount"
   ],
		elements : "AtaConteudoAta",
       toolbar: [
           "newdocument bold italic underline strikethrough alignleft aligncenter alignright alignjustify styleselect formatselect fontselect",
           "fontsizeselect cut copy paste bullist numlist outdent indent blockquote undo redo removeformat subscript superscript forecolor backcolor",
           "hr link unlink image charmap pastetext print preview anchor pagebreak spellchecker searchreplace visualblocks visualchars code fullscreen",
           "insertdatetime media nonbreaking save cancel table ltr rtl emoticons template forecolor backcolor insertfile"
       ]

});</script>
<?php 
include $caminhoAditivos;
?>
<center>
<div class="atas form">
<?php echo $this->Form->create('Ata');?>
	<fieldset>
 		<legend><?php __('Cadastrar Ata'); ?> 		&nbsp;&nbsp;&nbsp;
 		
 				&nbsp;&nbsp;&nbsp;
 		
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false), null,false); ?>
				
 		
 		</legend>
	<?php
		echo $this->Form->input('numero',array('class'=>'formulario'));
		echo $this->Form->input('observacao',array('class'=>'formulario'));
		echo $datePicker->picker('data_reuniao',array('class'=>'formulario','readonly'=>'readonly'));
		echo $this->Form->input('unidade_id',array('class'=>'formulario'));
		echo $this->Form->input('boletiminterno_id',array('class'=>'formulario'));
		echo $this->Form->input('conteudo_ata', array('type' => 'textarea','cols' => '80', 'rows' => '5','value'=>$modeloAtas));
				?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
</center>