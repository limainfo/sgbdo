<div class="militarsEscalas index">
<h1><?php __('MilitarsEscalas');?>
&nbsp;<?php echo $this->Html->link($this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'add', null),array('escape'=>false, 'escape'=>false), null,false); ?>
</h1>
<h3><?php
$paginator->options(array('update' => 'wrapper', 'indicator' => 'spinner'));
echo $paginator->counter(array(
'format' => __('Página %page%/%pages%, exibindo %current% registro(s) de %count% total, registros de %start%, até %end%', true)
));
?></h3>
<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo $paginator->sort('id');?></th>
		<th><?php echo $paginator->sort('escala_id');?></th>
		<th><?php echo $paginator->sort('militar_id');?></th>
		<th><?php echo $paginator->sort('codigo');?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($militarsEscalas as $militarsEscala):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	?>
	<tr <?php echo $class;?>>
		<td><?php echo $militarsEscala['MilitarsEscala']['id']; ?></td>
		<td><?php echo $this->Html->link($militarsEscala['Escala']['nm_escala'], array('controller'=> 'escalas', 'action'=>'view', $militarsEscala['Escala']['id'])); ?>
		</td>
		<td><?php echo $this->Html->link($militarsEscala['Militar']['nm_completo'], array('controller'=> 'militars', 'action'=>'view', $militarsEscala['Militar']['id'])); ?>
		</td>
		<td><?php echo $militarsEscala['MilitarsEscala']['codigo']; ?></td>
		<td class="actions"><?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $militarsEscala['MilitarsEscala']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit', $militarsEscala['MilitarsEscala']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php
		echo $yahooUi->generateScriptForSimpleDialog('del'.$militarsEscala['MilitarsEscala']['id'], array('body'=>'Tem certeza que deseja excluir # '.$militarsEscala['MilitarsEscala']['id'].' ?'));

		echo $yahooUi->imgForSimpleDialog('del'.$militarsEscala['MilitarsEscala']['id'],'lixo.gif',array('function'=>'delete','id'=>$militarsEscala['MilitarsEscala']['id'])); 
		
		
		?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
</div>
<br><hr>
<div class="paging"><?php echo $paginator->prev('<< '.__('Anterior', true), array(), null, array('class'=>'disabled'));?>
| <?php echo $paginator->numbers(array('modulus'=>200));?> <?php echo $paginator->next(__('Próxima', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
