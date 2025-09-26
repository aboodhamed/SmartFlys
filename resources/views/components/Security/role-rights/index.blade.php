<x-layout>
    <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 min-h-screen" dir="rtl">
        <div class="gradient-overlay rounded-2xl shadow-2xl p-6 sm:p-8 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-[#8333A6]/10 to-gray-500/10 opacity-50 pointer-events-none"></div>

            <h1 class="text-4xl font-extrabold text-center mb-6 bg-[#f59e0b] text-transparent bg-clip-text animate-fade-in relative z-10">
                إدارة الأدوار والصلاحيات
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
                    <span>الأدوار</span>
                </h2>
                <button type="button" class="inline-flex items-center py-2 px-4 mb-4 rounded-lg text-sm font-semibold text-[#0f172a] bg-white hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-md" onclick="toggleModal('addRoleModal')">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="#0f172a" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    إضافة دور
                </button>
                <div class="overflow-x-auto">
                    <table class="w-full text-[#0f172a]">
                        <thead>
                            <tr class="text-right">
                                <th class="py-3 px-4">اسم الدور</th>
                                <th class="py-3 px-4">الصلاحيات</th>
                                <th class="py-3 px-4">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                                <tr class="border-t border-gray-200">
                                    <td class="py-3 px-4">{{ $role->RoleName }}</td>
                                    <td class="py-3 px-4 gap-2">
                                        <button class="inline-flex items-center py-1 px-3 rounded-lg text-sm font-semibold text-[#0f172a] bg-white hover:bg-gray-100 transition-all duration-300 transform hover:scale-105" onclick="toggleModal('showPermissionsModal_{{ $role->RoleID }}')">
                                            عرض
                                        </button>
                                    </td>
                                    <td class="py-3 px-4 flex space-x-2 gap-2 space-x-reverse">
                                        <button class="inline-flex items-center py-1 px-3 rounded-lg text-sm font-semibold text-white bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-orange-600 hover:to-yellow-600 transition-all duration-300 transform hover:scale-105" onclick="toggleModal('editRoleModal_{{ $role->RoleID }}')">
                                            تعديل
                                        </button>
                                        <button class="inline-flex gap-2 items-center py-1 px-3 rounded-lg text-sm font-semibold text-white bg-gradient-to-r from-red-500 to-red-700 hover:from-red-600 hover:to-red-800 transition-all duration-300 transform hover:scale-105" onclick="toggleModal('deleteRoleModal_{{ $role->RoleID }}')">
                                            حذف
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Add Role Modal -->
    <div class="fixed inset-0 bg-black/70 flex items-center justify-center hidden transition-opacity duration-300 z-50" id="addRoleModal">
        <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-2xl animate-scale-in relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-[#f59e0b]"></div>
            <form action="{{ url('/role-rights/add') }}" method="POST">
                @csrf
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center space-x-2 space-x-reverse">
                    <svg class="w-6 h-6 text-[#f59e0b]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    <span>إضافة دور جديد</span>
                </h2>
                <div class="mb-4">
                    <label for="role_name" class="block text-sm font-medium text-gray-700">اسم الدور</label>
                    <input type="text" name="name" id="role_name" value="{{ old('name') }}" class="mt-1 block w-full rounded-lg border-[#f59e0b] border-2 shadow-sm focus:ring-[#f59e0b] focus:border-[#f59e0b]" required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-end space-x-2 space-x-reverse">
                    <button type="button" class="px-4 py-2 bg-gray-200 rounded-lg text-gray-700 hover:bg-gray-300 transition-all duration-200 transform hover:scale-105" onclick="toggleModal('addRoleModal')">إلغاء</button>
                    <button type="submit" class="px-4 py-2 bg-[#f59e0b] text-white rounded-lg hover:bg-yellow-600 transition-all duration-200 transform hover:scale-105">حفظ</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modals for each role -->
    @foreach($roles as $role)
    <!-- Edit Role Modal -->
    <div class="fixed inset-0 bg-black/70 flex items-center justify-center hidden transition-opacity duration-300 z-50" id="editRoleModal_{{ $role->RoleID }}">
        <div class="bg-white rounded-xl p-6 w-full max-w-5xl shadow-2xl animate-scale-in relative max-h-[90vh] overflow-auto">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-yellow-500 to-orange-500"></div>
            <form action="{{ url('/role-rights/edit/' . $role->RoleID) }}" method="POST">
                @csrf
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center space-x-2 space-x-reverse">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    <span>تعديل الدور: {{ $role->RoleName }}</span>
                </h2>
                <div class="mb-4">
                    <label for="role_name_{{ $role->RoleID }}" class="block text-sm font-medium text-gray-700">اسم الدور</label>
                    <input type="text" name="name" id="role_name_{{ $role->RoleID }}" value="{{ $role->RoleName }}" class="mt-1 block w-full border-2 rounded-lg border-yellow-600 shadow-sm focus:ring-yellow-500 focus:border-yellow-500" required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    @foreach($modules as $module)
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $module->ModuleName }}</h3>
                            <div class="overflow-x-auto overflow-y-auto max-h-96">
                                <table class="w-full text-gray-700 min-w-max">
                                    <thead>
                                        <tr class="text-right bg-gray-100">
                                            <th class="py-2 px-4 sticky top-0 bg-gray-100">الكيان</th>
                                            @foreach($actions as $action)
                                                <th class="py-2 px-4 sticky top-0 bg-gray-100">{{ $action->ActionName }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($module->entities as $entity)
                                            <tr class="border-t border-gray-200">
                                                <td class="py-2 px-4">{{ $entity->EntityName }}</td>
                                                @foreach($actions as $action)
                                                    @if($entity->actions->contains('ActionID', $action->ActionID))
                                                        <td class="py-2 px-4">
                                                            <input type="checkbox" name="permissions[{{ $entity->EntityID }}][]" value="{{ $action->ActionID }}"
                                                                   {{ $role->permissions()->where('entity_id', $entity->EntityID)->where('action_id', $action->ActionID)->exists() ? 'checked' : '' }}
                                                                   class="h-4 w-4 text-yellow-600 border-gray-300 rounded focus:ring-yellow-500">
                                                        </td>
                                                    @else
                                                        <td class="py-2 px-4"></td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="flex justify-end space-x-2 space-x-reverse">
                    <button type="button" class="px-4 py-2 bg-gray-200 rounded-lg text-gray-700 hover:bg-gray-300 transition-all duration-200 transform hover:scale-105" onclick="toggleModal('editRoleModal_{{ $role->RoleID }}')">إلغاء</button>
                    <button type="submit" class="px-4 py-2 bg-gradient-to-r from-yellow-500 to-orange-500 text-white rounded-lg hover:from-orange-600 hover:to-yellow-600 transition-all duration-200 transform hover:scale-105">حفظ</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Show Permissions Modal -->
    <div class="fixed inset-0 bg-black/70 flex items-center justify-center hidden transition-opacity duration-300 z-50" id="showPermissionsModal_{{ $role->RoleID }}">
        <div class="bg-white rounded-xl p-6 w-full max-w-4xl shadow-2xl animate-scale-in relative max-h-[90vh] overflow-auto">
            <div class="absolute top-0 left-0 w-full h-1 bg-[#f59e0b]"></div>
            <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center space-x-2 space-x-reverse">
                <svg class="w-6 h-6 text-[#f59e0b]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M19 19v-2a2 2 0 00-2-2H7a2 2 0 00-2 2v2"></path></svg>
                <span>عرض صلاحيات الدور: {{ $role->RoleName }}</span>
            </h2>
            <div class="mb-4 overflow-x-auto">
                @foreach($modules as $module)
                    @php
                        $hasPermissions = $role->permissions->whereIn('EntityID', $module->entities->pluck('EntityID'))->isNotEmpty();
                    @endphp
                    @if($hasPermissions)
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $module->ModuleName }}</h3>
                            <table class="w-full text-gray-700">
                                <thead>
                                    <tr class="text-right bg-gray-100">
                                        <th class="py-2 px-4">الكيان</th>
                                        <th class="py-2 px-4">الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($module->entities as $entity)
                                        @if($role->permissions->contains('EntityID', $entity->EntityID))
                                            <tr class="border-t border-gray-200">
                                                <td class="py-2 px-4">{{ $entity->EntityName }}</td>
                                                <td class="py-2 px-4">
                                                    @foreach($role->actions->where('pivot.entity_id', $entity->EntityID) as $action)
                                                        <span class="inline-block bg-[#f59e0b] text-white px-2 py-1 rounded-lg mr-2">{{ $action->ActionName }}</span>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                @endforeach
                @if($role->permissions->isEmpty())
                    <p class="text-gray-500">لا توجد صلاحيات لهذا الدور</p>
                @endif
            </div>
            <div class="flex justify-end">
                <button type="button" class="px-4 py-2 bg-gray-200 rounded-lg text-gray-700 hover:bg-gray-300 transition-all duration-200 transform hover:scale-105" onclick="toggleModal('showPermissionsModal_{{ $role->RoleID }}')">إغلاق</button>
            </div>
        </div>
    </div>

    <!-- Delete Role Modal -->
    <div class="fixed inset-0 bg-black/70 flex items-center justify-center hidden transition-opacity duration-300 z-50" id="deleteRoleModal_{{ $role->RoleID }}">
        <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-2xl animate-scale-in relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-red-500 to-red-700"></div>
            <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center space-x-2 space-x-reverse">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>تأكيد الحذف</span>
            </h2>
            <p class="text-gray-600 mb-6">هل أنت متأكد من حذف الدور "{{ $role->RoleName }}"؟</p>
            <div class="flex justify-end space-x-4 space-x-reverse">
                <button type="button" class="px-4 py-2 bg-gray-200 rounded-lg text-gray-700 hover:bg-gray-300 transition-all duration-200 transform hover:scale-105" onclick="toggleModal('deleteRoleModal_{{ $role->RoleID }}')">إلغاء</button>
                <form action="{{ url('/role-rights/delete/' . $role->RoleID) }}" method="POST" class="inline">
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
    @endforeach

    <style>
        body { background-color: #eee; }
        .animate-fade-in { animation: fadeIn 0.5s ease-out forwards; }
        .animate-slide-in { animation: slideIn 0.5s ease-out forwards; }
        .animate-scale-in { animation: scaleIn 0.3s ease-out forwards; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slideIn { from { opacity: 0; transform: translateX(20px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes slideInRTL { from { opacity: 0; transform: translateX(-20px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes scaleIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
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