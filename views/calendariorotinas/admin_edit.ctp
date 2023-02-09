<h1>Rotinas</h1>
<h2>Editar Rotina</h2>

<?=$this->renderElement('admin_menu');?>

<div class="form">
<?php echo $form->create('Event',array('name'=>'eventEditForm'));?>
<div class="optional"><?=$form->input('headline',array('label'=>'Referência '));?></div>
<div class="optional"><?=$form->input('date',array('label'=>'Data e hora '));?></div>
<div class="optional"><?=$form->input('location',array('label'=>'Responsável '));?></div>
<div class="optional"><?=$form->input('detail',array('type'=>'textarea','rows'=>'5','cols'=>'40','label'=>'Ação '));?></div>
<div class="optional"><?=$form->input('allday',array('label'=>' Exibir hora?'));?></div>
<div class="optional"><?=$form->input('Tag',array('label'=>'Setores','type'=>'select','multiple'=>'checkbox','options'=>$tags));?></div>
<?=$calendar->button('Salvar Rotina',array('form'=>'eventEditForm'));?>
</form>
</div>
