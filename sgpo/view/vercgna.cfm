<cfquery datasource="#dsn#" name="setor">
	select * from sgpo_cgna sc inner join sgpo_setores ss on (ss.setorID=sc.setorID) where sc.cgnaID='#form.id#';
</cfquery>
<cfscript>
	//dump(setor);
	pc = conteudoconsulta.cargamensal;
	total = 0;
	vetor=ArrayNew();
	novoturno=StructNew();
	conta = 1;
	qtdturnos = 0;
	for(h=0;h lt 24;h=h+1){
		for(m=0;m lte 50;m=m+30){
			inicio = CreateTime(h,m,0);
			fim = CreateTime(h,m+29,0);
			vetor[conta]=StructNew();
			
			
			StructInsert(vetor[conta], "hora", timeformat(inicio,'HH:mm'),"TRUE");
			StructInsert(vetor[conta], "consoles",0 ,"TRUE");
			for(q=1;q lte setor.recordcount;q=q+1){
				for(ev=1;ev lte 4;ev=ev+1){
					dinicio = CreateTime(hour(evaluate("setor['inicio0" & ev & "'][q]")),minute(evaluate("setor['inicio0" & ev & "'][q]")),0);
					dfim = CreateTime(hour(evaluate("setor['fim0" & ev & "'][q]")),minute(evaluate("setor['fim0" & ev & "'][q]")),0);
					dif1=datediff('n',inicio,dinicio);
					dif2=datediff('n',fim,dfim);
					dif3=datediff('n',fim,dinicio);
					dif4=datediff('n',inicio,dfim);
					dif5=datediff('n',dinicio,dfim);
					if( (dif1 lte 0 and dif3 lte 0 and dif4 gt 0 and dif2 gt 0) ){
						vetor[conta]["consoles"]=evaluate("setor['console0" & ev & "'][q]")+vetor[conta]["consoles"];
					}
					if(  (dif2 lt 0 and dif4 lt 0 and dif1 lte 0 and dif3 lt 0 and dif5 lt 0 ) or ( dif2 gt 0 and dif4 gte 0 and dif1 gt 0 and dif3 gt 0 and dif5 lt 0 ) ){
						vetor[conta]["consoles"]=evaluate("setor['console0" & ev & "'][q]")+vetor[conta]["consoles"];
					}
					
				}
				
			}
			
			conta = conta + 1;
		}
	}
			consoles=ArrayNew();
			picos=ArrayNew();
			inicios=ArrayNew();
			finais=ArrayNew();
			novosinicios=ArrayNew();
			novosfinais=ArrayNew();
			n=ArrayNew();
			eo=ArrayNew();
			l=ArrayNew();
			h=ArrayNew();
			m=ArrayNew();
			ef=ArrayNew();
			efs=ArrayNew();
			duracao=ArrayNew();
			duracaoh=ArrayNew();
			
			vetor[conta]=StructNew();
			StructInsert(vetor[conta], "hora", timeformat(inicio,'HH:mm'),"TRUE");
			StructInsert(vetor[conta], "consoles",0 ,"TRUE");
			for(q=1;q lte setor.recordcount;q=q+1){
				for(ev=1;ev lte 4;ev=ev+1){
					dinicio = CreateTime(hour(evaluate("setor['inicio0" & ev & "'][q]")),minute(evaluate("setor['inicio0" & ev & "'][q]")),0);
					dfim = CreateTime(hour(evaluate("setor['fim0" & ev & "'][q]")),minute(evaluate("setor['fim0" & ev & "'][q]")),0);
					dif1=datediff('n',inicio,dinicio);
					dif2=datediff('n',fim,dfim);
					dif3=datediff('n',fim,dinicio);
					dif4=datediff('n',inicio,dfim);
					dif5=datediff('n',dinicio,dfim);
					if( (dif1 lte 0 and dif3 lte 0 and dif4 gt 0 and dif2 gt 0) ){
						vetor[conta]["consoles"]=evaluate("setor['console0" & ev & "'][q]")+vetor[conta]["consoles"];
					}
					if(  (dif2 lt 0 and dif4 lt 0 and dif1 lte 0 and dif3 lt 0 and dif5 lt 0 ) or ( dif2 gt 0 and dif4 gte 0 and dif1 gt 0 and dif3 gt 0 and dif5 lt 0 ) ){
						vetor[conta]["consoles"]=evaluate("setor['console0" & ev & "'][q]")+vetor[conta]["consoles"];
					}
					consoles[ev] = evaluate("setor['console0" & ev & "'][q]");
					picos[ev] = evaluate("setor['pico0" & ev & "'][q]");
					inicios[ev] = evaluate("setor['inicio0" & ev & "'][q]");
					finais[ev] = evaluate("setor['fim0" & ev & "'][q]");
					novosinicios[ev] = evaluate("setor['inicio0" & ev & "'][q]");
					novosfinais[ev] = evaluate("setor['fim0" & ev & "'][q]");
					duracao[ev]=0;
					duracaoh[ev]=0;
					n[ev]=0;
					eo[ev]=0;
					l[ev]=0;
					h[ev]=0;
					m[ev]=0;
					ef[ev]=0;
					efs[ev]=0;
				}
				
			}
	
	StructInsert(novoturno, "console", consoles,"TRUE");
	StructInsert(novoturno, "pico", picos,"TRUE");
	StructInsert(novoturno, "inicio", inicios,"TRUE");
	StructInsert(novoturno, "fim", finais,"TRUE");
	StructInsert(novoturno, "novoinicio", novosinicios,"TRUE");
	StructInsert(novoturno, "novofim", novosfinais,"TRUE");
	StructInsert(novoturno, "duracao", duracao,"TRUE");
	StructInsert(novoturno, "duracaoh", duracaoh,"TRUE");
	StructInsert(novoturno, "n", n,"TRUE");
	StructInsert(novoturno, "eo", eo,"TRUE");
	StructInsert(novoturno, "l", l,"TRUE");
	StructInsert(novoturno, "h", h,"TRUE");
	StructInsert(novoturno, "m", m,"TRUE");
	StructInsert(novoturno, "ef", ef,"TRUE");
	StructInsert(novoturno, "efs", efs,"TRUE");
	min30 = CreateTime(0,30,0);
	for(a=1;a lte 4;a=a+1){
			if( (hour(novoturno.novoinicio[a])*60 + minute(novoturno.novoinicio[a])) gt (hour(novoturno.novofim[a])*60 + minute(novoturno.novofim[a])) ){
				novoturno.duracao[a] = (hour(novoturno.novoinicio[a])*60 + minute(novoturno.novoinicio[a])) -12*60 - (hour(novoturno.novofim[a])*60 + minute(novoturno.novofim[a]));
			}else{
				novoturno.duracao[a] = (hour(novoturno.novofim[a])*60 + minute(novoturno.novofim[a]))  - (hour(novoturno.novoinicio[a])*60 + minute(novoturno.novoinicio[a]));
			}
			novoturno.duracaoh[a]= novoturno.duracao[a]/60;
			novoturno.eo[a] = novoturno.duracaoh[a]+0.25;
			if (novoturno.duracaoh[a] gt 6){
				//120 minutos na console - valor padrão de PC
				novoturno.n[a] = ceiling(((60/120)+1)*novoturno.console[a]*2);
				}else{
				novoturno.n[a] = ceiling(((30/120)+1)*novoturno.console[a]*2);
			}
		if(novoturno.pico[a] eq '1'){
			nhora = 0;
			nminuto = 0;
			ntempo = hour(novoturno.novoinicio[a])*60 +minute(novoturno.novoinicio[a]) - 30;
			nhora = ntempo / 60;
			nminuto = ntempo mod 60;
			novoturno.novoinicio[a] = CreateTime(nhora, nminuto,0);
			for(b=1;b lte 4;b++){
				if(novoturno.inicio[a] eq novoturno.novofim[b]){
					novoturno.novofim[b] = novoturno.novoinicio[a];
				}
				if( (hour(novoturno.novoinicio[b])*60 + minute(novoturno.novoinicio[b])) gt (hour(novoturno.novofim[b])*60 + minute(novoturno.novofim[b])) ){
					novoturno.duracao[b] = (hour(novoturno.novoinicio[b])*60 + minute(novoturno.novoinicio[b])) -12*60 - (hour(novoturno.novofim[b])*60 + minute(novoturno.novofim[b]));
				}else{
					novoturno.duracao[b] = (hour(novoturno.novofim[b])*60 + minute(novoturno.novofim[b]))  - (hour(novoturno.novoinicio[b])*60 + minute(novoturno.novoinicio[b]));
				}
				novoturno.duracaoh[b]= novoturno.duracao[b]/60;
				novoturno.eo[b] = novoturno.duracaoh[b]+0.25;
				if (novoturno.duracaoh[b] gt 6){
					//120 minutos na console - valor padrão de PC
					novoturno.n[b] = ceiling(((60/120)+1)*novoturno.console[b]*2);
					}else{
					novoturno.n[b] = ceiling(((30/120)+1)*novoturno.console[b]*2);
				}
			}
		}
	if (novoturno.duracaoh[a] gt 0){
		qtdturnos = qtdturnos + 1;
	}
	total=total+novoturno.n[a];
				
	}
	dados = vetor[1]['consoles'];
	horas = "'" & vetor[1]['hora'] & "'";
	for(t=2;t lte ArrayLen(vetor);t=t+1){
		dados = dados & ',' & vetor[t]['consoles'];
		horas = horas & ',' & "'" & vetor[t]['hora'] & "'";
	}
	turnos = ArrayNew();
	for(t=1;t lte 4;t=t+1){
		turnos[t] = StructNew();
		turnos[t]['inicio']=evaluate("setor['inicio0" & t & "'][1]");
		turnos[t]['fim']=evaluate("setor['fim0" & t & "'][1]");
		turnos[t]['pico']=evaluate("setor['pico0" & t & "'][1]");
	}
	
