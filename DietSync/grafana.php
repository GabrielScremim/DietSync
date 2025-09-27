<?php
$titulo = "Grafana";
$page = 'grafana';
include __DIR__ . '/includes/header.inc.php';
include __DIR__ . '/includes/menu.inc.php';
if ($_SESSION['id'] != 1) {
    header('Location: home.php');
}

?>
<div class="container-fluid" id="main">
<iframe src="http://152.67.45.167:3000/d-solo/ddvfuvvexsqv4d/dashboard-dietsync?orgId=1&from=1724263818292&to=1724285418292&theme=light&panelId=1" width="1000" height="500" frameborder="0"></iframe>
<iframe src="http://152.67.45.167:3000/d-solo/ddvfuvvexsqv4d/dashboard-dietsync?orgId=1&from=1724261054114&to=1724282654114&panelId=3" width="1000" height="500" frameborder="0"></iframe>
<iframe src="http://152.67.45.167:3000/d-solo/bdvfu1wvy3chsc/prometheus-benchmark-2-0-x?schemaVersion=1&panes=%7B%22ujz%22%3A%7B%22datasource%22%3A%22edvfsbubik7b4e%22%2C%22queries%22%3A%5B%7B%22expr%22%3A%22irate%28process_cpu_seconds_total%7Bjob%3D%5C%22prometheus%5C%22%2Cinstance%3D%5C%22localhost%3A9090%5C%22%7D%5B1m%5D%29%22%2C%22intervalFactor%22%3A2%2C%22legendFormat%22%3A%22Irate%22%2C%22metric%22%3A%22prometheus_local_storage_ingested_samples_total%22%2C%22refId%22%3A%22A%22%2C%22step%22%3A10%2C%22datasource%22%3A%7B%22type%22%3A%22prometheus%22%2C%22uid%22%3A%22edvfsbubik7b4e%22%7D%2C%22interval%22%3A%22%22%7D%2C%7B%22expr%22%3A%22rate%28process_cpu_seconds_total%7Bjob%3D%5C%22prometheus%5C%22%2Cinstance%3D%5C%22localhost%3A9090%5C%22%7D%5B5m%5D%29%22%2C%22intervalFactor%22%3A2%2C%22legendFormat%22%3A%225m+rate%22%2C%22metric%22%3A%22prometheus_local_storage_ingested_samples_total%22%2C%22refId%22%3A%22B%22%2C%22step%22%3A10%2C%22datasource%22%3A%7B%22type%22%3A%22prometheus%22%2C%22uid%22%3A%22edvfsbubik7b4e%22%7D%2C%22interval%22%3A%22%22%7D%5D%2C%22range%22%3A%7B%22from%22%3A%22now-6h%22%2C%22to%22%3A%22now%22%7D%7D%7D&orgId=1&refresh=1m&from=1724264891462&to=1724286491462&panelId=9" width="1000" height="500" frameborder="0"></iframe>
<iframe src="http://152.67.45.167:3000/d-solo/bdvfu1wvy3chsc/prometheus-benchmark-2-0-x?schemaVersion=1&panes=%7B%22ujz%22%3A%7B%22datasource%22%3A%22edvfsbubik7b4e%22%2C%22queries%22%3A%5B%7B%22expr%22%3A%22irate%28process_cpu_seconds_total%7Bjob%3D%5C%22prometheus%5C%22%2Cinstance%3D%5C%22localhost%3A9090%5C%22%7D%5B1m%5D%29%22%2C%22intervalFactor%22%3A2%2C%22legendFormat%22%3A%22Irate%22%2C%22metric%22%3A%22prometheus_local_storage_ingested_samples_total%22%2C%22refId%22%3A%22A%22%2C%22step%22%3A10%2C%22datasource%22%3A%7B%22type%22%3A%22prometheus%22%2C%22uid%22%3A%22edvfsbubik7b4e%22%7D%2C%22interval%22%3A%22%22%7D%2C%7B%22expr%22%3A%22rate%28process_cpu_seconds_total%7Bjob%3D%5C%22prometheus%5C%22%2Cinstance%3D%5C%22localhost%3A9090%5C%22%7D%5B5m%5D%29%22%2C%22intervalFactor%22%3A2%2C%22legendFormat%22%3A%225m+rate%22%2C%22metric%22%3A%22prometheus_local_storage_ingested_samples_total%22%2C%22refId%22%3A%22B%22%2C%22step%22%3A10%2C%22datasource%22%3A%7B%22type%22%3A%22prometheus%22%2C%22uid%22%3A%22edvfsbubik7b4e%22%7D%2C%22interval%22%3A%22%22%7D%5D%2C%22range%22%3A%7B%22from%22%3A%22now-6h%22%2C%22to%22%3A%22now%22%7D%7D%7D&orgId=1&refresh=1m&from=1724264229797&to=1724285829798&panelId=6" width="1000" height="500" frameborder="0"></iframe>
<div>
<?php
include __DIR__ . '/includes/footer.inc.php';
?>
</body>

</html>
