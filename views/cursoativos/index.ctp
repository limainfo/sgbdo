

<div class="cursoativos index">
<h1><?php __('Mapeamentos PAEAT/EXTRA/PACESP');?><?php
$script = "var x=\$('find').value;if(x.blank()){\$('broffice').href='".$this->webroot."Cursoativos/indexExcel/';}else{\$('broffice').href='".$this->webroot."Cursoativos/indexExcel/'+x;}";?>
&nbsp;<?php echo $this->Html->link($this->Html->image('broffice.png', array('alt'=> __('BROffice', true), 'border'=> '0', 'title'=>'Dados em planilha BROffice', 'onmouseover'=>$script )), array('action'=>'indexExcel'), array('id'=>'broffice','escape'=>false), null,false); ?>
&nbsp;<?php echo $this->Html->link($this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'add', null),array('escape'=>false, 'escape'=>false), null,false); ?></h1><?php
echo $form->create('formFind', array('url' => 'index','id'=>'busca'));
echo '<div class="input text"><label for="find">Informe os dados a serem pesquisados</label><input type="text" maxlength="100" size="30" class="formulario" id="find" value="'.$this->data['formFind']['find'].'" name="data[formFind][find]"/>
<input type="submit" value="Buscar" class="botoes"/></div>';
?><h3>

<?php
$paginator->options(array('update' => 'wrapper', 'indicator' => 'spinner'));
echo $paginator->counter(array(
'format' => __('Página %page%/%pages%, exibindo %current% registro(s) de %count% total, registros de %start%, até %end%', true)
));
?>
</h3>
<?php
	
		echo '<div class="input select" style="align:right;">Registros por página:<select id="FindPaginas" name="data[formFind][paginas]" class="formulario" onchange="$(\'busca\').submit();">';
		for($i=$min_registros;$i<=$max_registros;$i+=$passo){
		echo '<option value="'.$i.'">'.$i.'</option>';
		}
		echo '<option value="TODAS">TODAS</option>';
		if(!empty($this->data['formFind']['paginas'])){
			echo '<option value="'.$this->data['formFind']['paginas'].'" selected="selected">'.$this->data['formFind']['paginas'].'</option>';
		}
		echo '</select></div>';
?>
<?php echo $form->end(); ?><table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('ano_base');?></th>
	<th><?php echo $paginator->sort('curso_id');?></th>
	<th><?php echo $paginator->sort('turma');?></th>
	<th><?php echo $paginator->sort('tipocurso_id');?></th>
	<th><?php echo $paginator->sort('natureza');?></th>
	<th><?php echo $paginator->sort('data_inicio');?></th>
	<th><?php echo $paginator->sort('data_termino');?></th>
	<th><?php echo $paginator->sort('vagas');?></th>
	<th><?php echo $paginator->sort('documento_ativacao');?></th>
	<th><?php echo $paginator->sort('local_realizacao');?></th>
	<th><?php echo $paginator->sort('status_atual');?></th>
	<th class="actions"><?php __('Ações');?></th>
</tr>
<?php
$i = 0;
foreach ($cursoativos as $cursoativo):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $cursoativo['Cursoativo']['ano_base']; ?>
		</td>
		<td>
			<?php echo $this->Html->link($cursoativo['Curso']['codigo'], array('controller'=> 'cursos', 'action'=>'view', $cursoativo['Curso']['id'])); ?>
		</td>
		<td>
			<?php echo $cursoativo['Cursoativo']['turma']; ?>
		</td>
		<td>
			<?php echo $cursoativo['Tipocurso']['tipo_curso']; ?>
		</td>
		<td>
			<?php echo $cursoativo['Cursoativo']['natureza']; ?>
		</td>
		<td>
			<?php echo $cursoativo['Cursoativo']['data_inicio']; ?>
		</td>
		<td>
			<?php echo $cursoativo['Cursoativo']['data_termino']; ?>
		</td>
		<td>
			<?php echo $cursoativo['Cursoativo']['vagas']; ?>
		</td>
		<td>
			<?php echo $cursoativo['Cursoativo']['documento_ativacao']; ?>
		</td>
		<td>
			<?php echo $cursoativo['Cursoativo']['local_realizacao']; ?>
		</td>
		<td>
			<?php echo $cursoativo['Cursoativo']['status_atual']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $cursoativo['Cursoativo']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>			<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit', $cursoativo['Cursoativo']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>			<?php  echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$cursoativo['Cursoativo']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$cursoativo['Cursoativo']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);?>		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('Anterior', true), array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?>	| <?php echo $paginator->numbers(array('modulus'=>200,'onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"));?> 
	<?php echo $paginator->next(__('Próxima', true).' >>', array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?></div>

