@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div id="map" style="width: 60%; height: 500px!important; display: block;float:left;"></div>

                    <div><h2>Find in the map your closer store and click it to claim your cup cake</h2></div>

                    <div id="store_info" v-if="current_store" style="float:right; width:40%;" >

                    <h2 >Store:@{{current_store.name}}</h2>
                        <h3>Cup Cakes Available(s) :@{{current_store.limit_stock}}</h3>
                        <br>
                    @guest                                       
                    <h1>REGISTER OR LOGIN TO CLAIM YOUR CAKE</h1>
                    @else  
                        <form method="POST" action="{{route('claim_url')}}">
                        @csrf
                            <input type="hidden" name="store_id" id="store_id"  v-model="current_store.id">
                            
                            <input type="date" name="date_claim" value="<?php echo date("Y-m-d");?>"  min="<?php echo date("Y-m-d");?>">

                            <button>CLAIM 1 CUP CAKE</button>
                        </form>                                                
                    @endguest
                    </div>
                    


                    
                    
                  
                    
                    

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCL2IDlZi53TxjIaLcQJRcWYnPRmmt4bt8&libraries=visualization&language=es"></script>