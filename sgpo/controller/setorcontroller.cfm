<cfif not StructKeyExists(session,"id") >
		<cfset status='ERRO'>
		<cfset mensagemstatus='O tempo da conexão terminou. <a href="../../../../../id/?i=logout&appID=#app.appID#">Log in novamente.</a>' >
		<cfinclude template="../view/fimsessao.cfm">
		<cfabort>		
</cfif>

<cfset id=CreateUUID()>
<cfparam name="Form.controller" default="">	
<cfparam name="conteudoconsulta" default="">	
<cfset controllernome='setor' >
<cfset controllernomeplural='setores' >
<cfset controllernomecampo='Setores' >
<cfparam name="url.pesquisa" default="">
<cfset url.i="Setor">
<cfset controllernomeid='setorID' >

<cfscript>
//<!-- -------------------------Setores--------------------------  -->
//<!-- -------------------------list--------------------------  -->
</cfscript>
<cfif Form.controller=='setores' and Form.action=='list' and evaluate('acoes.'& controllernomeplural & '["list"]')==1 >
	<cfset url.acao="list">
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cfparam name="completasql" default="">
	<cfset url.pesquisa = urldecode(url.pesquisa) >
	<cftry>	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
		select s.tepatco,s.setorID setorID, s.regionalID regionalID, s.unidadeID unidadeID, s.nome nomeSetor, ur.nome nomeUR, u.nome nomeU, s.telefone telefone, s.descricao descricao, s.created, s.usuariocriou, s.regiao from sgpo_setores as s inner join unidades_regionais ur on (ur.regionalID=s.regionalID and ur.deletedat is  null) inner join unidades u on (u.unidadeID=ur.unidadeID and u.deletedat is null)
		where s.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> and s.deleted is null order by s.updated desc, s.created desc;
		</cfquery>
	<cfcatch type="any">
		<cfset status='ERRO'>
		<cfset conteudo=''>
	</cfcatch>	
	</cftry>	
			<cfif isquery(conteudoconsulta) >
				<cfif queryrecordcount(conteudoconsulta) gt 0 >
					<cfset status='OK'>
					<cfset mensagemstatus=#conteudoconsulta.recordcount# & ' registro(s) encontrado(s) '>
				</cfif>
			</cfif>
	<cfinclude template="../view/listsetor.cfm">
</cfif>

