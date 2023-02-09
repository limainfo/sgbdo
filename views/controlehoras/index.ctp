<style>
<!--
.tooltiptstyle{
 background-color:#333;
 padding: 1px 3px;
 color: #fff;
 font-size:9px;
position: absolute;
}

-->
</style>
<?php
		//	echo "<pre>".print_r($escalas)."</pre>";
			

?>
<div class="Controlehoras index">
<h1><?php __('Controlehoras');?>
&nbsp;<?php echo $this->Html->link($this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'add', null),array('escape'=>false, 'escape'=>false), null,false); ?>
</h1>
<?php
//echo '<pre>'.print_r($escalas).' </pre>';

echo $form->create('formFind', array('url' => 'index','id'=>'busca'));

echo $form->input('find', array('value' => $findUrlNotCleaned, 'label'
=> '', 'type' => 'text', 'id' => 'find', 'class' => 'teste',
'size' => '30', 'maxlength' => '100','class'=>'formulario'));

echo $form->end(array('label'=>'Buscar','class'=>'botoes'));
?>
<h3>
<?php
$paginator->options(array('update' => 'wrapper', 'indicator' => 'spinner'));
echo $paginator->counter(array(
'format' => __('Página %page%/%pages%, exibindo %current% registro(s) de %count% total, registros de %start%, até %end%', true)
));
?></h3>
<table cellpadding="0" cellspacing="0">
	<tr>
		<th>Setor&nbsp;</th>
		<th>Militar&nbsp;</th>
		<th>Dia&nbsp;</th>
		<th>Hora Início&nbsp;</th>
		<th>Hora Término&nbsp;</th>
		<th>Supervisor&nbsp;</th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($afastamentos as $afastamento):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	?>
	<tr <?php echo $class;?>>
		<td><?php echo $afastamento['Setor']['sigla_setor']; ?></td>
		<td><?php echo $afastamento['0']['nome_completo']; ?></td>
		<td>
		<div  rel='tooltip' id='i<?php echo $afastamento['Controlehora']['id']; ?>' title='<?php echo '<b>Responsável:</b>'.$afastamento['Controlehora']['supervisor'].'<br>'; ?>'>
		<?php echo date('d',$afastamento['Controlehora']['dia_referencia']); ?>
			</div>
		</td>
		<td><?php echo $afastamento['Controlehora']['hora_inicio']; ?></td>
		<td><?php echo $afastamento['Controlehora']['hora_termino']; ?></td>
		<td><?php echo $afastamento['Controlehora']['supervisor']; ?></td>
		<td class="actions"><?php
		if(($u[0]['Usuario']['militar_id']==$afastamento['Controlehora']['militar_responsavel'])||($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)){
			
		echo $yahooUi->generateScriptForSimpleDialog('del'.$afastamento['Controlehora']['id'], array('body'=>'Tem certeza que deseja excluir # '.$afastamento['0']['nome_completo'].' ?'));
		echo $yahooUi->imgForSimpleDialog('del'.$afastamento['Controlehora']['id'],'lixo.gif',array('function'=>'delete','id'=>$afastamento['Controlehora']['id']));
		} 
		?>
		</td>

	</tr>
	<?php endforeach; ?>
</table>
</div>
<br><hr>
<div class="paging"><?php echo $paginator->prev('<< '.__('Anterior', true), array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?>
| <?php echo $paginator->numbers(array('modulus'=>200,'onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"));?> <?php echo $paginator->next(__('Próxima', true).' >>', array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?>
</div>
