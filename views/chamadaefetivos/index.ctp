<div class="habilitacaos index">
<h1><?php __('Habilitações');?>
&nbsp;<?php echo $html->link($html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'add', null),array('escape'=>false, 'escape'=>false), null,false); ?>
</h1>
<?php
echo $form->create('formFind', array('url' => 'index','id'=>'busca'));

echo '<div class="input text"><label for="find">Informe os dados a serem pesquisados</label><input type="text" maxlength="100" size="30" class="formulario" id="find" value="'.$this->data['formFind']['find'].'" name="data[formFind][find]"/>
<input type="submit" value="Buscar" class="botoes"/></div>';
		?>

<h3><?php
$paginator->options(array('update' => 'wrapper', 'indicator' => 'spinner'));
echo $paginator->counter(array(
'format' => __('Página %page%/%pages%, exibindo %current% registro(s) de %count% total, registros de %start% até %end%', true)
));
?></h3><?php
		echo '<div class="input select" style="align:right;">Registros por página:<select id="FindPaginas" name="data[formFind][paginas]" class="formulario" onchange="$(\'busca\').submit();">';
		echo '<option value="10">10</option>';
		echo '<option value="15">15</option>';
		echo '<option value="20">20</option>';
		echo '<option value="25">25</option>';
		echo '<opt" (LOWER(`Curso`.`codigo`) LIKE '%".$findUrl."%' OR LOWER(`Cursoativo`.`turma`) LIKE '%" . $findUrl ."%' )"ion value="30">30</option>';
		echo '<option value="TODAS">TODAS</option>';
		if(!empty($this->data['formFind']['paginas'])){
			echo '<option value="'.$this->data['formFind']['paginas'].'" selected="selected">'.$this->data['formFind']['paginas'].'</option>';
		}
		echo '</select></div>';
?>
<?php echo $form->end(); ?>
<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo $paginator->sort('militar_id');?></th>
		<th><?php //echo $paginator->sort('cht_anterior');?></th>
		<th><?php echo $paginator->sort('cht_atual');?></th>
		<th><?php //echo $paginator->sort('validade_cht_anterior');?></th>
		<th><?php echo $paginator->sort('validade_cht_atual');?></th>
		<th><?php echo $paginator->sort('funcao');?></th>
		<th><?php //echo $paginator->sort('setor');?></th>
		<th><?php //echo $paginator->sort('dt_designacao');?></th>
		<th><?php echo $paginator->sort('CDO','condicao_operacional');?></th>
		<th><?php echo $paginator->sort('CCO','conceito_operacional');?></th>
		<th><?php echo $paginator->sort('Grau','grau_teorico');?></th>
		<th><?php echo $paginator->sort('dt_teste_fisico');?></th>
		<th><?php echo $paginator->sort('nivel_ingles');?></th>
		<th><?php echo $paginator->sort('indicativo');?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($habilitacaos as $habilitacao):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	?>
	<tr <?php echo $class;?>>
		<td><?php echo $html->link($habilitacao['Militar']['Posto']['sigla_posto'].' '.$habilitacao['Militar']['Especialidade']['nm_especialidade'].' '.$habilitacao['Militar']['nm_completo'], array('controller'=> 'militars', 'action'=>'view', $habilitacao['Militar']['id'])); ?>
		</td>
		<td><?php //echo $habilitacao['Habilitacao']['cht_anterior']; ?></td>
		<td><?php echo $habilitacao['Habilitacao']['cht_atual']; ?></td>
		<td><?php //echo $habilitacao['Habilitacao']['validade_cht_anterior']; ?>
		</td>
		<td><?php echo $habilitacao['Habilitacao']['validade_cht_atual']; ?></td>
		<td><?php echo $habilitacao['Habilitacao']['funcao']; ?></td>
		<td><?php //echo $habilitacao['Habilitacao']['setor']; ?></td>
		<td><?php //echo $habilitacao['Habilitacao']['dt_designacao']; ?></td>
		<td><?php echo $habilitacao['Habilitacao']['condicao_operacional']; ?>
		</td>
		<td><?php echo $habilitacao['Habilitacao']['conceito_operacional']; ?>
		</td>
		<td><?php echo $habilitacao['Habilitacao']['grau_teorico']; ?></td>
		<td><?php echo $habilitacao['Habilitacao']['dt_teste_fisico']; ?></td>
		<td><?php echo $habilitacao['Habilitacao']['nivel_ingles']; ?></td>
		<td><?php echo $habilitacao['Habilitacao']['indicativo']; ?></td>
		<td class="actions"><?php echo $html->link($html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $habilitacao['Habilitacao']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $html->link($html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit', $habilitacao['Habilitacao']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php
		echo $html->link($html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$habilitacao['Habilitacao']['cht_atual']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$habilitacao['Habilitacao']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false); 
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
