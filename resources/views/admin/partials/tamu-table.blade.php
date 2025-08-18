
@forelse ($daftarTamu as $tamu)
    <tr class="border-b hover:bg-[#FFF5E5]">
        <td class="px-4 py-2">{{ $tamu->id }}</td>
        <td class="px-4 py-2">{{ $tamu->nama }}</td>
        <td class="px-4 py-2">{{ $tamu->nomor_kontak }}</td>
        <td class="px-4 py-2">{{ $tamu->jenis_kunjungan }}</td>
        <td class="px-4 py-2">{{ $tamu->jumlah_peserta }}</td>
    </tr>
@empty
    <tr class="border-b">
        <td colspan="5" class="text-center py-4 text-gray-500">
            Tidak ada tamu dengan nama tersebut.
        </td>
    </tr>
@endforelse