<?php 
            if ($ok) {
                echo '<p class="message" id="mensagens"><b>Os dados foram gravados.</b></p><script language="javascript">ShowContent(\'listagem\');new Effect.Fade(\'mensagens\',{delay: 5});HideContent(\'formularios\');</script>';
            } else {
                echo '<p class="message" id="mensagens"><b>Os dados não foram gravados. Por favor, tente novamente.</b></p><script language="javascript">ShowContent(\'listagem\');new Effect.Fade(\'mensagens\',{delay: 5});</script>';
            }
            
            $conta = $this->data['Controlehora']['termino'] - $this->data['Controlehora']['inicio'] +1;
            $conta = $conta*4 +10;
            
            
?>

<style>
#pop{display:none;position:absolute;top:50%;left:50%;margin-left:-90px;margin-top:-110px;padding:10px;width:180px;height:220px;border:1px solid #d0d0d0;background-color: #ffffff;}
</style>
<style>
#wrapper table tr th{
 background-color:#ccc;
 padding: 1px 3px;
 color: #000;
 font-size:10px;
text-align:center;
border: 1px solid #00000;
border-right-style: inset;
border-right-width: 2px;
border-bottom-style: inset;
border-bottom-width: 2px;
overflow: auto;
}
#wrapper p {
    color: #333333;
    font-size: 8px;
    font-weight: bold;
    margin: 0 0 0 0px;
    text-align:center;
    border: 1px solid #00000;
}
</style>

<table cellpadding="0" cellspacing="0" width="100%>
<tr style="vertical-align:middle;"><th colspan="<?echo $conta; ?>" style="width:100%;vertical-align:middle;border: 1px solid #000;background-color:#000060;color:#fff;"><center>MILITARES DO DIA <?php echo date('d-m-Y', strtotime($this->data['Controlehora']['data'])); ?> DAS <?php echo $this->data['Controlehora']['inicio']; ?>  HORAS A <?php echo $this->data['Controlehora']['termino']; ?> HORAS&nbsp;&nbsp;&nbsp;&nbsp;
<?php 
    //echo $ajax->link($this->Html->image('novo.gif', array('alt'=> __('Exibir', true), 'border'=> '0','float'=> 'right', 'width'=> '10 px', 'height'=> '10 px', 'title'=>'Visualizar')), array('action'=>'index', $testeopprova['Testeopprova']['id']),array('escape'=>false, 'update'=>'View'), null,false);
   // echo $ajax->link($this->Html->image('novo.gif', array('alt'=> __('Exibir', true), 'border'=> '0','float'=> 'right', 'title'=>'Visualizar')), array('action'=>'externoadd', null),array('escape'=>false, 'update'=>'formularios'), null,false);
    ?>
</center>
</th></tr>
<tr>
    <td width="100%" colspan="<?php echo $conta; ?>">
    <?php echo $form->create('Controlehora',array( 'inputDefaults' => array('label' => false,'div' => false),  'type'=>'file', 'onsubmit'=>'return false;'));?>
        <table  width="100%"><tr>
    <td width="25%" >
    
    <?php echo $form->input('nome_saram',array('class'=>'', 'type'=>'text', 'size'=>'15',   'label'=>false)); ?>
<?php echo $ajax->submit('Consultar NOME/SARAM', array('url'=> array('controller'=>'militars', 'action'=>'externoconsulta'), 'class'=>'botoes', 'update'=>'ControlehoraMilitarId', 'create' => 'ShowContent("carregando");', 'success' => 'HideContent("carregando");')); ?>    
   </td>
    <td width="25%" >
