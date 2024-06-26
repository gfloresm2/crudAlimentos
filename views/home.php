<?php include_once(ROOT_VIEW . "/templates/header.php"); ?>

<h1 class="text-center text-4xl mt-5 mb-10">Crud Alimentos</h1>
<div class="w-4/5 flex items-start p-5 sm:flex sm:flex-row ">
    <form action="" method="" class="flex flex-col w-1/3 h-96 gap-2">
        <label for="">Nombre: </label>
        <input type="text" placeholder="Ingrese el nombre" name="nombre">
        <label for="">Precio:</label>
        <input type="text" placeholder="Ingrese el precio" name="precio">
        <label for="">Imagen:</label>
        <input type="file" name="imagen">
        <button class="bg-blue-300 h-10" type="submit">Agregar</button>
    </form>
    <table class="border-collapse border border-slate-500 p-5 w-full">
        <thead>
            <tr>
                <td class="border border-slate-600">Id</td>
                <td class="border border-slate-600">Nombre</td>
                <td class="border border-slate-600">Precio</td>
                <td class="border border-slate-600">Imagen</td>
                <td class="border border-slate-600">Fecha de Creacion</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border border-slate-600">1</td>
                <td class="border border-slate-600">Manzana</td>
                <td class="border border-slate-600">20.00</td>
                <td class="border border-slate-600"><img src="./../public/img/imagen1.jpg" alt=""></td>
                <td class="border border-slate-600">20/06/2024 7:13</td>
            </tr>
            <tr>
                <td class="border border-slate-600">2</td>
                <td class="border border-slate-600">Manzana</td>
                <td class="border border-slate-600">20.00</td>
                <td class="border border-slate-600"><img src="./../public/img/imagen1.jpg" alt=""></td>
                <td class="border border-slate-600">20/06/2024 7:13</td>
            </tr>
        </tbody>
    </table>
</div>

<?php include_once(ROOT_VIEW . "/templates/footer.php"); ?>