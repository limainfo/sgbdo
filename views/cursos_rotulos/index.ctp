<div class="cursosRotulos index">
<h1><?php __('CursosRotulos');?>&nbsp;<?php echo $this->Html->link($this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'add', null),array('escape'=>false, 'escape'=>false), null,false); ?></h1>
 
<?php
echo $form->create('formFind', array('url' => 'index'));

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
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('rotulo_id');?></th>
	<th><?php echo $paginator->sort('curso_id');?></th>
	<th class="actions"><?php __('Ações');?></th>
</tr>
<?php
$i = 0;
//print_r($cursosRotulos);
foreach ($cursosRotulos as $cursosRotulo):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $cursosRotulo['CursosRotulo']['id']; ?>
		</td>
		<td>
			<?php echo $this->Html->link($cursosRotulo['Rotulo']['rotulo'], array('controller'=> 'rotulos', 'action'=>'view', $cursosRotulo['Rotulo']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($cursosRotulo['Curso']['codigo'], array('controller'=> 'cursos', 'action'=>'view', $cursosRotulo['Curso']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $cursosRotulo['CursosRotulo']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit', $cursosRotulo['CursosRotulo']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php  echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$cursosRotulo['CursosRotulo']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$cursosRotulo['CursosRotulo']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false); 
		?>

				</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('Anterior', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers(array('modulus'=>200));?>
	<?php echo $paginator->next(__('Próxima', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
	