<cfif not StructKeyExists(session,"id") >
		<cfset status='ERRO'>
		<cfset mensagemstatus='O tempo da conexão terminou. <a href="../../../../../id/?i=logout&appID=#app.appID#">Log in novamente.</a>' >
		<cfinclude template="../view/fimsessao.cfm">
		<cfabort>		
</cfif>
<cfset id=CreateUUID()>
<cfparam name="Form.controller" default="">	
<cfparam name="conteudoconsulta" default="">	
<cfset controllernome='cgna' >
<cfset controllernomeid='cgnaID' >
<cfset controllernomeplural='cgna' >
<cfset controllernomecampo='Cgna' >
<cfparam name="url.pesquisa" default="">
<cfset url.i="Cgna">
<cfscript>
//<!-- -------------------------Cgna--------------------------  -->
//<!-- -------------------------list--------------------------  -->
</cfscript>
<cfif Form.controller=='cgna' and Form.action=='list' and evaluate('acoes.'& controllernomeplural & '["list"]')==1 >
	<cfset url.acao="list">
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cfparam name="completasql" default="">
	<cfset url.pesquisa = urldecode(url.pesquisa) >
	<cftry>	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
				select *, concat(ur.jurisdicao,' ',ur.nome,' ',ss.nome,' ',ss.regiao) as regional from sgpo_cgna sc
				inner join sgpo_setores ss on (ss.setorID=sc.setorID #sqlSetorID#)
				inner join unidades_regionais ur on (ss.regionalID=ur.regionalID #sqlRegionalID#)
				inner join unidades u on (ur.unidadeID=u.unidadeID #sqlUnidadeID#)
				 where sc.deleted is null  order by sc.updated desc, sc.created desc;
		</cfquery>
	<cfcatch type="any">
		<cfset status='ERRO'>
		<cfset conteudo=''>
	</cfcatch>	
	</cftry>	

	<cfinclude template="../view/listcgna.cfm">
</cfif>

<cfscript>
//<!-- -------------------------Busca--------------------------  -->
</cfscript>
<cfif Form.controller=='cgna' and Form.action=='busca' and evaluate('acoes.'& controllernomeplural & '["busca"]')==1 >
	<cfset url.acao="list">
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cfset url.pesquisa=#Form.busca#>
	<cfset url.pagina='1' >
	
	<cftry>	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
				select *, concat(ur.jurisdicao,' ',ur.nome,' ',ss.nome,' ',ss.regiao) as regional from sgpo_cgna sc
				inner join sgpo_setores ss on (ss.setorID=sc.setorID #sqlSetorID#)
				inner join unidades_regionais ur on (ss.regionalID=ur.regionalID #sqlRegionalID#)
				inner join unidades u on (ur.unidadeID=u.unidadeID #sqlUnidadeID#)
				 where sc.deleted is null  order by sc.updated desc, sc.created desc;
		</cfquery>
	<cfcatch type="any">
		<cfset status='ERRO'>
		<cfset conteudo=''>
	</cfcatch>	
	</cftry>	
	<cfif queryrecordcount(conteudoconsulta) gt 0>
		<cfset status='OK'>
		<cfset mensagemstatus=#conteudoconsulta.recordcount# & ' registro(s) encontrado(s) '>
	<cfelse>
		<cfset status='ERRO'>
		<cfset mensagemstatus='Nenhum registro(s) encontrado(s) '>
	</cfif>

	<cfinclude template="../view/listcgna.cfm">
</cfif>
<cfscript>
//<!-- -------------------------Ver--------------------------  -->
</cfscript>
<cfif Form.controller=='cgna' and Form.action=='ver' and evaluate('acoes.'& controllernomeplural & '["ver"]')==1 >
	<cfset url.acao="ver">
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cftry>	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
				select *, concat(ur.jurisdicao,' ',ur.nome,' ',ss.nome,' ',ss.regiao) as regional from sgpo_cgna sc
				inner join sgpo_setores ss on (ss.setorID=sc.setorID #sqlSetorID#)
				inner join unidades_regionais ur on (ss.regionalID=ur.regionalID #sqlRegionalID#)
				inner join unidades u on (ur.unidadeID=u.unidadeID #sqlUnidadeID#)
				 where  sc.cgnaID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char"> and sc.deleted is null ORDER BY ss.nome;
		</cfquery>
	<cfcatch type="any">
		<cfset status='ERRO'>
		<cfset conteudo=''>
	</cfcatch>	
	</cftry>	

	<cfinclude template="../view/vercgna.cfm">
</cfif>


<cfscript>
//<!-- -------------------------exclui--------------------------  -->
</cfscript>
<cfif Form.controller=='cgna' and Form.action=='exclui' and evaluate('acoes.'& controllernomeplural & '["exclui"]')==1 >
	<cfset url.acao="exclui">
	<cfset status='OK'>
	<cfset mensagemstatus = 'O registro foi excluído com sucesso!'>
	<cfset url.pagina=#Form.pagina#>
	<cftry>	
		<cfquery datasource="#dsn#" name="excluicgna">
		update sgpo_cgna set deleted=now(), usuariodeletou='#u.usuarioID#', ipdeletou='#cgi.remote_addr#', hostdeletou='#cgi.remote_host#' where cgnaID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char">;
		</cfquery>
		<cfquery datasource="#dsn#" name="conteudoconsulta">
				select *, concat(ur.jurisdicao,' ',ur.nome,' ',ss.nome,' ',ss.regiao) as regional from sgpo_cgna sc
				inner join sgpo_setores ss on (ss.setorID=sc.setorID #sqlSetorID#)
				inner join unidades_regionais ur on (ss.regionalID=ur.regionalID #sqlRegionalID#)
				inner join unidades u on (ur.unidadeID=u.unidadeID #sqlUnidadeID#)
				 where sc.deleted is null  order by sc.updated desc, sc.created desc;
		</cfquery>
	<cfcatch type="any">
		<cfquery datasource="#dsn#" name="conteudoconsulta">
				select *, concat(ur.jurisdicao,' ',ur.nome,' ',ss.nome,' ',ss.regiao) as regional from sgpo_cgna sc
				inner join sgpo_setores ss on (ss.setorID=sc.setorID #sqlSetorID#)
				inner join unidades_regionais ur on (ss.regionalID=ur.regionalID #sqlRegionalID#)
				inner join unidades u on (ur.unidadeID=u.unidadeID #sqlUnidadeID#)
				 where sc.deleted is null  order by sc.updated desc, sc.created desc;
		</cfquery>
		<cfset status='ERRO'>
		<cfset mensagemstatus='A informação não pode ser excluída. Motivo:' & CFCATCH.Message >
		<cfset conteudo=''>
	</cfcatch>	
	</cftry>	

	<cfinclude template="../view/listcgna.cfm">
</cfif>


<cfscript>
//<!-- -------------------------veredit--------------------------  -->
</cfscript>
<cfif Form.controller=='cgna' and Form.action=='veredit' and evaluate('acoes.'& controllernomeplural & '["veredit"]')==1 >
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
<cftry>	
	<cfquery datasource="#dsn#" name="conteudoconsulta">
				select *, concat(ur.jurisdicao,' ',ur.nome,' ',ss.nome,' ',ss.regiao) as regional from sgpo_cgna sc
				inner join sgpo_setores ss on (ss.setorID=sc.setorID #sqlSetorID#)
				inner join unidades_regionais ur on (ss.regionalID=ur.regionalID #sqlRegionalID#)
				inner join unidades u on (ur.unidadeID=u.unidadeID #sqlUnidadeID#)
				where  sc.cgnaID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char"> and sc.deleted is null;
	</cfquery>
<cfcatch type="any">
	<cfset status='ERRO'>
	<cfset conteudo=''>
</cfcatch>	
</cftry>	
<cfinclude template="../view/editcgna.cfm">
</cfif>

<cfscript>
//<!-- -------------------------vercad--------------------------  -->
</cfscript>
<cfif Form.controller=='cgna' and Form.action=='vercad' and evaluate('acoes.'& controllernomeplural & '["vercad"]')==1 >
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cfinclude template="../view/cadcgna.cfm">
</cfif>

<cfscript>
//<!-- -------------------------edit--------------------------  -->
</cfscript>
<cfif Form.controller=='cgna' and Form.action=='edit' and evaluate('acoes.'& controllernomeplural & '["edit"]')==1 >
	<cfset url.pagina=#Form.pagina#>
	<cfset url.i='Anexo'>
	<cfset url.acao='list'>
	<cfset status='OK'>
	<cfset mensagemstatus='Dados registrados com sucesso!' >
	<cfscript>
		validacao = ArrayNew();
		validacao[1]=StructNew();
		validacao[1].campo = 'Console01';
		validacao[1].valor = evaluate('form.' & controllernomecampo & '.Console01');
		validacao[1].validacao = 'numero';
		validacao[1].requerido = 1;
		validacao[1].minimo = 4;
		validacao[1].limite = 100;
		validacao[2]=StructNew();
		validacao[2].campo = 'Console02';
		validacao[2].valor = evaluate('form.' & controllernomecampo & '.Console02');
		validacao[2].validacao = 'numero';
		validacao[2].requerido = 1;
		validacao[2].minimo = 1;
		validacao[2].limite = 20;
		validacao[3]=StructNew();
		validacao[3].campo = 'Console03';
		validacao[3].valor = evaluate('form.' & controllernomecampo & '.Console03');
		validacao[3].validacao = 'numero';
		validacao[3].requerido = 1;
		validacao[3].minimo = 1;
		validacao[3].limite = 100;
		validacao[4]=StructNew();
		validacao[4].campo = 'Console04';
		validacao[4].valor = evaluate('form.' & controllernomecampo & '.Console04');
		validacao[4].validacao = 'numero';
		validacao[4].requerido = 1;
		validacao[4].minimo = 1;
		validacao[4].limite = 100;
		validacao[5]=StructNew();
		validacao[5].campo = 'Inicio01';
		validacao[5].valor = evaluate('form.' & controllernomecampo & '.Inicio01');
		validacao[5].validacao = 'hora';
		validacao[5].requerido = 1;
		validacao[5].minimo = 1;
		validacao[5].limite = 3;
		validacao[6]=StructNew();
		validacao[6].campo = 'Inicio02';
		validacao[6].valor = evaluate('form.' & controllernomecampo & '.Inicio02');
		validacao[6].validacao = 'hora';
		validacao[6].requerido = 1;
		validacao[6].minimo = 1;
		validacao[6].limite = 3;
		validacao[7]=StructNew();
		validacao[7].campo = 'Inicio03';
		validacao[7].valor = evaluate('form.' & controllernomecampo & '.Inicio03');
		validacao[7].validacao = 'hora';
		validacao[7].requerido = 1;
		validacao[7].minimo = 1;
		validacao[7].limite = 3;
		validacao[8]=StructNew();
		validacao[8].campo = 'Inicio04';
		validacao[8].valor = evaluate('form.' & controllernomecampo & '.Inicio04');
		validacao[8].validacao = 'hora';
		validacao[8].requerido = 1;
		validacao[8].minimo = 1;
		validacao[8].limite = 3;
		validacao[9]=StructNew();
		validacao[9].campo = 'Fim01';
		validacao[9].valor = evaluate('form.' & controllernomecampo & '.Fim01');
		validacao[9].validacao = 'hora';
		validacao[9].requerido = 1;
		validacao[9].minimo = 1;
		validacao[9].limite = 3;
		validacao[10]=StructNew();
		validacao[10].campo = 'Fim02';
		validacao[10].valor = evaluate('form.' & controllernomecampo & '.Fim02');
		validacao[10].validacao = 'hora';
		validacao[10].requerido = 1;
		validacao[10].minimo = 1;
		validacao[10].limite = 3;
		validacao[11]=StructNew();
		validacao[11].campo = 'Fim03';
		validacao[11].valor = evaluate('form.' & controllernomecampo & '.Fim03');
		validacao[11].validacao = 'hora';
		validacao[11].requerido = 1;
		validacao[11].minimo = 1;
		validacao[11].limite = 3;
		validacao[12]=StructNew();
		validacao[12].campo = 'Fim04';
		validacao[12].valor = evaluate('form.' & controllernomecampo & '.Fim04');
		validacao[12].validacao = 'hora';
		validacao[12].requerido = 1;
		validacao[12].minimo = 1;
		validacao[12].limite = 3;
		validacao[13]=StructNew();
		validacao[13].campo = 'Cargamensal';
		validacao[13].valor = evaluate('form.' & controllernomecampo & '.Cargamensal');
		validacao[13].validacao = 'numero';
		validacao[13].requerido = 1;
		validacao[13].minimo = 3;
		validacao[13].limite = 3;
		campos = '';
		values = '';
		for(i=1;i lte 4;i = i+1){
			if(evaluate('structkeyexists(' & 'form.' & controllernomecampo & ' , ''Pico0' & i & ''')') ){
				campos = ', pico0' & i & '=1';
				values = values & campos;
			}else{
				values = values & ', pico0' & i & '= null';
			}
		}
		resultado = valida(validacao);
		status = resultado.status;
		mensagemstatus = resultado.mensagem;
		erros = resultado.contador;

	</cfscript>
<cfset dados = StructNew() >
<cfif status eq 'OK'>
	<cfquery datasource="#dsn#" name="setor">
	select * from sgpo_cgna sc inner join sgpo_setores ss on (ss.setorID=sc.setorID) where sc.cgnaID=<cfqueryparam  value="#form.Cgna.CgnaID#" cfsqltype="cf_sql_char"> ;
	</cfquery>
<cfscript>
	//dump(setor);
	pc = evaluate('form.' & controllernomecampo & '.Cargamensal');
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
	calculos = vetor[1]['consoles'];
	horas = "'" & vetor[1]['hora'] & "'";
	for(t=2;t lte ArrayLen(vetor);t=t+1){
		calculos = calculos & ',' & vetor[t]['consoles'];
		horas = horas & ',' & "'" & vetor[t]['hora'] & "'";
	}
	turnos = ArrayNew();
	for(t=1;t lte 4;t=t+1){
		turnos[t] = StructNew();
		turnos[t]['inicio']=evaluate("setor['inicio0" & t & "'][1]");
		turnos[t]['fim']=evaluate("setor['fim0" & t & "'][1]");
		turnos[t]['pico']=evaluate("setor['pico0" & t & "'][1]");
	}

	somaeo=0;
	loop from="1" to="4" index="c" {
		somaeo= somaeo + novoturno.eo[c];
	}
	somal30 = total*30;
	somah30 = somaeo/qtdturnos;
	somam30 = pc/somah30;
	somaef30 = somal30/somam30;
	somaefs30 = somaef30*1.2;
	somaefs30a = ceiling(somaefs30);
	coord30 = 0;
	coordef30 = 0;
	coord31 = 0;
	coordef31 = 0;
	ferias30 = ceiling(somaefs30a/12);
	equipe30 = round((somaefs30a-ferias30)/6);
	ferias30 = somaefs30a - equipe30*6 ;
	
	loop from="1" to="4" index="c"{
		coord30 = coord30 + fix(novoturno.console[c]/3);
		coordef30 = coordef30 + fix(novoturno.console[c]/3)*30*novoturno.console[c]/pc;
	}
	sup30 = 0;
	supc30 = 0;
	supef30 = 0;
	loop from="1" to="4" index="c"{
		if( fix(novoturno.console[c]/3) gt 0 ){
			supc30 = 1;
		}else{
			supc30 = 0;
		}
		sup30 = sup30 + supc30;
		supef30 = supef30 + supc30*30*novoturno.console[c]/pc;
	}
	efcoordsup30 = supef30 + coordef30 + ceiling((supef30 + coordef30)*0.15);
	apoio=ceiling(3+3*0.15);
	
	tlp = somaefs30a+ceiling(efcoordsup30+apoio);
</cfscript>			
	<cfset mensagemstatus='Dados registrados com sucesso!' >
	<cftry>	
			<cfquery name="editsetores" datasource="#dsn#">
			update sgpo_cgna set  movimentoanual=<cfqueryparam  value="#form.Cgna.Movimentoanual#" cfsqltype="cf_sql_char">, cargamensal=<cfqueryparam  value="#form.Cgna.Cargamensal#" cfsqltype="cf_sql_char">, console01=<cfqueryparam  value="#form.Cgna.Console01#" cfsqltype="cf_sql_char">, console02=<cfqueryparam  value="#form.Cgna.Console02#" cfsqltype="cf_sql_char">, console03=<cfqueryparam  value="#form.Cgna.Console03#" cfsqltype="cf_sql_char">, console04=<cfqueryparam  value="#form.Cgna.Console04#" cfsqltype="cf_sql_char">, inicio01=<cfqueryparam  value="#form.Cgna.Inicio01#" cfsqltype="cf_sql_char">, inicio02=<cfqueryparam  value="#form.Cgna.Inicio02#" cfsqltype="cf_sql_char">, inicio03=<cfqueryparam  value="#form.Cgna.Inicio03#" cfsqltype="cf_sql_char">, inicio04=<cfqueryparam  value="#form.Cgna.Inicio04#" cfsqltype="cf_sql_char">, fim01=<cfqueryparam  value="#form.Cgna.Fim01#" cfsqltype="cf_sql_char">, fim02=<cfqueryparam  value="#form.Cgna.Fim02#" cfsqltype="cf_sql_char">,fim03=<cfqueryparam  value="#form.Cgna.Fim03#" cfsqltype="cf_sql_char">, fim04=<cfqueryparam  value="#form.Cgna.Fim04#" cfsqltype="cf_sql_char">, ene=#tlp#,  updated=now(), usuariomodificou='#u.usuarioID#', ipmodificou='#cgi.remote_addr#', hostmodificou='#cgi.remote_host#' #values# where cgnaID=<cfqueryparam  value="#form.Cgna.CgnaID#" cfsqltype="cf_sql_char"> 
			</cfquery>	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
				select *, concat(ur.jurisdicao,' ',ur.nome,' ',ss.nome,' ',ss.regiao) as regional from sgpo_cgna sc
				inner join sgpo_setores ss on (ss.setorID=sc.setorID #sqlSetorID#)
				inner join unidades_regionais ur on (ss.regionalID=ur.regionalID #sqlRegionalID#)
				inner join unidades u on (ur.unidadeID=u.unidadeID #sqlUnidadeID#)
				 where sc.deleted is null  order by ss.nome ASC;
		</cfquery>
		<cfsavecontent variable="lista"><cfinclude template="../view/listcgna.cfm" ></cfsavecontent>
		<cfset StructInsert(dados, 'conteudo', lista , 'TRUE') >
	<cfcatch type="any">
		<cfset status='ERRO'>
		<cfset mensagemstatus='Dados não registrados. Motivo:' & CFCATCH.Message >
		<cfset conteudo=''>
	</cfcatch>	
	</cftry>	
	<cfset StructInsert(dados, 'status', status, 'TRUE')>
	<cfset StructInsert(dados, 'mensagemstatus', mensagemstatus, 'TRUE') >
	<cfcontent type="application/x-json"><cfoutput>#serializeJSON(dados, true)#</cfoutput></cfcontent>
	<cfabort>
<cfelse>
	<cfset StructInsert(dados, 'status', status, 'TRUE')>
	<cfset StructInsert(dados, 'mensagemstatus', mensagemstatus, 'TRUE') >
	<cfcontent type="application/x-json"><cfoutput>#serializeJSON(dados, true)#</cfoutput></cfcontent>
	<cfabort>
</cfif>

</cfif>

<cfscript>
//<!-- -------------------------cad--------------------------  -->
</cfscript>
<cfif Form.controller=='cgna' and Form.action=='cad' and evaluate('acoes.'& controllernomeplural & '["cad"]')==1 >
	<cfset status='OK'>
	<cfset mensagemstatus='Dados registrados com sucesso!' >
	<cfset url.pagina=#Form.pagina#>
	<cfset url.i='Cgna'>
	<cfset url.acao='list'>
	<cfscript>
		validacao = ArrayNew();
		validacao[1]=StructNew();
		validacao[1].campo = 'Console01';
		validacao[1].valor = evaluate('form.' & controllernomecampo & '.Console01');
		validacao[1].validacao = 'numero';
		validacao[1].requerido = 1;
		validacao[1].minimo = 4;
		validacao[1].limite = 100;
		validacao[2]=StructNew();
		validacao[2].campo = 'Console02';
		validacao[2].valor = evaluate('form.' & controllernomecampo & '.Console02');
		validacao[2].validacao = 'numero';
		validacao[2].requerido = 1;
		validacao[2].minimo = 1;
		validacao[2].limite = 20;
		validacao[3]=StructNew();
		validacao[3].campo = 'Console03';
		validacao[3].valor = evaluate('form.' & controllernomecampo & '.Console03');
		validacao[3].validacao = 'numero';
		validacao[3].requerido = 1;
		validacao[3].minimo = 1;
		validacao[3].limite = 100;
		validacao[4]=StructNew();
		validacao[4].campo = 'Console04';
		validacao[4].valor = evaluate('form.' & controllernomecampo & '.Console04');
		validacao[4].validacao = 'numero';
		validacao[4].requerido = 1;
		validacao[4].minimo = 1;
		validacao[4].limite = 100;
		validacao[5]=StructNew();
		validacao[5].campo = 'Inicio01';
		validacao[5].valor = evaluate('form.' & controllernomecampo & '.Inicio01');
		validacao[5].validacao = 'hora';
		validacao[5].requerido = 1;
		validacao[5].minimo = 1;
		validacao[5].limite = 3;
		validacao[6]=StructNew();
		validacao[6].campo = 'Inicio02';
		validacao[6].valor = evaluate('form.' & controllernomecampo & '.Inicio02');
		validacao[6].validacao = 'hora';
		validacao[6].requerido = 1;
		validacao[6].minimo = 1;
		validacao[6].limite = 3;
		validacao[7]=StructNew();
		validacao[7].campo = 'Inicio03';
		validacao[7].valor = evaluate('form.' & controllernomecampo & '.Inicio03');
		validacao[7].validacao = 'hora';
		validacao[7].requerido = 1;
		validacao[7].minimo = 1;
		validacao[7].limite = 3;
		validacao[8]=StructNew();
		validacao[8].campo = 'Inicio04';
		validacao[8].valor = evaluate('form.' & controllernomecampo & '.Inicio04');
		validacao[8].validacao = 'hora';
		validacao[8].requerido = 1;
		validacao[8].minimo = 1;
		validacao[8].limite = 3;
		validacao[9]=StructNew();
		validacao[9].campo = 'Fim01';
		validacao[9].valor = evaluate('form.' & controllernomecampo & '.Fim01');
		validacao[9].validacao = 'hora';
		validacao[9].requerido = 1;
		validacao[9].minimo = 1;
		validacao[9].limite = 3;
		validacao[10]=StructNew();
		validacao[10].campo = 'Fim02';
		validacao[10].valor = evaluate('form.' & controllernomecampo & '.Fim02');
		validacao[10].validacao = 'hora';
		validacao[10].requerido = 1;
		validacao[10].minimo = 1;
		validacao[10].limite = 3;
		validacao[11]=StructNew();
		validacao[11].campo = 'Fim03';
		validacao[11].valor = evaluate('form.' & controllernomecampo & '.Fim03');
		validacao[11].validacao = 'hora';
		validacao[11].requerido = 1;
		validacao[11].minimo = 1;
		validacao[11].limite = 3;
		validacao[12]=StructNew();
		validacao[12].campo = 'Fim04';
		validacao[12].valor = evaluate('form.' & controllernomecampo & '.Fim04');
		validacao[12].validacao = 'hora';
		validacao[12].requerido = 1;
		validacao[12].minimo = 1;
		validacao[12].limite = 3;
		validacao[13]=StructNew();
		validacao[13].campo = 'Cargamensal';
		validacao[13].valor = evaluate('form.' & controllernomecampo & '.Cargamensal');
		validacao[13].validacao = 'numero';
		validacao[13].requerido = 1;
		validacao[13].minimo = 3;
		validacao[13].limite = 3;
		campos = '';
		values = '';
		for(i=1;i lte 4;i = i+1){
			if(evaluate('structkeyexists(' & 'form.' & controllernomecampo & ' , ''Pico0' & i & ''')') ){
				campos = campos & ', pico0' & i;
				values = values & ', 1';
			}
		}
		resultado = valida(validacao);
		status = resultado.status;
		mensagemstatus = resultado.mensagem;
		erros = resultado.contador;
	</cfscript>
	<cfset dados = StructNew() >
<cfif status eq 'OK'>		

<cfscript>
	//dump(setor);
	pc = evaluate('form.' & controllernomecampo & '.Cargamensal');
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
				for(ev=1;ev lte 4;ev=ev+1){
					dinicio = CreateTime(hour(evaluate('form.' & controllernomecampo & '.Inicio0'& ev)),minute(evaluate('form.' & controllernomecampo & '.Inicio0'& ev)),0);
					dfim = CreateTime(hour(evaluate('form.' & controllernomecampo & '.Fim0'& ev)),minute(evaluate('form.' & controllernomecampo & '.Fim0'& ev)),0);
					dif1=datediff('n',inicio,dinicio);
					dif2=datediff('n',fim,dfim);
					dif3=datediff('n',fim,dinicio);
					dif4=datediff('n',inicio,dfim);
					dif5=datediff('n',dinicio,dfim);
					if( (dif1 lte 0 and dif3 lte 0 and dif4 gt 0 and dif2 gt 0) ){
						vetor[conta]["consoles"]=evaluate('form.' & controllernomecampo & '.Console0'& ev)+vetor[conta]["consoles"];
					}
					if(  (dif2 lt 0 and dif4 lt 0 and dif1 lte 0 and dif3 lt 0 and dif5 lt 0 ) or ( dif2 gt 0 and dif4 gte 0 and dif1 gt 0 and dif3 gt 0 and dif5 lt 0 ) ){
						vetor[conta]["consoles"]=evaluate('form.' & controllernomecampo & '.Console0'& ev)+vetor[conta]["consoles"];
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
				for(ev=1;ev lte 4;ev=ev+1){
					dinicio = CreateTime(hour(evaluate('form.' & controllernomecampo & '.Inicio0'& ev)),minute(evaluate('form.' & controllernomecampo & '.Inicio0'& ev)),0);
					dfim = CreateTime(hour(evaluate('form.' & controllernomecampo & '.Fim0'& ev)),minute(evaluate('form.' & controllernomecampo & '.Fim0'& ev)),0);
					dif1=datediff('n',inicio,dinicio);
					dif2=datediff('n',fim,dfim);
					dif3=datediff('n',fim,dinicio);
					dif4=datediff('n',inicio,dfim);
					dif5=datediff('n',dinicio,dfim);
					if( (dif1 lte 0 and dif3 lte 0 and dif4 gt 0 and dif2 gt 0) ){
						vetor[conta]["consoles"]=evaluate('form.' & controllernomecampo & '.Console0'& ev)+vetor[conta]["consoles"];
					}
					if(  (dif2 lt 0 and dif4 lt 0 and dif1 lte 0 and dif3 lt 0 and dif5 lt 0 ) or ( dif2 gt 0 and dif4 gte 0 and dif1 gt 0 and dif3 gt 0 and dif5 lt 0 ) ){
						vetor[conta]["consoles"]=evaluate('form.' & controllernomecampo & '.Console0'& ev)+vetor[conta]["consoles"];
					}
					consoles[ev] = evaluate('form.' & controllernomecampo & '.Console0'& ev);
					if(evaluate('structkeyexists(' & 'form.' & controllernomecampo & ' , ''Pico0' & i & ''')') ){
						picos[ev] = evaluate('form.' & controllernomecampo & '.Pico0'& ev);
					}else{
						picos[ev] = 0;
					}
					inicios[ev] = evaluate('form.' & controllernomecampo & '.Inicio0'& ev);
					finais[ev] = evaluate('form.' & controllernomecampo & '.Fim0'& ev);
					novosinicios[ev] = evaluate('form.' & controllernomecampo & '.Inicio0'& ev);
					novosfinais[ev] = evaluate('form.' & controllernomecampo & '.Fim0'& ev);
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
	calculos = vetor[1]['consoles'];
	horas = "'" & vetor[1]['hora'] & "'";
	for(t=2;t lte ArrayLen(vetor);t=t+1){
		calculos = calculos & ',' & vetor[t]['consoles'];
		horas = horas & ',' & "'" & vetor[t]['hora'] & "'";
	}
	turnos = ArrayNew();
	for(t=1;t lte 4;t=t+1){
		turnos[t] = StructNew();
		turnos[t]['inicio']=evaluate('form.' & controllernomecampo & '.Inicio0'& t);
		turnos[t]['fim']=evaluate('form.' & controllernomecampo & '.Fim0'& t);
		turnos[t]['pico']=picos[t];
	}

	somaeo=0;
	loop from="1" to="4" index="c" {
		somaeo= somaeo + novoturno.eo[c];
	}
	somal30 = total*30;
	somah30 = somaeo/qtdturnos;
	somam30 = pc/somah30;
	somaef30 = somal30/somam30;
	somaefs30 = somaef30*1.2;
	somaefs30a = ceiling(somaefs30);
	coord30 = 0;
	coordef30 = 0;
	coord31 = 0;
	coordef31 = 0;
	ferias30 = ceiling(somaefs30a/12);
	equipe30 = round((somaefs30a-ferias30)/6);
	ferias30 = somaefs30a - equipe30*6 ;
	
	loop from="1" to="4" index="c"{
		coord30 = coord30 + fix(novoturno.console[c]/3);
		coordef30 = coordef30 + fix(novoturno.console[c]/3)*30*novoturno.console[c]/pc;
	}
	sup30 = 0;
	supc30 = 0;
	supef30 = 0;
	loop from="1" to="4" index="c"{
		if( fix(novoturno.console[c]/3) gt 0 ){
			supc30 = 1;
		}else{
			supc30 = 0;
		}
		sup30 = sup30 + supc30;
		supef30 = supef30 + supc30*30*novoturno.console[c]/pc;
	}
	efcoordsup30 = supef30 + coordef30 + ceiling((supef30 + coordef30)*0.15);
	apoio=ceiling(3+3*0.15);
	
	tlp = somaefs30a+ceiling(efcoordsup30+apoio);
</cfscript>	<cfset mensagemstatus='Dados registrados com sucesso!' >
		<cfquery name="inserecgna" datasource="#dsn#">
		insert into sgpo_cgna (cgnaID, setorID, movimentoanual, cargamensal, console01, console02, console03, console04, inicio01, inicio02, inicio03, inicio04, fim01, fim02, fim03, fim04, ene, created, usuariocriou, ipcriou, hostcriou #campos#) values ('#id#', <cfqueryparam  value="#form.Cgna.SetorID#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Cgna.Movimentoanual#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Cgna.Cargamensal#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Cgna.console01#" cfsqltype="cf_sql_integer">, <cfqueryparam  value="#form.Cgna.console02#" cfsqltype="cf_sql_integer">, <cfqueryparam  value="#form.Cgna.console03#" cfsqltype="cf_sql_integer">, <cfqueryparam  value="#form.Cgna.console04#" cfsqltype="cf_sql_integer">, <cfqueryparam  value="#form.Cgna.inicio01#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Cgna.inicio02#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Cgna.inicio03#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Cgna.inicio04#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Cgna.fim01#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Cgna.fim02#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Cgna.fim03#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Cgna.fim04#" cfsqltype="cf_sql_char">, #tlp#, now(), '#u.usuarioID#', '#cgi.remote_addr#','#cgi.remote_host#' #values#)
		</cfquery>
		<cfquery datasource="#dsn#" name="conteudoconsulta">
				select *, concat(ur.jurisdicao,' ',ur.nome,' ',ss.nome,' ',ss.regiao) as regional from sgpo_cgna sc
				inner join sgpo_setores ss on (ss.setorID=sc.setorID #sqlSetorID#)
				inner join unidades_regionais ur on (ss.regionalID=ur.regionalID #sqlRegionalID#)
				inner join unidades u on (ur.unidadeID=u.unidadeID #sqlUnidadeID#)
				 where sc.deleted is null  order by sc.updated desc, sc.created desc;
		</cfquery>
		<cfsavecontent variable="lista"><cfinclude template="../view/listcgna.cfm" ></cfsavecontent>
		<cfset StructInsert(dados, 'conteudo', lista , 'TRUE') >
	<cfset StructInsert(dados, 'status', status, 'TRUE')>
	<cfset StructInsert(dados, 'mensagemstatus', mensagemstatus, 'TRUE') >
	<cfcontent type="application/x-json"><cfoutput>#serializeJSON(dados, true)#</cfoutput></cfcontent>
	<cfabort>
<cfelse>
	<cfset StructInsert(dados, 'status', status, 'TRUE')>
	<cfset StructInsert(dados, 'mensagemstatus', mensagemstatus, 'TRUE') >
	<cfcontent type="application/x-json"><cfoutput>#serializeJSON(dados, true)#</cfoutput></cfcontent>
	<cfabort>
</cfif>

</cfif>

