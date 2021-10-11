@extends('layouts.shipment')

@section('title', )

@section('content')

<form  method="POST" >
    @csrf
    <div class="row clearfix">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>{!! $title !!}</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                        <div class="form-group form-float form-group-lg">
                            <div class="form-line">
                                <input type="text" class="form-control" name="minmaxlength" maxlength="10" minlength="3" required="" aria-required="true">
                                <label class="form-label">Min/Max Length</label>
                            </div>
                            <div class="help-info">Min. 3, Max. 10 characters</div>
                        </div>

                        <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>

                </div>
            </div>
        </div>

        {{--
            divide et impera
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>{!! $title !!}</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <form  method="POST" >
                        @csrf
                        <div class="form-group form-float form-group-lg">
                            <div class="form-line">
                                <input type="text" class="form-control" name="minmaxlength" maxlength="10" minlength="3" required="" aria-required="true">
                                <label class="form-label">Min/Max Length</label>
                            </div>
                            <div class="help-info">Min. 3, Max. 10 characters</div>
                        </div>

                        <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>{!! $title !!}</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <form  method="POST" >
                        @csrf
                        <div class="form-group form-float form-group-lg">
                            <div class="form-line">
                                <input type="text" class="form-control" name="minmaxlength" maxlength="10" minlength="3" required="" aria-required="true">
                                <label class="form-label">Min/Max Length</label>
                            </div>
                            <div class="help-info">Min. 3, Max. 10 characters</div>
                        </div>

                        <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div> --}}

    </div>
</form>
@endsection
