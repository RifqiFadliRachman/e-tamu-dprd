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
                <th class="px-4 py-2 text-sm font-semibold text-[#E8BF6F]">STATUS</th>
                <th class="px-4 py-2 text-sm font-semibold text-[#E8BF6F]">AKSI</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse ($daftarTamu as $tamu)
            <tr class="hover:bg-[#FFF4E0] transition-colors duration-200">
                <td class="px-4 py-2 text-sm text-gray-900">{{ $tamu->id }}</td>
                <td @click="openDetail({{ $tamu->id }})" class="px-4 py-2 text-sm text-gray-900 cursor-pointer hover:underline">{{ $tamu->nama }}</td>
                <td class="px-4 py-2 text-sm text-gray-900">{{ $tamu->instansi }}</td>
                <td class="px-4 py-2 text-sm text-gray-900">{{ $tamu->nomor_kontak }}</td>
                <td class="px-4 py-2 text-sm text-gray-900">{{ Str::title(str_replace('_', ' ', $tamu->jenis_kunjungan)) }}</td>
                <td class="px-4 py-2 text-sm text-gray-900">{{ $tamu->jumlah_peserta }}</td>
                <td class="px-4 py-2 text-sm text-gray-900">
                    {{-- Badge Status dengan warna kondisional --}}
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                        @if($tamu->status == 'belum_di_proses') bg-yellow-100 text-yellow-800
                        @elseif($tamu->status == 'di_proses') bg-blue-100 text-blue-800
                        @elseif($tamu->status == 'di_terima') bg-green-100 text-green-800
                        @else bg-red-100 text-red-800 @endif">
                        {{ Str::title(str_replace('_', ' ', $tamu->status)) }}
                    </span>
                </td>
                <td class="px-4 py-2 text-sm text-gray-900">
                    {{-- Form untuk mengubah status --}}
                    <form action="{{ route('admin.tamu.updateStatus', $tamu) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="status" onchange="this.form.submit()" class="text-sm rounded border-gray-300 focus:ring-[#E8BF6F] focus:border-[#E8BF6F]">
                            <option value="belum_di_proses" @if($tamu->status == 'belum_di_proses') selected @endif>Belum Di Proses</option>
                            <option value="di_proses" @if($tamu->status == 'di_proses') selected @endif>Di Proses</option>
                            <option value="di_terima" @if($tamu->status == 'di_terima') selected @endif>Di Terima</option>
                            <option value="di_tolak" @if($tamu->status == 'di_tolak') selected @endif>Di Tolak</option>
                        </select>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                {{-- Update colspan menjadi 8 karena ada 2 kolom baru --}}
                <td colspan="8" class="px-4 py-2 text-center text-sm text-gray-500">
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
