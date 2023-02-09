



<div class="nivelInglesFase01s index">
	<h1><?php __('Nivel Inglês Fase 01 ');?>    &nbsp;
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
			<th><?php echo $this->Paginator->sort('acertos');?></th>
			<th><?php echo $this->Paginator->sort('erros');?></th>
			<th><?php echo $this->Paginator->sort('nota');?></th>
			<th><?php echo $this->Paginator->sort('identidade');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($nivelInglesFase01s as $nivelInglesFase01):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $this->Html->link($nivelInglesFase01['Militar']['Posto']['sigla_posto'].' '.$nivelInglesFase01['Militar']['Especialidade']['nm_especialidade'].' '.$nivelInglesFase01['Militar']['nm_completo'], array('controller' => 'militars', 'action' => 'view', $nivelInglesFase01['Militar']['id'])); ?>
		</td>
		<td><?php echo $nivelInglesFase01['NivelInglesFase01']['ano']; ?>&nbsp;</td>
		<td><?php echo $nivelInglesFase01['NivelInglesFase01']['dt_realizacao']; ?>&nbsp;</td>
		<td><?php echo $nivelInglesFase01['NivelInglesFase01']['operacional']; ?>&nbsp;</td>
		<td><?php echo $nivelInglesFase01['NivelInglesFase01']['local_trabalho']; ?>&nbsp;</td>
		<td><?php echo $nivelInglesFase01['NivelInglesFase01']['regional']; ?>&nbsp;</td>
		<td><?php echo $nivelInglesFase01['NivelInglesFase01']['acertos']; ?>&nbsp;</td>
		<td><?php echo $nivelInglesFase01['NivelInglesFase01']['erros']; ?>&nbsp;</td>
		<td><?php echo $nivelInglesFase01['NivelInglesFase01']['nota']; ?>&nbsp;</td>
		<td><?php echo $nivelInglesFase01['NivelInglesFase01']['identidade']; ?>&nbsp;</td>
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
