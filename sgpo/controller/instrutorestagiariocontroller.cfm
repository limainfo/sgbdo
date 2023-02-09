<cfif not StructKeyExists(session,"id") >
		<cfset status='ERRO'>
		<cfset mensagemstatus='O tempo da conexão terminou. <a href="../../../../../id/?i=logout&appID=#app.appID#">Log in novamente.</a>' >
		<cfinclude template="../view/fimsessao.cfm">
		<cfabort>		
</cfif>
<cfset id=CreateUUID()>
<cfparam name="Form.controller" default="">	
<cfparam name="conteudoconsulta" default="">	
<cfset controllernome='instrutorestagiario' >
<cfset controllernomeplural='instrutorestagiarios' >
<cfset controllernomecampo='Instrutorestagiarios' >
<cfparam name="url.pesquisa" default="">
<cfset url.i="Instrutorestagiario">
<cfset controllernomeid='instrutorestagiarioID' >

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
//<!-- -------------------------Instrutorestagiarios--------------------------  -->
//<!-- -------------------------list--------------------------  -->
</cfscript>
<cfif Form.controller=='instrutorestagiarios' and Form.action=='list' and evaluate('acoes.'& controllernomeplural & '["list"]')==1 >
	<cfset url.acao="list">
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cfparam name="completasql" default="">
	<cfset url.pesquisa = urldecode(url.pesquisa) >
	<cftry>	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
				select *, ur.nome as unidade, ru.nome as usuario from sgpo_instrutorestagiarios sie
				inner join sgpo_usuarios su on (su.usuarioID=sie.usuarioID)
				inner join sgpo_estagiarios se on (se.estagiarioID=sie.estagiarioID)
				inner join root_usuarios ru on (ru.usuarioID=sie.usuarioID)
				inner join unidades_regionais ur on (ur.regionalID=ru.unidadeID #sqlRegionalID#)
				inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID #sqlHabilitacao#)
				where
				(ru.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or se.cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> ) 
				and sie.deleted is null 
				order by sie.updated desc, sie.created desc;
		</cfquery>
	<cfcatch type="any">
		<cfset status='ERRO'>
		<cfset conteudo=''>
	</cfcatch>	
	</cftry>	

	<cfinclude template="../view/listinstrutorestagiario.cfm">
</cfif>

<cfscript>
//<!-- -------------------------Busca--------------------------  -->
</cfscript>
<cfif Form.controller=='instrutorestagiarios' and Form.action=='busca' and evaluate('acoes.'& controllernomeplural & '["busca"]')==1 >
	<cfset url.acao="list">
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cfset url.pesquisa=#Form.busca#>
	<cfset url.pagina='1' >
	
	<cftry>	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
			select *, ur.nome as unidade, ru.nome as usuario from sgpo_instrutorestagiarios sie
			inner join sgpo_usuarios su on (su.usuarioID=sie.usuarioID)
			inner join sgpo_estagiarios se on (se.estagiarioID=sie.estagiarioID)
			inner join root_usuarios ru on (ru.usuarioID=sie.usuarioID)
			inner join unidades_regionais ur on (ur.regionalID=ru.unidadeID #slqRegionalID#)
			inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID #sqlHabilitacao#)
			where
			(ru.nome like <cfqueryparam  value="%#form.busca#%" cfsqltype="cf_sql_char"> or se.cpf like <cfqueryparam  value="%#form.busca#%" cfsqltype="cf_sql_char"> ) 
			and sie.deleted is null 
			order by sie.updated desc, sie.created desc;
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

	<cfinclude template="../view/listinstrutorestagiario.cfm">
</cfif>

<cfscript>
//<!-- -------------------------Ver---------------------------->
</cfscript>
<cfif Form.controller=='instrutorestagiarios' and Form.action=='ver' and evaluate('acoes.'& controllernomeplural & '["ver"]')==1 >
	<cfset url.acao="ver">
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cftry>	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
		select sf.*,sds.*, se.*, hs.habilitacao as habilitacao from sgpo_instrutorestagiarios sf inner join sgpo_estagiarios se on (se.estagiarioID=sf.estagiarioID) inner join sgpo_dadossistemas sds on (sds.dadossistemaID=se.dadossistemaID) inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID) 
		where
		(sf.instrutorestagiarioID=<cfqueryparam  value="%#form.id#%" cfsqltype="cf_sql_char">) 
		and sf.deleted is null 
		group by sf.instrutorestagiarioID
		order by sf.updated desc, sf.created desc;
		</cfquery>
	<cfcatch type="any">
		<cfset status='ERRO'>
		<cfset conteudo=''>
	</cfcatch>	
	</cftry>	
	<cfinclude template="../view/verinstrutorestagiario.cfm">
</cfif>


<cfscript>
//<!-- -------------------------exclui--------------------------  -->
</cfscript>
<cfif Form.controller=='instrutorestagiarios' and Form.action=='exclui' and evaluate('acoes.'& controllernomeplural & '["exclui"]')==1 >
	<cfset url.acao="exclui">
	<cfset status='OK'>
	<cfset mensagemstatus = ''>
	<cfset url.pagina=#Form.pagina#>
	<cftry>	
		<cfquery datasource="#dsn#" name="excluiinstrutorestagiarios">
		update sgpo_instrutorestagiarios si, sgpo_fichas sf set si.deleted=now(), si.usuariodeletou='#u.usuarioID#', si.ipdeletou='#cgi.remote_addr#', si.hostdeletou='#cgi.remote_host#',
		sf.deleted=now(), sf.usuariodeletou='#u.usuarioID#', sf.ipdeletou='#cgi.remote_addr#', sf.hostdeletou='#cgi.remote_host#'
		 where si.usuarioID=sf.instrutorresponsavel and si.estagiarioID=sf.estagiarioID and sf.tipoavaliacao='FINAL' and si.instrutorestagiarioID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char">;
		</cfquery>
		<cfset status='OK'>
		<cfset mensagemstatus = 'A ficha final para ->' & #form.nome# & ' foi excluída com sucesso!'>
	<cfcatch type="any">
		<cfset status='ERRO'>
		<cfset mensagemstatus='A informação não pode ser excluída. Motivo:' & CFCATCH.Message >
		<cfset conteudo=''>
	</cfcatch>	
	</cftry>	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
			select *, ur.nome as unidade, ru.nome as usuario from sgpo_instrutorestagiarios sie
			inner join sgpo_usuarios su on (su.usuarioID=sie.usuarioID)
			inner join sgpo_estagiarios se on (se.estagiarioID=sie.estagiarioID)
			inner join root_usuarios ru on (ru.usuarioID=sie.usuarioID)
			inner join unidades_regionais ur on (ur.regionalID=ru.unidadeID #sqlRegionalID#)
			inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID #sqlHabilitacao#)
			where
			(ru.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or se.cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> ) 
			and sie.deleted is null 
			order by sie.updated desc, sie.created desc;
		</cfquery>
	

	<cfinclude template="../view/listinstrutorestagiario.cfm">
</cfif>



<cfscript>
//<!-- -------------------------vercad--------------------------  -->
</cfscript>
<cfif Form.controller=='instrutorestagiarios' and Form.action=='vercad' and evaluate('acoes.'& controllernomeplural & '["vercad"]')==1 >
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cfquery datasource="lpna" name="estagiarios">
		select * from sgpo_estagiarios se
		inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID #sqlHabilitacao#)
		where se.horasconcluidas>=se.horasnecessarias and se.fimestagio is null   order by se.nome asc;
	</cfquery>	
	<cfquery datasource="lpna" name="instrutores">
		select * from root_usuarios ru
		inner join sgpo_usuarios su on (su.usuarioID=ru.usuarioID)
		inner join sgpo_perfils sp on (sp.perfilID=su.perfilID and sp.tipo='INSTRUTOR')
		where deletedat is null order by nome asc;
	</cfquery>	
	<cfquery datasource="lpna" name="anexos">
		select * from sgpo_anexos group by documento, anexo order by documento asc, anexo asc
	</cfquery>	
	<cfinclude template="../view/cadinstrutorestagiario.cfm">
</cfif>
	
<cfscript>
//<!-- -------------------------edit--------------------------  -->
</cfscript>
<cfif Form.controller=='instrutorestagiarios' and Form.action=='editdesativado'>
	<cfset url.pagina=#Form.pagina#>
	<cfset url.i='Estagiario'>
	<cfset url.acao='list'>
	<cfset status='OK'>
	<cfset mensagemstatus='Dados registrados com sucesso!' >
<cftry>	
<cfparam name="editsetores" default="">
		<cfquery name="editsetores" datasource="#dsn#">
		update sgpo_instrutorestagiarios set  regionalID=<cfqueryparam  value="#form.Instrutorestagiarios.RegionalID#" cfsqltype="cf_sql_char">, setorID=<cfqueryparam  value="#form.Instrutorestagiarios.SetorID#" cfsqltype="cf_sql_char">,  horasnecessarias=<cfqueryparam  value="#form.Instrutorestagiarios.Horasnecessarias#" cfsqltype="cf_sql_integer">,cargateorica=<cfqueryparam  value="#form.Instrutorestagiarios.Cargateorica#" cfsqltype="cf_sql_integer">,cargapratica=<cfqueryparam  value="#form.Instrutorestagiarios.Cargapratica#" cfsqltype="cf_sql_integer">,  updated=now(), usuariomodificou='#u.usuarioID#', ipmodificou='#cgi.remote_addr#', hostmodificou='#cgi.remote_host#' where instrutorestagiarioID=<cfqueryparam  value="#form.Instrutorestagiarios.EstagiarioID#" cfsqltype="cf_sql_char">
		</cfquery>	
	<cfscript>
		a=obtemSql(editsetores);
	</cfscript>
<cfcatch type="any">
	<cfset status='ERRO'>
	<cfset mensagemstatus='Dados não registrados. Motivo:' & CFCATCH.Message >
	<cfset conteudo=''>
</cfcatch>	
</cftry>	
	<cfquery datasource="#dsn#" name="conteudoconsulta">
		select sf.*,sds.*, se.*, hs.habilitacao as habilitacao from sgpo_instrutorestagiarios sf inner join sgpo_estagiarios se on (se.estagiarioID=sf.estagiarioID) inner join sgpo_dadossistemas sds on (sds.dadossistemaID=se.dadossistemaID) inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID #sqlHabilitacao#) 
		where
		(se.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or se.cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">  or se.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or hs.habilitacao like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) 
		and sf.deleted is null 
		group by sf.instrutorestagiarioID
		order by sf.updated desc, sf.created desc;
	</cfquery>
<cfinclude template="../view/listinstrutorestagiario.cfm">
</cfif>

<cfscript>
//<!-- -------------------------cad--------------------------  -->
</cfscript>
<cfif Form.controller=='instrutorestagiarios' and Form.action=='cad' and evaluate('acoes.'& controllernomeplural & '["cad"]')==1 >
	<cfset status='OK'>
	<cfset mensagemstatus='' >
	<cfset url.pagina=#Form.pagina#>
	<cfset url.i='Estagiario'>
	<cfset url.acao='list'>
	<cfscript>
		erros = 1;
		if(not isdate(evaluate('form.' & controllernomecampo & '.Prazo')) ){
			status = 'ERRO';
			mensagemstatus = mensagemstatus & erros & '. Campo prazo deve ser preenchido .<br>';
			erros = erros +1;
		}
		documento = '';
		anexo = '';
		if( find('|||',evaluate('form.' & controllernomecampo & '.Documento'))-1 gt 0 ){
			documento = left(evaluate('form.' & controllernomecampo & '.Documento'), find('|||',evaluate('form.' & controllernomecampo & '.Documento'))-1 );
		}
		if( len(evaluate('form.' & controllernomecampo & '.Documento')) - (find('|||',evaluate('form.' & controllernomecampo & '.Documento'))+2) gt 0){
			anexo = right(evaluate('form.' & controllernomecampo & '.Documento'), len(evaluate('form.' & controllernomecampo & '.Documento')) - (find('|||',evaluate('form.' & controllernomecampo & '.Documento'))+2) );
		}

		if(documento eq ''){
			status = 'ERRO';
			mensagemstatus = mensagemstatus & erros & '. Selecione uma opção que conste documento .<br>';
			erros = erros +1;
		}

		if(anexo eq ''){
			status = 'ERRO';
			mensagemstatus = mensagemstatus & erros & '. Selecione uma opção que conste anexo .<br>';
			erros = erros +1;
		}

		if( not structkeyexists(evaluate('form.' & controllernomecampo),'EstagiarioID')  ){
			status = 'ERRO';
			mensagemstatus = mensagemstatus & erros & '. É necessário informar qual ou quais estagiárias realizarão avaliação final.<br>';
			erros = erros +1;
		}
		if( not structkeyexists(evaluate('form.' & controllernomecampo),'UsuarioID')  ){
			status = 'ERRO';
			mensagemstatus = mensagemstatus & erros & '. É necessário informar qual ou quais instrutores realizarão avaliação final.<br>';
			erros = erros +1;
		}
	</cfscript>	
	
	<cfset dados = StructNew() >
		<cfif status eq 'OK' >
					
				<cfloop list="#evaluate('Form.' & controllernomecampo & '.estagiarioID')#" index="estagiarioID">
				<cfloop list="#evaluate('Form.' & controllernomecampo & '.usuarioID')#" index="usuarioID">
					<cftry>
					<cfset id=createUUID() >
					<cfquery name="inseredadossistemas" datasource="#dsn#">
					insert into sgpo_instrutorestagiarios (instrutorestagiarioID, estagiarioID, usuarioID, documento, anexo, prazo, created, usuariocriou, ipcriou, hostcriou) values (<cfqueryparam  value="#id#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#estagiarioID#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#usuarioID#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#documento#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#anexo#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#evaluate('Form.' & controllernomecampo & '.Prazo')#" cfsqltype="cf_sql_date">, now(), '#u.usuarioID#', '#cgi.remote_addr#','#cgi.remote_host#')
					</cfquery>
						<cfset fichaID=createUUID() >
						<cfquery name="criaanexos" datasource="#dsn#">
						insert into sgpo_fichas (fichaID, instrutorresponsavel, prazo, estagiarioID, dtavaliacao, documento, tipoavaliacao, created, usuariocriou, ipcriou, hostcriou) values
						(<cfqueryparam  value="#fichaID#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#usuarioID#" cfsqltype="cf_sql_char">,<cfqueryparam  value="#evaluate('form.' & controllernomecampo & '.Prazo')#" cfsqltype="cf_sql_date">, <cfqueryparam  value="#estagiarioID#" cfsqltype="cf_sql_char">, now(), <cfqueryparam  value="#documento# - anexo #anexo#" cfsqltype="cf_sql_char">, 'FINAL',  now(), '#u.usuarioID#', '#cgi.remote_addr#','#cgi.remote_host#')  
						</cfquery>
						<cfset fichaanexoid=createUUID() >
						<cfquery name="criaanexos" datasource="#dsn#">
						insert into sgpo_fichaanexos (fichaanexoID, fichaID, anexoID, created, usuariocriou, ipcriou, hostcriou)
						(select '#fichaanexoid#', '#fichaID#', anexoID,  now(), '#u.usuarioID#', '#cgi.remote_addr#','#cgi.remote_host#' from sgpo_anexos where concat(documento,' - anexo ', anexo)=<cfqueryparam  value="#documento# - anexo #anexo#" cfsqltype="cf_sql_char"> order by item asc, sequenciaitem asc)  
						</cfquery>
						
						<cfset status = 'OK'>
						<cfset mensagemstatus = 'Informações registradas com sucesso! Anexo gerado com sucesso! '>
										
					<cfcatch type="any">
						<cfset status='ERRO'>
						<cfset mensagemstatus='Dados não registrados. Motivo:' & CFCATCH.Message >
					</cfcatch>
					</cftry>
				</cfloop>
				</cfloop>
						<cfquery datasource="#dsn#" name="conteudoconsulta">
							select *, ur.nome as unidade, ru.nome as usuario from sgpo_instrutorestagiarios sie
							inner join sgpo_usuarios su on (su.usuarioID=sie.usuarioID)
							inner join sgpo_estagiarios se on (se.estagiarioID=sie.estagiarioID)
							inner join root_usuarios ru on (ru.usuarioID=sie.usuarioID)
							inner join unidades_regionais ur on (ur.regionalID=ru.unidadeID #sqlRegionalID#)
							inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID #sqlHabilitacao#)
							where
							(ru.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or se.cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> ) 
							and sie.deleted is null 
							order by sie.updated desc, sie.created desc;
						</cfquery>
						<cfsavecontent variable="lista"><cfinclude template="../view/listinstrutorestagiario.cfm" ></cfsavecontent>
						<cfset StructInsert(dados, 'conteudo', lista , 'TRUE') >
			</cfif>
	<cfset StructInsert(dados, 'status', status, 'TRUE')>
	<cfset StructInsert(dados, 'mensagemstatus', mensagemstatus, 'TRUE') >
	<cfcontent type="application/x-json"><cfoutput>#serializeJSON(dados, true)#</cfoutput></cfcontent>
	<cfabort>
	
</cfif>


