<?php
ob_start();

require "./conexion.php";
require "./funciones.php";

$conn = ConexionBD();
$query = "SELECT * FROM producto";
$resultados = mysqli_query($conn,$query);

if($_SERVER["REQUEST_METHOD"]==="POST"){
    $eliminado_id = $_POST["id"];
    $query_eliminar = "DELETE FROM Producto WHERE id_prod=${eliminado_id}";
    mysqli_query($conn,$query_eliminar);
    header("Location: ./productos.php");
}

?>
<div class="contenedor-productos">
    <div class="productos-agregar">
        <a href="./agregarproductos.php">Agregar</a>
    </div>
    <div class="contenedor-tabla">
        <table class="tabla-productos">
            <tr>
                <th class="borde">ID</th>
                <th class="borde">NOMBRE</th>
                <th class="borde">CANTIDAD</th>
                <th class="borde">PRECIO</th>
                <th class="borde">FECHA VENCIMIENTO</th>
                <th></th>
                <th></th>
            </tr>
            <?php
            if($resultados->num_rows>0){
            ?>
                <?php while($row = mysqli_fetch_assoc($resultados)){ ?>
                    <tr><td class='borde'><?php echo $row["id_prod"]?></td>;
                    <td class='borde'><?php echo $row["nom_prod"]?></td>;
                    <td class='borde'><?php echo $row["cantidad"]?></td>;
                    <td class='borde'><?php echo $row["precio"]?></td>;
                    <td class='borde'><?php echo $row["fecha_vencimiento"]?></td>;
                    <td><a href="./actualizarproductos.php?id=<?php echo $row["id_prod"];?>"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" />
                    <line x1="13.5" y1="6.5" x2="17.5" y2="10.5" />
                  </svg></a></td>
                    <td>
                        <form action="" method="POST">
                            <input type="hidden" name="id" value="<?php echo $row["id_prod"]?>">
                            <input type="submit" value="" class="basura">
                        </form>
                    </td>
                    </tr>;
                <?php } ?>
            <?php } ?>
        </table>
    </div>
</div>
<?php
$contenido = ob_get_clean();
require "./includes/layout_principal.php";
?>