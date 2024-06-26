<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
// header("Content-Type: application/json; charset=UTF-8");
// session_start();

require_once ($_SERVER['DOCUMENT_ROOT'] . "/crudAlimentos/config/global.php");

require_once (ROOT_DIR . "/models/AdminModel.php");

$method = $_SERVER['REQUEST_METHOD'];

$input = json_decode(file_get_contents('php://input'),true);
// file_get_contents() es una función en PHP que lee el contenido de un archivo en una cadena.
// 'php://input' es un flujo de entrada que permite leer datos sin procesar del cuerpo de la solicitud. Esto es particularmente útil para leer datos enviados en una solicitud HTTP POST, PUT, o PATCH, especialmente cuando los datos están en formato JSON.
// json_decode() es una función en PHP que convierte una cadena JSON en una variable de PHP.
// El segundo parámetro de json_decode() es opcional. Si se establece en true, la función convierte los objetos JSON en arrays asociativos de PHP. Si se omite o se establece en false, convierte los objetos JSON en objetos de PHP.
// En resumen, esta línea de código está diseñada para recibir datos JSON enviados a través de una solicitud HTTP y convertirlos en una estructura de datos que puede ser fácilmente manipulada en PHP (un array asociativo).

try{
    $Path_Info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : (isset($_SERVER['ORIG_PATH_INFO']) ? $_SERVER['ORIG_PATH_INFO'] : '');
    $request = explode('/', trim($Path_Info,'/'));
}catch (Exception $e){
    echo $e->getMessage();
}

switch ($method) {
    // enviar informatcion mediante formulario con metodo post
    case 'GET':
        $p_ope = !empty($input['ope']) ? $input['ope']:$_GET['ope'];
        if($p_ope == "filterSearch"){
            filterAll();
        }
        break;
    case 'POST':
        $p_ope = !empty($input['ope']) ? $input['ope']:$_POST['ope'];
        if($p_ope == "login"){
            login($input);
        }else if($p_ope == "register"){
            register($input);
        }else if($p_ope == "logout"){
            session_destroy();
        }
        break;
    default://metodo NO soportado
        echo 'METODO NO SOPORTADO';
        break;
}

function filterAll(){
    $modelUser = new AdminModel();
    $var = $modelUser->findall();
    echo json_encode($var);
}

// function  filterPaginateAll($input){
//     $nro_record_page = 10;
//     $page = !empty($input['page'])?$input['page']:$_GET['page'];
//     $filter = !empty($input['filter'])?$input['filter']:$_GET['filter'];
//     $p_limit = 10;
//     $p_offset=0;
//     $p_offset=abs(($page-1) * $nro_record_page);
//     $modelUser = new UsuarioModel();
//     $var = $modelUser->findpaginateall($filter, $p_limit, $p_offset);
//     echo json_encode($var);
// }

function login($input){
    $email = !empty($input['email']) ? $input['email'] : $_POST['email'];
    $password = !empty($input['password']) ? $input['password'] : $_POST['password'];

    $admin = new AdminModel();
    $var = $admin->verificarLogin($email,$password);
    echo json_encode($var);
}

function register($input){
    $email = !empty($input['email']) ? $input['email'] : $_POST['email'];;
    $password = !empty($input['password']) ? $input['password'] : $_POST['password'];;
    $psw_hash = password_hash($password,PASSWORD_BCRYPT);

    $user = new AdminModel();
	$var = $user->register($email,$psw_hash);
    echo json_encode($var);
}

// function update($input){
// $p_cod_usu = !empty($input['cod_usu'])?$input['cod_usu']:$_POST['cod_usu'];;
// $p_cod_apl = !empty($input['cod_apl'])?$input['cod_apl']:$_POST['cod_apl'];;
// $p_estado = !empty($input['estado'])?$input['estado']:$_POST['estado'];;
// $p_usu_cre = !empty($input['usu_cre'])?$input['usu_cre']:$_POST['usu_cre'];;
// $p_fh_cre = !empty($input['fh_cre'])?$input['fh_cre']:$_POST['fh_cre'];;
// $p_usu_mod = !empty($input['usu_mod'])?$input['usu_mod']:$_POST['usu_mod'];;
// $p_fh_mod = !empty($input['fh_mod'])?$input['fh_mod']:$_POST['fh_mod'];;

//     $tseg_accesos = new Seg_accesosModel();
// 	$var = $tseg_accesos->update($p_cod_usu,$p_cod_apl,$p_estado,$p_usu_cre,$p_fh_cre,$p_usu_mod,$p_fh_mod);
    
//     echo json_encode($var);
// }

// function delete($input){
// $p_cod_apl = !empty($input['cod_apl'])?$input['cod_apl']:$_POST['cod_apl'];;

//     $tseg_accesos = new Seg_accesosModel();
// 	$var = $tseg_accesos->delete($p_cod_apl);
    
//     echo json_encode($var);
// } 
 ?>