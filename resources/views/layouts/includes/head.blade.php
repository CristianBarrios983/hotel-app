<!-- resources/views/layouts/includes/head.blade.php -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<title>{{ config('app.name', 'Laravel') }}</title>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />

<!-- Importar la fuente Funnel Sans -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Funnel+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    
<style>
    /* Aplicar Funnel Sans globalmente */
    body {
        font-family: "Funnel Sans", sans-serif;
        font-weight: 400; /* Peso normal */
    }

    /* Personalización */
    .light {
        font-weight: 300; /* Ligero */
    }

    .bold {
        font-weight: 700; /* Negrita */
    }

    .italic {
        font-style: italic; /* Cursiva */
    }
</style>
