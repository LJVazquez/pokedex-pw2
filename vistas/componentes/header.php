<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body class="bg-light">
    <nav class="navbar bg-danger">
        <div class="container-fluid">
            <a class="navbar-brand" href="./index.php"><img src="../img/pokeball.gif" alt="pokedex" height="30"></a>
            <div class="d-flex">
                <button type="button" class="btn btn-outline-light me-3" data-bs-toggle="modal" data-bs-target="#modal-login">
                    Login
                </button>
                <form class="d-flex" role="search" method="GET" action="./search.php">
                    <input name="searchParam" class="form-control me-2 rounded-0 bg-danger text-white placeholder-white" type="search" placeholder="Buscar" value="<?= isset($_GET['searchParam']) ? $_GET['searchParam'] : "" ?>">
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid mt-3">
        <div class="text-end p-0"><a class="btn btn-outline-danger me-3 rounded-0" href="./create.php">Agregar pokemon</a></div>
        <div class="container mt-2">
            <a class="d-flex align-items-center justify-content-center mb-5 text-decoration-none" href="./index.php">
                <img src="../img/pokedex.gif" alt="pokedex" class="pokedex-img me-4">
                <h1 class="pixel-font text-danger">POKEDEX</h1>
            </a>
        </div>
    </div>