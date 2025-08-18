<table class="min-w-full bg-white">
    <thead class="bg-gray-50">
        <tr class="text-[#E8BF6F]">
            <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">ID</th>
            <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Nama</th>
            <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Email</th>
            <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Aksi</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        @forelse ($users as $user)
            <tr class="hover:bg-[#E8BF6F]/30 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap text-black">{{ $loop->iteration }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-black">{{ $user->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-black">{{ $user->email }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black">
                    <a href="{{ route('admin.edit', $user) }}" class="text-blue-600 hover:text-blue-800">Edit</a>

                    <form 
                        action="{{ route('admin.destroy', $user) }}" 
                        method="POST" 
                        class="inline-block"
                        onsubmit="return confirm('Anda yakin ingin menghapus {{ auth()->id() === $user->id ? 'akun Anda sendiri' : 'admin ini' }}?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900 ml-4">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                    Tidak ada admin yang ditemukan.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $users->appends(request()->query())->links('vendor.pagination.custom') }}
</div>
