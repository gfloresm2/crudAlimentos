
<?php

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $ope = "register";
    $email = $_POST['email'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    // verificar password
    if(strcmp($password,$c_password) === 0){
        try {
            $data = [
                'ope' => $ope,
                'email' => $email,
                'password' => $password,
            ];
            $context = stream_context_create([
                'http' => [
                    'method' => 'POST',
                    'header' => 'Content-Type: application/json',
                    'content' => json_encode($data)
                ]
            ]);
            $response = file_get_contents(HTTP_BASE . "/controllers/LoginController.php",false,$context);
            $result = json_decode($response,true);
            // echo "<pre>";
            // var_dump($result);
            // echo "</pre>";
            if($result['ESTADO']){
                echo "
                <script>
                alert('Admin registrado correctamente');
                window.location.href = '". HTTP_BASE ."/login/login';
                </script>
                ";
            }else{
                echo "
                <script>
                alert('No se puede guardar');
                </script>
                ";
            }
        } catch (Exception $th) {
            echo "
            <script>
            alert('Ocurrio un error al guardar');
            </script>
            ";
            //throw $th;
        }
    }else{
        echo "
        <script>
        alert('contrasenias no coinciden');
        </script>
        ";

    }

}






?>


<?php require_once(ROOT_VIEW . "/templates/header-login.php");?>
<div class="w-96 h-96 bg-white py-7 px-5">
    <h1 class="text-center text-lg mb-2">Register</h1>
    <hr>
    <form action="" class="" method="POST">
        <div class="flex h-10 items-center mt-7 border p-1">
            <h1>@</h1>
            <input class="w-full h-full ml-2" type="email" required placeholder="Email" name="email">
        </div>
        <div class="flex h-10 items-center mt-2 border p-1">
            <h1>@</h1>
            <input class="w-full h-full ml-2" type="text" required placeholder="Password" name="password">
        </div>
        <div class="flex h-10 items-center mt-2 border p-1">
            <h1>@</h1>
            <input class="w-full h-full ml-2" type="text" required placeholder="Confirm password" name="c_password">
        </div>
        <button class="w-full h-10 bg-blue-400 rounded-sm mt-6 text-white hover:opacity-50" type="submit">Register</button>
    </form>
    <p class="mt-7 flex justify-center items-center w-full gap-2">Do you already have an account? <a class="text-blue-600 cursor-pointer border-b-blue-700" href="<?= HTTP_BASE ?>/login/login">Login -></a></p>
</div>
<?php require_once(ROOT_VIEW . "/templates/footer-login.php");?>