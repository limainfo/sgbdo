<center>
<div class="boletiminternos form">
<?php echo $this->Form->create('Boletiminterno');?>
	<fieldset>
 		<legend><?php __('Cadastrar Boletim interno'); ?> 		&nbsp;&nbsp;&nbsp;
 		
 				&nbsp;&nbsp;&nbsp;
 		
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false), null,false); ?>
				
 		
 		</legend>
	<?php
		echo $this->Form->input('numero',array('class'=>'formulario'));
		//echo $this->Form->input('data_publicacao',array('class'=>'formulario'));
		echo $this->Form->input('data_publicacao',array('class'=>'formulario','type'=>'text','label'=>'Data Publicação  (YYYY-mm-dd):', 'onchange'=>"var valor=this.value; validaData(valor,this);"));
                
		echo $this->Form->input('unidade_id',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
<script type="text/javascript">

function validaData (data, objeto) {
    var formatoValido = /^\d{4}-\d{2}-\d{2}$/; 
    var valido = false;
    if(!formatoValido.test(data)){
      alert("A data está no formato errado.  Padrão YYYY-mm-dd.");
        objeto.value = '';
    }else{
      var ano = data.split("-")[0];
      var mes = data.split("-")[1];
      var dia = data.split("-")[2];
      var MyData = new Date(ano, mes - 1, dia);
      if((MyData.getMonth() + 1 != mes)||
         (MyData.getDate() != dia)||
         (MyData.getFullYear() != ano)) {
       alert("Valores inválidos para o dia, mês ou ano. Padrão YYYY-mm-dd.");
           objeto.value = '';
       }
      else{
        valido = true;
        $('AfastamentoDtTermino').value=$('AfastamentoDtInicio').value;
        }
    }

    return valido;
}
</script>
</center>