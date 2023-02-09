<div class="escalasmonths index">
<h2><?php __('Escalasmonths');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Página %page%/%pages%, exibindo %current% registro(s) de %count% total, registros de %start%, até %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('hora_instrucao');?></th>
	<th><?php echo $paginator->sort('efetivo_total');?></th>
	<th><?php echo $paginator->sort('qtd_militares');?></th>
	<th><?php echo $paginator->sort('mes');?></th>
	<th><?php echo $paginator->sort('escala_id');?></th>
	<th class="actions"><?php __('Ações');?></th>
</tr>
<?php
$i = 0;
foreach ($escalasmonths as $escalasmonth):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $escalasmonth['Escalasmonth']['id']; ?>
		</td>
		<td>
			<?php echo $escalasmonth['Escalasmonth']['hora_instrucao']; ?>
		</td>
		<td>
			<?php echo $escalasmonth['Escalasmonth']['efetivo_total']; ?>
		</td>
		<td>
			<?php echo $escalasmonth['Escalasmonth']['qtd_militares']; ?>
		</td>
		<td>
			<?php echo $escalasmonth['Escalasmonth']['mes']; ?>
		</td>
		<td>
			<?php echo $this->Html->link($escalasmonth['Escala']['id'], array('controller'=> 'escalas', 'action'=>'view', $escalasmonth['Escala']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $escalasmonth['Escalasmonth']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit', $escalasmonth['Escalasmonth']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array('action'=>'delete', $escalasmonth['Escalasmonth']['id']), array('escape'=>false), sprintf(__('Tem certeza que deseja excluir # %s?', true), $escalasmonth['Escalasmonth']['id']),false); ?>
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
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Cadastrar Escalasmonth', true), array('action'=>'add'),array('class'=>'button')); ?></li>
		<li><?php echo $this->Html->link(__('Exibir Escalas', true), array('controller'=> 'escalas', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Escala', true), array('controller'=> 'escalas', 'action'=>'add'),array('class'=>'button')); ?> </li>
	</ul>
</div>
