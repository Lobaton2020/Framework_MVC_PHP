<div class="container">
    <form action="<?php echo route("main/update") ?>" method="POST">
        <input type="hidden" name="id" value="<?php echo $link->id_link_PK  ?>">
        <div class="form-group">
            <label for="exampleInputPassword1">Titulo</label>
            <input type="text" class="form-control" name="titulo" value="<?php echo $link->titulo ?>" id="exampleInputPassword1">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">URL</label>
            <input type="text" class="form-control" name="url_link" value="<?php echo $link->url_link ?>" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>