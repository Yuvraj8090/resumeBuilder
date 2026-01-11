<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen px-6 py-12">
        
        <div class="mb-8 text-center animate-fade-in-up">
            <a href="/" class="flex items-center justify-center gap-2 group">
                <div class="p-3 bg-indigo-600 rounded-xl text-white shadow-lg shadow-indigo-200 group-hover:scale-110 transition duration-300">
                    <i data-lucide="sparkles" class="w-6 h-6"></i>
                </div>
                <span class="text-2xl font-bold tracking-tight text-indigo-950">AI Resume</span>
            </a>
        </div>

        <div class="w-full max-w-md glass p-8 sm:p-10 rounded-3xl shadow-2xl border-indigo-50 relative overflow-hidden">
            
            <div class="mb-8 text-center">
                <h1 class="text-2xl font-bold text-indigo-950 mb-2">Welcome Back</h1>
                <p class="text-slate-500 text-sm">Enter your credentials to access your account.</p>
            </div>

            <x-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-4 rounded-xl border border-green-200">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-2">{{ __('Email') }}</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="mail" class="w-5 h-5"></i>
                        </div>
                        <input id="email" style="padding-left: 2.75rem;"
                                           class="block w-full rounded-xl border-slate-200 py-3 pl-11 pr-4 text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent sm:text-sm shadow-sm placeholder:text-slate-300 transition-all"
                               type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="you@example.com" />
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-2">{{ __('Password') }}</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="lock" class="w-5 h-5"></i>
                        </div>
                        <input id="password" style="padding-left: 2.75rem;"
                                           class="block w-full rounded-xl border-slate-200 py-3 pl-11 pr-4 text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent sm:text-sm shadow-sm placeholder:text-slate-300 transition-all"
                               type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <label for="remember_me" class="flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox" class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" name="remember">
                        <span class="ml-2 text-sm text-slate-600">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition" href="{{ route('password.request') }}">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif
                </div>

                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-indigo-200 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    {{ __('Log in') }}
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </button>
            </form>

            <div class="mt-8 text-center text-sm text-slate-500">
                Don't have an account? 
                <a href="{{ route('register') }}" class="font-bold text-indigo-600 hover:text-indigo-800 transition">Create one free</a>
            </div>
        </div>
        
        <div class="mt-8 text-slate-400 text-xs">
            &copy; {{ date('Y') }} AI Resume Builder. All rights reserved.
        </div>
    </div>
</x-guest-layout>