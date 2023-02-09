<br>
<?php
include('../views/funcoes_henrique.ctp');

echo $form->create('Escala', array('controller'=> 'Escala', 'action'=>'view'));
$anos = array();
$ano = date('Y')+1;
$anoa = 2009;
for ($inicio=$anoa; $inicio<=$ano;$inicio++){
	$anos[$inicio]=$inicio;
}

echo $form->hidden('menu');
echo 'Mês de referência:'.$form->select('mes', $mes ,$this->data['Escala']['mes'] ,array('onChange'=>" $('EscalaViewForm').submit();",'class'=>'formulario'), false);
echo $form->select('ano', $anos ,$this->data['Escala']['ano'] ,array('onChange'=>" $('EscalaViewForm').submit();",'class'=>'formulario'), false);

$previsao = array('PREVISTA'=>'PREVISTA','CUMPRIDA'=>'CUMPRIDA');
$tipoescala = array('OPERACIONAL'=>'OPERACIONAL','RISAER'=>'RISAER','TECNICA'=>'TECNICA');
$assinatura = array('TODOS'=>'TODOS','SIM'=>'ASSINOU','NAO'=>'NÃO ASSINOU');

if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)){
	$conteudo='Tipo:'.$form->select('previsao', $previsao ,'PREVISTA' ,array('class'=>'formulario'))."";
	$conteudo.=''.$form->select('tipoescala', $tipoescala ,'OPERACIONAL' ,array('class'=>'formulario'))."";
	$conteudo.='&nbsp;&nbsp;Escalante:'.$form->select('escalante', $assinatura ,'NAO' ,array('class'=>'formulario'))."";
	$conteudo.='&nbsp;&nbsp;Chefe:'.$form->select('chefe', $assinatura ,'NAO' ,array('class'=>'formulario'))."";
	$link = $this->webroot.'escalas/relatorioPdf/\'+$(\'EscalaMes\').options[$(\'EscalaMes\').options.selectedIndex].value+\'/\'+$(\'EscalaAno\').options[$(\'EscalaAno\').options.selectedIndex].value+\'/\'+$(\'EscalaPrevisao\').options[$(\'EscalaPrevisao\').options.selectedIndex].value+\'/\'+$(\'EscalaEscalante\').options[$(\'EscalaEscalante\').options.selectedIndex].value+\'/\'+$(\'EscalaChefe\').options[$(\'EscalaChefe\').options.selectedIndex].value +\'/\'+$(\'EscalaTipoescala\').options[$(\'EscalaTipoescala\').options.selectedIndex].value';
	$imagem = $this->Html->image('relatorio.gif', array('alt'=> __('PDF', true), 'border'=> '0', 'title'=>'Gerar Relatório em PDF com os critérios.', 'id'=>'pdf'));

	$conteudo.='&nbsp;&nbsp;<a 	onclick="window.open(\''.$link.",'_blank','');\">".$imagem."</a></label>";
	echo $this->Html->div(null,$conteudo,array('style'=>'align:center;'),false);
}
echo $form->end();
$id_usuario = $u[0]['Usuario']['militar_id'];
echo $form->create('Escala', array('controller'=> 'Escala', 'action'=>'assinar/0/'.$id_usuario.'/0/0/0/cmte/0/0/'.$this->data['Escala']['mes'].'/'.$this->data['Escala']['ano'],'id'=>'EscalaAssinarForm'));

?>
<script type="text/javascript">
<!--
function validaData (data) {
    var formatoValido = /^\d{2}\/\d{2}\/\d{4}$/; 
    var valido = false;
    if(!formatoValido.test(data))
      alert("A data está no formato errado. Por favor corrija.");
    else{
      var dia = data.split("/")[0];
      var mes = data.split("/")[1];
      var ano = data.split("/")[2];
      var MyData = new Date(ano, mes - 1, dia);
      if((MyData.getMonth() + 1 != mes)||
         (MyData.getDate() != dia)||
         (MyData.getFullYear() != ano))
       alert("Valores inválidos para o dia, mês ou ano. Por favor corrija.");
      else
        valido = true;
    }

    return valido;
}
//-->
</script>
<div class="input select required"></div>

<?php 
$cabecalhoTitulo = 0;
$contaOperacional = 0;
$contaRisaer = 0;
$contaTecnica = 0;

$totalOp=0;
$totalRi=0;
$totalTc=0;
foreach ($escalas as $escala){
    if($escala['Escala']['tipo']=='OPERACIONAL'){
            $totalOp++;
    }
    if($escala['Escala']['tipo']=='RISAER'){
            $totalRi++;
    }
    if($escala['Escala']['tipo']=='TECNICA'){
            $totalTc++;
    }
}

$i = 0;

//$class = ' style="font-size: 0.8em;padding: 1px 1px 1px 1px;width: 10 px;"';


foreach ($escalas as $escala):
                            $class = null;
                            if ($i++ % 2 == 0) {
                                $class = ' class="altrow"';
                            }

if(($escala['Escala']['tipo']=='OPERACIONAL')){
	$cabecalhoTitulo=1;
	$contaOperacional++;
} 
if(($escala['Escala']['tipo']=='RISAER')){
	$cabecalhoTitulo=2;
	$contaRisaer++;
} 
if(($escala['Escala']['tipo']=='TECNICA')){
	$cabecalhoTitulo=3;
	$contaTecnica++;
} 


$data2 = strtotime("now");

if($escala[0]['mes']==1){
        $ano = $escala[0]['ano']-1;
        $data1 = mktime(23,59,59,12,$escala['Escala']['dt_limite_previsao'],($ano));
}else{
        $mes = $escala[0]['mes']-1;
        $data1 = mktime(23,59,59,($mes),$escala['Escala']['dt_limite_previsao'],$escala[0]['ano']);
}
if($escala[0]['mes']<=11){
        $mes = $escala[0]['mes']+1;
        $data3 = mktime(23,59,59,($mes),$escala['Escala']['dt_limite_cumprida'],$escala[0]['ano']);
        //$data3 = strtotime($escala[0]['ano'].'/'.($escala[0]['mes']+1).'/'.$escala['Escala']['dt_limite_cumprida']);
}else{
        $ano = $escala[0]['ano']+1;
        $data3 = mktime(23,59,59,1,$escala['Escala']['dt_limite_cumprida'],($ano));
}
$dif1 = $data1-$data2;
$dif2 = $data3-$data2;
$pdf = 0;
$dataprevista = $escala['EscalasMonth']['destrava_prevista'];
$datacumprida = $escala['EscalasMonth']['destrava_cumprida'];

$escala['EscalasMonth']['destrava_prevista'] = strtotime($escala['EscalasMonth']['destrava_prevista']) - $data2;
if($escala['EscalasMonth']['destrava_prevista']>0){
        $escala['EscalasMonth']['destrava_prevista'] = 1;
        $dicap = 'Escala prevista desbloqueada até '.$dataprevista;
}else{
        $escala['EscalasMonth']['destrava_prevista'] = 0;
}
$escala['EscalasMonth']['destrava_cumprida'] = strtotime($escala['EscalasMonth']['destrava_cumprida']) - $data2;
if($escala['EscalasMonth']['destrava_cumprida']>0){
        $escala['EscalasMonth']['destrava_cumprida'] = 1;
        $dicac = 'Escala cumprida desbloqueada até '.$datacumprida;
}else{
        $escala['EscalasMonth']['destrava_cumprida'] = 0;
}
//echo $data1.'  '.$data2.'  '.$data3.'  '.$dif1.'  '.$dif2.'<br>';


if(($cabecalhoTitulo==1)&&($contaOperacional==1)){
	Menu_Barra('grupo01','idoperacional',"ESCALAS OPERACIONAIS ({$totalOp} registros)",0);
?>
		<table cellpadding="0" cellspacing="0" id="idoperacional" style="align:center;" >
		<tr><td colspan="20">
		
		</td></tr>
				<tr>
				<th><span><?php __('Escalante'); ?>&nbsp;</span></th>
				<th><span><?php __('Chefe'); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span></th>
				<th><span><?php __('Cidade '); ?>&nbsp;</span></th>
				<th><span><?php __('Unidade '); ?>&nbsp;</span></th>
				<th><span><?php __('Setor'); ?>&nbsp;</span></th>
				  <th><span><?php __('Chf Orgao'); ?>&nbsp;</span></th>  				
				<th><span><?php __('Efetivo'); ?>&nbsp;</span></th>
				<th><span><?php __('Mes'); ?>&nbsp;</span></th>
				<th class="actions" colspan="4"><?php __('Ações');?></th>
                <?php
                		
       				if(($u[0]['Usuario']['privilegio_id']==1)){
                ?>
				<th><span><?php echo $this->Html->image('ver.png', array('alt'=> __('Visualiza', true), 'title'=>'Ativar ou destativar visualização para os demais perfis.', 'id'=>'todos03')); ?></span></th><th>&nbsp;</th>
                <?php
                		}
                		?>
                <?php
       				if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)||($u[0]['Usuario']['privilegio_id']==3)){
                ?>
				<th><span><?php echo $this->Html->image('printp.gif', array('alt'=> __('ImpPrevista', true), 'border'=> '0','onClick'=>" autorizaImp('p');", 'title'=>'Disponibilizar para o Chefe de Divisão a Prevista', 'id'=>'impp'.$escala['EscalasMonth']['id'])); ?></span></th>
				<th><span><?php echo $this->Html->image('printc.gif', array('alt'=> __('ImpCumprida', true), 'border'=> '0','onClick'=>" autorizaImp('c');", 'title'=>'Disponibilizar para o Chefe de Divisão a Cumprida', 'id'=>'impc'.$escala['EscalasMonth']['id'])); ?></span></th>
				<th><span><?php echo $this->Html->image('diskp.png', array('alt'=> __('CmtePrevista', true), 'border'=> '0','onClick'=>" assinaCmt('p');", 'title'=>'Assinatura do Chefe da Divisão Prevista', 'id'=>'cmtep'.$escala['EscalasMonth']['id'])); ?></span></th>
				<th><span><?php echo $this->Html->image('diskc.png', array('alt'=> __('CmteCumprida', true), 'border'=> '0','onClick'=>" assinaCmt('c');", 'title'=>'Assinatura do Chefe da Divisão Cumprida', 'id'=>'cmtec'.$escala['EscalasMonth']['id'])); ?></span></th>
                <?php
                    }
       				if(($u[0]['Usuario']['privilegio_id']==12)){
                ?>
				<th><span><?php echo $this->Html->image('printp.gif', array('alt'=> __('ImpPrevista', true), 'border'=> '0','onClick'=>" autorizaImp('p');", 'title'=>'Disponibilizar para o Chefe de Divisão a Prevista', 'id'=>'impp'.$escala['EscalasMonth']['id'])); ?></span></th>
				<th><span><?php echo $this->Html->image('printc.gif', array('alt'=> __('ImpCumprida', true), 'border'=> '0','onClick'=>" autorizaImp('c');", 'title'=>'Disponibilizar para o Chefe de Divisão a Cumprida', 'id'=>'impc'.$escala['EscalasMonth']['id'])); ?></span></th>
				<th><span><?php echo $this->Html->image('diskp.png', array('alt'=> __('CmtePrevista', true), 'border'=> '0', 'title'=>'Escala Prevista assinada pelo Comandante', 'id'=>'cmtep'.$escala['EscalasMonth']['id'])); ?></span></th>
				<th><span><?php echo $this->Html->image('diskc.png', array('alt'=> __('CmteCumprida', true), 'border'=> '0', 'title'=>'Escala Cumprida assinada pelo Comandante', 'id'=>'cmtec'.$escala['EscalasMonth']['id'])); ?></span></th>
                <?php 
                     }


                 ?>
				<th colspan="2"><span></span></th>
			</tr>		

