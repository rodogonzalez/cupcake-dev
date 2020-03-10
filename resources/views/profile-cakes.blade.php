@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">My Cup Cakes</div>

                <div class="">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    @forelse ($user_stores as $store)
                    <?php 
                        $store_info= \App\Models\Store::find($store->id);
                    
                    ?>
                    <div><h2>{{ $store_info->name }}</h2> Date to pick up:  {{ $store->programmed_date_to_pick }}</div>
                    @empty
                        <p>No cup cakes claimed</p>
                    @endforelse


                    
                    
                  
                    
                    

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCL2IDlZi53TxjIaLcQJRcWYnPRmmt4bt8&libraries=visualization&language=es"></script>