<?php echo $form->input('militar_id',array('class'=>'', 'type'=>'select',   'label'=>false, 'onchange'=>'clickElement("intermediario");' )); 
    echo $ajax->link($this->Html->image('vazio.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'float'=> 'right', 'title'=>'Visualizar')), array('controller'=>'militars_escalas','action'=>'externoconsulta', null),array('id'=>'intermediario','escape'=>false, 'update'=>'ControlehoraSetorId', 'create' => 'ShowContent("carregando");', 'success' => 'HideContent("carregando");', 'with' => "$('ControlehoraAddForm').serialize()"), null,false);
      ?>    
    </td>
    <td width="25%" >
<?php echo $form->input('setor_id',array('class'=>'', 'type'=>'select',   'label'=>false)); ?> 
    </td>
    <td width="25%" ></td></tr></table>
    <?php  echo $form->end();?>
    </td>
    </tr>
<tr ><th >Militar</th><th>Escala</th>
<?php 
for($i=$this->data['Controlehora']['inicio'];$i<=$this->data['Controlehora']['termino'];$i++){
?>
<th colspan="4"><?php echo $i; ?></th>
<?php } ?>
<th>Horas</th><th>Ações</th></tr>
<tr><th colspan="2"></th>
<?php 
for($i=$this->data['Controlehora']['inicio'];$i<=$this->data['Controlehora']['termino'];$i++){
?>
<th>0</th><th>15</th><th>30</th><th>45</th>
<?php } ?>
<th colspan="2"></th></tr>
 <tr>
<tr><th colspan="2">3S FULANO DE TAL - ACC BS</th>
<?php 
$id = 0;
$militar_id = 1;
for($i=$this->data['Controlehora']['inicio'];$i<=$this->data['Controlehora']['termino'];$i++){
?>
<td>
    <?php $id=$i.'00'; ?>
 <?php echo $form->create('Controlehora',array( 'inputDefaults' => array('label' => false,'div' => false),  'type'=>'file', 'onsubmit'=>'return false;'));?>   
    <?php echo $this->Html->image('checkbox00.jpg', array('alt'=> __('Exibir', true),'id'=>'caixa'.$id, 'border'=> '0','onclick'=>"celulabox($id, $militar_id);",  'title'=>'Visualizar')); ?>
    <?php echo $form->input('posicao',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'posicao'.$id)); ?>
    <?php echo $form->input('console',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'console'.$id)); ?>
    <?php echo $form->input('setores',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'setores'.$id)); ?>
    <?php echo $form->input('militar_id',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'militar_id'.$id, 'value'=>$militar_id)); ?>
    <?php echo $form->input('controlehora_id',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'controlehora_id'.$id)); ?>
    <?php echo $form->input('controlehoraextensao',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'controleextensao'.$id)); ?>
<?php echo $form->end();?>    
</td><td>
    <?php $id=$i.'15';  ?>
 <?php echo $form->create('Controlehora',array( 'inputDefaults' => array('label' => false,'div' => false),  'type'=>'file', 'onsubmit'=>'return false;'));?>   
    <?php echo $this->Html->image('checkbox00.jpg', array('alt'=> __('Exibir', true),'id'=>'caixa'.$id, 'border'=> '0','onclick'=>"celulabox($id, $militar_id);",  'title'=>'Visualizar')); ?>
    <?php echo $form->input('posicao',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'posicao'.$id)); ?>
    <?php echo $form->input('console',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'console'.$id)); ?>
    <?php echo $form->input('setores',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'setores'.$id)); ?>
    <?php echo $form->input('militar_id',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'militar_id'.$id, 'value'=>$militar_id)); ?>
    <?php echo $form->input('controlehora_id',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'controlehora_id'.$id)); ?>
    <?php echo $form->input('controlehoraextensao',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false)); ?>
<?php echo $form->end();?>    
</td><td>
     <?php $id=$i.'30';  ?>
<?php echo $form->create('Controlehora',array( 'inputDefaults' => array('label' => false,'div' => false),  'type'=>'file', 'onsubmit'=>'return false;'));?>   
    <?php echo $this->Html->image('checkbox00.jpg', array('alt'=> __('Exibir', true),'id'=>'caixa'.$id, 'border'=> '0','onclick'=>"celulabox($id, $militar_id);",  'title'=>'Visualizar')); ?>
    <?php echo $form->input('posicao',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'posicao'.$id)); ?>
    <?php echo $form->input('console',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'console'.$id)); ?>
    <?php echo $form->input('setores',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'setores'.$id)); ?>
    <?php echo $form->input('militar_id',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'militar_id'.$id, 'value'=>$militar_id)); ?>
    <?php echo $form->input('controlehora_id',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'controlehora_id'.$id)); ?>
    <?php echo $form->input('controlehoraextensao',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false)); ?>
<?php echo $form->end();?>    
</td><td>
     <?php $id=$i.'45';  ?>
