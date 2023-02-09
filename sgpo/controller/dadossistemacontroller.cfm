<cfif not StructKeyExists(session,"id") >
		<cfset status='ERRO'>
		<cfset mensagemstatus='O tempo da conexão terminou. <a href="../../../../../id/?i=logout&appID=#app.appID#">Log in novamente.</a>' >
		<cfinclude template="../view/fimsessao.cfm">
		<cfabort>		
</cfif>
<cfset id=CreateUUID()>
<cfparam name="Form.controller" default="">	
<cfparam name="conteudoconsulta" default="">	
<cfset controllernome='dadossistema' >
<cfset controllernomeplural='dadossistemas' >
<cfset controllernomecampo='Dadossistemas' >
<cfparam name="url.pesquisa" default="">
<cfset url.i="Dadossistema">
<cfset controllernomeid='dadossistemaID' >
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
//<!-- -------------------------Dadossistemas--------------------------  -->
//<!-- -------------------------list--------------------------  -->
</cfscript>
<cfif Form.controller=='dadossistemas' and Form.action=='list' and evaluate('acoes.'& controllernomeplural & '["list"]')==1 >
	<cfset url.acao="list">
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cfparam name="completasql" default="">
	<cfset url.pesquisa = urldecode(url.pesquisa) >
	<cftry>	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
				select ds.nome, ds.sistema, ds.dadossistemaID, ds.cpf, ds.identidade, ds.matricula, ds.dtmovimentacao,
				ds.dtdesligamento, ds.dtapresentacao, ds.tipocontrato, ds.designado, ur.jurisdicao as regional,
				u.nome as unidade, ss.nome as nomesetor, ur.regionalID, ur.unidadeID from sgpo_dadossistemas ds
				inner join unidades_regionais ur on (ds.regionalID=ur.regionalID #sqlRegionalID#)
				inner join unidades u on (ur.unidadeID=u.unidadeID #sqlUnidadeID#)
				left join sgpo_setores ss on (ss.regionalID=ur.regionalID and ss.unidadeID=u.unidadeID #sqlSetorID#)
				where
				(ds.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or ds.cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or ds.identidade like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or matricula like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or u.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) 
				and ds.deleted is null and ds.designado is null 
				group by ds.dadossistemaID
				order by ds.updated desc, ds.created desc, regional asc, unidade asc, nomesetor asc, nome;
		</cfquery>
	<cfcatch type="any">
		<cfset status='ERRO'>
		<cfset conteudo=''>
	</cfcatch>	
	</cftry>	

	 
	<cfinclude template="../view/listdadossistema.cfm">
</cfif>

<cfscript>
//<!-- -------------------------Busca--------------------------  -->
</cfscript>
<cfif Form.controller=='dadossistemas' and Form.action=='busca' and evaluate('acoes.'& controllernomeplural & '["busca"]')==1 >
	<cfset url.acao="list">
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cfset url.pesquisa=#Form.busca#>
	<cfset url.pagina='1' >
	
	<cftry>	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
				select ds.nome, ds.sistema, ds.dadossistemaID, ds.cpf, ds.identidade, ds.matricula, ds.dtmovimentacao,
				ds.dtdesligamento, ds.dtapresentacao, ds.tipocontrato, ds.designado, ur.jurisdicao as regional,
				u.nome as unidade, ss.nome as nomesetor, ur.regionalID, ur.unidadeID from sgpo_dadossistemas ds
				inner join unidades_regionais ur on (ds.regionalID=ur.regionalID #sqlRegionalID#)
				inner join unidades u on (ur.unidadeID=u.unidadeID #sqlUnidadeID#)
				left join sgpo_setores ss on (ss.regionalID=ur.regionalID and ss.unidadeID=u.unidadeID #sqlSetorID#)
				where
				(ds.nome like <cfqueryparam  value="%#form.busca#%" cfsqltype="cf_sql_char"> or ds.cpf like <cfqueryparam  value="%#form.busca#%" cfsqltype="cf_sql_char"> or ds.identidade like <cfqueryparam  value="%#form.busca#%" cfsqltype="cf_sql_char"> or matricula like <cfqueryparam  value="%#form.busca#%" cfsqltype="cf_sql_char"> or u.nome like <cfqueryparam  value="%#form.busca#%" cfsqltype="cf_sql_char">) 
				and ds.deleted is null and ds.designado is null 
				group by ds.dadossistemaID
				order by ds.updated desc, ds.created desc, regional asc, unidade asc, nomesetor asc, nome;			
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

	 
	<cfinclude template="../view/listdadossistema.cfm">
</cfif>
<cfscript>
//<!-- -------------------------Ver--------------------------  -->
</cfscript>
<cfif Form.controller=='dadossistemas' and Form.action=='ver' and evaluate('acoes.'& controllernomeplural & '["ver"]')==1 >
	<cfset url.acao="ver">
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cftry>	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
		select d.*, concat(ur.jurisdicao,'-',ur.nome) as jurisdicao from sgpo_dadossistemas d inner join unidades_regionais ur on (d.regionalID=ur.regionalID #sqlRegionalID#)  where d.dadossistemaID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char"> and deleted is null and designado is null;
		</cfquery>
	<cfcatch type="any">
		<cfset status='ERRO'>
		<cfset conteudo=''>
	</cfcatch>	
	</cftry>	

	<cfinclude template="../view/verdadossistema.cfm">
</cfif>


<cfscript>
//<!-- -------------------------exclui--------------------------  -->
</cfscript>
<cfif Form.controller=='dadossistemas' and Form.action=='exclui' and evaluate('acoes.'& controllernomeplural & '["exclui"]')==1 >
	<cfset url.acao="exclui">
	<cfset status='OK'>
	<cfset mensagemstatus = 'O dadossistema ->' & #form.nome# & ' foi excluído com sucesso!'>
	<cfset url.pagina=#Form.pagina#>
	<cftry>	
		<cfquery datasource="#dsn#" name="excluidadossistemas">
		update sgpo_dadossistemas set deleted=now(), usuariodeletou='#u.usuarioID#', ipdeletou='#cgi.remote_addr#', hostdeletou='#cgi.remote_host#' where dadossistemaID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char">;
		</cfquery>
	<cfcatch type="any">
		<cfset status='ERRO'>
		<cfset mensagemstatus='A informação não pode ser excluída. Motivo:' & CFCATCH.Message >
		<cfset conteudo=''>
	</cfcatch>	
	</cftry>	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
				select ds.nome, ds.sistema, ds.dadossistemaID, ds.cpf, ds.identidade, ds.matricula, ds.dtmovimentacao,
				ds.dtdesligamento, ds.dtapresentacao, ds.tipocontrato, ds.designado, ur.jurisdicao as regional,
				u.nome as unidade, ss.nome as nomesetor, ur.regionalID, ur.unidadeID from sgpo_dadossistemas ds
				inner join unidades_regionais ur on (ds.regionalID=ur.regionalID #sqlRegionalID#)
				inner join unidades u on (ur.unidadeID=u.unidadeID #sqlUnidadeID#)
				left join sgpo_setores ss on (ss.regionalID=ur.regionalID and ss.unidadeID=u.unidadeID #sqlSetorID#)
				where
				(ds.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or ds.cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or ds.identidade like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or matricula like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or u.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) 
				and ds.deleted is null and ds.designado is null 
				group by ds.dadossistemaID
				order by ds.updated desc, ds.created desc, regional asc, unidade asc, nomesetor asc, nome;
		</cfquery>

	 
	<cfinclude template="../view/listdadossistema.cfm">
</cfif>


<cfscript>
//<!-- -------------------------veredit--------------------------  -->
</cfscript>
<cfif Form.controller=='dadossistemas' and Form.action=='veredit' and evaluate('acoes.'& controllernomeplural & '["veredit"]')==1 >
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
<cftry>	
	<cfquery datasource="#dsn#" name="conteudoconsulta">
		select d.*, concat(ur.jurisdicao,'-',ur.nome) as jurisdicao, ur.nome as nomeunidade, ur.regionalID from sgpo_dadossistemas d inner join unidades_regionais ur on (d.regionalID=ur.regionalID #sqlRegionalID# )  where d.dadossistemaID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char"> and deleted is null and designado is null;
	</cfquery>
<cfcatch type="any">
	<cfset status='ERRO'>
	<cfset conteudo=''>
</cfcatch>	
</cftry>	

<cfinclude template="../view/editdadossistema.cfm">
</cfif>

<cfscript>
//<!-- -------------------------vercad--------------------------  -->
</cfscript>
<cfif Form.controller=='dadossistemas' and Form.action=='vercad' and evaluate('acoes.'& controllernomeplural & '["vercad"]')==1 >
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cfinclude template="../view/caddadossistema.cfm">
</cfif>
	
<cfscript>
//<!-- -------------------------edit--------------------------  -->
</cfscript>
<cfif Form.controller=='dadossistemas' and Form.action=='edit' and evaluate('acoes.'& controllernomeplural & '["edit"]')==1 >
	<cfset url.pagina=#Form.pagina#>
	<cfset url.i='Dadossistema'>
	<cfset url.acao='list'>
	<cfset status='OK'>
	<cfset mensagemstatus='Dados registrados com sucesso!' >
<cftry>	
<cfparam name="editsetores" default="">
		<cfquery name="editsetores" datasource="#dsn#">
		update sgpo_dadossistemas set  regionalID=<cfqueryparam  value="#form.Dadossistemas.RegionalID#" cfsqltype="cf_sql_char">, nome=upper(<cfqueryparam  value="#form.Dadossistemas.Nome#" cfsqltype="cf_sql_char">), cpf=<cfqueryparam  value="#form.Dadossistemas.Cpf#" cfsqltype="cf_sql_char">, identidade=<cfqueryparam  value="#form.Dadossistemas.Identidade#" cfsqltype="cf_sql_char">, matricula=<cfqueryparam  value="#form.Dadossistemas.Matricula#" cfsqltype="cf_sql_char">, dtdesligamento=<cfqueryparam  value="#form.Dadossistemas.Dtdesligamento#" cfsqltype="cf_sql_date">, dtapresentacao=<cfqueryparam  value="#form.Dadossistemas.Dtapresentacao#" cfsqltype="cf_sql_date">, dtmovimentacao=<cfqueryparam  value="#form.Dadossistemas.Dtmovimentacao#" cfsqltype="cf_sql_date">, docmovimentacao=<cfqueryparam  value="#form.Dadossistemas.Docmovimentacao#" cfsqltype="cf_sql_char">, docdesligamento=<cfqueryparam  value="#form.Dadossistemas.Docdesligamento#" cfsqltype="cf_sql_char">,  updated=now(), usuariomodificou='#u.usuarioID#', ipmodificou='#cgi.remote_addr#', hostmodificou='#cgi.remote_host#' where dadossistemaID=<cfqueryparam  value="#form.Dadossistemas.DadossistemaID#" cfsqltype="cf_sql_char">
		</cfquery>	
	<cfscript>
		a=obtemSql(editsetores);
	</cfscript>
	<cfquery datasource="#dsn#" name="conteudoconsulta">
				select ds.nome, ds.sistema, ds.dadossistemaID, ds.cpf, ds.identidade, ds.matricula, ds.dtmovimentacao,
				ds.dtdesligamento, ds.dtapresentacao, ds.tipocontrato, ds.designado, ur.jurisdicao as regional,
				u.nome as unidade, ss.nome as nomesetor, ur.regionalID, ur.unidadeID from sgpo_dadossistemas ds
				inner join unidades_regionais ur on (ds.regionalID=ur.regionalID #sqlRegionalID#)
				inner join unidades u on (ur.unidadeID=u.unidadeID #sqlUnidadeID#)
				left join sgpo_setores ss on (ss.regionalID=ur.regionalID and ss.unidadeID=u.unidadeID #sqlSetorID#)
				where
				(ds.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or ds.cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or ds.identidade like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or matricula like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or u.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) 
				and ds.deleted is null and ds.designado is null 
				group by ds.dadossistemaID
				order by ds.updated desc, ds.created desc, regional asc, unidade asc, nomesetor asc, nome;
		
	</cfquery>
<cfcatch type="any">
	<cfset status='ERRO'>
	<cfset mensagemstatus='Dados não registrados. Motivo:' & CFCATCH.Message >
	<cfset conteudo=''>
</cfcatch>	
</cftry>	
	 
<cfinclude template="../view/listdadossistema.cfm">
</cfif>

<cfscript>
//<!-- -------------------------cad--------------------------  -->
</cfscript>
<cfif Form.controller=='dadossistemas' and Form.action=='cad' and evaluate('acoes.'& controllernomeplural & '["cad"]')==1 >
	<cfset status='OK'>
	<cfset mensagemstatus='Dados registrados com sucesso!' >
	<cfset url.pagina=#Form.pagina#>
	<cfset url.i='Dadossistema'>
	<cfset url.acao='list'>
<cftry>	
		<cfquery name="inseredadossistemas" datasource="#dsn#">
		insert into sgpo_dadossistemas (dadossistemaID, cadastroID, regionalID, nome, cpf, identidade, matricula, dtmovimentacao, dtmovimentacao, dtdesligamento, dtapresentacao, docmovimentacao, docdesligamento, created, usuariocriou, ipcriou, hostcriou) values ('#id#', '#id#', <cfqueryparam  value="#form.Dadossistemas.RegionalID#" cfsqltype="cf_sql_char">, upper(<cfqueryparam  value="#form.Dadossistemas.nome#" cfsqltype="cf_sql_char">), <cfqueryparam  value="#form.Dadossistemas.Cpf#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Dadossistemas.Identidade#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Dadossistemas.Matricula#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Dadossistemas.Dtmovimentacao#" cfsqltype="cf_sql_date">, <cfqueryparam  value="#form.Dadossistemas.Dtdesligamento#" cfsqltype="cf_sql_date">, <cfqueryparam  value="#form.Dadossistemas.Dtapresentacao#" cfsqltype="cf_sql_date">, <cfqueryparam  value="#form.Dadossistemas.Docmovimentacao#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Dadossistemas.Docdesligamento#" cfsqltype="cf_sql_char">, now(), '#u.usuarioID#', '#cgi.remote_addr#','#cgi.remote_host#')
		</cfquery>
		
	<cfscript>
	hoje=dateformat(now(),'yyyy-mm-dd');
	</cfscript>	
	<cfquery datasource="#dsn#" name="conteudoconsulta">
				select ds.nome, ds.sistema, ds.dadossistemaID, ds.cpf, ds.identidade, ds.matricula, ds.dtmovimentacao,
				ds.dtdesligamento, ds.dtapresentacao, ds.tipocontrato, ds.designado, ur.jurisdicao as regional,
				u.nome as unidade, ss.nome as nomesetor, ur.regionalID, ur.unidadeID from sgpo_dadossistemas ds
				inner join unidades_regionais ur on (ds.regionalID=ur.regionalID #sqlRegionalID#)
				inner join unidades u on (ur.unidadeID=u.unidadeID #sqlUnidadeID#)
				left join sgpo_setores ss on (ss.regionalID=ur.regionalID and ss.unidadeID=u.unidadeID #sqlSetorID#)
				where
				(ds.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or ds.cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or ds.identidade like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or matricula like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or u.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) 
				and ds.deleted is null and ds.designado is null 
				group by ds.dadossistemaID
				order by ds.updated desc, ds.created desc, regional asc, unidade asc, nomesetor asc, nome;
	</cfquery>
	<cfscript>
		a=obtemSql(conteudoconsulta);
	</cfscript>
<cfcatch type="any">
	<cfset status='ERRO'>
	<cfset mensagemstatus='Dados não registrados. Motivo:' & CFCATCH.Message >
	<cfset conteudo=''>
</cfcatch>	
</cftry>	
	 
<cfinclude template="../view/listdadossistema.cfm">
</cfif>

<cfscript>
//<!-- -------------------------verdesigna--------------------------  -->
</cfscript>
<cfif Form.controller=='dadossistemas' and Form.action=='vercaddesigna' and evaluate('acoes.'& controllernomeplural & '["caddesignacao"]')==1 >
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cfquery datasource="#dsn#" name="conteudoconsulta">
		select * from sgpo_dadossistemas where dadossistemaID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char"> and deleted is null and designado is null order by updated desc, created desc;
	</cfquery>
	<cfinclude template="../view/caddesignacao.cfm">
</cfif>


<cfscript>
//<!-- -------------------------caddesignacao--------------------------  -->
</cfscript>
<cfif Form.controller=='dadossistemas' and Form.action=='caddesignacao' and evaluate('acoes.'& controllernomeplural & '["caddesignacao"]')==1 >
	<cfset status='OK'>
	<cfset mensagemstatus='Dados registrados com sucesso!' >
	<cfset url.pagina=#Form.pagina#>
	<cfset url.i='Dadossistema'>
	<cfset url.pesquisa = urldecode(url.pesquisa) >
	<cfset url.acao='list'>
		<cfquery name="processo" datasource="#dsn#">
		select numeroprocesso from sgpo_estagiarios order by numeroprocesso desc limit 0,1;
		</cfquery>
		<cfif processo.numeroprocesso gte 1000>
		<cfset nrprocesso=processo.numeroprocesso +1 >
		</cfif> 
<cftry>	
		<cfquery name="inseredadossistemas" datasource="#dsn#">
		insert into sgpo_estagiarios (estagiarioID, setorID, dadossistemaID, tipocontrato, cpf, nome, horassimulador,horasnecessarias, obs, inicioestagio, numeroprocesso, habilitacaoID, funcao, created, usuariocriou, ipcriou, hostcriou) values ('#id#',  <cfqueryparam  value="#form.Dadossistemas.SetorID#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Dadossistemas.DadossistemaID#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Dadossistemas.Tipocontrato#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Dadossistemas.Cpf#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Dadossistemas.Nome#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Dadossistemas.Horassimulador#" cfsqltype="cf_sql_integer">, <cfqueryparam  value="#form.Dadossistemas.Horasnecessarias#" cfsqltype="cf_sql_integer">,  <cfqueryparam  value="#form.Dadossistemas.obs#" cfsqltype="cf_sql_char">, now(), '#nrprocesso#', <cfqueryparam  value="#form.Dadossistemas.HabilitacaoID#" cfsqltype="cf_sql_integer">, <cfqueryparam  value="#form.Dadossistemas.Funcao#" cfsqltype="cf_sql_char">, now(), '#u.usuarioID#', '#cgi.remote_addr#','#cgi.remote_host#')
		</cfquery>
		
		<cfquery name="atualiza" datasource="#dsn#">
		update sgpo_dadossistemas set designado='S' where dadossistemaID=<cfqueryparam  value="#form.Dadossistemas.DadossistemaID#" cfsqltype="cf_sql_char">;
		</cfquery>
		
		<cfquery datasource="#dsn#" name="conteudoconsulta">
				select ds.nome, ds.sistema, ds.dadossistemaID, ds.cpf, ds.identidade, ds.matricula, ds.dtmovimentacao,
				ds.dtdesligamento, ds.dtapresentacao, ds.tipocontrato, ds.designado, ur.jurisdicao as regional,
				u.nome as unidade, ss.nome as nomesetor, ur.regionalID, ur.unidadeID from sgpo_dadossistemas ds
				inner join unidades_regionais ur on (ds.regionalID=ur.regionalID #sqlRegionalID#)
				inner join unidades u on (ur.unidadeID=u.unidadeID #sqlUnidadeID#)
				left join sgpo_setores ss on (ss.regionalID=ur.regionalID and ss.unidadeID=u.unidadeID #sqlSetorID#)
				where
				(ds.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or ds.cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or ds.identidade like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or matricula like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or u.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) 
				and ds.deleted is null and ds.designado is null 
				group by ds.dadossistemaID
				order by ds.updated desc, ds.created desc, regional asc, unidade asc, nomesetor asc, nome;
</cfquery>
		<cfset mensagemstatus='#form.Dadossistemas.Cpf# - #form.Dadossistemas.Nome# designado com sucesso' >
	<cfscript>
		a=obtemSql(conteudoconsulta);
	</cfscript>
<cfcatch type="any">
	<cfset status='ERRO'>
	<cfset mensagemstatus='Dados não registrados. Motivo:' & CFCATCH.Message >
	<cfset conteudo=''>
</cfcatch>	
</cftry>	
	 
<cfinclude template="../view/listdadossistema.cfm">
</cfif>
<cfscript>
//<!-- -------------------------select--------------------------  -->
</cfscript>
<cfif Form.controller=='unidadesregionais' and Form.action=='select' and evaluate('acoes.'& controllernomeplural & '["vercad"]')==1 >
<cftry>	
	<cfquery datasource="#dsn#" name="selectunidadesregionais">
	select *, ss.nome as nome from sgpo_setores  ss
	inner join unidades_regionais ur on (ss.unidadeID=ur.unidadeID #sqlSetorID# and ss.regionalID=ur.regionalID #sqlRegionalID#)
	 where ur.regionalID=<cfqueryparam  value="#form.regionalid#" cfsqltype="cf_sql_char">  and ss.deleted is null  order by ss.nome asc;
	</cfquery>
	<cfscript>
		a=obtemSql(selectunidadesregionais);
	</cfscript>
<cfcatch type="any">
	<cfset conteudo=''>
</cfcatch>	
</cftry>
	<cfoutput query="selectunidadesregionais"><option value="#setorID#">#nome# #regiao#</cfoutput>
</cfif>
