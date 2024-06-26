<?php

include_once "../core/ModeloBasePDO.php";
class AdminModel extends ModeloBasePDO {

    public function __construct() { 
        parent::__construct(); 
    } 

    public function findall() { 
        $sql = "SELECT * FROM usuarios";
        $param = array(); 
        return parent::gselect($sql,$param);
    }

public function findpaginateall($p_filtro, $p_limit, $p_offset) { 
    $sql = " SELECT * FROM personas 
    WHERE upper(concat(
        IFNULL(nombre,''),
        IFNULL(carnet,''),
        IFNULL(fecha_nacimiento,''),
    like CONCAT('%',upper(IFNULL(:p_filtro,'' )), '%')
    LIMIT :p_limit OFFSET :p_offset  ";

    $param = array(); 

    array_push($param, [':p_filtro', $p_filtro, PDO::PARAM_STR]);
    array_push($param, [':p_limit', $p_limit, PDO::PARAM_INT]);
    array_push($param, [':p_offset', $p_offset, PDO::PARAM_INT]);

    $var = parent::gselect($sql, $param);

    $sqlCount = "SELECT count(1) as cant 
    FROM personas 
    WHERE upper(concat(
        IFNULL(nombre,''),
        IFNULL(carnet,''),
        IFNULL(fecha_nacimiento,''),
    LIKE CONCAT('%',upper(IFNULL(:p_filtro,'' )), '%') ";

 	$param = array();
    array_push($param, [':p_filtro', $p_filtro, PDO::PARAM_STR]);

	// $var1 = parent::gselect($sqlCount, $param);
    // $var['LENGTH'] = $var1['DATA'][0]['cant'];    
    return $var;
 }

function findId($p_cod_apl){ 
    $sql = " SELECT * FROM personas WHERE cod_apl = :p_cod_apl";
    $param = array(); 
    array_push($param, [':p_cod_apl', $p_cod_apl, PDO::PARAM_STR]);
    return parent::gselect($sql, $param);
}

public function register($email,$password) {
    $sql = "INSERT INTO admin (email,password) VALUES (:email,:password)";
    $param = array(); 
    array_push($param, [':email', $email, PDO::PARAM_STR]);
    array_push($param, [':password', $password, PDO::PARAM_STR]);
    return parent::ginsert($sql,$param);
}

public function verificarLogin($email,$password){
    $sql = "SELECT * FROM admin WHERE email = :email";
    $param = array();
    array_push($param,[':email', $email, PDO::PARAM_STR]);
    $result = parent::gselect($sql,$param);

    if (count($result['DATA']) > 0) {
        $user = $result['DATA'][0];
        if (password_verify($password, $user['password'])) { // Verificar la contraseña
            return [
                'ESTADO' => true,
                'DATA' => $user
            ];
        }
    }

    return [
        'ESTADO' => false,
        'ERROR' => "Usuario o contraseñas no válidos, verifique sus datos"
    ];
}

public function update($p_cod_usu,$p_cod_apl,$p_estado,$p_usu_cre,$p_fh_cre,$p_usu_mod,$p_fh_mod) {
$sql = "UPDATE seg_accesos SET 
cod_usu = :p_cod_usu,estado = :p_estado,usu_cre = :p_usu_cre,fh_cre = :p_fh_cre,usu_mod = :p_usu_mod,fh_mod = :p_fh_mod
 WHERE cod_apl = :p_cod_apl";
 $param = array(); 
array_push($param, [':p_cod_usu', $p_cod_usu, PDO::PARAM_STR]);

array_push($param, [':p_cod_apl', $p_cod_apl, PDO::PARAM_STR]);

array_push($param, [':p_estado', $p_estado, PDO::PARAM_STR]);

array_push($param, [':p_usu_cre', $p_usu_cre, PDO::PARAM_STR]);

array_push($param, [':p_fh_cre', $p_fh_cre, PDO::PARAM_STR]);

array_push($param, [':p_usu_mod', $p_usu_mod, PDO::PARAM_STR]);

array_push($param, [':p_fh_mod', $p_fh_mod, PDO::PARAM_STR]);


 return parent::gupdate($sql, $param);
    }
function delete($p_cod_apl) { $sql = "DELETE FROM seg_accesos WHERE cod_apl = :p_cod_apl"; $param = array(); 
array_push($param, [':p_cod_apl', $p_cod_apl, PDO::PARAM_STR]);


 return parent::gdelete($sql, $param);
    }
} 
 ?>
