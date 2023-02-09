



<div class="nivelInglesFase02s index">
	<h1><?php __('Nivel Inglês Fase 02');?>    &nbsp;
	</h1>
	<?php echo $form->create('formFind', array('url' => 'index','id'=>'busca'));
		echo '<div class="input text"><label for="find">Informe os dados a serem pesquisados</label><input type="text" maxlength="100" size="30" class="formulario" id="find" value="'.$this->data['formFind']['find'].'" name="data[formFind][find]"/>
		<input type="submit" value="Buscar" class="botoes"/></div>';
		?>	<h3>
	<?php
		echo $paginator->counter(array('format' => __('Página %page%/%pages%, exibindo %current% registro(s) de %count% total, registros de %start% até %end%', true)));
		
		?>	</h3>
	
	
<?php
		echo '<div class="input select" style="align:right;">Registros por página:<select id="FindPaginas" name="data[formFind][paginas]" class="formulario" onchange="$(\'busca\').submit();">';
		for($i=$min_registros;$i<=$max_registros;$i+=$passo){
		echo '<option value="'.$i.'">'.$i.'</option>';
		}
		echo '<option value="'.$paginator->counter(array('format' => __('%count%', true))).'">'.$paginator->counter(array('format' => __('%count%', true))).'</option>';
		if(!empty($this->data['formFind']['paginas'])){
			echo '<option value="'.$this->data['formFind']['paginas'].'" selected="selected">'.$this->data['formFind']['paginas'].'</option>';
		}
		echo '</select></div>';
?>
<?php echo $form->end(); ?>


	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('militar_id');?></th>
			<th><?php echo $this->Paginator->sort('ano');?></th>
			<th><?php echo $this->Paginator->sort('dt_realizacao');?></th>
			<th><?php echo $this->Paginator->sort('operacional');?></th>
			<th><?php echo $this->Paginator->sort('local_trabalho');?></th>
			<th><?php echo $this->Paginator->sort('regional');?></th>
			<th><?php echo $this->Paginator->sort('regional_exame');?></th>
			<th><?php echo $this->Paginator->sort('setutil');?></th>
			<th><?php echo $this->Paginator->sort('banda');?></th>
			<th><?php echo $this->Paginator->sort('pronuncia');?></th>
			<th><?php echo $this->Paginator->sort('estrutura');?></th>
			<th><?php echo $this->Paginator->sort('vocabulario');?></th>
			<th><?php echo $this->Paginator->sort('fluencia');?></th>
			<th><?php echo $this->Paginator->sort('compreensao');?></th>
			<th><?php echo $this->Paginator->sort('interacao');?></th>
			<th><?php echo $this->Paginator->sort('identidade');?></th>
			<th><?php echo $this->Paginator->sort('identidade_interlocutor');?></th>
			<th><?php echo $this->Paginator->sort('identidade_avaliador');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($nivelInglesFase02s as $nivelInglesFase02s):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $this->Html->link($nivelInglesFase02s['Militar']['Posto']['sigla_posto'].' '.$nivelInglesFase02s['Militar']['Especialidade']['nm_especialidade'].' '.$nivelInglesFase02s['Militar']['nm_completo'], array('controller' => 'militars', 'action' => 'view', $nivelInglesFase02s['Militar']['id'])); ?>
		</td>
		<td><?php echo $nivelInglesFase02s['NivelInglesFase02']['ano']; ?>&nbsp;</td>
		<td><?php echo $nivelInglesFase02s['NivelInglesFase02']['dt_realizacao']; ?>&nbsp;</td>
		<td><?php echo $nivelInglesFase02s['NivelInglesFase02']['operacional']; ?>&nbsp;</td>
		<td><?php echo $nivelInglesFase02s['NivelInglesFase02']['local_trabalho']; ?>&nbsp;</td>
		<td><?php echo $nivelInglesFase02s['NivelInglesFase02']['regional']; ?>&nbsp;</td>
		<td><?php echo $nivelInglesFase02s['NivelInglesFase02']['regional_exame']; ?>&nbsp;</td>
		<td><?php echo $nivelInglesFase02s['NivelInglesFase02']['setutil']; ?>&nbsp;</td>
		<td><?php echo $nivelInglesFase02s['NivelInglesFase02']['banda']; ?>&nbsp;</td>
		<td><?php echo $nivelInglesFase02s['NivelInglesFase02']['pronuncia']; ?>&nbsp;</td>
		<td><?php echo $nivelInglesFase02s['NivelInglesFase02']['estrutura']; ?>&nbsp;</td>
		<td><?php echo $nivelInglesFase02s['NivelInglesFase02']['vocabulario']; ?>&nbsp;</td>
		<td><?php echo $nivelInglesFase02s['NivelInglesFase02']['fluencia']; ?>&nbsp;</td>
		<td><?php echo $nivelInglesFase02s['NivelInglesFase02']['compreensao']; ?>&nbsp;</td>
		<td><?php echo $nivelInglesFase02s['NivelInglesFase02']['interacao']; ?>&nbsp;</td>
		<td><?php echo $nivelInglesFase02s['NivelInglesFase02']['identidade']; ?>&nbsp;</td>
		<td><?php echo $nivelInglesFase02s['NivelInglesFase02']['identidade_interlocutor']; ?>&nbsp;</td>
		<td><?php echo $nivelInglesFase02s['NivelInglesFase02']['identidade_avaliador']; ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('Anterior', true), array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers(array('modulus'=>200,'onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"));?>
 |
		<?php echo $this->Paginator->next(__('Próxima', true) . ' >>', array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class' => 'disabled'));?>
	</div>
	
	
	
	
	
	
	
</div>
