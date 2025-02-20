<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .info {
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <div class="header">Official Album Report Of: {{ $album->album_name }}</div>

    <div class="info">
        <strong>Date:</strong> {{ $date }}<br>
        <strong>Filter:</strong>
        {{ $filter == 'likes' ? 'Most Liked' : ($filter == 'comments' ? 'Most Commented' : 'All') }}
    </div>

    <div class="letter-body">
        <p>Dear {{ $admin_name }},</p>
        <p>We are pleased to present the official report of the album <strong>{{ $album->album_name }}</strong>. The
            report provides an overview of engagement metrics, specifically highlighting @if ($filter == 'likes' || $filter == 'all')
                the most liked
            @endif
            @if ($filter == 'comments' || $filter == 'all')
                the most commented
            @endif
            photos within the album.
        </p>
        <p>Please find below the detailed statistics for the top 5 content:</p>

    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Photo Title</th>
                @if ($filter == 'likes' || $filter == 'all')
                    <th>Like Count</th>
                @endif
                @if ($filter == 'comments' || $filter == 'all')
                    <th>Comment Count</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($photos->take(5) as $index => $photo)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $photo->photo_name }}</td>
                    @if ($filter == 'likes' || $filter == 'all')
                        <td>{{ $photo->likes_count ?? 0 }}</td>
                    @endif
                    @if ($filter == 'comments' || $filter == 'all')
                        <td>{{ $photo->comments_count ?? 0 }}</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    <p>We trust that this report will provide valuable insights into the album's performance. Should you have any
        questions, please do not hesitate to contact us.</p>

    <p>Sincerely,</p><br><br>
    <p><strong>KennGallery</strong></p>

</body>

</html>
