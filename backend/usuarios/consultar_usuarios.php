<?php include('../config/constants.php'); ?>

<?php include('../partials/head.php'); ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Consultar Usuarios</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<? echo SITEURL; ?>index.html">Inicio</a></li>
                <li class="breadcrumb-item active">Tables</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    Usuarios registrados en la app de Twice
                </div>
            </div> 
            <?php 
            if(isset($_SESSION['agregar'])) {
                echo $_SESSION['agregar'];
                unset($_SESSION['agregar']);
               }
            ?>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Usuarios
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Email</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Email</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $sql = "SELECT id_usuario,nombre,apellido,email FROM usuarios ";
                            $res = mysqli_query($conn, $sql);
                            if ($res == TRUE) {
                                $count = mysqli_num_rows($res);
                                if ($count > 0) {
                                    while ($rows = mysqli_fetch_assoc($res)) {
                                        $id = $rows['id_usuario'];
                                        $nombre = $rows['nombre'];
                                        $apellido = $rows['apellido'];
                                        $email = $rows['email'];
                            ?>
                                        <tr>
                                            <td><?php echo $id ?></td>
                                            <td><?php echo $nombre ?></td>
                                            <td><?php echo $apellido ?></td>
                                            <td><?php echo $email ?></td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="<?php echo SITEURL;?>/usuarios/actualizar_usuario.php?id=<?php echo $id;?>">Modificar</a>
                                            </td>
                                        </tr>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    
    <?php include('../partials/footer.php'); ?>