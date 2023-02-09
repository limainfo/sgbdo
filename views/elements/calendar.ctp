<?php
//Initialize variables for the element =>
	$firstdate = mktime(0, 0, 0, $data['month'], 1, $data['year']);
	$lastdate = mktime(0, 0, 0, $data['month']+1, 0, $data['year']); 
	$firstday = strftime("%a", $firstdate);

//	if (empty($next)) $next = 1;
//   echo "NEXT".$next."  -- PREV".$prev;
	$proximo = 1;
	
	$days_array = array(
		1=>'Sun', 2=>'Mon', 3=>'Tue', 4=>'Wed', 5=>'Thu', 6=>'Fri', 7=>'Sat',
		8=>'Sun', 9=>'Mon',10=>'Tue',11=>'Wed',12=>'Thu',13=>'Fri',14=>'Sat',
		15=>'Sun',16=>'Mon',17=>'Tue',18=>'Wed',19=>'Thu',20=>'Fri',21=>'Sat',
		22=>'Sun',23=>'Mon',24=>'Tue',25=>'Wed',26=>'Thu',27=>'Fri',28=>'Sat',
		29=>'Sun',30=>'Mon',31=>'Tue',32=>'Wed',33=>'Thu',34=>'Fri',35=>'Sat',
		36=>'Sun',37=>'Mon',38=>'Tue',39=>'Wed',40=>'Thu',41=>'Fri',42=>'Sat'
		);
?> 
<div class="calendar" style="margin-left: 0; margin-bottom: 1em;display: block;z-index:0;">
<table cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<td colspan="7" class="title">
<h1>
<?$data_calendar=date('F Y',$data['stamp']);
$meses_br = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
$meses_en = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
$total=count($meses_br);
for($i=0;$i<$total;$i++){
	$data_calendar=str_replace($meses_en[$i],$meses_br[$i],$data_calendar);
}
echo $data_calendar;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                             <?=($data['orgao'] ? 'Órgão:'.$data['orgao'].' &nbsp;&nbsp; ' : '');?> <?=($data['setor'] ? 'Setor:'.$data['setor'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' : '');?>
</h1><br>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$this->Html->link('Anterior','/calendariorotinas/view/'.$prev);?>&nbsp;|&nbsp;<?=$this->Html->link('Próximo','/calendariorotinas/view/'.$next);?></p>

</td>
		</tr>
		<tr class="daynames">
			<td class="name day weekend">Dom</td>
			<td class="name day">Seg</td>
			<td class="day name">Ter</td>
			<td class="day name">Qua</td>
			<td class="day name">Qui</td>
			<td class="day name">Sex</td>
			<td class="name day weekend">Sáb</td>
		</tr>
	</thead>
	<tbody>
		<tr class="daysrow rowhilite">
<? for ($i=1; $i<=7; $i++){ ?>
<? if ($proximo<=1 && $firstday != $days_array[$i]) : ?>
<td  class="emptycell">&nbsp;</td>
<? else: ?>
<td class="day">
	<?=$calendar->today($proximo,$data['month'],$data['year']);?><br/>
	<?=$calendar->events($data['month'],$proximo,$data['year'],$calendariorotinas);?>
</td>
<? $proximo++;?>
<? endif;?>
<? } ?>
		</tr>
		<tr class="daysrow rowhilite">
<? for ($i=8; $i<=14; $i++){ ?>
<td class="day">
	<?=$calendar->today($proximo,$data['month'],$data['year']);?><br/>
	<?=$calendar->events($data['month'],$proximo,$data['year'],$calendariorotinas);?>
</td>
<? $proximo++;?>
<? } ?>
		</tr>
		<tr class="daysrow rowhilite">
<? for ($i=15; $i<=21; $i++){ ?>
<td class="day">
	<?=$calendar->today($proximo,$data['month'],$data['year']);?><br/>
	<?=$calendar->events($data['month'],$proximo,$data['year'],$calendariorotinas);?>
</td>
<? $proximo++;?>
<? } ?>
		</tr>
		<tr class="daysrow rowhilite">
<? for ($i=22; $i<=28; $i++){ ?>
<? if (strftime("%d",$lastdate) < $proximo): ?>
<td  class="emptycell">&nbsp;</td>
<? else: ?>
<td class="day">
	<?=$calendar->today($proximo,$data['month'],$data['year']);?><br/>
	<?=$calendar->events($data['month'],$proximo,$data['year'],$calendariorotinas);?>
</td>
<? $proximo++;?>
<? endif; ?>
<? } ?>
		</tr>
		<tr class="daysrow rowhilite">
<? for ($i=29; $i<=35; $i++){ ?>
<? if (strftime("%d",$lastdate) < $proximo): ?>
<td  class="emptycell">&nbsp;</td>
<? else: ?>
<td class="day">
	<?=$calendar->today($proximo,$data['month'],$data['year']);?><br/>
	<?=$calendar->events($data['month'],$proximo,$data['year'],$calendariorotinas);?>
</td>
<? $proximo++;?>
<? endif; ?>
<? } ?>
		</tr>
		
<? if ($proximo < strftime("%d",$lastdate)): /* check if there is a sixth line */?>
<tr class="daysrow rowhilite">
<? for ($i=36; $i<=42; $i++){ ?>
<? if (strftime("%d",$lastdate) < $proximo): ?>
<td  class="emptycell">&nbsp;</td>
<? else: ?>
<td class="day">
	<?=$calendar->today($proximo,$data['month'],$data['year']);?><br/>
	<?=$calendar->events($data['month'],$proximo,$data['year'],$calendariorotinas);?>
</td>
<? $proximo++;?>
<? endif; ?>
<? } ?>
</tr>
<? endif;?>
	</tbody>
	<tfoot>
		<tr class="footrow">
			<td colspan="8" class="ttip">&nbsp;</td>
		</tr>
	</tfoot>
</table>
</div>
