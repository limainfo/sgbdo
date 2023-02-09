<cftry>
     		   <cfhttp
                url="http://sisosweb.cindacta1.intraer/indxenviasms.php?fone=#form.fone#&txt=#form.txt#"
                method="GET" resolveurl="yes" timeout="10">
      		</cfhttp>
        		<cfset ok = '{"ok":1}'>
        		<cfcatch type="any">
        		<cfset ok = '{"ok":0}'>
        		</cfcatch>

</cftry>
<cfoutput>#ok#</cfoutput>
<cfabort>