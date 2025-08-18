<div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="w-full border-collapse text-left">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-sm font-semibold text-[#E8BF6F]">ID</th>
                <th class="px-4 py-2 text-sm font-semibold text-[#E8BF6F]">NAMA</th>
                <th class="px-4 py-2 text-sm font-semibold text-[#E8BF6F]">ASAL INSTANSI</th>
                <th class="px-4 py-2 text-sm font-semibold text-[#E8BF6F]">NOMOR KONTAK</th>
                <th class="px-4 py-2 text-sm font-semibold text-[#E8BF6F]">JENIS KUNJUNGAN</th>
                <th class="px-4 py-2 text-sm font-semibold text-[#E8BF6F]">JUMLAH TAMU</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse ($daftarTamu as $tamu)
            <tr @click="openDetail({{ $tamu->id }})" class="hover:bg-[#FFF4E0] transition-colors duration-200 cursor-pointer">
                <td class="px-4 py-2 text-sm text-gray-900">{{ $tamu->id }}</td>
                <td class="px-4 py-2 text-sm text-gray-900">{{ $tamu->nama }}</td>
                <td class="px-4 py-2 text-sm text-gray-900">{{ $tamu->instansi }}</td>
                <td class="px-4 py-2 text-sm text-gray-900">{{ $tamu->nomor_kontak }}</td>
                <td class="px-4 py-2 text-sm text-gray-900">{{ Str::title(str_replace('_', ' ', $tamu->jenis_kunjungan)) }}</td>
                <td class="px-4 py-2 text-sm text-gray-900">{{ $tamu->jumlah_peserta }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-4 py-2 text-center text-sm text-gray-500">
                    Tidak ada data tamu untuk kriteria ini.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Custom Pagination -->
    <div class="flex justify-end items-center p-4 space-x-2">
        {{ $daftarTamu->appends(request()->query())->onEachSide(1)->links('vendor.pagination.custom') }}
    </div>
</div>
