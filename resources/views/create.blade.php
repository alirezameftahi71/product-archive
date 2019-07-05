@extends('layouts.site')
@section('content')
<div class="row content justify-content-center full-height">
    <div class="col-md-10">
        <h3 class="text-center mt-4 mb-4">
            Create page
        </h3>
        <hr />
        <form>
            <div class="row content justify-content-center">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter title" name="title"
                            required="required">
                    </div>
                    <div class="row">
                        <div class="col-md-4  form-group">
                            <label for="released-date">Released Date:</label>
                            <input type="date" class="form-control" id="released-date" name="released-date">
                        </div>
                        <div class="col-md-4  form-group">
                            <label for="rate">Rate:</label>
                            <input type="number" min=1 max=5 step="0.5" class="form-control" id="rate"
                                placeholder="Enter Metascore" name="rate">
                        </div>
                        <div class="col-md-4  form-group">
                            <label for="isDone">Mark as Done:</label>
                            <select id="isDone" class="form-control" name="isDone">
                                <option value="0">False</option>
                                <option value="1">True</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="genre">Genre(s):</label>
                        <input type="text" class="form-control typeahead tm-input tm-input-info" id="genre"
                            placeholder="Enter Genres" name="genre" autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <label for="platform">Platform(s):</label>
                        <input type="text" class="form-control typeahead tm-input tm-input-info" id="platform"
                            placeholder="Enter Platforms" name="platform" autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <label for="publisher">Publisher(s):</label>
                        <input type="text" class="form-control typeahead tm-input tm-input-info" id="publisher"
                            placeholder="Enter Publishers" name="publisher" autocomplete="off" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="desc-box">Description:</label>
                        <textarea class="form-control" rows="11" id="desc-box"
                            placeholder="Enter brief description here" name="desc-box"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="cover-pic">Cover Picture:</label>
                        <div id="file-browse-wrapper">
                            <input type="file" class="form-control" name="cover-pic" id="cover-pic">
                            <a data-toggle="confirmation" title="Delete Cover Picture" data-title="Delete Picture?"
                                data-placement="top" data-btn-cancel-class="btn-danger" data-popout="true"
                                href="javascript:deletePicture();">
                                <i class="icon fas fa-times"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row content justify-content-center">
                <div class="col-md-8">
                    <button id="btn-submit" type="button" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-md-4">
                    <div id="messageBox"></div>
                </div>
            </div>
        </form>
        <br />
    </div>
</div>
@endsection