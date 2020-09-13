<!-- <form action="<?php echo route("user/store") ?>" method="POST">
    <div>
        <input type="hidden" name="idrol" value="1">
        <input type="hidden" name="name" value="2">
        <input type="hidden" name="lastname" value="3">
        <input type="hidden" name="email" value="4">
        <input type="hidden" name="nickname" value="jUNA">
        <input type="hidden" name="password" value="6">

    </div>
    <input type="submit" name="" value="Enviar">
</form> -->

<!-- <form action="<?php echo route("user/update") ?>" method="POST">
    <div>
        <input type="hidden" name="iduser" value="1">
        <input type="hidden" name="lastname" value="Pedro Juama">

    </div>
    <input type="submit" name="" value="Actualizar">
</form> -->


<!-- <form action="<?php echo route("user/delete") ?>" method="POST">
    <div>
        <input type="hidden" name="id" value="1">
    </div>
    <input type="submit" name="" value="Eliminar">
</form> -->

<form action="<?php echo route("user/disable") ?>" method="POST">
    <div>
        <input type="hidden" name="id" value="5">
    </div>
    <input type="submit" name="" value="Inhabilitar">
</form>