<?php 	
}

if(($cabecalhoTitulo==1)&&($contaOperacional<=$totalOp)){

?>
                <?php
                		
       			if(($u[0]['Usuario']['privilegio_id']==1) || ($escala['EscalasMonth']['ver']==0) || ($u[0]['Usuario']['privilegio_id']==12)){
                ?>


                        <tr <?php echo $class; ?>>
                        <td <?php echo $class; ?>>
                        <?php
                                   
                                    

                                      if (!empty($escala['EscalasMonth']['ok_escalantep'])) {
                                          $pdf = 1;
                                          echo '<img border="0" title="Assinado" alt="Exibir"  src="' . $this->webroot . 'img/verdep.gif" />';
                                      } else {
                                          if ($dif1 >= 0) {
                                              if (!empty($escala['EscalasMonth']['destrava_prevista'])) {
                                                  echo '<img border="0" title="'.$dicap.'" alt="Exibir" src="' . $this->webroot . 'img/cadeadoaberto.gif" />';
                                              } else {
                                                  echo '<img border="0" title="Dentro do prazo" alt="Exibir"  src="' . $this->webroot . 'img/laranjap.gif" />';
                                              }
                                          } else {
                                              if (!empty($escala['EscalasMonth']['destrava_prevista'])) {
                                                  echo '<img border="0" title="'.$dicap.'" alt="Exibir" src="' . $this->webroot . 'img/cadeadoaberto.gif" />';
                                              } else {
                                                  echo '<img border="0" title="Perdeu o prazo" alt="Exibir" src="' . $this->webroot . 'img/vermelhop.gif" />';
                                              }
                                          }
                                      }
                                      if (!empty($escala['EscalasMonth']['ok_escalantec'])) {
                                          $pdf = 2;
                                          echo '<img border="0" title="Assinado" alt="Exibir" src="' . $this->webroot . 'img/verdec.gif" />';
                                      } else {
                                          if ($dif2 >= 0) {
                                              if (!empty($escala['EscalasMonth']['destrava_cumprida'])) {
                                                  echo '<img border="0" title="'.$dicac.'" alt="Exibir" src="' . $this->webroot . 'img/cadeadoaberto.gif" />';
                                              } else {
                                                  echo '<img border="0" title="Dentro do prazo" alt="Exibir"  src="' . $this->webroot . 'img/laranjac.gif" />';
                                              }
                                          } else {
                                              if (!empty($escala['EscalasMonth']['destrava_cumprida'])) {
                                                  echo '<img border="0" title="'.$dicac.'" alt="Exibir" src="' . $this->webroot . 'img/cadeadoaberto.gif" />';
                                              } else {
                                                  echo '<img border="0" title="Fora do prazo" alt="Exibir" src="' . $this->webroot . 'img/vermelhoc.gif" />';
                                              }
                                          }
                                      }                                    
                                    ?>&nbsp;
                          </td>                                   
                          <td <?php echo $class; ?>>
                          <?php 
                                      if (!empty($escala['EscalasMonth']['ok_chefep'])) {
                                          $pdf = 1;
                                          echo '<img border="0" title="Assinado" alt="Exibir"  src="' . $this->webroot . 'img/verdep.gif" />';
                                      } else {
                                          if ($dif1 >= 0) {
                                              if (!empty($escala['EscalasMonth']['destrava_prevista'])) {
                                                  echo '<img border="0" title="'.$dicap.'" alt="Exibir" src="' . $this->webroot . 'img/cadeadoaberto.gif" />';
                                              } else {
                                                  echo '<img border="0" title="Dentro do prazo" alt="Exibir"  src="' . $this->webroot . 'img/laranjap.gif" />';
                                              }
                                          } else {
                                              if (!empty($escala['EscalasMonth']['destrava_prevista'])) {
                                                  echo '<img border="0" title="'.$dicap.'" alt="Exibir" src="' . $this->webroot . 'img/cadeadoaberto.gif" />';
                                              } else {
                                                  echo '<img border="0" title="Fora do prazo" alt="Exibir" src="' . $this->webroot . 'img/vermelhop.gif" />';
                                              }
                                          }
                                      }
                                      if (!empty($escala['EscalasMonth']['ok_chefec'])) {
                                          $pdf = 2;
                                          if (!empty($escala['EscalasMonth']['destrava_cumprida'])) {
                                              echo '<img border="0" title="'.$dicac.'" alt="Exibir" src="' . $this->webroot . 'img/cadeadoaberto.gif" />';
                                          } else {
                                              echo '<img border="0" title="Assinado" alt="Exibir" src="' . $this->webroot . 'img/verdec.gif" />';
                                          }
                                      } else {
                                          if ($dif2 >= 0) {
                                              if (!empty($escala['EscalasMonth']['destrava_cumprida'])) {
                                                  echo '<img border="0" title="'.$dicac.'" alt="Exibir" src="' . $this->webroot . 'img/cadeadoaberto.gif" />';
                                              } else {
                                                  echo '<img border="0" title="Dentro do prazo" alt="Exibir"  src="' . $this->webroot . 'img/laranjac.gif" />';
                                              }
                                          } else {
                                              if (!empty($escala['EscalasMonth']['destrava_cumprida'])) {
                                                  echo '<img border="0" title="'.$dicac.'" alt="Exibir" src="' . $this->webroot . 'img/cadeadoaberto.gif" />';
                                              } else {
                                                  echo '<img border="0" title="Fora do prazo" alt="Exibir" src="' . $this->webroot . 'img/vermelhoc.gif" />';
                                              }
                                          }
                                      }
                                      ?></td>
                    <td <?php echo $class;?>><?php echo $escala['Cidade']['nome']; ?>
            </td>
            <td <?php echo $class;?>><?php echo $escala['Unidade']['sigla_unidade']; ?>
            </td>
            <td <?php echo $class;?>><?php echo $escala['Setor']['sigla_setor']; ?>
            </td>
	<td <?php echo $class;?>><?php echo $escala['Escala']['nm_chefe_orgao']; ?>
            </td>
            <td <?php echo $class;?>><?php echo $escala['Escala']['efetivo_total']; ?>
            </td>
            <td <?php echo $class;?>><?php echo $escala[0]['mes']; ?></td>
            <td <?php echo $class;?>><?php 

            if(!empty($escala['EscalasMonth']['ok_comandante'])){}else{ ?><a <?php echo $class;?> 
                    onclick="var x=screen.height;var y=screen.width;window.open('<?php echo $this->webroot.'escalas/escala/'.$escala['Escala']['id'].'/'.$escala[0]['mes'].'/'.$escala[0]['ano']; ?>','_blank','');">
            <img border="0" title="Editar" alt="Exibir"
                    src="<?php echo $this->webroot; ?>img/zerar.png" /></a>
                    <?php
                    }

                     ?></td>
            <td <?php echo $class;?>>
            <?php 
            if($pdf>0){
                    if($pdf==1){$sel='p';}else{$sel='c';}
            ?>
            <?php
                    $tamanho = strlen($escala['EscalasMonth']['id']);
                    if($tamanho<6){
                            $diferenca = 6-$tamanho;
                            for($i=0;$i<$diferenca;$i++){
                                    $completa .= '0';
                            }
                            $auxilio = $completa.$escala['EscalasMonth']['id'];
                    }

                    $completa = '';
                    $absoluto = substr(__FILE__, 0, strrpos(__FILE__, '/'));
            $absoluto = str_replace('views/escalas','',$absoluto);
                    //echo empty($escala['EscalasMonth']['destrava_prevista']);


            $absoluto = $absoluto.'webroot/pdf/'.$escala[0]['ano'].$escala[0]['mes'].$auxilio.'p.pdf';

            if((!empty($escala['EscalasMonth']['ok_chefep']))&&(empty($escala['EscalasMonth']['destrava_prevista']))&&(file_exists($absoluto))){

                    $caminhop = $this->webroot.'webroot/pdf/'.$escala[0]['ano'].$escala[0]['mes'].$auxilio.'p.pdf';

            }else{
                    $caminhop = $this->webroot.'escalas/indexPdf/'.$escala['Escala']['id'].'/'.$escala[0]['mes'].'/'.$escala[0]['ano'].'/p';
            }

            $absoluto = $absoluto.'webroot/pdf/'.$escala[0]['ano'].$escala[0]['mes'].$auxilio.'c.pdf';

            if((!empty($escala['EscalasMonth']['ok_chefec']))&&(empty($escala['EscalasMonth']['destrava_cumprida']))&&(file_exists($absoluto))){

                    $caminhoc = $this->webroot.'webroot/pdf/'.$escala[0]['ano'].$escala[0]['mes'].$auxilio.'c.pdf';

            }else{
                    $caminhoc = $this->webroot.'escalas/indexPdf/'.$escala['Escala']['id'].'/'.$escala[0]['mes'].'/'.$escala[0]['ano'].'/c';
            }

            ?> <a <?php echo $class;?> 
                    onclick="window.open('<?php echo $caminhop; ?>','_blank','');"><?php echo $this->Html->image('pdf2p.gif', array('alt'=> __('PDF', true), 'border'=> '0', 'title'=>'Gerar PDF da escala prevista', 'id'=>'pdfp')); ?>
            </a>
            <?php  } ?>
            </td>
            <td>
            <?php 
            if($pdf>0){ ?>
            <a <?php echo $class;?> 
                    onclick="window.open('<?php echo $caminhoc; ?>','_blank','');"><?php echo $this->Html->image('pdf2c.gif', array('alt'=> __('PDF', true), 'border'=> '0', 'title'=>'Gerar PDF da escala cumprida', 'id'=>'pdfc')); ?>
            </a>

            <?php } ?></td>
            <td><?php 
            if(!empty($escala['EscalasMonth']['ok_comandante'])){}else{
                    if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)||($u[0]['Usuario']['privilegio_id']==12)){
                    if(($escala['EscalasMonth']['destrava_prevista'])||($escala['EscalasMonth']['destrava_cumprida'])){
                            ?><a <?php echo $class;?>  ><?php echo $this->Html->image('cadeadoaberto.gif', array('alt'=> __('PDF', true), 'border'=> '0', 'title'=>$dicap.$dicac, 'id'=>'cadeado'.$escala['EscalasMonth']['id'], 'onclick'=>'Cadeado(\''.$escala['EscalasMonth']['id'].'\',\''.$id_usuario.'\');')); ?>
            </a><?php
                    }else{
                            ?><a <?php echo $class;?>  ><?php echo $this->Html->image('cadeadofechado.gif', array('alt'=> __('PDF', true), 'border'=> '0', 'title'=>'', 'id'=>'cadeado'.$escala['EscalasMonth']['id'], 'onclick'=>'Cadeado(\''.$escala['EscalasMonth']['id'].'\',\''.$id_usuario.'\');')); ?>
            </a><?php
                    }
                    }


            } ?></td>

                <?php
                		
       				if(($u[0]['Usuario']['privilegio_id']==1)){
                ?>
				<td><input type="checkbox" name="data[Escalasmonth][ver][]" id="<?php echo $escala['Escala']['tipo']; ?><?php echo $escala['EscalasMonth']['id']; ?>" onChange="visualiza('<?php echo $escala['Escala']['tipo']; ?><?php echo $escala['EscalasMonth']['id']; ?>','<?php echo $escala['EscalasMonth']['id']; ?>');" value="<?php echo $escala['EscalasMonth']['ver']; ?>" <?php if($escala['EscalasMonth']['ver']==1){echo ' checked="checked"'; } ?>></td><td><?php if($escala['EscalasMonth']['ver']==1){
					echo $this->Html->image('olhofechado.png', array('alt'=> __('fechado', true), 'border'=> '0', 'title'=>'Desativado', 'id'=>'v'.$escala['EscalasMonth']['id']));
				}else{
					echo $this->Html->image('olhoaberto.png', array('alt'=> __('aberto', true), 'border'=> '0', 'title'=>'Ativado', 'id'=>'v'.$escala['EscalasMonth']['id']));
				}; ?></td>
            
            <?php
            }
