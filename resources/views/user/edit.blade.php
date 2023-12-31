@extends('layouts.template')

@section('content')
    <form action="{{ route('user.update', $Users['id'])}}" method="post" class="card p-5" >
        @csrf
        @method('PATCH')

        @if ($errors->any())
            <ul class="alert alert-danger p-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nama :</label>
            <div>
                <input type="text" class="form-control" id="name" name="name" value="{{$Users['name']}}" >
            </div>
        </div>
        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">Email :</label>
            <div>
                <input type="text" class="form-control" id="email" name="email" value="{{$Users['email']}}" >
            </div>
        </div>
        <div class="mb-3 row">
            <label for="role" class="col-sm-2 col-form-label">Tipe Pengguna :</label>
            <div>
                <select class="form-select" name="role" id="role">
                    <option selected disabled hidden>Pilih</option>
                    <option value="admin" {{ $Users ['role'] == 'admin' ? 'selected' : ''}}>Admin</option>
                    <option value="cashier" {{ $Users ['role'] == 'cashier' ? 'selected' : ''}}>cashier</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="password" class="col-sm-2 col-form-label">Ubah Password :</label>
            <div>
                <input type="password" class="form-control" id="password" name="password" >
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
    </form>
    
@endsection