@extends('layouts.app')

@section('content')
<div class="bg-white py-10">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800">Hubungi Kami</h1>
            <p class="mt-2 text-gray-600">Kami siap membantu Anda untuk mengirim bunga segar di setiap momen spesial Anda.</p>
        </div>

        <!-- Info dan Maps -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center mb-12">
            <!-- Info Toko -->
            <div class="bg-pink-100 rounded-lg p-6 shadow-md">
                <h2 class="text-2xl font-bold text-pink-700 mb-4">Toko Bunga Kimberly Florist</h2>
                <p class="text-gray-700 mb-2">
                    <i class="fas fa-map-marker-alt text-pink-600 mr-2"></i>
                    Jl. Mawar Indah No. 123, Kebayoran Baru, Jakarta Selatan
                </p>
                <p class="text-gray-700 mb-2">
                    <i class="fas fa-phone-alt text-pink-600 mr-2"></i>
                    +62 812-3456-7890
                </p>
                <p class="text-gray-700 mb-4">
                    <i class="fas fa-envelope text-pink-600 mr-2"></i>
                    info@kimberlyflorist.com
                </p>
                <a href="https://wa.me/6281234567890" target="_blank" class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition">
                    <i class="fab fa-whatsapp mr-2"></i> Chat via WhatsApp
                </a>
            </div>

            <!-- Maps -->
            <div class="rounded-lg overflow-hidden shadow-md">
                <iframe class="w-full h-80 rounded-lg" frameborder="0" style="border:0"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126918.57907054406!2d106.68943143794843!3d-6.2297281227404585!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f1c436dcce7f%3A0xa009df20b42ad7a0!2sKebayoran%20Baru%2C%20Jakarta%20Selatan!5e0!3m2!1sid!2sid!4v1686000000000"
                    allowfullscreen>
                </iframe>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="bg-gray-50 p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Kirim Pesan ke Kami</h2>

            <form action="#" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-600 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" id="name" required
                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 ring-pink-300" />
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-600 mb-2">Email</label>
                        <input type="email" name="email" id="email" required
                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 ring-pink-300" />
                    </div>
                    <div class="md:col-span-2">
                        <label for="message" class="block text-sm font-semibold text-gray-600 mb-2">Pesan</label>
                        <textarea name="message" id="message" rows="5" required
                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 ring-pink-300"></textarea>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit"
                        class="px-6 py-2 bg-pink-600 hover:bg-pink-700 text-white font-semibold rounded-md transition">
                        Kirim Pesan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
