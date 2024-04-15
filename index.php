<?php

$hotels = [

  [
    'name' => 'Hotel Belvedere',
    'description' => 'Hotel Belvedere Descrizione',
    'parking' => true,
    'vote' => 4,
    'distance_to_center' => 10.4
  ],
  [
    'name' => 'Hotel Futuro',
    'description' => 'Hotel Futuro Descrizione',
    'parking' => true,
    'vote' => 2,
    'distance_to_center' => 2
  ],
  [
    'name' => 'Hotel Rivamare',
    'description' => 'Hotel Rivamare Descrizione',
    'parking' => false,
    'vote' => 1,
    'distance_to_center' => 1
  ],
  [
    'name' => 'Hotel Bellavista',
    'description' => 'Hotel Bellavista Descrizione',
    'parking' => false,
    'vote' => 5,
    'distance_to_center' => 5.5
  ],
  [
    'name' => 'Hotel Milano',
    'description' => 'Hotel Milano Descrizione',
    'parking' => true,
    'vote' => 2,
    'distance_to_center' => 50
  ],

];

// Filtra gli hotel in base alla richiesta GET, se presente
$filtroParcheggio = isset($_GET['parking']);
$filtroVoti = isset($_GET['vote']) ? (int)$_GET['vote'] : null;

if ($filtroParcheggio || $filtroVoti !== null) {
  $hotels = array_filter($hotels, function ($hotel) use ($filtroParcheggio, $filtroVoti) {
    $parkingCondition = $filtroParcheggio ? $hotel['parking'] : true;
    $voteCondition = $filtroVoti ? $hotel['vote'] >= $filtroVoti : true;
    return $parkingCondition && $voteCondition;
  });
}
?>

<!DOCTYPE html>

<html lang="it">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Hotel</title>
  <!-- Includi Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
  <div class="container mt-4">
    <!-- Form per filtrare gli hotel -->
    <form method="GET" class="mb-3">
      <div class="form-group">
        <div class="form-check">
          <input type="checkbox" class="form-check-input" name="parking" id="parking" <?php if ($filtroParcheggio) echo 'checked'; ?>>
          <label class="form-check-label" for="parking">Solo con parcheggio</label>
        </div>
      </div>


      <!-- Questo form permette di filtrare gli hotel in base alla presenza di parcheggio e al voto minimo. Selezionando "Solo con parcheggio" verranno mostrati solo gli hotel con parcheggio. Selezionando un voto minimo verranno mostrati solo gli hotel con un voto maggiore o uguale a quello selezionato.  -->

      <div class="form-group">
        <label for="vote">Voto minimo:</label>
        <select class="form-control" name="vote" id="vote">
          <option value="">Qualsiasi</option>
          <option value="1" <?php if ($filtroVoti === 1) echo 'selected'; ?>>1</option>
          <option value="2" <?php if ($filtroVoti === 2) echo 'selected'; ?>>2</option>
          <option value="3" <?php if ($filtroVoti === 3) echo 'selected'; ?>>3</option>
          <option value="4" <?php if ($filtroVoti === 4) echo 'selected'; ?>>4</option>
          <option value="5" <?php if ($filtroVoti === 5) echo 'selected'; ?>>5</option>
        </select>
      </div>

      <button type="submit" class="btn btn-primary btn-bg-danger">Filtra</button>
    </form>

    <!-- Visualizzazione degli hotel -->

    <div class="row">
      <?php foreach ($hotels as $hotel) : ?>
        <div class="col-md-4">
          <div class="card mb-4">
            <div class="card-body">
              <h5 class="card-title"><?php echo $hotel['name']; ?></h5>
              <p class="card-text"><?php echo $hotel['description']; ?></p>
              <ul class="list-unstyled">
                <li>Parcheggio: <?php echo $hotel['parking'] ? 'Sì' : 'No'; ?></li>
                <li>Voto: <?php echo $hotel['vote']; ?></li>
                <li>Distanza dal centro: <?php echo $hotel['distance_to_center']; ?> km</li>
              </ul>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

</body>

</html>