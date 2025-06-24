<div class="max-w-xl mx-auto py-10 px-6 bg-white rounded shadow dark:bg-gray-900 text-white">
    <h2 class="text-2xl font-bold mb-4">Pembayaran Booking</h2>

    @if (session()->has('success'))
        <div class="mb-4 text-green-500 font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <p class="mb-4">Lapangan: <strong>{{ $booking->lapangan->nama ?? '-' }}</strong></p>
    <p class="mb-4">Tanggal: <strong>{{ $booking->tanggal_booking }}</strong></p>
    <p class="mb-4">Waktu: <strong>{{ $booking->waktu_mulai }} - {{ $booking->waktu_selesai }}</strong></p>
    <p class="mb-6 text-lg font-semibold">Total yang harus dibayar:
        <span class="text-yellow-300 text-2xl">Rp {{ number_format($nominal, 0, ',', '.') }}</span>
    </p>

    <div class="text-center mt-6 bg-gray-100 dark:bg-gray-800 p-4 rounded shadow">
        <p class="text-gray-800 dark:text-gray-200 mb-2 font-medium">Silakan lakukan pembayaran ke QRIS berikut:</p>
        <img src="{{ asset('storage/image/qris.jpg') }}" alt="QRIS Code" class="mx-auto w-64 rounded shadow mb-4">
        <p class="text-sm text-gray-700 dark:text-gray-300">
            Nama: <strong>Mutiara Futsal</strong><br>
            Gunakan nominal sesuai jumlah di atas.<br>
            Setelah membayar, klik tombol di bawah untuk menyelesaikan proses.
        </p>
    </div>

    <button type="button" id="bayar-btn"
        class="mt-6 w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-semibold">
        Konfirmasi Pembayaran
    </button>
</div>

<!-- Midtrans Script -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('SB-Mid-client-0VqtZFWagdCwhN77') }}"></script>

<script>
    document.getElementById('bayar-btn').addEventListener('click', function() {
        snap.pay(@json($snapToken), {
            onSuccess: function (result) {
                Livewire.dispatch('paymentSuccess');
            },
            onPending: function (result) {
                console.log("pending", result);
            },
            onError: function (result) {
                console.error("error", result);
            }
        });
    });
</script>
