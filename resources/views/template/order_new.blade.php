@extends('template')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">Užsakymo tvarkymas</div>
            <div class="panel-footer">
                <form action="{{ route('order.new') }}" method="POST">
                    <div class="form-inline{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="title">Pavadinimas</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Pavadinimas" value="{{ old('title') }}" style="margin: 15px 50px;">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered" style="text-align: center;" id="orders">
                                <thead>
                                    <tr>
                                        <td style="width: 2%;"></td>
                                        <td>Prekės pavadinimas</td>
                                        <td style="width: 15%;">Kiekis</td>
                                        <td style="width: 15%;">Kaina</td>
                                        <td style="width: 15%;">Suma</td>
                                        <td style="width: 2%;"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            <span class="glyphicon glyphicon-menu-up"></span><br>
                                            <span class="glyphicon glyphicon-menu-down"></span>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <div class="form-group{{ $errors->has('item.0') ? ' has-error' : '' }}">
                                                <label for="item"></label>
                                                <input type="text" class="form-control" id="item" name="item[]" placeholder="Prekė" value="{{ old('item.0') }}">
                                            </div>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <div class="form-group{{ $errors->has('quantity.0') ? ' has-error' : '' }}">
                                                <label for="quantity"></label>
                                                <input type="text" class="form-control quantity" name="quantity[]" placeholder="Kiekis" value="{{ old('quantity.0') }}">
                                            </div>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <div class="form-group{{ $errors->has('price.*') ? ' has-error' : '' }}">
                                                <label for="price"></label>
                                                <input type="text" class="form-control price" name="price[]" placeholder="Kaina" value="{{ old('price.0') }}">
                                            </div>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <div class="form-group">
                                                <label for="sum"></label>
                                                <input type="text" class="form-control sum" name="sum[]" placeholder="Suma" value="{{ old('sum.0') }}" readonly>
                                            </div>
                                        </td>
                                        <td style="vertical-align: middle;"><a href="#"><span class="glyphicon glyphicon-remove" style="color: red;"></span></a></td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="#" class="btn btn-default" id="add">Pridėti prekę</a>
                            <hr style="border-top: 2px solid #6E6A6A;">
                            <button style="float: left;" type="submit" class="btn btn-default">Išsaugoti</button>
                            <div style="float: right;" class="form-inline {{ $errors->has('total') ? ' has-error' : '' }}">
                                <label for="total">Bendra suma</label>
                                <input type="text" class="form-control" id="total" name="total" placeholder="Bendra suma" value="{{ old('total') }}" style="margin-left: 30px;" readonly>
                            </div>
                            <div style="clear: both;"></div>
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ URL::asset('js/jQuery.js') }}"></script>
@stop