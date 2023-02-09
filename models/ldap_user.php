<?php 
class LdapUser extends AppModel
{
    var $name = 'LdapUser';
    var $useTable = false;

    var $host       = '10.112.24.20';
    var $port       = 389;
    var $baseDn = 'dc=cindacta4,dc=intraer';
    var $user       = 'ou=Users,dc=cindacta4,dc=intraer';
    var $pass       = '';
    var $ds;

function __construct()
{
    parent::__construct();
    $this->ds = ldap_connect($this->host, $this->port);
    ldap_set_option($this->ds, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_bind($this->ds, $this->user, $this->pass);
}

function __destruct()
{
    ldap_close($this->ds);
}
function findAll($attribute = 'uid', $value = '*', $baseDn = null  )
{
    $r = ldap_search($this->ds, $this->baseDn, $attribute . '=' . $value);

    if ($r)
    {
        //if the result contains entries with surnames,
        //sort by surname:
        ldap_sort($this->ds, $r, "sn");

        return ldap_get_entries($this->ds, $r);
    }
}
function auth($uid, $password)
{
    $result = $this->findAll('uid', $uid);

    if($result[0])
    {
        if (ldap_bind($this->ds, $result[0]['dn'], $password))
            {
                return true;
            }
            else
            {
                return false;
            }
    }
    else
    {
        return false;
    }
}

}
?>