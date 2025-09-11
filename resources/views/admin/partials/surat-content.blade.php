<div class="border rounded-md divide-y divide-gray-200">
    {{-- Menggunakan variabel $tamusWithSurat --}}
    @forelse ($tamusWithSurat as $tamu)
        <div class="p-4 hover:bg-gray-50">
            <div class="flex justify-between items-center">
                <div>
                    <p class="font-bold text-gray-800">{{ $tamu->nama }}</p>
                    <p class="text-sm text-gray-500">{{ $tamu->instansi }}</p>
                    <p class="text-xs text-gray-400">Tanggal Pengajuan: {{ $tamu->created_at->isoFormat('D MMMM YYYY') }}</p>
                </div>
                <div class="flex items-center gap-4">
                    @if ($tamu->surat_permohonan_path)
                        <div class="text-center">
                            <p class="text-sm font-semibold">Surat Permohonan</p>
                            <div class="flex gap-2 mt-1 justify-center">
                                <!-- Tombol Lihat -->
                                <a href="{{ Storage::url($tamu->surat_permohonan_path) }}" target="_blank" class="p-1 rounded hover:opacity-80" title="Lihat Surat">
                                    <svg class="w-9 h-9" viewBox="0 0 36 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="36" height="35" fill="#386EF5"/>
                                        <g clip-path="url(#clip0_1118_769)"><path d="M28.1509 13.4694C22.5278 8.24784 13.3791 8.24784 7.75588 13.4694L4 16.9565L7.84905 20.5306C10.6604 23.1412 14.3534 24.4469 18.0468 24.4469C21.7403 24.4469 25.4328 23.1416 28.2446 20.5306L32.0005 17.043L28.1509 13.4694ZM27.5753 19.9096C22.3211 24.7881 13.7721 24.7881 8.51784 19.9096L5.33757 16.9565L8.42466 14.0899C13.6789 9.21142 22.2279 9.21142 27.4822 14.0899L30.6624 17.043L27.5753 19.9096Z" fill="white"/><path d="M17.5139 13.4731C15.6883 13.4731 14.2031 14.8522 14.2031 16.5475C14.2031 16.7899 14.415 16.9867 14.6761 16.9867C14.9372 16.9867 15.1491 16.7899 15.1491 16.5475C15.1491 15.3366 16.2099 14.3515 17.5139 14.3515C17.775 14.3515 17.9869 14.1548 17.9869 13.9123C17.9869 13.6699 17.7755 13.4731 17.5139 13.4731Z" fill="white"/><path d="M17.9865 11.2773C14.5963 11.2773 11.8379 13.8387 11.8379 16.9868C11.8379 20.1349 14.5963 22.6963 17.9865 22.6963C21.3768 22.6963 24.1352 20.1349 24.1352 16.9868C24.1352 13.8387 21.3773 11.2773 17.9865 11.2773ZM17.9865 21.8179C15.118 21.8179 12.7838 19.6505 12.7838 16.9868C12.7838 14.3231 15.118 12.1557 17.9865 12.1557C20.8551 12.1557 23.1892 14.3231 23.1892 16.9868C23.1892 19.6505 20.8556 21.8179 17.9865 21.8179Z" fill="white"/></g><defs><clipPath id="clip0_1118_769"><rect width="28" height="26" fill="white" transform="translate(4 4)"/></clipPath></defs></svg>
                                </a>
                                <!-- Tombol Cetak -->
                                <button onclick="printSurat('{{ Storage::url($tamu->surat_permohonan_path) }}')" class="p-1 rounded hover:opacity-80" title="Cetak Surat">
                                    <svg width="36" height="35" viewBox="0 0 36 35" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="36" height="35" fill="#E8BF6F"/><path d="M11.9805 24.1342H6.40179C6.05907 24.1342 5.78125 23.8816 5.78125 23.57V15.13C5.78125 14.8185 6.05907 14.5659 6.40179 14.5659H30.5982C30.9409 14.5659 31.2188 14.8185 31.2188 15.13V23.57C31.2188 23.8816 30.9409 24.1342 30.5982 24.1342H25.0196" stroke="white" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/><path d="M25.0195 21.6479H11.9805V27.9792H25.0195V21.6479Z" stroke="white" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/><path d="M25.0195 14.5661H11.9805V6.021H22.2695L25.0195 8.521L25.0195 14.5661Z" stroke="white" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/><path d="M22.5371 6.021V8.27756H25.0193" stroke="white" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/><path d="M29.3975 16.7803C29.6822 16.7803 29.9131 16.5704 29.9131 16.3115C29.9131 16.0526 29.6822 15.8428 29.3975 15.8428C29.1127 15.8428 28.8818 16.0526 28.8818 16.3115C28.8818 16.5704 29.1127 16.7803 29.3975 16.7803Z" fill="white"/><path d="M27.3242 16.7803C27.609 16.7803 27.8398 16.5704 27.8398 16.3115C27.8398 16.0526 27.609 15.8428 27.3242 15.8428C27.0394 15.8428 26.8086 16.0526 26.8086 16.3115C26.8086 16.5704 27.0394 16.7803 27.3242 16.7803Z" fill="white"/><path d="M25.25 16.7803C25.5348 16.7803 25.7656 16.5704 25.7656 16.3115C25.7656 16.0526 25.5348 15.8428 25.25 15.8428C24.9652 15.8428 24.7344 16.0526 24.7344 16.3115C24.7344 16.5704 24.9652 16.7803 25.25 16.7803Z" fill="white"/></svg>
                                </button>
                                <!-- Tombol Hapus -->
                                <form action="{{ route('admin.surat.destroy', $tamu) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus surat ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="tipe" value="permohonan">
                                    <button type="submit" class="p-1 rounded hover:opacity-80" title="Hapus Surat">
                                        <svg width="36" height="35" viewBox="0 0 36 35" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="36" height="35" fill="#FF0000" fill-opacity="0.65"/><path fill-rule="evenodd" clip-rule="evenodd" d="M12.5 6V8.3H7V10.6H29V8.3H23.5V6H12.5ZM8.375 11.75H11.125V26.2236L11.6945 26.7H24.3054L24.875 26.2236V11.75H27.625V27.1764L25.4446 29H10.5555L8.375 27.1764V11.75Z" fill="white"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                    @if ($tamu->surat_tugas_path)
                        <div class="text-center">
                            <p class="text-sm font-semibold">Surat Tugas</p>
                            <div class="flex gap-2 mt-1 justify-center">
                                <!-- Tombol Lihat -->
                                <a href="{{ Storage::url($tamu->surat_tugas_path) }}" target="_blank" class="p-1 rounded hover:opacity-90 flex items-center justify-center" title="Lihat Surat">
                                    <svg class="w-9 h-9" viewBox="0 0 36 35" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="36" height="35" fill="#386EF5"/><g clip-path="url(#clip0_1118_769)"><path d="M28.1509 13.4694C22.5278 8.24784 13.3791 8.24784 7.75588 13.4694L4 16.9565L7.84905 20.5306C10.6604 23.1412 14.3534 24.4469 18.0468 24.4469C21.7403 24.4469 25.4328 23.1416 28.2446 20.5306L32.0005 17.043L28.1509 13.4694ZM27.5753 19.9096C22.3211 24.7881 13.7721 24.7881 8.51784 19.9096L5.33757 16.9565L8.42466 14.0899C13.6789 9.21142 22.2279 9.21142 27.4822 14.0899L30.6624 17.043L27.5753 19.9096Z" fill="white"/><path d="M17.5139 13.4731C15.6883 13.4731 14.2031 14.8522 14.2031 16.5475C14.2031 16.7899 14.415 16.9867 14.6761 16.9867C14.9372 16.9867 15.1491 16.7899 15.1491 16.5475C15.1491 15.3366 16.2099 14.3515 17.5139 14.3515C17.775 14.3515 17.9869 14.1548 17.9869 13.9123C17.9869 13.6699 17.7755 13.4731 17.5139 13.4731Z" fill="white"/><path d="M17.9865 11.2773C14.5963 11.2773 11.8379 13.8387 11.8379 16.9868C11.8379 20.1349 14.5963 22.6963 17.9865 22.6963C21.3768 22.6963 24.1352 20.1349 24.1352 16.9868C24.1352 13.8387 21.3773 11.2773 17.9865 11.2773ZM17.9865 21.8179C15.118 21.8179 12.7838 19.6505 12.7838 16.9868C12.7838 14.3231 15.118 12.1557 17.9865 12.1557C20.8551 12.1557 23.1892 14.3231 23.1892 16.9868C23.1892 19.6505 20.8556 21.8179 17.9865 21.8179Z" fill="white"/></g><defs><clipPath id="clip0_1118_769"><rect width="28" height="26" fill="white" transform="translate(4 4)"/></clipPath></defs></svg>
                                </a>
                                <!-- Tombol Cetak -->
                                <button onclick="printSurat('{{ Storage::url($tamu->surat_tugas_path) }}')" class="p-1 rounded hover:opacity-90 flex items-center justify-center" title="Cetak Surat">
                                    <svg class="w-9 h-9" viewBox="0 0 36 35" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="36" height="35" fill="#E8BF6F"/><path d="M11.9805 24.1342H6.40179C6.05907 24.1342 5.78125 23.8816 5.78125 23.57V15.13C5.78125 14.8185 6.05907 14.5659 6.40179 14.5659H30.5982C30.9409 14.5659 31.2188 14.8185 31.2188 15.13V23.57C31.2188 23.8816 30.9409 24.1342 30.5982 24.1342H25.0196" stroke="white" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/><path d="M25.0195 21.6479H11.9805V27.9792H25.0195V21.6479Z" stroke="white" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/><path d="M25.0195 14.5661H11.9805V6.021H22.2695L25.0195 8.521L25.0195 14.5661Z" stroke="white" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/><path d="M22.5371 6.021V8.27756H25.0193" stroke="white" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/><path d="M29.3975 16.7803C29.6822 16.7803 29.9131 16.5704 29.9131 16.3115C29.9131 16.0526 29.6822 15.8428 29.3975 15.8428C29.1127 15.8428 28.8818 16.0526 28.8818 16.3115C28.8818 16.5704 29.1127 16.7803 29.3975 16.7803Z" fill="white"/><path d="M27.3242 16.7803C27.609 16.7803 27.8398 16.5704 27.8398 16.3115C27.8398 16.0526 27.609 15.8428 27.3242 15.8428C27.0394 15.8428 26.8086 16.0526 26.8086 16.3115C26.8086 16.5704 27.0394 16.7803 27.3242 16.7803Z" fill="white"/><path d="M25.25 16.7803C25.5348 16.7803 25.7656 16.5704 25.7656 16.3115C25.7656 16.0526 25.5348 15.8428 25.25 15.8428C24.9652 15.8428 24.7344 16.0526 24.7344 16.3115C24.7344 16.5704 24.9652 16.7803 25.25 16.7803Z" fill="white"/></svg>
                                </button>
                                <!-- Tombol Hapus -->
                                <form action="{{ route('admin.surat.destroy', $tamu) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus surat ini?')" class="flex items-center justify-center">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="tipe" value="tugas">
                                    <button type="submit" class="p-1 rounded hover:opacity-90 flex items-center justify-center" title="Hapus Surat">
                                        <svg class="w-9 h-9" viewBox="0 0 36 35" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="36" height="35" fill="#FF0000" fill-opacity="0.65"/><path fill-rule="evenodd" clip-rule="evenodd" d="M12.5 6V8.3H7V10.6H29V8.3H23.5V6H12.5ZM8.375 11.75H11.125V26.2236L11.6945 26.7H24.3054L24.875 26.2236V11.75H27.625V27.1764L25.4446 29H10.5555L8.375 27.1764V11.75Z" fill="white"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <p class="p-4 text-center text-gray-500">Tidak ada surat yang diunggah.</p>
    @endforelse
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $tamusWithSurat->appends(request()->query())->links('vendor.pagination.custom') }}
</div>
