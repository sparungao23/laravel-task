@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        My Expenses
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Expense Categories</th>
                        <th>Total</th>
                    </tr>
                    @foreach($expensesSummary as $inc)
                        <tr>
                            <th>{{ $inc['name'] }}</th>
                            <td>{{ number_format($inc['amount'], 2) }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="col">
<div id="piechart"></div>

            </div>    
        </div>
    </div>
</div>
@endsection

@section('scripts')