@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50/30 to-purple-50/30 py-8 px-4 sm:px-6 lg:px-8 pl-8 lg:pl-0">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8 animate-fade-in">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl p-8 shadow-lg">
                <h1 class="text-3xl font-bold text-white mb-2">
                    <svg class="w-8 h-8 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    Notifikasi
                </h1>
                <p class="text-blue-100">Semua notifikasi dan pengingat penting</p>
            </div>
        </div>

        <!-- Notifications List -->
        <div class="space-y-3" x-data="{ 
            markAsRead(id) {
                fetch(`/notifications/${id}/read`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                    }
                }).then(() => {
                    document.getElementById('notif-' + id).classList.remove('border-l-blue-500');
                    document.getElementById('notif-' + id).classList.add('border-l-gray-200');
                    document.getElementById('badge-' + id).remove();
                });
            }
        }">
            @forelse($notifications as $notif)
            <div id="notif-{{ $notif->id }}" 
                 class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 {{ $notif->is_read ? 'border-l-gray-200' : 'border-l-blue-500' }} border-l-4 shadow-minimal hover:shadow-minimal-hover transition-all duration-300 animate-fade-in-scale"
                 style="animation-delay: {{ $loop->index * 50 }}ms;">
                <div class="p-6">
                    <div class="flex items-start gap-4">
                        <!-- Icon -->
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl flex items-center justify-center
                            @if($notif->type === 'tugas_baru') bg-blue-100
                            @elseif($notif->type === 'deadline_reminder') bg-yellow-100
                            @elseif($notif->type === 'nilai_keluar') bg-green-100
                            @else bg-purple-100
                            @endif">
                            <svg class="w-6 h-6
                                @if($notif->type === 'tugas_baru') text-blue-600
                                @elseif($notif->type === 'deadline_reminder') text-yellow-600
                                @elseif($notif->type === 'nilai_keluar') text-green-600
                                @else text-purple-600
                                @endif" 
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($notif->type === 'tugas_baru')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                @elseif($notif->type === 'deadline_reminder')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                @elseif($notif->type === 'nilai_keluar')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                @else
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                @endif
                            </svg>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between mb-2">
                                <h3 class="text-base font-semibold text-gray-900">{{ $notif->title }}</h3>
                                @if(!$notif->is_read)
                                <span id="badge-{{ $notif->id }}" class="flex-shrink-0 ml-2 px-2 py-1 bg-blue-100 text-blue-600 text-xs font-medium rounded-full">
                                    Baru
                                </span>
                                @endif
                            </div>
                            <p class="text-sm text-gray-600 mb-3">{{ $notif->message }}</p>
                            <div class="flex items-center gap-4">
                                <span class="text-xs text-gray-400">
                                    {{ $notif->created_at->diffForHumans() }}
                                </span>
                                @if($notif->link)
                                <a href="{{ $notif->link }}" 
                                   @if(!$notif->is_read) @click="markAsRead({{ $notif->id }})" @endif
                                   class="text-xs text-blue-600 hover:text-blue-700 font-medium transition-colors">
                                    Lihat Detail →
                                </a>
                                @endif
                                @if(!$notif->is_read)
                                <button @click="markAsRead({{ $notif->id }})" 
                                        class="text-xs text-gray-500 hover:text-gray-700 font-medium transition-colors">
                                    Tandai Dibaca
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 shadow-minimal p-12 text-center">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
                <p class="text-gray-500 text-lg font-medium mb-1">Tidak Ada Notifikasi</p>
                <p class="text-gray-400 text-sm">Notifikasi baru akan muncul di sini</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($notifications->hasPages())
        <div class="mt-8">
            {{ $notifications->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
