<div class="zquestaos form">
<?php echo $this->Form->create('Zquestao',array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Cadastrar Questão'); ?></legend>
	<?php
$select1 = '<select id="nome_prova" name="nome_prova" class="formulario">';
foreach($nomes as $dado){
	$select1 .= '<option value="'.$dado['zquestaos']['regulamento'].'">'.$dado['zquestaos']['regulamento']."</option>";
}
$select1 .= "<option value=\"\" selected=\"selected\"></option></select>";
 echo "<label >Regulamentos</label>".$select1;
 
//echo '<table><tr><td>'.$form->input('organizacao',array('class'=>'formulario')).'</td><td>'.$select1.'</td></tr></table>';
 
$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
Event.observe('nome_prova', 'change', function(event) { $('ZquestaoRegulamento').value = $('nome_prova').options[$('nome_prova').options.selectedIndex].value; }, false);
//]]>
</script>
SCRIPT;

echo $jscript;				
		echo $this->Form->input('regulamento');
		echo $this->Form->input('referencia');
		echo '<label>Imagem:</label>'.$form->file('imagem',array('class'=>'formulario'));
		echo $this->Form->hidden('zfoto_id',array('value'=>0));
		echo $this->Form->hidden('tentativas',array('value'=>0));
		echo $this->Form->input('item',array('rows'=>'10','cols'=>'100'));
		echo '<label>Resposta:</label>'.$this->Form->select('Zquestao.resposta',array(''=>'','A'=>'A','B'=>'B','C'=>'C','D'=>'D','E'=>'E'));
		//echo $this->Form->input('resposta');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Zquestaos', true), array('action' => 'index'));?></li>
	</ul>
</div>