?>
            <td>

<?php
    if(!empty($escala['EscalasMonth']['ok_chefeorgaop'])){

    ?>
      <span><?php echo $this->Html->image('print.gif', array('alt'=> __('ImpressoraPrevista', true), 'border'=> '0','onMouseDown'=>" right(event e);", 'title'=>'Autoriza impressão Prevista', 'id'=>'imp'.$escala['EscalasMonth']['id'])); ?></span>
      <?php
    }else{
            if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)||($u[0]['Usuario']['privilegio_id']==12)){

                                            if(((!empty($escala['EscalasMonth']['ok_escalantep']))&&(!empty($escala['EscalasMonth']['ok_chefep']))||($u[0]['Usuario']['privilegio_id']==1))){

                                                    ?>
    <input type="checkbox" name="data[Escalasmonth][ok_chefeorgaop][]" id="idimpp<?php echo $escala['EscalasMonth']['id']; ?>" value="<?php echo $escala['EscalasMonth']['id']; ?>">
    <?php
                                            }else{

      ?>
    <input type="checkbox" name="data[Escalasmonth][naomuda][]" id="idimpp<?php echo $escala['EscalasMonth']['id']; ?>" value="<?php echo $escala['EscalasMonth']['id']; ?>"  onclick="$('idimpp<?php echo $escala['EscalasMonth']['id']; ?>').checked=false;alert('Escalante e Chefe devem assinar a escala !!!');">
    <?php


                                            }
            }
    }

            ?>

            </td>

            <td>
            <?php

    if(!empty($escala['EscalasMonth']['ok_chefeorgaoc'])){

    ?>
      <span><?php echo $this->Html->image('print.gif', array('alt'=> __('ImpressoraCumprida', true), 'border'=> '0', 'title'=>'Autoriza impressão Cumprida', 'id'=>'imp'.$escala['EscalasMonth']['id'])); ?></span>
      <?php
    }else{
            if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)||($u[0]['Usuario']['privilegio_id']==12)){

                                            if(((!empty($escala['EscalasMonth']['ok_escalantec']))&&(!empty($escala['EscalasMonth']['ok_chefec']))||($u[0]['Usuario']['privilegio_id']==1))){

                                                    ?>
     <input type="checkbox" name="data[Escalasmonth][ok_chefeorgaoc][]" id="idimpc<?php echo $escala['EscalasMonth']['id']; ?>" value="<?php echo $escala['EscalasMonth']['id']; ?>">

    <?php
                                            }else{

      ?>
      <input type="checkbox" name="data[Escalasmonth][naomuda][]" id="idimpc<?php echo $escala['EscalasMonth']['id']; ?>" value="<?php echo $escala['EscalasMonth']['id']; ?>"  onclick="$('idimpp<?php echo $escala['EscalasMonth']['id']; ?>').checked=false;alert('Escalante e Chefe devem assinar a escala !!!');">
    <?php


                                            }
            }
    }
            ?>

            </td>


            <td>
            <?php 
    if(!empty($escala['EscalasMonth']['ok_comandantep'])){ 

    ?>
    
      <span><?php echo $this->Html->image('verdep.gif', array('alt'=> __('Cmte', true), 'border'=> '0', 'title'=>'Assinatura do Chefe da Divisão Prevista', 'id'=>'cmte'.$escala['EscalasMonth']['id'])); ?></span>
      
      <?php
    }else{
            if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)||($u[0]['Usuario']['privilegio_id']==3)){
				if(!empty($escala['EscalasMonth']['ok_chefeorgaop'])){
      ?>
    <input type="checkbox" name="data[Escalasmonth][ok_comandantep][]" id="idcmtp<?php echo $escala['EscalasMonth']['id']; ?>" value="<?php echo $escala['EscalasMonth']['id']; ?>">
    <?php
            }
		}
    }
            ?>

            </td>
            <td>
            <?php 
            //echo $escala['EscalasMonth']['id'];
            ?>
            <?php 
    if(!empty($escala['EscalasMonth']['ok_comandantec'])){ 

    ?>
      <span><?php echo $this->Html->image('verdec.gif', array('alt'=> __('Cmte', true), 'border'=> '0', 'title'=>'Assinatura do Chefe da Divisão Cumprida', 'id'=>'cmte'.$escala['EscalasMonth']['id'])); ?></span>
      <?php
    }else{
            if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)||($u[0]['Usuario']['privilegio_id']==3)){
				if(!empty($escala['EscalasMonth']['ok_chefeorgaoc'])){
      ?>
    <input type="checkbox" name="data[Escalasmonth][ok_comandantec][]" id="idcmtc<?php echo $escala['EscalasMonth']['id']; ?>" value="<?php echo $escala['EscalasMonth']['id']; ?>">
        <?php
            }
		}
    }
            ?>

            </td>
            
<?php
    if(!empty($escala['EscalasMonth']['ok_chefeorgaoc'])){
		/*
			echo '<td><span>';
			echo $this->Html->link($this->Html->image('csv.png', array('alt'=> __('7613', true), 'border'=> '0', 'title'=>'7613', 'id'=>'7613_'.$escala['EscalasMonth']['id'])), array('action'=>'externocsv', $escala['EscalasMonth']['id'].'/7613'),array('id'=>$escala['EscalasMonth']['id'].'link', 'escape'=>false), null,false); 
			echo '</span></td>';
			*/
	}
?>
<?php
	if(!empty($escala['EscalasMonth']['ok_chefeorgaoc'])){
		/*
		echo '<td><span>';
		echo $this->Html->link($this->Html->image('csv.png', array('alt'=> __('9272', true), 'border'=> '0', 'title'=>'9272', 'id'=>'9272_'.$escala['EscalasMonth']['id'])), array('action'=>'externocsv', $escala['EscalasMonth']['id'].'/9272'),array('id'=>$escala['EscalasMonth']['id'].'link', 'escape'=>false), null,false); 
		echo '</span></td>';
		*/
	}
?>


<!--       /////////////////////////////////////////////////////////////////////////////                     -->


			</tr>
<?php 
	}//Verifica olho
}

