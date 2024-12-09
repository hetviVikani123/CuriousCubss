<?php
session_start();
require("../db.php");
require("mentor_Header.php");
require("mentor_Sidebar.php");
require("../Auth/nedded.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Quiz Questions</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .card {
            background-color: white;
            border-radius: 10px;
            border: 1px solid #ddd;
            padding: 20px;
            margin-left: 150px;
            margin-top:90px;
        }
    
        .form-group label {
            font-weight: bold;
            color: #855e46;
        }
        .form-group input, .form-group select {
            color: #555;
        }
        .btn {
            background-color: #855e46;
            color: white;
            border: none;
            width:50px;
        }
        button:hover {
            background-color: #6d4e3a;
        }
    </style>
    <script>
        function toggleOptionType(optionNumber) {
            var optionType = document.getElementById('option' + optionNumber + '_type').value;
            var textInput = document.getElementById('option' + optionNumber + '_text');
            var fileInput = document.getElementById('option' + optionNumber + '_file');
            var fileLabel = document.getElementById('option' + optionNumber + '_file_label');

            if (optionType === 'text') {
                textInput.style.display = 'block';
                fileInput.style.display = 'none';
                fileLabel.style.display = 'none';
            } else {
                textInput.style.display = 'none';
                fileInput.style.display = 'block';
                fileLabel.style.display = 'block';
            }
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title" style="font-size:30px;">Add Quiz Questions</h1>
                <form action="process_form.php" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="question_type" class="col-md-3 col-form-label">Question Type:</label>
                        <div class="col-md-9">
                            <select id="question_type" name="question_type" class="form-control" required>
                                <option value="text">Text</option>
                                <option value="image">Image</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="question_text" class="col-md-3 col-form-label">Question (Text or Image URL):</label>
                        <div class="col-md-9">
                            <input type="text" id="question_text" name="question_text" class="form-control" required>
                        </div>
                    </div>
                    <?php for ($i = 1; $i <= 4; $i++): ?>
                    <div class="form-group row">
                        <label for="option<?php echo $i; ?>_type" class="col-md-3 col-form-label">Option <?php echo $i; ?> Type:</label>
                        <div class="col-md-9">
                            <select id="option<?php echo $i; ?>_type" name="option<?php echo $i; ?>_type" class="form-control" onchange="toggleOptionType(<?php echo $i; ?>)" required>
                                <option value="text">Text</option>
                                <option value="image">Image</option>
                            </select>
                            <input type="text" id="option<?php echo $i; ?>_text" name="option<?php echo $i; ?>_text" class="form-control mt-2" style="display: block;">
                            <label for="option<?php echo $i; ?>_file" id="option<?php echo $i; ?>_file_label" class="file-input mt-2" style="display: none;">Option <?php echo $i; ?> (Image):</label>
                            <input type="file" id="option<?php echo $i; ?>_file" name="option<?php echo $i; ?>_file" class="file-input form-control mt-2" style="display: none;">
                        </div>
                    </div>
                    <?php endfor; ?>
                    <div class="form-group row">
                        <label for="correct_option" class="col-md-3 col-form-label">Correct Option:</label>
                        <div class="col-md-9">
                            <select id="correct_option" name="correct_option" class="form-control" required>
                                <option value="1">Option 1</option>
                                <option value="2">Option 2</option>
                                <option value="3">Option 3</option>
                                <option value="4">Option 4</option>
                            </select>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-block" value="Add Question">
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