<?php echo $form->create('Controlehora',array( 'inputDefaults' => array('label' => false,'div' => false),  'type'=>'file', 'onsubmit'=>'return false;'));?>   
    <?php //echo $form->input('hora'.$i.'min45',array('class'=>'formularios', 'type'=>'checkbox', 'label'=>false)); ?>
    <?php echo $this->Html->image('checkbox00.jpg', array('alt'=> __('Exibir', true),'id'=>'caixa'.$id, 'border'=> '0','onclick'=>"celulabox($id, $militar_id);",  'title'=>'Visualizar')); ?>
    <?php echo $form->input('posicao',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'posicao'.$id)); ?>
    <?php echo $form->input('console',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'console'.$id)); ?>
    <?php echo $form->input('setores',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'setores'.$id)); ?>
    <?php echo $form->input('militar_id',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'militar_id'.$id, 'value'=>$militar_id)); ?>
    <?php echo $form->input('controlehora_id',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'controlehora_id'.$id)); ?>
    <?php echo $form->input('controlehoraextensao',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false)); ?>
<?php echo $form->end();?>    
</td>
<?php } ?>
<td><p id='total<?php echo $militar_id; ?>' ></p></td>
<td>
    <?php 
echo $this->Html->link($this->Html->image('novodoc.gif', array('alt'=> __('Opcoes', true), 'border'=> '0', 'float'=> 'left', 'title'=>'Visualizar')), array('url'=>null, null),array('id'=>'intermediario','escape'=>false, 'onclick' => 'ShowContent(\'pop\');new Draggable(\'pop\');return false;'), null,false);    
echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Opcoes', true), 'border'=> '0', 'float'=> 'right', 'title'=>'Visualizar')), array('url'=>null, null),array('id'=>'excluir','escape'=>false, 'onclick' => 'return false;'), null,false);    
    
    ?>
<!--    <a href="#" onclick="ShowContent('pop');new Draggable('pop');">Mostra</a> -->
</td>
</tr>
<tr><th colspan="2">1S SICRANO DE TAL</th>
<?php 
$id = 0;
$militar_id = 2;
for($i=$this->data['Controlehora']['inicio'];$i<=$this->data['Controlehora']['termino'];$i++){
?>
<td>
    <?php $id=$i.'000'; ?>
 <?php echo $form->create('Controlehora',array( 'inputDefaults' => array('label' => false,'div' => false),  'type'=>'file', 'onsubmit'=>'return false;'));?>   
    <?php echo $this->Html->image('checkbox00.jpg', array('alt'=> __('Exibir', true),'id'=>'caixa'.$id, 'border'=> '0','onclick'=>"celulabox($id, $militar_id);",  'title'=>'Visualizar')); ?>
    <?php echo $form->input('posicao',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'posicao'.$id)); ?>
    <?php echo $form->input('console',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'console'.$id)); ?>
    <?php echo $form->input('setores',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'setores'.$id)); ?>
    <?php echo $form->input('militar_id',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'militar_id'.$id, 'value'=>$militar_id)); ?>
    <?php echo $form->input('controlehora_id',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'controlehora_id'.$id)); ?>
    <?php echo $form->input('controlehoraextensao',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'controleextensao'.$id)); ?>
<?php echo $form->end();?>    
</td><td>
    <?php $id=$i.'150';  ?>
 <?php echo $form->create('Controlehora',array( 'inputDefaults' => array('label' => false,'div' => false),  'type'=>'file', 'onsubmit'=>'return false;'));?>   
    <?php echo $this->Html->image('checkbox00.jpg', array('alt'=> __('Exibir', true),'id'=>'caixa'.$id, 'border'=> '0','onclick'=>"celulabox($id, $militar_id);",  'title'=>'Visualizar')); ?>
    <?php echo $form->input('posicao',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'posicao'.$id)); ?>
    <?php echo $form->input('console',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'console'.$id)); ?>
    <?php echo $form->input('setores',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'setores'.$id)); ?>
    <?php echo $form->input('militar_id',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'militar_id'.$id, 'value'=>$militar_id)); ?>
    <?php echo $form->input('controlehora_id',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'controlehora_id'.$id)); ?>
    <?php echo $form->input('controlehoraextensao',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false)); ?>