if(($cabecalhoTitulo==1)&&($contaOperacional==$totalOp)){
 	?>
<tr style="padding: 1px; font-size: 0.8em;">
				<td style="padding: 1px; font-size: 0.8em;" colspan="12">	</td>
                <?php
                		
       				if(($u[0]['Usuario']['privilegio_id']==1)){
                ?>
				<td>&nbsp;</td><td>&nbsp;</td>
<?php
}
?>
				<td><a  style="padding: 1px; font-size: 0.8em;"><img border="0" id="todos01" title="" alt="" src="<?php echo $this->webroot;?>img/accept.png"/></a></td>
				<td><a  style="padding: 1px; font-size: 0.8em;"><img border="0" id="todos02" title="" alt="" src="<?php echo $this->webroot;?>img/accept.png"/></a>
				<td><a  style="padding: 1px; font-size: 0.8em;"><img border="0" id="todoscmtp" title="" alt="" src="<?php echo $this->webroot;?>img/accept.png"/></a></td>
				<td><a   style="padding: 1px; font-size: 0.8em;"><img border="0" id="todoscmtc" title="" alt="" src="<?php echo $this->webroot;?>img/accept.png"/></a>

			</td>
				<td colspan="12"></td>
				</tr>
		</table>
</div>	
	<?php 

}
		
if(($cabecalhoTitulo==2)&&($contaRisaer==1)){
	Menu_Barra('grupo02','idrisaer',"ESCALAS RISAER ({$totalRi} registros)",0);
?>
		<table cellpadding="0" cellspacing="0" id="idrisaer"  style="align:center;">
		<tr><td colspan="17">
		
		</td></tr>
				<th><span><?php __('Escalante'); ?>&nbsp;</span></th>
				<th><span><?php __('Chefe'); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span></th>
				<th><span><?php __('Cidade '); ?>&nbsp;</span></th>
				<th><span><?php __('Unidade '); ?>&nbsp;</span></th>
				<th><span><?php __('Setor'); ?>&nbsp;</span></th>
				 <th><span><?php __('Chf Orgao'); ?>&nbsp;</span></th>  -->				
				<th><span><?php __('Efetivo'); ?>&nbsp;</span></th>
				<th><span><?php __('Mes'); ?>&nbsp;</span></th>
				<th class="actions" colspan="4"><?php __('Ações');?></th>
                <?php
       				if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)||($u[0]['Usuario']['privilegio_id']==3)){
                ?>
				<th><span><?php echo $this->Html->image('printp.gif', array('alt'=> __('ImpPrevista', true), 'border'=> '0','onClick'=>" autorizaImp('p');", 'title'=>'Disponibilizar para o Chefe de Divisão a Prevista', 'id'=>'impp'.$escala['EscalasMonth']['id'])); ?></span></th>
				<th><span><?php echo $this->Html->image('printc.gif', array('alt'=> __('ImpCumprida', true), 'border'=> '0','onClick'=>" autorizaImp('c');", 'title'=>'Disponibilizar para o Chefe de Divisão a Cumprida', 'id'=>'impc'.$escala['EscalasMonth']['id'])); ?></span></th>
				<th><span><?php echo $this->Html->image('diskp.png', array('alt'=> __('CmtePrevista', true), 'border'=> '0','onClick'=>" assinaCmt('p');", 'title'=>'Assinatura do Chefe da Divisão Prevista', 'id'=>'cmtep'.$escala['EscalasMonth']['id'])); ?></span></th>
				<th><span><?php echo $this->Html->image('diskc.png', array('alt'=> __('CmteCumprida', true), 'border'=> '0','onClick'=>" assinaCmt('c');", 'title'=>'Assinatura do Chefe da Divisão Cumprida', 'id'=>'cmtec'.$escala['EscalasMonth']['id'])); ?></span></th>
                <?php
                    }
       				if(($u[0]['Usuario']['privilegio_id']==12)){
                ?>
				<th><span><?php echo $this->Html->image('printp.gif', array('alt'=> __('ImpPrevista', true), 'border'=> '0','onClick'=>" autorizaImp('p');", 'title'=>'Disponibilizar para o Chefe de Divisão a Prevista', 'id'=>'impp'.$escala['EscalasMonth']['id'])); ?></span></th>
				<th><span><?php echo $this->Html->image('printc.gif', array('alt'=> __('ImpCumprida', true), 'border'=> '0','onClick'=>" autorizaImp('c');", 'title'=>'Disponibilizar para o Chefe de Divisão a Cumprida', 'id'=>'impc'.$escala['EscalasMonth']['id'])); ?></span></th>
				<th><span><?php echo $this->Html->image('diskp.png', array('alt'=> __('CmtePrevista', true), 'border'=> '0', 'title'=>'Escala Prevista assinada pelo Comandante', 'id'=>'cmtep'.$escala['EscalasMonth']['id'])); ?></span></th>
				<th><span><?php echo $this->Html->image('diskc.png', array('alt'=> __('CmteCumprida', true), 'border'=> '0', 'title'=>'Escala Cumprida assinada pelo Comandante', 'id'=>'cmtec'.$escala['EscalasMonth']['id'])); ?></span></th>
                <?php 
                     }


                 ?>
				<th colspan="2">SIGPES<span></span></th>
			</tr><?php 
}

