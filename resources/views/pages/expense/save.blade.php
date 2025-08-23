@extends('layouts.app')

@section('title', isset($expense) ? 'Edit Expense' : 'Create Expense')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="mb-0">
                                {{ isset($expense) ? 'Edit Expense' : 'Create Expense' }}
                            </h4>
                            <a href="{{ route('expenses.index') }}" class="btn btn-primary">Expense List</a>
                        </div>

                        <form
                            action="{{ isset($expense) ? route('expenses.update', $expense->id) : route('expenses.store') }}"
                            method="POST">
                            @csrf
                            @if (isset($expense))
                                @method('PUT')
                            @endif

                            <div class="mb-3">
                                <label for="category_id" class="form-label">Select a Category</label>
                                <select class="form-select" name="category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', isset($expense) ? $expense->category_id : '') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title"
                                    value="{{ old('title', isset($expense) ? $expense->title : '') }}" class="form-control"
                                    id="title">
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" name="amount"
                                    value="{{ old('amount', isset($expense) ? $expense->amount : '') }}" min="1"
                                    class="form-control" id="amount">
                                @error('amount')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" name="date"
                                    value="{{ old('date', isset($expense) ? $expense->date->format('Y-m-d') : '') }}"
                                    class="form-control" id="date" max="{{ now()->format('Y-m-d') }}">

                                @error('date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">
                                {{ isset($expense) ? 'Update' : 'Create' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
