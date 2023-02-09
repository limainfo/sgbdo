<center>
<div class="avisos form">
    

<?php echo $this->Form->create('Aviso');?>
	<fieldset>
 		<legend><?php __('Cadastrar Aviso'); ?> 		&nbsp;&nbsp;&nbsp;
 		
 				&nbsp;&nbsp;&nbsp;
 		
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false), null,false); ?>
				
 		
 		</legend>
	<?php
                $tipos = array('AVISO'=>'AVISO', 'MANUTENÇÃO'=>'MANUTENÇÃO');
                $tipodefault = 'AVISO';
 		echo $this->Form->input('tipo',array('class'=>'formulario','type'=>'select','options'=>$tipos,'selected'=>$tipodefault));
		echo $this->Form->input('mensagem',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
</center>    
<script>
    //fullpage legacyoutput
    tinymce.init({
        selector:'#AvisoMensagem', 
        forced_root_block: false,
        element_format: 'html',
        apply_source_formatting: true,
        remove_linebreaks: false,
        plugins: [ "table textcolor " ],
        toolbar: ["bold italic underline strikethrough alignleft aligncenter alignright alignjustify styleselect formatselect fontselect forecolor backcolor",
            "fontsizeselect bullist numlist outdent indent blockquote undo redo removeformat subscript superscript hr charmap pastetext print  "
        ]


});</script>

    
