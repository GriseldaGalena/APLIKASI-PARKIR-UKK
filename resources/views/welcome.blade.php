<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SiParkir - Sistem Parkir Digital</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<style>
  html {
    scroll-behavior: smooth;
  }

  .reveal {
    opacity: 0;
    transform: translateY(40px);
    transition: all 1s ease;
  }

  .reveal.active {
    opacity: 1;
    transform: translateY(0);
  }

  .reveal.delay-1 { transition-delay: 0.3s; }
  .reveal.delay-2 { transition-delay: 0.6s; }
  .reveal.delay-3 { transition-delay: 0.9s; }
</style>


<body class="bg-gray-50 text-gray-800">

  <!-- Navbar -->
  <nav class="fixed w-full z-10 backdrop-blur bg-white/70 border-b border-white/40">
  <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">

    <!-- Branding -->
    <div class="flex items-center gap-10">
      <div class="flex items-center gap-4">
      <h1 class="text-2xl font-extrabold">
          <span class="text-blue-600">Si</span>
          <span class="text-gray-700">Parkir</span>
        </h1>
      </div>

    <div class="hidden md:flex items-center gap-6 text-gray-600 font-medium">
        <a href="#fitur" class="hover:text-blue-600 transition">Fitur</a>
        <a href="#hak-akses" class="hover:text-blue-600 transition">Hak Akses</a>
      </div>
    </div>

    <!-- Login Button -->
    <a href="/login"
       class="px-6 py-2.5 rounded-full bg-blue-600 text-white font-semibold shadow hover:bg-blue-700 hover:scale-105 transition">
      Login
    </a>

  </div>
</nav>



  <!-- Hero -->
  <section class="reveal pt-32 pb-24 bg-gray-900 text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-blue-600/30 to-purple-600/30"></div>
    <div class="relative max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
      <div>
        <span class="inline-block mb-4 px-4 py-1 rounded-full bg-white/10 text-sm">
          UKK RPL Project
        </span>
        <h2 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
          Kelola Parkir<br>
          <span class="text-blue-400">Lebih Cepat & Terstruktur</span>
        </h2>
        <p class="mb-8 text-gray-300 text-lg">
        SiParkir membantu pencatatan, pemantauan, dan laporan parkir secara real-time dalam satu sistem terintegrasi.
        </p>
        <div class="flex gap-4">
          <a href="/login" class="px-7 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 font-semibold">Mulai Sekarang</a>
          <a href="#fitur" class="px-7 py-3 rounded-xl border border-white/30 hover:bg-white/10">Lihat Fitur</a>
        </div>
      </div>

      <div class="hidden md:flex justify-center">
        <div class="bg-white/10 backdrop-blur rounded-3xl p-6 shadow-2xl">
          <img src="{{ asset('image/parking.png') }}" alt="Ilustrasi Sistem Parkir" class="w-96 object-contain">
        </div>
      </div>
    </div>
  </section>

  <!-- Fitur -->
  <section id="fitur" class="reveal py-24 bg-gradient-to-b from-gray-50 to-blue-50">
  <div class="max-w-7xl mx-auto px-6">

    <!-- Heading -->
    <div class="text-center mb-16">
      <span class="inline-block mb-3 px-4 py-1 rounded-full bg-blue-100 text-blue-600 text-sm font-medium">
        Fitur Utama
      </span>
      <h3 class="text-3xl md:text-4xl font-extrabold text-gray-800">
        Apa yang Bisa Dilakukan <span class="text-blue-600">SiParkir</span>
      </h3>
      <p class="mt-4 text-gray-600 max-w-2xl mx-auto">
        Semua kebutuhan pengelolaan parkir dirancang dalam satu sistem
        yang cepat, rapi, dan mudah digunakan.
      </p>
    </div>

    <!-- Cards -->
    <div class="grid md:grid-cols-3 gap-10">

      <!-- Card 1 -->
      <div class="reveal delay-1 bg-white/90 backdrop-blur p-8 rounded-3xl shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
        <div class="w-14 h-14 mb-6 rounded-2xl bg-blue-100 flex items-center justify-center text-blue-600 text-2xl">
          🚗
        </div>
        <h4 class="text-xl font-semibold mb-3 text-gray-800">
          Manajemen Kendaraan
        </h4>
        <p class="text-gray-600 leading-relaxed">
          Mengelola data kendaraan masuk dan keluar secara real-time
          berdasarkan plat nomor dan jenis kendaraan.
        </p>
      </div>

      <!-- Card 2 -->
      <div class="reveal delay-2 bg-white/90 backdrop-blur p-8 rounded-3xl shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
        <div class="w-14 h-14 mb-6 rounded-2xl bg-emerald-100 flex items-center justify-center text-emerald-600 text-2xl">
          💳
        </div>
        <h4 class="text-xl font-semibold mb-3 text-gray-800">
          Transaksi Otomatis
        </h4>
        <p class="text-gray-600 leading-relaxed">
          Perhitungan durasi dan biaya parkir dilakukan otomatis
          berdasarkan tarif yang telah ditentukan.
        </p>
      </div>

      <!-- Card 3 -->
      <div class="reveal delay-3 bg-white/90 backdrop-blur p-8 rounded-3xl shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
        <div class="w-14 h-14 mb-6 rounded-2xl bg-indigo-100 flex items-center justify-center text-indigo-600 text-2xl">
          📊
        </div>
        <h4 class="text-xl font-semibold mb-3 text-gray-800">
          Laporan & Area Parkir
        </h4>
        <p class="text-gray-600 leading-relaxed">
          Mengelola area parkir, kapasitas, serta laporan transaksi
          untuk admin dan pemilik usaha.
        </p>
      </div>

    </div>
  </div>
