@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Ajouter un créneau horaire</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('schedules.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" id="date" name="date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="start_time" class="form-label">Heure de début</label>
                <input type="time" id="start_time" name="start_time" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="end_time" class="form-label">Heure de fin</label>
                <input type="time" id="end_time" name="end_time" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Ajouter le créneau</button>
        </form>
    </div>
@endsection
