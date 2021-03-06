<?php
require_once '../include/db_connection.inc';
require 'variables.php';

// Konto des senders wählen
$query = 'SELECT user_ID FROM account WHERE acc_ID = ?';

$stmt = mysqli_prepare($db, $query);

$stmt->bind_param('i', $account);

$stmt->execute();

$result = $stmt->get_result();

$stmt->close();

$row = mysqli_fetch_assoc($result);

// Konto gehört angemeldetem User
$accountOwnerID = $row['user_ID'];

if ($accountOwnerID != $user['user_ID']) {
    $error = 666;
    header('Location: ../index.php?action=finances&error=' . $error);
} else {
if($analysisType == "transactionTimes")
{

    $query = "select count(trans_ID) as count from transaction WHERE trans_sender = $account and trans_type = 'Miete'";

    $result = mysqli_query($db, $query);

    $miete = mysqli_fetch_array($result);

    $miete = $miete['count'];


    $query = "select count(trans_ID) as count from transaction WHERE trans_sender = $account and trans_type = 'Haushalt'";

    $result = mysqli_query($db, $query);

    $haushalt = mysqli_fetch_array($result);

    $haushalt = $haushalt['count'];


    $query = "select count(trans_ID) as count from transaction WHERE trans_sender = $account and trans_type = 'Freizeit'";

    $result = mysqli_query($db, $query);

    $freizeit = mysqli_fetch_array($result);

    $freizeit = $freizeit['count'];


    $query = "select count(trans_ID) as count from transaction WHERE trans_sender = $account and trans_type = 'Online'";

    $result = mysqli_query($db, $query);

    $online = mysqli_fetch_array($result);

    $online = $online['count'];


    $query = "select count(trans_ID) as count from transaction WHERE trans_sender = $account and trans_type = 'Einkaufen'";

    $result = mysqli_query($db, $query);

    $einkaufen = mysqli_fetch_array($result);

    $einkaufen = $einkaufen['count'];


    $query = "select count(trans_ID) as count from transaction WHERE trans_sender = $account and trans_type = 'Reisen'";

    $result = mysqli_query($db, $query);

    $reisen = mysqli_fetch_array($result);

    $reisen = $reisen['count'];


    $query = "select count(trans_ID) as count from transaction WHERE trans_sender = $account and trans_type = 'Gesundheit'";

    $result = mysqli_query($db, $query);

    $gesundheit = mysqli_fetch_array($result);

    $gesundheit = $gesundheit['count'];


    $query = "select count(trans_ID) as count from transaction WHERE trans_sender = $account and trans_type = 'Steuern & Versicherungen'";

    $result = mysqli_query($db, $query);

    $steuern = mysqli_fetch_array($result);

    $steuern = $steuern['count'];


    $query = "select count(trans_ID) as count from transaction WHERE trans_sender = $account and trans_type = 'Ferien'";

    $result = mysqli_query($db, $query);

    $ferien = mysqli_fetch_array($result);

    $ferien = $ferien['count'];


    $query = "select count(trans_ID) as count from transaction WHERE trans_sender = $account and trans_type = 'Diverses'";

    $result = mysqli_query($db, $query);

    $diverses = mysqli_fetch_array($result);

    $diverses = $diverses['count'];

    ?>

    <!DOCTYPE HTML>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Highcharts Example</title>

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <style type="text/css">
            ${demo.css}
        </style>
        <script type="text/javascript">
            $(function () {
                $('#container').highcharts({
                    chart: {
                        type: 'bar'
                    },
                    title: {
                        text: 'Diagram für <?php echo $account; ?>'
                    },
                    xAxis: {
                        categories: ['Miete', 'Haushalt', 'Freizeit', 'Online', 'Einkaufen', 'Reisen', 'Gesundheit', 'Steuern & Versicherungen', 'Ferien', 'Diverses'],
                        title: {
                            text: null
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Transaktionen',
                            align: 'high'
                        },
                        labels: {
                            overflow: 'justify'
                        }
                    },
                    tooltip: {
                        valueSuffix: ' Anzahl'
                    },
                    plotOptions: {
                        bar: {
                            dataLabels: {
                                enabled: true
                            }
                        }
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'top',
                        x: -40,
                        y: 80,
                        floating: true,
                        borderWidth: 1,
                        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                        shadow: true
                    },
                    credits: {
                        enabled: false
                    },
                    series: [{
                        name: 'Anazhl Transaktionen',
                        data: [<?php echo "$miete, $haushalt, $freizeit, $online, $einkaufen, $reisen, $gesundheit, $steuern, $ferien, $diverses";  ?>]
                    }]
                });
            });
        </script>

    </head>
    <body>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>

    <div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>

    </body>
    </html>


    <?php
} elseif ($analysisType == "transactionAmmount") {
    $query = "select sum(trans_amount) as count from transaction WHERE trans_sender = $account and trans_type = 'Miete'";

    $result = mysqli_query($db, $query);

    $miete = mysqli_fetch_array($result);

    $miete = $miete['count'];


    $query = "select sum(trans_amount) as count from transaction WHERE trans_sender = $account and trans_type = 'Haushalt'";

    $result = mysqli_query($db, $query);

    $haushalt = mysqli_fetch_array($result);

    $haushalt = $haushalt['count'];


    $query = "select sum(trans_amount) as count from transaction WHERE trans_sender = $account and trans_type = 'Freizeit'";

    $result = mysqli_query($db, $query);

    $freizeit = mysqli_fetch_array($result);

    $freizeit = $freizeit['count'];


    $query = "select sum(trans_amount) as count from transaction WHERE trans_sender = $account and trans_type = 'Online'";

    $result = mysqli_query($db, $query);

    $online = mysqli_fetch_array($result);

    $online = $online['count'];


    $query = "select sum(trans_amount) as count from transaction WHERE trans_sender = $account and trans_type = 'Einkaufen'";

    $result = mysqli_query($db, $query);

    $einkaufen = mysqli_fetch_array($result);

    $einkaufen = $einkaufen['count'];


    $query = "select sum(trans_amount) as count from transaction WHERE trans_sender = $account and trans_type = 'Reisen'";

    $result = mysqli_query($db, $query);

    $reisen = mysqli_fetch_array($result);

    $reisen = $reisen['count'];


    $query = "select sum(trans_amount) as count from transaction WHERE trans_sender = $account and trans_type = 'Gesundheit'";

    $result = mysqli_query($db, $query);

    $gesundheit = mysqli_fetch_array($result);

    $gesundheit = $gesundheit['count'];


    $query = "select sum(trans_amount) as count from transaction WHERE trans_sender = $account and trans_type = 'Steuern & Versicherungen'";

    $result = mysqli_query($db, $query);

    $steuern = mysqli_fetch_array($result);

    $steuern = $steuern['count'];


    $query = "select sum(trans_amount) as count from transaction WHERE trans_sender = $account and trans_type = 'Ferien'";

    $result = mysqli_query($db, $query);

    $ferien = mysqli_fetch_array($result);

    $ferien = $ferien['count'];


    $query = "select sum(trans_amount) as count from transaction WHERE trans_sender = $account and trans_type = 'Diverses'";

    $result = mysqli_query($db, $query);

    $diverses = mysqli_fetch_array($result);

    $diverses = $diverses['count'];

    ?>

    <!DOCTYPE HTML>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Highcharts Example</title>

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <style type="text/css">
            ${demo.css}
        </style>
        <script type="text/javascript">
            $(function () {
                $('#container').highcharts({
                    chart: {
                        type: 'bar'
                    },
                    title: {
                        text: 'Diagram für <?php echo $account; ?>'
                    },
                    xAxis: {
                        categories: ['Miete', 'Haushalt', 'Freizeit', 'Online', 'Einkaufen', 'Reisen', 'Gesundheit', 'Steuern & Versicherungen', 'Ferien', 'Diverses'],
                        title: {
                            text: null
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Geld',
                            align: 'high'
                        },
                        labels: {
                            overflow: 'justify'
                        }
                    },
                    tooltip: {
                        valueSuffix: ' CHF'
                    },
                    plotOptions: {
                        bar: {
                            dataLabels: {
                                enabled: true
                            }
                        }
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'top',
                        x: -40,
                        y: 80,
                        floating: true,
                        borderWidth: 1,
                        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                        shadow: true
                    },
                    credits: {
                        enabled: false
                    },
                    series: [{
                        name: 'Geld Transaktionen',
                        data: [<?php echo "$miete, $haushalt, $freizeit, $online, $einkaufen, $reisen, $gesundheit, $steuern, $ferien, $diverses";  ?>]
                    }]
                });
            });
        </script>


    </head>
    <body>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>

    <div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>

    </body>
    </html>

    <?php
    }
}