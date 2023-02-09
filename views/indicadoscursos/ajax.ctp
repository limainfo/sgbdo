<?php echo $form->create('Indicadoscurso',array('action'=>'ajax'));

	
$select1 = '<label for="IndicadoscursoMotivo">Listar:</label><select id="opcao" name="data[opcao]" class="formulario">';
$select1 .= '<option value=" " selected></option>';
$select1 .= '<option value="INDICADOS">INDICADOS</option>';
$select1 .= '<option value="CURSANDO">CURSANDO</option>';
$select1 .= '<option value="CONCLUÍDO">CONCLUÍDO</option>';
$select1 .= '<option value="'.$opcao.'" selected="selected">'.$opcao.'</option>';
$select1 .= '</select></fieldset>';

echo $select1;


		


//echo $jscript;		

$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
Event.observe('opcao', 'change', function(event) { $('IndicadoscursoAjaxForm').submit();var x=$('opcao').options[$('opcao').options.selectedIndex].value;
 }, false);
//]]>
</script>
SCRIPT;

echo $jscript;		

	?>
	
<?php

echo $form->end();?>


<table cellpadding="0" cellspacing="0">
<tr>
	<th>Curso Ativo - Turma</th>
	<th>Militar</th>
	<th>Tipo</th>
	<th>Prioridade</th>
	<th>Data Início</th>
	<th>Data Término</th>
	<th class="actions"><?php __('Ações');?></th>
</tr>
<?php
$i = 0;
//print_r($indicadoscursos);

foreach ($indicadoscursos as $indicadoscurso):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
			<?php if($indicadoscurso['Indicadoscurso']['status']=='C'){$td = ' style="background-color:#F0D0D0;" ';}else{$td="";} ?>
	<tr<?php echo $class;?>>
		<td <?php echo $td;?>>
			<?php echo $this->Html->link($indicadoscurso['Curso']['codigo'].'-'.$indicadoscurso['Cursoativo']['turma'], array('controller'=> 'cursoativos', 'action'=>'view', $indicadoscurso['Cursoativo']['id'])); ?>
		</td>
		<td <?php echo $td;?>>
			<?php 
			echo $this->Html->link($indicadoscurso['Posto']['sigla_posto'].' '.$indicadoscurso['Quadro']['sigla_quadro'].' - '.$indicadoscurso['Militar']['nm_completo'], array('controller'=> 'militars', 'action'=>'view', $indicadoscurso['Militar']['id'])); ?>
		</td>
		<td <?php echo $td;?>>
			<?php echo $indicadoscurso['Indicadoscurso']['tipo']; ?>
		</td>
		<td <?php echo $td;?>>
			<?php echo $indicadoscurso['Indicadoscurso']['prioridade']; ?>
		</td>
		<td <?php echo $td;?>>
			<?php echo $indicadoscurso['Cursoativo']['data_inicio']; ?>
		</td>
		<td <?php echo $td;?>>
			<?php echo $indicadoscurso['Cursoativo']['data_termino']; ?>
		</td>
		<td class="actions" <?php echo $td;?>>
			<?php 
			if($indicadoscurso['Indicadoscurso']['status']=='I'){
				echo $this->Html->link($this->Html->image('accept.png', array('alt'=> __('Concluir', true), 'border'=> '0', 'title'=>'Concluir')), array(), array('onmousedown'=>'dialogo("Esta modificação não poderá ser desfeita! <br>O militar concluiu o referido curso?<br> #'.$indicadoscurso['Curso']['codigo'].'-'.$indicadoscurso['Cursoativo']['turma'].':'.$indicadoscurso['Militar']['nm_completo'].'" ,"'.$this->webroot.$this->params['controller'].'/ajax/'.$indicadoscurso['Indicadoscurso']['id'].'/'.$indicadoscurso['Curso']['id'].'/'.$indicadoscurso['Militar']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);
			
			} ?></td>
	</tr>
<?php endforeach; ?>
</table>

<?php
//.'/'.urlencode($indicadoscurso['Cursoativo']['data_inicio']).'/'.urlencode($indicadoscurso['Cursoativo']['data_termino']).'/'.urlencode($indicadoscurso['Cursoativo']['documento_ativacao']).'/'.urlencode($indicadoscurso['Cursoativo']['local_realizacao'])
echo "<pre>";
//print_r($indicadoscurso);
echo "</pre>";
?>