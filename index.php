<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-10 offset-1">
                <div class="card">
                    <div class="card-header">
                        Fuzzy (Klasifikasi Gender Abalone)
                    </div>
                    <div class="card-body">
                        <form action="FuzzyController.php" method="POST">
                            <div class="mb-3 form-group">
                                <label for="exampleFormControlInput1" class="form-label">Masukan Length</label>
                                <input type="number" class="form-control" name="length" id="exampleFormControlInput1">
                            </div>

                            <div class="mb-3 form-group">
                                <label for="diameter" class="form-label">Masukan Diameter</label>
                                <input type="number" class="form-control" id="diameter" name="diameter">
                            </div>

                            <div class="mb-3 form-group">
                                <label for="tinggi" class="form-label">Masukan tinggi</label>
                                <input type="number" class="form-control" id="tinggi" name="height">
                            </div>

                            <button type="submit" name="prediksi" class="btn btn-primary">Prediksi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>
