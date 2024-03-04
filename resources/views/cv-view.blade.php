<!DOCTYPE html>
<html>
<head>
    <title>Create CV</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>

        $(function () {
            $("#datepicker").datepicker();
        });

        function hidePopup () {
            $('#skillPopup').hide();
            $('#newSkill').val('');
            removeRequiredAttribute();
        }

        function getSkills() {
            $.ajax({
                url: "{{ route('get.skills') }}",
                type: "GET",
                success: function (skills) {
                    var skillSelect = $('#skills');
                    skillSelect.empty();
                    $.each(skills, function (index, skill) {
                        skillSelect.append('<option value="' + skill.id + '">' + skill.name + '</option>');
                    });

                    // skillSelect.multiselect({
                    //     nonSelectedText: 'Select Skills',
                    //     enableFiltering: true,
                    //     enableCaseInsensitiveFiltering: true,
                    //     buttonWidth: '100%'
                    // });
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);

                    var errorMessage = xhr.responseText;
                    $('#errorDialog').text(errorMessage);
                    $('#errorDialog').dialog({
                        title: 'Error',
                        modal: true,
                        buttons: {
                            Ok: function () {
                                $(this).dialog('close');
                            }
                        }
                    });
                }
            });

        }

        $(document).ready(function () {
            $('#addSkill').click(function () {
                $('#skillPopup').show();
                addRequiredSkills()
            });

            $('#cancelSkill').click(function () {
                $('#skillPopup').hide();
                removeRequiredAttribute();
            });

            $('#submitSkill').click(function (event) {
                if ($('#skillPopup').is(':visible')) {
                    event.preventDefault();

                    // Manually trigger form validation
                    var form = $('#newSkillForm')[0];
                    console.log(form)
                    if (form.checkValidity()) {

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
                                getSkills();
                                hidePopup();
                            },
                            error: function (xhr, status, error) {
                                console.error(xhr.responseText);

                                var errorMessage = xhr.responseText;
                                $('#errorDialog').text(errorMessage);
                                $('#errorDialog').dialog({
                                    title: 'Error',
                                    modal: true,
                                    buttons: {
                                        Ok: function () {
                                            $(this).dialog('close');
                                        }
                                    }
                                });
                            }
                        });
                    }
                    else {
                        // If form is invalid, handle accordingly (e.g., display error messages)
                        console.log('fail')
                        form.reportValidity();
                    }
                }
            });
        });

        $(function () {
            $("#datepicker").datepicker();
        });

        function getUniversities() {
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

                    var errorMessage = xhr.responseText;
                    $('#errorDialog').text(errorMessage);
                    $('#errorDialog').dialog({
                        title: 'Error',
                        modal: true,
                        buttons: {
                            Ok: function () {
                                $(this).dialog('close');
                            }
                        }
                    });
                }
            });
        }

        $(document).ready(function () {
            $('#addUniversity').click(function () {
                $('#universityPopup').show();
                addRequiredUniversity()
            });

            $('#cancelUniversity').click(function () {
                $('#universityPopup').hide();
                removeRequiredAttribute();
            });

            $('#submitUniversity').click(function (event) {
                if ($('#universityPopup').is(':visible')) {
                    event.preventDefault();

                    // Manually trigger form validation
                    var form = $('#newUniversityForm')[0];
                    console.log(form)
                    if (form.checkValidity()) {

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
                                getUniversities();
                                removeRequiredAttribute();

                            },
                            error: function (xhr, status, error) {
                                console.error(xhr.responseText);

                                var errorMessage = xhr.responseText;
                                $('#errorDialog').text(errorMessage);
                                $('#errorDialog').dialog({
                                    title: 'Error',
                                    modal: true,
                                    buttons: {
                                        Ok: function () {
                                            $(this).dialog('close');
                                        }
                                    }
                                });
                            }
                        });

                        // If form is valid, continue with your logic

                        // form.submit();
                    } else {
                        // If form is invalid, handle accordingly (e.g., display error messages)
                        console.log('fail')
                        form.reportValidity();
                    }


                }
            });
        });

        function addRequiredUniversity() {

            var universityNameInput = $('#newUniversityName');
            if (universityNameInput.length > 0) {
                universityNameInput.attr('required', 'required');
            }

            var accreditationInput = $('#newAccreditation');
            if (accreditationInput.length > 0) {
                accreditationInput.attr('required', 'required');
            }
        }

        function addRequiredSkills() {

            var newSkillInput = $('#newSkill');
            if (newSkillInput.length > 0) {
                newSkillInput.attr('required', 'required');
            }
        }

        // Function to remove the required attribute from the specified input fields
        function removeRequiredAttribute() {
            $('#newUniversityName, #newAccreditation, #newSkill').removeAttr('required');
        }

        // Event listener for cancel button
        $('#cancelUniversity, #cancelSkill').click(function () {
            removeRequiredAttribute();
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

        .required::after {
            content: '*';
            color: red;
        }
    </style>
</head>
<body>
<h2>Create CV</h2>
<form id="cvForm" action="{{ route('store.cv') }}" method="POST">
    @csrf
    <label for="name" class="required">Name:</label>
    <input type="text" id="name" name="name" required><br><br>
    <label for="middle_name" class="required">Middle name:</label>
    <input type="text" id="middle_name" name="middle_name" required><br><br>
    <label for="last_name" class="required">Last name:</label>
    <input type="text" id="last_name" name="last_name" required><br><br>
    <label for="birth_date" class="required">Date of Birth:</label>
    <input type="text" id="datepicker" name="birth_date" required><br><br>
    <label for="university" class="required">University:</label>
    <select id="university" name="university">
        <option value="">Select University</option>
        @foreach($universities as $university)
            <option value="{{ $university->id }}">{{ $university->name }}</option>
        @endforeach
    </select>
    <button type="button" id="addUniversity">Add University</button>
    <br><br>

    <label for="skills" class="required">Skills:</label>
    <select id="skills" name="skills[]" multiple>
        <option value="">Select skill</option>
        @foreach($skills as $skill)
            <option value="{{ $skill->id }}">{{ $skill->name }}</option>
        @endforeach
    </select>
    <button type="button" id="addSkill">Add Skill</button>
    <br><br>

    <button type="submit">Submit CV</button>
</form>

<div id="universityPopup">
    <form id="newUniversityForm" action="" method="post">
        <label for="newUniversityName" class="required">University Name:</label>
        <input type="text" id="newUniversityName" name="newUniversityName"><br><br>
        <label for="newAccreditation" class="required">University Accreditation:</label>
        <input type="text" id="newAccreditation" name="newAccreditation"><br><br>
        <button type="button" id="cancelUniversity">Cancel</button>
        <button type="button" id="submitUniversity">Submit</button>
    </form>
</div>

<div id="skillPopup">
    <form id="newSkillForm" action="" method="post">
        <label for="newSkill" class="required">New Skill:</label>
        <input type="text" id="newSkill" name="newSkill"><br><br>
        <button type="button" id="cancelSkill">Cancel</button>
        <button type="button" id="submitSkill">Submit</button>
    </form>
</div>

<p>Note: Fields marked with * are required.</p>
<p>Note: To add new university fields for name must be filled.</p>
<br><br><br>
<a href="{{ route('home') }}">To get cvs for given period click here!</a>

</body>
</html>