if(($cabecalhoTitulo==2)&&($contaRisaer<=$totalRi)){

?>

			<tr <?php echo $class;?>>
				<td <?php echo $class; ?>>
<?php
                                   
                                    

                                      if (!empty($escala['EscalasMonth']['ok_escalantep'])) {
                                          $pdf = 1;
                                          echo '<img border="0" title="Assinado" alt="Exibir"  src="' . $this->webroot . 'img/verdep.gif" />';
                                      } else {
                                          if ($dif1 >= 0) {
                                              if (!empty($escala['EscalasMonth']['destrava_prevista'])) {
                                                  echo '<img border="0" title="'.$dicap.'" alt="Exibir" src="' . $this->webroot . 'img/cadeadoaberto.gif" />';
                                              } else {
                                                  echo '<img border="0" title="Dentro do prazo" alt="Exibir"  src="' . $this->webroot . 'img/laranjap.gif" />';
                                              }
                                          } else {
                                              if (!empty($escala['EscalasMonth']['destrava_prevista'])) {
                                                  echo '<img border="0" title="'.$dicap.'" alt="Exibir" src="' . $this->webroot . 'img/cadeadoaberto.gif" />';
                                              } else {
                                                  echo '<img border="0" title="Perdeu o prazo" alt="Exibir" src="' . $this->webroot . 'img/vermelhop.gif" />';
                                              }
                                          }
                                      }
                                      if (!empty($escala['EscalasMonth']['ok_escalantec'])) {
                                          $pdf = 2;
                                          echo '<img border="0" title="Assinado" alt="Exibir" src="' . $this->webroot . 'img/verdec.gif" />';
                                      } else {
                                          if ($dif2 >= 0) {
                                              if (!empty($escala['EscalasMonth']['destrava_cumprida'])) {
                                                  echo '<img border="0" title="'.$dicac.'" alt="Exibir" src="' . $this->webroot . 'img/cadeadoaberto.gif" />';
                                              } else {
                                                  echo '<img border="0" title="Dentro do prazo" alt="Exibir"  src="' . $this->webroot . 'img/laranjac.gif" />';
                                              }
                                          } else {
                                              if (!empty($escala['EscalasMonth']['destrava_cumprida'])) {
                                                  echo '<img border="0" title="'.$dicac.'" alt="Exibir" src="' . $this->webroot . 'img/cadeadoaberto.gif" />';
                                              } else {
                                                  echo '<img border="0" title="Fora do prazo" alt="Exibir" src="' . $this->webroot . 'img/vermelhoc.gif" />';
                                              }
                                          }
                                      }                                    
                                    ?>&nbsp;
                          </td>                                   
                          <td <?php echo $class; ?>>
                          <?php 
                                      if (!empty($escala['EscalasMonth']['ok_chefep'])) {
                                          $pdf = 1;
                                          echo '<img border="0" title="Assinado" alt="Exibir"  src="' . $this->webroot . 'img/verdep.gif" />';
                                      } else {
                                          if ($dif1 >= 0) {
                                              if (!empty($escala['EscalasMonth']['destrava_prevista'])) {
                                                  echo '<img border="0" title="'.$dicap.'" alt="Exibir" src="' . $this->webroot . 'img/cadeadoaberto.gif" />';
                                              } else {
                                                  echo '<img border="0" title="Dentro do prazo" alt="Exibir"  src="' . $this->webroot . 'img/laranjap.gif" />';
                                              }
                                          } else {
                                              if (!empty($escala['EscalasMonth']['destrava_prevista'])) {
                                                  echo '<img border="0" title="'.$dicap.'" alt="Exibir" src="' . $this->webroot . 'img/cadeadoaberto.gif" />';
                                              } else {
                                                  echo '<img border="0" title="Fora do prazo" alt="Exibir" src="' . $this->webroot . 'img/vermelhop.gif" />';
                                              }
                                          }
                                      }
                                      if (!empty($escala['EscalasMonth']['ok_chefec'])) {
                                          $pdf = 2;
                                          if (!empty($escala['EscalasMonth']['destrava_cumprida'])) {
                                              echo '<img border="0" title="'.$dicac.'" alt="Exibir" src="' . $this->webroot . 'img/cadeadoaberto.gif" />';
                                          } else {
                                              echo '<img border="0" title="Assinado" alt="Exibir" src="' . $this->webroot . 'img/verdec.gif" />';
                                          }
                                      } else {
                                          if ($dif2 >= 0) {
                                              if (!empty($escala['EscalasMonth']['destrava_cumprida'])) {
                                                  echo '<img border="0" title="'.$dicac.'" alt="Exibir" src="' . $this->webroot . 'img/cadeadoaberto.gif" />';
                                              } else {
                                                  echo '<img border="0" title="Dentro do prazo" alt="Exibir"  src="' . $this->webroot . 'img/laranjac.gif" />';
                                              }
                                          } else {
                                              if (!empty($escala['EscalasMonth']['destrava_cumprida'])) {
                                                  echo '<img border="0" title="'.$dicac.'" alt="Exibir" src="' . $this->webroot . 'img/cadeadoaberto.gif" />';
                                              } else {
                                                  echo '<img border="0" title="Fora do prazo" alt="Exibir" src="' . $this->webroot . 'img/vermelhoc.gif" />';
                                              }
                                          }
                                      }
                                      ?></td>
				<td <?php echo $class;?>><?php echo $escala['Cidade']['nome']; ?>
				</td>
				<td <?php echo $class;?>><?php echo $escala['Unidade']['sigla_unidade']; ?>
				</td>
				<td <?php echo $class;?>><?php echo $escala['Setor']['sigla_setor']; ?>
				</td>
 				<td <?php echo $class;?>><?php echo $escala['Escala']['nm_chefe_orgao']; ?> 
				</td>
				<td <?php echo $class;?>><?php echo $escala['Escala']['efetivo_total']; ?>
				</td>
				<td <?php echo $class;?>><?php echo $escala[0]['mes']; ?></td>
				<td <?php echo $class;?>><?php 
								
				if(!empty($escala['EscalasMonth']['ok_comandante'])){}else{ ?><a <?php echo $class;?> 
					onclick="var x=screen.height;var y=screen.width;window.open('<?php echo $this->webroot.'escalas/escala/'.$escala['Escala']['id'].'/'.$escala[0]['mes'].'/'.$escala[0]['ano']; ?>','_blank','');">
				<img border="0" title="Editar" alt="Exibir"
					src="<?php echo $this->webroot; ?>img/zerar.png" /></a>
					<?php
					}
					
					 ?></td>
				<td <?php echo $class;?>>
				<?php 
				if($pdf>0){
					if($pdf==1){$sel='p';}else{$sel='c';}
				?>
				<?php
					$tamanho = strlen($escala['EscalasMonth']['id']);
					if($tamanho<6){
						$diferenca = 6-$tamanho;
						for($i=0;$i<$diferenca;$i++){
							$completa .= '0';
						}
						$auxilio = $completa.$escala['EscalasMonth']['id'];
					}
				
					$completa = '';
					$absoluto = substr(__FILE__, 0, strrpos(__FILE__, '/'));
       				$absoluto = str_replace('views/escalas','',$absoluto);
					//echo empty($escala['EscalasMonth']['destrava_prevista']);
				

 				$absoluto = $absoluto.'webroot/pdf/'.$escala[0]['ano'].$escala[0]['mes'].$auxilio.'p.pdf';
       				
				if((!empty($escala['EscalasMonth']['ok_chefep']))&&(empty($escala['EscalasMonth']['destrava_prevista']))&&(file_exists($absoluto))){

					$caminhop = $this->webroot.'webroot/pdf/'.$escala[0]['ano'].$escala[0]['mes'].$auxilio.'p.pdf';

				}else{
					$caminhop = $this->webroot.'escalas/indexPdf/'.$escala['Escala']['id'].'/'.$escala[0]['mes'].'/'.$escala[0]['ano'].'/p';
				}
				
 				$absoluto = $absoluto.'webroot/pdf/'.$escala[0]['ano'].$escala[0]['mes'].$auxilio.'c.pdf';
 				
				if((!empty($escala['EscalasMonth']['ok_chefec']))&&(empty($escala['EscalasMonth']['destrava_cumprida']))&&(file_exists($absoluto))){

					$caminhoc = $this->webroot.'webroot/pdf/'.$escala[0]['ano'].$escala[0]['mes'].$auxilio.'c.pdf';

				}else{
					$caminhoc = $this->webroot.'escalas/indexPdf/'.$escala['Escala']['id'].'/'.$escala[0]['mes'].'/'.$escala[0]['ano'].'/c';
				}
				
				?> <a <?php echo $class;?> 
					onclick="window.open('<?php echo $caminhop; ?>','_blank','');"><?php echo $this->Html->image('pdf2p.gif', array('alt'=> __('PDF', true), 'border'=> '0', 'title'=>'Gerar PDF da escala prevista', 'id'=>'pdfp')); ?>
				</a>
				<?php  } ?>
				</td>
				<td>
				<?php 
				if($pdf>0){ ?>
				<a <?php echo $class;?> 
					onclick="window.open('<?php echo $caminhoc; ?>','_blank','');"><?php echo $this->Html->image('pdf2c.gif', array('alt'=> __('PDF', true), 'border'=> '0', 'title'=>'Gerar PDF da escala cumprida', 'id'=>'pdfc')); ?>
				</a>
				
				<?php } ?></td>
				<td><?php 
				if(!empty($escala['EscalasMonth']['ok_comandante'])){}else{
					if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)||($u[0]['Usuario']['privilegio_id']==12)){
					if(($escala['EscalasMonth']['destrava_prevista'])||($escala['EscalasMonth']['destrava_cumprida'])){
						?><a <?php echo $class;?>  ><?php echo $this->Html->image('cadeadoaberto.gif', array('alt'=> __('PDF', true), 'border'=> '0', 'title'=>$dicap.$dicac, 'id'=>'cadeado'.$escala['EscalasMonth']['id'], 'onclick'=>'Cadeado(\''.$escala['EscalasMonth']['id'].'\',\''.$id_usuario.'\');')); ?>
				</a><?php
					}else{
						?><a <?php echo $class;?>  ><?php echo $this->Html->image('cadeadofechado.gif', array('alt'=> __('PDF', true), 'border'=> '0', 'title'=>'', 'id'=>'cadeado'.$escala['EscalasMonth']['id'], 'onclick'=>'Cadeado(\''.$escala['EscalasMonth']['id'].'\',\''.$id_usuario.'\');')); ?>
				</a><?php
					}
					}

					
				} ?></td>

				<td>
				<?php

			if(!empty($escala['EscalasMonth']['ok_chefeorgaop'])){

			?>
			  <span><?php echo $this->Html->image('print.gif', array('alt'=> __('ImpressoraPrevista', true), 'border'=> '0','onMouseDown'=>" right(event e);", 'title'=>'Autoriza impressão Prevista', 'id'=>'imp'.$escala['EscalasMonth']['id'])); ?></span>
			  <?php
			}else{
				if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)||($u[0]['Usuario']['privilegio_id']==12)){
					
								if(((!empty($escala['EscalasMonth']['ok_escalantep']))&&(!empty($escala['EscalasMonth']['ok_chefep']))||($u[0]['Usuario']['privilegio_id']==1))){
					
									?>
			<input type="checkbox" name="data[Escalasmonth][ok_chefeorgaop][]" id="idimpp<?php echo $escala['EscalasMonth']['id']; ?>" value="<?php echo $escala['EscalasMonth']['id']; ?>">
			<?php
								}else{
									
			  ?>
			<input type="checkbox" name="data[Escalasmonth][naomuda][]" id="idimpp<?php echo $escala['EscalasMonth']['id']; ?>" value="<?php echo $escala['EscalasMonth']['id']; ?>"  onclick="$('idimpp<?php echo $escala['EscalasMonth']['id']; ?>').checked=false;alert('Escalante e Chefe devem assinar a escala !!!');">
			<?php
									
									
								}
				}
			}

	//	}
				?>

				</td>

				<td>
				<?php

			if(!empty($escala['EscalasMonth']['ok_chefeorgaoc'])){

			?>
			  <span><?php echo $this->Html->image('print.gif', array('alt'=> __('ImpressoraCumprida', true), 'border'=> '0', 'title'=>'Autoriza impressão Cumprida', 'id'=>'imp'.$escala['EscalasMonth']['id'])); ?></span>
			  <?php
			}else{
				if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)||($u[0]['Usuario']['privilegio_id']==12)){
					
								if(((!empty($escala['EscalasMonth']['ok_escalantec']))&&(!empty($escala['EscalasMonth']['ok_chefec']))||($u[0]['Usuario']['privilegio_id']==1))){
					
									?>
			 <input type="checkbox" name="data[Escalasmonth][ok_chefeorgaoc][]" id="idimpc<?php echo $escala['EscalasMonth']['id']; ?>" value="<?php echo $escala['EscalasMonth']['id']; ?>">
			 
			<?php
								}else{
									
			  ?>
			  <input type="checkbox" name="data[Escalasmonth][naomuda][]" id="idimpc<?php echo $escala['EscalasMonth']['id']; ?>" value="<?php echo $escala['EscalasMonth']['id']; ?>"  onclick="$('idimpp<?php echo $escala['EscalasMonth']['id']; ?>').checked=false;alert('Escalante e Chefe devem assinar a escala !!!');">
			<?php
									
									
								}
				}
			}
	//	}
				?>

				</td>

				
				<td>
				<?php 
			if(!empty($escala['EscalasMonth']['ok_comandantep'])){ 
				
			?>
			
			  <span><?php echo $this->Html->image('verdep.gif', array('alt'=> __('Cmte', true), 'border'=> '0', 'title'=>'Assinatura do Chefe da Divisão Prevista', 'id'=>'cmte'.$escala['EscalasMonth']['id'])); ?></span>
			  			  <?php
			}else{
				if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)||($u[0]['Usuario']['privilegio_id']==3)){
					if(!empty($escala['EscalasMonth']['ok_chefeorgaop'])){
			  ?>
				<input type="checkbox" name="data[Escalasmonth][ok_comandantep][]" id="idcmtp<?php echo $escala['EscalasMonth']['id']; ?>" value="<?php echo $escala['EscalasMonth']['id']; ?>">
			
			<?php
				}
			}
			}
				?>
				
				</td>
				<td>
				<?php 
				//echo $escala['EscalasMonth']['id'];
				?>
				<?php 
			if(!empty($escala['EscalasMonth']['ok_comandantec'])){ 
				
			?>
			  <span><?php echo $this->Html->image('verdec.gif', array('alt'=> __('Cmte', true), 'border'=> '0', 'title'=>'Assinatura do Chefe da Divisão Cumprida', 'id'=>'cmte'.$escala['EscalasMonth']['id'])); ?></span>
			  <?php
			}else{
				if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)||($u[0]['Usuario']['privilegio_id']==3)){
					if(!empty($escala['EscalasMonth']['ok_chefeorgaoc'])){
			  ?>
			  
			<input type="checkbox" name="data[Escalasmonth][ok_comandantec][]" id="idcmtc<?php echo $escala['EscalasMonth']['id']; ?>" value="<?php echo $escala['EscalasMonth']['id']; ?>">
			
			<?php
				}
			}
			}
				?>
				
				</td>
				<?php
    if(!empty($escala['EscalasMonth']['ok_chefeorgaoc'])){
		/*
			echo '<td><span>';
			echo $this->Html->link($this->Html->image('csv.png', array('alt'=> __('7613', true), 'border'=> '0', 'title'=>'7613', 'id'=>'7613_'.$escala['EscalasMonth']['id'])), array('action'=>'externocsv', $escala['EscalasMonth']['id'].'/7613'),array('id'=>$escala['EscalasMonth']['id'].'link', 'escape'=>false), null,false); 
			echo '</span></td>';
			echo '<td><span>';
			echo $this->Html->link($this->Html->image('csv.png', array('alt'=> __('9272', true), 'border'=> '0', 'title'=>'9272', 'id'=>'9272_'.$escala['EscalasMonth']['id'])), array('action'=>'externocsv', $escala['EscalasMonth']['id'].'/9272'),array('id'=>$escala['EscalasMonth']['id'].'link', 'escape'=>false), null,false); 
			echo '</span></td>';
			*/
	}
			?>


