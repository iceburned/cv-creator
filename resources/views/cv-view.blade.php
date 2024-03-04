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
        });

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

                    $.ajax({
                        url: "{{ route('store.skill') }}",
                        type: "POST",
                        data: {
                            skill_name: newSkill,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {

                            console.log(response);
                            $('#skillPopup').hide();
                            $('#newSkill').val('');

                            $.ajax({
                                url: "{{ route('get.skills') }}",
                                type: "GET",
                                success: function (skills) {
                                    var skillSelect = $('#skills');
                                    skillSelect.empty();
                                    $.each(skills, function (index, skill) {
                                        skillSelect.append('<option value="' + skill.id + '">' + skill.name + '</option>');
                                    });

                                    skillSelect.multiselect({
                                        nonSelectedText: 'Select Skills',
                                        enableFiltering: true,
                                        enableCaseInsensitiveFiltering: true,
                                        buttonWidth: '100%'
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
                    var universityName = $('#newUniversityName').val();
                    var accreditation = $('#newAccreditation').val();
                    var name = $('#name').val();
                    var middle_name = $('#middle_name').val();
                    var last_name = $('#last_name').val();
                    var datepicker = $('#datepicker').val();

                    $.ajax({
                        url: "{{ route('university.store') }}",
                        type: "POST",
                        data: {
                            university_name: universityName,
                            accreditation: accreditation,
                            user_name: name,
                            middle_name: middle_name,
                            last_name: last_name,
                            datepicker: datepicker,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {

                            console.log(response);

                            $('#universityPopup').hide();
                            $('#newUniversityName').val('');
                            $('#newAccreditation').val('');


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

    <div id="universityPopup">
        <label for="newUniversityName">University Name:</label>
        <input type="text" id="newUniversityName" name="newUniversityName"><br><br>
        <label for="newAccreditation">University Accreditation:</label>
        <input type="text" id="newAccreditation" name="newAccreditation"><br><br>
        <button type="button" id="cancelUniversity">Cancel</button>
        <button type="button" id="submitUniversity">Submit</button>
    </div>

    <label for="skills">Skills:</label>
    <select id="skills" name="skills[]" multiple>
        <option value="">Select skill</option>
        @foreach($skills as $skill)
            <option value="{{ $skill->id }}">{{ $skill->name }}</option>
        @endforeach
    </select>
    <button type="button" id="addSkill">Add Skill</button>
    <br><br>

    <div id="skillPopup">
        <label for="newSkill">New Skill:</label>
        <input type="text" id="newSkill" name="newSkill"><br><br>
        <button type="button" id="cancelSkill">Cancel</button>
        <button type="button" id="submitSkill">Submit</button>
    </div>

    <button type="submit">Submit CV</button>
</form>
</body>
</html>
