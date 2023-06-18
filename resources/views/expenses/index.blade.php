<!-- resources/views/expenses/index.blade.php -->

@extends('layouts.app')


@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Expense Tracker</h1>

        <!-- Display success or error messages if available -->
        @if(session('success'))
            <div class="bg-green-200 text-green-800 px-4 py-2 mb-4">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-200 text-red-800 px-4 py-2 mb-4">{{ session('error') }}</div>
        @endif

        <!-- Display expenses table -->
        <table class="table-auto w-full text-center">
            <thead>
                <tr>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Amount</th>
                    <th class="px-4 py-2">Category</th>
                    <th class="px-4 py-2">Payment Method</th>
                    <th class="px-4 py-2">Frequency</th>
                    <th class="px-4 py-2">Description</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody class="border">
                @foreach($expenses as $expense)
                    <tr>
                        <td class="px-4 py-2">{{ $expense->name }}</td>
                        <td class="px-4 py-2">{{ $expense->amount }}</td>
                        <td class="px-4 py-2">{{ $expense->category->name }}</td>
                        <td class="px-4 py-2">{{ $expense->paymentMethod->name }}</td>
                        <td class="px-4 py-2">{{ $expense->frequencyOption->name }}</td>
                        <td class="px-4 py-2">{{ $expense->description ? $expense->desciption : "-" }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('expenses.edit', $expense->id) }}" class="bg-blue-400 text-white p-2 rounded-sm">Edit</a>
                            <form class="inline-block" action="{{ route('expenses.destroy', $expense->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-400 text-white p-2 rounded-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Add New Expense button -->
        <div class="mt-4">
            <a href="{{ route('expenses.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add New Expense</a>
        </div>
    </div>
@endsection
@section('subContent')
<h1 class="text-center mt-2">Your Total Spending: <span class="text-red-700">{{$totalSpending}} </span></h1>
<br />

<div class="flex justify mt-8 mb-8">
<form action="{{ route('expenses.generate-report') }}" method="POST">
            @csrf
            <div class="flex">
                <div class="flex mb-4">
                <label for="category_id" class="block font-medium mr-2">Category:</label>
                <select name="category_id" id="category_id" class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 block sm:text-sm border rounded-md">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                </div>
            <div class="flex mb-4 ml-4">
                <label for="payment_method_id" class="block font-medium mr-2">Payment Method:</label>
                <select name="payment_method_id" id="payment_method_id" class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 block sm:text-sm border rounded-md">
                    <option value="">All Payment Methods</option>
                    @foreach ($paymentMethods as $paymentMethod)
                        <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex mb-4 ml-4">
                <label for="frequency_option_id" class="block font-medium mr-2">Frequency:</label>
                <select name="frequency_option_id" id="frequency_option_id" class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 block sm:text-sm border rounded-md">
                    <option value="">All Frequencies</option>
                    @foreach ($frequencyOptions as $frequencyOption)
                        <option value="{{ $frequencyOption->id }}">{{ $frequencyOption->name }}</option>
                    @endforeach
                </select>
            </div>
            </div>
        
            <div class="mb-4">
<!-- Add the View Report button -->
<a href="{{ route('expenses.view-report') }}" id="view-report" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded ml-2">View Report</a>
            </div>
</form>
</div>

@endsection