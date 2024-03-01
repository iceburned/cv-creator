<!DOCTYPE html>
<html>
<head>
    <title>Create CV</title>
    <!-- Include necessary CSS and JavaScript files for datepicker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $( function() {
            $( "#datepicker" ).datepicker();
        });

        $(document).ready(function(){
            $('#addUniversity').click(function(){
                $('#universityPopup').show();
            });

            $('#cancelUniversity').click(function(){
                $('#universityPopup').hide();
            });
        });
    </script>
    <style>
        #universityPopup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ccc;
            z-index: 9999;
        }
    </style>
</head>
<body>
<h2>Create CV</h2>
<form id="cvForm" action="{{ route('store.cv') }}" method="POST">
    @csrf
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br><br>
    <label for="middle_name">Middle name:</label>
    <input type="text" id="middle_name" name="middle_name" required><br><br>
    <label for="last_name">Last name:</label>
    <input type="text" id="last_name" name="last_name" required><br><br>
    <label for="birth_date">Date of Birth:</label>
    <input type="text" id="datepicker" name="birth_date" required><br><br>
    <label for="university">University:</label>
    <select id="university" name="university" required>
        <option value="">Select University</option>
        @foreach($universities as $university)
            <option value="{{ $university->id }}">{{ $university->name }}</option>
        @endforeach
        <!-- Add option for adding new university -->
        <option value="new">Add New University</option>
    </select>
    <button type="button" id="addUniversity">Add University</button><br><br>

    <!-- University Popup -->
    <div id="universityPopup">
        <label for="newUniversityName">University Name:</label>
        <input type="text" id="newUniversityName" name="newUniversityName" required><br><br>
        <label for="newUniversityScore">University Score:</label>
        <input type="text" id="newUniversityScore" name="newUniversityScore" required><br><br>
        <button type="button" id="cancelUniversity">Cancel</button>
        <button type="submit" id="submitUniversity">Submit</button>
    </div>
    <!-- End University Popup -->

    <label for="score">Score:</label>
    <input type="text" id="score" name="score" required><br><br>
    <label for="skills">Skills:</label>
    <input type="text" id="skills" name="skills" required><br><br>
    <button type="submit">Submit CV</button>
</form>
</body>
</html>
