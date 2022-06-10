@extends('layouts.site')

@section('main')
<div class="card">
    <div class="card-header" style="background-color: rgba(0,0,0,.03);">
        <h5 class="card-title">Học phí</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('sinhvien.feeStore') }}" method="POST">
            @csrf
            <table style="text-align: center" class="table-sm">
                <tr>
                    <td>Học phí: </td>
                    <td>{{ !isset($hocphi) ? '0' : number_format($hocphi) }} VND</td>
                    <td>
                        @if (isset($hocphi))
                        <button name="payUrl" type="submit" class="btn btn-primary">
                            Thanh toán
                        </button>
                        @endif
                    </td>
                </tr>
                <tr>
                    @if (isset($hocphi))
                    <input type="hidden" name="hoc_phi" value="{{ $hocphi }}">
                    @endif
                </tr> 
            </table>
        </form>
    </div>
</div>
@endsection

