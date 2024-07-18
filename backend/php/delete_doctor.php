<?php
require_once('../../backend/bd/Conexion.php');

if (isset($_POST['delete_patients'])) {
    $idodc = trim($_POST['idodc']);

    // Validación de campo vacío
    if (empty($idodc)) {
        echo '<script type="text/javascript">
        swal({
          icon: "error",
          title: "Error",
          text: "ID no puede estar vacío.",
        }).then(function() {
            window.location = "mostrar.php";
        });
        </script>';
        exit;
    }

    try {
        $consulta = "DELETE FROM doctor WHERE idodc = :idodc";
        $sql = $connect->prepare($consulta);
        $sql->bindParam(':idodc', $idodc, PDO::PARAM_INT);

        $sql->execute();

        if ($sql->rowCount() > 0) {
            echo '<script type="text/javascript">
            swal({
              icon: "success",
              title: "Eliminado",
              text: "Eliminado correctamente!",
            }).then(function() {
                window.location = "mostrar.php";
            });
            </script>';
        } else {
            echo '<script type="text/javascript">
            swal({
              icon: "error",
              title: "Error",
              text: "No se pudo eliminar el registro.",
            }).then(function() {
                window.location = "mostrar.php";
            });
            </script>';
        }

    } catch (PDOException $e) {
        echo '<script type="text/javascript">
        swal({
          icon: "error",
          title: "Error",
          text: "Error: ' . $e->getMessage() . '",
        }).then(function() {
            window.location = "mostrar.php";
        });
        </script>';
    }
}
?>
