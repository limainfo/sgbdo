<cfif not StructKeyExists(session,"id") >
		<cfset status='ERRO'>
		<cfset mensagemstatus='O tempo da conexão terminou. <a href="../../../../../id/?i=logout&appID=#app.appID#">Log in novamente.</a>' >
		<cfinclude template="../view/fimsessao.cfm">
		<cfabort>		
</cfif>
<cfset id=CreateUUID()>
<cfparam name="Form.controller" default="">	
<cfparam name="conteudoconsulta" default="">	
<cfset controllernome='perfil' >
<cfset controllernomeplural='perfils' >
<cfset controllernomecampo='Perfils' >
<cfparam name="url.pesquisa" default="">
<cfset url.i="Perfil">
<cfset controllernomeid='perfilID' >
<cfparam name="nrprocesso" default="1000">
<cfparam name="sqlUnidadeID" default="">
<cfparam name="sqlRegionalID" default="">
<cfparam name="sqlHabilitacao" default="">
<cfparam name="sqlSetorID" default="">
<cfif len(contenhaUnidadeID) gt 10>
	<cfset sqlUnidadeID=replace(contenhaUnidadeID,'XXXXXXXXXX','ur.unidadeID') >
</cfif>
<cfif len(contenhaRegionalID) gt 10>
	<cfset sqlRegionalID=replace(contenhaRegionalID,'XXXXXXXXXX','ur.regionalID') >
</cfif>
<cfif len(contenhaHabilitacao) gt 10>
	<cfset sqlHabilitacao=replace(contenhaHabilitacao,'XXXXXXXXXX','hs.habilitacao') >
</cfif>
<cfif len(contenhaSetorID) gt 10>
	<cfset sqlSetorID=replace(contenhaSetorID,'XXXXXXXXXX','ss.setorID') >
