<?php
require("admin_Header.php");
require("admin_Sidebar.php");
require("../Auth/nedded.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1 style='color:#855e46;'>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"style='color:#855e46;'>Home</a></li>
                    <li class="breadcrumb-item"style='color:#855e46;'>Dashboard</li>
                    <li class="breadcrumb-item active"style='color:#855e46;'>Reports</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row mt-4">
                <div class="card p-4 col-12">

                    <div class="card-header">
                        <div class="row">
                            <form>
                                <div class="row justify-content-center mt-3">
                                    <div class="col-md-3">
                                        <label class="ms-2 form-label"style='color:#855e46;'>
                                            Start Date
                                        </label>
                                        <input type="date" id="start-date" class="form-control" name="date" />
                                    </div>
                                    <div class="col-md-3">
                                        <label class="ms-2 form-label "style='color:#855e46;'>End Date</label>
                                        <input type="date" id="inputDate" class="form-control" name="date" />
                                    </div>
                                    <div class="col-md-3">
                                        <label class="ms-2 form-label "style='color:#855e46;'>
                                            Report Type
                                        </label>
                                        <select id="inputCategory" name="category" class="form-select">
                                            <option value="" disabledstyle='color:#855e46;'>
                                                Select
                                            </option>
                                            <option value="TPS Day">TPS Day</option>
                                            <option value="TPS Week">TPS Week</option>
                                            <option value="MIS">MIS</option>
                                            <option value="DSS">DSS</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2 mt-4">
                                        <button type="submit" name="tps" class="btn btn-primary my-2" style='color:beige;background:#855e46'>
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr class="text-dark" />
                    <table >
                        
                    </table>
                    <div class="card-body">
                    
                    </div>
                </div>
            </div>
            </div>
            </div>
        </section>
    </main>
</body>

</html>