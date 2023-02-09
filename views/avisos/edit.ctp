<center>
<div class="avisos form">
    

<?php echo $this->Form->create('Aviso');?>
	<fieldset>
 		<legend><?php __('Modificar Aviso'); ?> 		&nbsp;&nbsp;&nbsp;
 		
 				&nbsp;&nbsp;&nbsp;
 		
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false), null,false); ?>
				
 		
 		</legend>
	<?php
		echo $this->Form->input('id',array('class'=>'formulario'));
                $tipos = array('AVISO'=>'AVISO', 'MANUTENÇÃO'=>'MANUTENÇÃO');
 		echo $this->Form->input('tipo',array('class'=>'formulario','type'=>'select','options'=>$tipos,'selected'=>$this->data['Aviso']['tipo']));
                
		echo $this->Form->input('mensagem',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
</center>
<script>
    //fullpage legacyoutput
    /*
     * 
     * 
   ,
  plugins: [
         "fullpage legacyoutput advlist anchor autolink autoresize autosave bbcode charmap code colorpicker contextmenu directionality emoticons example example_dependency  fullscreen", 
         "hr image imagetools insertdatetime layer  link lists importcss media nonbreaking noneditable pagebreak paste preview print save searchreplace spellchecker", 
         "tabfocus table template textcolor textpattern visualblocks visualchars wordcount"
   ],
       toolbar: [
           "newdocument bold italic underline strikethrough alignleft aligncenter alignright alignjustify styleselect formatselect fontselect",
           "fontsizeselect cut copy paste bullist numlist outdent indent blockquote undo redo removeformat subscript superscript forecolor backcolor",
           "hr link unlink image charmap pastetext print preview anchor pagebreak spellchecker searchreplace visualblocks visualchars code fullscreen",
           "insertdatetime media nonbreaking save cancel table ltr rtl emoticons template forecolor backcolor insertfile"
       ]
     */
    tinymce.init({
        selector:'textarea', 
        forced_root_block: false,
        element_format: 'html',
        apply_source_formatting: true,
        remove_linebreaks: false,
        plugins: [ "table textcolor " ],
        toolbar: ["bold italic underline strikethrough alignleft aligncenter alignright alignjustify styleselect formatselect fontselect forecolor backcolor",
            "fontsizeselect bullist numlist outdent indent blockquote undo redo removeformat subscript superscript hr charmap pastetext print  "
        ]

});</script>

    
