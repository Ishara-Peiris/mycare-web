<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resources</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #2E073F, #7A1CAC, #AD49E1);
            color: #fff;
        }
        .search-bar {
            max-width: 500px;
            margin: 0 auto 30px auto;
        }
        .card {
            border-radius: 20px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
        }
        .card:hover {
            transform: translateY(-5px) scale(1.03);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }
        .title-color {
            color: #fff;
        }
        .link-purple {
            color: #EBD3F8;
            font-weight: 600;
        }
        .nav-tabs .nav-link {
            color: #EBD3F8;
            font-weight: 600;
            border: none;
            border-bottom: 3px solid transparent;
        }
        .nav-tabs .nav-link.active {
            color: #fff;
            background: transparent;
            border-bottom: 3px solid #EBD3F8;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <!-- Page Title -->
        <h2 class="text-center fw-bold mb-4">Resources for {{ $category->name }}</h2>

        <!-- Search Bar -->
        <div class="search-bar">
            <input type="text" id="searchInput" class="form-control form-control-lg" placeholder="Search resources...">
        </div>

        <!-- Submenu Tabs -->
        <ul class="nav nav-tabs justify-content-center mb-4" id="resourceTabs" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" id="articles-tab" data-bs-toggle="tab" data-bs-target="#articles" type="button">Articles</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="videos-tab" data-bs-toggle="tab" data-bs-target="#videos" type="button">Videos</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents" type="button">Documents</button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="resourceTabsContent">
            <!-- Articles -->
            <div class="tab-pane fade show active" id="articles" role="tabpanel">
                <div class="row g-4" id="articlesGrid">
                    @foreach($resources->where('type', 'article') as $resource)
                        <div class="col-12 col-sm-6 col-md-4 resource-card">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body text-center">
                                    <h5 class="card-title fw-bold title-color">{{ $resource->title }}</h5>
                                    <p class="card-text small">{{ Str::limit($resource->description, 100) }}</p>
                                    <a href="{{ $resource->file_url }}" target="_blank" class="link-purple">Read More →</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Videos -->
            <div class="tab-pane fade" id="videos" role="tabpanel">
                <div class="row g-4" id="videosGrid">
                    @foreach($resources->where('type', 'video') as $resource)
                        <div class="col-12 col-sm-6 col-md-4 resource-card">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body text-center">
                                    <h5 class="card-title fw-bold title-color">{{ $resource->title }}</h5>
                                    <p class="card-text small">{{ Str::limit($resource->description, 100) }}</p>
                                    <a href="{{ $resource->file_url }}" target="_blank" class="link-purple">Watch Video →</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Documents -->
            <div class="tab-pane fade" id="documents" role="tabpanel">
                <div class="row g-4" id="documentsGrid">
                    @foreach($resources->where('type', 'pdf') as $resource)
                        <div class="col-12 col-sm-6 col-md-4 resource-card">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body text-center">
                                    <h5 class="card-title fw-bold title-color">{{ $resource->title }}</h5>
                                    <p class="card-text small">{{ Str::limit($resource->description, 100) }}</p>
                                    <a href="{{ $resource->file_url }}" target="_blank" class="link-purple">Download PDF →</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Search Script -->
    <script>
        document.getElementById("searchInput").addEventListener("keyup", function() {
            let filter = this.value.toLowerCase();
            let activeTab = document.querySelector(".tab-pane.active");
            let cards = activeTab.querySelectorAll(".resource-card");

            cards.forEach(function(card) {
                let title = card.querySelector(".card-title").innerText.toLowerCase();
                if (title.includes(filter)) {
                    card.style.display = "";
                } else {
                    card.style.display = "none";
                }
            });
        });
    </script>
</body>
</html>
