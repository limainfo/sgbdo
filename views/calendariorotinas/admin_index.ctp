<h1>Rotinas</h1>
<h2>Listar Rotinas</h2>
<?=$this->renderElement('admin_menu');?>
<table cellspacing="0">
<tr>
	<th><?=$paginator->sort('Referência','headline');?></th>
	<th><?=$paginator->sort('Data','date');?></th>
	<th><?=$paginator->sort('Ação','location');?></th>
	<th>Detalhes</th>
	<th><?=$paginator->sort('Exibir hora?','allday');?></th>
	<th>Ações</th>
</tr>
<? $i = 1; ?>
<? foreach ($events as $event): ?>
<tr class="<?=($i++ % 2 == 0 ? " odd" : " even");?>">
	<td><?=$event['Event']['headline'];?></td>
	<td><?=date('j M Y, g:i a',strtotime($event['Event']['date']));?></td>
	<td><?=$event['Event']['location'];?></td>
	<td><?=$event['Event']['detail'];?></td>
	<td style="text-align: center;"><?=($event['Event']['allday'] == 1 ? $this->Html->image('exclamation.png') : $this->Html->image('accept.png'));?></td>
	<td>
		<?=$this->Html->link($this->Html->image('edit.png'),'/admin/events/edit/'.$event['Event']['id'],array('escape'=>false, 'escape'=>false), null,false);?>&nbsp;
		<?=$this->Html->link($this->Html->image('delete.png'),'/admin/events/delete/'.$event['Event']['id'],array('onClick'=>'return confirm(\'Tem certeza que deseja excluir '.addslashes($event['Event']['headline']).' id '.$event['Event']['id'].' ?\');', 'escape'=>false), null,false);?>
	</td>
</tr>
<? endforeach;?>
</table>
<br/><hr/><br/>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('Anterior', true), array(), null, array('class'=>'disabled'));?>&nbsp;|&nbsp;<?php echo $paginator->numbers();?> <?php echo $paginator->next(__('Próxima', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