</cfif>
<cfscript>
//<!-- -------------------------Perfils--------------------------  -->
//<!-- -------------------------list--------------------------  -->
</cfscript>
<cfif Form.controller=='perfils' and Form.action=='list' and evaluate('acoes.'& controllernomeplural & '["list"]')==1  and len(u.unidadeResponsavel) lt 10>
	<cfset url.acao="list">
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cfparam name="completasql" default="">
	<cfset url.pesquisa = urldecode(url.pesquisa) >
	<cftry>	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
				select *, ur.nome as nomeunidade from sgpo_perfils sp
				inner join sgpo_perfiljurisdicao spj on (spj.perfilID=sp.perfilID)
				left join unidades ur on (ur.unidadeID=spj.unidadeResponsavel #sqlUnidadeID#)
				where
				(sp.perfilID like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or sp.tipo like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> ) 
				and sp.deleted is null 
				order by nomeunidade asc, sp.updated desc, sp.created desc;
		</cfquery>
	<cfcatch type="any">
		<cfset status='ERRO'>
		<cfset conteudo=''>
	</cfcatch>	
	</cftry>	

	<cfinclude template="../view/listperfil.cfm">
</cfif>

<cfscript>
//<!-- -------------------------Busca--------------------------  -->
</cfscript>
<cfif Form.controller=='perfils' and Form.action=='busca' and evaluate('acoes.'& controllernomeplural & '["busca"]')==1  and len(u.unidadeResponsavel) lt 10>
	<cfset url.acao="list">
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cfset url.pesquisa=#Form.busca#>
	<cfset url.pagina='1' >
	
	<cftry>	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
				select *, ur.nome as nomeunidade from sgpo_perfils sp
				inner join sgpo_perfiljurisdicao spj on (spj.perfilID=sp.perfilID)
				left join unidades ur on (ur.unidadeID=spj.unidadeResponsavel #sqlUnidadeID#)
				where
				(sp.perfilID like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or sp.tipo like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> ) 
				and sp.deleted is null 
				order by nomeunidade asc, sp.updated desc, sp.created desc;
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

	<cfinclude template="../view/listperfil.cfm">
</cfif>

<cfscript>
//<!-- -------------------------Ver---------------------------->
</cfscript>
<cfif Form.controller=='perfils' and Form.action=='ver' and evaluate('acoes.'& controllernomeplural & '["ver"]')==1  and len(u.unidadeResponsavel) lt 10>
	<cfset url.acao="ver">
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
		<cfquery datasource="#dsn#" name="spj">
			select *, ur.nome as nomeunidade from sgpo_perfiljurisdicao spj 
			left join unidades ur on (ur.unidadeID=spj.unidadeResponsavel #sqlUnidadeID#)
			where (spj.perfilID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char">) ;
		</cfquery>
		
		<cfloop query="spj">
			<cfset verhabilitacao = evaluate("""" & habilitacao & """") >
			<cfset verregional = evaluate("""" & regionalID & """") >
			<cfset verunidade = evaluate("""" & unidadeID & """") >
			<cfset versetor = evaluate("""" & setorID & """") >
		</cfloop>
		
		<cfif len(verhabilitacao) gt 10>
			<cfset fverHabilitacao = " and hs.habilitacao in ("& ListQualify(verhabilitacao, """") &")" >
		<cfelse>
			<cfset fverHabilitacao = "" >
		</cfif>
		<cfif len(verregional) gt 10>
			<cfset fverRegionalID = " and ur.regionalID in ("& ListQualify(verregional, """") &")" >
		<cfelse>
			<cfset fverRegionalID = "" >
		</cfif>
		<cfif len(verunidade) gt 10>
			<cfset fverUnidadeID = " and ur.unidadeID in ("& ListQualify(verunidade, """") &")" >
		<cfelse>
			<cfset fverUnidadeID = "" >
		</cfif>
		<cfif len(versetor) gt 10>
			<cfset fverSetorID = " and ss.setorID in ("& ListQualify(versetor, """") &")" >
		<cfelse>
			<cfset fverSetorID = "" >
		</cfif>
			
		<cfquery datasource="#dsn#" name="conteudoconsulta">
		select *, ur.nome as nomeunidade from sgpo_perfils sp 
			inner join sgpo_perfiljurisdicao spj on (spj.perfilID=sp.perfilID)
			left join unidades ur on (ur.unidadeID=spj.unidadeResponsavel #sqlUnidadeID#)
		where sp.perfilID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char">;
		</cfquery>
		
	<cftry>	
			
	<cfcatch type="any">
		<cfset status='ERRO'>
		<cfset conteudo=''>
	</cfcatch>	
	</cftry>	
	<cfinclude template="../view/verperfil.cfm">
</cfif>


<cfscript>
//<!-- -------------------------exclui--------------------------  -->
</cfscript>
<cfif Form.controller=='perfils' and Form.action=='exclui' and evaluate('acoes.'& controllernomeplural & '["exclui"]')==1  and len(u.unidadeResponsavel) lt 10>
	<cfset url.acao="exclui">
	<cfset status='OK'>
	<cfset mensagemstatus = 'O perfil ->' & #form.nome# & ' foi excluído com sucesso!'>
	<cfset url.pagina=#Form.pagina#>
	<cfscript>
		validacao = ArrayNew();
		validacao[1]=StructNew();
		validacao[1].campo = 'Perfil';
		validacao[1].valor = evaluate('form.' & controllernomecampo & '.PerfilID');
		validacao[1].validacao = 'literal';
		validacao[1].requerido = 1;
		validacao[1].minimo = 4;
		validacao[1].limite = 100;
		resultado = valida(validacao);
		status = resultado.status;
		mensagemstatus = resultado.mensagem;
		erros = resultado.contador;

	</cfscript>
	<cfset dados = StructNew() >
<cfif status eq 'OK'>		
	<cfset mensagemstatus='Dados registrados com sucesso!' >
	<cftry>	
		<cfquery datasource="#dsn#" name="excluiperfils">
		update sgpo_perfils set deleted=now(), usuariodeletou='#u.usuarioID#', ipdeletou='#cgi.remote_addr#', hostdeletou='#cgi.remote_host#' where perfilID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char">;
		</cfquery>
		<cfquery datasource="#dsn#" name="excluiperfils">
		delete from sgpo_perfilanexos where perfilID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char">;
		</cfquery>
		<cfquery datasource="#dsn#" name="conteudoconsulta">
				select *, ur.nome as nomeunidade from sgpo_perfils sp
				inner join sgpo_perfiljurisdicao spj on (spj.perfilID=sp.perfilID)
				left join unidades ur on (ur.unidadeID=spj.unidadeResponsavel #sqlUnidadeID#)
				where
				(sp.perfilID like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or sp.tipo like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> ) 
				and sp.deleted is null 
				order by nomeunidade asc, sp.updated desc, sp.created desc;		</cfquery>
		<cfsavecontent variable="lista"><cfinclude template="../view/listperfil.cfm" ></cfsavecontent>
		<cfset StructInsert(dados, 'conteudo', lista , 'TRUE') >
	<cfcatch type="any">
		<cfset status='ERRO'>
		<cfset mensagemstatus='A informação não pode ser excluída. Motivo:' & CFCATCH.Message >
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
//<!-- -------------------------veredit--------------------------  -->
</cfscript>
<cfif Form.controller=='perfils' and Form.action=='veredit' and evaluate('acoes.'& controllernomeplural & '["veredit"]')==1  and len(u.unidadeResponsavel) lt 10>
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cftry>	
		<cfquery datasource="#dsn#" name="spj">
		select *, ur.nome as nomeunidade from sgpo_perfiljurisdicao spj 
		left join unidades ur on (ur.unidadeID=spj.unidadeResponsavel #sqlUnidadeID#)
		where
		(spj.perfilID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char">) ;
		</cfquery>		

		<cfloop query="spj">
		<cfset habilitacaolst = evaluate("""" & spj.habilitacao & """") >
		<cfset regionallst = evaluate("""" & spj.regionalID & """") >
		<cfset unidadelst = evaluate("""" & spj.unidadeID & """") >
		<cfset setorlst = evaluate("""" & spj.setorID & """") >
		</cfloop>
		<cfset contenhaHabilitacao = "("& ListQualify(habilitacaolst, """") &")" >
		<cfset contenhaRegionalID = "("& ListQualify(regionallst, """") &")" >
		<cfset contenhaUnidadeID = "("& ListQualify(unidadelst, """") &")" >
		<cfset contenhaSetorID = "("& ListQualify(setorlst, """") &")" >
			
		<cfquery datasource="#dsn#" name="conteudoconsulta">
			select *, ur.nome as nomeunidade from sgpo_perfils sp
			inner join sgpo_perfiljurisdicao spj on (spj.perfilID=sp.perfilID)
			left join unidades ur on (ur.unidadeID=spj.unidadeResponsavel #sqlUnidadeID#)
			where
			sp.perfilID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char"> 
			and sp.deleted is null 
			order by nomeunidade asc, sp.updated desc, sp.created desc;
		</cfquery>
	<cfcatch type="any">
		<cfset status='ERRO'>
		<cfset mensagemstatus='Erro na consulta. Motivo:' & CFCATCH.Message >
		<cfset conteudo=''>
	</cfcatch>	
	</cftry>	
<cfinclude template="../view/editperfil.cfm">
</cfif>

<cfscript>
//<!-- -------------------------vercad--------------------------  -->
</cfscript>
<cfif Form.controller=='perfils' and Form.action=='vercad' and evaluate('acoes.'& controllernomeplural & '["vercad"]')==1  and len(u.unidadeResponsavel) lt 10>
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
		
	<cfinclude template="../view/cadperfil.cfm">
</cfif>
	
<cfscript>
//<!-- -------------------------edit--------------------------  -->
</cfscript>
<cfif Form.controller=='perfils' and Form.action=='edit' and evaluate('acoes.'& controllernomeplural & '["edit"]')==1  and len(u.unidadeResponsavel) lt 10>
	<cfset status='OK'>
	<cfset mensagemstatus='' >
	<cfset url.pagina=#Form.pagina#>
	<cfset url.i='Perfil'>
	<cfset url.acao='list'>
	<cfparam name="erros" default="0">
	<cfscript>
		validacao = ArrayNew();
		validacao[1]=StructNew();
		validacao[1].campo = 'Nome';
		validacao[1].valor = evaluate('form.' & controllernomecampo & '.PerfilID');
		validacao[1].validacao = 'literal';
		validacao[1].requerido = 1;
		validacao[1].minimo = 5;
		validacao[1].limite = 100;
		if(len(u.unidadeResponsavel) gt 20){
			validacao[2]=StructNew();
			validacao[2].campo = 'Habilitação';
			if (not StructKeyExists(evaluate('form.' & controllernomecampo),"Habilitacao")){
				validacao[2].valor = '';
			}else{
				validacao[2].valor = evaluate('form.' & controllernomecampo & '.Habilitacao');
			} 
			validacao[2].validacao = 'literal';
			validacao[2].requerido = 1;
			validacao[2].minimo = 2;
			validacao[2].limite = 10000;
			validacao[3]=StructNew();
			validacao[3].campo = 'Unidade';
			if (not StructKeyExists(evaluate('form.' & controllernomecampo),"Unidade")){
				validacao[3].valor = '';
			}else{
				validacao[3].valor = evaluate('form.' & controllernomecampo & '.Unidade');
			} 
			validacao[3].validacao = 'literal';
			validacao[3].requerido = 1;
			validacao[3].minimo = 2;
			validacao[3].limite = 10000;
		}
		resultado = valida(validacao);
		status = resultado.status;
		mensagemstatus = resultado.mensagem;
		erros = resultado.contador;
	</cfscript>
	<cfset dados = StructNew() >
<cfif status eq 'OK'>		
	<cfset mensagemstatus='Dados registrados com sucesso!' >
<cftry>	
		<cfparam name="editsetores" default="">
		<cfquery name="editsetores" datasource="#dsn#">
		update sgpo_perfils set  updated=now(), usuariomodificou='#u.usuarioID#', ipmodificou='#cgi.remote_addr#', hostmodificou='#cgi.remote_host#' where perfilID=<cfqueryparam  value="#form.Perfils.PerfilID#" cfsqltype="cf_sql_char">
		</cfquery>	
		<cfparam name="form.Perfils.Habilitacao" default="">
		<cfparam name="form.Perfils.RegionalID" default="">
		<cfparam name="form.Perfils.UnidadeID" default="">
		<cfparam name="form.Perfils.SetorID" default="">
		<cfset formHabilitacao = form.Perfils.Habilitacao >
		<cfset formRegionalID = form.Perfils.RegionalID >
		<cfset formUnidadeID = form.Perfils.UnidadeID >
		<cfset formSetorID = form.Perfils.SetorID >
		<cfquery name="insereperfils" datasource="#dsn#">
			delete from sgpo_perfiljurisdicao where  perfilID=<cfqueryparam  value="#form.Perfils.PerfilID#" cfsqltype="cf_sql_char">;
		</cfquery>

		<cfquery name="insereperfils" datasource="#dsn#">
			insert into sgpo_perfiljurisdicao (perfilID, unidadeResponsavel, regionalID, unidadeID, setorID, habilitacao, created, usuariocriou, ipcriou, hostcriou) values (<cfqueryparam  value="#ucase(form.Perfils.PerfilID)#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#ucase(form.Perfils.UnidadeResponsavel)#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#formRegionalID#" cfsqltype="cf_sql_longvarchar">,<cfqueryparam  value="#formUnidadeID#" cfsqltype="cf_sql_longvarchar">,<cfqueryparam  value="#formSetorID#" cfsqltype="cf_sql_longvarchar">,<cfqueryparam  value="#formHabilitacao#" cfsqltype="cf_sql_longvarchar">, now(), '#u.usuarioID#', '#cgi.remote_addr#','#cgi.remote_host#');
		</cfquery>
		<cfquery datasource="#dsn#" name="conteudoconsulta">
			select *, ur.nome as nomeunidade from sgpo_perfils sp
			inner join sgpo_perfiljurisdicao spj on (spj.perfilID=sp.perfilID)
			left join unidades ur on (ur.unidadeID=spj.unidadeResponsavel #sqlUnidadeID#)
			where
			(sp.perfilID like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or sp.tipo like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> ) 
			and sp.deleted is null 
			order by nomeunidade asc, sp.updated desc, sp.created desc;	
		</cfquery>
		<cfsavecontent variable="lista"><cfinclude template="../view/listperfil.cfm" ></cfsavecontent>
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
<cfif Form.controller=='perfils' and Form.action=='cad' and evaluate('acoes.'& controllernomeplural & '["cad"]')==1  and len(u.unidadeResponsavel) lt 10>
	<cfset status='OK'>
	<cfset mensagemstatus='' >
	<cfset url.pagina=#Form.pagina#>
	<cfset url.i='Perfil'>
	<cfset url.acao='list'>
	<cfparam name="erros" default="0">
	<cfscript>
		validacao = ArrayNew();
		validacao[1]=StructNew();
		validacao[1].campo = 'Nome';
		validacao[1].valor = evaluate('form.' & controllernomecampo & '.PerfilID');
		validacao[1].validacao = 'literal';
		validacao[1].requerido = 1;
		validacao[1].minimo = 5;
		validacao[1].limite = 100;
		if(len(u.unidadeResponsavel) gt 20){
			validacao[2]=StructNew();
			validacao[2].campo = 'Habilitação';
			if (not StructKeyExists(evaluate('form.' & controllernomecampo),"Habilitacao")){
				validacao[2].valor = '';
			}else{
				validacao[2].valor = evaluate('form.' & controllernomecampo & '.Habilitacao');
			} 
			validacao[2].validacao = 'literal';
			validacao[2].requerido = 1;
			validacao[2].minimo = 2;
			validacao[2].limite = 10000;
			validacao[3]=StructNew();
			validacao[3].campo = 'Unidade';
			if (not StructKeyExists(evaluate('form.' & controllernomecampo),"Unidade")){
				validacao[3].valor = '';
			}else{
				validacao[3].valor = evaluate('form.' & controllernomecampo & '.Unidade');
			} 
			validacao[3].validacao = 'literal';
			validacao[3].requerido = 1;
			validacao[3].minimo = 2;
			validacao[3].limite = 10000;
		}
		resultado = valida(validacao);
		status = resultado.status;
		mensagemstatus = resultado.mensagem;
		erros = resultado.contador;
	</cfscript>
	<cfset dados = StructNew() >
<cfif status eq 'OK'>		
	<cfset mensagemstatus='Dados registrados com sucesso!' >
	<cftry>	
		<cfquery name="insereperfils" datasource="#dsn#">
		insert into sgpo_perfils (perfilID, tipo, created, usuariocriou, ipcriou, hostcriou) values (<cfqueryparam  value="#form.Perfils.PerfilID#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Perfils.Tipo#" cfsqltype="cf_sql_char">, now(), '#u.usuarioID#', '#cgi.remote_addr#','#cgi.remote_host#');
		</cfquery>
		<cfparam name="form.Perfils.Habilitacao" default="">
		<cfparam name="form.Perfils.RegionalID" default="">
		<cfparam name="form.Perfils.UnidadeID" default="">
		<cfparam name="form.Perfils.SetorID" default="">
		<cfset formHabilitacao = form.Perfils.Habilitacao >
		<cfset formRegionalID = form.Perfils.RegionalID >
		<cfset formUnidadeID = form.Perfils.UnidadeID >
		<cfset formSetorID = form.Perfils.SetorID >

		<cfquery name="insereperfils" datasource="#dsn#">
			insert into sgpo_perfiljurisdicao (perfilID, unidadeResponsavel, regionalID, unidadeID, setorID, habilitacao, created, usuariocriou, ipcriou, hostcriou) values (<cfqueryparam  value="#form.Perfils.perfilID#" cfsqltype="cf_sql_char">,<cfqueryparam  value="#form.Perfils.UnidadeResponsavel#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#formRegionalID#" cfsqltype="cf_sql_longvarchar">,<cfqueryparam  value="#formUnidadeID#" cfsqltype="cf_sql_longvarchar">,<cfqueryparam  value="#formSetorID#" cfsqltype="cf_sql_longvarchar">,<cfqueryparam  value="#formHabilitacao#" cfsqltype="cf_sql_longvarchar">, now(), '#u.usuarioID#', '#cgi.remote_addr#','#cgi.remote_host#');
		</cfquery>

		<cfquery datasource="#dsn#" name="conteudoconsulta">
			select *, ur.nome as nomeunidade from sgpo_perfils sp
			inner join sgpo_perfiljurisdicao spj on (spj.perfilID=sp.perfilID)
			left join unidades ur on (ur.unidadeID=spj.unidadeResponsavel #sqlUnidadeID#)
			where
			(sp.perfilID like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or sp.tipo like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> ) 
			and sp.deleted is null 
			order by nomeunidade asc, sp.updated desc, sp.created desc;	
		</cfquery>
		<cfsavecontent variable="lista"><cfinclude template="../view/listperfil.cfm" ></cfsavecontent>
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
//<!-- -------------------------select--------------------------  -->
</cfscript>
<cfif Form.controller=='perfils' and Form.action=='atualizaselect' and evaluate('acoes.'& controllernomeplural & '["select"]')==1  and len(u.unidadeResponsavel) lt 10>
	<cfset tabelas = "unidades_regionais,unidades,sgpo_setores">
	<cfif isArray(form.contenha) >
		<cfset existencia = ListFind(tabelas, form.tabela) >
		<cfset contenha = ListQualify(ArrayToList(form.contenha), """") >
		<cfif existencia gt 0 >
			<cfquery datasource="#dsn#" name="conteudoconsulta">
				select #form.tabelaID# as id, #form.tabelacampo# as nome from #form.tabela# where #form.campoWhere# in (#contenha#) order by nome asc;
			</cfquery>
			<cfloop query="conteudoconsulta"><cfoutput><option value="#id#">#nome#</cfoutput></cfloop>
			<cfelse>
			<option value=""></option>
		</cfif>
	</cfif>
<cfabort>
</cfif>

