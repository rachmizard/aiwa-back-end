@extends('layouts.master')
@section('content')
@push('otherJavascript')
        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable({
                    processing: true,
                });
            });
        </script>
        
        <script type="text/javascript">
        /* ==============================================
             Counter Up
             =============================================== */
            jQuery(document).ready(function($) {
                $('.counter').counterUp({
                    delay: 100,
                    time: 1200
                });
            });
        </script>
@endpush
@endsection
