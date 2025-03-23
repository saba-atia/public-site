@extends('public_site.layouts.welcome')
@section('title', 'Booking')

@section('content')
<!-- Popup for Success/Error Messages -->
@if(session('success'))
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ session('success') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endif

@if(session('error'))
<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Error</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ session('error') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endif

<div class="back_re">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title">
                    <h2>Book Your Stay</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- عرض تفاصيل الغرفة إذا تم تحديدها -->
@if(isset($room))
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                 <center>   <img src="{{ asset('images/' . $room->image) }}" alt="{{ $room->name }}" class="img-fluid"> 
                   <h3 class="card-title">{{ $room->name }}</h3> 
                    <p class="card-text">{{ $room->description }}</p>
                    <p class="card-text"><strong>Price: ${{ $room->price }}</strong></p>
                    <p class="card-text"><strong>Room Type:</strong> {{ ucfirst($room->room_type) }}</p>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#bookingModal{{ $room->id }}">Book Now</button>                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Booking Modal -->
@if(isset($room))
<div class="modal fade" id="bookingModal{{ $room->id }}" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel{{ $room->id }}" aria-hidden="true">    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalLabel{{ $room->id }}">Book {{ $room->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('booking.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $room->id }}">
                    <input type="hidden" name="room_price" id="room_price" value="{{ $room->price }}">
                    <div class="form-group">
                        <label for="date">Check-in Date</label>
                        <input type="date" name="booking_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="time">Check-in Time</label>
                        <input type="time" name="booking_time" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Additional Services</label>
                        <div>
                            <input type="checkbox" name="breakfast" value="1" data-price="10"> Breakfast (+$10)<br>
                            <input type="checkbox" name="lunch" value="1" data-price="15"> Lunch (+$15)<br>
                            <input type="checkbox" name="dinner" value="1" data-price="20"> Dinner (+$20)<br>
                            <input type="checkbox" name="room_service" value="1" data-price="5"> Room Service (+$5)<br>
                            <input type="checkbox" name="parking" value="1" data-price="8"> Parking (+$8)<br>
                            <input type="checkbox" name="wifi" value="1" data-price="0"> Free Wi-Fi (+$0)<br>
                            <input type="checkbox" name="gym" value="1" data-price="12"> Gym Access (+$12)<br>
                            <input type="checkbox" name="pool" value="1" data-price="7"> Pool Access (+$7)<br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Total Price</label>
                        <input type="text" id="total_price" name="total_price" class="form-control" readonly>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Confirm Booking</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

<!-- My Bookings Section -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h2>My Bookings</h2>
            @if(auth()->check())
                @if($bookings->isEmpty())
                    <p>You have no bookings yet.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Booking Date</th>
                                <th>Booking Time</th>
                                <th>Additional Services</th>
                                <th>Total Price</th> <!-- العمود الجديد -->
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->booking_date }}</td>
                                    <td>{{ $booking->booking_time }}</td>
                                    <td>
                                        @if($booking->breakfast) Breakfast<br> @endif
                                        @if($booking->lunch) Lunch<br> @endif
                                        @if($booking->dinner) Dinner<br> @endif
                                        @if($booking->room_service) Room Service<br> @endif
                                        @if($booking->parking) Parking<br> @endif
                                        @if($booking->wifi) Free Wi-Fi<br> @endif
                                        @if($booking->gym) Gym Access<br> @endif
                                        @if($booking->pool) Pool Access<br> @endif
                                    </td>
                                    <td>${{ $booking->total_price }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($booking->status == 'confirmed') badge-success
                                            @elseif($booking->status == 'pending') badge-warning
                                            @elseif($booking->status == 'cancelled') badge-danger
                                            @endif">
                                            {{ $booking->status }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($booking->status == 'pending')
                                            <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            @else
                <p>You need to login to view your bookings.</p>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
   document.addEventListener('DOMContentLoaded', function() {
    const roomPrice = parseFloat(document.getElementById('room_price').value);
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    const totalPriceInput = document.getElementById('total_price');

    function updateTotalPrice() {
        let totalPrice = roomPrice;
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                totalPrice += parseFloat(checkbox.dataset.price);
            }
        });
        totalPriceInput.value = totalPrice.toFixed(2); // تحديث السعر بدون علامة الدولار
    }

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateTotalPrice);
    });

    updateTotalPrice(); // تحديث السعر عند تحميل الصفحة
});

</script>
@endpush