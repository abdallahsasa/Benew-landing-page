<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benew® Admin Login</title>
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#1E083B">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <script src="https://cdn.tailwindcss.com/3.4.17"></script>
</head>
<body class="min-h-screen bg-[#1E083B] flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8">
        <div class="text-center mb-6">
            <img src="{{ asset('images/benew-logo-dark.png') }}" alt="Benew® — Be New To Be Fine" width="712" height="248" class="h-14 w-auto object-contain mx-auto mb-3">
            <h1 class="text-lg font-bold text-[#1E083B]">Admin Portal</h1>
        </div>
        <div id="errorBox" class="hidden bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl p-3 mb-4"></div>
        <form id="loginForm" class="space-y-4">
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Email</label>
                <input type="email" id="email" required value="admin@benew.com" class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Password</label>
                <input type="password" id="password" required class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm">
            </div>
            <button type="submit" class="w-full bg-[#2B0C54] text-white font-semibold py-3 rounded-xl hover:opacity-95">Sign In</button>
        </form>
    </div>
    <script>
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const errorBox = document.getElementById('errorBox');
            errorBox.classList.add('hidden');
            const res = await fetch('/api/v1/auth/login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({
                    email: document.getElementById('email').value,
                    password: document.getElementById('password').value,
                }),
            });
            const data = await res.json();
            if (!res.ok) {
                errorBox.textContent = data.message || 'Login failed.';
                errorBox.classList.remove('hidden');
                return;
            }
            localStorage.setItem('benew_token', data.token);
            window.location.href = '/admin';
        });
    </script>
</body>
</html>