<cfscript>
//<!-- -------------------------Busca--------------------------  -->
</cfscript>
<cfif Form.controller=='setores' and Form.action=='busca' and evaluate('acoes.'& controllernomeplural & '["busca"]')==1 >
	<cfset url.acao="list">
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cfset url.pesquisa=#Form.busca#>
	<cfset url.pagina='1' >
	<cftry>	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
		select s.tepatco, s.setorID setorID, s.regionalID regionalID, s.unidadeID unidadeID, s.nome nomeSetor, ur.nome nomeUR, u.nome nomeU, s.telefone telefone, s.descricao descricao, s.created, s.usuariocriou, s.regiao from sgpo_setores as s inner join unidades_regionais ur on (ur.regionalID=s.regionalID and ur.deletedat is  null #sqlRegionalID# #sqlUnidadeID#) inner join unidades u on (u.unidadeID=ur.unidadeID and u.deletedat is null)  where s.nome like <cfqueryparam  value="%#form.busca#%" cfsqltype="cf_sql_char"> and s.deleted is null ;
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

	<cfinclude template="../view/listsetor.cfm">
</cfif>
<cfscript>
//<!-- -------------------------Ver--------------------------  -->
</cfscript>
<cfif Form.controller=='setores' and Form.action=='ver' and evaluate('acoes.'& controllernomeplural & '["ver"]')==1 >
	<cfset url.acao="ver">
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cftry>	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
		select s.tepatco, s.setorID setorID, s.regionalID regionalID, s.unidadeID unidadeID, s.nome nomeSetor, ur.nome nomeUR, u.nome nomeU, s.telefone telefone, s.descricao descricao, s.created, s.usuariocriou, s.regiao from sgpo_setores as s inner join unidades_regionais ur on (ur.regionalID=s.regionalID and ur.deletedat is  null #sqlRegionalID# #sqlUnidadeID#) inner join unidades u on (u.unidadeID=ur.unidadeID and u.deletedat is null)  where s.setorID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char"> and s.deleted is null;
		</cfquery>
	<cfcatch type="any">
		<cfset status='ERRO'>
		<cfset conteudo=''>
	</cfcatch>	
	</cftry>	

	<cfinclude template="../view/versetor.cfm">
</cfif>


<cfscript>
//<!-- -------------------------exclui--------------------------  -->
</cfscript>
<cfif Form.controller=='setores' and Form.action=='exclui' and evaluate('acoes.'& controllernomeplural & '["exclui"]')==1 >
	<cfset url.acao="exclui">
	<cfset status='OK'>
	<cfset mensagemstatus = 'O setor ->' & #form.nome# & ' foi excluído com sucesso!'>
	<cfset url.pagina=#Form.pagina#>
	<cftry>	
		<cfquery datasource="#dsn#" name="excluisetores">
		update sgpo_setores set deleted=now(), usuariodeletou='#u.usuarioID#', ipdeletou='#cgi.remote_addr#', hostdeletou='#cgi.remote_host#' where setorID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char">;
		</cfquery>
		<cfquery datasource="#dsn#" name="conteudoconsulta">
		select s.tepatco, s.setorID setorID, s.regionalID regionalID, s.unidadeID unidadeID, s.nome nomeSetor, ur.nome nomeUR, u.nome nomeU, s.telefone telefone, s.descricao descricao, s.created, s.usuariocriou, s.regiao from sgpo_setores as s inner join unidades_regionais ur on (ur.regionalID=s.regionalID and ur.deletedat is  null #sqlRegionalID# #sqlUnidadeID#) inner join unidades u on (u.unidadeID=ur.unidadeID and u.deletedat is null) where s.deleted is null  order by s.updated desc,  s.created desc;
		</cfquery>
		<cfscript>
			a=obtemSql(conteudoconsulta);
		</cfscript>
	<cfcatch type="any">
		<cfquery datasource="#dsn#" name="conteudoconsulta">
		select s.tepatco, s.setorID setorID, s.regionalID regionalID, s.unidadeID unidadeID, s.nome nomeSetor, ur.nome nomeUR, u.nome nomeU, s.telefone telefone, s.descricao descricao, s.created, s.usuariocriou, s.regiao from sgpo_setores as s inner join unidades_regionais ur on (ur.regionalID=s.regionalID and ur.deletedat is  null #sqlRegionalID# #sqlUnidadeID#) inner join unidades u on (u.unidadeID=ur.unidadeID and u.deletedat is null) where s.deleted is null  order by s.updated desc,  s.created desc;
		</cfquery>
		<cfset status='ERRO'>
		<cfset mensagemstatus='A informação não pode ser excluída. Motivo:' & CFCATCH.Message >
		<cfset conteudo=''>
	</cfcatch>	
	</cftry>	

	<cfinclude template="../view/listsetor.cfm">
</cfif>


<cfscript>
//<!-- -------------------------veredit--------------------------  -->
</cfscript>
<cfif Form.controller=='setores' and Form.action=='veredit' and evaluate('acoes.'& controllernomeplural & '["veredit"]')==1 >
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
<cftry>	
	<cfquery datasource="#dsn#" name="conteudoconsulta">
	select s.tepatco, s.setorID setorID, s.regionalID regionalID, s.unidadeID unidadeID, s.nome nomeSetor, ur.nome nomeUR, u.nome nomeU, s.telefone telefone, s.descricao descricao, s.created, s.usuariocriou, s.regiao from sgpo_setores as s inner join unidades_regionais ur on (ur.regionalID=s.regionalID and ur.deletedat is  null #sqlRegionalID# #sqlUnidadeID#) inner join unidades u on (u.unidadeID=ur.unidadeID and u.deletedat is null) where s.setorID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char"> and s.deleted is null;
	</cfquery>
<cfcatch type="any">
	<cfset status='ERRO'>
	<cfset conteudo=''>
</cfcatch>	
</cftry>	
<cfinclude template="../view/editsetor.cfm">
</cfif>

<cfscript>
//<!-- -------------------------vercad--------------------------  -->
</cfscript>
<cfif Form.controller=='setores' and Form.action=='vercad' and evaluate('acoes.'& controllernomeplural & '["vercad"]')==1 >
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cfinclude template="../view/cadsetor.cfm">
</cfif>

<cfscript>
//<!-- -------------------------edit--------------------------  -->
</cfscript>
<cfif Form.controller=='setores' and Form.action=='edit' and evaluate('acoes.'& controllernomeplural & '["edit"]')==1 >
	<cfset url.pagina=#Form.pagina#>
	<cfset url.i='Setor'>
	<cfset url.acao='list'>
	<cfset status='OK'>
	<cfset mensagemstatus='Dados registrados com sucesso!' >
	<cfscript>
		validacao = ArrayNew();
		validacao[1]=StructNew();
		validacao[1].campo = 'Setor';
		validacao[1].valor = evaluate('form.' & controllernomecampo & '.Nome');
		validacao[1].validacao = 'literal';
		validacao[1].requerido = 1;
		validacao[1].minimo = 3;
		validacao[1].limite = 200;
		validacao[2]=StructNew();
		validacao[2].campo = 'Região';
		validacao[2].valor = evaluate('form.' & controllernomecampo & '.Regiao');
		validacao[2].validacao = 'literal';
		validacao[2].requerido = 0;
		validacao[2].minimo = 2;
		validacao[2].limite = 200;
		validacao[3]=StructNew();
		validacao[3].campo = 'TEP ATCO';
		validacao[3].valor = evaluate('form.' & controllernomecampo & '.Tepatco');
		validacao[3].validacao = 'numero';
		validacao[3].requerido = 1;
		validacao[3].minimo = 1;
		validacao[3].limite = 200;
		resultado = valida(validacao);
		status = resultado.status;
		mensagemstatus = resultado.mensagem;
		erros = resultado.contador;
	</cfscript>
<cfif status eq 'OK'>		
	<cfset mensagemstatus='Dados registrados com sucesso!' >
	<cftry>	
			<cfquery name="editsetores" datasource="#dsn#">
			update sgpo_setores set tepatco=<cfqueryparam  value="#form.Setores.Tepatco#" cfsqltype="cf_sql_char">, regionalID=<cfqueryparam  value="#form.Setores.RegionalID#" cfsqltype="cf_sql_char">, unidadeID=<cfqueryparam  value="#form.Setores.UnidadeID#" cfsqltype="cf_sql_char">, nome=<cfqueryparam  value="#UCase(form.Setores.Nome)#" cfsqltype="cf_sql_char">,regiao=<cfqueryparam  value="#UCase(form.Setores.Regiao)#" cfsqltype="cf_sql_char">, telefone=<cfqueryparam  value="#form.Setores.Telefone#" cfsqltype="cf_sql_char">, descricao=<cfqueryparam  value="#form.Setores.Descricao#" cfsqltype="cf_sql_char">, updated=now(), usuariomodificou='#u.usuarioID#', ipmodificou='#cgi.remote_addr#', hostmodificou='#cgi.remote_host#' where setorID=<cfqueryparam  value="#form.Setores.SetorID#" cfsqltype="cf_sql_char">;
			</cfquery>	
			<cfquery datasource="#dsn#" name="conteudoconsulta">
			select s.tepatco tepatco, s.setorID setorID, s.regionalID regionalID, s.unidadeID unidadeID, s.nome nomeSetor, ur.nome nomeUR, u.nome nomeU, s.telefone telefone, s.descricao descricao, s.created, s.usuariocriou, s.regiao from sgpo_setores as s inner join unidades_regionais ur on (ur.regionalID=s.regionalID and ur.deletedat is  null #sqlRegionalID# #sqlUnidadeID#) inner join unidades u on (u.unidadeID=ur.unidadeID and u.deletedat is null) where s.deleted is null   order by s.updated desc,  s.created desc;
			</cfquery>
			<cfsavecontent variable="lista"><cfinclude template="../view/listsetor.cfm" ></cfsavecontent>
	<cfcatch type="any">
			<cfset status='ERRO'>
			<cfset mensagemstatus='Dados não registrados. Motivo:' & CFCATCH.Message >
			<cfset conteudo=''>
	</cfcatch>	
	</cftry>
	<cfset dados = StructNew() >
	<cfset StructInsert(dados, 'status', status, 'TRUE')>
	<cfset StructInsert(dados, 'mensagemstatus', mensagemstatus, 'TRUE') >
	<cfset StructInsert(dados, 'conteudo', lista , 'TRUE') >
	<cfcontent type="application/x-json"><cfoutput>#serializeJSON(dados, true)#</cfoutput></cfcontent>
	<cfabort>
<cfelse>
	<cfset dados = StructNew() >
	<cfset StructInsert(dados, 'status', status, 'TRUE')>
	<cfset StructInsert(dados, 'mensagemstatus', mensagemstatus, 'TRUE') >
	<cfcontent type="application/x-json"><cfoutput>#serializeJSON(dados, true)#</cfoutput></cfcontent>
	<cfabort>
</cfif>
</cfif>

<cfscript>
//<!-- -------------------------cad--------------------------  -->
</cfscript>
<cfif Form.controller=='setores' and Form.action=='cad' and evaluate('acoes.'& controllernomeplural & '["cad"]')==1 >
	<cfset status='OK'>
	<cfset mensagemstatus='' >
	<cfset url.pagina=#Form.pagina#>
	<cfset url.i='Setor'>
	<cfset url.acao='list'>
	<cfparam name="erros" default="0">
	<cfscript>
		validacao = ArrayNew();
		validacao[1]=StructNew();
		validacao[1].campo = 'Nome';
		validacao[1].valor = evaluate('form.' & controllernomecampo & '.Nome');
		validacao[1].validacao = 'literal';
		validacao[1].requerido = 1;
		validacao[1].minimo = 3;
		validacao[1].limite = 200;
		validacao[2]=StructNew();
		validacao[2].campo = 'Região';
		validacao[2].valor = evaluate('form.' & controllernomecampo & '.Regiao');
		validacao[2].validacao = 'literal';
		validacao[2].requerido = 0;
		validacao[2].minimo = 2;
		validacao[2].limite = 200;
		validacao[3]=StructNew();
		validacao[3].campo = 'TEP ATCO';
		validacao[3].valor = evaluate('form.' & controllernomecampo & '.Tepatco');
		validacao[3].validacao = 'numero';
		validacao[3].requerido = 1;
		validacao[3].minimo = 1;
		validacao[3].limite = 200;
		resultado = valida(validacao);
		status = resultado.status;
		mensagemstatus = resultado.mensagem;
		erros = resultado.contador;
	</cfscript>
<cfif status eq 'OK'>		
	<cfset mensagemstatus='Dados registrados com sucesso!' >
	<cftry>	
			<cfquery name="inseresetores" datasource="#dsn#">
			insert into sgpo_setores (setorID, regionalID, unidadeID, nome, regiao, tepatco, telefone, descricao, created, usuariocriou, ipcriou, hostcriou) values ('#id#', <cfqueryparam  value="#form.Setores.RegionalID#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Setores.UnidadeID#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#UCase(form.Setores.Nome)#" cfsqltype="cf_sql_char">,<cfqueryparam  value="#UCase(form.Setores.Regiao)#" cfsqltype="cf_sql_char">,<cfqueryparam  value="#form.Setores.Tepatco#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Setores.Telefone#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Setores.Descricao#" cfsqltype="cf_sql_char">, now(), '#u.usuarioID#', '#cgi.remote_addr#','#cgi.remote_host#');
			</cfquery>
			<cfquery datasource="#dsn#" name="conteudoconsulta">
				select s.tepatco, s.setorID setorID, s.regionalID regionalID, s.unidadeID unidadeID, s.nome nomeSetor, ur.nome nomeUR, u.nome nomeU, s.telefone telefone, s.descricao descricao, s.created, s.usuariocriou, s.regiao from sgpo_setores as s inner join unidades_regionais ur on (ur.regionalID=s.regionalID and ur.deletedat is  null #sqlRegionalID# #sqlUnidadeID#) inner join unidades u on (u.unidadeID=ur.unidadeID and u.deletedat is null) where s.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> and s.deleted is null   order by s.updated desc,  s.created desc;
			</cfquery>
			<cfsavecontent variable="lista"><cfinclude template="../view/listsetor.cfm" ></cfsavecontent>
	<cfcatch type="any">
		<cfset status='ERRO'>
		<cfset mensagemstatus='Dados não registrados. Motivo:' & CFCATCH.Message >
		<cfset conteudo=''>
	</cfcatch>	
	</cftry>
	<cfset dados = StructNew() >
	<cfset StructInsert(dados, 'status', status, 'TRUE')>
	<cfset StructInsert(dados, 'mensagemstatus', mensagemstatus, 'TRUE') >
	<cfset StructInsert(dados, 'conteudo', lista , 'TRUE') >
	<cfcontent type="application/x-json"><cfoutput>#serializeJSON(dados, true)#</cfoutput></cfcontent>
	<cfabort>
<cfelse>
	<cfset dados = StructNew() >
	<cfset StructInsert(dados, 'status', status, 'TRUE')>
	<cfset StructInsert(dados, 'mensagemstatus', mensagemstatus, 'TRUE') >
	<cfcontent type="application/x-json"><cfoutput>#serializeJSON(dados, true)#</cfoutput></cfcontent>
	<cfabort>
</cfif>

</cfif>

<cfscript>
//<!-- -------------------------select--------------------------  -->
</cfscript>
<cfif Form.controller=='unidadesregionais' and Form.action=='select' and evaluate('acoes.'& controllernomeplural & '["select"]')==1 >
<cftry>	
	<cfquery datasource="#dsn#" name="selectunidadesregionais">
	select * from unidades_regionais where unidadeID=<cfqueryparam  value="#form.unidadeid#" cfsqltype="cf_sql_char">  and deletedat is null  order by nome asc;
	</cfquery>
	<cfscript>
		a=obtemSql(selectunidadesregionais);
	</cfscript>
<cfcatch type="any">
	<cfset conteudo=''>
	<cfdump var="#selectunidadesregionais#">
</cfcatch>	
</cftry>
	<cfoutput query="selectunidadesregionais"><option value="#regionalID#">#nome#</cfoutput>
</cfif>