<?php echo $form->end();?>    
</td><td>
     <?php $id=$i.'300';  ?>
<?php echo $form->create('Controlehora',array( 'inputDefaults' => array('label' => false,'div' => false),  'type'=>'file', 'onsubmit'=>'return false;'));?>   
    <?php echo $this->Html->image('checkbox00.jpg', array('alt'=> __('Exibir', true),'id'=>'caixa'.$id, 'border'=> '0','onclick'=>"celulabox($id, $militar_id);",  'title'=>'Visualizar')); ?>
    <?php echo $form->input('posicao',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'posicao'.$id)); ?>
    <?php echo $form->input('console',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'console'.$id)); ?>
    <?php echo $form->input('setores',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'setores'.$id)); ?>
    <?php echo $form->input('militar_id',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'militar_id'.$id, 'value'=>$militar_id)); ?>
    <?php echo $form->input('controlehora_id',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'controlehora_id'.$id)); ?>
    <?php echo $form->input('controlehoraextensao',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false)); ?>
<?php echo $form->end();?>    
</td><td>
     <?php $id=$i.'450';  ?>
<?php echo $form->create('Controlehora',array( 'inputDefaults' => array('label' => false,'div' => false),  'type'=>'file', 'onsubmit'=>'return false;'));?>   
    <?php //echo $form->input('hora'.$i.'min45',array('class'=>'formularios', 'type'=>'checkbox', 'label'=>false)); ?>
    <?php echo $this->Html->image('checkbox00.jpg', array('alt'=> __('Exibir', true),'id'=>'caixa'.$id, 'border'=> '0','onclick'=>"celulabox($id, $militar_id);",  'title'=>'Visualizar')); ?>
    <?php echo $form->input('posicao',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'posicao'.$id)); ?>
    <?php echo $form->input('console',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'console'.$id)); ?>
    <?php echo $form->input('setores',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'setores'.$id)); ?>
    <?php echo $form->input('militar_id',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'militar_id'.$id, 'value'=>$militar_id)); ?>
    <?php echo $form->input('controlehora_id',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false, 'id'=>'controlehora_id'.$id)); ?>
    <?php echo $form->input('controlehoraextensao',array('class'=>'formularios', 'type'=>'hidden', 'label'=>false)); ?>
<?php echo $form->end();?>    
</td>
<?php } ?>
<td><p id='total<?php echo $militar_id; ?>' ></p></td>
<td>
    <?php 
echo $this->Html->link($this->Html->image('novodoc.gif', array('alt'=> __('Opcoes', true), 'border'=> '0', 'float'=> 'left', 'title'=>'Visualizar')), array('url'=>null, null),array('id'=>'intermediario','escape'=>false, 'onclick' => 'ShowContent(\'pop\');new Draggable(\'pop\');return false;'), null,false);    
echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Opcoes', true), 'border'=> '0', 'float'=> 'right', 'title'=>'Visualizar')), array('url'=>null, null),array('id'=>'excluir','escape'=>false, 'onclick' => 'return false;'), null,false);    
    
    ?>
<!--    <a href="#" onclick="ShowContent('pop');new Draggable('pop');">Mostra</a> -->
</td>
</tr>



    <?php 
$i=0;
     //   $dados = $this->requestAction('testeopprovasagendadas/externolista');
        foreach($dados as $dado){
                $class = null;
                if ($i++ % 2 == 0) {
                    $class = ' class="altrow"';
                }
                echo "<tr {$class}><td>{$dado['Testeopprovasagendada']['ano']}</td>";
                echo "<td>{$dado['Testeopprovasagendada']['divisao']}</td>";
                echo "<td>{$dado['Testeopprovasagendada']['subdivisao']}</td>";
                echo "<td>{$dado['Testeopprova']['nm_prova']}</td>";
                echo "<td>{$dado['Especialidade']['nm_especialidade']}</td>";
                echo "<td>{$dado['Testeopprovasagendada']['data_chamada01']}</td>";
                echo "<td>{$dado['Testeopprovasagendada']['data_chamada02']}</td>";
                echo "<td>{$dado['Testeopprovasagendada']['data_chamada03']}</td>";
                echo "<td>{$dado['Testeopprovasagendada']['data_chamada04']}</td>";
                echo "<td>";
                //echo $ajax->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'index', $testeopprova['Testeopprova']['id']),array('escape'=>false, 'update'=>'View'), null,false);
                echo $ajax->link($this->Html->image('lapis.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'externoedit', $dado['Testeopprovasagendada']['id']),array('escape'=>false, 'update'=>'formularios','method'=>'post', 'with'=>'\'data[id]='.$dado['Testeopprovaagendada']['id'].'&value=help\'' ), null,false);
                echo '&nbsp;&nbsp;&nbsp;';
                echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$dado['Testeopprovasagendada']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$dado['Testeopprovasagendada']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false); 
                echo "<td></td></tr>";
            
        }
                
