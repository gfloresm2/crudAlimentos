<?php
define("CONTROLADOR_DEFECTO", "Usuarios");
define("ACCION_DEFECTO", "index");

define("RUTA_BASE",$_SERVER['DOCUMENT_ROOT']."/");
define("HTTP_BASE","http://localhost/crudAlimentos");
define('ROOT_DIR',RUTA_BASE.'crudAlimentos');
define('ROOT_CORE',RUTA_BASE.'crudAlimentos/core');
// define('ROOT_UPLOAD',RUTA_BASE.'crudAlimentos/uploads');
define('ROOT_VIEW',RUTA_BASE.'crudAlimentos/views');
// define('ROOT_REPORT',RUTA_BASE.'crudAlimentos/reports');
// define('ROOT_REPORT_DOWN',RUTA_BASE.'crud2/reports_download');
define("URL_RESOURCES", HTTP_BASE. "/public/");
//JWT TOKEN
// define('SECRET_KEY','MIEMPRESA.MBmxKMifghY7d55sghvTlB1jyAjB3uN0g6ZDdOXpz21');  // secret key can be a random string and keep in secret from anyone
// define('ALGORITHM','HS256');   // Algorithm used to sign the token
?>