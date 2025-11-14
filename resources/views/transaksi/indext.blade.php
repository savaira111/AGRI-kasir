@extends('layouts.app')

@section('content')
<div class="flex-grow-1 p-4">

    <!-- 🔍 Search Bar -->
    <div class="d-flex justify-content-center align-items-center mb-4">
        <div class="input-group" style="width: 1000px;">
            <span class="input-group-text" style="background-color: #C0EBA6; border: none; border-radius: 20px 0 0 20px;">
                <i class="bi bi-search" style="color: #333;"></i>
            </span>
            <input type="text" class="form-control" placeholder="Search transaction..." 
                   style="background-color: #C0EBA6; border: none; color: #333;">
            <span class="input-group-text" style="background-color: #C0EBA6; border: none; border-radius: 0 20px 20px 0;">
                <img src="{{ asset('image/profile.png') }}" alt="Profile"
                     style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; border: 2px solid white;">
            </span>
        </div>
    </div>

    <!-- 🟡 Button to Add Transaction -->
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('transactions.create') }}" 
           class="btn btn-warning fw-bold d-flex align-items-center"
           style="color: #000000; border-radius: 12px;">
            <i class="bi bi-plus-circle me-1"></i> Add Transaction
        </a>
    </div>

    <!-- 🧾 Transactions Table -->
    <div class="mt-4 bg-light p-3 rounded shadow-sm">
        <table class="table table-bordered text-center align-middle" style="background-color: #C0EBA6;">
            <thead>
                <tr>
                    <th style="background-color: #7FB176; color: #fafafa;">No</th>
                    <th style="background-color: #7FB176; color: #fafafa;">Transaction Code</th>
                    <th style="background-color: #7FB176; color: #fafafa;">Customer Name</th>
                    <th style="background-color: #7FB176; color: #fafafa;">Product</th>
                    <th style="background-color: #7FB176; color: #fafafa;">Quantity</th>
                    <th style="background-color: #7FB176; color: #fafafa;">Total Price</th>
                    <th style="background-color: #7FB176; color: #fafafa;">Date</th>
                    <th style="background-color: #7FB176; color: #fafafa;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->transaction_code }}</td>
                        <td>{{ $item->customer_name }}</td>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ number_format($item->total_price, 2) }}</td>
                        <td>{{ $item->created_at->format('d M Y') }}</td>
                        <td class="text-center align-middle" style="white-space: nowrap;">
                            <div class="d-flex justify-content-center gap-2">
                                <!-- View -->
                                <a href="{{ route('transactions.show', $item->id) }}" class="btn btn-sm" style="background-color: #FCCD2A;">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <!-- Edit -->
                                <a href="{{ route('transactions.edit', $item->id) }}" class="btn btn-sm" style="background-color: #FCCD2A;">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <!-- Delete -->
                                <form action="{{ route('transactions.destroy', $item->id) }}" method="POST" 
                                      onsubmit="return confirm('Are you sure to delete this transaction? 🌿');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm" style="background-color: #FCCD2A;">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-muted">No transactions found 🌱</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
