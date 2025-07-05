@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="bg-white py-16">
    <div class="container mx-auto flex flex-col md:flex-row items-center px-6 gap-8">
        <div class="md:w-1/2">
            <img src="{{ asset('images/dekorasi.jpg') }}" alt="Dekorasi" class="rounded-3xl shadow-xl w-full max-w-md mx-auto">
        </div>
        <div class="md:w-1/2 text-center md:text-left">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                Membuat agar acara <span id="dynamic-text" class="text-pink-600"></span><br>
                Anda menjadi lebih spesial
            </h1>
            <p class="text-gray-600 text-lg">Kami siap mewujudkan dekorasi impian Anda sesuai dengan tema dan keinginan Anda.</p>
        </div>
    </div>
</section>

<!-- Kenapa Memilih Kami -->
<section class="bg-gray-100 py-16">
    <div class="container mx-auto px-6">
        <h2 class="text-2xl font-bold text-center mb-10 text-gray-800">Kenapa memilih dekorasi bersama kami?</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 text-center">
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <i class="fas fa-clock fa-2x text-pink-600 mb-4"></i>
                <h3 class="font-bold text-lg text-gray-800">Pengantaran Tepat Waktu</h3>
                <p class="text-gray-600">Kami selalu mengutamakan waktu dan ketepatan pengiriman dekorasi.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <i class="fas fa-users fa-2x text-pink-600 mb-4"></i>
                <h3 class="font-bold text-lg text-gray-800">Tim yang Handal</h3>
                <p class="text-gray-600">Dikerjakan oleh tim profesional dengan pengalaman tinggi di bidang dekorasi.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <i class="fas fa-brush fa-2x text-pink-600 mb-4"></i>
                <h3 class="font-bold text-lg text-gray-800">Desain Kreatif</h3>
                <p class="text-gray-600">Dekorasi yang unik dan dapat disesuaikan sesuai dengan tema acara Anda.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <i class="fas fa-gift fa-2x text-pink-600 mb-4"></i>
                <h3 class="font-bold text-lg text-gray-800">Harga Terjangkau</h3>
                <p class="text-gray-600">Paket dekorasi lengkap dengan harga bersaing dan sesuai budget Anda.</p>
            </div>
        </div>
    </div>
</section>

<!-- Jenis Acara -->
<section class="bg-white py-16">
    <div class="container mx-auto px-6">
        <h2 class="text-2xl font-bold text-center mb-10 text-gray-800">Jenis Acara Spesial Anda</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            <div class="bg-gray-100 rounded-xl overflow-hidden shadow hover:shadow-xl transition">
                <img src="{{ asset('images/sweetseventeen.jpg') }}" alt="Sweet Seventeen" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-gray-800">Sweet Seventeen</h3>
                    <p class="text-gray-600 mt-2">Acara sweet 17 merupakan momen yang menunjukkan bahwa Anda sudah dewasa. Jadikan hari spesial ini tak terlupakan bersama dekorasi kami.</p>
                </div>
            </div>
            <div class="bg-gray-100 rounded-xl overflow-hidden shadow hover:shadow-xl transition">
                <img src="{{ asset('images/wedding.jpg') }}" alt="Wedding" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-gray-800">Pernikahan</h3>
                    <p class="text-gray-600 mt-2">Momen pernikahan Anda adalah awal cerita baru. Biarkan kami hias hari bahagia Anda dengan keindahan yang tak terlupakan.</p>
                </div>
            </div>
            <div class="bg-gray-100 rounded-xl overflow-hidden shadow hover:shadow-xl transition">
                <img src="{{ asset('images/grandopening.jpg') }}" alt="Grand Opening" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-gray-800">Grand Opening</h3>
                    <p class="text-gray-600 mt-2">Tampilkan kesan pertama yang profesional dan meriah di acara pembukaan bisnis Anda bersama dekorasi terbaik dari kami.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Script untuk animasi teks -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const words = ['ulang tahun', 'wedding', 'grand opening', 'birthday', 'proposal'];
        let index = 0;
        const el = document.getElementById('dynamic-text');

        const changeText = () => {
            el.classList.remove('opacity-100');
            el.classList.add('opacity-0');
            setTimeout(() => {
                el.textContent = words[index];
                el.classList.remove('opacity-0');
                el.classList.add('opacity-100');
                index = (index + 1) % words.length;
            }, 300);
        };

        setInterval(changeText, 2000);
    });
</script>

<style>
    #dynamic-text {
        transition: opacity 0.3s ease;
        display: inline-block;
    }

    .opacity-0 {
        opacity: 0;
    }

    .opacity-100 {
        opacity: 1;
    }
</style>
@endsection
