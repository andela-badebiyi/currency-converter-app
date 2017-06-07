@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col s12">
            <form action="{{ route('search') }}" method="get">
                <div class="card-panel">
                    <div class="row">
                        <div class="input-field col s6">
                            <select name="base">
                                @foreach($allCurrencies as $currency)
                                    <option value="{{ $currency }}" {{ $currency === (isset($base) ? $base : "USD") ? "selected" : "" }}>{{ $currency }}</option>
                                @endforeach
                            </select>
                            <label>Base Currency</label>
                        </div>
                        <div class="input-field col s6">
                            <select name="target">
                                @foreach($allCurrencies as $currency)
                                    <option value="{{ $currency }}" {{ $currency === (isset($target) ? $target : "EUR") ? "selected" : "" }}>{{ $currency }}</option>
                                @endforeach
                            </select>
                            <label>Target Currency</label>
                        </div>
                        <div class="col s12 center-align">
                            <button type="submit" class="waves-effect waves-light btn"> Search </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
        <div class="card-panel">
            <div class="row">
                @if(isset($result))
                    <div class="col s12 center-align">
                        <h2>Results</h2>
                    </div>
                    <div class="col s6 center-align">
                        <h3>Base Currency</h3>
                        <span class="grey-text">{{ $base }} 1.00</span>
                    </div>
                    <div class="col s6 center-align">
                        <h3>Target Currency</h3>
                        <span class="grey-text">{{ $target }} {{ $result }}</span>
                        <p><a href="#modal1">Show rate history</a></p>
                    </div>
                    <div class="col s12 center-align more-currency">
                        <a href="#!">Show other currencies <i class="fa fa-caret-down"></i></a>
                    </div>
                        <!-- Modal Structure -->
                    <div id="modal1" class="modal">
                        <div class="my-wrapper">
                            <h3 class="center-align">History</h3>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Rate</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($history as $h)
                                    <tr>
                                        <td>{{ $target }} {{ $h->rate }}</td>
                                        <td>{{ $h->created_at->diffForHumans() }}

                                        </td>
                                    @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="col s12 center-align">
                        <p class="red-text"><i class="fa fa-frown-o"></i> No Conversion has been made yet</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
@endsection