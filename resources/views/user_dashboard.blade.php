@extends('layouts.user_dashboard')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Bienvenido, {{ auth()->user()->name }}</h6>
            </div>
            <div class="card-body">
                <p>Aquí puedes gestionar tu información personal, turnos y nómina.</p>
            </div>
        </div>
    </div>
</div>
@endsection
