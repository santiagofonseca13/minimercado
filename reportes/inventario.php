<?php
session_start();
include("../conexion.php");

if(!isset($_SESSION['usuario'])){
    header("Location: ../index.php");
}

$resultado = $conexion->query("SELECT * FROM productos");

$totales = $conexion->query("
    SELECT 
        COUNT(*) AS total_productos,
        COALESCE(SUM(stock), 0) AS total_unidades,
        COALESCE(SUM(precio * stock), 0) AS valor_total,
        COALESCE(SUM(CASE WHEN stock <= 10 THEN 1 ELSE 0 END), 0) AS productos_bajo_stock
    FROM productos
")->fetch_assoc();

$mostrar_reporte = isset($_GET['reporte']) && $_GET['reporte'] == '1';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inventario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: #f4f6f9; }
        .card { border-radius: 15px; }
        .bajo-stock { background-color: #ffe5e5; }
        .search-box { max-width: 300px; }
        .resumen-card {
            border: 0;
            box-shadow: 0 6px 18px rgba(0,0,0,.08);
            border-radius: 16px;
        }
        @media print {
            .no-print { display: none !important; }
            body { background: white; }
            .card { box-shadow: none; }
        }
    </style>

    <script>
        function buscarProducto() {
            let input = document.getElementById("buscar").value.toLowerCase();
            let filas = document.querySelectorAll("tbody tr");

            filas.forEach(fila => {
                let texto = fila.innerText.toLowerCase();
                fila.style.display = texto.includes(input) ? "" : "none";
            });
        }
    </script>
</head>

<body>

<nav class="navbar navbar-dark bg-dark no-print">
    <div class="container-fluid">
        <span class="navbar-brand">Mini Mercado</span>
        <span class="text-white">👤 <?php echo $_SESSION['usuario']; ?></span>
    </div>
</nav>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-3 no-print">
        <h2>📦 Inventario</h2>

        <div class="d-flex gap-2">
            <a href="inventario.php?reporte=1" class="btn btn-primary">
                📄 Generar reporte
            </a>
            <button onclick="window.print()" class="btn btn-dark">
                🖨️ Imprimir
            </button>
        </div>
    </div>

    <?php if($mostrar_reporte){ ?>
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card resumen-card p-3">
                <h6 class="text-muted">Total productos</h6>
                <h3><?php echo $totales['total_productos']; ?></h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card resumen-card p-3">
                <h6 class="text-muted">Total unidades</h6>
                <h3><?php echo $totales['total_unidades']; ?></h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card resumen-card p-3">
                <h6 class="text-muted">Stock bajo</h6>
                <h3><?php echo $totales['productos_bajo_stock']; ?></h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card resumen-card p-3">
                <h6 class="text-muted">Valor inventario</h6>
                <h3>$<?php echo number_format($totales['valor_total'], 2); ?></h3>
            </div>
        </div>
    </div>
    <?php } ?>

    <div class="d-flex justify-content-between align-items-center mb-3 no-print">
        <input type="text" id="buscar" onkeyup="buscarProducto()"
               class="form-control search-box" placeholder="Buscar producto...">
        <a href="../dashboard.php" class="btn btn-secondary ms-2">⬅ Volver</a>
    </div>

    <div class="card shadow p-3">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Producto</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Estado</th>
                </tr>
            </thead>

            <tbody>
            <?php while($row = $resultado->fetch_assoc()) { 
                $bajo = $row['stock'] <= 10;
            ?>
                <tr class="<?php echo $bajo ? 'bajo-stock' : ''; ?>">
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['descripcion']; ?></td>
                    <td>$<?php echo number_format($row['precio'], 2); ?></td>
                    <td><?php echo $row['stock']; ?></td>
                    <td>
                        <?php if($bajo){ ?>
                            <span class="badge bg-danger">Stock Bajo</span>
                        <?php } else { ?>
                            <span class="badge bg-success">Disponible</span>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>