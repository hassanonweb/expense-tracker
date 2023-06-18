<!-- resources/views/expenses/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Create Expense</h1>

        <!-- Display form errors if available -->
        @if ($errors->any())
            <div class="bg-red-200 text-red-800 px-4 py-2 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Expense creation form -->
        <form action="{{ route('expenses.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block font-medium">Name:</label>
                <input type="text" name="name" id="name" class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border rounded-md">
            </div>
            <div class="mb-4">
                <label for="amount" class="block font-medium">Amount:</label>
                <input type="number" name="amount" id="amount" class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border rounded-md">
            </div>
            <div class="mb-4">
                <label for="category_id" class="block font-medium">Category:</label>
                <select name="category_id" id="category_id" class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border rounded-md">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="payment_method_id" class="block font-medium">Payment Method:</label>
                <select name="payment_method_id" id="payment_method_id" class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border rounded-md">
                    <option value="">Select Payment Method</option>
                    @foreach ($paymentMethods as $paymentMethod)
                        <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="frequency_option_id" class="block font-medium">Frequency:</label>
                <select name="frequency_option_id" id="frequency_option_id" class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border rounded-md">
                    <option value="">Select Frequency</option>
                    @foreach ($frequencyOptions as $frequencyOption)
                        <option value="{{ $frequencyOption->id }}">{{ $frequencyOption->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="description" class="block font-medium">Description:</label>
                <textarea name="description" id="description" rows="4" class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border rounded-md"></textarea>
            </div>
            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create Expense</button>
            </div>
        </form>
    </div>
@endsection
