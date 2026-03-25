
@extends('layouts.admin')
@section('title','Create Footer')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="m-0">Create Footer</h4>
    <a href="{{ route('footer.list') }}" class="btn btn-outline-dark btn-sm">Back to List</a>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-white">
        <strong>Footer Form</strong>
        <div class="text-muted small">Create new footer record</div>
    </div>

    <div class="card-body">
        <form action="{{ route('footer.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Company Name</label>
                    <input type="text" name="CompanyName" class="form-control" value="{{ old('CompanyName') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="text" name="Email" class="form-control" value="{{ old('Email') }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="Phone" class="form-control" value="{{ old('Phone') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" name="Address" class="form-control" value="{{ old('Address') }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Facebook</label>
                    <input type="text" name="Facebook" class="form-control" value="{{ old('Facebook') }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Telegram</label>
                    <input type="text" name="Telegram" class="form-control" value="{{ old('Telegram') }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Youtube</label>
                    <input type="text" name="Youtube" class="form-control" value="{{ old('Youtube') }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label">Copyright</label>
                    <input type="text" name="Copyright" class="form-control" value="{{ old('Copyright') }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Active</label>
                    <select name="IsActive" class="form-select">
                        <option value="1" selected>Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>

            <button class="btn btn-primary">Save Footer</button>
        </form>
    </div>
</div>
@endsection