<?php
include("template/Admin/menuAdmin.php");
?>
<?php
require_once __DIR__ . '/vendor/autoload.php';
$client = new MongoDB\Client('mongodb://ringo:Tu%4001229553219@ddl.routerproxy.com:27017/?authMechanism=SCRAM-SHA-256');
$log =$client->SorcerySetting->LogUser;

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.6.0/js/dataTables.select.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.6.0/css/select.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="css/dashboad.css"/>
<div id="root" hidden></div>
<script>
    $.ajax({
        url: "./tables/tableDashboard.php", 
        success: function(result){
            $("#root").html(result);
        }});
    setTimeout(function() {
        document.getElementById('root').removeAttribute("hidden")
    }, 1000);
</script>

<?php
include("template/Admin/footer.php");
?>

