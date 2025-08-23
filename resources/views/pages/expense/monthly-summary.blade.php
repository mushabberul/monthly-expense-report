@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">

                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="mb-0">Monthly Expense Summary ({{ now()->format('F Y') }})</h4>
                            <a href="{{ route('expenses.index') }}" class="btn btn-primary">Back to Expense List</a>
                        </div>

                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Category</th>
                                    <th class="text-end">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expenses as $expense)
                                    <tr>
                                        <td>{{ $expense->category->name }}</td>
                                        <td class="text-end">৳ {{ $expense->total }}</td>
                                    </tr>
                                @endforeach
                                <tr class="fw-bold bg-light">
                                    <td>Total</td>
                                    <td class="text-end">৳ {{ number_format($total, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
