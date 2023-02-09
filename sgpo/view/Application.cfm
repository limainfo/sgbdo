<cfif NOT isDefined("Application.sslfix")>
	<cfset objSecurity = createObject("java", "java.security.Security") />
	<cfset objSecurity.removeProvider("JsafeJCE") />
	<cfset Application.sslfix = true />
</cfif>
