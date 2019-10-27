@extends('layouts.site')
@section('styles')
<link rel="stylesheet" href="/css/home.css">
@endsection
@section('content')
<div class="row text-center full-height">
    <div class="col-lg-3 col-md-3 items-sidenav">
        <div class="input-group" id="searchItems">
            <input class="form-control border-right-0 border" type="search" id="search-box" placeholder="Search...">
            <div class="input-group-append">
                <div class="input-group-text bg-white">
                    <i class="icon fa fa-search"></i>
                </div>
            </div>
        </div>
        <br />
        <div class="list-group" id="list-items">
            @foreach ($list_items ?? [] as $item)
            <a id={{ $item->id }} href="#"
                class="list-group-item list-group-item-action">{{ htmlspecialchars_decode($item->name) }}</a>
            @endforeach
        </div>
    </div>
    <div id="info-area" class="col-lg-9 col-md-9">
        <h3 class="mt-4 mb-4">The Archive</h3>
        <hr />
        <div class="row">
            <div class="col-lg-8 col-md-7">
                <table id="info-table" class="table table-bordered table-striped fixed-width-table">
                    <tr>
                        <th>Name</th>
                        <td id="name">{{ isset($game) ? $game->name : null }}</td>
                    </tr>
                    <tr>
                        <th>Release Date</th>
                        <td id="releasedDate">{{ isset($game) ? $game->released_date : null }}</td>
                    </tr>
                    <tr>
                        <th>Genre(s)</th>
                        <td id="genre">
                            @php
                            $joinedItems=array();
                            if(isset($game)) {
                            foreach ($game->genres as $item) {
                            $joinedItems[] = $item->name;
                            }
                            }
                            @endphp
                            {{ implode(', ', $joinedItems) }}
                        </td>
                    </tr>
                    <tr>
                        <th>Platform(s)</th>
                        <td id="platform">
                            @php
                            $joinedItems=array();
                            if(isset($game)) {
                            foreach ($game->platforms as $item) {
                            $joinedItems[] = $item->name;
                            }
                            }
                            @endphp
                            {{ implode(', ', $joinedItems) }}
                        </td>
                    </tr>
                    <tr>
                        <th>Publisher(s)</th>
                        <td id="publisher">
                            @php
                            $joinedItems=array();
                            if(isset($game)) {
                            foreach ($game->publishers as $item) {
                            $joinedItems[] = $item->name;
                            }
                            }
                            @endphp
                            {{ implode(', ', $joinedItems) }}
                        </td>
                    </tr>
                    <tr>
                        <th>Rate</th>
                        <td id="rate">{{ isset($game) ? $game->rate . "/5" : null }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-4 col-md-5">
                <div class="container-fluid">
                    <img id="cover-pic" class="img-fluid"
                        src="{{ isset($game) ? asset("storage/" . $game->cover_pic) : asset('storage/assets/default.png')}}"
                        alt="Product Cover" width="265" height="320">
                </div>
                <div class="container-fluid toolbar">
                    <a id="item-delete" href="javascript:void(0);" data-toggle="confirmation"
                        data-title="Delete Product?" data-placement="left" data-btn-cancel-class="btn btn-sm btn-danger"
                        data-popout="true" class="icon">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                    <a id="item-heart" href="javascript:void(0);" class="icon">
                        <i class="fas fa-thumbs-up"></i>
                    </a>
                    <a id="item-edit" href="javascript:void(0);" class="icon">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a id="item-check" href="javascript:void(0);" class="icon {{ isset($game) && $game->checked ? 'i-green' : '' }}">
                        <i class="fas fa-check-circle"></i>
                    </a>
                </div>
            </div>
        </div>
        <hr>
        <div class="container-fluid">
            <p id="description">
                {{ isset($game) ? $game->description : null }}
            </p>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="/js/home.js"></script>
@endsection