<!--       /////////////////////////////////////////////////////////////////////////////                     -->


			</tr>
<?php 
}
?>





<?php 

if(($cabecalhoTitulo==2)&&($contaRisaer==$totalRi)){
	?>
<tr style="padding: 1px; font-size: 0.8em;">
				<td style="padding: 1px; font-size: 0.8em;" colspan="12">	</td>
				<td><a  style="padding: 1px; font-size: 0.8em;"><img border="0" id="todos03" title="" alt="" src="<?php echo $this->webroot;?>img/accept.png"/></a></td>
				<td><a   style="padding: 1px; font-size: 0.8em;"><img border="0" id="todos04" title="" alt="" src="<?php echo $this->webroot;?>img/accept.png"/></a>
				</td>
				<td colspan="10"></td>
				</tr>
		</table>
</div>
	<?php 
}
		
if(($cabecalhoTitulo==3)&&($contaTecnica==1)){
	Menu_Barra('grupo03','idtecnica',"ESCALAS TÉCNICAS ({$totalTc} registros)",0);
?>
		<table cellpadding="0" cellspacing="0" id="idtecnica"  style="align:center;">
		<tr><td colspan="17">
		
		</td></tr>
				<th><span><?php __('Escalante'); ?>&nbsp;</span></th>
				<th><span><?php __('Chefe'); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span></th>
				<th><span><?php __('Cidade '); ?>&nbsp;</span></th>
				<th><span><?php __('Unidade '); ?>&nbsp;</span></th>
				<th><span><?php __('Setor'); ?>&nbsp;</span></th>
				<th><span><?php __('Chf Orgao'); ?>&nbsp;</span></th>  -->				
				<th><span><?php __('Efetivo'); ?>&nbsp;</span></th>
				<th><span><?php __('Mes'); ?>&nbsp;</span></th>
				<th class="actions" colspan="4"><?php __('Ações');?></th>
                <?php
       				if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)||($u[0]['Usuario']['privilegio_id']==3)){
                ?>
				<th><span><?php echo $this->Html->image('printp.gif', array('alt'=> __('ImpPrevista', true), 'border'=> '0','onClick'=>" autorizaImp('p');", 'title'=>'Disponibilizar para o Chefe de Divisão a Prevista', 'id'=>'impp'.$escala['EscalasMonth']['id'])); ?></span></th>
				<th><span><?php echo $this->Html->image('printc.gif', array('alt'=> __('ImpCumprida', true), 'border'=> '0','onClick'=>" autorizaImp('c');", 'title'=>'Disponibilizar para o Chefe de Divisão a Cumprida', 'id'=>'impc'.$escala['EscalasMonth']['id'])); ?></span></th>
				<th><span><?php echo $this->Html->image('diskp.png', array('alt'=> __('CmtePrevista', true), 'border'=> '0','onClick'=>" assinaCmt('p');", 'title'=>'Assinatura do Chefe da Divisão Prevista', 'id'=>'cmtep'.$escala['EscalasMonth']['id'])); ?></span></th>
				<th><span><?php echo $this->Html->image('diskc.png', array('alt'=> __('CmteCumprida', true), 'border'=> '0','onClick'=>" assinaCmt('c');", 'title'=>'Assinatura do Chefe da Divisão Cumprida', 'id'=>'cmtec'.$escala['EscalasMonth']['id'])); ?></span></th>
                <?php
                    }
       				if(($u[0]['Usuario']['privilegio_id']==12)){
                ?>
				<th><span><?php echo $this->Html->image('printp.gif', array('alt'=> __('ImpPrevista', true), 'border'=> '0','onClick'=>" autorizaImp('p');", 'title'=>'Disponibilizar para o Chefe de Divisão a Prevista', 'id'=>'impp'.$escala['EscalasMonth']['id'])); ?></span></th>
				<th><span><?php echo $this->Html->image('printc.gif', array('alt'=> __('ImpCumprida', true), 'border'=> '0','onClick'=>" autorizaImp('c');", 'title'=>'Disponibilizar para o Chefe de Divisão a Cumprida', 'id'=>'impc'.$escala['EscalasMonth']['id'])); ?></span></th>
				<th><span><?php echo $this->Html->image('diskp.png', array('alt'=> __('CmtePrevista', true), 'border'=> '0', 'title'=>'Escala Prevista assinada pelo Comandante', 'id'=>'cmtep'.$escala['EscalasMonth']['id'])); ?></span></th>
				<th><span><?php echo $this->Html->image('diskc.png', array('alt'=> __('CmteCumprida', true), 'border'=> '0', 'title'=>'Escala Cumprida assinada pelo Comandante', 'id'=>'cmtec'.$escala['EscalasMonth']['id'])); ?></span></th>
                <?php 
                     }


                 ?>
				<th colspan="2">SIGPES<span></span></th>
			</tr><?php 
}
?>    

