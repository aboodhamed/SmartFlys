<x-layout>
    <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 min-h-screen" dir="rtl">
        <div class="gradient-overlay rounded-2xl shadow-2xl p-6 sm:p-8 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-[#8333A6]/10 to-gray-500/10 opacity-50 pointer-events-none"></div>

            <h1 class="text-4xl font-extrabold text-center mb-6 bg-[#f59e0b] text-transparent bg-clip-text animate-fade-in relative z-10">
                إدارة النظام
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

            <div class="space-y-10 relative z-10">
                <!-- Modules Section -->
                <div class="bg-blue-600 p-6 sm:p-8 rounded-xl shadow-lg transition-all duration-300 hover:shadow-xl">
                    <h2 class="text-2xl font-bold text-white mb-6 flex items-center space-x-2 space-x-reverse">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h-6m-6 0H5"></path></svg>
                        <span>الوحدات</span>
                    </h2>
                    <button type="button" class="inline-flex items-center py-2 px-4 mb-4 rounded-lg text-sm font-semibold text-white bg-[#f59e0b] hover:bg-yellow-600 transition-all duration-300 transform hover:scale-105 shadow-md" onclick="toggleModal('addModuleModal')">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        إضافة وحدة
                    </button>
                    <div class="overflow-x-auto">
                        <table class="w-full text-white">
                            <thead>
                                <tr class="text-right">
                                    <th class="py-3 px-4">اسم الوحدة</th>
                                    <th class="py-3 px-4">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($modules as $module)
                                    <tr class="border-t border-white/20">
                                        <td class="py-3 px-4">{{ $module->ModuleName }}</td>
                                        <td class="py-3 px-4 flex space-x-2 gap-2 space-x-reverse">
                                            <button class="inline-flex items-center py-1 px-3 rounded-lg text-sm font-semibold text-white bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-orange-600 hover:to-yellow-600 transition-all duration-300 transform hover:scale-105" onclick="toggleModal('editModuleModal_{{ $module->ModuleID }}')">
                                                تعديل
                                            </button>
                                            <button class="inline-flex items-center py-1 px-3 rounded-lg text-sm font-semibold text-white bg-gradient-to-r from-red-500 to-red-700 hover:from-red-600 hover:to-red-800 transition-all duration-300 transform hover:scale-105" onclick="toggleModal('deleteModuleModal_{{ $module->ModuleID }}')">
                                                حذف
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Actions Section -->
                <div class="bg-blue-600 p-6 sm:p-8 rounded-xl shadow-lg transition-all duration-300 hover:shadow-xl">
                    <h2 class="text-2xl font-bold text-white mb-6 flex items-center space-x-2 space-x-reverse">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        <span>الإجراءات</span>
                    </h2>
                    <button type="button" class="inline-flex items-center py-2 px-4 mb-4 rounded-lg text-sm font-semibold text-white bg-[#f59e0b] hover:bg-yellow-600 transition-all duration-300 transform hover:scale-105 shadow-md" onclick="toggleModal('addActionModal')">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        إضافة إجراء
                    </button>
                    <div class="overflow-x-auto">
                        <table class="w-full text-white">
                            <thead>
                                <tr class="text-right">
                                    <th class="py-3 px-4">اسم الإجراء</th>
                                    <th class="py-3 px-4">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($actions as $action)
                                    <tr class="border-t border-white/20">
                                        <td class="py-3 px-4">{{ $action->ActionName }}</td>
                                        <td class="py-3 px-4 flex space-x-2 gap-2 space-x-reverse">
                                            <button class="inline-flex items-center py-1 px-3 rounded-lg text-sm font-semibold text-white bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-orange-600 hover:to-yellow-600 transition-all duration-300 transform hover:scale-105" onclick="toggleModal('editActionModal_{{ $action->ActionID }}')">
                                                تعديل
                                            </button>
                                            <button class="inline-flex items-center py-1 px-3 rounded-lg text-sm font-semibold text-white bg-gradient-to-r from-red-500 to-red-700 hover:from-red-600 hover:to-red-800 transition-all duration-300 transform hover:scale-105" onclick="toggleModal('deleteActionModal_{{ $action->ActionID }}')">
                                                حذف
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Entities Section -->
                <div class="bg-blue-600 p-6 sm:p-8 rounded-xl shadow-lg transition-all duration-300 hover:shadow-xl">
                    <h2 class="text-2xl font-bold text-white mb-6 flex items-center space-x-2 space-x-reverse">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a8 8 0 01-8 8m8-8a8 8 0 00-8-8m8 8V5m-6 6H5m6 6V5"></path></svg>
                        <span>الكيانات</span>
                    </h2>
                    <button type="button" class="inline-flex items-center py-2 px-4 mb-4 rounded-lg text-sm font-semibold text-white bg-[#f59e0b] hover:bg-yellow-600 transition-all duration-300 transform hover:scale-105 shadow-md" onclick="toggleModal('addEntityModal')">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        إضافة كيان
                    </button>
                    <div class="overflow-x-auto">
                        <table class="w-full text-white">
                            <thead>
                                <tr class="text-right">
                                    <th class="py-3 px-4">اسم الكيان</th>
                                    <th class="py-3 px-4">الوحدة</th>
                                    <th class="py-3 px-4">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($entities as $entity)
                                    <tr class="border-t border-white/20">
                                        <td class="py-3 px-4">{{ $entity->EntityName }}</td>
                                        <td class="py-3 px-4">{{ $entity->module->ModuleName }}</td>
                                        <td class="py-3 px-4 flex space-x-2 gap-2 space-x-reverse">
                                            <button class="inline-flex items-center py-1 px-3 rounded-lg text-sm font-semibold text-white bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-orange-600 hover:to-yellow-600 transition-all duration-300 transform hover:scale-105" onclick="toggleModal('editEntityModal_{{ $entity->EntityID }}')">
                                                تعديل
                                            </button>
                                            <button class="inline-flex items-center py-1 px-3 rounded-lg text-sm font-semibold text-white bg-gradient-to-r from-red-500 to-red-700 hover:from-red-600 hover:to-red-800 transition-all duration-300 transform hover:scale-105" onclick="toggleModal('deleteEntityModal_{{ $entity->EntityID }}')">
                                                حذف
                                            </button>
                                            <button class="inline-flex items-center py-1 px-3 rounded-lg text-sm font-semibold text-white bg-gradient-to-r from-green-500 to-teal-500 hover:from-teal-600 hover:to-green-600 transition-all duration-300 transform hover:scale-105" onclick="toggleModal('actionsModal_{{ $entity->EntityID }}')">
                                                إجراءات الكيان
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Add Module Modal -->
    <div class="fixed inset-0 bg-black/70 flex items-center justify-center hidden transition-opacity duration-300 z-50" id="addModuleModal">
        <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-2xl animate-scale-in relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-[#f59e0b]"></div>
            <form action="{{ url('/system-module/add') }}" method="POST">
                @csrf
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center space-x-2 space-x-reverse">
                    <svg class="w-6 h-6 text-[#f59e0b]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    <span>إضافة وحدة جديدة</span>
                </h2>
                <div class="mb-4">
                    <label for="module_name" class="block text-sm font-medium text-gray-700">اسم الوحدة</label>
                    <input type="text" name="name" id="module_name" value="{{ old('name') }}" class="mt-1 block w-full rounded-lg border-[#f59e0b] border-2 shadow-sm focus:ring-[#f59e0b] focus:border-[#f59e0b]" required>
                </div>
                <div class="flex justify-end space-x-2 space-x-reverse">
                    <button type="button" class="px-4 py-2 bg-gray-200 rounded-lg text-gray-700 hover:bg-gray-300 transition-all duration-200 transform hover:scale-105" onclick="toggleModal('addModuleModal')">إلغاء</button>
                    <button type="submit" class="px-4 py-2 bg-[#f59e0b] text-white rounded-lg hover:bg-yellow-600 transition-all duration-200 transform hover:scale-105">حفظ</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit + Delete Module Modals -->
    @foreach($modules as $module)
        <div class="fixed inset-0 bg-black/70 flex items-center justify-center hidden transition-opacity duration-300 z-50" id="editModuleModal_{{ $module->ModuleID }}">
            <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-2xl animate-scale-in relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-yellow-500 to-orange-500"></div>
                <form action="{{ url('/system-module/edit/' . $module->ModuleID) }}" method="POST">
                    @csrf
                    <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center space-x-2 space-x-reverse">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        <span>تعديل الوحدة</span>
                    </h2>
                    <div class="mb-4">
                        <label for="module_name_{{ $module->ModuleID }}" class="block text-sm font-medium text-gray-700">اسم الوحدة</label>
                        <input type="text" name="name" id="module_name_{{ $module->ModuleID }}" value="{{ $module->ModuleName }}" class="mt-1 block w-full rounded-lg border-yellow-500 border-2 shadow-sm focus:ring-yellow-500 focus:border-yellow-500" required>
                    </div>
                    <div class="flex justify-end space-x-2 space-x-reverse">
                        <button type="button" class="px-4 py-2 bg-gray-200 rounded-lg text-gray-700 hover:bg-gray-300 transition-all duration-200 transform hover:scale-105" onclick="toggleModal('editModuleModal_{{ $module->ModuleID }}')">إلغاء</button>
                        <button type="submit" class="px-4 py-2 bg-gradient-to-r from-yellow-500 to-orange-500 text-white rounded-lg hover:from-orange-600 hover:to-yellow-600 transition-all duration-200 transform hover:scale-105">حفظ</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="fixed inset-0 bg-black/70 flex items-center justify-center hidden transition-opacity duration-300 z-50" id="deleteModuleModal_{{ $module->ModuleID }}">
            <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-2xl animate-scale-in relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-red-500 to-red-700"></div>
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center space-x-2 space-x-reverse">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>تأكيد حذف الوحدة</span>
                </h2>
                <p class="text-gray-600 mb-6">هل أنت متأكد من حذف الوحدة "{{ $module->ModuleName }}"؟</p>
                <div class="flex justify-end space-x-4 space-x-reverse">
                    <button type="button" class="px-4 py-2 bg-gray-200 rounded-lg text-gray-700 hover:bg-gray-300 transition-all duration-200 transform hover:scale-105" onclick="toggleModal('deleteModuleModal_{{ $module->ModuleID }}')">إلغاء</button>
                    <form action="{{ url('/system-module/delete/' . $module->ModuleID) }}" method="POST" class="inline">
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

    <!-- Add Action Modal -->
    <div class="fixed inset-0 bg-black/70 flex items-center justify-center hidden transition-opacity duration-300 z-50" id="addActionModal">
        <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-2xl animate-scale-in relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-[#f59e0b]"></div>
            <form action="{{ url('/system-module/action/add') }}" method="POST">
                @csrf
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center space-x-2 space-x-reverse">
                    <svg class="w-6 h-6 text-[#f59e0b]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    <span>إضافة إجراء جديد</span>
                </h2>
                <div class="mb-4">
                    <label for="action_name" class="block text-sm font-medium text-gray-700">اسم الإجراء</label>
                    <input type="text" name="name" id="action_name" value="{{ old('name') }}" class="mt-1 block w-full rounded-lg border-[#f59e0b] border-2 shadow-sm focus:ring-[#f59e0b] focus:border-[#f59e0b]" required>
                </div>
                <div class="flex justify-end space-x-2 space-x-reverse">
                    <button type="button" class="px-4 py-2 bg-gray-200 rounded-lg text-gray-700 hover:bg-gray-300 transition-all duration-200 transform hover:scale-105" onclick="toggleModal('addActionModal')">إلغاء</button>
                    <button type="submit" class="px-4 py-2 bg-[#f59e0b] text-white rounded-lg hover:bg-yellow-600 transition-all duration-200 transform hover:scale-105">حفظ</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit + Delete Action Modals -->
    @foreach($actions as $action)
        <div class="fixed inset-0 bg-black/70 flex items-center justify-center hidden transition-opacity duration-300 z-50" id="editActionModal_{{ $action->ActionID }}">
            <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-2xl animate-scale-in relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-yellow-500 to-orange-500"></div>
                <form action="{{ url('/system-module/action/edit/' . $action->ActionID) }}" method="POST">
                    @csrf
                    <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center space-x-2 space-x-reverse">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        <span>تعديل الإجراء</span>
                    </h2>
                    <div class="mb-4">
                        <label for="action_name_{{ $action->ActionID }}" class="block text-sm font-medium text-gray-700">اسم الإجراء</label>
                        <input type="text" name="name" id="action_name_{{ $action->ActionID }}" value="{{ $action->ActionName }}" class="mt-1 block w-full rounded-lg border-yellow-500 border-2 shadow-sm focus:ring-yellow-500 focus:border-yellow-500" required>
                    </div>
                    <div class="flex justify-end space-x-2 space-x-reverse">
                        <button type="button" class="px-4 py-2 bg-gray-200 rounded-lg text-gray-700 hover:bg-gray-300 transition-all duration-200 transform hover:scale-105" onclick="toggleModal('editActionModal_{{ $action->ActionID }}')">إلغاء</button>
                        <button type="submit" class="px-4 py-2 bg-gradient-to-r from-yellow-500 to-orange-500 text-white rounded-lg hover:from-orange-600 hover:to-yellow-600 transition-all duration-200 transform hover:scale-105">حفظ</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="fixed inset-0 bg-black/70 flex items-center justify-center hidden transition-opacity duration-300 z-50" id="deleteActionModal_{{ $action->ActionID }}">
            <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-2xl animate-scale-in relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-red-500 to-red-700"></div>
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center space-x-2 space-x-reverse">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>تأكيد حذف الإجراء</span>
                </h2>
                <p class="text-gray-600 mb-6">هل أنت متأكد من حذف الإجراء "{{ $action->ActionName }}"؟</p>
                <div class="flex justify-end space-x-4 space-x-reverse">
                    <button type="button" class="px-4 py-2 bg-gray-200 rounded-lg text-gray-700 hover:bg-gray-300 transition-all duration-200 transform hover:scale-105" onclick="toggleModal('deleteActionModal_{{ $action->ActionID }}')">إلغاء</button>
                    <form action="{{ url('/system-module/action/delete/' . $action->ActionID) }}" method="POST" class="inline">
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

    <!-- Add Entity Modal -->
    <div class="fixed inset-0 bg-black/70 flex items-center justify-center hidden transition-opacity duration-300 z-50" id="addEntityModal">
        <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-2xl animate-scale-in relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-[#f59e0b]"></div>
            <form action="{{ url('/system-module/entity/add') }}" method="POST">
                @csrf
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center space-x-2 space-x-reverse">
                    <svg class="w-6 h-6 text-[#f59e0b]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    <span>إضافة كيان جديد</span>
                </h2>
                <div class="mb-4">
                    <label for="entity_name" class="block text-sm font-medium text-gray-700">اسم الكيان</label>
                    <input type="text" name="name" id="entity_name" value="{{ old('name') }}" class="mt-1 block w-full rounded-lg border-[#f59e0b] border-2 shadow-sm focus:ring-[#f59e0b] focus:border-[#f59e0b]" required>
                </div>
                <div class="mb-4">
                    <label for="module_id" class="block text-sm font-medium text-gray-700">الوحدة</label>
                    <select name="module_id" id="module_id" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-[#f59e0b] focus:border-[#f59e0b]" required>
                        @foreach($modules as $module)
                            <option value="{{ $module->ModuleID }}">{{ $module->ModuleName }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end space-x-2 space-x-reverse">
                    <button type="button" class="px-4 py-2 bg-gray-200 rounded-lg text-gray-700 hover:bg-gray-300 transition-all duration-200 transform hover:scale-105" onclick="toggleModal('addEntityModal')">إلغاء</button>
                    <button type="submit" class="px-4 py-2 bg-[#f59e0b] text-white rounded-lg hover:bg-yellow-600 transition-all duration-200 transform hover:scale-105">حفظ</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit + Delete + Actions Entity Modals -->
    @foreach($entities as $entity)
        <div class="fixed inset-0 bg-black/70 flex items-center justify-center hidden transition-opacity duration-300 z-50" id="editEntityModal_{{ $entity->EntityID }}">
            <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-2xl animate-scale-in relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-yellow-500 to-orange-500"></div>
                <form action="{{ url('/system-module/entity/edit/' . $entity->EntityID) }}" method="POST">
                    @csrf
                    <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center space-x-2 space-x-reverse">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        <span>تعديل الكيان</span>
                    </h2>
                    <div class="mb-4">
                        <label for="entity_name_{{ $entity->EntityID }}" class="block text-sm font-medium text-gray-700">اسم الكيان</label>
                        <input type="text" name="name" id="entity_name_{{ $entity->EntityID }}" value="{{ $entity->EntityName }}" class="mt-1 block w-full rounded-lg border-yellow-500 border-2 shadow-sm focus:ring-yellow-500 focus:border-yellow-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="module_id_{{ $entity->EntityID }}" class="block text-sm font-medium text-gray-700">الوحدة</label>
                        <select name="module_id" id="module_id_{{ $entity->EntityID }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-yellow-500 focus:border-yellow-500" required>
                            @foreach($modules as $module)
                                <option value="{{ $module->ModuleID }}" {{ $module->ModuleID == $entity->ModuleID ? 'selected' : '' }}>{{ $module->ModuleName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end space-x-2 space-x-reverse">
                        <button type="button" class="px-4 py-2 bg-gray-200 rounded-lg text-gray-700 hover:bg-gray-300 transition-all duration-200 transform hover:scale-105" onclick="toggleModal('editEntityModal_{{ $entity->EntityID }}')">إلغاء</button>
                        <button type="submit" class="px-4 py-2 bg-gradient-to-r from-yellow-500 to-orange-500 text-white rounded-lg hover:from-orange-600 hover:to-yellow-600 transition-all duration-200 transform hover:scale-105">حفظ</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="fixed inset-0 bg-black/70 flex items-center justify-center hidden transition-opacity duration-300 z-50" id="actionsModal_{{ $entity->EntityID }}">
            <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-2xl animate-scale-in relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-green-500 to-teal-500"></div>
                <form action="{{ url('/system-module/entity/actions/' . $entity->EntityID) }}" method="POST">
                    @csrf
                    <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center space-x-2 space-x-reverse">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        <span>إجراءات الكيان: {{ $entity->EntityName }}</span>
                    </h2>
                    <div class="mb-4">
                        @foreach($actions as $action)
                            <div class="flex items-center mb-2">
                                <input type="checkbox" name="actions[]" value="{{ $action->ActionID }}" 
                                       {{ $entity->actions->contains('ActionID', $action->ActionID) ? 'checked' : '' }} 
                                       class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                                <label class="mr-2 text-sm text-gray-700">{{ $action->ActionName }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex justify-end space-x-2 space-x-reverse">
                        <button type="button" class="px-4 py-2 bg-gray-200 rounded-lg text-gray-700 hover:bg-gray-300 transition-all duration-200 transform hover:scale-105" onclick="toggleModal('actionsModal_{{ $entity->EntityID }}')">إلغاء</button>
                        <button type="submit" class="px-4 py-2 bg-gradient-to-r from-green-500 to-teal-500 text-white rounded-lg hover:from-teal-600 hover:to-green-600 transition-all duration-200 transform hover:scale-105">حفظ</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="fixed inset-0 bg-black/70 flex items-center justify-center hidden transition-opacity duration-300 z-50" id="deleteEntityModal_{{ $entity->EntityID }}">
            <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-2xl animate-scale-in relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-red-500 to-red-700"></div>
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center space-x-2 space-x-reverse">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>تأكيد حذف الكيان</span>
                </h2>
                <p class="text-gray-600 mb-6">هل أنت متأكد من حذف الكيان "{{ $entity->EntityName }}"؟</p>
                <div class="flex justify-end space-x-4 space-x-reverse">
                    <button type="button" class="px-4 py-2 bg-gray-200 rounded-lg text-gray-700 hover:bg-gray-300 transition-all duration-200 transform hover:scale-105" onclick="toggleModal('deleteEntityModal_{{ $entity->EntityID }}')">إلغاء</button>
                    <form action="{{ url('/system-module/entity/delete/' . $entity->EntityID) }}" method="POST" class="inline">
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
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slideIn { from { opacity: 0; transform: translateX(20px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes scaleIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
        @keyframes slideInRTL { from { opacity: 0; transform: translateX(-20px); } to { opacity: 1; transform: translateX(0); } }
        .animate-fade-in { animation: fadeIn 0.5s ease-out forwards; }
        .animate-slide-in { animation: slideIn 0.5s ease-out forwards; }
        [dir="rtl"] .animate-slide-in { animation: slideInRTL 0.5s ease-out forwards; }
        .animate-scale-in { animation: scaleIn 0.3s ease-out forwards; }
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