<cfif not StructKeyExists(session,"id") >
		<cfset status='ERRO'>
		<cfset mensagemstatus='O tempo da conexão terminou. <a href="../../../../../id/?i=logout&appID=#app.appID#">Log in novamente.</a>' >
		<cfinclude template="../view/fimsessao.cfm">
		<cfabort>		
</cfif>

<cfset id=CreateUUID()>
<cfparam name="Form.controller" default="">	
<cfparam name="conteudoconsulta" default="">	
<cfset controllernome='habilitacoes' >
<cfset controllernomeplural='habilitacoes' >
<cfset controllernomecampo='Habilitacoes' >
<cfparam name="url.pesquisa" default="">
<cfset url.i="Habilitação">
<cfset controllernomeid='habilitacaoID' >

<cfscript>
//<!-- -------------------------Setores--------------------------  -->
//<!-- -------------------------list--------------------------  -->
</cfscript>
<cfif Form.controller=='habilitacoes' and Form.action=='list' and evaluate('acoes.'& controllernomeplural & '["list"]')==1 >
	<cfset url.acao="list">
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cfparam name="completasql" default="">
	<cfset url.pesquisa = urldecode(url.pesquisa) >
	<cftry>	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
		select * from sgpo_habilitacoes where nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> order by dt_validade asc, nome asc;
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
	<cfinclude template="../view/listhabilitacoes.cfm">
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
		select s.setorID setorID, s.regionalID regionalID, s.unidadeID unidadeID, s.nome nomeSetor, ur.nome nomeUR, u.nome nomeU, s.telefone telefone, s.descricao descricao, s.created, s.usuariocriou, s.regiao from sgpo_setores as s inner join unidades_regionais ur on (ur.regionalID=s.regionalID and ur.deletedat is  null) inner join unidades u on (u.unidadeID=ur.unidadeID and u.deletedat is null)  where s.nome like <cfqueryparam  value="%#form.busca#%" cfsqltype="cf_sql_char"> and s.deleted is null ;
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
