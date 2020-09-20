<div class="container">
    <?php attendMessage(); ?>
    <form action="<?php echo route("main/store") ?>" method="POST">
        <input type="hidden" name="id" value="">
        <div class="form-group">
            <label for="exampleInputPassword1">Titulo</label>
            <input type="text" class="form-control" name="titulo" value="" id="exampleInputPassword1">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">URL</label>
            <input type="text" class="form-control" name="url_link" value="" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</div>