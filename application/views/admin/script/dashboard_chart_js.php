
        <script type="text/javascript">

            'use strict';
            //bar chart
                var ctx = document.getElementById("barChart");
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ["Last 30 days", "Last 15 days", "Last 7 days", "Today"],
                        datasets: [
                            {
                                label: "",
                                data: [<?php echo @$last_30;?>, <?php echo @$last_15;?>, <?php echo @$last_7;?>, <?php echo count(@$to_day_get_appointment);?>],
                                borderColor: "rgba(55, 160, 0, 0.9)",
                                borderWidth: "0",
                                backgroundColor: "rgba(55, 160, 0, 0.5)"
                            },
                            {
                                label: "",
                                data: [<?php echo @$last_30;?>, <?php echo @$last_15;?>, <?php echo @$last_7;?>, <?php echo count(@$to_day_get_appointment);?>],
                                borderColor: "rgba(0,0,0,0.09)",
                                borderWidth: "0",
                                backgroundColor: "rgba(0,0,0,0.07)"
                            }
                        ]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                        }
                    }
                });

                //line chart
                var ctx = document.getElementById("lineChart");
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ["Total Patient", "Last 30 days", "Last 15 days", "Last 7 days"],
                        datasets: [
                            {
                                label: "",
                                borderColor: "rgba(0,0,0,.09)",
                                borderWidth: "1",
                                backgroundColor: "rgba(0,0,0,.07)",
                                data: [<?php echo @$total_patient;?>, <?php echo @$patient_30_day;?>, <?php echo @$patient_15_day;?>, <?php echo @$patient_7_day;?>]
                            },
                            {
                                label: "",
                                borderColor: "rgba(55, 160, 0, 0.9)",
                                borderWidth: "1",
                                backgroundColor: "rgba(55, 160, 0, 0.5)",
                                pointHighlightStroke: "rgba(26,179,148,1)",
                                 data: [<?php echo @$total_patient;?>, <?php echo @$patient_30_day;?>, <?php echo @$patient_15_day;?>, <?php echo @$patient_7_day;?>]
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        tooltips: {
                            mode: 'index',
                            intersect: false
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        }

                    }
                });
        </script>