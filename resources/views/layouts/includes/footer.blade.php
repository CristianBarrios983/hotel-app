<!-- resources/views/layouts/includes/footer.blade.php -->
<!-- <footer class="bg-dark text-center text-lg-start">
    <div class="text-center p-3 text-white">
        © 2024 Hotel App
        <a class="text-white" href="#"></a>
    </div>
</footer> -->

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>


<script> 
    let table = new DataTable('#myTable', {
        language: {
        search: "Buscar:",
        lengthMenu: "Mostrar _MENU_ registros por página",
        zeroRecords: "No se encontraron resultados",
        info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
        infoEmpty: "No hay registros disponibles",
        infoFiltered: "(filtrado de _MAX_ registros en total)",
        paginate: {
            first: "Primero",
            last: "Último",
            next: "Siguiente",
            previous: "Anterior"
        },
    },
    });
</script>

<!-- Dark Mode -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const darkModeToggle = document.getElementById('darkModeToggle');
    const icon = document.getElementById('icon');
    const body = document.body;
  
    darkModeToggle.addEventListener('change', function () {
      if (darkModeToggle.checked) {
        body.setAttribute('data-bs-theme', 'dark');
        icon.classList.remove('bi','bi-moon-fill');
        icon.classList.add('bi','bi-sun-fill'); // Cambia la clase del icono al modo oscuro
        // Guarda el modo oscuro en el localStorage
        localStorage.setItem('mode', 'dark');
      } else {
        body.setAttribute('data-bs-theme', 'light');
        icon.classList.remove('bi','bi-sun-fill');
        icon.classList.add('bi','bi-moon-fill'); // Cambia la clase del icono al modo claro
        // Guarda el modo claro en el localStorage
        localStorage.setItem('mode', 'light');
      }
    });

    if(localStorage.getItem('mode') === 'dark'){
      darkModeToggle.checked = true;
      body.setAttribute('data-bs-theme', 'dark');
      icon.classList.add('bi','bi-sun-fill');
    }else{
      body.setAttribute('data-bs-theme', 'light');
      icon.classList.add('bi','bi-moon-fill');
    }
});
  
</script>

