<x-app-layout>
    <div class="max-w-6xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <div class="flex items-center gap-2 text-sm text-indigo-600 font-medium mb-1">
                    <a href="{{ route('users.index') }}" class="hover:underline">Users</a>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400"></i>
                    <span class="text-slate-500">Edit</span>
                </div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Edit User: {{ $user->name }}</h1>
            </div>
            
            <a href="{{ route('users.index') }}" class="flex items-center gap-2 text-slate-500 bg-white border border-slate-200 hover:bg-slate-50 hover:text-slate-700 px-4 py-2 rounded-xl text-sm font-medium transition-all shadow-sm">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back to List
            </a>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-indigo-600 rounded-3xl p-6 text-white shadow-xl shadow-indigo-200 relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                    <div class="relative z-10">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center mb-4">
                            <i data-lucide="user-cog" class="w-6 h-6 text-white"></i>
                        </div>
                        <h3 class="text-lg font-bold mb-2">User Settings</h3>
                        <p class="text-indigo-100 text-sm leading-relaxed">
                            Update profile information and system access levels. 
                        </p>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">
                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Meta Data</h4>
                    <ul class="space-y-4">
                        <li class="flex justify-between text-sm">
                            <span class="text-slate-500">Member Since</span>
                            <span class="font-medium text-slate-700">{{ $user->created_at->format('M d, Y') }}</span>
                        </li>
                        <li class="flex justify-between text-sm">
                            <span class="text-slate-500">Last Updated</span>
                            <span class="font-medium text-slate-700">{{ $user->updated_at->diffForHumans() }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
                    
                    <form action="{{ route('users.update', $user->id) }}" method="POST" class="p-8">
                        @csrf
                        @method('PUT')

                        <div class="mb-8 border-b border-slate-50 pb-6">
                            <h2 class="text-lg font-bold text-slate-800">Profile Information</h2>
                            <p class="text-sm text-slate-500">Update the user's personal details and role.</p>
                        </div>

                        <div class="space-y-6">
                            
                            <div>
                                <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Full Name</label>
                                <div class="relative mt-2 rounded-xl shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                        <i data-lucide="user" class="h-5 w-5 text-slate-400"></i>
                                    </div>
                                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                                           class="block w-full rounded-xl border-slate-200 py-3 pl-11 pr-4 text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent sm:text-sm shadow-sm">
                                </div>
                                @error('name') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
                                <div class="relative mt-2 rounded-xl shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                        <i data-lucide="mail" class="h-5 w-5 text-slate-400"></i>
                                    </div>
                                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                                           class="block w-full rounded-xl border-slate-200 py-3 pl-11 pr-4 text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent sm:text-sm shadow-sm">
                                </div>
                                @error('email') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="role_id" class="block text-sm font-semibold text-slate-700 mb-2">Assign Role</label>
                                <div class="relative mt-2 rounded-xl shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                        <i data-lucide="shield" class="h-5 w-5 text-slate-400"></i>
                                    </div>
                                    <select name="role_id" id="role_id" 
                                            class="block w-full rounded-xl border-slate-200 py-3 pl-11 pr-10 text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent sm:text-sm shadow-sm bg-white">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                                {{ $role->label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('role_id') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
                            </div>

                            <hr class="border-slate-100 my-6">
                            
                            <div>
                                <h3 class="text-sm font-bold text-slate-800 mb-4">Change Password</h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                                    
                                    <div>
                                        <label for="password" class="block text-xs font-semibold text-slate-500 mb-2 uppercase tracking-wide">New Password</label>
                                        <div class="relative rounded-xl shadow-sm">
                                            <input type="password" name="password" id="password" placeholder="Leave blank to keep current"
                                                   class="block w-full rounded-xl border-slate-200 py-2.5 px-3 text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent sm:text-sm shadow-sm">
                                        </div>
                                        @error('password') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
                                    </div>

                                    <div>
                                        <label for="password_confirmation" class="block text-xs font-semibold text-slate-500 mb-2 uppercase tracking-wide">Confirm New Password</label>
                                        <div class="relative rounded-xl shadow-sm">
                                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm new password"
                                                   class="block w-full rounded-xl border-slate-200 py-2.5 px-3 text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent sm:text-sm shadow-sm">
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="mt-10 pt-6 border-t border-slate-50 flex items-center justify-end gap-4">
                            <a href="{{ route('users.index') }}" class="text-slate-500 hover:text-slate-700 font-medium text-sm px-4 py-2 transition-colors">Cancel</a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-xl font-bold shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/40 transition-all transform active:scale-95 flex items-center gap-2">
                                <i data-lucide="save" class="w-4 h-4"></i>
                                Save Changes
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script> document.addEventListener("DOMContentLoaded", function() { lucide.createIcons(); }); </script>
</x-app-layout>