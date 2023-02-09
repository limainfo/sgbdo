<?php
// app/config/my_session.php
//
// Reverte o valor e força checagem do referrer mesmo quando
// Security.level for medium
ini_restore('session.referer_check');

ini_set('session.use_trans_sid', 0);
//ini_set('session.name', Configure::read('Session.cookie'));
ini_set('session.name', 'SGBDO');
// Cookies agora são destruídos quando o navegador é fechado,
// não persiste a informação por dias e é o padrão para nível
// de segurança em low ou medium
ini_set('session.cookie_lifetime', 0);

// Cookie path agora é '/', mesmo se sua aplicação estiver
// em um subdiretório no domínio
$this->path = '/var/www/html/cake/sessions/';
ini_set('session.cookie_path', $this->path);

// Cookies de sessão agora são persistidos para todos
// os subdomínios
ini_set('session.cookie_domain', env('HTTP_BASE'));

?>