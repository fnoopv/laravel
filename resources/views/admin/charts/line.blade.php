<canvas id="line" width="400" height="400"></canvas>
<script>

    $(function () {
        var jsonData = $.ajax({
            url: 'admin/api/users/line',
            dataType: 'json'
        }).done(function (results) {
            var labels = [] ,data = [];
            labels = results[0];
            data = results[1];

            var tempData = {
                labels: labels,
                datasets: [{
                    label: '日增用户',
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            };
            var ctx = document.getElementById("line").getContext('2d');
            var line = new Chart(ctx, {
                type: 'line',
                data: tempData,
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        });
    });
</script>