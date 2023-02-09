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
		<?php echo date('d',strtotime($afastamento['Controlehora']['dia_referencia'])); ?>
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