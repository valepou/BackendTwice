<?php $id = $_GET['id'];?>
<?php echo $id; include('../config/constants.php'); ?>

<?php include('../partials/head.php'); ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Modificar Usuario</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<? echo SITEURL; ?>index.html">Inicio</a></li>
                <li class="breadcrumb-item active">Modificar Usuario</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    Modifica Usuarios registrados en la app de Twice (Completa todos los campos).
                </div>
            </div>
            <?php 
            if(isset($_SESSION['errorE'])){
                echo $_SESSION['errorE'];
                unset($_SESSION['errorE']);
            }
            $sql = "SELECT * FROM usuarios WHERE id_usuario=$id";
            $res=mysqli_query($conn,$sql);
            if($res==TRUE){
                $count = mysqli_num_rows($res);
                if($count == 1){
                    $row = mysqli_fetch_assoc($res);
                    $nombre = $row['nombre'];
                    $apellido = $row['apellido'];
                    $email = $row['email'];
                }else{
                    header('location:'.SITEURL.'/consultar_usuarios.php');
                }
            }
            ?>
            <div class="row">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input required type="text" class="form-control" id="nombre" 
                        name="nombre" placeholder="Ingresa el nombre(s)" 
                        value="<?php if(isset($_SESSION['nombre'])){ echo $_SESSION['nombre'];
                         }else{ echo $nombre ;}?>">
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido:</label>
                        <input required type="text" class="form-control" id="apellido" 
                         name="apellido" placeholder="Ingresa el apellido(s)"
                         value="<?php if(isset($_SESSION['apellido'])){ echo $_SESSION['apellido'];
                         }else{ echo $apellido; }?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input required type="email" class="form-control" id="email" name="email" placeholder="Ingresa el email" value="<?php if(isset($_SESSION['email'])){
                            echo $_SESSION['email']; 
                            }else{ echo $email ; }?>">
                    </div>
                     <input type="hidden" name="id" value="<?php echo $id; ?>">
                     <input type="hidden" name="prevEmail" value="<?php echo $email; ?>">
                    <button type="submit" name="submit" class="btn btn-success">Actualizar</button>
                
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
        $prevEmail = $_POST['prevEmail'];
        $id = $_POST['id'];
        if(strcmp($email,$prevEmail)!==0){
            $sql = "SELECT *FROM usuarios WHERE email ='$email'";
            $res =mysqli_query($conn,$sql) or die(mysqli_error($conn));
            if(mysqli_num_rows($res) >0){
            $_SESSION['errorE'] = "<div class='alert alert-danger'>Ya existe un registro con ese email</div>";
            $_SESSION['nombre'] =$nombre;
            $_SESSION['apellido']=$apellido;
            $_SESSION['email']=$email;
            header("location:" .SITEURL. '/usuarios/actualizar_usuario.php?id='.$id);
            die();
           }
        }
        $sql2="UPDATE usuarios SET
        nombre = '$nombre',
        apellido ='$apellido',
        email = '$email'
        WHERE id_usuario = $id";
        $res = mysqli_query($conn,$sql2) or die(mysqli_error($conn));
        if($res== TRUE){
            unset($_SESSION['nombre']);
            unset($_SESSION['apellido']);
            unset($_SESSION['email']);
            $_SESSION['agregar']="<div class='alert alert-success'>Usuario actualizado correctamente</div>";
            header("location:" .SITEURL.'/usuarios/consultar_usuarios.php');
            die();
        }else{
            $_SESSION['agregar'] = "<div class='alert alert-alert'>Error al guardar</div>";
            header("location:".SITEURL.'/usuarios/actualizar_usuario.php?=id'.$id);
            die();
        }
    }
    ?>