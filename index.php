<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hit Url Rapidly</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/4114/4114642.png" type="image/x-icon">
</head>

<body>
    <style>
        /* google font */
        @import url('https://fonts.googleapis.com/css2?family=Alegreya+Sans:wght@800&display=swap');

        /* width */
        ::-webkit-scrollbar {
            width: 4px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 25px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .response {
            height: 300px;
            overflow: auto;
            border-left: 5px solid green;
            padding-left: 5px;
            background: #E7E9EB;
            color: black;
            font-size: 14px;
        }
    </style>

    <form class="form">
        <div class="card">
            <div class="card-header text-center">
                Hit Url Rapidly
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-lg-3 mt-3">
                        <label class="mb-1">Enter Url</label>
                        <input required type="url" name="url" id="url" class="form-control" value="http://localhost/auto/request.php">
                    </div>
                    <div class="col-lg-3 mt-3">
                        <label class="mb-1">Execute in every second (1s = 1000)</label>
                        <input required type="number" name="interval" id="interval" class="form-control" value="1000">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-6 mt-3">
                        <button type="submit" class="btn btn-danger btn-sm" id="hit_btn">Execute</button>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Response (<span class="response_count">0</span>)
                </div>
                <div class="card-body">
                    <p class="executing">The response is printed below. </p>
                    <div class="response"></div>
                </div>
            </div>
        </div>
    </form>
    <input type="hidden" name="status" class="status" value="2">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('.form').on('submit', function(e) {
            $(".executing").text('Executing.....');
            $(".status").val(2);
            $('#hit_btn').prop('disabled', true);
            e.preventDefault();
            var url = $("#url").val();
            var interval = $("#interval").val();

            var st = setInterval(function() {
                var status = $(".status").val();

                if (status == 0) {
                    clearInterval(st);
                } else {
                    // execute function
                    execute(url);
                    $(".response_count").text(parseInt($(".response_count").text()) + 1);
                }
            }, interval);


        });



        function execute(url = '') {
            $.ajax({
                type: "POST",
                url: url,
                dataType: "json",
                success: function(response) {
                    if (response.status == "success") {
                        $('.response').prepend("<br>" + JSON.stringify(response));
                        $(".status").val(1);
                    } else {
                        $('#hit_btn').prop('disabled', false);
                        $('.response').prepend("<br>" + JSON.stringify(response));
                        $(".status").val(0);
                    }

                },
                error: function() {
                    alert('Error');
                }
            });
        }
    </script>

    <!--
         author : Dip sarkar
         Created at: 25.09.22
         Desc: this tool is used to hit url rapidly. which can act same like cron job.
         but when we test application in local env then we can use this tool as cron job.
    -->
</body>

</html>