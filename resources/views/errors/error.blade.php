@extends('layouts.master')
@section('content')


        <div class="wrapper-page animated fadeInDown">

            <div class="ex-page-content animated flipInX text-center">
                <h1>500</h1>
                <h2 class="font-light">Maintenance on going.</h2><br>
                <p>Why not try refreshing your page? or you can contact <a href="instagram.com/rachmizard">support</a></p>
                
                <a class="btn btn-purple m-t-20" href="#"><i class="fa fa-angle-left"></i> Back to Dashboard</a>
                <p>Error Details : {{ $exception->getMessage() }}</p>
            </div>
            
        </div>

@endsection
