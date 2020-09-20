<div class="container">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <?php attendMessage(); ?>
            <a href="<?php echo route("main/create") ?>">Crear</a>
            <table class="table">
                <thead>
                    <th>Titulo</th>
                    <th>Url</th>
                    <th>Fecha</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <?php foreach ($links as $link) : ?>
                        <tr>
                            <td><?php echo $link->titulo ?></td>
                            <td><a href="<?php echo $link->url_link ?>" target="_blank">Ir al sitio</a></td>
                            <td><?php echo format_date($link->fecha_ingreso) ?></td>
                            <td>
                                <a href="<?php echo route("main/edit/{$link->id_link_PK}") ?>" class="btn btn-info">Actualizar</a>
                                <a onclick="return confirm(' Esta Seguro?')" href="<?php echo route("main/delete/{$link->id_link_PK}") ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>