@extends('admin.layouts.app')

@section('title', 'Manajemen Kategori')
@section('header', 'Manajemen Kategori')

@section('content')
<div class="container mx-auto px-6 py-8">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Manajemen Kategori</h1>
                <p class="mt-2 text-sm text-gray-600">Kelola dan organisasi kategori bootcamp</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center px-4 py-2 bg-orange border border-transparent rounded-lg shadow-sm text-sm font-medium text-white hover:bg-orange-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange transition-colors duration-200">
                    <i class="fas fa-plus mr-2 -ml-1"></i>
                    Tambah Kategori Baru
                </a>
            </div>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="mb-6 bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex-1 max-w-md">
                <div class="relative">
                    <input type="text"
                           id="search"
                           placeholder="Cari kategori..."
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <select id="status-filter" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent">
                    <option value="">Semua Status</option>
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </select>
                <button id="reset-filters" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors duration-200">
                    <i class="fas fa-redo mr-2"></i> Reset
                </button>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4 rounded-lg shadow-md">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-check-circle text-green-400"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-green-700">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
    <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded-lg shadow-md">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-circle text-red-400"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-red-700">{{ session('error') }}</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Categories Table -->
    <div class="bg-white shadow-lg rounded-xl overflow-hidden border-0">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <i class="fas fa-grip-vertical mr-1"></i> Order
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kategori
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Deskripsi
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Bootcamp
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Aksi</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($categories as $category)
                    <tr class="hover:bg-gray-50 transition-colors duration-150 cursor-move" data-id="{{ $category->id }}" draggable="true">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <div class="flex items-center">
                                <i class="fas fa-grip-vertical text-gray-400 mr-2"></i>
                                <span>{{ $category->sort_order }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if($category->icon)
                                    <div class="flex-shrink-0 h-8 w-8 rounded-lg flex items-center justify-center" style="background-color: {{ $category->color ?? '#f3f4f6' }}">
                                        <i class="{{ $category->icon }} text-white text-sm"></i>
                                    </div>
                                @endif
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">{{ $category->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $category->slug }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ Str::limit($category->description, 50) ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $category->bootcamps_count }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('admin.categories.toggle-active', $category) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="inline-flex items-center">
                                    @if($category->is_active)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 hover:bg-green-200 cursor-pointer">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 hover:bg-red-200 cursor-pointer">
                                            Tidak Aktif
                                        </span>
                                    @endif
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="text-indigo-600 hover:text-indigo-900">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada kategori ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($categories->hasPages())
    <div class="mt-6 bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 rounded-lg shadow-lg">
        <div class="flex-1 flex justify-between sm:hidden">
            {{ $categories->links() }}
        </div>
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Menampilkan <span class="font-medium">{{ $categories->firstItem() }}</span> hingga <span class="font-medium">{{ $categories->lastItem() }}</span> dari <span class="font-medium">{{ $categories->total() }}</span> hasil
                </p>
            </div>
            <div>
                {{ $categories->links() }}
            </div>
        </div>
    </div>
    @endif
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search and filter functionality
    const searchInput = document.getElementById('search');
    const statusFilter = document.getElementById('status-filter');
    const resetButton = document.getElementById('reset-filters');
    const tableRows = document.querySelectorAll('tbody tr[data-id]');

    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusValue = statusFilter.value;

        tableRows.forEach(row => {
            const name = row.querySelector('td:nth-child(2) .text-sm.font-medium').textContent.toLowerCase();
            const slug = row.querySelector('td:nth-child(2) .text-sm.text-gray-500').textContent.toLowerCase();
            const description = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            const isActive = row.querySelector('td:nth-child(5) button span').textContent.includes('Aktif');

            const matchesSearch = name.includes(searchTerm) ||
                                 slug.includes(searchTerm) ||
                                 description.includes(searchTerm);

            const matchesStatus = statusValue === '' ||
                                 (statusValue === '1' && isActive) ||
                                 (statusValue === '0' && !isActive);

            if (matchesSearch && matchesStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    searchInput.addEventListener('input', filterTable);
    statusFilter.addEventListener('change', filterTable);

    resetButton.addEventListener('click', function() {
        searchInput.value = '';
        statusFilter.value = '';
        filterTable();
    });

    // Simple drag and drop for reordering
    const table = document.querySelector('tbody');
    let draggedRow = null;

    table.addEventListener('dragstart', function(e) {
        const row = e.target.closest('tr');
        if (row && row.style.display !== 'none') {
            draggedRow = row;
            draggedRow.classList.add('opacity-50');
        }
    });

    table.addEventListener('dragend', function(e) {
        if (draggedRow) {
            draggedRow.classList.remove('opacity-50');
            draggedRow = null;
        }
    });

    table.addEventListener('dragover', function(e) {
        e.preventDefault();
        const afterElement = getDragAfterElement(table, e.clientY);
        if (afterElement == null) {
            table.appendChild(draggedRow);
        } else {
            table.insertBefore(draggedRow, afterElement);
        }
    });

    table.addEventListener('drop', function(e) {
        e.preventDefault();
        updateSortOrder();
    });

    function getDragAfterElement(container, y) {
        const draggableElements = [...container.querySelectorAll('tr:not(.dragging)')].filter(row => row.style.display !== 'none');

        return draggableElements.reduce((closest, child) => {
            const box = child.getBoundingClientRect();
            const offset = y - box.top - box.height / 2;

            if (offset < 0 && offset > closest.offset) {
                return { offset: offset, element: child };
            } else {
                return closest;
            }
        }, { offset: Number.NEGATIVE_INFINITY }).element;
    }

    function updateSortOrder() {
        const rows = Array.from(table.querySelectorAll('tr[data-id]')).filter(row => row.style.display !== 'none');
        const categories = [];

        rows.forEach((row, index) => {
            categories.push({
                id: row.dataset.id,
                sort_order: index
            });
        });

        fetch('{{ route("admin.categories.update-sort") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ categories: categories })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Sort order updated successfully');
            }
        })
        .catch(error => {
            console.error('Error updating sort order:', error);
        });
    }
});
</script>
@endsection
@endsection
