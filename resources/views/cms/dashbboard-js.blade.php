<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

    // document ready
    $(document).ready(function() {
        getData();
    });

    function drawLineChart(data) {
        var config = {
            type: 'line',
            data: data,
            options: {
                scales: {
                    x: {
                        type: 'category',
                        labels: data.labels
                    },
                    y: {
                        beginAtZero: true
                    }
                },
                elements: {
                    line: {
                        tension: 0.4 // Atur nilai tension sesuai kebutuhan (0.0 - 1.0)
                    }
                },
            }
        };
        var myChart = new Chart(document.getElementById('pendaftarChart'), config);
    }

    function drawDoughnutChart(data) {
      var config = {
        type: 'doughnut',
        data: data,
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'top',
            },
            title: {
              display: false,
            }
          },
        },
      };
      var myChart = new Chart(document.getElementById('jurusanChart'), config);
    }

    function getData() {
        let tahun_ajaran = '{{ request()->input('tahun_ajaran') }}';
        let gelombang = '{{ request()->input('gelombang') }}';
        $.ajax({
            url: '/cms/dashboard/data',
            type: 'GET',
            data: {
                tahun_ajaran: tahun_ajaran,
                gelombang: gelombang
            },
            dataType: 'JSON',
            success: function(response) {
                $('#total_pendaftar').html(response.results.totalPendaftar);
                $('#total_pendaftar_gelombang').html(response.results.totalPendaftarGelombangIni);
                let totalPendaftarPerStatus = response.results.totalPendaftarPerStatus;
                for (let i = 0; i < totalPendaftarPerStatus.length; i++) {
                    const element = totalPendaftarPerStatus[i];
                    if (element.status_pembayaran == 'Belum Bayar') {
                        $('#belum_bayar').html(element.persen_total+"%");
                        $('#belum_bayar').css('width', element.persen_total+"%");
                    } else if (element.status_pembayaran == 'Belum Lunas') {
                        $('#belum_lunas').html(element.persen_total+"%");
                        $('#belum_lunas').css('width', element.persen_total+"%");
                    } else if (element.status_pembayaran == 'Lunas') {
                        $('#lunas').html(element.persen_total+"%");
                        $('#lunas').css('width', element.persen_total+"%");
                    }
                }

                $("#gelombangNow").html(gelombang ? gelombang : response.results.gelombangNow);
                $(".periode").html(response.results.tahunAjaranNow + " gelombang " + response.results.gelombangNow);
                
                $("#tahun_ajaran").val(tahun_ajaran ? tahun_ajaran : response.results.tahunAjaranNow)
                $("#gelombang").val(gelombang ? gelombang : response.results.gelombangNow)

                if (response.status == 'OK') {
                    drawLineChart(response.results.dataLineChart);
                    drawDoughnutChart(response.results.dataDougnutChart);
                }
            }
        });
    }
</script>
