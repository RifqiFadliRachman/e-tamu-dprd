<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Warna utama & hover */
        .bg-custom-gold {
            background-color: #E8BF6F;
        }
        .bg-custom-gold:hover {
            background-color: #d6aa5f; /* sedikit lebih gelap */
        }
    </style>
</head>
<body class="bg-gray-50 flex items-center justify-center h-screen">
    <div class="w-full max-w-sm">
        <form method="POST" action="{{ route('login') }}" class="bg-white shadow-lg rounded-lg px-8 pt-8 pb-8 mb-4">
            @csrf
            <h1 class="text-2xl font-bold text-center text-gray-800 mb-8">Login Admin</h1>

            <div class="mb-4">
                <input class="shadow-sm appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#E8BF6F]/50 @error('email') border-red-500 @enderror" id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <input class="shadow-sm appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#E8BF6F]/50 @error('password') border-red-500 @enderror" id="password" type="password" name="password" placeholder="Password" required>
                @error('password')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex items-center justify-between mb-6">
                <label for="remember_me" class="flex items-center text-sm text-gray-600">
                    <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-[#E8BF6F] bg-gray-100 border-gray-300 rounded focus:ring-[#E8BF6F]">
                    <span class="ml-2">Ingat Saya</span>
                </label>
                <a href="#" class="inline-block align-baseline text-sm text-gray-600 hover:text-gray-900">
                    Lupa Password?
                </a>
            </div>

            <div class="flex items-center justify-between">
                <button 
                    class="bg-custom-gold hover:bg-custom-gold-dark text-white font-bold active:font-extrabold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline w-full transition-all duration-150"
                    type="submit">
                    Login
                </button>
            </div>
        </form>
    </div>
</body>
</html>
