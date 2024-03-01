<!DOCTYPE html>
<html>
<head>
    <title>Retrieve CVs</title>
</head>
<body>
<h2>Retrieve CVs</h2>
<label for="fromDate">From:</label>
<input type="text" id="fromDate" name="fromDate" class="datepicker" required><br><br>
<label for="toDate">To:</label>
<input type="text" id="toDate" name="toDate" class="datepicker" required><br><br>
<button id="retrieveBtn">Retrieve</button>
<table id="cvTable">
    <thead>
    <tr>
        <th>Name</th>
        <th>Date of Birth</th>
        <th>University</th>
        <th>Skills</th>
        <th>Score</th>
    </tr>
    </thead>
    <tbody id="cvData">
    <!-- CV data will be populated here -->
    </tbody>
</table>

<!-- Include necessary JavaScript files for datepicker and Axios -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.24.0/axios.min.js"></script>
<script>
    $( function() {
        $( ".datepicker" ).datepicker();
    });

    $(document).ready(function() {
        $('#retrieveBtn').click(function() {
            var fromDate = $('#fromDate').val();
            var toDate = $('#toDate').val();
            axios.get('/retrieve-cvs', {
                params: {
                    fromDate: fromDate,
                    toDate: toDate
                }
            })
                .then(function(response) {
                    $('#cvData').empty();
                    $.each(response.data, function(index, cv) {
                        $('#cvData').append('<tr>' +
                            '<td>' + cv.name + '</td>' +
                            '<td>' + cv.dob + '</td>' +
                            '<td>' + cv.university + '</td>' +
                            '<td>' + cv.skills + '</td>' +
                            '<td>' + cv.score + '</td>' +
                            '</tr>');
                    });
                })
                .catch(function(error) {
                    console.log(error);
                });
        });
    });
</script>
</body>
</html>
