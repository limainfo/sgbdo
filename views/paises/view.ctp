<center>
<div class="paise view">

<h2><?php  __('País');?>
		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$paise['Paise']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$paise['Paise']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				
</h2>


	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt  class="altrow"><?php __('Nome'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $paise['Paise']['nome']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Sigla'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $paise['Paise']['sigla']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Idioma'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $paise['Paise']['idioma']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('País'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($paise['Paise']['nome'], array('controller' => 'paises', 'action' => 'view', $paise['Paise']['id'])); ?>
			&nbsp;
		</dt>
	</dl>
</div>


</center>
<center>
<div class="estados index">

	<table cellpadding="0" cellspacing="0">
                    <tr><td colspan="5">
	<h1><?php __('Estados');?>    &nbsp;<?php echo $this->Html->link($this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'add','controller'=>'estados', null),array('escape'=>false, 'escape'=>false), null,false); ?>	</h1>
 	<?php echo $form->create('formFind', array('url' => 'index','id'=>'busca'));
		?>	<h3> </h3>             
                </td></tr>
            
	<tr>
			<th>NOME</th>
			<th>UF</th>
			<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($paise['Estado'] as $estado):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $estado['nome']; ?>&nbsp;</td>
		<td><?php echo $estado['uf']; ?>&nbsp;</td>
		<td class="actions">

		<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view','controller'=>'estados', $estado['id']),array('escape'=>false, 'escape'=>false), null,false); ?>

		<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit','controller'=>'estados', $estado['id']),array('escape'=>false, 'escape'=>false), null,false); ?>

		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$estado['id']." ?' ,'estados".'/delete/'.$estado['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false); ?>

				</td>
	</tr>
<?php endforeach; ?>
	</table>

	
	
	
</div>
</center>