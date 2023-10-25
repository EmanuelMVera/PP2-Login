<div class="menu-container">
    <form action="dashboard.php" method="get" id="filter-form">
        <label for="sort">Ordenar por:</label>
        <select id="sort" name="sort">
            <option value="nombre">Nombre</option>
            <option value="apellido">Apellido</option>
            <option value="fecha_creacion">Fecha</option>
        </select>
        <label for="from-date">Desde:</label>
        <input type="date" id="from-date" name="from-date" value="">
        <label for="to-date">Hasta:</label>
        <input type="date" id="to-date" name="to-date" value="">
        <button type="submit" id="filter-button">Filtrar</button>
    </form>
    <a href="../includes/generar_pdf.php?download=1" class="pdf-link" target="_blank" download>
        <button class="btn">
            <i class="fas fa-file-download"></i> Descargar PDF
        </button>
    </a>

</div>

<script>
    const filterButton = document.getElementById("filter-button");

    // Verifica si hay fechas establecidas antes de aplicar el filtro
    filterButton.addEventListener("click", () => {
        const sort = document.getElementById("sort").value;
        const from_date = document.getElementById("from-date").value;
        const to_date = document.getElementById("to-date").value;

        if (from_date.trim() === "" || to_date.trim() === "") {
            // Si falta alguna fecha, establece un valor por defecto para mostrar todos los usuarios
            const today = new Date().toISOString().substr(0, 10);
            document.getElementById("from-date").value = "1970-01-01";
            document.getElementById("to-date").value = today;
        }
    });

</script>