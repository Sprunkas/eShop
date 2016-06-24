@extends('template')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">Užsakymo tvarkymas</div>
            <div class="panel-footer">
                <form action="{{ route('order.edit', ['id' => $fresh_order->id]) }}" method="POST">
                    <div class="form-inline{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="title">Pavadinimas</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Pavadinimas" value="{{ old('title') ?: $fresh_order->title }}" style="margin: 15px 50px;">
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
                                @if(count($orders))
                                    @foreach($orders as $order)
                                        <?php $i = 0; ?>
                                        <tr>
                                            <input type="hidden" name="itemid[]" value="{{ $order->id }}">
                                            <td style="vertical-align: middle;">
                                                <span class="glyphicon glyphicon-menu-up"></span><br>
                                                <span class="glyphicon glyphicon-menu-down"></span>
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <div class="form-group{{ $errors->has('item') ? ' has-error' : '' }}">
                                                    <label for="item"></label>
                                                    <input type="text" class="form-control" id="item" name="item[]" placeholder="Prekė" value="{{ old('item.'.$i) ?: $order->item }}">
                                                    @if($errors->has('item'))
                                                        <span class="help-block">{{ $errors->first('item.0') }}</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                                                    <label for="quantity"></label>
                                                    <input type="text" class="form-control quantity" name="quantity[]" placeholder="Kiekis" value="{{ old('quantity.'.$i) ?: $order->quantity }}">
                                                </div>
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                                    <label for="price"></label>
                                                    <input type="text" class="form-control price" name="price[]" placeholder="Kaina" value="{{ old('quantity.'.$i) ?: $order->price }}">
                                                </div>
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <div class="form-group">
                                                    <label for="sum"></label>
                                                    <input type="text" class="form-control sum" name="sum[]" placeholder="Suma" value="{{ old('sum.'.$i) ?: $order->sum }}" readonly>
                                                </div>
                                            </td>
                                            <td style="vertical-align: middle;"><a href="{{ route('order.delete.item', ['id' => $order->id]) }}"><span class="glyphicon glyphicon-remove" style="color: red;"></span></a></td>
                                        </tr>
                                        <?php $i++; ?>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            <a href="#" class="btn btn-default" id="add">Pridėti prekę</a>
                            <hr style="border-top: 2px solid #6E6A6A;">
                            <button style="float: left;" type="submit" class="btn btn-default">Išsaugoti</button>
                            <div style="float: right;" class="form-inline {{ $errors->has('total') ? ' has-error' : '' }}">
                                <label for="total">Bendra suma</label>
                                <input type="text" class="form-control" id="total" name="total" placeholder="Bendra suma" value="{{ old('total') ?: $fresh_order->total }}" style="margin-left: 30px;" readonly>
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