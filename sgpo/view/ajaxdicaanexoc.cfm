<cfquery name="r" datasource="lpna">
select areaavaliada, dicaareaavaliada, #form.tipo# from sgpo_anexos where anexoID=<cfqueryparam cfsqltype="CF_SQL_VARCHAR" value="#form.id#"> 
</cfquery>
<cfscript>
 saida = serializeJSON(r, true);
 writeOutput(saida);
</cfscript>