//	dump(novoturno);
//	dump(dados);
	//((DATEDIFF(dtbd,'dinicio') gte 0 or DATEDIFF(dtbd,'dinicio') lte 0) and DATEDIFF(dtbd,'dfim') lte 0) and  (DATEDIFF(dtbd,'dinicio') gte 0)
</cfscript>
<style>
div#turno table {
    color: #000000;
    empty-cells: show;
    font-family: Verdana,Geneva,Arial,Helvetica,sans-serif;
    font-size: 11px;
}
div#turno td {
    border: 1px solid #000000;
    empty-cells: show;
    padding: 2px;
    vertical-align: top;
}
td.conteudo {
    background-color: #FFCC99;
}
td.titulo {
    background-color: #9999FF;
}
td.coluna {
    background-color: #99CC33;
}

</style>
<cfoutput>

<cfloop query="conteudoconsulta"></cfloop>
<script src="js/highcharts.js"></script>
<script src="js/modules/exporting.js"></script>
	<div id="accordion" >
	<h3>PLANEJAMENTO DA DEMANDA (CGNA)</h3>
	<div>
<div id="container" style="min-width: 50%; height: 50%; margin: 0 auto"></div>
		
		</p>
	</div>
	<h3>DEFINIÇÃO DOS TURNOS</h3>
	<div>
		<p>
		<div id="turno">
		<table>
		<tr ><td class="titulo">TURNOS</td><td class="titulo">HORÁRIO ORIGINAL</td><td class="titulo">NOVO HORÁRIO</td><td class="titulo">PICO</td><td class="titulo">DURAÇÃO</td></tr>
		<cfloop from="1" to="4" index="c">
		<tr ><td class="coluna">#c#&deg; </td><td class="conteudo">#timeformat(novoturno.inicio[c],'HH:mm')#-#timeformat(novoturno.fim[c],'HH:mm')#</td><td class="conteudo">#timeformat(novoturno.novoinicio[c],'HH:mm')#-#timeformat(novoturno.novofim[c],'HH:mm')#</td><td class="coluna">#novoturno.pico[c]#</td><td class="coluna">#(novoturno.duracaoh[c])#h</td></tr>
		</cfloop>
		
		</table>
		
		</div>
		
		</p>
	</div>
	<h3>NÚMERO DE CONTROLADORES POR TURNO DE SERVIÇO</h3>
	<div>
		<p>
		<div id="turno">
		<table>
		<tr ><td class="titulo">TURNOS</td><td class="titulo">N=[(D/PC)+1]* C * ATCO</td><td class="titulo">Quantidade</td></tr>
		<cfloop from="1" to="4" index="c">
		<tr ><td class="coluna">#c#&deg;->#timeformat(novoturno.novoinicio[c],'HH:mm')#-#timeformat(novoturno.novofim[c],'HH:mm')# </td><td class="conteudo">[(<cfif novoturno.duracao[c]/60 gt 6>60<cfelse>30</cfif>/120)+1]*#novoturno.console[c]#*2</td><td class="conteudo">#novoturno.n[c]#</td></tr>
		</cfloop>
		<tr ><td ></td><td ></td><td class="titulo"><b>#total#</b></td></tr>
		
		</table>
		
		</div>
		</p>
	</div>
	<h3>ENVOLVIMENTO OPERACIONAL (EO)</h3>
	<div>
		<p>
		<div id="turno">
		<table>
		<tr ><td class="titulo">TURNOS</td><td class="titulo">HORÁRIO ORIGINAL</td><td class="titulo">NOVO HORÁRIO</td><td class="titulo">PICO</td><td class="titulo">DURAÇÃO</td><td class="titulo">ACRÉSCIMO</td><td class="titulo">SOMA</td></tr>
		<cfset somaeo=0>
		<cfloop from="1" to="4" index="c">
		<tr ><td class="coluna">#c#&deg; </td><td class="conteudo">#timeformat(novoturno.inicio[c],'HH:mm')#-#timeformat(novoturno.fim[c],'HH:mm')#</td><td class="conteudo">#timeformat(novoturno.novoinicio[c],'HH:mm')#-#timeformat(novoturno.novofim[c],'HH:mm')#</td><td class="coluna">#novoturno.pico[c]#</td><td class="coluna">#(novoturno.duracaoh[c])#h</td><td class="coluna">15 min</td><td class="coluna">#novoturno.eo[c]#</td></tr>
		<cfset somaeo= somaeo + novoturno.eo[c] >
		</cfloop>
		<tr ><td ></td><td ></td><td ></td><td></td><td ></td><td></td><td class="titulo"><b>#somaeo#h</b></td></tr>
		
		</table>
		
		</div>
		</p>
	</div>
	<h3>NÚMERO DE LEGENDAS POR MÊS (L)</h3>
	<div>
		<p>
		<div id="turno">
		<table>
		<cfset somal30 = total*30>
		<cfset somal31 = total*31>
		<tr ><td class="titulo">L = TOTAL DE CONTROLADORES POR DIA * 30</td><td class="conteudo">L = #total#*30 = #somal30#</td></tr>
		<tr ><td class="titulo">L = TOTAL DE CONTROLADORES POR DIA * 31</td><td class="conteudo">L = #total#*31 = #somal31#</td></tr>
		</table>
		</div>
		</p>
	</div>
	<h3>MÉDIA DE ENVOLVIMENTO OPERACIONAL DIÁRIO (H)</h3>
	<div>
		<p>
		<div id="turno">
		<table>
		<tr ><td class="titulo">H = EO / NÚMERO DE TURNOS</td><td class="conteudo">H = #somaeo#/#qtdturnos# = #somaeo/qtdturnos#</td></tr>
		<cfset somah30 = somaeo/qtdturnos>
		<cfset somah31 = somaeo/qtdturnos>
		</table>
		</div>
		</p>
	</div>
	<h3>NÚMERO DE DIAS ENVOLVIDOS EM ESCALA OPERACIONAL (M), CONSIDERANDO UMA CARGA MENSAL DE #pc#H</h3>
	<div>
		<p>
		<div id="turno">
		<table>
		<cfset somam30 = pc/somah30>
		<cfset somam31 = pc/somah31>
		<tr ><td class="titulo">M = #pc# / H</td><td class="conteudo">M = #pc#/#somah30# = #somam30#</td></tr>
		<tr ><td class="titulo">M = #pc# / H</td><td class="conteudo">M = #pc#/#somah31# = #somam31#</td></tr>
		</table>
		</div>		
		</p>
	</div>
	<h3>EFETIVO DE CONTROLADORES NO ÓRGÃO ATC PARA O SERVIÇO OPERACIONAL (EF)</h3>
	<div>
		<p>
		<div id="turno">
		<table>
		<cfset somaef30 = somal30/somam30 >
		<cfset somaef31 = somal31/somam31 >
		<tr ><td class="titulo">EF = (L/M)</td><td class="conteudo">EF = (#somal30#/#somam30#) = #somaef30#</td></tr>
		<tr ><td class="titulo">EF = (L/M)</td><td class="conteudo">EF = (#somal31#/#somam31#) = #somaef31#</td></tr>
		</table>
		</div>
		</p>
	</div>
	<h3>EFETIVO DE SEGURANÇA (EFS)</h3>
	<div>
		<p>
		<div id="turno">
		<table>
		<cfset somaefs30 = somaef30*1.2 >
		<cfset somaefs31 = somaef31*1.2 >
		<cfset somaefs30a = ceiling(somaefs30) >
		<cfset somaefs31a = ceiling(somaefs31) >
		<tr ><td class="titulo">EFS = EF x 1,20 (FATOR DE SEGURANÇA 20% ICA 100-30)</td><td class="conteudo">EFS = (#somaef30#*1.2) = #somaefs30# =#somaefs30a#</td></tr>
		<tr ><td class="titulo">EFS = EF x 1,20 (FATOR DE SEGURANÇA 20% ICA 100-30)</td><td class="conteudo">EFS = (#somaef31#*1.2) = #somaefs31# =#somaefs31a#</td></tr>
		</table>
		</div>
		</p>
	</div>
	<h3>NÚMERO DE CONTROLADORES POR EQUIPE</h3>
	<div>
		<p>
		<div id="turno">
		<cfset ferias30 = ceiling(somaefs30a/12) >
		<cfset equipe30 = fix((somaefs30a-ferias30)/6) >
		<cfset ferias30 = somaefs30a - equipe30*6 >
		<cfset decrementa = ferias30 >
		<cfset vetorequipe=ArrayNew() >
		<cfloop from=1 to=6 index="ii">
			<cfset vetorequipe[ii] = 0 >
		</cfloop>
		<cfset conta = 1>
		<cfloop condition="decrementa gt 0">
			<cfset decrementa = decrementa - 1>
			<cfif conta eq 7>
				<cfset conta = 1>
			</cfif>
			<cfset vetorequipe[conta] = vetorequipe[conta] + 1 >
			<cfset conta = conta + 1>
		</cfloop>
		
		<table>
		<tr><td>
		<table>
		<tr ><td class="titulo" colspan="2">MÁXIMO 6 EQUIPES COM #ferias30# FÉRIAS - #somaefs30a# para 30 DIAS</td></tr>
		<tr ><td class="titulo">EQUIPE A</td><td class="conteudo">#equipe30# ATCO + #vetorequipe[1]# FÉRIAS</td></tr>
		<tr ><td class="titulo">EQUIPE B</td><td class="conteudo">#equipe30# ATCO + #vetorequipe[2]# FÉRIAS</td></tr>
		<tr ><td class="titulo">EQUIPE C</td><td class="conteudo">#equipe30# ATCO + #vetorequipe[3]# FÉRIAS</td></tr>
		<tr ><td class="titulo">EQUIPE D</td><td class="conteudo">#equipe30# ATCO + #vetorequipe[4]# FÉRIAS</td></tr>
		<tr ><td class="titulo">EQUIPE E</td><td class="conteudo">#equipe30# ATCO + #vetorequipe[5]# FÉRIAS</td></tr>
		<tr ><td class="titulo">EQUIPE F</td><td class="conteudo">#equipe30# ATCO + #vetorequipe[6]# FÉRIAS</td></tr>
		<cfset total30 = equipe30*6 >
		<tr ><td ><b>TOTAL</b></td><td ><b>#total30# + #ferias30# = #somaefs30a# </b></td></tr>
		</table>
		</td><td>
		<table>
		<cfset ferias31 = ceiling(somaefs31a/12) >
		<cfset equipe31 = fix((somaefs31a-ferias31)/6) >
		<cfset ferias31 = somaefs31a - equipe31*6 >
		<cfset decrementa = ferias31 >
		<cfloop from=1 to=6 index="ii">
			<cfset vetorequipe[ii] = 0 >
		</cfloop>
		<cfset conta = 1>
		<cfloop condition="decrementa gt 0">
			<cfset decrementa = decrementa - 1>
			<cfif conta eq 7>
				<cfset conta = 1>
			</cfif>
			<cfset vetorequipe[conta] = vetorequipe[conta] + 1 >
			<cfset conta = conta + 1>
		</cfloop>
		<tr ><td class="titulo" colspan="2">MÁXIMO 6 EQUIPES COM #ferias31# FÉRIAS - #somaefs31a# para 31 DIAS</td></tr>
		<tr ><td class="titulo">EQUIPE A</td><td class="conteudo">#equipe31# ATCO + #vetorequipe[1]# FÉRIAS</td></tr>
		<tr ><td class="titulo">EQUIPE B</td><td class="conteudo">#equipe31# ATCO + #vetorequipe[2]# FÉRIAS</td></tr>
		<tr ><td class="titulo">EQUIPE C</td><td class="conteudo">#equipe31# ATCO + #vetorequipe[3]# FÉRIAS</td></tr>
		<tr ><td class="titulo">EQUIPE D</td><td class="conteudo">#equipe31# ATCO + #vetorequipe[4]# FÉRIAS</td></tr>
		<tr ><td class="titulo">EQUIPE E</td><td class="conteudo">#equipe31# ATCO + #vetorequipe[5]# FÉRIAS</td></tr>
		<tr ><td class="titulo">EQUIPE F</td><td class="conteudo">#equipe31# ATCO + #vetorequipe[6]# FÉRIAS</td></tr>
		<cfset total31 = equipe31*6 >
		<tr ><td ><b>TOTAL</b></td><td ><b>#total31# + #ferias31# = #somaefs31a# </b></td></tr>
		</table>
		</td>
		</tr>
		</table>
		<table>
		<tr><td colspan="31" class="titulo">SOMATÓRIO DE HORAS COM ALTERNÂNCIA DE TURNOS DURANTE 31 DIAS</td></tr>
		<tr>
		<cfloop from=1 to=31 index="dias">
			<td class="titulo">#dias#</td>
		</cfloop>
		</tr>
		<cfset indice = 1>
		<cfloop from=1 to=31 index="dias">
			<td class="coluna">#indice#&deg;T</td>
			<cfset indice = indice + 1>
			<cfif indice gt 4><cfset indice = 1></cfif>
		</cfloop>
		</tr>
		<cfset indice = 1>
		<cfset soma = 0>
		<cfloop from=1 to=31 index="dias">
			<td class="conteudo">#soma=soma+novoturno.duracaoh[indice]#</td>
			<cfset indice = indice + 1>
			<cfif indice gt 4><cfset indice = 1></cfif>
		</cfloop>
		</tr>
		</table>
		
		</div>
		</p>
	</div>
	<h3>CÁLCULO DO EFETIVO DE SUPERVISORES E COORDENADORES CONFORME ICA 100-30</h3>
	<div>
		<p>
		<div id="turno">
		<cfset coord30 = 0 >
		<cfset coordef30 = 0 >
		<cfset coord31 = 0 >
		<cfset coordef31 = 0 >
		<table>
		<tr><td>
		<table>
		<tr ><td class="titulo" colspan="6">1 COORDENADOR PARA CADA 3 A 5 CONSOLES para 30 DIAS - PC=#pc#</td></tr>
		<tr ><td class="coluna" colspan="2">TURNOS</td><td class="coluna">C</td><td class="coluna">DUR</td><td class="coluna">COORD</td><td class="coluna">EF.</td></tr>
		<cfloop from="1" to="4" index="c">
		<tr ><td class="coluna">#c#&deg; </td><td class="conteudo">#timeformat(novoturno.novoinicio[c],'HH:mm')#-#timeformat(novoturno.novofim[c],'HH:mm')#</td><td class="conteudo">#novoturno.console[c]#</td><td class="conteudo">#(novoturno.duracaoh[c])#h</td><td class="conteudo">#fix(novoturno.console[c]/3)#</td><td class="titulo">#fix(novoturno.console[c]/3)*30*novoturno.console[c]/pc#</td></tr>
		<cfset coord30 = coord30 + fix(novoturno.console[c]/3) >
		<cfset coordef30 = coordef30 + fix(novoturno.console[c]/3)*30*novoturno.console[c]/pc >
		</cfloop>
		<tr ><td colspan="4"></td><td ><b>TOTAL</b></td><td ><b>#coordef30# = #coordef30=ceiling(coordef30)# </b></td></tr>
		</table>
		</td><td>
		<table>
		<tr ><td class="titulo" colspan="6">1 COORDENADOR PARA CADA 3 A 5 CONSOLES para 31 DIAS - PC=#pc#</td></tr>
		<tr ><td class="coluna" colspan="2">TURNOS</td><td class="coluna">C</td><td class="coluna">DUR</td><td class="coluna">COORD</td><td class="coluna">EF.</td></tr>
		<cfloop from="1" to="4" index="c">
		<tr ><td class="coluna">#c#&deg; </td><td class="conteudo">#timeformat(novoturno.novoinicio[c],'HH:mm')#-#timeformat(novoturno.novofim[c],'HH:mm')#</td><td class="conteudo">#novoturno.console[c]#</td><td class="conteudo">#(novoturno.duracaoh[c])#h</td><td class="conteudo">#fix(novoturno.console[c]/3)#</td><td class="titulo">#fix(novoturno.console[c]/3)*31*novoturno.console[c]/pc#</td></tr>
		<cfset coord31 = coord31 + fix(novoturno.console[c]/3) >
		<cfset coordef31 = coordef31 + fix(novoturno.console[c]/3)*31*novoturno.console[c]/pc >
		</cfloop>
		<tr ><td colspan="4"></td><td ><b>TOTAL</b></td><td ><b>#coordef31# = #coordef31=ceiling(coordef31)# </b></td></tr>
		</table>
		</td>
		</tr>
		</table>
		<cfset sup30 = 0 >
		<cfset supc30 = 0 >
		<cfset supef30 = 0 >
		<cfset sup31 = 0 >
		<cfset supc31 = 0 >
		<cfset supef31 = 0 >
		<table>
		<tr><td>
		<table>
		<tr ><td class="titulo" colspan="6">1 SUPERVISOR PARA MAIS DE 3 CONSOLES para 30 DIAS - PC=#pc#</td></tr>
		<tr ><td class="coluna" colspan="2">TURNOS</td><td class="coluna">C</td><td class="coluna">DUR</td><td class="coluna">SUP</td><td class="coluna">EF.</td></tr>
		<cfloop from="1" to="4" index="c">
		<cfif fix(novoturno.console[c]/3) gt 0>
		<cfset supc30 = 1 >
		<cfelse>
		<cfset supc30 = 0 >
		</cfif>
		<tr ><td class="coluna">#c#&deg; </td><td class="conteudo">#timeformat(novoturno.novoinicio[c],'HH:mm')#-#timeformat(novoturno.novofim[c],'HH:mm')#</td><td class="conteudo">#novoturno.console[c]#</td><td class="conteudo">#(novoturno.duracaoh[c])#h</td><td class="conteudo">#supc30#</td><td class="titulo">#supc30*30*novoturno.console[c]/pc#</td></tr>
		<cfset sup30 = sup30 + supc30 >
		<cfset supef30 = supef30 + supc30*30*novoturno.console[c]/pc >
		</cfloop>
		<tr ><td colspan="4"></td><td ><b>TOTAL</b></td><td ><b>#supef30# = #supef30=ceiling(supef30)# </b></td></tr>
		<cfset efcoordsup30 = supef30 + coordef30 + ceiling(supef30 + coordef30)*0.15 >
		<tr ><td colspan="5"><b>TOTAL DE SUPERVISORES E COORDENADORES+15%</b></td><td><b>#efcoordsup30# </b></td></tr>
		</table>
		</td><td>
		<table>
		<tr ><td class="titulo" colspan="6">1 SUPERVISOR PARA MAIS DE 3 CONSOLES para 31 DIAS - PC=#pc#</td></tr>
		<tr ><td class="coluna" colspan="2">TURNOS</td><td class="coluna">C</td><td class="coluna">DUR</td><td class="coluna">SUP</td><td class="coluna">EF.</td></tr>
		<cfloop from="1" to="4" index="c">
		<cfif fix(novoturno.console[c]/3) gt 0>
		<cfset supc31 = 1 >
		<cfelse>
		<cfset supc31 = 0 >
		</cfif>
		<tr ><td class="coluna">#c#&deg; </td><td class="conteudo">#timeformat(novoturno.novoinicio[c],'HH:mm')#-#timeformat(novoturno.novofim[c],'HH:mm')#</td><td class="conteudo">#novoturno.console[c]#</td><td class="conteudo">#(novoturno.duracaoh[c])#h</td><td class="conteudo">#supc31#</td><td class="titulo">#supc31*31*novoturno.console[c]/pc#</td></tr>
		<cfset sup31 = sup31 + supc31 >
		<cfset supef31 = supef31 + supc31*31*novoturno.console[c]/pc >
		</cfloop>
		<tr ><td colspan="4"></td><td ><b>TOTAL</b></td><td ><b>#supef31# = #supef31=ceiling(supef31)# </b></td></tr>
		<cfset efcoordsup31 = supef31 + coordef31 + ceiling(supef31 + coordef31)*0.15 >
		<tr ><td colspan="5"><b>TOTAL DE SUPERVISORES E COORDENADORES+15%</b></td><td><b>#efcoordsup31# </b></td></tr>
		</table>
		</td>
		</tr>
		</table>
		
		
		<cfset apoio = 0 >
		<table>
		<tr><td>
		<table>
		<tr ><td class="titulo" colspan="2">EFETIVO DE APOIO RECOMENDADO</td></tr>
		<tr ><td class="coluna">ADJUNTO</td><td class="conteudo">1</td></tr>
		<tr ><td class="coluna">TSCEA</td><td class="conteudo">1</td></tr>
		<tr ><td class="coluna">FMC</td><td class="conteudo">0</td></tr>
		<tr ><td class="coluna">GBDS</td><td class="conteudo">0</td></tr>
		<tr ><td class="coluna">ADJ SIATO</td><td class="conteudo">1</td></tr>
		<tr ><td ><b>TOTAL</b></td><td ><b>3</b></td></tr>
		<tr ><td ><b>TOTAL+15%</b></td><td ><b>#apoio=3+3*0.15#</b></td></tr>
		</table>
		</td><td>
		<table>
		<tr ><td class="titulo" colspan="2">CÁLCULO DO EFETIVO PARA 30 DIAS</td></tr>
		<tr ><td class="coluna">APOIO+COORD+SUP</td><td class="conteudo">#apoio#+#coordef30#+#supef30#=#efcoordsup30+apoio#=<b>#ceiling(efcoordsup30+apoio)#</b></td></tr>
		<tr ><td class="coluna">ATCO</td><td class="conteudo"><b>#somaefs30a#</b></td></tr>
		<tr ><td ><b>TOTAL</b></td><td style="color:##fff;background-color:red;font-size:32px;"><b>#somaefs30a+ceiling(efcoordsup30+apoio)#</b></td></tr>
		<cfset tlp = somaefs30a+ceiling(efcoordsup30+apoio) >
		<tr ><td class="titulo" colspan="2">CÁLCULO DO EFETIVO PARA 31 DIAS</td></tr>
		<tr ><td class="coluna">APOIO+COORD+SUP</td><td class="conteudo">#apoio#+#coordef31#+#supef31#=#efcoordsup31+apoio#=<b>#ceiling(efcoordsup31+apoio)#</b></td></tr>
		<tr ><td class="coluna">ATCO</td><td class="conteudo"><b>#somaefs31a#</b></td></tr>
		<tr ><td ><b>TOTAL</b></td><td  style="color:##fff;background-color:red;font-size:32px;"><b>#somaefs31a+ceiling(efcoordsup31+apoio)#</b></td></tr>
		</table>
		</td>
		</tr>
		</table>
		
		</div>
		</p>
	</div>

</cfoutput>

	<script>
	$(function() {
		var icons = {
			header: "ui-icon-circle-arrow-e",
			activeHeader: "ui-icon-circle-arrow-s"
		};
		$( "#accordion" ).accordion({
			icons: icons,
			heightStyle: "content",
			collapsible: true
		});
		$( "#toggle" ).button().click(function() {
			if ( $( "#accordion" ).accordion( "option", "icons" ) ) {
				$( "#accordion" ).accordion( "option", "icons", null );
			} else {
				$( "#accordion" ).accordion( "option", "icons", icons );
			}
		});
   var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'area'
            },
            title: {
                text: 'DEMANDA DE MOVIMENTOS AÉREOS NA REGIÃO <cfoutput>#setor.nome#</cfoutput>'
            },
            subtitle: {
                text: 'Fonte: ICA 100-25/2008 Pág. 11'
            },
            xAxis: {
				type: 'datetime',
                title: {
                    text: 'HORÁRIO'
                },
				formatter: function() {return Highcharts.dateFormat('%a %d %b', this.value);},
            },
            yAxis: {
                title: {
                    text: 'NÚMERO DE CONSOLES'
                },
                labels: {
                    formatter: function() {
                        return this.value;
                    }
                }
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+Highcharts.numberFormat(this.y, 0)+'</b> ' + this.series.name +' no horário <b>'+
                        Highcharts.dateFormat('%H:%M ', this.x) +'</b>' ;
                }
            },
            plotOptions: {
                area: {
                    pointStart: 0,
                    marker: {
                        enabled: true,
                        symbol: 'diamond',
                        radius: 5,
                        states: {
                            hover: {
                                enabled: true
                            }
                        }
                    }
                }
            },
            series: [{
                name: 'CONSOLE(S)',
                data: [<cfoutput>#dados#</cfoutput> ],
                pointStart: Date.UTC(2012, 8, 12),
				pointInterval: 1800 * 1000 
            }]
        });
    });		
	});
</script>
<br><br><br><br>
