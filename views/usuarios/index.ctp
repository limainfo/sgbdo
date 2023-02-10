<div class="usuarios index">
<h2><?php __('Usuarios');?>&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'add', null),array('escape'=>false, 'escape'=>false), null,false); ?>
</h2>
<?php
echo $form->create('formFind', array('url' => 'index'));

echo $form->input('find', array('value' => $findUrlNotCleaned, 'label'
=> '', 'type' => 'text', 'id' => 'find', 'class' => 'teste',
'size' => '30', 'maxlength' => '100','class'=>'formulario'));

echo $form->end(array('label'=>'Buscar','class'=>'botoes'));
?><h3>
<?php

echo $paginator->counter(array(
'format' => __('Página %page%/%pages%, exibindo %current% registro(s) de %count% total, registros de %start%, até %end%', true)
));
?></h3>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('militar_id');?></th>
	<th><?php echo $paginator->sort('senha');?></th>
	<th><?php echo $paginator->sort('privilegio_id');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('updated');?></th>
	<th class="actions"><?php __('Ações');?></th>
</tr>
<?php
$i = 0;
foreach ($usuarios as $usuario):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $this->Html->link($usuario['Militar']['nm_completo'], array('controller'=> 'militars', 'action'=>'view', $usuario['Militar']['id'])); ?>
		</td>
		<td>
			<?php echo $usuario['Usuario']['senha']; ?>
		</td>
		<td>
			<?php echo $usuario['Privilegio']['descricao']; ?>
		</td>
		<td>
			<?php echo $usuario['Usuario']['created']; ?>
		</td>
		<td>
			<?php echo $usuario['Usuario']['updated']; ?>
		</td>
		<td class="actions">
			<?php //echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $usuario['Usuario']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php //echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit', $usuario['Usuario']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php //echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array('action'=>'delete', $usuario['Usuario']['id']), array('escape'=>false), sprintf(__('Tem certeza que deseja excluir # %s?', true), $usuario['Usuario']['id']),false); ?>
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
<!-- 
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Cadastrar Usuario', true), array('action'=>'add'),array('class'=>'button')); ?></li>
		<li><?php echo $this->Html->link(__('Exibir Militars', true), array('controller'=> 'militars', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Militar', true), array('controller'=> 'militars', 'action'=>'add'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir Privilegios', true), array('controller'=> 'privilegios', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Privilegio', true), array('controller'=> 'privilegios', 'action'=>'add'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir Setors', true), array('controller'=> 'setors', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Setor', true), array('controller'=> 'setors', 'action'=>'add'),array('class'=>'button')); ?> </li>
	</ul>
</div>
 -->