<?php 
if(($cabecalhoTitulo==3)&&($contaTecnica<=$totalTc)){

?>

			<tr <?php echo $class;?>>
				<td <?php echo $class; ?>>
<?php
                                   
                                    

                                      if (!empty($escala['EscalasMonth']['ok_escalantep'])) {
                                          $pdf = 1;
                                          echo '<img border="0" title="Assinado" alt="Exibir"  src="' . $this->webroot . 'img/verdep.gif" />';
                                      } else {
                                          if ($dif1 >= 0) {
                                              if (!empty($escala['EscalasMonth']['destrava_prevista'])) {
                                                  echo '<img border="0" title="'.$dicap.'" alt="Exibir" src="' . $this->webroot . 'img/cadeadoaberto.gif" />';
                                              } else {
                                                  echo '<img border="0" title="Dentro do prazo" alt="Exibir"  src="' . $this->webroot . 'img/laranjap.gif" />';
                                              }
                                          } else {
                                              if (!empty($escala['EscalasMonth']['destrava_prevista'])) {
                                                  echo '<img border="0" title="'.$dicap.'" alt="Exibir" src="' . $this->webroot . 'img/cadeadoaberto.gif" />';
                                              } else {
                                                  echo '<img border="0" title="Perdeu o prazo" alt="Exibir" src="' . $this->webroot . 'img/vermelhop.gif" />';
                                              }
                                          }
                                      }
                                      if (!empty($escala['EscalasMonth']['ok_escalantec'])) {
                                          $pdf = 2;
                                          echo '<img border="0" title="Assinado" alt="Exibir" src="' . $this->webroot . 'img/verdec.gif" />';
                                      } else {
                                          if ($dif2 >= 0) {
                                              if (!empty($escala['EscalasMonth']['destrava_cumprida'])) {
                                                  echo '<img border="0" title="'.$dicac.'" alt="Exibir" src="' . $this->webroot . 'img/cadeadoaberto.gif" />';
                                              } else {
                                                  echo '<img border="0" title="Dentro do prazo" alt="Exibir"  src="' . $this->webroot . 'img/laranjac.gif" />';
                                              }
                                          } else {
                                              if (!empty($escala['EscalasMonth']['destrava_cumprida'])) {
                                                  echo '<img border="0" title="'.$dicac.'" alt="Exibir" src="' . $this->webroot . 'img/cadeadoaberto.gif" />';
                                              } else {
                                                  echo '<img border="0" title="Fora do prazo" alt="Exibir" src="' . $this->webroot . 'img/vermelhoc.gif" />';
                                              }
                                          }
                                      }                                    
                                    ?>&nbsp;
                          </td>                                   
                          <td <?php echo $class; ?>>
                          <?php 
                                      if (!empty($escala['EscalasMonth']['ok_chefep'])) {
                                          $pdf = 1;
                                          echo '<img border="0" title="Assinado" alt="Exibir"  src="' . $this->webroot . 'img/verdep.gif" />';
                                      } else {
                                          if ($dif1 >= 0) {
                                              if (!empty($escala['EscalasMonth']['destrava_prevista'])) {
                                                  echo '<img border="0" title="'.$dicap.'" alt="Exibir" src="' . $this->webroot . 'img/cadeadoaberto.gif" />';
                                              } else {
                                                  echo '<img border="0" title="Dentro do prazo" alt="Exibir"  src="' . $this->webroot . 'img/laranjap.gif" />';
                                              }
                                          } else {
                                              if (!empty($escala['EscalasMonth']['destrava_prevista'])) {
                                                  echo '<img border="0" title="'.$dicap.'" alt="Exibir" src="' . $this->webroot . 'img/cadeadoaberto.gif" />';
                                              } else {
                                                  echo '<img border="0" title="Fora do prazo" alt="Exibir" src="' . $this->webroot . 'img/vermelhop.gif" />';
                                              }
                                          }
                                      }
                                      if (!empty($escala['EscalasMonth']['ok_chefec'])) {
                                          $pdf = 2;
                                          if (!empty($escala['EscalasMonth']['destrava_cumprida'])) {
                                              echo '<img border="0" title="'.$dicac.'" alt="Exibir" src="' . $this->webroot . 'img/cadeadoaberto.gif" />';
                                          } else {
                                              echo '<img border="0" title="Assinado" alt="Exibir" src="' . $this->webroot . 'img/verdec.gif" />';
                                          }
                                      } else {
                                          if ($dif2 >= 0) {
                                              if (!empty($escala['EscalasMonth']['destrava_cumprida'])) {
                                                  echo '<img border="0" title="'.$dicac.'" alt="Exibir" src="' . $this->webroot . 'img/cadeadoaberto.gif" />';
                                              } else {
                                                  echo '<img border="0" title="Dentro do prazo" alt="Exibir"  src="' . $this->webroot . 'img/laranjac.gif" />';
                                              }
                                          } else {
                                              if (!empty($escala['EscalasMonth']['destrava_cumprida'])) {
                                                  echo '<img border="0" title="'.$dicac.'" alt="Exibir" src="' . $this->webroot . 'img/cadeadoaberto.gif" />';
                                              } else {
                                                  echo '<img border="0" title="Fora do prazo" alt="Exibir" src="' . $this->webroot . 'img/vermelhoc.gif" />';
                                              }
                                          }
                                      }
                                      ?></td>
				<td <?php echo $class;?>><?php echo $escala['Cidade']['nome']; ?>
				</td>
				<td <?php echo $class;?>><?php echo $escala['Unidade']['sigla_unidade']; ?>
				</td>
				<td <?php echo $class;?>><?php echo $escala['Setor']['sigla_setor']; ?>
				</td>
 				<td <?php echo $class;?>><?php echo $escala['Escala']['nm_chefe_orgao']; ?> -->
				</td>
				<td <?php echo $class;?>><?php echo $escala['Escala']['efetivo_total']; ?>
				</td>
				<td <?php echo $class;?>><?php echo $escala[0]['mes']; ?></td>
				<td <?php echo $class;?>><?php 
								
				if(!empty($escala['EscalasMonth']['ok_comandante'])){}else{ ?><a <?php echo $class;?> 
					onclick="var x=screen.height;var y=screen.width;window.open('<?php echo $this->webroot.'escalas/escala/'.$escala['Escala']['id'].'/'.$escala[0]['mes'].'/'.$escala[0]['ano']; ?>','_blank','');">
				<img border="0" title="Editar" alt="Exibir"
					src="<?php echo $this->webroot; ?>img/zerar.png" /></a>
					<?php
					}
					
					 ?></td>
				<td <?php echo $class;?>>
				<?php 
				if($pdf>0){
					if($pdf==1){$sel='p';}else{$sel='c';}
				?>
				<?php
					$tamanho = strlen($escala['EscalasMonth']['id']);
					if($tamanho<6){
						$diferenca = 6-$tamanho;
						for($i=0;$i<$diferenca;$i++){
							$completa .= '0';
						}
						$auxilio = $completa.$escala['EscalasMonth']['id'];
					}
				
					$completa = '';
					$absoluto = substr(__FILE__, 0, strrpos(__FILE__, '/'));
       				$absoluto = str_replace('views/escalas','',$absoluto);
					//echo empty($escala['EscalasMonth']['destrava_prevista']);
				

 				$absoluto = $absoluto.'webroot/pdf/'.$escala[0]['ano'].$escala[0]['mes'].$auxilio.'p.pdf';
       				
				if((!empty($escala['EscalasMonth']['ok_chefep']))&&(empty($escala['EscalasMonth']['destrava_prevista']))&&(file_exists($absoluto))){

					$caminhop = $this->webroot.'webroot/pdf/'.$escala[0]['ano'].$escala[0]['mes'].$auxilio.'p.pdf';

				}else{
					$caminhop = $this->webroot.'escalas/indexPdf/'.$escala['Escala']['id'].'/'.$escala[0]['mes'].'/'.$escala[0]['ano'].'/p';
				}
				
 				$absoluto = $absoluto.'webroot/pdf/'.$escala[0]['ano'].$escala[0]['mes'].$auxilio.'c.pdf';
 				
				if((!empty($escala['EscalasMonth']['ok_chefec']))&&(empty($escala['EscalasMonth']['destrava_cumprida']))&&(file_exists($absoluto))){

					$caminhoc = $this->webroot.'webroot/pdf/'.$escala[0]['ano'].$escala[0]['mes'].$auxilio.'c.pdf';

				}else{
					$caminhoc = $this->webroot.'escalas/indexPdf/'.$escala['Escala']['id'].'/'.$escala[0]['mes'].'/'.$escala[0]['ano'].'/c';
				}
				
				?> <a <?php echo $class;?> 
					onclick="window.open('<?php echo $caminhop; ?>','_blank','');"><?php echo $this->Html->image('pdf2p.gif', array('alt'=> __('PDF', true), 'border'=> '0', 'title'=>'Gerar PDF da escala prevista', 'id'=>'pdfp')); ?>
				</a>
				<?php  } ?>
				</td>
				<td>
				<?php 
				if($pdf>0){ ?>
				<a <?php echo $class;?> 
					onclick="window.open('<?php echo $caminhoc; ?>','_blank','');"><?php echo $this->Html->image('pdf2c.gif', array('alt'=> __('PDF', true), 'border'=> '0', 'title'=>'Gerar PDF da escala cumprida', 'id'=>'pdfc')); ?>
				</a>
				
				<?php } ?></td>
				<td><?php 
				if(!empty($escala['EscalasMonth']['ok_comandante'])){}else{
					if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)||($u[0]['Usuario']['privilegio_id']==12)){
					if(($escala['EscalasMonth']['destrava_prevista'])||($escala['EscalasMonth']['destrava_cumprida'])){
						?><a <?php echo $class;?>  ><?php echo $this->Html->image('cadeadoaberto.gif', array('alt'=> __('PDF', true), 'border'=> '0', 'title'=>$dicap.$dicac, 'id'=>'cadeado'.$escala['EscalasMonth']['id'], 'onclick'=>'Cadeado(\''.$escala['EscalasMonth']['id'].'\',\''.$id_usuario.'\');')); ?>
				</a><?php
					}else{
						?><a <?php echo $class;?>  ><?php echo $this->Html->image('cadeadofechado.gif', array('alt'=> __('PDF', true), 'border'=> '0', 'title'=>'', 'id'=>'cadeado'.$escala['EscalasMonth']['id'], 'onclick'=>'Cadeado(\''.$escala['EscalasMonth']['id'].'\',\''.$id_usuario.'\');')); ?>
				</a><?php
					}
					}

					
				} ?></td>

				<td>
				<?php

			if(!empty($escala['EscalasMonth']['ok_chefeorgaop'])){

			?>
			  <span><?php echo $this->Html->image('print.gif', array('alt'=> __('ImpressoraPrevista', true), 'border'=> '0','onMouseDown'=>" right(event e);", 'title'=>'Autoriza impressão Prevista', 'id'=>'imp'.$escala['EscalasMonth']['id'])); ?></span>
			  <?php
			}else{
				if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)||($u[0]['Usuario']['privilegio_id']==12)){
					
								if(((!empty($escala['EscalasMonth']['ok_escalantep']))&&(!empty($escala['EscalasMonth']['ok_chefep']))||($u[0]['Usuario']['privilegio_id']==1))){
					
									?>
			<input type="checkbox" name="data[Escalasmonth][ok_chefeorgaop][]" id="idimpp<?php echo $escala['EscalasMonth']['id']; ?>" value="<?php echo $escala['EscalasMonth']['id']; ?>">
			<?php
								}else{
									
			  ?>
			<input type="checkbox" name="data[Escalasmonth][naomuda][]" id="idimpp<?php echo $escala['EscalasMonth']['id']; ?>" value="<?php echo $escala['EscalasMonth']['id']; ?>"  onclick="$('idimpp<?php echo $escala['EscalasMonth']['id']; ?>').checked=false;alert('Escalante e Chefe devem assinar a escala !!!');">
			<?php
									
									
								}
				}
			}

	//	}
				?>

				</td>

				<td>
				<?php

			if(!empty($escala['EscalasMonth']['ok_chefeorgaoc'])){

			?>
			  <span><?php echo $this->Html->image('print.gif', array('alt'=> __('ImpressoraCumprida', true), 'border'=> '0', 'title'=>'Autoriza impressão Cumprida', 'id'=>'imp'.$escala['EscalasMonth']['id'])); ?></span>
			  <?php
			}else{
				if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)||($u[0]['Usuario']['privilegio_id']==12)){
					
								if(((!empty($escala['EscalasMonth']['ok_escalantec']))&&(!empty($escala['EscalasMonth']['ok_chefec']))||($u[0]['Usuario']['privilegio_id']==1))){
					
									?>
			 <input type="checkbox" name="data[Escalasmonth][ok_chefeorgaoc][]" id="idimpc<?php echo $escala['EscalasMonth']['id']; ?>" value="<?php echo $escala['EscalasMonth']['id']; ?>">
			 
			<?php
								}else{
									
			  ?>
			  <input type="checkbox" name="data[Escalasmonth][naomuda][]" id="idimpc<?php echo $escala['EscalasMonth']['id']; ?>" value="<?php echo $escala['EscalasMonth']['id']; ?>"  onclick="$('idimpp<?php echo $escala['EscalasMonth']['id']; ?>').checked=false;alert('Escalante e Chefe devem assinar a escala !!!');">
			<?php
									
									
								}
				}
			}
	//	}
				?>

				</td>

				
				<td>
				<?php 
			if(!empty($escala['EscalasMonth']['ok_comandantep'])){ 
				
			?>
			
			  <span><?php echo $this->Html->image('verdep.gif', array('alt'=> __('Cmte', true), 'border'=> '0', 'title'=>'Assinatura do Chefe da Divisão Prevista', 'id'=>'cmte'.$escala['EscalasMonth']['id'])); ?></span>
			 
			  <?php
			}else{
				if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)||($u[0]['Usuario']['privilegio_id']==3)){
					if(!empty($escala['EscalasMonth']['ok_chefeorgaop'])){
			  ?>
			 
			<input type="checkbox" name="data[Escalasmonth][ok_comandantep][]" id="idcmtp<?php echo $escala['EscalasMonth']['id']; ?>" value="<?php echo $escala['EscalasMonth']['id']; ?>">
			
			<?php
				}
			}
			}
				?>
				
				</td>
				<td>
				<?php 
				//echo $escala['EscalasMonth']['id'];
				?>
				<?php 
			if(!empty($escala['EscalasMonth']['ok_comandantec'])){ 
				
			?>
			  <span><?php echo $this->Html->image('verdec.gif', array('alt'=> __('Cmte', true), 'border'=> '0', 'title'=>'Assinatura do Chefe da Divisão Cumprida', 'id'=>'cmte'.$escala['EscalasMonth']['id'])); ?></span>
			  <?php
			}else{
				if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)||($u[0]['Usuario']['privilegio_id']==3)){
					if(!empty($escala['EscalasMonth']['ok_chefeorgaoc'])){
			  ?>
			 
			<input type="checkbox" name="data[Escalasmonth][ok_comandantec][]" id="idcmtc<?php echo $escala['EscalasMonth']['id']; ?>" value="<?php echo $escala['EscalasMonth']['id']; ?>">
			
			<?php
					}
				}
			}
				?>
				
				</td>
				<td><span>
