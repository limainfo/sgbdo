<div class="afastamentos form">
	<fieldset>
 		<legend><?php __(' Controle de horas');?>&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
 		</legend>
 		
<?php echo $form->create('Controlehora',array( 'inputDefaults' => array('label' => false,'div' => false),  'type'=>'file', 'onsubmit'=>'return false;'));?>
<table cellpadding="0" cellspacing="0"  style="align:center;width:100%;display:overflow;" "   >
<tr><td colspan=4>
</td></tr>
<?php 
for($i=0;$i<=23;$i++){
   $horas[$i]=$i;
}
include $caminhoAditivos;
?>
<tr><th width="25%"><?php echo $datePicker->picker('data',array('readonly'=>'readonly','id'=>'data','class'=>'formulario', 'size'=>10,  'label'=>false, 'value'=>$hoje)); ?></th>
<th width="25%">Controle:<?php echo $form->input('controle',array('class'=>'', 'type'=>'select', 'options'=>$controlehoras,   'label'=>false )); ?></th>
<th width="25%"> Início:<?php echo $form->input('inicio',array('class'=>'', 'id'=>'inicio', 'type'=>'select', 'options'=>$horas,  'label'=>false )); ?>h</th>
<th width="25%">Término:<?php echo $form->input('termino',array('class'=>'', 'id'=>'termino', 'type'=>'select', 'options'=>$horas,  'label'=>false )); ?>h</th>
<th><?php echo $ajax->submit('CADASTRAR', array('url'=> array('controller'=>'controlehoras', 'action'=>'externoadd'), 'class'=>'botoes','onmouseover'=>'valida();', 'update'=>'listagem', 'create' => 'ShowContent("carregando");', 'success' => 'HideContent("carregando");'));?></th>
</tr>
<tr><td colspan=5>
<div id="carregando" >
    <?php echo $this->Html->image('spinner.gif'); ?>
</div> </td></tr>
<tr><td colspan=4><?php  echo $form->end();?>
 </td></tr>
</table> 
        </fieldset>
<div class="Controlehoras index" id="listagem">
</div>
	
</div>
<a id="atencao" href="javascript:;"></a>
<?php
  
?>

<style>
<!--
.tooltiptstyle{
 background-color:#333;
 padding: 1px 3px;
 color: #fff;
 font-size:9px;
position: absolute;
}

-->
</style>

<script type="text/javascript">
<!--
HideContent('carregando');
//-->
</script>
<br><hr>
<script type="text/javascript">
function clickElement(elementid)
    {
    var e = document.getElementById(elementid);
        if (typeof e == 'object')
        {
            if(document.createEventObject)
            {
                e.fireEvent('onclick');
                return false;
            }
            else if(document.createEvent)
            {
                var evObj = document.createEvent('MouseEvents');
                evObj.initEvent('click',true,true);
                e.dispatchEvent(evObj);
                return false;
            }else
                {
                    e.click();
                    return false;
                }
            }
 }
function celulabox(id, militarid){
var valorposicao = $$('input:checked[type="radio"][name="posicao"]').pluck('value');
var valorsetores = $F('setores').each(function(s){ s=s+s;});
var qtdsetores = $F('setores').size();
var valorconsole = $('console').value;

if(qtdsetores>0){
    if(valorposicao==''){
   var x=new Dialog({
                handle:'#atencao',
                title:'Relatório'
        });
        $('dialog-content').innerHTML= 'É necessário informar a <b>POSIÇÃO</b> do operador. <br>Para informar clique no ícone <?php echo $this->Html->image('novodoc.gif', array('alt'=> __('Opcoes', true), 'border'=> '0', 'float'=> 'right', 'title'=>'Visualizar')); ?> que encontra-se na coluna ações.';
    clickElement('atencao');      
    x=null;
        
    }else{
     $('posicao'+id).value=valorposicao;
     $('console'+id).value=valorconsole;
     $('setores'+id).value=valorsetores;
    if(valorposicao=='N'){
         $('caixa'+id).src='<?php echo $this->webroot; ?>img/checkbox00.jpg';
         $('posicao'+id).value=null;
         $('console'+id).value=null;
         $('setores'+id).value=null;
    }
    if(valorposicao=='C'){
        $('caixa'+id).src='<?php echo $this->webroot; ?>img/checkbox01.jpg';
    }
    if(valorposicao=='A'){
        $('caixa'+id).src='<?php echo $this->webroot; ?>img/checkbox02.jpg';
    }
    if(valorposicao=='I'){
        $('caixa'+id).src='<?php echo $this->webroot; ?>img/checkbox03.jpg';
    }
    if(valorposicao=='S'){
        $('caixa'+id).src='<?php echo $this->webroot; ?>img/checkbox04.jpg';
    }
    if(valorposicao=='E'){
        $('caixa'+id).src='<?php echo $this->webroot; ?>img/checkbox05.jpg';
    }
    $('total'+militarid).innerHTML='0';
    var tt = 0;
    var valortotal = $$('input:value[type="hidden"]').each(function(s){if(s.value==militarid){
    var stringid = s.id;
    var idatual=stringid.substring(10)
        if(($('console'+idatual).value!='')&&($('console'+idatual).value!=null)&&(idatual.length>0)){
             tt+=0.25;
             $('total'+militarid).innerHTML = tt;
        }
    }});
   // alert(tt);

    }
 }else{
    
    var x=new Dialog({
                handle:'#atencao',
                title:'Relatório',
                afterClose:function(){
                   //location.reload(true);
                }
        });
        $('dialog-content').innerHTML= 'É necessário informar <b>O(S) SETOR(ES)</b>. <br>Para informar clique no ícone <?php echo $this->Html->image('novodoc.gif', array('alt'=> __('Opcoes', true), 'border'=> '0', 'float'=> 'right', 'title'=>'Visualizar')); ?> que encontra-se na coluna ações.';
    clickElement('atencao');      
    x=null;
                    
 }
    
}

function valida(){

/*
    var op1 = $('inicio').value;
    var op2 = $('termino').value;
    var umahora = 3600000;
    
    var horainicio = $('data').value+' '+op1+':00';
    var horatermino = $('data').value+' '+op2+':00';
    var inicio = new Date(horainicio);
    var agora = new Date();
    var termino = new Date(horatermino);
    alert('inicio:'+horainicio)
    alert('termino:'+horatermino)
    var mes = agora.getMonth() + 1;
    alert('agora:'+agora.getFullYear()+'-'+mes+'-'+agora.getDate()+' '+agora.getHours()+':'+agora.getMinutes())
    inicio = inicio-umahora;
    termino = termino+umahora;
    
    if((agora>=inicio)&&(agora<=termino)){}else{
    
    var x=new Dialog({
                handle:'#atencao',
                title:'Relatório'
        });
        $('dialog-content').innerHTML= 'A hora de início não pode ser inferior a hora atual.<br> A hora de término tem de ser, no mínimo, uma hora a mais que a hora atual.';
        clickElement('atencao');      
        x=null;
    }
    */
}
</script>

