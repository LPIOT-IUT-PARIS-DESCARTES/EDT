<?php
ini_set('display_errors', 1);
?>
<hr>
<div class="row">
    <div class="col-md-6">
        <h2> Modules </h2>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">id_uemod</th>
                <th scope="col">id_form</th>
                <th scope="col">nom</th>
                <th scope="col">classif</th>
                <th scope="col">label</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($modules = $module->fetch()){ ?>
            <tr>
                <th scope="row"><?php echo $modules['id_uemod'] ?></th>
                <td><?php echo $modules['id_form'] ?></td>
                <td><?php echo $modules['nom'] ?></td>
                <td><?php echo $modules['classif'] ?></td>
                <td><?php echo $modules['label'] ?></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="col-md-6">
        <h2> Modules et formation </h2>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">id_uemod</th>
                <th scope="col">formation</th>
                <th scope="col">module</th>
                <th scope="col">classif</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($modulesform = $moduleform->fetch()){ ?>
                <tr>
                    <th scope="row"><?php echo $modulesform['id_uemod'] ?></th>
                    <td><?php echo $modulesform['nom_form'] ?></td>
                    <td><?php echo $modulesform['nom_module'] ?></td>
                    <td><?php echo $modulesform['classif'] ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <h2> Période </h2>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">id_period</th>
                <th scope="col">id_promo</th>
                <th scope="col">label</th>
                <th scope="col">tDeb</th>
                <th scope="col">tFin</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($periodes = $periode->fetch()){ ?>
                <tr>
                    <th scope="row"><?php echo $periodes['id_period'] ?></th>
                    <td><?php echo $periodes['id_promo'] ?></td>
                    <td><?php echo $periodes['label'] ?></td>
                    <td><?php echo $periodes['tDeb'] ?></td>
                    <td><?php echo $periodes['tFin'] ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="col-md-6">
        <h2> Période </h2>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">id_period</th>
                <th scope="col">label_promo</th>
                <th scope="col">label_period</th>
                <th scope="col">tDeb</th>
                <th scope="col">tFin</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($periodes = $periodepromo->fetch()){ ?>
                <tr>
                    <th scope="row"><?php echo $periodes['id_period'] ?></th>
                    <td><?php echo $periodes['label_promo'] ?></td>
                    <td><?php echo $periodes['label_period'] ?></td>
                    <td><?php echo $periodes['tDeb'] ?></td>
                    <td><?php echo $periodes['tFin'] ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>