<?php
			if(!empty($escala['EscalasMonth']['ok_chefeorgaoc'])){
				echo $this->Html->link($this->Html->image('csv.png', array('alt'=> __('7613', true), 'border'=> '0', 'title'=>'7613', 'id'=>'7613_'.$escala['EscalasMonth']['id'])), array('action'=>'externocsv', $escala['EscalasMonth']['id'].'/7613'),array('id'=>$escala['EscalasMonth']['id'].'link', 'escape'=>false), null,false); 
			}
?>
				</span></td>
				<td><span>
<?php
			if(!empty($escala['EscalasMonth']['ok_chefeorgaoc'])){
				echo $this->Html->link($this->Html->image('csv.png', array('alt'=> __('9272', true), 'border'=> '0', 'title'=>'9272', 'id'=>'9272_'.$escala['EscalasMonth']['id'])), array('action'=>'externocsv', $escala['EscalasMonth']['id'].'/9272'),array('id'=>$escala['EscalasMonth']['id'].'link', 'escape'=>false), null,false); 
			}
	?>
 				
				</span></td>

<!--       /////////////////////////////////////////////////////////////////////////////                     -->


			</tr>
<?php 
}

if(($cabecalhoTitulo==3)&&($contaTecnica==$totalTc)){
	?>
<tr style="padding: 1px; font-size: 0.8em;">
				<td style="padding: 1px; font-size: 0.8em;" colspan="12">	</td>
				<td><a  style="padding: 1px; font-size: 0.8em;"><img border="0" id="todos05" title="" alt="" src="<?php echo $this->webroot;?>img/accept.png"/></a></td>
				<td><a   style="padding: 1px; font-size: 0.8em;"><img border="0" id="todos06" title="" alt="" src="<?php echo $this->webroot;?>img/accept.png"/></a>
				</td>
				<td colspan="10"></td>
				</tr>
		</table>
</div>
	<?php 
}
 endforeach; 
			//var formulario = $('EscalaAssinarForm');alert('teste');var x =formulario.getInputs();alert(x.inspect());
?>


<script type="text/javascript">
	Event.observe('todos01', 'click', function(event) {
	var formulario = $('EscalaAssinarForm');
	var x =formulario.getInputs('checkbox');
	for(i=0;i<x.size();i++){
		nome = x[i].id; 
		if(nome.startsWith('idimpp')){
		   if(x[i].checked){
		    x[i].checked = false;
		    }else{
		    x[i].checked = true;
		    }
		}
	}
	
     });
     //, false   		

	Event.observe('todos02', 'click', function(event) {
	var formulario = $('EscalaAssinarForm');
	var x =formulario.getInputs('checkbox');
	for(i=0;i<x.size();i++){
		nome = x[i].id; 
		if(nome.startsWith('idimpc')){
		   if(x[i].checked){
		    x[i].checked = false;
		    }else{
		    x[i].checked = true;
		    }
		}
	}

	
     });
     //, false   
	 
	 
	 Event.observe('todoscmtp', 'click', function(event) {
	var formulario = $('EscalaAssinarForm');
	var x =formulario.getInputs('checkbox');
	for(i=0;i<x.size();i++){
		nome = x[i].id; 
		if(nome.startsWith('idcmtp')){
		   if(x[i].checked){
		    x[i].checked = false;
		    }else{
		    x[i].checked = true;
		    }
		}
	}

	
     });
	 
	 Event.observe('todoscmtc', 'click', function(event) {
	var formulario = $('EscalaAssinarForm');
	var x =formulario.getInputs('checkbox');
	for(i=0;i<x.size();i++){
		nome = x[i].id; 
		if(nome.startsWith('idcmtc')){
		   if(x[i].checked){
		    x[i].checked = false;
		    }else{
		    x[i].checked = true;
		    }
		}
	}

	
     });


     //, false   		
</script>

<script language="javascript">

<?php if(!empty($this->data['Escala']['menu'])){echo '$(\''.$this->data['Escala']['menu'].'\').show();';} ?>
</script>
<?php
echo $form->end();
?>
<script language="javascript">
function assinaCmt(pc){
	mesescala=$('EscalaMes').value;
	anoescala=$('EscalaAno').value;
	var id ='<?php echo $id_usuario;?>';
	var mes = <?php echo $this->data['Escala']['mes']; ?>;
	var ano = <?php echo $this->data['Escala']['ano']; ?>;
	var raiz = '<?php echo $this->webroot; ?>escalas/assinar/0/'+id+'/0/0/'+pc+'/cmte/0/0/'+mes+'/'+ano+'/'+mesescala+'/'+anoescala;
	$('EscalaAssinarForm').action = raiz;
	$('EscalaAssinarForm').submit();
}
function autorizaImp(pc){
	mesescala=$('EscalaMes').value;
	anoescala=$('EscalaAno').value;
	var id ='<?php echo $id_usuario;?>';
	var mes = <?php echo $this->data['Escala']['mes']; ?>;
	var ano = <?php echo $this->data['Escala']['ano']; ?>;
	var raiz = '<?php echo $this->webroot; ?>escalas/assinar/0/'+id+'/0/0/'+pc+'/imp/0/0/'+mes+'/'+ano+'/'+mesescala+'/'+anoescala;
	$('EscalaAssinarForm').action = raiz;
	$('EscalaAssinarForm').submit();
}

function visualiza(nomeunico, escalasmonthid){
	mesescala=$('EscalaMes').value;
	anoescala=$('EscalaAno').value;
	var idunico=$(nomeunico).value;
	if(idunico == 0){
		idunico = 1;
		$(nomeunico).value = 1;
	}else{
		idunico = 0;
		$(nomeunico).value = 0;
	}
	var id ='<?php echo $id_usuario;?>';
	var mes = <?php echo $this->data['Escala']['mes']; ?>;
	var ano = <?php echo $this->data['Escala']['ano']; ?>;
	var raiz = '<?php echo $this->webroot; ?>escalas/externovisualiza/'+id+'/'+mesescala+'/'+anoescala+'/'+idunico+'/'+escalasmonthid;
	
	new Ajax.Request(raiz, {
		method: 'get',
		onSuccess: function(transport) {
			var resultado = transport.responseText.evalJSON(true);
			if (resultado.ok==0){
				alert('Não foi modificado! ');
			}else{
				var nome = 'v'+escalasmonthid;
				if(idunico==0){
					$(nome).src = '<?php echo $this->webroot; ?>img/olhoaberto.png';
				}else{
					$(nome).src = '<?php echo $this->webroot; ?>img/olhofechado.png';
				}
				//location.reload(true);
			}
		}
	});
	
}

function right(e) {
if (navigator.appName == 'Netscape' &&
(e.which == 3 || e.which == 2))
return false;
else if (navigator.appName == 'Microsoft Internet Explorer' &&
(event.button == 2 || event.button == 3)) {
alert("Botão direito não pode!");
return false;
}
return true;
}

function Cadeado (id, militar){
		var idescalasmonth = id;
		var idmilitar = militar;
		mesescala=$('EscalaMes').value;
		anoescala=$('EscalaAno').value;
		motivo = window.prompt('Informe (p) ou (c) para desbloquear prevista ou cumprida:');
		data = window.prompt('Informe a nova data limite no formato dd/mm/YYYY:');
		motivo = motivo.toLowerCase();
		if(((motivo=='p')||(motivo=='c'))&&(validaData(data))){
			new Ajax.Request('<?php echo $this->webroot;?>escalas/assinar/'+idescalasmonth+'/'+idmilitar+'/0/0/'+motivo+'/desbloquear/0/'+data+'/'+mesescala+'/'+anoescala, {
				method: 'get',
				onSuccess: function(transport) {
					var resultado = transport.responseText.evalJSON(true);
					if (resultado.ok==0){
						alert('Registro não atualizado! ');
					}else{
						//alert('Registro atualizado! \n'+resultado.mensagem);
						var nome = 'cadeado' + idescalasmonth;
						$(nome).src = '<?php echo $this->webroot; ?>img/cadeadoaberto.gif';
                                                //location.reload(true);
					}
				}
			});
                }else{  
                 	window.confirm('Tente novamente! Digite a opção corretamente!');
       	
		}
}
     //, false   		
HideContent('idrisaer');
HideContent('idoperacional');
HideContent('idtecnica');

</script>