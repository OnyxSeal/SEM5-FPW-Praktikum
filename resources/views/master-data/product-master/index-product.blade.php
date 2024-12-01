<style>
    .paginationVal {
        display: flex;
        justify-content: center;
        align-items: center;
        list-style: none;
        padding: 0;
        margin: 20px 0;
        gap: 8px;
    }

    .paginationVal a,
    .paginationVal span {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 45px;
        height: 45px;
        font-size: 14px;
        font-weight: bold;
        color: #555;
        text-decoration: none;
        border-radius: 10px;
        background: linear-gradient(145deg, #ffffff, #d1d9e6);
        box-shadow: 3px 3px 6px #c2cad9, -3px -3px 6px #ffffff;
        transition: all 0.2s ease-in-out;
    }

    .paginationVal a:hover {
        background: linear-gradient(145deg, #d1d9e6, #ffffff);
        box-shadow: inset 3px 3px 6px #c2cad9, inset -3px -3px 6px #ffffff;
        color: #007bff;
        transform: translateY(-2px);
    }

    .paginationVal .activeVal {
        background: linear-gradient(145deg, #007bff, #0056b3);
        color: #fff;
        box-shadow: inset 3px 3px 6px #0056b3, inset -3px -3px 6px #007bff;
        pointer-events: none;
    }

    .paginationVal .disabledVal {
        background: #f0f0f0;
        color: #ccc;
        box-shadow: none;
        pointer-events: none;
    }

    .totoijo {
      background-color: green;
      height: auto;
      margin-bottom: 10px;
    }

    .btn-warningVal {
        margin: 2px;
        background-color: #ffc107;
        color: black;
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        border-radius: 0.25rem;
        border: 1px solid #ffc107;
        transition: background-color 0.2s ease-in-out;
    }
    .btn-warningVal:hover {
        background-color: #e0a800;
    }

    .btn-dangerVal {
        margin: 2px;
        background-color: #dc3545;
        color: white;
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        border-radius: 0.25rem;
        border: 1px solid #dc3545;
        transition: background-color 0.2s ease-in-out;
    }
    .btn-dangerVal:hover {
        background-color: #c82333;
    }

</style>

<x-app-layout>

  <!-- fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">



  <div class="container p-4 mx-auto">
    <d class="overflow-x-auto">

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

    <form method="GET" action="{{ route('product-index') }}" class="mb-4 flex items-center">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." class="w-1/4 rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
        <button type="submit" class="ml-2 rounded-lg bg-green-500 px-4 py-2 text-white shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">Cari</button>
    </form>

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
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Supplier Name</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($products as $product)
          <tr class="bg-white">
          <td class="px-4 py-2 border border-gray-200">{{ $product->id }}</td>
          <td class="border border-gray-200 px-4 y-2 hover:text-blue-500 hover:underline">
            <a href="{{ route('product-detail', $product->id)}}">
            {{$product->product_name}}
            </a>
          </td>
          <td class="px-1 py-1 border border-gray-200">{{ $product->unit }}</td>
          <td class="px-1 py-1 border border-gray-200">{{ $product->type }}</td>
          <td class="px-1 py-1 border border-gray-200">{{ $product->information }}</td>
          <td class="px-1 py-1 border border-gray-200">{{ $product->qty }}</td>
          <td class="px-1 py-1 border border-gray-200">{{ $product->producer }}</td>
          <td class="px-1 py-1 border border-gray-200">{{ $product->supplier->supplier_name ?? 'Gada Supplier' }}</td>
          <td class="px-1 py-1 border flex inline-block border-gray-200">
              <a href="{{ route('product-edit', $product->id) }}" 
                class="btn-warningVal m-1">
                  <i class="fa-solid fa-pencil"></i>
              </a>
              <button class="btn-dangerVal m-1"
                      onclick="confirmDelete('{{ route('product-deleted', $product->id) }}')">
                  <i class="fa-solid fa-trash-can"></i>
              </button>
          </td>

          </tr>
          @empty
          <p class="mb-4 text-center text-2xl font-bold text-red-600">Produk Tidak Ditemukan</p>
          @endforelse
          <!-- Tambahkan baris lainnya sesuai kebutuhan -->
        </tbody>
      </table>

      <!-- paginasi manual karena memakai $products->links() error:( sad sekali -->
      <ul class="paginationVal">
          @if ($products->onFirstPage())
              <li class="disabledVal"><span>Previous</span></li>
          @else
              <li><a href="{{ $products->previousPageUrl() }}">Previous</a></li>
          @endif

          @for ($i = 1; $i <= $products->lastPage(); $i++)
              @if ($i == $products->currentPage())
                  <li class="activeVal"><span>{{ $i }}</span></li>
              @else
                  <li><a href="{{ $products->url($i) }}">{{ $i }}</a></li>
              @endif
          @endfor

          @if ($products->hasMorePages())
              <li><a href="{{ $products->nextPageUrl() }}">Next</a></li>
          @else
              <li class="disabledVal"><span>Next</span></li>
          @endif
      </ul>

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