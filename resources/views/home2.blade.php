<!DOCTYPE html>
<html>
<head>
    <title>Posts List</title>
    <style>
        /* Overall page styling */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f0ff; /* light purple background */
            margin: 0;
            padding: 0;
        }

        /* Header styling */
        h1 {
            text-align: center;
            background-color: #6a0dad; /* deep purple */
            color: white;
            padding: 20px 0;
            margin: 0;
            font-size: 2rem;
            letter-spacing: 1px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        /* Container for posts */
        .posts-container {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* Each post card */
        .post-card {
            background-color: #fff; /* white card background */
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(106, 13, 173, 0.1);
            padding: 20px;
            margin-bottom: 25px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(106, 13, 173, 0.15);
        }

        /* Post title */
        .post-card p:first-child {
            font-size: 1.3rem;
            font-weight: bold;
            color: #6a0dad;
            margin-bottom: 10px;
        }

        /* Post description */
        .post-card p:nth-child(2) {
            font-size: 1rem;
            color: #333;
            margin-bottom: 15px;
            line-height: 1.6;
        }

        /* Comment section area */
        .comment-section {
            border-top: 1px solid #eee;
            padding-top: 10px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <h1>Posts</h1>

    <div class="posts-container">
        @foreach($post as $posts)
            <div class="post-card">
                <p>{{ $posts->title }}</p>
                <p>{{ $posts->description }}</p>

                <div class="comment-section">
                    <livewire:comments :model="$posts"/>
                </div>
            </div>
        @endforeach
    </div>

</body>
</html>
