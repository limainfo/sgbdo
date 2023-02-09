<div class="logs index">
<h1><?php __('Logs');?>&nbsp;</h1>

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
	<th><?php echo __('Display');?></th>
	<th><?php echo __('Data');?></th>
	<th><?php echo __('Tabela');?></th>
	<th><?php echo __('Tabela_id');?></th>
	<th><?php echo __('Ação');?></th>
	<th><?php echo __('usuario_nome');?></th>
	<th><?php echo __('Modificação');?></th>
	<th><?php echo __('IP');?></th>
	<th class="actions"><?php __('Ações');?></th>
</tr>
<?php
$i = 0;
foreach ($logs as $log):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $log['Log']['title']; ?>
		</td>
		<td>
			<?php echo $log['Log']['created']; ?>
		</td>
		<td>
			<?php echo $log['Log']['model']; ?>
		</td>
		<td>
			<?php echo $log['Log']['model_id']; ?>
		</td>
		<td>
			<?php echo $log['Log']['action']; ?>
		</td>
		<td>
			<?php echo $log['Log']['usuario_nome']; ?>
		</td>
		<td>
			<?php echo $log['Log']['changes']; ?>
		</td>
		<td>
			<?php echo $log['Log']['ip']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $log['Log']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
				</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<br><hr>
<div class="paging"><?php echo $paginator->prev('<< '.__('Anterior', true), array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?>
| <?php echo $paginator->numbers(array('modulus'=>200,'onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"));?> <?php echo $paginator->next(__('Próxima', true).' >>', array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?>
</div>


<script languague="javascript">
new PeriodicalExecuter(function(pe) {
  	location.reload(true);
}, 30);

</script>