<div class="privilegios index">
<h1><?php __('Privilegios');?></h1><?php
echo $form->create('formFind', array('url' => 'index','id'=>'busca'));

echo $form->input('find', array('value' => $findUrlNotCleaned, 'label'
=> '', 'type' => 'text', 'id' => 'find', 'class' => 'teste',
'size' => '30', 'maxlength' => '100'));

echo $form->end('Buscar');
?>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Página %page%/%pages%, exibindo %current% registro(s) de %count% total, registros de %start%, até %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('acesso');?></th>
	<th><?php echo $paginator->sort('descricao');?></th>
	<th class="actions"><?php __('Ações');?></th>
</tr>
<?php
$i = 0;
foreach ($privilegios as $privilegio):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $privilegio['Privilegio']['id']; ?>
		</td>
		<td>
			<?php echo $privilegio['Privilegio']['acesso']; ?>
		</td>
		<td>
			<?php echo $privilegio['Privilegio']['descricao']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $privilegio['Privilegio']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit', $privilegio['Privilegio']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array('action'=>'delete', $privilegio['Privilegio']['id']), array('escape'=>false), sprintf(__('Tem certeza que deseja excluir # %s?', true), $privilegio['Privilegio']['id']),false); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging"><?php echo $paginator->prev('<< '.__('Anterior', true), array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?>
| <?php echo $paginator->numbers(array('modulus'=>200,'onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"));?> <?php echo $paginator->next(__('Próxima', true).' >>', array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?>
</div>

<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Cadastrar Privilegio', true), array('action'=>'add'),array('class'=>'button')); ?></li>
		<li><?php echo $this->Html->link(__('Exibir Tabelas', true), array('controller'=> 'tabelas', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Tabela', true), array('controller'=> 'tabelas', 'action'=>'add'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir Usuarios', true), array('controller'=> 'usuarios', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Usuario', true), array('controller'=> 'usuarios', 'action'=>'add'),array('class'=>'button')); ?> </li>
	</ul>
</div>
