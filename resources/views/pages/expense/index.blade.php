@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">

                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="mb-0">Expense List</h4>
                            <div>
                                <a href="{{ route('expenses.monthly-summary') }}" class="btn btn-primary">Monthly Expense</a>
                                <a href="{{ route('expenses.create') }}" class="btn btn-primary">Create Expense</a>
                            </div>

                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Expense Date</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($expenses as $key => $expense)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $expense->category->name }}</td>
                                        <td>{{ $expense->title }}</td>
                                        <td>৳ {{ $expense->amount }}</td>
                                        <td>{{ $expense->date->format('d M, Y') }}</td>
                                        <td>
                                            <div class="d-flex justify-content-end gap-2">
                                                <a class="btn btn-secondary btn-sm"
                                                    href="{{ route('expenses.edit', $expense->id) }}">Edit</a>
                                                <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </div>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="50" class="text-center">No Data Found</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        <div>{{ $expenses->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
