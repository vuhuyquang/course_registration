@extends('layouts.site')

@section('main')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
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
                <h3 class="card-title">Học phần đăng ký nhiều nhất</h3>
                <div class="card-tools">
                    <a href="#" class="btn btn-tool btn-sm">
                        <i class="fas fa-download"></i>
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                    <thead>
                        <tr>
                            <th>Mã môn học</th>
                            <th>Mã học phần</th>
                            <th>Môn học</th>
                            <th>Giảng viên</th>
                            <th>Đã đăng ký</th>
                            <th>Xem danh sách</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hocphans as $item)
                            <tr>
                              <td>{{ $item->ma_lop }}</td>
                                <td>
                                    {{ $item->ma_hoc_phan }}
                                </td>
                                <td>{{ $item->monhocs->ten_mon_hoc }}</td>
                                <td>
                                    @if (!empty($item->giang_vien_id))
                                        {{ $item->giangviens->ho_ten }}
                                    @else
                                        <i>Chưa có thông tin</i>
                                    @endif
                                </td>
                                <td>
                                    {{ $item->da_dang_ky }}
                                </td>
                                <td>
                                    <a href="{{ route('hoc-phan.show', ['id' => $item->id]) }}" class="text-muted">
                                        <i class="fas fa-search"></i>
                                    </a>
                                </td>
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
        var ten = []
        var luot = []
        var mangbies = <?php echo json_encode($arr); ?>;
        for (let key in mangbies) {
            if (mangbies.hasOwnProperty(key)) {
                ten.push(key)
                luot.push(mangbies[key])
            }
        }
        console.log(ten, luot)
        var xArray = ten;
        var yArray = luot;

        var layout = {
            title: "Môn học đăng ký nhiều nhất"
        };

        var data = [{
            labels: xArray,
            values: yArray,
            type: "pie"
        }];

        Plotly.newPlot("myPlot", data, layout);
        //
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
