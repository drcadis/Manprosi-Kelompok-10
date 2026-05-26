<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Semua Barang - TelU Lost & Found</title>

  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <!-- Custom CSS -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('css/semuaBarang.css') }}" rel="stylesheet">

</head>
<body>

  @include('partials.navbar')

  <!-- Hero Section -->
  <section class="hero-section position-relative" style="height: 300px; background-image: url('/assets/images/tumnailSemua.png'); background-size: cover; background-position: center; background-attachment: scroll;">
    <div class="container">
      <div class="hero-text-section text-center">
        <div class="hero-divider"></div>
        <h1 class="hero-title mb-3">Ayo Cari Produk Kamu</h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cari Produk</li>
          </ol>
        </nav>
      </div>
    </div>

  </section>

  <!-- Filter and Search Section -->
  <section class="filter-section py-4 bg-light border-top">
    <div class="container">
      <div class="row align-items-center mb-3">
        <div class="col-md-6">
          <div class="d-flex align-items-center gap-3 flex-wrap">
            <button class="btn btn-filter" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse">
              <i class="bi bi-funnel me-2"></i>Filters
              <i class="bi bi-chevron-down ms-2"></i>
            </button>
            <div class="category-tabs">
              <button class="category-tab active" data-category="all">All</button>
              @foreach ($kategoris as $kategori)
                <button class="category-tab" data-category="{{ $kategori->id }}">
                  {{ $kategori->nama_kategori }}
                </button>
              @endforeach
            </div>
          </div>
        </div>
        <div class="col-md-6 text-md-end">
          <div class="d-flex align-items-center justify-content-md-end gap-3">
            <span class="results-count text-muted">
                {{ $getAll->total() }} results found
            </span>
            <div class="view-toggle">
              <button class="view-btn active" data-view="grid" title="Grid View">
                <i class="bi bi-grid-3x3-gap"></i>
              </button>
              <button class="view-btn" data-view="list" title="List View">
                <i class="bi bi-list-ul"></i>
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Filter Collapse -->
      <div class="collapse" id="filterCollapse">
        <div class="card card-body bg-white border">
          <div class="row">
            <div class="col-md-3 mb-3">
              <label class="form-label fw-bold">Status</label>
              <select class="form-select">
                <option value="">All Status</option>
                <option value="found">Ditemukan</option>
                <option value="not-found">Belum Ditemukan</option>
              </select>
            </div>
            <div class="col-md-3 mb-3">
              <label class="form-label fw-bold">Lokasi</label>
              <select class="form-select">
                <option value="">All Lokasi</option>
                <option value="feb">FEB</option>
                <option value="fte">FTE</option>
                <option value="fif">FIF</option>
              </select>
            </div>
            <div class="col-md-3 mb-3">
              <label class="form-label fw-bold">Tanggal</label>
              <input type="date" class="form-control">
            </div>
            <div class="col-md-3 mb-3 d-flex align-items-end">
              <button class="btn btn-danger w-100">Apply Filters</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Items Grid Section -->
  <section class="items-grid-section py-5 bg-white">
    <div class="container">
      <div class="items-grid" id="itemsGrid">

        @if($getAll->count())
            @foreach($getAll as $barang)
                <div class="item-card" data-category="{{ $barang->id_kategori ?? '' }}">
                    <div class="item-image-wrapper">
                        <img 
                            src="{{ $barang->foto_barang 
                                ? asset('storage/' . $barang->foto_barang) 
                                : asset('assets/images/no-image.png') }}" 
                            alt="{{ $barang->nama_barang }}"
                        >

                        <div class="item-timer">
                            <i class="bi bi-clock me-1"></i>
                            {{ \Carbon\Carbon::parse($barang->tanggal)->format('d M Y') }}
                        </div>

                        <button class="item-favorite" type="button">
                            <i class="bi bi-heart"></i>
                        </button>
                    </div>

                    <div class="item-content">
                        <h5 class="item-title">{{ $barang->nama_barang }}</h5>

                        <span class="item-category">{{ $barang->kategori?->nama_kategori ?? '-' }}</span>

                        <div class="item-price">
                            <span class="text-muted">Lokasi:</span> {{ $barang->lokasi }}
                        </div>

                        <div class="item-creator">
                            <span class="text-muted">Status:</span> 
                            {{ ucfirst($barang->status_barang) }}
                        </div>

                        <a href="{{ route('detail', $barang->id) }}"
                          class="btn btn-danger btn-sm w-100 mt-2">
                            Lihat Detail →
                        </a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12 text-center py-5">
                <p class="text-muted">Tidak ada barang yang ditemukan.</p>
            </div>
        @endif

      </div>

      <!-- Load More Button -->
      <div class="text-center mt-5">
          {{ $getAll->links() }}
      </div>
    </div>
  </section>

  @include('partials.footer')

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- Custom JS -->
  <script>
    // Category Filter
    document.querySelectorAll('.category-tab').forEach(tab => {
      tab.addEventListener('click', function() {
        document.querySelectorAll('.category-tab').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
        
        const category = this.getAttribute('data-category');
        const cards = document.querySelectorAll('.item-card');
        
        cards.forEach(card => {
          if (category === 'all' || card.getAttribute('data-category') === category) {
            card.style.display = 'block';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });

    // View Toggle
    document.querySelectorAll('.view-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        
        const view = this.getAttribute('data-view');
        const grid = document.getElementById('itemsGrid');
        
        if (view === 'list') {
          grid.classList.add('list-view');
        } else {
          grid.classList.remove('list-view');
        }
      });
    });

    // Favorite Toggle
    document.querySelectorAll('.item-favorite').forEach(btn => {
      btn.addEventListener('click', function() {
        const icon = this.querySelector('i');
        if (icon.classList.contains('bi-heart-fill')) {
          icon.classList.remove('bi-heart-fill', 'text-danger');
          icon.classList.add('bi-heart');
        } else {
          icon.classList.remove('bi-heart');
          icon.classList.add('bi-heart-fill', 'text-danger');
        }
      });
    });
  </script>
  
</body>
</html>


