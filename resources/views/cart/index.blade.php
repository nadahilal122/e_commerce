
<!--
<h1>Shopping Cart</h1>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(!empty($cart))
    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Designation</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php $totals = 0; @endphp
            @foreach($cart as $id => $details)
                @php
                    $total = $details['quantity'] * $details['price'];
                    $totals += $total;
                @endphp
                <tr>
                    <td>
                        <img src="{{ asset('storage/' . $details['image']) }}" class="img-fluid w-100 rounded-top cart-image" alt="">
                    </td>
                    <td>{{ $details['designation'] }}</td>
                    <td>
                        <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="form-control quantity-input" data-id="{{ $id }}" style="width: 60px;">
                    </td>
                    <td>{{ $details['price'] }} DH</td>
                    <td>{{ $total }} DH</td>
                    <td>{{ $details['description'] }}</td>
                    <td>
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4" class="text-right"><strong>Total:</strong></td>
                <td colspan="3"><strong>{{ $totals }} DH</strong></td>
            </tr>
        </tbody>
    </table>
    <form action="{{ route('cart.order') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="mode_reglements_id">Mode de Règlement</label>
            <select name="mode_reglements_id" class="form-control">
                @foreach($mode_reglements as $mode_reglement)
                    <option value="{{ $mode_reglement->id }}">{{ $mode_reglement->mode_reglements }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="etat_id">État</label>
            <select name="etat_id" class="form-control">
                @foreach($etats as $etat)
                    <option value="{{ $etat->id }}">{{ $etat->etat }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Place Order</button>
    </form>
@else
    <p>Your cart is empty</p>
@endif

<style>
    .cart-image {
        width: 100px;
        height: 100px;
        object-fit: cover; /* Ensure the image is properly scaled */
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.quantity-input').on('change', function() {
            var id = $(this).data('id');
            var quantity = $(this).val();

            $.ajax({
                url: '{{ url("cart/update") }}/' + id,
                method: 'put',
                data: {
                    _token: '{{ csrf_token() }}',
                    quantity: quantity
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        });
    });
</script>
-->
@extends('layouts.interface')

@section('section')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Cart</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Cart</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Cart Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(!empty($cart))
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Products</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totals = 0; @endphp
                            @foreach($cart as $id => $details)
                                @php
                                    $total = $details['quantity'] * $details['price'];
                                    $totals += $total;
                                @endphp
                                <tr>
                                    <th scope="row">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/' . $details['image']) }}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                        </div>
                                    </th>
                                    <td>
                                        <p class="mb-0 mt-4">{{ $details['designation'] }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4">{{ $details['price'] }} DH</p>
                                    </td>
                                    <td>
                                        <div class="input-group quantity mt-4" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-minus rounded-circle bg-light border" data-id="{{ $id }}">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="number" name="quantity" class="form-control form-control-sm text-center border-0 quantity-input" value="{{ $details['quantity'] }}" min="1" data-id="{{ $id }}">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-plus rounded-circle bg-light border" data-id="{{ $id }}">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4">{{ $total }} DH</p>
                                    </td>
                                    <td>
                                        <form action="{{ route('cart.remove', $id) }}" method="POST" class="d-inline-block mt-4">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-md rounded-circle bg-light border">
                                                <i class="fa fa-times text-danger"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" class="text-right"><strong>Total:</strong></td>
                                <td colspan="2"><strong>{{ $totals }} DH</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded p-4">
                        <form action="{{ route('cart.order') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="mode_reglements_id">Mode de Règlement</label>
                                <select name="mode_reglements_id" class="form-control">
                                    @foreach($mode_reglements as $mode_reglement)
                                        <option value="{{ $mode_reglement->id }}">{{ $mode_reglement->mode_reglements }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="etat_id">État</label>
                                <select name="etat_id" class="form-control">
                                    @foreach($etats as $etat)
                                        <option value="{{ $etat->id }}">{{ $etat->etat }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase">Place Order</button>
                        </form>
                    </div>
                </div>
            @else
                <p>Your cart is empty</p>
            @endif
        </div>
    </div>
    <!-- Cart Page End -->

    <style>
        .cart-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.quantity-input').on('change', function() {
                var id = $(this).data('id');
                var quantity = $(this).val();

                $.ajax({
                    url: '{{ url("cart/update") }}/' + id,
                    method: 'put',
                    data: {
                        _token: '{{ csrf_token() }}',
                        quantity: quantity
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            });

            $('.btn-minus').on('click', function() {
                var id = $(this).data('id');
                var input = $('.quantity-input[data-id="' + id + '"]');
                var quantity = parseInt(input.val()) - 1;
                if (quantity < 1) {
                    quantity = 1;
                }
                input.val(quantity).trigger('change');
            });

            $('.btn-plus').on('click', function() {
                var id = $(this).data('id');
                var input = $('.quantity-input[data-id="' + id + '"]');
                var quantity = parseInt(input.val()) ;
                input.val(quantity).trigger('change');
            });
        });
    </script>
@endsection
