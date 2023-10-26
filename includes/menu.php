<div class="menu-container">
    <form action="dashboard.php" method="get" id="filter-form">
        <label for="sort">Ordenar por:</label>
        <select id="sort" name="sort" onchange="this.form.submit()">
            <option value="nombre" <?php if (isset($_GET['sort']) && $_GET['sort'] === 'nombre')
                echo 'selected'; ?>>
                Nombre</option>
            <option value="apellido" <?php if (isset($_GET['sort']) && $_GET['sort'] === 'apellido')
                echo 'selected'; ?>>
                Apellido</option>
            <option value="fecha_creacion" <?php if (isset($_GET['sort']) && $_GET['sort'] === 'fecha_creacion')
                echo 'selected'; ?>>Fecha</option>
        </select>

        <label for="from-date">Desde:</label>
        <input type="date" id="from-date" name="from-date" value="<?php echo $fromDate; ?>">
        <label for="to-date">Hasta:</label>
        <input type="date" id="to-date" name="to-date" value="<?php echo $toDate; ?>">
        <button type="submit" id="filter-button">Filtrar</button>
    </form>
    <a href="../includes/generar_pdf.php?download=1" class="pdf-link" target="_blank" download>
        <button class="btn">
            <i class="fas fa-file-download"></i> Descargar PDF
        </button>
    </a>
</div>