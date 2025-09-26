<x-layout>
    <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 min-h-screen" dir="rtl">
        <div class="gradient-overlay rounded-2xl shadow-2xl p-6 sm:p-8 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-[#8333A6]/10 to-gray-500/10 opacity-50 pointer-events-none"></div>

            <h1 class="text-4xl font-extrabold text-center mb-6 bg-[#f59e0b] text-transparent bg-clip-text animate-fade-in relative z-10">
                إدارة المستخدمين
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

            <div class="bg-[#eee] p-6 sm:p-8 rounded-xl shadow-lg transition-all duration-300 hover:shadow-xl relative z-10">
                <h2 class="text-2xl font-bold text-[#0f172a] mb-6 flex items-center space-x-2 space-x-reverse">
                    <svg class="w-6 h-6" fill="none" stroke="#8333A6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c1.66 0 3-1.34 3-3S13.66 5 12 5s-3 1.34-3 3 1.34 3 3 3zm0 2c-2.76 0-5 2.24-5 5h10c0-2.76-2.24-5-5-5z"></path></svg>
                    <span>جميع المستخدمين</span>
                </h2>
                <div class="mb-6 flex justify-between items-center space-x-4 space-x-reverse">
                    <form method="GET" action="{{ route('users.index') }}" class="flex items-center space-x-2 space-x-reverse">
                        <input type="text" name="search" value="{{ request()->input('search') ?? '' }}" placeholder="ابحث عن مستخدم"
                               class="w-full max-w-md rounded-lg border-gray-300 shadow-sm focus:ring-[#f59e0b] focus:border-[#f59e0b] text-gray-900 p-2">
                        <button type="submit" class="px-4 py-2 bg-[#f59e0b] text-white rounded-lg hover:bg-yellow-600 transition-all duration-300 transform hover:scale-105">
                            بحث
                        </button>
                    </form>
                    <a href="{{ route('sessions.index') }}"
                       class="inline-flex items-center py-2 px-4 rounded-lg text-sm font-semibold text-white bg-[#f59e0b] hover:bg-yellow-600 transition-all duration-300 transform hover:scale-105 shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5v14"></path></svg>
                        عرض الجلسات
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-[#0f172a]">
                        <thead>
                            <tr class="text-right">
                                <th class="py-3 px-4">الاسم</th>
                                <th class="py-3 px-4">البريد الإلكتروني</th>
                                <th class="py-3 px-4">الدور</th>
                                <th class="py-3 px-4">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr class="border-t border-gray-200">
                                    <td class="py-3 px-4">{{ $user->name }}</td>
                                    <td class="py-3 px-4">{{ $user->email }}</td>
                                    <td class="py-3 px-4">{{ $user->role->RoleName }}</td>
                                    <td class="py-3 px-4 flex space-x-2 gap-2 space-x-reverse">
                                        <a href="{{ route('users.edit', $user->id) }}"
                                           class="inline-flex items-center py-1 px-3 rounded-lg text-sm font-semibold text-white bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-orange-600 hover:to-yellow-600 transition-all duration-300 transform hover:scale-105">
                                            تعديل
                                        </a>
                                        <button class="inline-flex items-center py-1 px-3 rounded-lg text-sm font-semibold text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 transition-all duration-300 transform hover:scale-105" onclick="toggleModal('changePasswordModal_{{ $user->id }}')">
                                            تغيير كلمة السر
                                        </button>
                                        <button class="inline-flex items-center py-1 px-3 rounded-lg text-sm font-semibold text-white bg-gradient-to-r from-red-500 to-red-700 hover:from-red-600 hover:to-red-800 transition-all duration-300 transform hover:scale-105" onclick="toggleModal('deleteUserModal_{{ $user->id }}')">
                                            حذف
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-3 px-4 text-center text-gray-400">لا توجد بيانات لعرضها</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-6 text-[#0f172a] text-sm">
                        عرض {{ $users->firstItem() }} إلى {{ $users->lastItem() }} من إجمالي {{ $users->total() }} نتيجة
                    </div>
                    <div class="mt-6">
                        {{ $users->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- مودال حذف المستخدم -->
    @foreach($users as $user)
        <div class="fixed inset-0 bg-black/70 flex items-center justify-center hidden transition-opacity duration-300 z-50" id="deleteUserModal_{{ $user->id }}">
            <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-2xl animate-scale-in relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-red-500 to-red-700"></div>
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center space-x-2 space-x-reverse">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>تأكيد الحذف</span>
                </h2>
                <p class="text-gray-600 mb-6">هل أنت متأكد من حذف المستخدم "{{ $user->name }}"؟</p>
                <div class="flex justify-end space-x-4 space-x-reverse">
                    <button type="button" class="px-4 py-2 bg-gray-200 rounded-lg text-gray-700 hover:bg-gray-300 transition-all duration-200 transform hover:scale-105" onclick="toggleModal('deleteUserModal_{{ $user->id }}')">إلغاء</button>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-700 text-white rounded-lg hover:from-red-600 hover:to-red-800 transition-all duration-200 transform hover:scale-105 flex items-center space-x-2 space-x-reverse">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            <span>حذف</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- مودال تغيير كلمة السر -->
        <div class="fixed inset-0 bg-black/70 flex items-center justify-center hidden transition-opacity duration-300 z-50" id="changePasswordModal_{{ $user->id }}">
            <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-2xl animate-scale-in relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-blue-700"></div>
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center space-x-2 space-x-reverse">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c1.66 0 3-1.34 3-3S13.66 5 12 5s-3 1.34-3 3 1.34 3 3 3zm0 2c-2.76 0-5 2.24-5 5h10c0-2.76-2.24-5-5-5z"></path></svg>
                    <span>تغيير كلمة السر لـ "{{ $user->name }}"</span>
                </h2>
                <form action="{{ route('users.change-password', $user->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="new_password_{{ $user->id }}" class="block text-sm font-medium text-gray-700">كلمة السر الجديدة</label>
                        <input type="password" name="new_password" id="new_password_{{ $user->id }}"
                               class="mt-1 block w-full rounded-lg border-[#f59e0b] border-2 shadow-sm focus:ring-[#f59e0b] focus:border-[#f59e0b] text-gray-900 p-2" required>
                        @error('new_password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="new_password_confirmation_{{ $user->id }}" class="block text-sm font-medium text-gray-700">تأكيد كلمة السر الجديدة</label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation_{{ $user->id }}"
                               class="mt-1 block w-full rounded-lg border-[#f59e0b] border-2 shadow-sm focus:ring-[#f59e0b] focus:border-[#f59e0b] text-gray-900 p-2" required>
                    </div>
                    <div class="flex justify-end space-x-4 space-x-reverse">
                        <button type="button" class="px-4 py-2 bg-gray-200 rounded-lg text-gray-700 hover:bg-gray-300 transition-all duration-200 transform hover:scale-105" onclick="toggleModal('changePasswordModal_{{ $user->id }}')">إلغاء</button>
                        <button type="submit" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-lg hover:from-blue-600 hover:to-blue-800 transition-all duration-200 transform hover:scale-105 flex items-center space-x-2 space-x-reverse">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>حفظ</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    <style>
        body { background-color: #eee; }
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

    <script>
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.toggle('hidden');
        }
    </script>
</x-layout>