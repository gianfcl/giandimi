@extends('Layouts.layout')

@section('js-libs')
<link href="{{ URL::asset('css/formValidation.min.css') }}" rel="stylesheet" type="text/css" > 
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet" type="text/css" > 
<link href="{{ URL::asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" >


<script type="text/javascript" src="{{ URL::asset('js/formvalidation/formValidation.popular.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/formvalidation/framework/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/formvalidation/language/es_CL.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/chart.bundle.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker.es.min.js') }}"></script>
@stop

@section('content')

@section('pageTitle', 'E - Note')

<style type="text/css">
    .lnkRenovacion, .lnkRenovacion:hover, .lnkNotas, .lnkNotas:hover{
        text-decoration: underline;
        color: blue;
    }
</style>

    <div class="row">    
        <div class="form-group col-md-12">
            <a type="button" class="btn btn-primary btn-lg btn-block" href="{{ route('be.enote-jefe') }}">Vista Jefe</a>
        </div>        
        <div class="form-group col-md-12">
            <a type="button" class="btn btn-primary btn-lg btn-block" href="{{ route('be.enote') }}">Vista Ejecutivo</a>
        </div>
    </div>
@stop
    
@section('js-scripts')
    <script type="text/javascript">
           $(document).ready(function(){
            
            $('#vistaJefatura').click(function(){            
            })
        })
    </script>
@stop
