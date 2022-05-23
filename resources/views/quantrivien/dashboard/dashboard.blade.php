@extends('layouts.site')

@section('main')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $subjects }}</h3>

                        <p>Môn học đăng ký</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-book-open"></i>
                    </div>
                    <a href="{{ route('subjectsList') }}" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $modules }}</h3>

                        <p>Lớp học phần</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-award"></i>
                    </div>
                    <a href="{{ route('moduleList') }}" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $students }}</h3>

                        <p>Sinh viên đăng ký</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-user-graduate"></i>
                    </div>
                    <a href="{{ route('studentList') }}" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $teachers }}</h3>

                        <p>Giảng viên giảng dạy</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                    </div>
                    <a href="{{ route('teacherList') }}" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div id="mc" style="width:100%; max-width:900px; height:500px;"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div id="myPlot" style="width:100%;max-width:700px; height:500px;"></div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">Môn học đăng ký nhiều nhất</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                    <thead>
                        <tr>
                            <th>Mã môn học</th>
                            <th>Môn học</th>
                            <th>Đã đăng ký</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($arr as $key => $items)
                            <tr>
                                <td>{{ $items['ma_mon_hoc'] }}</td>
                                <td>{{ $items['ten_mon_hoc'] }}</td>
                                <td>{{ $items['da_dang_ky'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        var diem = []
        var luot = []
        var diemso = <?php echo json_encode($sxdiems); ?>;
        for (let key in diemso) {
            if (diemso.hasOwnProperty(key)) {
                diem.push(key)
                luot.push(diemso[key])
            }
        }
        var xArray = diem;
        var yArray = luot;
        var layout = {
            title: "Thông kê điểm số"
        };
        var data = [{
            labels: xArray,
            values: yArray,
            type: "pie"
        }];
        Plotly.newPlot("myPlot", data, layout);

        /////////////////////////////////////////

        google.charts.load('current', {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var a = [
                ['Học kỳ', 'Lượt']
            ]
            var mangs = <?php echo json_encode($arrhk); ?>;
            mangs.forEach(mang => {
                a.push([mang['mahocky'], mang['sl']])
            });
            // Set Data
            var data = google.visualization.arrayToDataTable(a);
            // Set Options
            var options = {
                title: 'Học kỳ vs. Lượt đăng ký',
                hAxis: {
                    title: 'Học kỳ'
                },
                vAxis: {
                    title: 'Lượt đăng ký'
                },
                legend: 'none'
            };
            // Draw
            var chart = new google.visualization.LineChart(document.getElementById('mc'));
            chart.draw(data, options);
        }
    </script>

    <script src="{{ url('ad123') }}/plugins/jquery/jquery.min.js"></script>
    <script src="{{ url('ad123') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('ad123') }}/plugins/chart.js/Chart.min.js"></script>
    <script src="{{ url('ad123') }}/dist/js/adminlte.min.js"></script>
    <script src="{{ url('ad123') }}/dist/js/demo.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script>
    @endsection
