<!DOCTYPE html>
<html>
    <link rel="stylesheet" type="text/css" href="../css/search_result_entry.css"/>
    <link rel="stylesheet" type="text/css" href="../css/common.css"/>
<head>
    <title>SquadUCSD</title>
    <meta charset="utf-8">
    <meta name="description" content="UCSD study group searching site">
    <meta name="keywords" content="HTML,CSS,JavaScript">
    <meta name="author" content="Zifan Yang">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#common').load('./common.php');
        });
    </script>
</head>
<body>

    <div id="common"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <div class="panel panel-custom">
                    <div class="panel-heading"><h4>Search Results</h4></div>
                    <div class="panel-body">
                        <div class="basicinfo">
                
                      
                       <label class="col-sm-12">Matched Classes: CSE101, CSE 105, CSE110</label>
                            <br>
                            <br>
                       </div>
                        <div class="button">
                        <div class="btn-group" role="group">
                            <button href="#" type="button" class="btn btn-primary" role="button">Message</button>
                            <button href="./viewprofile.html" type="button" target="_blank" class="btn btn-info" role="button">View Profile</button>
                            <button href="#" type="button" class="btn btn-success" role="button">Invite to Existing Group</button>
                            <button href="#" type="button" class="btn btn-success" role="button">Invite to Form New Group</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>