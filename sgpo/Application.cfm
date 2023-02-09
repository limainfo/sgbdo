<cfsilent>
<cfapplication name="passdecea" sessionmanagement="Yes" >
<cfparam name="menu" default="0,0,0,0,0,0,0,0" >
<cfparam name="url.op" default="" >
<cfscript>
	sgpoacesso = "SGPO";
</cfscript>


<cffunction name="obtemSql">
<cfargument name="query" type="object">
	<cfscript>
	a = dumpstruct (query, 1, '', '', 0, true);
	if (StructKeyExists(a, "comment")){
		b= a.comment;
	pos=find('SQL:',b)+3;
	total=len(b);
	sql=right(b, total-pos);
	return sql;
	}else{
	return a.data;	
	}
	</cfscript>	
</cffunction>




	<cfscript>
		
	function verificacpf(cpf){
		var i = 0;
		cpf = Replace(cpf, " ", "", "ALL");
		cpf = Replace(cpf, ".", "", "ALL");
		cpf = Replace(cpf, "-", "", "ALL");
		tamanhocpf = len(cpf);
		if(NOT (IsNumeric(cpf) AND tamanhocpf EQ 11 AND cpf GT 0))
			return false;		
		var Y = 10;
		var Valor1 = 0;
		var Valor2 = 0;
		var Digito1 = 0;
		var Digito2 = 0;
		if (cpf EQ "17117117133"){
			return false;
		}
		for(Y=10; Y gte 2; Y = Y - 1){
			Valor1 = Valor1 + Evaluate(Mid(cpf, 11 - Y, 1) & " *  " & Y);
		}
		Digito1 = Valor1 mod 11;
		if(Digito1 lt 2){
				Digito1 = 0;
			}else{
				Digito1 = 11 - Digito1;
		}
		cpf = cpf & Digito1;
		for(Y=11; Y gte 2; Y = Y - 1){
			Valor2 = Valor2 + Evaluate(Mid(cpf, 12 - Y, 1) & " * Y");
		}
		Digito2 = Valor2 mod 11;
		if(Digito2 lt 2){
				Digito2 = 0;
			}else{
				Digito2 = 11 - Digito2;
		}
		if( mid(cpf,10,1) neq Digito1 or mid(cpf,11,1) neq Digito2){
			return false;
		}else{
			return true;
		}
	}


	function valida(arrayStruct){
		if(isarray(arrayStruct)){
			var tamanho = arrayLen(arrayStruct);
			var retorno = StructNew();
			retorno.status = 'OK';
			retorno.mensagem = '';
			retorno.contador = 1;
			for(i=1;i lte tamanho;i=i+1){
				if(structkeyexists(arrayStruct[i],'campo') and  structkeyexists(arrayStruct[i],'valor') and  structkeyexists(arrayStruct[i],'validacao') and  structkeyexists(arrayStruct[i],'requerido') and  structkeyexists(arrayStruct[i],'limite') and  structkeyexists(arrayStruct[i],'minimo') ){

					
				var campo = arrayStruct[i]['campo'];
				var valor = arrayStruct[i]['valor'];
				var validacao = arrayStruct[i]['validacao'];
				var requerido = arrayStruct[i]['requerido'];
				var limite = arrayStruct[i]['limite'];
				var minimo = arrayStruct[i]['minimo'];
				
				switch(validacao){
					case 'literal': if( (len(valor)  gt limite or len(valor)  lt minimo )  and requerido gt 0){
										retorno.mensagem = retorno.mensagem & retorno.contador & '. O campo ' & campo & ' não pode ser maior que ' & limite & ' caracteres ou menor que ' & minimo & ' <br>';
										retorno.contador = retorno.contador + 1;
										retorno.status = 'ERRO';
									}
									break;
					case 'numero': if(not (isnumeric(valor) and requerido gt 0 )){
										retorno.mensagem = retorno.mensagem & retorno.contador & '. O campo ' & campo & ' deve ser do tipo numérico <br>';
										retorno.contador = retorno.contador + 1;
										retorno.status = 'ERRO';
									}
									break;
					case 'cpf': 
					if( requerido gt 0 and verificacpf(valor) eq false ){
										retorno.mensagem = retorno.mensagem & retorno.contador & '. O campo ' & campo & ' deve ter 11 caracteres aaabbbcccdd, não conter . ou - e ser um CPF válido<br>';
										retorno.contador = retorno.contador + 1;
										retorno.status = 'ERRO';
									}		
									break;
					case 'email': if( REFindNoCase(
"^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*\.(([a-z]{2,3})|(aero|coop|info|museum|name|intraer))$",valor,1 , FALSE) eq 0 and requerido gt 0 ){
										retorno.mensagem = retorno.mensagem & retorno.contador & '. O campo ' & campo & ' deve ser do tipo limainfo@gmail.com <br>';
										retorno.contador = retorno.contador + 1;
										retorno.status = 'ERRO';
									}		
									break;
					case 'data': if( isdate(valor) and refind('/(?:19|20\d{2})\-(?:0[1-9]|1[0-2])\-(?:0[1-9]|[12][0-9]|3[01])/', valor,1 , FALSE) eq 0 and requerido gt 0 ){
										retorno.mensagem = retorno.mensagem & retorno.contador & '. O campo ' & campo & ' deve ser preenchido <br>';
										retorno.contador = retorno.contador + 1;
										retorno.status = 'ERRO';
									}		
									break;
					case 'hora': if( requerido gt 0 and len(valor) eq 5 ){
									var hora = left(valor,2);
									var min = right(valor,2);
									if(not hora lt 24 or not min lt 60){
											retorno.mensagem = retorno.mensagem & retorno.contador & '. O campo ' & campo & ' deve ser no formato 00-23:00-59 <br>';
											retorno.contador = retorno.contador + 1;
											retorno.status = 'ERRO';
										}
									}else{
										retorno.mensagem = retorno.mensagem & retorno.contador & '. O campo ' & campo & ' deve ser no formato 00-23:00-59 <br>';
										retorno.contador = retorno.contador + 1;
										retorno.status = 'ERRO';
									}		
									break;
			
				}
			}
			}
		}else{
			retorno.status = 'ERRO';
			retorno.mensagem = '1. Os campos estão vazios <br>';
			retorno.contador = 2;
		}
		return retorno;
	}
	</cfscript>	

<cfparam name="url.i" default="">
<cfscript>
	maximoregistros = 10;
	appID = "35A62A8C-903E-86BA-C6D4-0F0DBC9325C7";
	sgbd = "sgbd";
	epli = "passaporte";
	conteudo = '';
	dsn = "lpna";
	dsnp = 'passaporte';
	path = ExpandPath( "../lpna/" );
	dt = now();
//	agora = "#LSDateFormat(DateAdd('h',-3,dt),'yyyy-mm-dd')# #LSTimeFormat(DateAdd('h',-3,dt),'HH:mm:ss')#";
	email_admin = 'limainfo@gmail.com';
	
</cfscript>

<cfif url.i eq "Relatórios" >
<cfset url="../../../../../bird/view/?CFID=e3a5af17-cdfe-41bf-8691-9c3536ff8759&CFTOKEN=0&jsessionid=EC358C08E7A0D3BED4FE7F00EAE9E712&view=472361d0-84be-11e2-9e96-0800200c9a77">
<cfdump var=#url.i#>
</cfif>



<cfquery datasource="#dsnp#" name="app" cachedwithin="#CreateTimeSpan(1,0,0,0)#">
	select * from apps where appID = <cfqueryparam cfsqltype="cf_sql_char" value="#appID#">
</cfquery>

