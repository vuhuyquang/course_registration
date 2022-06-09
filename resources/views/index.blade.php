<title>Trường Đại học Công nghệ Giao thông vận tải</title>
<link rel="stylesheet" href="{{ url('ad123') }}/dist/css/adminlte.min.css">
<link rel="shortcut icon" href="https://utt.edu.vn/publics/template/default/img/favicon.ico">
<style>
@import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Quicksand&display=swap');
*
{
	margin: 0;
	padding: 0;
	font-family: 'Open Sans', sans-serif;
	font-family: 'Quicksand', sans-serif;
}

    .card-heading {
        color: #1d1d1d;
        background-color: #b6b6b6;
        padding: 10px 20px;
        font-weight: 500;
    }

    table,
    th,
    td {
        border: 2px solid white;
        text-align: center;
    }

    .button {
        -moz-box-shadow: inset 0px 1px 0px 0px #ffffff;
        -webkit-box-shadow: inset 0px 1px 0px 0px #ffffff;
        box-shadow: inset 0px 1px 0px 0px #ffffff;
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ededed), color-stop(1, #dfdfdf));
        background: -moz-linear-gradient(center top, #ededed 5%, #dfdfdf 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ededed', endColorstr='#dfdfdf');
        background-color: #ededed;
        -webkit-border-top-left-radius: 6px;
        -moz-border-radius-topleft: 6px;
        border-top-left-radius: 6px;
        -webkit-border-top-right-radius: 6px;
        -moz-border-radius-topright: 6px;
        border-top-right-radius: 6px;
        -webkit-border-bottom-right-radius: 6px;
        -moz-border-radius-bottomright: 6px;
        border-bottom-right-radius: 6px;
        -webkit-border-bottom-left-radius: 6px;
        -moz-border-radius-bottomleft: 6px;
        border-bottom-left-radius: 6px;
        text-indent: 0;
        border: 1px solid #dcdcdc;
        display: inline-block;
        color: #777777;
        font-family: Times New Roman;
        font-size: 15px;
        font-weight: normal;
        font-style: normal;
        height: 25px;
        line-height: 25px;
        width: 100px;
        text-decoration: none;
        text-align: center;
        text-shadow: 1px 1px 0px #ffffff;
    }

    .button:hover {
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #dfdfdf), color-stop(1, #ededed));
        background: -moz-linear-gradient(center top, #dfdfdf 5%, #ededed 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#dfdfdf', endColorstr='#ededed');
        background-color: #dfdfdf;
    }

    .button:active {
        position: relative;
        top: 1px;
    }

    #menu {
        font-size: 15px;
        color: white;
        padding: 5px 5px 0 5px;
        background-color: #FF6600;
        height: 30px;
        top: 89px;
        right: 0px;
        text-align: right;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
    }

    #menu a {
        color: white;
        padding: 5px;
        text-decoration: none;
        text-align: 5px center;
        /* right: 5px; */
    }

    .h1 {
        font-family: arial;
        width: 300px;
        height: 50px;
        padding-left: 10px;
        font-size: 20px;
        font-weight: bold;
        text-align: justify;
    }

    .h2 {
        font-family: arial;
        width: 700px;
        height: 150px;
        padding-left: 10px;
        font-size: 18px;
        text-align: justify;
        padding-top: 5px;
    }

    #news-block-title {
        font-size: 18px;
        border-bottom: 1px solid #cd2122;
        position: relative;
        left: 300px;
        font-size: 30px;
        top: 50px;

    }

    p {
        padding-top: 10px;
        font-size: 16px;
        font-weight: normal;
    }

    .a3 {
        font-size: 20px;
        text-decoration: none;
        font-style: bold;
        color: black;
        font-size: 20px;
    }

    .a3:hover {
        color: #CD2122;
    }

    .hh1 {
        /* width: 34%; */
        text-align: center;
        margin: 52px 0px;
        margin-bottom: 6px;
        border-bottom: #cd2122;
        border: 1px solid #cd2122;
        border-top: none;
        border-left: none;
        border-right: none;
    }

</style>
<div id="imgall" style="text-align: center">
    <img style="text-align:center;" src="https://utt.edu.vn/uploads/images/site/1461517779logo.png">
</div>
<div id="menu">
    |
    <a href="{{ route('home') }}">Trang chủ</a>
    |
    <a href="{{ route('getLogin') }}">Đăng nhập</a>
    |
</div>
<div>
    <div style="align: center" style="padding-top: 20px">
        <div class="container mt-5">
            <table style="margin-left: auto; margin-right: auto;" width="">
                @if (isset($tintucs))
                    @foreach ($tintucs as $key => $item)
                        @if ($key == 0)
                            <tr class="tr mb-2">
                                <td>
                                    <h1 class="hh1">TIN TỨC SỰ KIỆN</h1>
                                </td>
                            </tr>
                        @endif
                        <tr class="tr mb-2">
                            <td class="" rowspan="2"><img height="220px" src="{{ $item['hinh_anh'] }}"
                                    alt="">
                            </td>
                            <td height="220px" class="h1"><a class="a3" href="{{ $item['duong_dan'] }}">
                                    {{ $item['tieu_de'] }}</a>

                                <p>{{ date('d-m-Y', strtotime($item['ngay_dang'])) }}</p>
                            </td>
                        <tr>
                            <td class="h2">{{ $item['noi_dung_ngan'] }}</td>
                        </tr>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>
        <div class="d-flex justify-content-center mb-5 mt-5">
            {{-- {!! $tintucs->links() !!} --}}
        </div>
    </div>
</div>



