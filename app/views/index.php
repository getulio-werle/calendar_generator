<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar Generator</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
</head>

<body class="bg-light">

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-6 shadow-lg bg-light-emphasis p-5 rounded-5">
                <h1 class="text-center mb-5">Calendar Generator</h1>
                <form action="?ct=main&mt=make_calendar" method="POST">
                    <div class="mb-3">
                        <label for="month" class="form-label">Month</label>
                        <input type="month" name="month" class="form-control">
                    </div>
                    <div id="events"></div>
                    <div class="mb-5 text-center">
                        <button type="button" id="btn_add_event" class="btn btn-success">+ Add Event</button>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Generate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- bootstrap js -->
    <script src="assets/bootstrap/bootstrap.bundle.min.js"></script>

    <script>

        var new_event_count = 0;

        // create new inputs to new events
        document.querySelector('#btn_add_event').addEventListener('click', () => {
            new_event_count += 1;
            // create new inputs
            let new_event = document.createElement('div');
            new_event.classList.add('mb-3', 'row');
            new_event.innerHTML = `<p class="form-label">New event</p>
                                   <div class="col-8">
                                        <input type="text" name="new_event_name_${new_event_count}" class="form-control col-6" placeholder="Event name">
                                   </div>
                                   <div class="col-4">
                                        <input type="number" name="new_event_date_${new_event_count}" class="form-control col-6" min="1" max="31" placeholder="Event date">
                                   </div>`;
            document.querySelector('#events').appendChild(new_event);
        }); 
        
    </script>
</body>

</html>