<!DOCTYPE html>
<html>
<head>
    <title>Create CV</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>

        $(function () {
            $("#datepicker").datepicker();
            // fetchSkills(); // Fetch skills when the page loads
        });

        // Function to fetch skills from the server
        {{--function fetchSkills() {--}}
        {{--    $.ajax({--}}
        {{--        url: "{{ route('get.skills') }}",--}}
        {{--        type: "GET",--}}
        {{--        success: function(skills) {--}}
        {{--            var skillSelect = $('#skills');--}}
        {{--            skillSelect.empty(); // Clear existing options--}}
        {{--            $.each(skills, function(index, skill) {--}}
        {{--                skillSelect.append('<option value="' + skill.id + '">' + skill.name + '</option>');--}}
        {{--            });--}}
        {{--            // Initialize multiselect dropdown--}}
        {{--            skillSelect.multiselect({--}}
        {{--                nonSelectedText: 'Select Skills',--}}
        {{--                enableFiltering: true,--}}
        {{--                enableCaseInsensitiveFiltering: true,--}}
        {{--                buttonWidth: '100%'--}}
        {{--            });--}}
        {{--        },--}}
        {{--        error: function(xhr, status, error) {--}}
        {{--            console.error(xhr.responseText);--}}
        {{--        }--}}
        {{--    });--}}
        {{--}--}}

        $(document).ready(function () {
            $('#addSkill').click(function () {
                $('#skillPopup').show();
            });

            $('#cancelSkill').click(function () {
                $('#skillPopup').hide();
            });

            $('#submitSkill').click(function () {
                if ($('#skillPopup').is(':visible')) {
                    var newSkill = $('#newSkill').val();

                    // AJAX request to add a new skill
                    $.ajax({
                        url: "{{ route('store.skill') }}",
                        type: "POST",
                        data: {
                            skill_name: newSkill,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {

                            console.log(response);
                            // If the skill was added successfully, fetch skills again to update the dropdown
                            // fetchSkills();
                            $('#skillPopup').hide();
                            $('#newSkill').val('');

                            $.ajax({
                                url: "{{ route('get.skills') }}",
                                type: "GET",
                                success: function (skills) {
                                    $('#skill').empty();
                                    $.each(skills, function (index, skill) {
                                        $('#skill').append('<option value="' + skill.id + '">' + skill.name + '</option>');
                                    });
                                },
                                error: function (xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            });

                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        });

        $(function () {
            $("#datepicker").datepicker();
        });

        $(document).ready(function () {
            $('#addUniversity').click(function () {
                $('#universityPopup').show();
            });

            $('#cancelUniversity').click(function () {
                $('#universityPopup').hide();
            });

            $('#submitUniversity').click(function () {
                if ($('#universityPopup').is(':visible')) {
                    // Get data from input fields
                    var universityName = $('#newUniversityName').val();
                    var universityScore = $('#newUniversityScore').val();

                    // AJAX request
                    $.ajax({
                        url: "{{ route('university.store') }}",
                        type: "POST",
                        data: {
                            university_name: universityName,
                            university_score: universityScore,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {

                            console.log(response);

                            $('#universityPopup').hide();
                            $('#newUniversityName').val('');
                            $('#newUniversityScore').val('');


                            $.ajax({
                                url: "{{ route('get.universities') }}",
                                type: "GET",
                                success: function (universities) {
                                    $('#university').empty();
                                    $.each(universities, function (index, university) {
                                        $('#university').append('<option value="' + university.id + '">' + university.name + '</option>');
                                    });
                                },
                                error: function (xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            });
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
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
    <style>
        #skillPopup {
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
    <input type="text" id="name" name="name"><br><br>
    <label for="middle_name">Middle name:</label>
    <input type="text" id="middle_name" name="middle_name"><br><br>
    <label for="last_name">Last name:</label>
    <input type="text" id="last_name" name="last_name"><br><br>
    <label for="birth_date">Date of Birth:</label>
    <input type="text" id="datepicker" name="birth_date"><br><br>
    <label for="university">University:</label>
    <select id="university" name="university">
        <option value="">Select University</option>
        @foreach($universities as $university)
            <option value="{{ $university->id }}">{{ $university->name }}</option>
        @endforeach
    </select>
    <button type="button" id="addUniversity">Add University</button>
    <br><br>

    <!-- University Popup -->
    <div id="universityPopup">
        <label for="newUniversityName">University Name:</label>
        <input type="text" id="newUniversityName" name="newUniversityName"><br><br>
        <label for="newUniversityScore">University Score:</label>
        <input type="text" id="newUniversityScore" name="newUniversityScore"><br><br>
        <button type="button" id="cancelUniversity">Cancel</button>
        <button type="button" id="submitUniversity">Submit</button>
    </div>
    <!-- End University Popup -->

    <!-- Other form fields -->
    <label for="skills">Skills:</label>
    <select id="skills" name="skills[]" multiple>
        <option value="">Select skill</option>
        @foreach($skills as $skill)
            <option value="{{ $skill->id }}">{{ $skill->name }}</option>
        @endforeach
    </select>
        <button type="button" id="addSkill">Add Skill</button><br><br>

    <!-- Skill Popup -->
    <div id="skillPopup">
        <label for="newSkill">New Skill:</label>
        <input type="text" id="newSkill" name="newSkill"><br><br>
        <button type="button" id="cancelSkill">Cancel</button>
        <button type="button" id="submitSkill">Submit</button>
    </div>

    <!-- End Skill Popup -->


    <button type="submit">Submit CV</button>
</form>
</body>
</html>
