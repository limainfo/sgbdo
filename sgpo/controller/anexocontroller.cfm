<cfif not StructKeyExists(session,"id") >
		<cfset status='ERRO'>
		<cfset mensagemstatus='O tempo da conexão terminou. <a href="../../../../../id/?i=logout&appID=#app.appID#">Log in novamente.</a>' >
		<cfinclude template="../view/fimsessao.cfm">
		<cfabort>		
</cfif>
<cfset id=CreateUUID()>
<cfparam name="Form.controller" default="">	
<cfparam name="conteudoconsulta" default="">	
<cfset controllernome='anexo' >
<cfset controllernomeid='anexoID' >
<cfset controllernomeplural='anexos' >
<cfset controllernomecampo='Anexos' >
<cfparam name="url.pesquisa" default="">
<cfset url.i="Anexo">
<cfscript>
//<!-- -------------------------Anexos--------------------------  -->
//<!-- -------------------------list--------------------------  -->
</cfscript>
<cfif Form.controller=='anexos' and Form.action=='list' and evaluate('acoes.'& controllernomeplural & '["list"]')==1 >
	<cfset url.acao="list">
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cfparam name="completasql" default="">
	<cfset url.pesquisa = urldecode(url.pesquisa) >
	<cftry>	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
		select * from sgpo_anexos where (anexo like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or item like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or documento like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or areaavaliada like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) and  deleted is null  order by updated desc, created desc;
		</cfquery>
	<cfcatch type="any">
		<cfset status='ERRO'>
		<cfset conteudo=''>
	</cfcatch>	
	</cftry>	

	<cfinclude template="../view/listanexo.cfm">
</cfif>

<cfscript>
//<!-- -------------------------Busca--------------------------  -->
</cfscript>
<cfif Form.controller=='anexos' and Form.action=='busca' and evaluate('acoes.'& controllernomeplural & '["busca"]')==1 >
	<cfset url.acao="list">
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cfset url.pesquisa=#Form.busca#>
	<cfset url.pagina='1' >
	
	<cftry>	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
		select * from sgpo_anexos  where (anexo like <cfqueryparam  value="%#form.busca#%" cfsqltype="cf_sql_char"> or item like <cfqueryparam  value="%#form.busca#%" cfsqltype="cf_sql_char"> or documento like <cfqueryparam  value="%#form.busca#%" cfsqltype="cf_sql_char"> or areaavaliada like <cfqueryparam  value="%#form.busca#%" cfsqltype="cf_sql_char">) and deleted is null ;
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

	<cfinclude template="../view/listanexo.cfm">
</cfif>
<cfscript>
//<!-- -------------------------Ver--------------------------  -->
</cfscript>
<cfif Form.controller=='anexos' and Form.action=='ver' and evaluate('acoes.'& controllernomeplural & '["ver"]')==1 >
	<cfset url.acao="ver">
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cftry>	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
		select * from sgpo_anexos  where anexoID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char"> and deleted is null;
		</cfquery>
	<cfcatch type="any">
		<cfset status='ERRO'>
		<cfset conteudo=''>
	</cfcatch>	
	</cftry>	

	<cfinclude template="../view/veranexo.cfm">
</cfif>


<cfscript>
//<!-- -------------------------exclui--------------------------  -->
</cfscript>
<cfif Form.controller=='anexos' and Form.action=='exclui' and evaluate('acoes.'& controllernomeplural & '["exclui"]')==1 >
	<cfset url.acao="exclui">
	<cfset status='OK'>
	<cfset mensagemstatus = 'O anexo ->' & #form.nome# & ' foi excluído com sucesso!'>
	<cfset url.pagina=#Form.pagina#>
	<cftry>	
		<cfquery datasource="#dsn#" name="excluianexos">
		update sgpo_anexos set deleted=now(), usuariodeletou='#u.usuarioID#', ipdeletou='#cgi.remote_addr#', hostdeletou='#cgi.remote_host#' where anexoID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char">;
		</cfquery>
		<cfquery datasource="#dsn#" name="conteudoconsulta">
		select * from sgpo_anexos where deleted is null order by updated desc, created desc;
		</cfquery>
		<cfscript>
			a=obtemSql(conteudoconsulta);
		</cfscript>
	<cfcatch type="any">
		<cfquery datasource="#dsn#" name="conteudoconsulta">
		select * from sgpo_anexos where deleted is null order by updated desc, created desc;
		</cfquery>
		<cfset status='ERRO'>
		<cfset mensagemstatus='A informação não pode ser excluída. Motivo:' & CFCATCH.Message >
		<cfset conteudo=''>
	</cfcatch>	
	</cftry>	

	<cfinclude template="../view/listanexo.cfm">
