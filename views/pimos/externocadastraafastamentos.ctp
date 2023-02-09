<?php echo $this->Session->flash(); ?>
<script language="javascript">
	//mensagem = $('flashMsg');mensagem.setStyle('display:block');
</script>
<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo __('militar_id');?></th>
		<th><?php echo __('motivo');?></th>
		<th><?php echo __('dt_inicio');?></th>
		<th><?php echo __('dt_termino');?></th>
		<th><?php echo __('obs');?></th>
		<th><span>Escala</span></th>
		<th><?php echo __('Inserido');?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
<?php 
	$i = 0;
	foreach ($afastamentosdodia as $afastamento):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	?>
	<tr <?php echo $class;?>>
		<td>
			<?php echo $this->Html->link($afastamento['Posto']['sigla_posto'].' '.$afastamento['Especialidade']['nm_especialidade'].' '.$afastamento['Militar']['nm_completo'], array('controller'=> 'militars', 'action'=>'view', $afastamento['Militar']['id']),array('rel'=>'tooltip')); ?>
<!-- <div  rel='tooltip' id='i<?php echo $afastamento['Afastamento']['id']; ?>' title='<?php echo '<p style="background-color:#000;color:#fff;"><br><b>Responsável:</b>'.$responsavel[0][$afastamento['Afastamento']['militar_responsavel']]."<br><b>Identidade:</b>".$responsavel[1][$afastamento['Afastamento']['militar_responsavel']].'<br><br></p>'; ?>'>
			<?php echo $this->Html->link($afastamento['Posto']['sigla_posto'].' '.$afastamento['Especialidade']['nm_especialidade'].' '.$afastamento['Militar']['nm_completo'], array('controller'=> 'militars', 'action'=>'view', $afastamento['Militar']['id']),array('rel'=>'tooltip')); ?>
			</div>
 -->		
		</td>
		<td><?php echo $afastamento['Afastamento']['motivo']; ?></td>
		<td><?php echo date('d-m-Y',strtotime($afastamento['Afastamento']['dt_inicio'])); ?></td>
		<td><?php echo date('d-m-Y',strtotime($afastamento['Afastamento']['dt_termino'])); ?></td>
		<td><?php echo $afastamento['Afastamento']['obs']; ?></td>
		<td><?php echo $afastamento['Setor']['sigla_setor']; ?></td>
		<td><?php echo date('d-m-Y h:i:s',strtotime($afastamento['Afastamento']['created'])) ?></td>
		<td class="actions">
		<?php
		//if(array_key_exists($afastamento['Afastamento']['escala_id'],$ativos)||($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)) {
		if((array_search($afastamento['Afastamento']['setor_id'],$setores)||($afastamento['Afastamento']['setor_id']==$setores[0]))&&(($u[0]['Usuario']['privilegio_id']==5)||($u[0]['Usuario']['privilegio_id']==6))){
			$apaga=1;
		} else{
			$apaga=0;
		}
		//echo $apaga.' apagar';
		
//		if(array_key_exists($afastamento['Afastamento']['escala_id'],$ativos)) { 
		if(($u[0]['Usuario']['militar_id']==$afastamento['Afastamento']['militar_responsavel'])||($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)||($apaga)){
			
		//echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$afastamento['Militar']['nm_completo'].' - Início:'.$afastamento['Afastamento']['dt_inicio']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$afastamento['Afastamento']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);
		echo "<a onclick=\"$('afastamentoid').value='{$afastamento['Afastamento']['id']}';$('afastamentoid').fire('afastamentoid:exclui',{log:1});\"  ><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"{$this->webroot}img/lixo.gif\"></a>";
		} 
	//	}
		?>
		</td>

	</tr>
	<?php endforeach; ?>
</table>
<script>
new Effect.Fade('flashMessage',{delay: 100});
</script>
