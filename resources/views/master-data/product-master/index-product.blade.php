<style>
  .totoijo {
    background-color: green;
    height: auto;
    margin-bottom: 10px;
  }
</style>

<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <!-- fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">



  <div class="container p-4 mx-auto">
    <div class="overflow-x-auto">

      @if(session('success'))
      <div class="bg-green-500 text-white p-3 rounded mb-4">
      {{ session('success') }}
      </div>
    @endif

      @if(session('error'))
      <div class="bg-red-500 text-white p-3 rounded mb-4">
      {{ session('error') }}
      </div>
    @endif


      <a href="{{ route('tambah-barang')}}">
        <button
          class="px-6 py-4 text-white bg-green-500 border border-green-500 rounded-lg shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 totoijo">
          <i class="fa-solid fa-plus"></i> Add product data
        </button>
      </a>
      <a href="{{ route('product-export-excel')}}">
        <button
          class="px-6 py-4 text-white bg-turquoise-500 border border-turquoise-500 rounded-lg shadow-lg hover:bg-turquoise-600 focus:outline-none focus:ring-2 focus:ring-turquoise-500 totoijo">
          <i class="fa-solid fa-print"></i> Export Data
        </button>
      </a>
      <table class="min-w-full border border-collapse border-gray-200">
        <thead>
          <tr class="bg-gray-100">
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">ID</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Product Name</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Unit</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Type</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">information</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">qty</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">producer</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Aksi</th>
          </tr>
        </thead>
        <tbody>

          @foreach ($product as $product)
        <tr class="bg-white">
        <td class="px-4 py-2 border border-gray-200">{{ $product->id }}</td>
        <td class="border border-gray-200 px-4 y-2 hover:text-blue-500 hover:underline">
          <a href="{{ route('product-detail', $product->id)}}">
          {{$product->product_name}}
          </a>
        </td>
        <td class="px-4 py-2 border border-gray-200">{{ $product->unit }}</td>
        <td class="px-4 py-2 border border-gray-200">{{ $product->type }}</td>
        <td class="px-4 py-2 border border-gray-200">{{ $product->information }}</td>
        <td class="px-4 py-2 border border-gray-200">{{ $product->qty }}</td>
        <td class="px-4 py-2 border border-gray-200">{{ $product->producer }}</td>
        <td class="px-4 py-2 border border-gray-200">
          <a href="{{ route('product-edit', $product->id) }}" class="px-2 text-blue-600 hover:text-blue-800"><i
            class="fa-solid fa-pencil"></i></a>
          <button class="px-2 text-red-600 hover:text-red-800"
          onclick="confirmDelete('{{  route('product-deleted', $product->id) }}')"><i
            class="fa-solid fa-trash-can"></i></button>
        </td>
        </tr>
      @endforeach


          <!-- Tambahkan baris lainnya sesuai kebutuhan -->
        </tbody>
      </table>
    </div>
  </div>


  <script>
    function confirmDelete(deleteUrl) {
      if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        // Jika user mengonfirmasi, kita dapat membuat form dan mengirimkan permintaan delete
        let form = document.createElement('form');
        form.method = 'POST';
        form.action = deleteUrl;

        // Tambahkan CSRF token
        let csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfInput);

        // Tambahkan method spoofing untuk DELETE (karena HTML form hanya mendukung GET dan POST)
        let methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);

        // Tambahkan form ke body dan submit
        document.body.appendChild(form);
        form.submit();
      }
    }
  </script>




</x-app-layout>