</cfif>


<cfscript>
//<!-- -------------------------veredit--------------------------  -->
</cfscript>
<cfif Form.controller=='anexos' and Form.action=='veredit' and evaluate('acoes.'& controllernomeplural & '["veredit"]')==1 >
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
<cftry>	
	<cfquery datasource="#dsn#" name="conteudoconsulta">
	select * from sgpo_anexos where anexoID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char"> and deleted is null;
	</cfquery>
<cfcatch type="any">
	<cfset status='ERRO'>
	<cfset conteudo=''>
</cfcatch>	
</cftry>	
<cfinclude template="../view/editanexo.cfm">
</cfif>

<cfscript>
//<!-- -------------------------vercad--------------------------  -->
</cfscript>
<cfif Form.controller=='anexos' and Form.action=='vercad' and evaluate('acoes.'& controllernomeplural & '["vercad"]')==1 >
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cfinclude template="../view/cadanexo.cfm">
</cfif>

<cfscript>
//<!-- -------------------------edit--------------------------  -->
</cfscript>
<cfif Form.controller=='anexos' and Form.action=='edit' and evaluate('acoes.'& controllernomeplural & '["edit"]')==1 >
	<cfset url.pagina=#Form.pagina#>
	<cfset url.i='Anexo'>
	<cfset url.acao='list'>
	<cfset status='OK'>
	<cfset mensagemstatus='Dados registrados com sucesso!' >
	<cfscript>
		validacao = ArrayNew();
		validacao[1]=StructNew();
		validacao[1].campo = 'Documento';
		validacao[1].valor = evaluate('form.' & controllernomecampo & '.Documento');
		validacao[1].validacao = 'literal';
		validacao[1].requerido = 1;
		validacao[1].minimo = 4;
		validacao[1].limite = 100;
		validacao[2]=StructNew();
		validacao[2].campo = 'Item';
		validacao[2].valor = evaluate('form.' & controllernomecampo & '.Item');
		validacao[2].validacao = 'literal';
		validacao[2].requerido = 1;
		validacao[2].minimo = 1;
		validacao[2].limite = 20;
		validacao[3]=StructNew();
		validacao[3].campo = 'Areaavaliada';
		validacao[3].valor = evaluate('form.' & controllernomecampo & '.Areaavaliada');
		validacao[3].validacao = 'literal';
		validacao[3].requerido = 1;
		validacao[3].minimo = 1;
		validacao[3].limite = 100;
		validacao[4]=StructNew();
		validacao[4].campo = 'Itemavaliado';
		validacao[4].valor = evaluate('form.' & controllernomecampo & '.Itemavaliado');
		validacao[4].validacao = 'literal';
		validacao[4].requerido = 1;
		validacao[4].minimo = 1;
		validacao[4].limite = 100;
		validacao[5]=StructNew();
		validacao[5].campo = 'SequenciaItem';
		validacao[5].valor = evaluate('form.' & controllernomecampo & '.SequenciaItem');
		validacao[5].validacao = 'numero';
		validacao[5].requerido = 1;
		validacao[5].minimo = 1;
		validacao[5].limite = 3;
		resultado = valida(validacao);
		status = resultado.status;
		mensagemstatus = resultado.mensagem;
		erros = resultado.contador;

	</cfscript>
	<cfset dados = StructNew() >
