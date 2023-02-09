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
<div class="afastamentos index">
<h1><?php __('Afastamentos');?>
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
		<th><?php echo $paginator->sort('militar_id');?></th>
		<th><?php echo $paginator->sort('motivo');?></th>
		<th><?php echo $paginator->sort('dt_inicio');?></th>
		<th><?php echo $paginator->sort('dt_termino');?></th>
		<th><?php echo $paginator->sort('obs');?></th>
		<th><span>Escala</span></th>
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
		<td>
		<div  rel='tooltip' id='i<?php echo $afastamento['Afastamento']['id']; ?>' title='<?php echo '<b>Responsável:</b>'.$responsavel[0][$afastamento['Afastamento']['militar_responsavel']]."<br><b>Identidade:</b>".$responsavel[1][$afastamento['Afastamento']['militar_responsavel']].'<br>'; ?>'>
			<?php echo $this->Html->link($afastamento['Militar']['Posto']['sigla_posto'].' '.$afastamento['Militar']['Especialidade']['nm_especialidade'].' '.$afastamento['Militar']['nm_completo'], array('controller'=> 'militars', 'action'=>'view', $afastamento['Militar']['id'])); ?>
			</div>
		</td>
		<td><?php echo $afastamento['Afastamento']['motivo']; ?></td>
		<td><?php echo $afastamento['Afastamento']['dt_inicio']; ?></td>
		<td><?php echo $afastamento['Afastamento']['dt_termino']; ?></td>
		<td><?php echo $afastamento['Afastamento']['obs']; ?></td>
		<td><?php echo $escalas[$afastamento['Afastamento']['escala_id']]; ?></td>
		<td class="actions"><?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $afastamento['Afastamento']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php
	//	if(($u[0]['Usuario']['militar_id']==$afastamento['Afastamento']['militar_responsavel'])||($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)){
		echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit', $afastamento['Afastamento']['id']),array('escape'=>false, 'escape'=>false), null,false); 
			
		echo $yahooUi->generateScriptForSimpleDialog('del'.$afastamento['Afastamento']['id'], array('body'=>'Tem certeza que deseja excluir # '.$afastamento['Afastamento']['id'].' ?'));
		echo $yahooUi->imgForSimpleDialog('del'.$afastamento['Afastamento']['id'],'lixo.gif',array('function'=>'delete','id'=>$afastamento['Afastamento']['id']));
	//	} 
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
