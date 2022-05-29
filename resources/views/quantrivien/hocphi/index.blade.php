@extends('layouts.site')

@section('main')
<div class="card">
    <div class="card-header" style="background-color: rgba(0,0,0,.03);">
        <h5 class="card-title">Thanh toán học phí</h5>
    </div>
    <div class="card-body">
        <tr>
            <td>Học phí: </td>
            <td>5000000</td>
        </tr>
        <tr>
            <form action="{{ route('sinhvien.feeStore') }}" method="POST">
                @csrf
                <input type="hidden" value="5000000" name="hocphi">
                <input class="btn btn-primary" type="submit" value="Checkout">
            </form>
        </tr>
    </div>
</div>
@endsection
