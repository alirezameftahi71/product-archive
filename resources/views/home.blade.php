@extends('layouts.site')
@section('content')
<b-row class='text-center h-100'>
    <b-col md='12' lg='3' class='side-bar-container'>
        <side-bar :items='@json($list_items)'></side-bar>
    </b-col>
    <b-col md='12' lg='9'>
        <b-row align-v='center' class='h-100 mt-md-2'>
            <b-col>
                <details-area :item='@json($game)'></details-area>
            </b-col>
        </b-row>
    </b-col>
</b-row>
@endsection
@section('modals')
    <delete-modal></delete-modal>
@endsection