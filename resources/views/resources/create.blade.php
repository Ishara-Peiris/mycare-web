<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Resource</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #2E073F, #7A1CAC, #AD49E1);
            font-family: 'Poppins', sans-serif;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 50px 15px;
        }

        .upload-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 30px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            font-weight: 700;
            text-shadow: 1px 1px 8px rgba(0,0,0,0.4);
        }

        .form-control, .form-select, textarea {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #fff;
            border-radius: 10px;
            padding: 12px;
            margin-bottom: 15px;
            backdrop-filter: blur(10px);
        }

        .form-control::placeholder,
        textarea::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        textarea {
            resize: none;
            min-height: 100px;
        }

        .btn-upload {
            background: #EBD3F8;
            color: #7A1CAC;
            font-weight: 600;
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-upload:hover {
            background: #fff;
            color: #7A1CAC;
            transform: scale(1.05);
        }

        input[type="file"] {
            color: #fff;
        }

    </style>
</head>
<body>
    <div class="upload-card">
        <h2>Upload Resource</h2>
        <form action="{{ route('resources.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="title" placeholder="Title" class="form-control" required>
            <textarea name="description" placeholder="Description" class="form-control"></textarea>

            <select name="category_id" class="form-select" required>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>

            <select name="type" class="form-select" required>
                <option value="article">Article</option>
                <option value="video">Video</option>
                <option value="pdf">PDF</option>
            </select>

            <input type="file" name="file" class="form-control" required>

            <button type="submit" class="btn btn-upload mt-3">Upload</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
