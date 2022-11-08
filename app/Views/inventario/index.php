<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <base href="/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  
    <link rel="stylesheet" href="<?= base_url() ?>/css/styles.ef46db3751d8e999.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <style type="text/css">@font-face{font-family:'Material Icons';font-style:normal;font-weight:400;src:url(https://fonts.gstatic.com/s/materialicons/v139/flUhRq6tzZclQEJ-Vdg-IuiaDsNcIhQ8tQ.woff2) format('woff2');}.material-icons{font-family:'Material Icons';font-weight:normal;font-style:normal;font-size:24px;line-height:1;letter-spacing:normal;text-transform:none;display:inline-block;white-space:nowrap;word-wrap:normal;direction:ltr;-webkit-font-feature-settings:'liga';-webkit-font-smoothing:antialiased;}</style>
</head>
<body>

        <div class="row">
            <div class="col s6">
                <br>
                <h5>Inventario</h5>
                <div class="center">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Id</td>
                                <td>Codigo</td>
                                <td>Nombre</td>
                                <td>Cantidad</td>
                                <td>Precio</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($inventarios as $item): ?>
                            <tr>
                                <td><?= $item->id ?></td>
                                <td><?= $item->codigo ?></td>
                                <td><?= $item->name ?></td>
                                <td><?= $item->quantity ?></td>
                                <td><?= $item->precio ?></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
             
            </div>
            <div class="col s6" style="display:flex;justify-content:center;">
            <app-root ></app-root>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="<?= base_url() ?>/js/runtime.1adfd6eec953d3e4.js" type="module"></script>
    <script src="<?= base_url() ?>/js/polyfills.bf56d2c45c356a5c.js" type="module"></script>
    <script src="<?= base_url() ?>/js/main.34406f4e53161dc2.js" type="module"></script>
</body>
</html>