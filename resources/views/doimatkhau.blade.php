@extends('layouts.site')
@section('main')

    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Đổi mật khẩu</div>
                        <div class="card-body">
                            <form action="{{ route('postChangePassword') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="oldPassword" class="col-md-4 col-form-label text-md-right">Mật khẩu
                                        hiện tại</label>
                                    <div class="col-md-6">
                                        <input type="password" id="oldPassword" class="form-control form-control-sm"
                                            name="oldPassword" required autofocus>
                                        @error('oldPassword')
                                            <small class="help-block">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="newPassword" class="col-md-4 col-form-label text-md-right">Mật khẩu
                                        mới</label>
                                    <div class="col-md-6">
                                        <input type="password" id="newPassword" class="form-control form-control-sm"
                                            name="newPassword" required>
                                        @error('newPassword')
                                            <small class="help-block">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="reNewPassword" class="col-md-4 col-form-label text-md-right">Xác nhận mật
                                        khẩu mới</label>
                                    <div class="col-md-6">
                                        <input type="password" id="reNewPassword" class="form-control form-control-sm"
                                            name="reNewPassword" required>
                                        @error('reNewPassword')
                                            <small class="help-block">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Lưu
                                    </button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @stop
