<?php
// we need to adjust the url accordingly (append user id)
include_once "$_SERVER[DOCUMENT_ROOT]/controller/startUserSession.php";

$url = json_encode($_SERVER['REQUEST_URI']);

echo "!!";
echo strrpos($url, "?class=") !== false;
echo strrpos($url, "&type=") !== false;
echo "!!";

// redirects the url to homepage if not groupid foun
if (strrpos($url, "?class=") !== false &&
    strrpos($url, "&type=") !== false
) {

    $_SESSION['class'] = $_GET['class'];
    $_SESSION['type'] = $_GET['type'];

    echo $_SESSION['class'];
    echo "-----";
    echo $_SESSION['type'];

    // after this include, a variable named $result will be available, storing
    // an array of user objects or group objects depending on the request
    include_once "$_SERVER[DOCUMENT_ROOT]/controller/getSearchResultAction.php";
} else // otherwise reset the array
    $result = Array();

echo "hi";
echo sizeof($result);

?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="css/common.css"/>
<link rel="stylesheet" type="text/css" href="css/browse.css"/>
<head>
    <!-- this is the icon in the browser tab. change the image at some point -->
    <link rel="shortcut icon" href="http://i.imgur.com/Divi9yo.png" type="image/x-icon"/>

    <title>SquadUCSD</title>
    <meta charset="utf-8">
    <meta name="description" content="UCSD study group searching site">
    <meta name="keywords" content="HTML,CSS,JavaScript">
    <meta name="author" content="Zifan Yang">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- jQuery form validation -->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
    <script src="js/browse-validation.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- UI for class drop down -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="js/class-list.js"></script>
    <!--jqueryplugin for pagination-->
    <script src="js/jquery.twbsPagination.min.js" type="text/javascript"></script>
    <!--jquery object-->
    <script src="js/URI.js" type="text/javascript"></script>
    <script type="text/javascript">
        var result = <?php echo json_encode($result); ?>;
        var show = 8;
        var start = 0;

        function resetPage(){
            $("#results-container").html("");
            if (window.location.href.indexOf("&type=users") > -1) {
                for (i = start; i < start + show; i++)
                    renderResult(result[i]['fname'], result[i]['lname'], result[i]['major'], result[i]['userid']);
            }
            else if (window.location.href.indexOf("&type=groups") > -1) {
                for (i = start; i < start + show; i++)
                    renderResultGroup(result[i]['name'], result[i]['size'], result[i]['groupid']);
            }
        }

        $(document).ready(function () {
            $('#common').load('./common.php');
            if (result.length == 0) {
                $('#results-container').html("Sorry, we couldn't find any results... ");
            }
            resetPage();
            $('#pagination').twbsPagination({
                totalPages: Math.ceil(result.length / show),
                visiblePages: 4,
                initiateStartPageClick: false,
                hideOnlyOnePage: false,
                onPageClick: function (event, page) {
                    start = (page - 1) * show;
                    resetPage();
                    $('#page-content').text('Page ' + page);
                }
            });
        });
    </script>
</head>
<body>

<div id="common"></div>
<div class="container-fluid">
    <div class="col-lg-2 col-lg-offset-2 col-md-3 col-md-offset-1">
        <div class="panel panel-custom">
            <div class="panel-body main-panel">
                <form class="form" role="search" id="searchForm" name="searchForm" method="POST"
                      action="./controller/searchAction.php">

                    <div class="form-group" id="courseFormGroup" name="courseFormGroup">
                        <label for="course" class="control-label">Class</label>
                        <input type="text" placeholder="Enter a Class" class="form-control" name="course" id="course">
                    </div>

                    <div class="form-group" id="typeFormGroup" name="typeFormGroup">
                        <label for="searchtype" class="control-label">Type</label>
                        <select id="searchtype" name="searchtype">
                            <option value="users">Users</option>
                            <option value="groups">Groups</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block-xs" role="button">Search
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-7">
        <div class="panel panel-custom main-panel">
            <div class="panel-heading" name="mainHeading" id="mainHeading">
                <h3>Search Results</h3>
            </div>
            <div id="main-body" class="panel-body panel-custom main-body">
                <div class="text-center col-md-12 page-row">
                    <ul id="pagination" class="pagination-lg pagination"></ul>
                </div>
                <div id="results-container">
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<script type="text/javascript">
    function renderResult(fname, lname, major, id) {
        $("#results-container").append("<div class='col-md-6'><div class='panel panel-custom col-md-12 result-panel'><div class='panel-heading'><h4>" +
            fname + " " + lname + "</h4></div><div class='panel-body result-body'><form class='form-horizontal'><div class='form-group'><label for='major' class='col-md-3 control-label'>Major</label><div class='col-md-9'><p class='form-control-static' name='major' id='major'>" + major + "</p></div></div><div class='text-center buttons col-md-12' id='button'><button type='button' class='btn btn-primary btn-sm-block' onclick=" +
            "location.href='viewprofile.php?userid=" + id + "' role='button'>View Profile</button></div></form></div></div></div>");
    }
    function renderResultGroup(name, size, id) {
        $("#results-container").append("<div class='col-md-6'><div class='panel panel-custom col-md-12 result-panel'><div class='panel-heading'><h4>" +
            name + "</h4></div><div class='panel-body result-body'><form class='form-horizontal'><div class='form-group'><label for='major' class='col-md-3 control-label'>Size</label><div class='col-md-9'><p class='form-control-static' name='size' id='size'>" + size + "</p></div></div><div class='text-center buttons col-md-12' id='button'><button type='button' class='btn btn-primary btn-sm-block' onclick=" +
            "location.href='viewgroup.php?groupid=" + id + "' role='button'>View Group Profile</button></div></form></div></div></div>");
    }
</script>
</body>
</html>