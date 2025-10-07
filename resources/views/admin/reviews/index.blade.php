@extends('layouts.app')

@section('content')

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Recenzije</h3>
            </div>
            @if(count($reviews) == 0)
                <div class="card-body">
                    <p class="text-muted mb-0">Nema recenzija</p>
                </div>
            @else
                <div class="card-body">
                    @foreach ($reviews as $review)
                        <div class="mb-4 pb-3 border-bottom">
                            <div class="row align-items-center mb-2">
                                <div class="col-md-3">
                                    <strong>{{ $review->listing->name }}</strong>
                                </div>
                                <div class="col-md-3">
                                    <strong>{{ $review->user->name }}</strong>
                                </div>
                                <div class="col-md-2">
                                    <span class="badge bg-warning text-dark">{{ $review->rating }}/5</span>
                                </div>
                                <div class="col-md-4 text-end">
                                    <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Obriši</button>
                                    </form>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <p class="mb-0">{{ $review->comment }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

@endsection