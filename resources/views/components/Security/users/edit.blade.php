<x-layout>
    <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 min-h-screen" dir="rtl">
        <div class="gradient-overlay rounded-2xl shadow-2xl p-6 sm:p-8 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-[#8333A6]/10 to-gray-500/10 opacity-50 pointer-events-none"></div>

            <h1 class="text-4xl font-extrabold text-center mb-6 bg-[#f59e0b] text-transparent bg-clip-text animate-fade-in relative z-10">
                تعديل بيانات المستخدم: {{ $user->name }}
            </h1>

            @if(session('success'))
                <div class="bg-green-50 border border-green-300 text-green-600 px-4 py-3 rounded-lg my-4 shadow-sm animate-slide-in flex items-center space-x-2 space-x-reverse" role="alert">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-50 border border-red-300 text-red-600 px-4 py-3 rounded-lg my-4 shadow-sm animate-slide-in flex items-center space-x-2 space-x-reverse" role="alert">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg transition-all duration-300 hover:shadow-xl relative z-10">
                <div class="space-y-6">
                    <form method="POST" action="{{ route('users.update', $user->id) }}" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <h2 class="text-xl font-bold text-[#0f172a] mb-4">تعديل المعلومات الأساسية</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="relative">
                                <label for="name" class="block text-sm font-medium text-[#0f172a]">الاسم</label>
                                <input type="text" name="name" id="name" value="{{ $user->name }}"
                                       class="mt-1 block w-full rounded-lg border-[#f59e0b] border-2 shadow-sm focus:ring-[#f59e0b] focus:border-[#f59e0b] text-gray-900 p-2" required>
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="relative">
                                <label for="email" class="block text-sm font-medium text-[#0f172a]">البريد الإلكتروني</label>
                                <input type="email" name="email" id="email" value="{{ $user->email }}"
                                       class="mt-1 block w-full rounded-lg border-[#f59e0b] border-2 shadow-sm focus:ring-[#f59e0b] focus:border-[#f59e0b] text-gray-900 p-2" required>
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="relative">
                                <label for="MobileNumber" class="block text-sm font-medium text-[#0f172a]">رقم الهاتف</label>
                                <input type="text" name="MobileNumber" id="MobileNumber" value="{{ $user->MobileNumber }}"
                                       class="mt-1 block w-full rounded-lg border-[#f59e0b] border-2 shadow-sm focus:ring-[#f59e0b] focus:border-[#f59e0b] text-gray-900 p-2" required>
                                @error('MobileNumber')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="relative">
                                <label for="RoleID" class="block text-sm font-medium text-[#0f172a]">الدور</label>
                                <select name="RoleID" id="RoleID" class="mt-1 block w-full rounded-lg border-[#f59e0b] border-2 shadow-sm focus:ring-[#f59e0b] focus:border-[#f59e0b] text-gray-900 p-2">
                                    <option value="">لا يوجد دور</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->RoleID }}" {{ $user->RoleID == $role->RoleID ? 'selected' : '' }}>{{ $role->RoleName }}</option>
                                    @endforeach
                                </select>
                                @error('RoleID')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="relative">
                                <label for="display_order" class="block text-sm font-medium text-[#0f172a]">ترتيب العرض</label>
                                <input type="number" name="display_order" id="display_order" value="{{ $user->display_order }}"
                                       class="mt-1 block w-full rounded-lg border-[#f59e0b] border-2 shadow-sm focus:ring-[#f59e0b] focus:border-[#f59e0b] text-gray-900 p-2">
                                @error('display_order')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex justify-end space-x-4 mt-6 space-x-reverse">
                            <a href="{{ route('users.index') }}" class="px-4 py-2 bg-gray-200 rounded-lg text-gray-700 hover:bg-gray-300 transition-all duration-200 transform hover:scale-105">إلغاء</a>
                            <button type="submit" class="px-4 py-2 bg-gradient-to-r from-yellow-500 to-orange-500 text-white rounded-lg hover:from-orange-600 hover:to-yellow-600 transition-all duration-200 transform hover:scale-105">
                                حفظ التغييرات
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <style>
        body { background-color: #f5f5f5; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slideIn { from { opacity: 0; transform: translateX(20px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes scaleIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
        @keyframes slideInRTL { from { opacity: 0; transform: translateX(-20px); } to { opacity: 1; transform: translateX(0); } }
        .animate-fade-in { animation: fadeIn 0.5s ease-out forwards; }
        .animate-slide-in { animation: slideIn 0.5s ease-out forwards; }
        .animate-scale-in { animation: scaleIn 0.3s ease-out forwards; }
        [dir="rtl"] .animate-slide-in { animation: slideInRTL 0.5s ease-out forwards; }
        .gradient-overlay {
            background: linear-gradient(135deg, #0f172a 0%, #3b82f6 100%);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            border-radius: 20px;
        }
    </style>
</x-layout>