<cfif status eq 'OK'>		
	<cfset mensagemstatus='Dados registrados com sucesso!' >
	<cftry>	
			<cfquery name="editsetores" datasource="#dsn#">
			update sgpo_anexos set  anexo=<cfqueryparam  value="#form.Anexos.Anexo#" cfsqltype="cf_sql_char">, documento=<cfqueryparam  value="#form.Anexos.Documento#" cfsqltype="cf_sql_char">, areaavaliada=<cfqueryparam  value="#form.Anexos.Areaavaliada#" cfsqltype="cf_sql_char">, dicaareaavaliada=<cfqueryparam  value="#form.Anexos.Dicaareaavaliada#" cfsqltype="cf_sql_char">, itemavaliado=<cfqueryparam  value="#form.Anexos.Itemavaliado#" cfsqltype="cf_sql_char">, dicaotimo=<cfqueryparam  value="#form.Anexos.Dicaotimo#" cfsqltype="cf_sql_char">, dicabom=<cfqueryparam  value="#form.Anexos.Dicabom#" cfsqltype="cf_sql_char">, dicaregular=<cfqueryparam  value="#form.Anexos.Dicaregular#" cfsqltype="cf_sql_char">, dicanaosatisfatorio=<cfqueryparam  value="#form.Anexos.Dicanaosatisfatorio#" cfsqltype="cf_sql_char">, sequenciaitem=<cfqueryparam  value="#form.Anexos.SequenciaItem#" cfsqltype="cf_sql_char">,item=<cfqueryparam  value="#form.Anexos.Item#" cfsqltype="cf_sql_char">,  updated=now(), usuariomodificou='#u.usuarioID#', ipmodificou='#cgi.remote_addr#', hostmodificou='#cgi.remote_host#' where anexoID=<cfqueryparam  value="#form.Anexos.AnexoID#" cfsqltype="cf_sql_char">
			</cfquery>	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
		select * from sgpo_anexos where deleted is null order by updated desc, created desc;
		</cfquery>
		<cfsavecontent variable="lista"><cfinclude template="../view/listanexo.cfm" ></cfsavecontent>
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
<cfif Form.controller=='anexos' and Form.action=='cad' and evaluate('acoes.'& controllernomeplural & '["cad"]')==1 >
	<cfset status='OK'>
	<cfset mensagemstatus='Dados registrados com sucesso!' >
	<cfset url.pagina=#Form.pagina#>
	<cfset url.i='Anexo'>
	<cfset url.acao='list'>
	<cfscript>
		validacao = ArrayNew();
		validacao[1]=StructNew();
		validacao[1].campo = 'Documento';
		validacao[1].valor = evaluate('form.' & controllernomecampo & '.Documento');
		validacao[1].validacao = 'literal';
		validacao[1].requerido = 1;
		validacao[1].minimo = 4;
		validacao[1].limite = 100;
		validacao[2]=StructNew();
		validacao[2].campo = 'Item';
		validacao[2].valor = evaluate('form.' & controllernomecampo & '.Item');
		validacao[2].validacao = 'literal';
		validacao[2].requerido = 1;
		validacao[2].minimo = 1;
		validacao[2].limite = 20;
		validacao[3]=StructNew();
		validacao[3].campo = 'Areaavaliada';
		validacao[3].valor = evaluate('form.' & controllernomecampo & '.Areaavaliada');
		validacao[3].validacao = 'literal';
		validacao[3].requerido = 1;
		validacao[3].minimo = 1;
		validacao[3].limite = 100;
		validacao[4]=StructNew();
		validacao[4].campo = 'Itemavaliado';
		validacao[4].valor = evaluate('form.' & controllernomecampo & '.Itemavaliado');
		validacao[4].validacao = 'literal';
		validacao[4].requerido = 1;
		validacao[4].minimo = 1;
		validacao[4].limite = 100;
		validacao[5]=StructNew();
		validacao[5].campo = 'SequenciaItem';
		validacao[5].valor = evaluate('form.' & controllernomecampo & '.SequenciaItem');
		validacao[5].validacao = 'numero';
		validacao[5].requerido = 1;
		validacao[5].minimo = 1;
		validacao[5].limite = 3;
		resultado = valida(validacao);
		status = resultado.status;
		mensagemstatus = resultado.mensagem;
		erros = resultado.contador;

	</cfscript>
	<cfset dados = StructNew() >
<cfif status eq 'OK'>		
	<cfset mensagemstatus='Dados registrados com sucesso!' >
	<cftry>	
		<cfquery name="insereanexos" datasource="#dsn#">
		insert into sgpo_anexos (anexoID, anexo, documento, areaavaliada, dicaareaavaliada, itemavaliado, dicaotimo, dicabom, dicaregular, dicanaosatisfatorio, sequenciaitem, item, created, usuariocriou, ipcriou, hostcriou) values ('#id#', <cfqueryparam  value="#form.Anexos.Anexo#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Anexos.Documento#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Anexos.Areaavaliada#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Anexos.Dicaareaavaliada#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Anexos.Itemavaliado#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Anexos.Dicaotimo#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Anexos.Dicabom#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Anexos.Dicaregular#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Anexos.Dicanaosatisfatorio#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Anexos.SequenciaItem#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Anexos.Item#" cfsqltype="cf_sql_char">, now(), '#u.usuarioID#', '#cgi.remote_addr#','#cgi.remote_host#')
		</cfquery>
		<cfquery datasource="#dsn#" name="conteudoconsulta">
			select * from sgpo_anexos where deleted is null order by updated desc, created desc;
		</cfquery>
		<cfsavecontent variable="lista"><cfinclude template="../view/listanexo.cfm" ></cfsavecontent>
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

