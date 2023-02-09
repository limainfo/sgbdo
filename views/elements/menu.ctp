<? $calendars = $this->requestAction('/calendariorotinas/findCalendarioRotinas/');?>

<div id="qm0" class="qmmc">
 <? foreach ($calendars as $calendar): ?>
	<a href="<?=$this->Html->url('/calendariorotinas/view/'.$calendar['Orgao']['sigla_orgao']);?>"><?=$calendar['Orgao']['sigla_orgao'];?>&nbsp;CINDACTA4</a>
	<div>
	<? foreach ($calendar['Orgao']['Setor'] as $setor): ?>
		<?=$this->Html->link($setor,'/calendariorotinas/view/'.$calendar['Orgao']['sigla_orgao'].'/'.urlencode($setor));?>
		<? endforeach; ?>
	</div>

<? endforeach; ?>
 <? if (!empty($acesso['usuarios'])): ?>
	<a   href="<?=$this->Html->url('/calendariorotinas/view');?>">OPERAÇÕES</a>
	<div>	
		<?=$this->Html->link('Cadastro e Controle do Efetivo','/militars/');?>
		<?=$this->Html->link('Cadastro e Controle de Escalas','/escalas/add');?>
		<?=$this->Html->link('Cadastro e Controle de Cursos','/cursos/');?>
		<?=$this->Html->link('Cadastro de Parâmetros','/parametros/');?>
		<?=$this->Html->link('Cadastro de Rotinas para Calendário','/rotinas/');?>
		<?=$this->Html->link('Indicadores e Controles Gerenciais','/gerentes/');?>
</div>
		<? endif; ?> 

<span class="qmclear">&nbsp;</span></div>

<!-- Create Menu Settings: (Menu ID, Is Vertical, Show Timer, Hide Timer, On Click (options: 'all' * 'all-always-open' * 'main' * 'lev2'), Right to Left, Horizontal Subs, Flush Left, Flush Top) -->
<script type="text/javascript">qm_create(0,false,0,500,false,false,false,false,false);</script>

