@extends('layouts.app')

@section('title', 'Detail Tugas - EduLearn')

@section('content')
<div class="max-w-4xl mx-auto animate-fade-in">
    <!-- Header Card -->
    <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 shadow-minimal overflow-hidden mb-6">
        @if(session('success'))
            <div class="p-4 bg-green-50 border-b border-green-200">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-green-800 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif
        @if(session('error'))
            <div class="p-4 bg-red-50 border-b border-red-200">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-red-800 font-medium">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <div class="p-8">
            <div class="flex items-start gap-4 mb-6">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-gray-900 mb-3">{{ $tugas->judul }}</h1>
                    <div class="flex flex-wrap items-center gap-3">
                        <a href="{{ route('kelas.detail', $tugas->kelas_id) }}" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-blue-50 text-blue-700 text-sm font-semibold hover:bg-blue-100 transition-colors duration-200">
                            {{ optional($tugas->kelas)->name }}
                        </a>
                        <span class="text-gray-400">•</span>
                        <span class="text-gray-600">{{ optional($tugas->user)->name ?? 'Guru' }}</span>
                    </div>
                </div>
                @if($isGuru ?? false)
                <div class="flex items-center gap-2">
                    <a href="{{ route('tugas.edit', $tugas->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 hover:bg-blue-100 rounded-xl text-blue-700 font-semibold transition-all duration-300 hover:scale-105">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit
                    </a>
                    <form action="{{ route('tugas.destroy', $tugas->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tugas ini?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-red-50 hover:bg-red-100 rounded-xl text-red-700 font-semibold transition-all duration-300 hover:scale-105">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Hapus
                        </button>
                    </form>
                </div>
                @endif
            </div>

            <div class="prose max-w-none">
                <div class="text-gray-700 leading-relaxed">{!! nl2br(e($tugas->deskripsi)) !!}</div>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-8 p-6 bg-gradient-to-r from-gray-50 to-gray-100 rounded-2xl">
                <div>
                    <p class="text-sm text-gray-500 mb-1 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Batas waktu
                    </p>
                    <p class="font-semibold text-gray-900">{{ optional($tugas->deadline)->format('d M Y H:i') ?? 'Tidak ada' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-1 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Status
                    </p>
                    <p class="font-semibold text-gray-900">{{ ucfirst($tugas->status ?? '---') }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Submission area --}}
    <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 shadow-minimal p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Pengumpulan Tugas
        </h2>

        @if($submission)
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-2xl p-6 mb-6">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-green-900 mb-2">Tugas Sudah Dikumpulkan</h3>
                        <p class="text-sm text-green-700 mb-3">Dikumpulkan pada <span class="font-semibold">{{ $submission->submitted_at->format('d M Y H:i') }}</span></p>
                        
                        @if($submission->file_path)
                            <div class="bg-white rounded-xl p-4 mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                                        <span class="text-xl">{{ $submission->fileIcon }}</span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-gray-900 truncate">{{ $submission->file_name }}</p>
                                        <p class="text-sm text-gray-500">{{ $submission->fileSizeFormatted }}</p>
                                    </div>
                                    <a href="{{ route('submissions.download', $submission->id) }}" 
                                       class="flex-shrink-0 inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-700 rounded-xl font-medium hover:bg-blue-100 transition-colors duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        Download
                                    </a>
                                </div>
                            </div>
                        @endif
                        
                        @if($submission->content)
                            <div class="mt-3 p-4 bg-white/50 rounded-xl">
                                <p class="text-sm font-medium text-gray-700 mb-2">Catatan:</p>
                                <p class="text-gray-600">{{ $submission->content }}</p>
                            </div>
                        @endif
                        
                        @if($submission->grade)
                            <div class="mt-3 p-4 bg-white rounded-xl border-2 border-blue-200">
                                <p class="text-sm font-medium text-gray-700 mb-1">Nilai:</p>
                                <p class="text-2xl font-bold text-blue-600">{{ $submission->grade }}</p>
                            </div>
                        @endif
                        
                        @if($submission->feedback)
                            <div class="mt-3 p-4 bg-white rounded-xl">
                                <p class="text-sm font-medium text-gray-700 mb-2">Feedback dari Guru:</p>
                                <p class="text-gray-600">{{ $submission->feedback }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('tugas.submit', $tugas->id) }}" method="post" enctype="multipart/form-data" class="space-y-6"
              x-data="{
                  isDragging: false,
                  fileName: '',
                  fileSize: '',
                  fileType: '',
                  fileIcon: '📎',
                  uploadProgress: 0,
                  handleFileSelect(event) {
                      const file = event.target.files[0];
                      if (file) {
                          this.fileName = file.name;
                          this.fileSize = this.formatFileSize(file.size);
                          this.fileType = file.name.split('.').pop().toLowerCase();
                          this.fileIcon = this.getFileIcon(this.fileType);
                      }
                  },
                  handleDrop(event) {
                      this.isDragging = false;
                      const file = event.dataTransfer.files[0];
                      if (file) {
                          const input = document.getElementById('file-input');
                          input.files = event.dataTransfer.files;
                          this.fileName = file.name;
                          this.fileSize = this.formatFileSize(file.size);
                          this.fileType = file.name.split('.').pop().toLowerCase();
                          this.fileIcon = this.getFileIcon(this.fileType);
                      }
                  },
                  formatFileSize(bytes) {
                      if (bytes < 1024) return bytes + ' B';
                      if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(2) + ' KB';
                      return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
                  },
                  getFileIcon(type) {
                      const icons = {
                          'pdf': '📄', 'doc': '📝', 'docx': '📝',
                          'xls': '📊', 'xlsx': '📊', 'ppt': '📊', 'pptx': '📊',
                          'zip': '📦', 'rar': '📦',
                          'jpg': '🖼️', 'jpeg': '🖼️', 'png': '🖼️', 'gif': '🖼️'
                      };
                      return icons[type] || '📎';
                  },
                  clearFile() {
                      document.getElementById('file-input').value = '';
                      this.fileName = '';
                      this.fileSize = '';
                      this.fileType = '';
                  }
              }">
            @csrf
            
            <!-- Drag & Drop Upload Area -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    Upload File (opsional)
                </label>
                
                <!-- Drop Zone -->
                <div class="relative"
                     @dragenter="isDragging = true"
                     @dragleave="isDragging = false"
                     @dragover.prevent
                     @drop.prevent="handleDrop">
                    
                    <input type="file" 
                           id="file-input"
                           name="file" 
                           class="hidden"
                           @change="handleFileSelect"
                           accept=".pdf,.doc,.docx,.txt,.zip,.jpg,.jpeg,.png,.ppt,.pptx,.xls,.xlsx" />
                    
                    <label for="file-input" 
                           class="block cursor-pointer transition-all duration-300"
                           :class="isDragging ? 'scale-[0.98]' : 'hover:scale-[1.01]'">
                        <div class="border-2 border-dashed rounded-2xl p-8 text-center transition-all duration-300"
                             :class="isDragging ? 'border-blue-500 bg-blue-50' : fileName ? 'border-green-300 bg-green-50' : 'border-gray-300 bg-gray-50 hover:border-blue-400 hover:bg-blue-50'">
                            
                            <!-- Empty State -->
                            <template x-if="!fileName">
                                <div class="space-y-3">
                                    <div class="w-16 h-16 mx-auto rounded-2xl bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-base font-semibold text-gray-700">
                                            <span class="text-blue-600">Klik untuk upload</span> atau drag & drop
                                        </p>
                                        <p class="text-sm text-gray-500 mt-1">PDF, DOC, DOCX, XLS, PPT, ZIP, atau Gambar (max 10MB)</p>
                                    </div>
                                </div>
                            </template>
                            
                            <!-- File Selected State -->
                            <template x-if="fileName">
                                <div class="flex items-center gap-4 bg-white rounded-xl p-4">
                                    <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                                        <span class="text-2xl" x-text="fileIcon"></span>
                                    </div>
                                    <div class="flex-1 text-left">
                                        <p class="font-semibold text-gray-900 truncate" x-text="fileName"></p>
                                        <p class="text-sm text-gray-500" x-text="fileSize"></p>
                                    </div>
                                    <button type="button" 
                                            @click.prevent="clearFile()"
                                            class="flex-shrink-0 w-8 h-8 rounded-lg hover:bg-red-100 text-red-500 transition-colors flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </label>
                </div>
                @error('file')<p class="mt-2 text-sm text-red-600 flex items-center gap-1"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>{{ $message }}</p>@enderror
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">Catatan / Keterangan (opsional)</label>
                <textarea name="content" rows="4" class="w-full border border-gray-200 rounded-xl p-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200" placeholder="Tambahkan catatan atau keterangan tentang tugas Anda...">{{ old('content') }}</textarea>
                @error('content')<p class="mt-2 text-sm text-red-600 flex items-center gap-1"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>{{ $message }}</p>@enderror
            </div>
            
            <div class="flex items-center gap-4 pt-4">
                <button type="submit" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-sm hover:shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Kumpulkan Tugas
                </button>
                <a href="{{ route('tugas') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 transition-colors duration-200 font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke daftar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
