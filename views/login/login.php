<?php
if($_SERVER['REQUEST_METHOD'] === "POST"){
    $ope = "login";
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        //code...
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
        if($result['ESTADO']){
            echo "
            <script>
                alert('Bienvenido!!');
                window.location.href = '". HTTP_BASE ."';
            </script>
            ";
        }else{
            echo "
            <script>
                alert('No Registrado!!');
            </script>
            ";
        }

    } catch (Exception $th) {
        echo "
        <script>
            alert('Hubo un error');
        </script>
        ";
    }



}









?>
<?php require_once( ROOT_VIEW . "/templates/header-login.php");?>
<div class="w-96 h-96 bg-white py-7 px-5">
    <h1 class="text-center text-lg mb-2">Login</h1>
    <hr>
    <form action="" class="" method="POST">
        <div class="flex h-10 items-center mt-7 border p-1">
            <h1>@</h1>
            <input class="w-full h-full ml-2" type="email" required placeholder="Email" name="email">
        </div>
        <div class="flex h-10 items-center mt-2 border p-1">
            <h1>@</h1>
            <input class="w-full h-full ml-2" type="password" required placeholder="Password" name="password">
        </div>
        <div class="flex justify-center items-center gap-2 mt-4">
            <input type="checkbox">
            <p>Remember me?</p>
        </div>
        <button class="w-full h-10 bg-blue-400 rounded-sm mt-6 text-white hover:opacity-50" type="submit">Login</button>
    </form>
    <p class="mt-7 flex justify-center items-center w-full gap-2">You don't have an account? <a class="text-blue-600 cursor-pointer border-b-blue-700" href="<?= HTTP_BASE ?>/login/register">Register now -></a></p>
</div>
<?php require_once( ROOT_VIEW . "/templates/footer-login.php");?>