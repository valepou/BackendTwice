<?php include('../config/constants.php'); ?>

<?php include('../partials/head.php'); ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Registrar Usuario</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<? echo SITEURL; ?>index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Registrar Usuario</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    Registra Usuarios en la app de Twice (Completa todos los campos).
                </div>
            </div>
            <?php 
            if(isset($_SESSION['errorP'])){
                echo $_SESSION['errorP'];
                unset($_SESSION['errorP']);
            }
            if(isset($_SESSION['errorE'])){
                echo $_SESSION['errorE'];
                unset($_SESSION['errorE']);
            }
            ?>
            <div class="row">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input required type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa el nombre(s)" value="<?php if(isset($_SESSION['nombre'])){
                            echo $_SESSION['nombre']; }else{ echo''; }?>">
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido:</label>
                        <input required type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingresa el apellido(s)" value="<?php if(isset($_SESSION['apellido'])){
                            echo $_SESSION['apellido']; }else{ echo''; }?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input required type="email" class="form-control" id="email" name="email" placeholder="Ingresa el email" value="<?php if(isset($_SESSION['email'])){
                            echo $_SESSION['email']; }else{ echo''; }?>">
                    </div>
                    <div class="mb-3">
                        <label for="pass" class="form-label">Contraseña:</label>
                        <input required type="password" class="form-control" id="pass" name="pass" placeholder="Ingresa tu  contraseña">
                    </div>
                    <div class="mb-3">
                        <label for="rePass" class="form-label">Confirma tu Contraseña:</label>
                        <input required type="password" class="form-control" id="rePass" name="rePass" placeholder="Contirma tu  contraseña">
                    </div>
                    <button type="submit" name="submit" class="btn btn-success">Registre</button>
                </form>
            </div>
            
        </div>
    </main> 
    <?php include('../partials/footer.php'); ?>
    <?php
    if(isset($_POST['submit'])){
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $rePass = $_POST['rePass'];
        if(strcmp($pass,$rePass)!==0){
            
            $_SESSION['errorP'] = "<div class='alert alert-danger'>Las contraseñas no coinciden</div>";
            $_SESSION['nombre'] =$nombre;
            $_SESSION['apellido']=$apellido;
            $_SESSION['email']=$email;
            header("location:" .SITEURL. '/usuarios/registrar_usuario.php');
            die();
        }
        $password = password_hash($pass,PASSWORD_DEFAULT);
        $sql = "SELECT *FROM usuarios WHERE email ='$email'";
        $res =mysqli_query($conn,$sql2) or die(mysqli_error($conn));
        if(mysqli_num_rows($res) >0){
            $_SESSION['errorP'] = "<div class='alert alert-danger'>Ya existe un usuario igual</div>";
            $_SESSION['nombre'] =$nombre;
            $_SESSION['apellido']=$apellido;
            $_SESSION['email']=$email;
            header("location:".SITEURL.'/usuarios/registrar_usuario.php');
            die();
        }
        $sql2="INSERT INTO usuarios SET
        nombre = '$nombre',
        apellido ='$apellido',
        email = '$email',
        password = '$password'";
        $res = mysqli_query($conn,$sql2) or die (mysqli_error($conn));
        if($res== TRUE){
            unset($_SESSION['nombre']);
            unset($_SESSION['apellido']);
            unset($_SESSION['email']);
            $_SESSION['agregar']="<div class='alert alert-success'>Usuario guardado correctamente</div>";
            header("location:" .SITEURL. '/usuarios/consultar_usuarios.php');
            die();
        }else{
            $_SESSION['agregar'] = "<div class='alert alert-alert'>Error al guardar</div>";
            header("location:".SITEURL.'/usuarios/registrar_usuario.php');
            die();
        }
    }
    ?>