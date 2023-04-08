<?php 
session_start();

if (isset($_SESSION['iduser']) && isset($_SESSION['nombrecompleto']))  {

 ?>
 
 <?php
    include_once '../../db_conn.php';
    
    // Obtener el email del usuario a editar desde la URL
$email = $_GET['email'];

// Obtener los datos del usuario de la base de datos
$query = "SELECT * FROM usuario WHERE email = '$email'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// Si se ha enviado el formulario de edición, actualizar los datos del usuario
if(isset($_POST['editar'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $nombrecompleto = $_POST['nombrecompleto'];
  $idpuesto = $_POST['idpuesto'];
  $telefono = $_POST['telefono'];
  $firma = $_POST['firma'];

  $query = "UPDATE usuario SET password='$password', nombrecompleto='$nombrecompleto', idpuesto='$idpuesto', telefono='$telefono', firma='$firma' WHERE email='$email'";
  mysqli_query($conn, $query);

  // Redirigir de vuelta a la página de usuarios
  header('Location: home.php');
  exit;
}
?>
    

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    
<!----------CSS---------->
<link rel="stylesheet" href="../../css/styleusuarios.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <title>Control Usuarios Grupo SARA </title>
    <script src="script.js"></script>

</head>
<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="../../img/logo.png" alt="">
                </span>

                <div class="text header-text">
                    <span class="name">Grupo SARA</span>
                    <span class="profession">Construcciones</span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle' ></i>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="home.php">
                            <i class='bx bx-user'></i>
                            <span class="text nav-text">Control de Usuarios</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="../licitaciones/home.php">
                            <i class='bx bx-paperclip'></i>
                            <span class="text nav-text">Licitaciones</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="../proyectos/home.php">
                            <i class='bx bx-hard-hat'></i>
                            <span class="text nav-text">Proyectos</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="../planos/home.php">
                            <i class='bx bxs-file-archive'></i>
                            <span class="text nav-text">Planos Ejecutivos</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="../bitacoraobra/home.php">
                            <i class='bx bx-cabinet'></i>
                            <span class="text nav-text">Bitácora de obra</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="../estimaciones/home.php">
                            <i class='bx bx-spreadsheet' ></i>
                            <span class="text nav-text">Estimaciones</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="../directorioempleados/home.php">
                            <i class='bx bx-universal-access'></i>
                            <span class="text nav-text">Directorio Empleados</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="../recursos/home.php">
                            <i class='bx bxs-devices'></i>
                            <span class="text nav-text">Recursos</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="../productividad/home.php">
                            <i class='bx bx-chart'></i>
                            <span class="text nav-text">Productividad</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="../finanzas/home.php">
                            <i class='bx bx-money-withdraw'></i>
                            <span class="text nav-text">Finanzas</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="../../logout.php">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Cerrar Sesión</span>
                    </a>
                </li>

            </div>
        </div>
    </nav>


<div class="main-content">
    <header>
        <h1>
            <label for="">
            <span class="las la-bars"></span>
            </label>

            Control de Usuarios
            
        </h1>

        <div class="user-wrapper">
            <img src="../../img/PP.png" width="30px" height="30px" alt="">
            <div>
                <h4><?php echo $_SESSION['nombrecompleto']; ?></h4>
            </div>
        </div>       
    </header>

    <div class="container">
        <div class="title">Actualizar Usuario</div>
        <form id="FormularioRegistro" class action="edituser.php" method="POST">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Email</span>
                    <input type="email" id="email" name="email" required maxlength="40" value="<?php echo $row['email']; ?>" readonly>
                </div>
                <div class="input-box">
                    <span class="details">Contraseña</span>
                    <input type="text" id="password" name="password" required minlength="4" value="<?php echo $row['password']; ?>">
                </div>
                <div class="input-box">
                    <span class="details">Nombre Completo</span>
                    <input type="text" id="nombrecompleto" name="nombrecompleto" value="<?php echo $row['nombrecompleto']; ?>" required maxlength="50">
                </div>
                <div class="input-box">
                    <span class="details">Telefono</span>
                    <input type="text" id="telefono" name="telefono" value="<?php echo $row['telefono']; ?>" required minlength="7" maxlength="10">
                </div>
                <div class="input-box">
                    <span class="details">Puesto</span>
                    <select class="input-group" name="idpuesto">
                    <?php
                        $sql='SELECT * FROM puesto';
                        $query=mysqli_query($conn,$sql);
                        while ($row=mysqli_fetch_array($query)){
                            $idpuesto=$row['idpuesto'];
                            $nombre_puesto=$row['nombre_puesto'];
                    ?>
                    <option value="<?php echo $idpuesto?>"><?php echo $nombre_puesto ?></option>
                    <?php
                    }
                ?>
                </select>
                </div>
                <div class="input-box">
                    <span class="details">Firma</span>
                    <input type="text" id="firma" name="firma" required minlength="2" maxlength="5" value="<?php echo $row['firma']; ?>">
                </div>
                <div class="button">
                <input type="submit" value="Actualizar" class="Editar" name="edituser">
                </div>
            </div>
        </form>
    </div>

</div>

    <script src="script.js"></script>
    


</body>
</html>
<?php 
}else{
     header("Location: ../../login.php");
     exit();
}
 ?>
