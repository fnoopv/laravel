<canvas id="pie" width="400" height="400"></canvas>
<script>
    $(function () {
        var jsonData = $.ajax({
            url: 'admin/api/users/pie',
            dataType: 'json',
        }).done(function (results) {

            // 将获取到的json数据分别存放到两个数组中
            var labels = [], data = [];
            labels = results.sex;
            data = results.count;

            // 设置图表的数据
            var tempData = {
                datasets: [{
                    label:'性别比例',
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)',
                    ],
                    borderWidth: 1
                }],
                labels: labels,
            };
            var ctx = document.getElementById("pie").getContext('2d');
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: tempData
            });
        });
    })
</script>