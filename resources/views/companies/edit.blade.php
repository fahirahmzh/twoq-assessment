<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('companies.index') }}" 
               class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Edit Company') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">Update company information for <span class="font-semibold text-gray-800">{{ $company->name }}</span></p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <!-- Progress Indicator -->
                <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 h-1.5"></div>
                
                <div class="p-8">
                    <form action="{{ route('companies.update', $company) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Company Name -->
                        <div class="group">
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Company Name <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-yellow-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       value="{{ old('name', $company->name) }}"
                                       placeholder="Enter company name"
                                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all @error('name') border-red-500 ring-2 ring-red-200 @enderror">
                            </div>
                            @error('name')
                                <div class="flex items-center mt-2 text-red-600 text-sm">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="group">
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                Email Address
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-yellow-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <input type="email" 
                                       name="email" 
                                       id="email" 
                                       value="{{ old('email', $company->email) }}"
                                       placeholder="company@example.com"
                                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all @error('email') border-red-500 ring-2 ring-red-200 @enderror">
                            </div>
                            @error('email')
                                <div class="flex items-center mt-2 text-red-600 text-sm">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Logo Upload -->
                        <div class="group">
                            <label for="logo" class="block text-sm font-semibold text-gray-700 mb-2">
                                Company Logo
                            </label>
                            
                            <!-- Current Logo Display -->
                            @if($company->logo)
                                <div class="mb-4 bg-gradient-to-r from-gray-50 to-gray-100 border-2 border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center space-x-4">
                                        <img src="{{ asset('storage/' . $company->logo) }}" 
                                             alt="{{ $company->name }}" 
                                             id="currentLogo"
                                             class="h-20 w-20 object-cover rounded-lg shadow-md border-2 border-white">
                                        <div class="flex-1">
                                            <p class="text-sm font-semibold text-gray-700">Current Logo</p>
                                            <p class="text-xs text-gray-500 mt-1">Upload a new image to replace this logo</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                </svg>
                                                Active
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- New Logo Upload Area -->
                            <div class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-yellow-400 transition-colors group-focus-within:border-yellow-500 @error('logo') border-red-300 @enderror">
                                <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="mt-4 flex text-sm text-gray-600 justify-center">
                                        <label for="logo" class="relative cursor-pointer bg-white rounded-md font-medium text-yellow-600 hover:text-yellow-500 focus-within:outline-none">
                                            <span>{{ $company->logo ? 'Replace logo' : 'Upload a file' }}</span>
                                            <input id="logo" name="logo" type="file" accept="image/*" class="sr-only" onchange="previewNewImage(event)">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2">PNG, JPG, GIF up to 10MB (minimum 100x100px)</p>
                                </div>
                                
                                <!-- New Image Preview -->
                                <div id="newImagePreview" class="mt-4 hidden">
                                    <div class="relative inline-block">
                                        <img id="newPreview" class="h-32 w-32 object-cover rounded-lg border-2 border-yellow-400 shadow-lg" src="" alt="New Preview">
                                        <div class="absolute -top-2 -right-2">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-yellow-500 text-white shadow-md">
                                                NEW
                                            </span>
                                        </div>
                                    </div>
                                    <p class="text-xs text-gray-600 mt-2 font-medium">New logo preview</p>
                                </div>
                            </div>
                            @error('logo')
                                <div class="flex items-center mt-2 text-red-600 text-sm">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Website URL -->
                        <div class="group">
                            <label for="website" class="block text-sm font-semibold text-gray-700 mb-2">
                                Website URL
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-yellow-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                    </svg>
                                </div>
                                <input type="url" 
                                       name="website" 
                                       id="website" 
                                       value="{{ old('website', $company->website) }}"
                                       placeholder="https://example.com"
                                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all @error('website') border-red-500 ring-2 ring-red-200 @enderror">
                            </div>
                            @error('website')
                                <div class="flex items-center mt-2 text-red-600 text-sm">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Info Box -->
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-lg">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-blue-500 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-blue-800">Update Information</p>
                                    <p class="text-sm text-blue-700 mt-1">Leave fields empty to keep existing values. Only updated fields will be changed.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                            <a href="{{ route('companies.show', $company) }}" 
                               class="px-6 py-3 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-gray-400">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="group relative px-6 py-3 bg-gradient-to-r from-yellow-500 to-yellow-600 text-white font-medium rounded-lg hover:from-yellow-600 hover:to-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-105">
                                <span class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Update Company
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Last Updated Info -->
            <div class="mt-4 text-center text-sm text-gray-500">
                Last updated: {{ $company->updated_at->diffForHumans() }}
            </div>
        </div>
    </div>

    <script>
        function previewNewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('newPreview').src = e.target.result;
                    document.getElementById('newImagePreview').classList.remove('hidden');
                    
                    // Optional: Add slight fade to current logo to show it will be replaced
                    const currentLogo = document.getElementById('currentLogo');
                    if (currentLogo) {
                        currentLogo.style.opacity = '0.4';
                    }
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-app-layout>