?>
<tr><th colspan="<?echo $conta; ?>" ></th></tr>
</table>

<div id="pop">
    <div style="border: 1px solid #ffffff;width: 180px;background-color: #4169E1;font-weight: bold;color:#ffffff; font-size: 8pt;padding: 2 2 2 2px; ">
<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Fechar', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>false), array('default'=>false, 'onclick'=>"HideContent('pop');",'escape'=>false),false); ?></br></div>
<?php echo $form->create('Controlehora',array( 'inputDefaults' => array('label' => false,'div' => false),  'type'=>'file', 'onsubmit'=>'return false;'));?>
<table cellpadding="0" cellspacing="0"  style="align:center;width:180px;display:overflow;"   >
<tr>
 <th rowspan="2" width="25%">Setor:<?php echo $form->input('setores',array('class'=>'', 'id'=>'setores','name'=>'setores', 'type'=>'select', 'size'=>10, 'options'=>array('S01'=>'S01','S02'=>'S02','S03'=>'S03','S04'=>'S04','S05'=>'S05','S06'=>'S06','S07'=>'S07','S08'=>'S08','S09'=>'S09','S10'=>'S10','S11'=>'S11','S12'=>'S12',), 'multiple'=>true,  'label'=>false )); ?></th>
<th width="25%">
<b>Posição</b><br>
<style>
#tabela1{
   border: 1px solid #000000;
   width: 100px;
   background-color: #6495ED;
   font-weight: bold;
   font-size: 8pt;
   padding: 2 2 2 2px; 
}
#tabela2{
   border: 1px solid #000000;
   width: 100px;
   background-color: #00CED1;
   font-weight: bold;
   font-size: 8pt;
   padding: 2 2 2 2px; 
}
#tabela3{
   border: 1px solid #000000;
   width: 100px;
   background-color: #2F4F4F;
   font-weight: bold;
   font-size: 8pt;
   padding: 2 2 2 2px; 
}
#tabela4{
   border: 1px solid #000000;
   width: 100px;
   background-color: #FF9900;
   font-weight: bold;
   font-size: 8pt;
   padding: 2 2 2 2px; 
}
#tabela5{
   border: 1px solid #000000;
   width: 100px;
   background-color: #98FB98;
   font-weight: bold;
   font-size: 8pt;
   padding: 2 2 2 2px; 
}
#tabela6{
   border: 1px solid #000000;
   width: 100px;
   background-color: #ffffff;
   font-weight: bold;
   font-size: 8pt;
   padding: 2 2 2 2px; 
}

</style>
<div id='tabela1'><input type="radio" value="C" name="posicao">Controle<br></div>
<div id='tabela2'><input type="radio" value="A" name="posicao">Assistente<br></div>
<div id='tabela3'><input type="radio" value="I" name="posicao">Instrutor<br></div>
<div id='tabela4'><input type="radio" value="S" name="posicao">Supervisor<br></div>
<div id='tabela5'><input type="radio" value="E" name="posicao">Estagiario<br></div>
<div id='tabela6'><input type="radio" value="N" name="posicao">Nenhuma<br></div>
    
</th>
</tr>
<tr>
<th width="25%">
    Console:<?php echo $form->input('console',array('class'=>'', 'id'=>'console', 'type'=>'select', 'options'=>array(1=>'1',2=>'2',3=>'3',4=>'4',5=>'5',6=>'6',7=>'7',8=>'8',9=>'9',10=>'10',11=>'11',12=>'12',),  'label'=>false )); ?>
</th>
<td width="25%"></td>
</tr>
</table>       
<?php
echo $form->end();
?>
</div>