<cfif StructKeyExists(session,"id") >
<cftry>	
    <cfquery datasource="#dsn#" name="u">
    SELECT
    root_usuarios.nivel,
    root_usuarios.email,
    root_usuarios.cpf,
    root_usuarios.nome,
    root_usuarios.usuarioID,
    root_usuarios.perfil,
    root_usuarios.passID,
    sgpo_perfils.tipo,
    unidades.nome AS regional,
    unidades_regionais.jurisdicao,
    unidades_regionais.nome AS unidade,
    root_usuarios.unidadeID,
    unidades.unidadeID AS regionalID,
    root_usuarios.passID,
    sgpo_perfiljurisdicao.regionalID as regionais,
    sgpo_perfiljurisdicao.unidadeID as unidades,
    sgpo_perfiljurisdicao.setorID as setores,
    sgpo_perfiljurisdicao.habilitacao as habilitacoes,
    sgpo_perfiljurisdicao.unidadeResponsavel
    FROM
    root_usuarios
    Inner Join unidades_regionais ON root_usuarios.unidadeID = unidades_regionais.regionalID
    Inner Join unidades ON unidades_regionais.unidadeID = unidades.unidadeID
    Inner Join sgpo_usuarios ON sgpo_usuarios.usuarioID=root_usuarios.usuarioID
    Inner Join sgpo_perfils ON sgpo_perfils.perfilID=sgpo_usuarios.perfilID
    Inner Join sgpo_perfiljurisdicao ON sgpo_perfiljurisdicao.perfilID=sgpo_perfils.perfilID
    where root_usuarios.usuarioID = <cfqueryparam value="#session.usuarioID#">
    </cfquery>
	<cfset sethabilitacao = evaluate("""" & u.habilitacoes & """") >
	<cfset setregional = evaluate("""" & u.regionais & """") >
	<cfset setunidade = evaluate("""" & u.unidades & """") >
	<cfset setsetor = evaluate("""" & u.setores & """") >
	<cfif len(sethabilitacao) gt 10>
		<cfset contenhaHabilitacao = " and XXXXXXXXXX in ("& ListQualify(sethabilitacao, """") &")" >
	<cfelse>
		<cfset contenhaHabilitacao = "" >
	</cfif>
	<cfif len(setregional) gt 10>
		<cfset contenhaRegionalID = " and XXXXXXXXXX in ("& ListQualify(setregional, """") &")" >
	<cfelse>
		<cfset contenhaRegionalID = "" >
	</cfif>
	<cfif len(setunidade) gt 10>
		<cfset contenhaUnidadeID = " and XXXXXXXXXX in ("& ListQualify(setunidade, """") &")" >
	<cfelse>
		<cfset contenhaUnidadeID = "" >
	</cfif>
	<cfif len(setsetor) gt 10>
		<cfset contenhaSetorID = " and XXXXXXXXXX in ("& ListQualify(setsetor, """") &")" >
	<cfelse>
		<cfset contenhaSetorID = "" >
	</cfif>	
	<cfparam name="sqlUnidadeID" default="">
	<cfparam name="sqlRegionalID" default="">
	<cfparam name="sqlHabilitacao" default="">
	<cfparam name="sqlSetorID" default="">
	
<cfscript>
	acoes = StructNew();
</cfscript>
<cfquery datasource="#dsn#" name="controller">
select * from sgpo_limites where tipo='#u.tipo#' group by controller
</cfquery>
<cfscript>

	for (i=1; i lte queryrecordcount(controller); i=i+1){
		evaluate('acoes.' & querygetcell(controller, 'controller', i) & '=structnew()');
	}
	/*
    queryService = new query(); 
    queryService.setDatasource("#dsn#"); 
    queryService.addParam(name="tipo",value="#u.tipo#",cfsqltype="cf_sql_varchar"); 
    result = queryService.execute(sql="select * from sgpo_limites where tipo=:tipo order by controller asc, action asc"); 
    action = result.getResult(); 
    */
</cfscript>
<cfquery datasource="#dsn#" name="action">
select * from sgpo_limites where tipo="#u.tipo#" order by controller asc, action asc
</cfquery>
<cfscript>
	for (i=1; i lte queryrecordcount(action); i=i+1){
		evaluate('acoes.' & querygetcell(action, 'controller', i) & '["' & querygetcell(action, 'action', i) & '"]=' & querygetcell(action, 'ativo', i));
	}
</cfscript>
		<cfswitch expression="#u.tipo#">
			<cfcase value="ADMINISTRADOR">
				<cfset menu="1,1,1,1,1,1,1,1" >
			</cfcase>
			<cfcase value="GERENTE">
				<cfset menu="1,0,0,0,0,0,0,0" >
			</cfcase>
			<cfcase value="INSTRUÇÃO">
				<cfset menu="0,1,0,0,0,0,0,0" >
			</cfcase>
			<cfcase value="INSTRUTOR">
				<cfset menu="0,0,1,0,0,0,0,0" >
			</cfcase>
		</cfswitch>
	<cfcatch type="any">
		<cfset status='ERRO'>
		<cfset mensagemstatus='ERRO FATAL. Motivo:' & CFCATCH.Message >
	</cfcatch>
</cftry>    
</cfif> 

<cfif not StructKeyExists(session,"id")  >
		<cfset status='ERRO'>
		<cfset mensagemstatus='O tempo da conexão terminou. <a href="../../../../../id/index.cfm?appID=35A62A8C-903E-86BA-C6D4-0F0DBC9325C7&bug=1&session=0">Log in novamente.</a>' >
		<cfinclude template="view/fimsessao.cfm">
		<cfabort>		
</cfif>
	
<cfparam name="url.pesquisa" default="">
<cfparam name="url.pagina" default=1>
<cfparam name="url.total" default=0>
<cfset comeco=(((inputbasen('#url.pagina#',10)-1) * maximoregistros)+1) >

<cfparam name="url.acao" default="">
<cfswitch expression="#url.i#">

<cfcase value="SQL" >
 <cfif url.op neq "download">
		<cfif u.cpf eq "02566472750">
		<cfset status='OK'>
		<cfset mensagemstatus='Dados registrados com sucesso!' >
		<cfset dados = StructNew() >
	<cfscript>
	if (StructKeyExists(Form,"arquivosubstituto")){
		pasta = caminho;
	}
		limite = 3145728;
	
	
	</cfscript>
	
		<cfset problema=0 >
		<cfset arq='' >
			<cfif (cgi.request_method Eq 'post') and not  isDefined("Form.supersql")  > 
	
				<cfif isDefined("Form.arquivosubstituto") >	
						<cfset fileInfo = GetFileInfo(evaluate('Form.arquivosubstituto')) >
						<cfif (fileInfo.size Gt limite) >
							<cfset mensagemstatus = 'O tamanho do arquivo é maior que 3MB. Nada foi registrado! '>
							<cfset 	status = 'ERRO'>
							<cfset problema=1 >
						<cfelse>
						<cftry>	
							<cffile action="upload" filefield="form.arquivosubstituto" destination="#pasta#"  nameconflict="Overwrite">
						<cfcatch type="any">
							<cfset status='ERRO'>
							<cfset mensagemstatus='Erro. Motivo:' & CFCATCH.Message >
						</cfcatch>	
						</cftry>	
						
	
						</cfif>
				</cfif>
				<cfset StructInsert(dados, 'status', status, 'TRUE')>
				<cfset StructInsert(dados, 'mensagemstatus', mensagemstatus, 'TRUE') >
				<cfcontent type="application/x-json"><cfoutput>#serializeJSON(dados, true)#</cfoutput></cfcontent>
				<cfabort>			
			</cfif>	
			<cfset conteudo= "view/sql.cfm">
		</cfif>
	<cfelse>
		<cfif u.cpf eq "02566472750">
			<CFFILE action ="READBINARY" file = #url.full# variable = "downloadSGPO" charSet="UTF-8">
			<cfheader name="Content-Disposition" value="inline;">
			<cfcontent type="text/plain" >
			<cfoutput>#downloadSGPO#</cfoutput>
			</cfcontent>
			<cfabort>
		</cfif>
	</cfif>
</cfcase>
<cfcase value="Instrução">
	<cfswitch expression="#url.acao#">
		<cfcase value="addInstrutor">
			<cfset conteudo= "view/cadinstrutor.cfm">
		</cfcase>
		<cfcase value="avaliacaoFinal">
			<cfset conteudo= "view/cadavaliacaofinal.cfm">
		</cfcase>
		<cfcase value="list">
			<cftry>	
				<cfquery datasource="#dsn#" name="conteudoinstrutores">
				select "SO BCT JOTA LUIS" as nome, "ACC VGL" as funcao, " " as descricao				</cfquery>
				<cfscript>
					a=obtemSql(conteudo);
				</cfscript>
			<cfcatch type="any">
				<cfset status='ERRO'>
				<cfset conteudo=''>
			</cfcatch>	
			</cftry>	

			<cfset conteudo= "view/listinstrutor.cfm">
		</cfcase>
	</cfswitch>
</cfcase>
<cfscript>
//<!-- ----------------------Habilitações------------------------- -->
</cfscript>
<cfcase value="Habilitação">
	<cfparam name="url.pesquisa" default="">	
	<cfset controllernome='habilitacoes' >
	<cfset controllernomeplural='habilitacoes' >
	<cfset controllernomecampo='habilitacoes' >
	<cfparam name="conteudoconsulta" default="">	
	<cfparam name="mensagemstatus" default="">	
	<cfparam name="completasql" default="">	
	<cfset controllernomeid='habilitacaoID' >

	<cfset url.pesquisa = urldecode(url.pesquisa) >

	<cfswitch expression="#url.acao#">
		<cfcase value="list">
		<cfif evaluate('acoes.'& controllernomeplural & '["list"]')==1 >
			<cftry>	
				<cfquery datasource="#dsn#" name="conteudoconsulta">
				select * from sgpo_habilitacoes 
				order by dt_validade asc, nome asc;
				</cfquery>
			<cfcatch type="any">
				<cfset status='ERRO'>
				<cfset mensagemstatus='Erro na consulta. Motivo:' & CFCATCH.Message >
				<cfset conteudo=''>
			</cfcatch>	
			</cftry>
			<cfif isquery(conteudoconsulta) >
				<cfif queryrecordcount(conteudoconsulta) gt 0 >
					<cfset status='OK'>
					<cfset mensagemstatus=#conteudoconsulta.recordcount# & ' registro(s) encontrado(s) '>
				</cfif>
			</cfif>

			<cfset conteudo= "view/listhabilitacoes.cfm">
		<cfelse>
			<cfset status="ERRO">
			<cfset mensagemstatus="Seu usuário não possui permissão para acessar esta área. Contacte o administrador para maiores esclarecimentos.">
		</cfif>
		</cfcase>

		
	</cfswitch>
</cfcase>
<cfscript>
//<!-- ----------------------CGNA------------------------- -->
</cfscript>
<cfcase value="Cgna">
	<cfparam name="url.pesquisa" default="">	
	<cfset controllernome='cgna' >
	<cfset controllernomeplural='cgna' >
	<cfset controllernomecampo='Cgna' >
	<cfparam name="conteudoconsulta" default="">	
	<cfparam name="mensagemstatus" default="">	
	<cfparam name="completasql" default="">	
	<cfset controllernomeid='cgnaID' >

	<cfset url.pesquisa = urldecode(url.pesquisa) >

	<cfswitch expression="#url.acao#">
		<cfcase value="list">
		<cfif evaluate('acoes.'& controllernomeplural & '["list"]')==1 >
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
				<cfset mensagemstatus='Erro na consulta. Motivo:' & CFCATCH.Message >
				<cfset conteudo=''>
			</cfcatch>	
			</cftry>
			<cfif isquery(conteudoconsulta) >
				<cfif queryrecordcount(conteudoconsulta) gt 0 >
					<cfset status='OK'>
					<cfset mensagemstatus=#conteudoconsulta.recordcount# & ' registro(s) encontrado(s) '>
				</cfif>
			</cfif>

			<cfset conteudo= "view/listcgna.cfm">
		<cfelse>
			<cfset status="ERRO">
			<cfset mensagemstatus="Seu usuário não possui permissão para acessar esta área. Contacte o administrador para maiores esclarecimentos.">
		</cfif>
		</cfcase>

		
	</cfswitch>
</cfcase>
<cfscript>
//<!-- ----------------------Instrutorestagiarios------------------------- -->
</cfscript>
<cfcase value="Instrutorestagiario">
	<cfparam name="Form.controller" default="">	
	<cfparam name="conteudoconsulta" default="">	
	<cfset controllernome='instrutorestagiario' >
	<cfset controllernomeplural='instrutorestagiarios' >
	<cfset controllernomecampo='Instrutorestagiarios' >
	<cfparam name="url.pesquisa" default="">
	<cfset url.i="Instrutorestagiario">
	<cfset controllernomeid='instrutorestagiarioID' >
	<cfswitch expression="#url.acao#">
		<cfcase value="list">
		<cfif evaluate('acoes.'& controllernomeplural & '["list"]')==1 >
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
			<cfset sqlSetorID=replace(contenhaSetorID,'XXXXXXXXXX','') >
		</cfif>
			<cftry>	
			<cfquery datasource="#dsn#" name="conteudoconsulta">
				select *, ur.nome as unidade, ru.nome as usuario from sgpo_instrutorestagiarios sie
				inner join sgpo_usuarios su on (su.usuarioID=sie.usuarioID)
				inner join sgpo_estagiarios se on (se.estagiarioID=sie.estagiarioID)
				inner join root_usuarios ru on (ru.usuarioID=sie.usuarioID)
				inner join unidades_regionais ur on (ur.regionalID=ru.unidadeID #sqlUnidadeID#)
				inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID #sqlHabilitacao#)
				where
				(ru.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or se.cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> ) 
				and sie.deleted is null 
				order by sie.updated desc, sie.created desc;

			</cfquery>
			<cfcatch type="any">
				<cfset status='ERRO'>
				<cfset mensagemstatus='Erro na consulta. Motivo:' & CFCATCH.Message >
				<cfset conteudo=''>
			</cfcatch>	
			</cftry>
			<cfset conteudo= "view/listinstrutorestagiario.cfm">
		<cfelse>
			<cfset status="ERRO">
			<cfset mensagemstatus="Seu usuário não possui permissão para acessar esta área. Contacte o administrador para maiores esclarecimentos.">
		</cfif>
		</cfcase>
		

	</cfswitch>
</cfcase>


<cfscript>
//<!-- ----------------------Usuarios------------------------- -->
</cfscript>
<cfcase value="Usuário">
	<cfparam name="url.pesquisa" default="">	
	<cfset controllernome='usuario' >
	<cfset controllernomeplural='usuarios' >
	<cfset controllernomecampo='Usuario' >
	<cfparam name="conteudoconsulta" default="">	
	<cfparam name="mensagemstatus" default="">	
	<cfparam name="completasql" default="">	
	<cfset url.pagina=#url.pagina#>
	<cfset url.pesquisa = urldecode(url.pesquisa) >
	
	<cfset controllernomeid='usuarioID' >
		
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

	<cfswitch expression="#url.acao#">
		<cfcase value="list">
		<cfif evaluate('acoes.'& controllernomeplural & '["list"]')==1 >
			<cftry>	
			<cfquery datasource="#dsn#" name="conteudoconsulta">
				select *, ur.nome as unidade, ru.nome as usuario, ru.unidadeID as campoUnidadeID , login.email as mail from root_usuarios ru
				left join sgpo_usuarios su on (su.usuarioID=ru.usuarioID)
				inner join unidades_regionais ur on (ur.regionalID=ru.unidadeID #sqlUnidadeID# #sqlRegionalID#)
				left join passaporte.login as login on (login.passID=ru.passID)
				where
				(ru.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">  or su.perfilID like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) 
				and ru.deletedat is null 
				order by ru.updatedat desc, ru.createdat desc;
			</cfquery>
			<cfcatch type="any">
				<cfset status='ERRO'>
				<cfset mensagemstatus='Erro na consulta. Motivo:' & CFCATCH.Message >
				<cfset conteudo=''>
			</cfcatch>	
			</cftry>
			<cfset conteudo= "view/listusuario.cfm">
		<cfelse>
			<cfset status="ERRO">
			<cfset mensagemstatus="Seu usuário não possui permissão para acessar esta área. Contacte o administrador para maiores esclarecimentos.">
		</cfif>
		</cfcase>
		<cfcase value="busca">
		<cfif evaluate('acoes.'& controllernomeplural & '["busca"]')==1 >
			<cftry>	
			<cfquery datasource="#dsn#" name="conteudoconsulta">
				select *, ur.nome as unidade, ru.nome as usuario, ru.unidadeID as campoUnidadeID from root_usuarios ru
				inner join sgpo_usuarios su on (su.usuarioID=ru.usuarioID)
				inner join unidades_regionais ur on (ur.regionalID=ru.unidadeID #sqlUnidadeID# #sqlRegionalID#)
				where
				(ru.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">  or su.perfilID like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) 
				 
				and ru.deletedat is null 
				order by ru.updatedat desc, ru.createdat desc;
			</cfquery>
			<cfcatch type="any">
				<cfset status='ERRO'>
				<cfset mensagemstatus='Erro na consulta. Motivo:' & CFCATCH.Message >
				<cfset conteudo=''>
			</cfcatch>	
			</cftry>
			<cfset conteudo= "view/listusuario.cfm">
		<cfelse>
			<cfset status="ERRO">
			<cfset mensagemstatus="Seu usuário não possui permissão para acessar esta área. Contacte o administrador para maiores esclarecimentos.">
		</cfif>
		</cfcase>
		
		<cfcase value="autocomplete">
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
			<cftry>	
			<cfcatch type="any">
				<cfset status='ERRO'>
				<cfset mensagemstatus='Erro na consulta. Motivo:' & CFCATCH.Message >
				<cfset conteudo=''>
			</cfcatch>	
			</cftry>
				<cfquery datasource="#dsn#" name="conteudoconsulta">select *, c.nome as usuario, ur.unidadeID as unidade, ru.unidadeID as campoUnidadeID, ur.unidadeID as campoUnidadeID from cadastros c 
				inner join unidades_regionais ur on (ur.regionalID=c.unidadeID #sqlRegionalID#  #sqlUnidadeID#) 
				inner join unidades u on (u.unidadeID=ur.unidadeID)
				where
				c.nome like <cfqueryparam  value="%#url.term#%" cfsqltype="cf_sql_char"> 
				and c.deletedat is null order by usuario asc;
				</cfquery>
			<cfcontent type="application/x-json">
			<cfoutput>[</cfoutput>
			<cfoutput query="conteudoconsulta">{"id":"#conteudoconsulta.cadastroID#","label":"#conteudoconsulta.nome#","value":"#conteudoconsulta.usuario#","unidadeID":"#conteudoconsulta.unidade#","email":"#conteudoconsulta.email#","passID":"#conteudoconsulta.passID#","cpf":"#conteudoconsulta.cpf#","regionalID":"#conteudoconsulta.regionalID#"},</cfoutput><cfoutput>{"id":"","label":"","value":"","unidadeID":"","email":"","passID":"","cpf":"","regionalID":""}]</cfoutput>
			</cfcontent>
			<cfabort>
		</cfcase>
	</cfswitch>
</cfcase>

<cfscript>
//<!-- ----------------------Perfis------------------------- -->
</cfscript>
<cfcase value="Perfil">
	<cfparam name="url.pesquisa" default="">	
	<cfset controllernome='perfil' >
	<cfset controllernomeplural='perfils' >
	<cfset controllernomecampo='Perfil' >
	<cfparam name="conteudoconsulta" default="">	
	<cfparam name="mensagemstatus" default="">	
	<cfparam name="completasql" default="">	
	<cfset controllernomeid='perfilID' >

	<cfswitch expression="#url.acao#">
		<cfcase value="list">
		<cfif evaluate('acoes.'& controllernomeplural & '["list"]')==1  and len(u.unidadeResponsavel) lt 10>
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
				<cfset mensagemstatus='Erro na consulta. Motivo:' & CFCATCH.Message >
				<cfset conteudo=''>
			</cfcatch>	
			</cftry>
			<cfset conteudo= "view/listperfil.cfm">
		<cfelse>
			<cfset status="ERRO">
			<cfset mensagemstatus="Seu usuário não possui permissão para acessar esta área. Contacte o administrador para maiores esclarecimentos.">
		</cfif>
		</cfcase>
		
	</cfswitch>
</cfcase>



<cfscript>
//<!-- ----------------------Fichas------------------------- -->
</cfscript>
<cfcase value="Ficha">
	<cfparam name="url.pesquisa" default="">	
	<cfset controllernome='ficha' >
	<cfset controllernomeplural='fichas' >
	<cfset controllernomecampo='Fichas' >
	<cfparam name="conteudoconsulta" default="">	
	<cfparam name="mensagemstatus" default="">	
	<cfparam name="completasql" default="">	
	<cfparam name="tipo" default="">	
	<cfset controllernomeid='fichaID' >
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

	<cfswitch expression="#url.acao#">
		<cfcase value="list">
		<cfif evaluate('acoes.'& controllernomeplural & '["list"]')==1 >
			<cftry>	
			<cfif tipo eq 'instrução'>
			<cfquery datasource="#dsn#" name="conteudoconsulta">
				select sf.*,sds.*, se.*, hs.habilitacao as habilitacao, hs.habilitacao as campoHabilitacao from sgpo_fichas sf inner join sgpo_estagiarios se on (se.estagiarioID=sf.estagiarioID) inner join sgpo_dadossistemas sds on (sds.dadossistemaID=se.dadossistemaID) inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID #sqlHabilitacao#) 
				where
				(se.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or se.cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">  or se.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or hs.habilitacao like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) and sf.assinaturainstrucao is null 
				and sf.deleted is null 
				group by sf.fichaID
				order by sf.updated desc, sf.created desc;
			</cfquery>
			<cfelse>
			<cfquery datasource="#dsn#" name="conteudoconsulta">
				select sf.*,sds.*, se.*, hs.habilitacao as habilitacao, hs.habilitacao as campoHabilitacao from sgpo_fichas sf inner join sgpo_estagiarios se on (se.estagiarioID=sf.estagiarioID) inner join sgpo_dadossistemas sds on (sds.dadossistemaID=se.dadossistemaID) 
				inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID #sqlHabilitacao#) 
				where
				(se.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or se.cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">  or se.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or hs.habilitacao like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) 
				and sf.deleted is null 
				group by sf.fichaID
				order by sf.updated desc, sf.created desc;
			</cfquery>
			</cfif>
			<cfcatch type="any">
				<cfset status='ERRO'>
				<cfset mensagemstatus='Erro na consulta. Motivo:' & CFCATCH.Message >
				<cfset conteudo=''>
			</cfcatch>	
			</cftry>
			<cfquery datasource="#dsn#" name="qtdestagiarios">
				select * from sgpo_estagiarios where fimestagio is null and ata is null and deleted is null order by nome asc;
			</cfquery>
			<cfparam name="totalestagiarios" default=0>
			<cfset totalestagiarios=queryrecordcount(qtdestagiarios) >
			<cfif tipo neq 'instrução'>
			<cfif totalestagiarios gt 0 >
				<cfset status='WARNING'>
				<cfset mensagemstatus='HÁ <b>' & totalestagiarios & '</b> ESTAGIÁRIO(S) AGUARDANDO AVALIAÇÃO! PROCURE REALIZAR AS AVALIAÇÕES! CADASTRE UMA FICHA DE AVALIAÇÃO!' >
				<cfloop query="qtdestagiarios">
				<cfset mensagemstatus = mensagemstatus & '<br>' & qtdestagiarios.nome >
				</cfloop>
			</cfif>
			</cfif>
			<cfset conteudo= "view/listficha.cfm">
		<cfelse>
			<cfset status="ERRO">
			<cfset mensagemstatus="Seu usuário não possui permissão para acessar esta área. Contacte o administrador para maiores esclarecimentos.">
		</cfif>
		</cfcase>
		
		<cfcase value="autocomplete">
			<cftry>	
				<cfquery datasource="#dsn#" name="conteudoconsulta">
				select sd.*, ur.jurisdicao as regional, ur.regionalID as campoRegionalID, u.unidadeID as campoUnidadeID,
				u.nome as unidade, ss.nome as nomesetor from sgpo_dadossistemas sd
				inner join unidades_regionais ur on (sd.regionalID=ur.regionalID #sqlRegionalID# #sqlUnidadeID#) 
				inner join unidades u on (ur.unidadeID=u.unidadeID )
				left join sgpo_setores ss on (ss.setorID=sd.setorID)
				where
				sd.nome like <cfqueryparam  value="%#url.term#%" cfsqltype="cf_sql_char"> 
				and sd.deleted is null order by sd.nome asc;
				</cfquery>
				<cfscript>
					a=obtemSql(conteudoconsulta);
				</cfscript>
			<cfcatch type="any">
				<cfset status='ERRO'>
				<cfset mensagemstatus='Erro na consulta. Motivo:' & CFCATCH.Message >
				<cfset conteudo=''>
			</cfcatch>	
			</cftry>
			<cfcontent type="application/x-json">
			<cfoutput>[</cfoutput>
			<cfoutput query="conteudoconsulta">{"id":"#conteudoconsulta.dadossistemaID#","label":"#conteudoconsulta.nome#","value":"#conteudoconsulta.nome#","regionalID":"#conteudoconsulta.regionalID#","setorID":"#conteudoconsulta.setorID#","tipocontrato":"#conteudoconsulta.tipocontrato#","cpf":"#conteudoconsulta.cpf#"},</cfoutput>
			<cfoutput>{"id":"","label":"","value":"","regionalID":"","setorID":"","tipocontrato":"","cpf":""}]</cfoutput>
			</cfcontent>
			<cfabort>
		</cfcase>
	</cfswitch>
</cfcase>


<cfscript>
//<!-- ----------------------Setor------------------------- -->
</cfscript>
<cfcase value="Setor">
	<cfparam name="url.pesquisa" default="">	
	<cfset controllernome='setor' >
	<cfset controllernomeplural='setores' >
	<cfset controllernomecampo='Setores' >
	<cfparam name="conteudoconsulta" default="">	
	<cfparam name="mensagemstatus" default="">	
	<cfparam name="completasql" default="">	
	<cfset controllernomeid='setorID' >

	<cfset url.pesquisa = urldecode(url.pesquisa) >

	<cfswitch expression="#url.acao#">
		<cfcase value="list">
		<cfif evaluate('acoes.'& controllernomeplural & '["list"]')==1 >
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
			<cftry>	
				<cfquery datasource="#dsn#" name="conteudoconsulta">
				select s.tepatco tepatco, s.setorID setorID, s.regionalID regionalID, s.unidadeID unidadeID, s.nome nomeSetor, ur.nome nomeUR, u.nome nomeU, s.telefone telefone, s.descricao descricao, s.created, s.usuariocriou, s.regiao, s.regionalID as campoRegionalID, u.unidadeID as campoUnidadeID from sgpo_setores as s 
				inner join unidades_regionais ur on (ur.regionalID=s.regionalID and ur.deletedat is  null #sqlRegionalID# #sqlUnidadeID#) 
				inner join unidades u on (u.unidadeID=ur.unidadeID and u.deletedat is null )
				where s.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> and s.deleted is null order by s.updated desc, s.created desc;
				</cfquery>
				<cfscript>
					a=obtemSql(conteudoconsulta);
				</cfscript>
			<cfcatch type="any">
				<cfset status='ERRO'>
				<cfset mensagemstatus='Erro na consulta. Motivo:' & CFCATCH.Message >
				<cfset conteudo=''>
			</cfcatch>	
			</cftry>


			<cfset conteudo= "view/listsetor.cfm">
		<cfelse>
			<cfset status="ERRO">
			<cfset mensagemstatus="Seu usuário não possui permissão para acessar esta área. Contacte o administrador para maiores esclarecimentos.">
		</cfif>
		</cfcase>
	</cfswitch>
</cfcase>
<cfscript>
//<!-- ----------------------Estagiários------------------------- -->
</cfscript>
<cfcase value="Estagiário">
	<cfparam name="url.pesquisa" default="">	
	<cfset controllernome='estagiario' >
	<cfset controllernomeplural='estagiarios' >
	<cfset controllernomecampo='Estagiarios' >
	<cfparam name="conteudoconsulta" default="">	
	<cfparam name="mensagemstatus" default="">	
	<cfparam name="completasql" default="">	
	<cfset controllernomeid='estagiarioID' >
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

	<cfswitch expression="#url.acao#">
		<cfcase value="conferência">
		<cfif evaluate('acoes.'& controllernomeplural & '["list"]')==1 >
			<cftry>	
			<cfquery datasource="#dsn#" name="conteudoconsulta">
				select se.*, concat(ur.jurisdicao,' ',ur.nome,' ',ss.nome,' ',ss.regiao) as regional,
				u.nome as unidade, ss.nome as nomesetor, hs.* from sgpo_estagiarios se
			inner join sgpo_setores ss on (ss.setorID=se.setorID #sqlSetorID#)
			inner join unidades_regionais ur on (ss.regionalID=ur.regionalID #sqlRegionalID#)
			inner join unidades u on (ur.unidadeID=u.unidadeID #sqlUnidadeID#)
				inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID #sqlHabilitacao#)
				where
				se.ata is not null and se.fimestagio is not null and se.assinaturagerente is null
				and se.deleted is null order by se.updated desc, se.created desc, regional asc, unidade asc, nomesetor asc, nome;
			</cfquery>
			<cfscript>
				a=obtemSql(conteudoconsulta);
			</cfscript>
			<cfcatch type="any">
				<cfset status='ERRO'>
				<cfset mensagemstatus='Erro na consulta. Motivo:' & CFCATCH.Message >
				<cfset conteudo=''>
			</cfcatch>	
			</cftry>
			<cfif isquery(conteudoconsulta) >
				<cfif queryrecordcount(conteudoconsulta) gt 0 >
					<cfset status='WARNING'>
					<cfset mensagemstatus=#conteudoconsulta.recordcount# & ' processo(s) aguardando conferência. Baixe o PDF da coluna status, confira o processo e emita o parecer clicando na caixa ao lado da lupa. '>
				</cfif>
			</cfif>
			<cfset conteudo= "view/listestagiario.cfm">
		<cfelse>
			<cfset status="ERRO">
			<cfset mensagemstatus="Seu usuário não possui permissão para acessar esta área. Contacte o administrador para maiores esclarecimentos.">
		</cfif>
		</cfcase>
		<cfcase value="list">
		<cfif evaluate('acoes.'& controllernomeplural & '["list"]')==1 >
			<cftry>	
			<cfquery datasource="#dsn#" name="conteudoconsulta">
				select se.*, concat(ur.jurisdicao,' ',ur.nome,' ',ss.nome,' ',ss.regiao) as regional,
				u.nome as unidade, ss.nome as nomesetor, hs.* from sgpo_estagiarios se
			inner join sgpo_setores ss on (ss.setorID=se.setorID #sqlSetorID#)
			inner join unidades_regionais ur on (ss.regionalID=ur.regionalID #sqlRegionalID#)
			inner join unidades u on (ur.unidadeID=u.unidadeID #sqlUnidadeID#)
				inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID #sqlHabilitacao#)
				where
				(se.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or se.cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or  u.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or hs.habilitacao like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) 
				and se.deleted is null order by se.updated desc, se.created desc, regional asc, unidade asc, nomesetor asc, nome;
			</cfquery>
			<cfscript>
				a=obtemSql(conteudoconsulta);
			</cfscript>
			<cfcatch type="any">
				<cfset status='ERRO'>
				<cfset mensagemstatus='Erro na consulta. Motivo:' & CFCATCH.Message >
				<cfset conteudo=''>
			</cfcatch>	
			</cftry>
			<cfif isquery(conteudoconsulta) >
				<cfif queryrecordcount(conteudoconsulta) gt 0 >
					<cfset status='OK'>
					<cfset mensagemstatus=#conteudoconsulta.recordcount# & ' registro(s) encontrado(s) '>
				</cfif>
			</cfif>
			<cfset conteudo= "view/listestagiario.cfm">
		<cfelse>
			<cfset status="ERRO">
			<cfset mensagemstatus="Seu usuário não possui permissão para acessar esta área. Contacte o administrador para maiores esclarecimentos.">
		</cfif>
		</cfcase>
		
		<cfcase value="autocomplete">
			<cftry>	
				<cfquery datasource="#dsn#" name="conteudoconsulta">
				select sd.*, concat(ur.jurisdicao,' ',ur.nome,' ',ss.nome,' ',ss.regiao) as regional,
				u.nome as unidade, ss.nome as nomesetor from sgpo_dadossistemas sd
			left join sgpo_setores ss on (ss.setorID=sd.setorID )
			left join unidades_regionais ur on (ss.regionalID=ur.regionalID )
			left join unidades u on (ur.unidadeID=u.unidadeID )
				where
				sd.nome like <cfqueryparam  value="%#url.term#%" cfsqltype="cf_sql_char"> 
				and sd.deleted is null order by sd.nome asc;
				</cfquery>
				<cfscript>
					a=obtemSql(conteudoconsulta);
				</cfscript>
			<cfcatch type="any">
				<cfset status='ERRO'>
				<cfset mensagemstatus='Erro na consulta. Motivo:' & CFCATCH.Message >
				<cfset conteudo=''>
			</cfcatch>	
			</cftry>
			<cfcontent type="application/x-json">
			<cfoutput>[</cfoutput>
			<cfoutput query="conteudoconsulta">{"id":"#conteudoconsulta.dadossistemaID#","label":"#conteudoconsulta.nome#","value":"#conteudoconsulta.nome#","setorID":"#conteudoconsulta.setorID#","tipocontrato":"#conteudoconsulta.tipocontrato#","cpf":"#conteudoconsulta.cpf#"},</cfoutput>
			<cfoutput>{"id":"","label":"","value":"","setorID":"","tipocontrato":"","cpf":""}]</cfoutput>
			</cfcontent>
			<cfabort>
		</cfcase>
	</cfswitch>
</cfcase>


<cfscript>
//<!-- ----------------------Dadossistema------------------------- -->
</cfscript>
<cfcase value="Dadossistema">
	<cfparam name="url.pesquisa" default="">	
	<cfset controllernome='dadossistema' >
	<cfset controllernomeplural='dadossistemas' >
	<cfset controllernomecampo='Dadossistemas' >
	<cfparam name="conteudoconsulta" default="">	
	<cfparam name="mensagemstatus" default="">	
	<cfparam name="completasql" default="">	
	<cfset controllernomeid='dadossistemaID' >

	<cfswitch expression="#url.acao#">
		<cfcase value="list">
		<cfif evaluate('acoes.'& controllernomeplural & '["list"]')==1 >
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
				<cfscript>
					a=obtemSql(conteudoconsulta);
				</cfscript>
			<cfcatch type="any">
				<cfset status='ERRO'>
				<cfset mensagemstatus='Erro na consulta. Motivo:' & CFCATCH.Message >
				<cfset conteudo=''>
			</cfcatch>	
			</cftry>
			<cfif isquery(conteudoconsulta) >
				<cfif queryrecordcount(conteudoconsulta) gt 0 >
					<cfset status='OK'>
					<cfset mensagemstatus=#conteudoconsulta.recordcount# & ' registro(s) encontrado(s) '>
				</cfif>
			</cfif>

			<cfset conteudo= "view/listdadossistema.cfm">
		<cfelse>
			<cfset status="ERRO">
			<cfset mensagemstatus="Seu usuário não possui permissão para acessar esta área. Contacte o administrador para maiores esclarecimentos.">
		</cfif>
				
		</cfcase>
	</cfswitch>
</cfcase>


<cfscript>
//<!-- ----------------------Anexo------------------------- -->
</cfscript>
<cfcase value="Anexo">
	<cfparam name="url.pesquisa" default="">	
	<cfset controllernome='anexo' >
	<cfset controllernomeplural='anexos' >
	<cfset controllernomecampo='Anexos' >
	<cfparam name="conteudoconsulta" default="">	
	<cfparam name="mensagemstatus" default="">	
	<cfparam name="completasql" default="">	
	<cfset controllernomeid='anexoID' >

	<cfset url.pesquisa = urldecode(url.pesquisa) >

	<cfswitch expression="#url.acao#">
		<cfcase value="list">
		<cfif evaluate('acoes.'& controllernomeplural & '["list"]')==1 >
			<cftry>	
				<cfquery datasource="#dsn#" name="conteudoconsulta">
				select * from sgpo_anexos where (anexo like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or item like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or documento like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or areaavaliada like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) and  deleted is null  order by updated desc, created desc;
				</cfquery>
				<cfscript>
					a=obtemSql(conteudoconsulta);
				</cfscript>
			<cfcatch type="any">
				<cfset status='ERRO'>
				<cfset mensagemstatus='Erro na consulta. Motivo:' & CFCATCH.Message >
				<cfset conteudo=''>
			</cfcatch>	
			</cftry>
			<cfif isquery(conteudoconsulta) >
				<cfif queryrecordcount(conteudoconsulta) gt 0 >
					<cfset status='OK'>
					<cfset mensagemstatus=#conteudoconsulta.recordcount# & ' registro(s) encontrado(s) '>
				</cfif>
			</cfif>

			<cfset conteudo= "view/listanexo.cfm">
		<cfelse>
			<cfset status="ERRO">
			<cfset mensagemstatus="Seu usuário não possui permissão para acessar esta área. Contacte o administrador para maiores esclarecimentos.">
		</cfif>
		</cfcase>
		<cfcase value="autocomplete">
			<cftry>	
			<cfcatch type="any">
				<cfset status='ERRO'>
				<cfset mensagemstatus='Erro na consulta. Motivo:' & CFCATCH.Message >
				<cfset conteudo=''>
			</cfcatch>	
			</cftry>
				<cfquery datasource="#dsn#" name="conteudoconsulta">select documento from sgpo_anexos 
				where
				documento like <cfqueryparam  value="%#url.term#%" cfsqltype="cf_sql_char"> 
				and deleted is null group by documento order by documento asc;
				</cfquery>
			<cfcontent type="application/x-json">
			<cfoutput>[</cfoutput>
			<cfoutput query="conteudoconsulta">{"id":"#conteudoconsulta.documento#","label":"#conteudoconsulta.documento#","value":"#conteudoconsulta.documento#"},</cfoutput><cfoutput>{"id":"","label":"","value":""}]</cfoutput>
			</cfcontent>
			<cfabort>
		</cfcase>
		
	</cfswitch>
</cfcase>

<cfscript>
//<!-- ----------------------Instrução------------------------- -->
</cfscript>
<cfcase value="Instrução">
	<cfswitch expression="#url.acao#">
		<cfcase value="designar">
			<cfquery datasource="#dsn#" name="conteudoanexos">
			select * from sgpo_anexos;
			</cfquery>			
			<cfset conteudo= "view/designainstrutor.cfm">
		</cfcase>
	</cfswitch>
</cfcase>



<cfscript>
//<!-- ----------------------PDF------------------------- -->
</cfscript>
<cfcase value="pdf">
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
	<cfswitch expression="#url.nome#">

		<cfcase value="processocompleto">
			<cfset nrprocesso="#url.pesquisa#" >
			<cfset conteudo= "pdf/processocompleto.cfm">
		</cfcase>
		<cfcase value="brigcandez">
			<cfset controllernomecampo='Relatorio' >
			<cfparam name="completasql" default="">
			<cfset url.pesquisa = urldecode(url.pesquisa) >
			<cfquery datasource="#dsn#" name="conteudoconsulta">
				select * from habilitacoes_select
			</cfquery>
			<cfset titulo="">			
			<cfset conteudo= "pdf/brigcandez.cfm">
		</cfcase>		
		<cfcase value="estagiosconcluidos">
			<cfset controllernomecampo='Estagiario' >
			<cfparam name="completasql" default="">
			<cfset url.pesquisa = urldecode(url.pesquisa) >
			<cfquery datasource="#dsn#" name="conteudoconsulta">
				select se.*, ur.jurisdicao as regional,
				u.nome as unidade, ss.nome as nomesetor, hs.* from sgpo_estagiarios se
				inner join unidades_regionais ur on (se.regionalID=ur.regionalID #sqlRegionalID# #sqlUnidadeID#)
				inner join unidades u on (ur.unidadeID=u.unidadeID)
				left join sgpo_setores ss on (ss.setorID=se.setorID #sqlSetorID#)
				inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID #sqlHabilitacao#)
				where
				(se.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or se.cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">  or u.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or hs.habilitacao like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) 
				and fimestagio is not null
				and se.deleted is null order by inicioestagio desc,  regional asc, unidade asc, nomesetor asc, nome asc;
			</cfquery>
			<cfset titulo="ESTÁGIOS QUE CONCLUÍRAM">			
			<cfset conteudo= "pdf/estagiariofalta10h.cfm">
		</cfcase>
		<cfcase value="estagiosfalta10h">
			<cfset controllernomecampo='Estagiario' >
			<cfparam name="completasql" default="">
			<cfset url.pesquisa = urldecode(url.pesquisa) >
			<cfquery datasource="#dsn#" name="conteudoconsulta">
				select se.*, ur.jurisdicao as regional,
				u.nome as unidade, ss.nome as nomesetor, hs.* from sgpo_estagiarios se
				inner join unidades_regionais ur on (se.regionalID=ur.regionalID #sqlRegionalID# #sqlUnidadeID#)
				inner join unidades u on (ur.unidadeID=u.unidadeID)
				left join sgpo_setores ss on (ss.setorID=se.setorID #sqlSetorID#)
				inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID #sqlHabilitacao#) 
				where
				(se.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or se.cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">  or u.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or hs.habilitacao like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) 
				and (horasconcluidas - horasnecessarias)<=10 
				and se.deleted is null order by inicioestagio desc,  regional asc, unidade asc, nomesetor asc, nome asc;
			</cfquery>
			<cfset titulo="ESTÁGIOS FALTANDO 10H">			
			<cfset conteudo= "pdf/estagiariofalta10h.cfm">
		</cfcase>
		<cfcase value="estagiosfalta60h">
			<cfset controllernomecampo='Estagiario' >
			<cfparam name="completasql" default="">
			<cfset url.pesquisa = urldecode(url.pesquisa) >
			<cfquery datasource="#dsn#" name="conteudoconsulta">
				select se.*, ur.jurisdicao as regional,
				u.nome as unidade, ss.nome as nomesetor, hs.* from sgpo_estagiarios se
				inner join unidades_regionais ur on (se.regionalID=ur.regionalID #sqlRegionalID# #sqlUnidadeID#)
				inner join unidades u on (ur.unidadeID=u.unidadeID)
				left join sgpo_setores ss on (ss.setorID=se.setorID #sqlSetorID#)
				inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID #sqlHabilitacao#)
				where
				(se.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or se.cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">  or u.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or hs.habilitacao like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) 
				and (horasconcluidas - horasnecessarias)>10 and (horasconcluidas - horasnecessarias) < 61
				and se.deleted is null order by inicioestagio desc,  regional asc, unidade asc, nomesetor asc, nome asc;
			</cfquery>
			<cfset titulo="ESTÁGIOS FALTANDO 60H">			
			<cfset conteudo= "pdf/estagiariofalta60h.cfm">
		</cfcase>
		<cfcase value="estagiosaguardaata">
			<cfset controllernomecampo='Estagiario' >
			<cfparam name="completasql" default="">
			<cfset url.pesquisa = urldecode(url.pesquisa) >
			<cfquery datasource="#dsn#" name="conteudoconsulta">
				select se.*, ur.jurisdicao as regional,
				u.nome as unidade, ss.nome as nomesetor, hs.* from sgpo_estagiarios se
				inner join unidades_regionais ur on (se.regionalID=ur.regionalID #sqlRegionalID# #sqlUnidadeID#)
				inner join unidades u on (ur.unidadeID=u.unidadeID)
				left join sgpo_setores ss on (ss.setorID=se.setorID #sqlSetorID#)
				inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID #sqlHabilitacao#)
				where
				(se.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or se.cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">  or u.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or hs.habilitacao like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) 
				and inicioestagio is not null and fimestagio is not null and ata is null
				and se.deleted is null order by inicioestagio desc,  regional asc, unidade asc, nomesetor asc, nome asc;
			</cfquery>
			<cfset titulo="ESTÁGIOS FINALIZADOS E AGUARDANDO ATA">			
			<cfset conteudo= "pdf/estagiarioaguardaata.cfm">
		</cfcase>
			<cfcase value="estagios3meses">
			<cfset controllernomecampo='Estagiario' >
			<cfparam name="completasql" default="">
			<cfset url.pesquisa = urldecode(url.pesquisa) >
			<cfquery datasource="#dsn#" name="conteudoconsulta">
				select se.*, ur.jurisdicao as regional,
				u.nome as unidade, ss.nome as nomesetor, hs.* from sgpo_estagiarios se
				inner join unidades_regionais ur on (se.regionalID=ur.regionalID #sqlRegionalID# #sqlUnidadeID#)
				inner join unidades u on (ur.unidadeID=u.unidadeID)
				left join sgpo_setores ss on (ss.setorID=se.setorID #sqlSetorID#)
				inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID #sqlHabilitacao#)
				where
				(se.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or se.cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">  or u.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or hs.habilitacao like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) 
				and datediff(now(),inicioestagio)>90 and fimestagio is null
				and se.deleted is null order by inicioestagio desc,  regional asc, unidade asc, nomesetor asc, nome asc;
			</cfquery>
			<cfset titulo="ESTÁGIOS INICIADOS A MAIS DE 3 MESES">			
			<cfset conteudo= "pdf/estagiario3meses.cfm">
		</cfcase>
		<cfcase value="dadossistema">
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
			<cfset controllernomecampo='Dadossistema' >
			<cfparam name="completasql" default="">
			<cfset url.pesquisa = urldecode(url.pesquisa) >
			<cfquery datasource="#dsn#" name="conteudoconsulta">
				select ds.nome, ds.sistema, ds.dadossistemaID, ds.cpf, ds.identidade, ds.matricula, ds.dtmovimentacao,
				ds.dtdesligamento, ds.dtapresentacao, ds.tipocontrato, ds.designado, ur.jurisdicao as regional,
				u.nome as unidade, ss.nome as nomesetor, ur.regionalID, ur.unidadeID from sgpo_dadossistemas ds
				inner join unidades_regionais ur on (ds.regionalID=ur.regionalID #sqlRegionalID# #sqlUnidadeID#)
				inner join unidades u on (ur.unidadeID=u.unidadeID )
				left join sgpo_setores ss on (ss.regionalID=ur.regionalID and ss.unidadeID=u.unidadeID #sqlSetorID#)
				where
				(ds.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or ds.cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or ds.identidade like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or matricula like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or u.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) 
				and ds.deleted is null and ds.designado is null 
				group by ds.dadossistemaID
				order by ds.updated desc, ds.created desc, regional asc, unidade asc, nomesetor asc, nome;
			</cfquery>			
			<cfset conteudo= "pdf/dadossistema.cfm">
		</cfcase>
		<cfcase value="estagiario">
			<cfset controllernomecampo='Estagiario' >
			<cfparam name="completasql" default="">
			<cfset url.pesquisa = urldecode(url.pesquisa) >
			<cfquery datasource="#dsn#" name="conteudoconsulta">
				select se.*, ur.jurisdicao as regional,
				u.nome as unidade, ss.nome as nomesetor, hs.* from sgpo_estagiarios se
				inner join unidades_regionais ur on (se.regionalID=ur.regionalID #sqlRegionalID# #sqlUnidadeID#)
				inner join unidades u on (ur.unidadeID=u.unidadeID)
				left join sgpo_setores ss on (ss.setorID=se.setorID #sqlSetorID#)
				inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID #sqlHabilitacao#)
				where
				(se.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or se.cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">  or u.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or hs.habilitacao like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) 
				and se.deleted is null order by inicioestagio desc,  regional asc, unidade asc, nomesetor asc, nome asc;
			</cfquery>			
			<cfset conteudo= "pdf/estagiario.cfm">
		</cfcase>
		<cfcase value="setor">
			<cfset controllernomecampo='Setores' >
			<cfparam name="completasql" default="">
			<cfset url.pesquisa = urldecode(url.pesquisa) >
			<cfquery datasource="#dsn#" name="conteudoconsulta">
			select s.tepatco tepatco, s.setorID setorID, s.regionalID regionalID, s.unidadeID unidadeID, s.nome nomeSetor, ur.nome nomeUR, u.nome nomeU, s.telefone telefone, s.descricao descricao, s.created, s.usuariocriou from sgpo_setores as s inner join unidades_regionais ur on (ur.regionalID=s.regionalID and ur.deletedat is  null) inner join unidades u on (u.unidadeID=ur.unidadeID and u.deletedat is null) where s.deleted is null  and s.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">  order by nomeU asc, nomeUR asc, nomeSetor asc
			</cfquery>			
			<cfset conteudo= "pdf/setor.cfm">
		</cfcase>
		<cfcase value="anexo">
			<cfset controllernomecampo='Anexos' >
			<cfparam name="completasql" default="">
			<cfset url.pesquisa = urldecode(url.pesquisa) >
			<cfquery datasource="#dsn#" name="conteudoconsulta">
					select * from sgpo_anexos where deleted is null  and (anexo like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or item like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or documento like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or areaavaliada like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) order by documento asc, anexo asc, item asc, sequenciaitem asc;
			</cfquery>			
			<cfset conteudo= "pdf/anexo.cfm">
		</cfcase>
		<cfcase value="fichacadastral">
			<cfquery datasource="#dsn#" name="conteudoconsulta">
				select se.*, ur.jurisdicao as regional,
				u.nome as unidade, ss.nome as nomesetor, hs.* from sgpo_estagiarios se
				left join unidades_regionais ur on (se.regionalID=ur.regionalID)
				left join unidades u on (ur.unidadeID=u.unidadeID)
				left join sgpo_setores ss on (ss.setorID=se.setorID)
				inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID)
				where
				se.estagiarioID=<cfqueryparam  value="#url.d#" cfsqltype="cf_sql_char"> 
				and se.deleted is null order by se.updated desc, se.created desc, regional asc, unidade asc, nomesetor asc, nome;
			</cfquery>		


				

			<!--template="pdf/fichacadastrallpna.cfm" -->
	
			<cfset conteudo= "pdf/fichacadastral.cfm">-->
		</cfcase>
		<cfcase value="anexoa">
			<cfdump var="#url#">
			<cfquery datasource="#dsn#" name="conteudoconsulta">
				select se.*, ur.jurisdicao as regional,
				u.nome as unidade, ss.nome as nomesetor, hs.* from sgpo_estagiarios se
				left join unidades_regionais ur on (se.regionalID=ur.regionalID #sqlRegionalID# #sqlUnidadeID#)
				left join unidades u on (ur.unidadeID=u.unidadeID)
				left join sgpo_setores ss on (ss.setorID=se.setorID #sqlSetorID#)
				inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID #sqlHabilitacao#)
				where
				se.estagiarioID=<cfqueryparam  value="#url.d#" cfsqltype="cf_sql_char"> 
				and se.deleted is null order by se.updated desc, se.created desc, regional asc, unidade asc, nomesetor asc, nome;
			</cfquery>
			<cfset conteudo= "pdf/anexoa.cfm">
		</cfcase>
		<cfcase value="anexoc">
			<cfset conteudo= "pdf/anexoc.cfm">
			<cfinclude template=#conteudo# >
		</cfcase>
		<cfcase value="anexod">
			<cfset conteudo= "pdf/anexod.cfm">
			<cfinclude template=#conteudo# >
			<cfabort>
		</cfcase>
		<cfcase value="anexob">
			<cfquery datasource="#dsn#" name="conteudoestagiarios">
			select * from sgpo_anexos;
			</cfquery>			
			<cfset conteudo= "pdf/anexob.cfm">
		</cfcase>
		<cfcase value="fichaanexoc">
			<cfquery datasource="#dsn#" name="conteudoconsulta">
				select sf.*,sds.*, se.*, hs.habilitacao as habilitacao, ur.*, ss.*, c.licenca licenca, ss.nome nomesetor from sgpo_fichas sf 
				inner join sgpo_estagiarios se on (se.estagiarioID=sf.estagiarioID) 
				inner join sgpo_dadossistemas sds on (sds.dadossistemaID=se.dadossistemaID)
				inner join cadastros c on (c.cpf=sds.cpf) 
				inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID) 

				left join sgpo_setores ss on (ss.setorID=se.setorID #sqlSetorID#)
				left join unidades_regionais ur on (ss.regionalID=ur.regionalID #sqlRegionalID#)
				left join unidades u on (ur.unidadeID=u.unidadeID #sqlUnidadeID#)

				where
				sf.fichaID=<cfqueryparam  value="#url.d#" cfsqltype="cf_sql_char">
				and sf.deleted is null
				group by sf.fichaID
				order by sf.updated desc, sf.created desc;
			</cfquery>
			<cfset form.id=#url.d# >
			<cfset conteudo= "pdf/fichaanexoc.cfm">
		</cfcase>
		
	</cfswitch>
</cfcase>


<cfscript>
//<!-- ----------------------XLS------------------------- -->
</cfscript>
<cfcase value="xls">
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
	<cfswitch expression="#url.nome#">
		<cfcase value="habilitacoes">
			<cfquery datasource="#dsn#" name="conteudoconsulta">
			select * from sgpo_habilitacoes as sh inner join unidades_regionais ur on (ur.regionalID=s.regionalID and ur.deletedat is  null #sqlRegionalID# #sqlUnidadeID#) inner join unidades u on (u.unidadeID=ur.unidadeID and u.deletedat is null) where s.deleted is null order by nomeU asc, nomeUR asc, nomeSetor asc
			</cfquery>			
			<cfset conteudo= "xls/habilitacao.cfm">
		</cfcase>
		<cfcase value="setor">
			<cfquery datasource="#dsn#" name="conteudosetores">
			select s.regiao regiao,s.tepatco tepatco,s.setorID setorID, s.regionalID regionalID, s.unidadeID unidadeID, s.nome nomeSetor, ur.nome nomeUR, u.nome nomeU, s.telefone telefone, s.descricao descricao, s.created, s.usuariocriou from sgpo_setores as s inner join unidades_regionais ur on (ur.regionalID=s.regionalID and ur.deletedat is  null #sqlRegionalID# #sqlUnidadeID#) inner join unidades u on (u.unidadeID=ur.unidadeID and u.deletedat is null) where s.deleted is null order by nomeU asc, nomeUR asc, nomeSetor asc
			</cfquery>			
			<cfset conteudo= "xls/setor.cfm">
		</cfcase>
		<cfcase value="estagiario">
			<cfset controllernomecampo='Estagiario' >
			<cfparam name="completasql" default="">
			<cfset url.pesquisa = urldecode(url.pesquisa) >
			<cfquery datasource="#dsn#" name="conteudoconsulta">
				select se.*, ur.jurisdicao as regional,
				u.nome as unidade, ss.nome as nomesetor, hs.* from sgpo_estagiarios se
				inner join unidades_regionais ur on (se.regionalID=ur.regionalID #sqlRegionalID# #sqlUnidadeID#)
				inner join unidades u on (ur.unidadeID=u.unidadeID)
				left join sgpo_setores ss on (ss.setorID=se.setorID #sqlSetorID#)
				inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID #sqlHabilitacao#)
				where
				(se.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or se.cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">  or u.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or hs.habilitacao like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) 
				and se.deleted is null order by inicioestagio desc,  regional asc, unidade asc, nomesetor asc, nome asc;
			</cfquery>			
			<cfset conteudo= "xls/estagiario.cfm">
		</cfcase>
		<cfcase value="dadossistema">
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
			<cfset conteudo= "xls/dadossistema.cfm">
		</cfcase>

		
	 </cfswitch>
</cfcase>


<cfscript>
//<!-- ----------------------Gerente------------------------- -->
</cfscript>
<cfcase value="Gerente">
	<cfswitch expression="#url.acao#">
		<cfcase value="list">
		<cfif evaluate('acoes.'& controllernomeplural & '["list"]')==1 >
			<cfquery datasource="#dsn#" name="conteudoestagiarios">
			select * from sgpo_anexos;
			</cfquery>			
			<cfset conteudo= "view/listdesigna.cfm">
		<cfelse>
			<cfset status="ERRO">
			<cfset mensagemstatus="Seu usuário não possui permissão para acessar esta área. Contacte o administrador para maiores esclarecimentos.">
		</cfif>
		</cfcase>
		<cfcase value="designar">
			<cfquery datasource="#dsn#" name="conteudoestagiarios">
			select * from sgpo_anexos;
			</cfquery>			
			<cfset conteudo= "view/caddesigna.cfm">
		</cfcase>
	</cfswitch>
		
</cfcase>
<cfcase value="Agendamento">
	<cfswitch expression="#url.acao#">
		<cfcase value="#dsn#">
			<cfquery datasource="#dsn#" name="c">
			select cadastroID, unidadeID, cpf, ident as identidade, orgao_matricula as matricula, upper(nome) nome from cadastros where concat(cpf, ident, orgao_matricula) not in (select concat(cpf, identidade, matricula) from sgpo_dadossistemas);
			</cfquery>			
			<cfloop query="c" >
				<cfquery datasource="#dsn#" name="insere">
				insert into sgpo_dadossistemas (dadossistemaID, cadastroID, regionalID, nome, cpf, identidade, matricula, created, usuariocriou, ipcriou, hostcriou, sistema) values (uuid(), "#c.cadastroID#", "#c.unidadeID#", "#c.nome#", "#c.cpf#", "#c.identidade#", "#c.matricula#", now(), "#u.usuarioID#", '#cgi.remote_addr#','#cgi.remote_host#', 'lpna') 
				</cfquery>			
			</cfloop>
		</cfcase>
	</cfswitch>
</cfcase>



</cfswitch>

</cfsilent>






