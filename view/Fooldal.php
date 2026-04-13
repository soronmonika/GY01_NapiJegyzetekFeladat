<!DOCTYPE html>
<html lang="hu">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Napi feladatok/teendők</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
  <?php include_once("base/navbar.html") ?>

  <div class="container my-4">
    <div class="row align-items-stretch">
      <div class="col-lg-6 d-flex justify-content-end gap-2">
        <div id="NapiFeladatok">
          <h1>Napi feladatok/teendők</h1>

          <?php if (!empty($ErrorUzenet)): ?>
            <div class="alert alert-danger container mt-3"><?= htmlspecialchars($ErrorUzenet) ?></div>
          <?php endif; ?>

          <?php if (!empty($SuccessUzenet)): ?>
            <div class="alert alert-success container mt-3"><?= htmlspecialchars($SuccessUzenet) ?></div>
          <?php endif; ?>


          <form action="../controller/controller.php" method="post">
            <input type="hidden" name="felvitel" value="TeendokFelvitel">

            <input type="text" name="name" placeholder="Napi feladat" required>
            <input type="date" name="datum" required>

            <button type="submit" name="mentes" value="mentes" class="btn btn-primary">Mentés</button>
          </form>
        </div>
      </div>


      <div class="col-12">

        <div class="col-md-6">
          <div class="card dashboard-card stat-card stat-income mb-3 text-center">
            <div class="card-body">
              <h5>Összes feladat</h5>
              <p class="stat-value" id="OsszesFeladat">0 db</p>
            </div>
          </div>

          <div class="card dashboard-card stat-card stat-income mb-3 text-center">
            <div class="card-body">
              <h5>Kész feladat</h5>
              <p class="stat-value" id="OsszesKesz">0 db</p>
            </div>
          </div>
        </div>


        <h2>Teendő lista</h2>
        <table class="table table-striped my-4 table-hover">
          <thead class="table-primary">
            <tr>
              <th>Név</th>
              <th>Dátum</th>
              <th>Kész</th>
            </tr>
          </thead>
          <tbody id="Torzs"></tbody>

      </div>



    </div>
    <?php include_once("base/footer.html") ?>
    <script>
      console.log("HTML fut")
    </script>
    <script src="JavaScript/script.js"></script>
</body>

</html>
