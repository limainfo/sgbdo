<div id="menu">
	<ul>
		<li><?=$this->Html->link('Listar','/admin/'.$this->params['controller'].'/index');?></li>
		<li><?=$this->Html->link('Novo','/admin/'.$this->params['controller'].'/add');?></li>
		<?=($this->action == 'admin_edit' ? '<li>'.$this->Html->link('Apagar','/admin/'.$this->params['controller'].'/delete/'.$this->data[$this->params['models'][0]]['id'], array('onClick'=>'return confirm(\'Tem certeza que deseja excluir?\');')).'</li>' : '');?>
	</ul>
</div>