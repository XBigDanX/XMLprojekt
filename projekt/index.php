<?php

// Numeriranje žanrova
$genres = [
    28 => 'Action',
    12 => 'Adventure',
    16 => 'Animation',
    35 => 'Comedy',
    80 => 'Crime',
    99 => 'Documentary',
    18 => 'Drama',
    10751 => 'Family',
    14 => 'Fantasy',
    36 => 'History',
    27 => 'Horror',
    10402 => 'Music',
    9648 => 'Mystery',
    10749 => 'Romance',
    878 => 'Science Fiction',
    10770 => 'TV Movie',
    53 => 'Thriller',
    10752 => 'War',
    37 => 'Western',
];


//funkcija za povlacenje api podataka sa TMDB stranice
function fetchDataFromAPI($url) {
    $api_key = 'bab254156285f3fac16ddfb171652272';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url . '?api_key=' . $api_key);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response, true);
}

// povlaci prvih 20 filmova sa podstranice "popularno"
$url = 'https://api.themoviedb.org/3/movie/popular'; 
$data = fetchDataFromAPI($url);
$movies = array_slice($data['results'], 0, 20);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineScope</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">CineScope</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Početna</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="about.html">O nama</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h2>Dobrodošli na CineScope</h2>
            </div>
        </div>
        <p class="lead">Ne znate što biste gledali od filmova? Dosadili su vam isti naslovi? Ne brinite, došli ste na pravo mjesto! CineScope vam donosi najnovije i najpopularnije filmove dostupne sada. Naša kolekcija obuhvaća širok spektar žanrova i stvarno je za svakoga ponešto. Pregledajte našu selekciju i pronađite savršen film za večerašnje uživanje.</p>
    </div>

    <div class="container mt-4">
        <div class="row row-cols-1 row-cols-md-2 g-4">

            <?php foreach ($movies as $movie) : ?>
                <div class="col">
                    <div class="card h-100">
                        <!-- Slika -->
                        <a href="https://www.themoviedb.org/movie/<?= $movie['id'] ?>">
                            <img src="https://image.tmdb.org/t/p/original<?= $movie['backdrop_path'] ?>" class="card-img-top" alt="Backdrop Image">
                        </a>
                        <div class="card-body">
                            <!-- Naslov -->
                            <h5 class="card-title d-flex justify-content-between align-items-center">
                                <a href="https://www.themoviedb.org/movie/<?= $movie['id'] ?>" class="text-dark"><?= $movie['title'] ?></a>
                                <a href="https://www.themoviedb.org/movie/<?= $movie['id'] ?>"><i class="fas fa-info-circle"></i></a>
                            </h5>
                            <!-- Žanrovi -->
                            <?php foreach ($movie['genre_ids'] as $genre_id) : ?>
                                    <span class="badge bg-secondary"><?= $genres[$genre_id] ?></span>
                                <?php endforeach; ?>
                            <!-- Opis -->
                            <p class="card-text"><?= $movie['overview'] ?></p>
                            <div class="mt-3">
                                <!-- Izdanje -->
                                <p class="card-text">Release Date: <?= $movie['release_date'] ?></p>
                                
                                <!-- Ocjene -->
                                <div><strong>Rating:</strong> <?= $movie['vote_average'] ?>/10</div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            
        </div>
    </div>

     <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
          <p> Danijel Lozić © XML projekt 2024 <p>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>
