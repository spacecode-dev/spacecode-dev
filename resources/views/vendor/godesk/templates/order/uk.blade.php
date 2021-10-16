@include('godesk::index.inc.slot')
@extends('godesk::index.index')
@section('content')
    <div class="section" id="orderFormStepDiv">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <modal-order-form prop-order='{!! json_encode($entity->orderArray) !!}' prop-data='{!! json_encode($entity->orderData) !!}'></modal-order-form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{----}}
@stop

@section('js')
    {{----}}
@stop