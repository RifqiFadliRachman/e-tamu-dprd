<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white">
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-lg p-6 border rounded-sm relative bg-white">
            <!-- Tombol Close ke route admin.admin -->
            <a href="{{ route('admin.admin') }}" 
               class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                ✕
            </a>

            <!-- Judul -->
            <h2 class="text-base font-semibold text-gray-900 mb-6">Edit Pengguna</h2>

            <!-- Form -->
            <form method="POST" action="{{ route('admin.update', $user) }}" class="space-y-5">
                @csrf
                @method('PUT')
                
                <!-- Nama -->
                <div>
                    <label for="name" class="block text-sm text-gray-700 mb-1">Nama</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                        class="w-full border px-3 py-2 text-sm focus:outline-none focus:border-gray-400">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                        class="w-full border px-3 py-2 text-sm focus:outline-none focus:border-gray-400">
                </div>

                <!-- Password baru (opsional) -->
                <div>
                    <label for="password" class="block text-sm text-gray-700 mb-1">Password Baru (opsional)</label>
                    <input type="password" name="password" id="password"
                        class="w-full border px-3 py-2 text-sm focus:outline-none focus:border-gray-400">
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm text-gray-700 mb-1">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full border px-3 py-2 text-sm focus:outline-none focus:border-gray-400">
                </div>

                <!-- Tombol -->
                <div class="flex justify-center">
                    <button type="submit" 
                        class="px-6 py-2 bg-[#E5B962] text-white rounded hover:bg-[#d6a94f]">
                        Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
