@extends('layouts.master')

@section('title', 'FRS - Akses Ditolak')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50">
    <div class="bg-white rounded-lg shadow-md p-8 text-center max-w-md w-full mx-4">
        <div class="mb-6">
            <svg class="mx-auto h-16 w-16 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z">
                </path>
            </svg>
        </div>
        
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Akses Terbatas</h1>
        
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-6">
            <p class="text-yellow-800 text-lg font-medium">
                Anda bukan dosen wali
            </p>
            <p class="text-yellow-700 text-sm mt-2">
                Halaman FRS hanya dapat diakses oleh dosen yang menjadi dosen wali kelas.
            </p>
        </div>
        
        <div class="mt-6">
            <a href="{{ route('home') }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md transition duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
@endsection