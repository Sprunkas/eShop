@extends('template')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">Užsakymų sąrašas</div>
            <div class="panel-footer">
                <a href="{{ route('order.new') }}" class="btn btn-default">Sukurti naują užsakymą</a><br><br>
                <table style="text-align: center;" class="table table-bordered">
                    <tr>
                        <td>Pavadinimas</td>
                        <td style="width: 30%;">Sukūrimo data</td>
                        <td style="width: 15%;">Suma</td>
                        <td style="width: 2%;"></td>
                    </tr>
                    @foreach($orders as $order)
                        <tr>
                            <td><a href="{{ route('order.edit', ['id' => $order->id]) }}">{{ $order->title }}</td>
                            <td>{{ $order->created_at->format('Y-m-d') }}</td>
                            <td>{{ $order->total }} €</td>
                            <td><a href="{{ route('order.delete', ['id' => $order->id]) }}"><span class="glyphicon glyphicon-remove" style="color: red;"></span></a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@stop