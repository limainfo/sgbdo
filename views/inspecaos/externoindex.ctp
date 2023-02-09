<div class="inspecaos index">
<h1><?php __('Inspeções');?>
<?php
$script = "var x=\$('find').value;if(x.blank()){\$('broffice').href='".$this->webroot."inspecaos/indexExcel/';}else{\$('broffice').href='".$this->webroot."inspecaos/indexExcel/'+x;}";

?>
&nbsp;<?php echo $this->Html->link($this->Html->image('broffice.png', array('alt'=> __('BROffice', true), 'border'=> '0', 'title'=>'Dados em planilha BROffice', 'onmouseover'=>$script )), array('action'=>'indexExcel'), array('id'=>'broffice','escape'=>false), null,false); ?>
</h1><?php
echo $form->create('formFind', array('url' => 'externoindex','id'=>'busca'));

echo $form->input('find', array('value' => $findUrlNotCleaned, 'label'
=> '', 'type' => 'text', 'id' => 'find', 'class' => 'teste',
'size' => '30', 'maxlength' => '100','class'=>'formulario'));

echo $form->end(array('label'=>'Buscar','class'=>'botoes'));
?>
<h3>
<?php
echo $paginator->counter(array(
'format' => __('Página %page%/%pages%, exibindo %current% registro(s) de %count% total, registros de %start%, até %end%', true)
));
?></h3>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('origem');?></th>
	<th><?php echo $paginator->sort('orgao');?></th>
	<th><?php echo $paginator->sort('descricao');?></th>
	<th><?php echo $paginator->sort('acao_recomendada');?></th>
	<th><?php echo $paginator->sort('gestor');?></th>
	<th><?php echo $paginator->sort('providencia_gestor');?></th>
	<th><?php echo $paginator->sort('executor');?></th>
	<th><?php echo $paginator->sort('acao_executor');?></th>
	<th><?php echo $paginator->sort('obs_do');?></th>
	<th><?php echo $paginator->sort('status');?></th>
	<th class="actions"><?php __('Ações');?></th>
</tr>
<?php
$i = 0;
foreach ($inspecaos as $inspecao):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $inspecao['Inspecao']['origem']; ?>
		</td>
		<td>
			<?php echo $inspecao['Inspecao']['orgao']; ?>
		</td>
		<td>
			<?php echo $inspecao['Inspecao']['descricao']; ?>
		</td>
		<td>
			<?php echo $inspecao['Inspecao']['acao_recomendada']; ?>
		</td>
		<td>
			<?php echo $inspecao['Inspecao']['gestor']; ?>
		</td>
		<td>
			<?php echo $inspecao['Inspecao']['providencia_gestor']; ?>
		</td>
		<td>
			<?php echo $inspecao['Inspecao']['executor']; ?>
		</td>
		<td>
			<?php echo $inspecao['Inspecao']['acao_executor']; ?>
		</td>
		<td>
			<?php echo $inspecao['Inspecao']['obs_do']; ?>
		</td>
		<td>
			<?php echo $inspecao['Inspecao']['status']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $inspecao['Inspecao']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging"><?php echo $paginator->prev('<< '.__('Anterior', true), array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?>
| <?php echo $paginator->numbers(array('modulus'=>200,'onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"));?> <?php echo $paginator->next(__('Próxima', true).' >>', array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?>
</div>
