<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?></title>
    <link rel="shortcut icon" href="assets/img/favicon.svg" type="image/x-icon">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
</head>

<body class="bg-light">

    <div class="container px-5 my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 shadow-lg bg-light-emphasis p-5 rounded-5">
                <h1 class="text-center mb-5"><?= APP_NAME ?></h1>
                <form action="?ct=main&mt=make_calendar" method="POST" class="mb-5">
                    <div class="mb-4">
                        <label for="month_and_year" class="form-label">Month</label>
                        <input type="month" name="month_and_year" class="form-control" required>
                    </div>
                    <div id="events"></div>
                    <div class="my-5 text-center">
                        <button type="button" id="btn_add_event" class="btn btn-success p-3 w-50">+ Add Event</button>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary p-3 w-50">Generate</button>
                    </div>
                </form>
                <div class="text-center opacity-50">
                    <p>Feito por Getúlio Werle</p>
                </div>
            </div>
        </div>
    </div>

    <!-- bootstrap js -->
    <script src="assets/bootstrap/bootstrap.bundle.min.js"></script>

    <!-- script js -->
    <script src="assets/js/script.js"></script>
</body>

</html>