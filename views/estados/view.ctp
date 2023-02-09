<center>
<div class="estados view">
<h2><?php  __('Estado');?>
		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$estado['Estado']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$estado['Estado']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				
</h2>


	<dl><?php $i = 0; $class = ' class="altrow"';?>

		<dt  class="altrow"><?php __('Nome'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $estado['Estado']['nome']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Uf'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $estado['Estado']['uf']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('País'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($estado['Paise']['nome'], array('controller' => 'paises', 'action' => 'view', $estado['Paise']['id'])); ?>
			&nbsp;
		</dt>
	</dl>
</div>

</center>
<center>
<div class="cidades index">
	<table cellpadding="0" cellspacing="0">
                    <tr><td colspan="4">
	<h1><?php __('Cidades');?>    &nbsp;<?php echo $this->Html->link($this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'add','controller'=>'cidades', null),array('escape'=>false, 'escape'=>false), null,false); ?>	</h1>
 	<?php echo $form->create('formFind', array('url' => 'index','id'=>'busca'));
		?>	             
                </td></tr>
                       
	<tr>
			<th><?php __('nome');?></th>
			<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($estado['Cidade'] as $cidade):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $cidade['nome']; ?>&nbsp;</td>
		<td class="actions">

		<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view','controller'=>'cidades', $cidade['id']),array('escape'=>false, 'escape'=>false), null,false); ?>

		<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit','controller'=>'cidades', $cidade['id']),array('escape'=>false, 'escape'=>false), null,false); ?>

		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$cidade['id']." ?' ,'cidades".'/delete/'.$cidade['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false); ?>

				</td>
	</tr>
<?php endforeach; ?>
	</table>


	
</div>
</center>