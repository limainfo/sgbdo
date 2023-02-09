<div class="PareceresTecnicos index">
<h1><?php __('Pareceres Técnicos');?></h1><?php
echo $form->create('formFind', array('url' => 'externoindex','id'=>'busca'));

echo $form->input('find', array('value' => $findUrlNotCleaned, 'label'
=> '', 'type' => 'text', 'id' => 'find', 'class' => 'formulario',
'size' => '30', 'maxlength' => '100'));

echo $form->end(array('label'=>'Buscar','class'=>'botoes'));
?>
<h3><font color="#FF0000">(Informe o número do Oficio ou Ano ou alguma informação interna ao parecer)</font><br>
<?php


echo $paginator->counter(array(
'format' => __('Página %page%/%pages%, exibindo %current% registro(s) de %count% total, registros de %start%, até %end%', true)
));
?></h3>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('oficio');?></th>
	<th><?php echo $paginator->sort('sereng');?></th>
	<th><?php echo $paginator->sort('entrada_cindacta');?></th>
	<th><?php echo $paginator->sort('entrada_opats');?></th>
	<th><?php echo $paginator->sort('situacao');?></th>
	<th><?php echo $paginator->sort('parecer');?></th>
	<th class="actions"><?php __('Ações');?></th>
</tr>
<?php
$i = 0;
foreach ($parecerestecnicos as $parecerestecnico):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' style="background-color: #e0e0f0;color: #303030;"';
	}
?>
	<tr<?php echo $class;?>>
		<td<?php echo $class;?>>
			<?php echo $parecerestecnico['Parecerestecnico']['oficio']; ?>
		</td>
		<td<?php echo $class;?>>
			<?php echo $parecerestecnico['Parecerestecnico']['sereng']; ?>
		</td>
		<td<?php echo $class;?>>
			<?php echo $parecerestecnico['Parecerestecnico']['entrada_cindacta']; ?>
		</td>
		<td<?php echo $class;?>>
			<?php echo $parecerestecnico['Parecerestecnico']['entrada_opats']; ?>
		</td>
		<td<?php echo $class;?>>
			<?php echo $parecerestecnico['Parecerestecnico']['situacao']; ?>
		</td>
		<td<?php echo $class;?>>
			<?php echo $parecerestecnico['Parecerestecnico']['parecer']; ?>
		</td>
		<td class="actions"<?php echo $class;?>>
		   <?php if(strlen($parecerestecnico['Parecerestecnico']['arquivo'])>0){ ?>
			<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'externoview', $parecerestecnico['Parecerestecnico']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		   <?php } ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging"><?php echo $paginator->prev('<< '.__('Anterior', true), array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?>
| <?php echo $paginator->numbers(array('modulus'=>200,'onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"));?> <?php echo $paginator->next(__('Próxima', true).' >>', array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?>
</div>
