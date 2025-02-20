<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Popular Posts Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12pt; }
        .header { text-align: center; font-weight: bold; font-size: 14pt; }
        .content { margin: 20px 0; }
        .footer { margin-top: 40px; font-size: 10pt; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="header">
        <p>KennGallery</p>
        <p><strong>POPULAR POSTS REPORT</strong></p>
        <p>{{ $date }}</p>
    </div>

    <div class="content">
        <p>To,</p>
        <p><strong>KennGallery</strong></p>
        <p>Below is the report of posts with the highest interactions:</p>

        <h3>1. Most Liked Posts</h3>
        <table>
            <tr>
                <th>Title</th>
                <th>Total Likes</th>
            </tr>
            @foreach($mostLikedPosts->take(5) as $post)
            <tr>
                <td>{{ $post->photo_name ?? '-' }}</td>
                <td>{{ $post->likes_count ?? 0 }}</td>
            </tr>
            @endforeach
        </table>

        <h3>2. Most Commented Posts</h3>
        <table>
            <tr>
                <th>Title</th>
                <th>Total Comments</th>
            </tr>
            @foreach($mostCommentedPosts->take(5) as $post)
            <tr>
                <td>{{ $post->photo_name ?? '-' }}</td>
                <td>{{ $post->comments_count ?? 0 }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <div class="footer">
        <p>This report is created for reference as needed.</p>
        <p>Best regards,</p><br><br>
        <p><strong> {{ $admin_name }} | Admin KennGallery</strong></p>
    </div>
</body>
</html>