</section>

  <!-- Role -->
  <section id="hak-akses" class="reveal py-24 bg-gray-900 text-white relative overflow-hidden">
  
  <!-- Background Accent -->
  <div class="absolute inset-0 bg-gradient-to-br from-blue-600/10 to-indigo-600/10"></div>

  <div class="relative max-w-7xl mx-auto px-6">

    <!-- Heading -->
    <div class="text-center mb-16">
      <span class="inline-block mb-3 px-4 py-1 rounded-full bg-white/10 text-sm text-gray-300">
        Role Management
      </span>
      <h3 class="text-3xl md:text-4xl font-extrabold">
        Hak Akses <span class="text-blue-400">Pengguna</span>
      </h3>
      <p class="mt-4 text-gray-400 max-w-2xl mx-auto">
        Setiap pengguna memiliki hak akses berbeda sesuai peran
        untuk menjaga keamanan dan efisiensi sistem.
      </p>
    </div>

    <!-- Cards -->
    <div class="grid md:grid-cols-3 gap-10 text-center">

      <!-- Admin -->
      <div class="reveal delay-1 bg-gray-800/80 backdrop-blur p-8 rounded-3xl border border-white/10 shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
        <div class="w-14 h-14 mx-auto mb-6 rounded-2xl bg-blue-500/10 text-blue-400 flex items-center justify-center text-2xl">
          🛠️
        </div>
        <h4 class="text-xl font-semibold mb-3 text-blue-400">Admin</h4>
        <p class="text-gray-300 leading-relaxed">
          Mengelola pengguna, tarif, area parkir, serta memantau
          aktivitas sistem secara keseluruhan.
        </p>
      </div>

      <!-- Petugas -->
      <div class="reveal delay-2 bg-gray-800/80 backdrop-blur p-8 rounded-3xl border border-white/10 shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
        <div class="w-14 h-14 mx-auto mb-6 rounded-2xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center text-2xl">
          👮
        </div>
        <h4 class="text-xl font-semibold mb-3 text-emerald-400">Petugas</h4>
        <p class="text-gray-300 leading-relaxed">
          Mencatat kendaraan masuk dan keluar, mengelola transaksi,
          serta mencetak struk parkir.
        </p>
      </div>

      <!-- Owner -->
      <div class="reveal delay-3 bg-gray-800/80 backdrop-blur p-8 rounded-3xl border border-white/10 shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
        <div class="w-14 h-14 mx-auto mb-6 rounded-2xl bg-amber-500/10 text-amber-400 flex items-center justify-center text-2xl">
          📈
        </div>
        <h4 class="text-xl font-semibold mb-3 text-amber-400">Owner</h4>
        <p class="text-gray-300 leading-relaxed">
          Memantau laporan transaksi dan pendapatan parkir
          secara real-time tanpa mengubah data.
        </p>
      </div>

    </div>
  </div>
