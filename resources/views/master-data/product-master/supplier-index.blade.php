<style>
    .greenbtn{
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
      <a href="{{ route('tambah-supplier')}}">
        <button class="px-6 py-4 text-white bg-green-500 border border-green-500 rounded-lg shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 greenbtn">
            Add supplier data
        </button>
    </a>
      <table class="min-w-full border border-collapse border-gray-200">
        <thead>
          <tr class="bg-gray-100">
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">
              <?php echo isset($id) ? $id : 'Supplier ID'; ?>
            </th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Supplier Name</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Supplier Address</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Phone</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Comment</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Edit/Hapus</th>
          </tr>
        </thead>
        <tbody>
         
          @foreach ($data as $item)
            <tr class="bg-white">
              <td class="px-4 py-2 border border-gray-200">{{ $item->id }}</td>
              <td class="px-4 py-2 border border-gray-200">{{ $item->supplier_name }}</td>
              <td class="px-4 py-2 border border-gray-200">{{ $item->supplier_address }}</td>
              <td class="px-4 py-2 border border-gray-200">{{ $item->phone }}</td>
              <td class="px-4 py-2 border border-gray-200">{{ $item->comment }}</td>
              <td class="px-4 py-2 border border-gray-200">
                <a href="{{ route('supplier-edit', $item->id) }}" class="px-2 text-blue-600 hover:text-blue-800"><i class="fa-solid fa-pencil"></i></a>
                <button class="px-2 text-red-600 hover:text-red-800" onclick="confirmDelete(1)"><i class="fa-solid fa-trash-can"></i></button>
              </td>
            </tr>
          @endforeach


          <!-- Tambahkan baris lainnya sesuai kebutuhan -->
        </tbody>
      </table>
    </div>
  </div>


  <script>
    function confirmDelete(id, deleteUrl) {
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