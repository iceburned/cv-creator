<!DOCTYPE html>
<html>
<head>
    <title>Retrieve CVs</title>
</head>

<body>
<h2>Retrieve CVs</h2>
<label for="fromDate">From:</label>
<input type="text" id="fromDate" name="fromDate" class="datepicker" required>
<label for="toDate">To:</label>
<input type="text" id="toDate" name="toDate" class="datepicker"
       required><br><br><br><br><br><br><br><br><br><br><br><br>
<button id="retrieveBtn">Retrieve</button>
<table id="cvTable">
    <thead>
    <tr>
        <th>Name</th>
        <th>Date of Birth</th>
        <th>University</th>
        <th>Skills</th>
        <th>Accreditation</th>
    </tr>
    </thead>
    <tbody id="cvData">
    </tbody>
</table>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.24.0/axios.min.js"></script>
<script>
    $(function () {
        $(".datepicker").datepicker();
    });

    $(document).ready(function () {
        $('#retrieveBtn').click(function () {
            var fromDate = $('#fromDate').val();
            var toDate = $('#toDate').val();
            axios.get('/retrieve-cvs', {
                params: {
                    fromDate: fromDate,
                    toDate: toDate
                }
            })
                .then(function (response) {
                    $('#cvData').empty();
                    $.each(response.data, function (index, cv) {
                        let skillsNames = cv.skills.map(skill => skill.name).join(', ');
                        $.each(response.data, function (index, cv) {
                            $('#cvData').append('<tr>' +
                                '<td>' + cv.user.name + '</td>' +
                                '<td>' + cv.user.birth_date + '</td>' +
                                '<td>' + cv.university.name + '</td>' +
                                '<td>' + skillsNames + '</td>' +
                                '<td>' + cv.university.accreditation + '</td>' +
                                '</tr>');
                        });
                    })
                        .catch(function (error) {
                            console.log(error);
                        });
                })
        });
    });

</script>
</body>
</html>