</section>


  <!-- Tentang -->
<section class="reveal py-24 bg-gradient-to-b from-blue-50 to-indigo-50 relative overflow-hidden">

<!-- Accent -->
<div class="absolute inset-0 bg-gradient-to-br from-blue-600/10 to-indigo-600/10"></div>

<div class="relative max-w-5xl mx-auto px-6">
  <div class="bg-white/90 backdrop-blur p-12 rounded-3xl shadow-xl text-center">

    <span class="inline-block mb-4 px-4 py-1 rounded-full bg-blue-100 text-blue-600 text-sm font-medium">
      Tentang Aplikasi
    </span>

    <h3 class="text-3xl md:text-4xl font-extrabold mb-6 text-gray-800">
      Apa Itu <span class="text-blue-600">SiParkir</span>?
    </h3>

    <p class="text-lg text-gray-600 leading-relaxed">
      <span class="font-semibold text-gray-800">SiParkir</span> adalah aplikasi sistem parkir berbasis web
      yang dikembangkan sebagai project <span class="font-medium">UKK RPL</span>.
      Aplikasi ini menerapkan konsep <span class="font-medium">CRUD</span>,
      relasi database, multi user role, serta laporan transaksi
      untuk mendukung pengelolaan parkir yang lebih terstruktur dan efisien.
    </p>

  </div>
</div>
</section>



  <!-- CTA -->
  <section class="reveal py-24 bg-gray-900 text-white text-center relative overflow-hidden">

  <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 to-indigo-600/20"></div>

  <div class="relative max-w-3xl mx-auto px-6">
    <h3 class="text-3xl md:text-4xl font-extrabold mb-6">
      Siap Menggunakan <span class="text-blue-400">SiParkir</span>?
    </h3>

    <p class="mb-10 text-gray-300 text-lg">
      Masuk ke sistem dan mulai kelola parkir dengan
      lebih cepat, rapi, dan efisien.
    </p>

    <a href="{{ route('login') }}"
       class="inline-block px-10 py-3.5 rounded-full bg-blue-600 text-white font-semibold shadow-lg hover:bg-blue-700 transition">
      Masuk ke Aplikasi
    </a>
  </div>

</section>


  <!-- Footer -->
  <footer class="bg-gray-900 text-gray-400 py-8">
  <div class="max-w-7xl mx-auto px-6 text-center">

    <h4 class="text-lg font-semibold text-white mb-2">
      <span class="text-blue-500">Si</span>Parkir
    </h4>

    <p class="text-sm">
      © 2026 SiParkir · Project UKK RPL
    </p>

  </div>
</footer>

<script>
  const reveals = document.querySelectorAll('.reveal');

  function revealOnScroll() {
    reveals.forEach(el => {
      const windowHeight = window.innerHeight;
      const elementTop = el.getBoundingClientRect().top;

      if (elementTop < windowHeight - 100) {
        el.classList.add('active');
      }
    });
  }

  window.addEventListener('scroll', revealOnScroll);
  revealOnScroll();
</script>

</body>
</html>
