<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Postingan Populer</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12pt; }
        .header { text-align: center; font-weight: bold; font-size: 14pt; }
        .content { margin: 20px 0; }
        .footer { margin-top: 40px; font-size: 10pt; }
        .bold { font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <p>KENNGALLERY</p>
        <p><strong>LAPORAN POSTINGAN POPULER</strong></p>
        <p>{{ $date }}</p>
    </div>

    <div class="content">
        <p>Kepada Yth,</p>
        <p><strong>Admin {{ $admin_name }}</strong></p>
        <p>Berikut adalah laporan postingan yang memiliki interaksi terbanyak:</p>

        <h3>1. Postingan dengan Like Terbanyak</h3>
        <p><span class="bold">Judul:</span> {{ $mostLikedPost->photo_name ?? '-' }}</p>
        <p><span class="bold">Total Like:</span> {{ $mostLikedPost->likes_count ?? 0 }}</p>

        <h3>2. Postingan dengan Komentar Terbanyak</h3>
        <p><span class="bold">Judul:</span> {{ $mostCommentedPost->photo_name ?? '-' }}</p>
        <p><span class="bold">Total Komentar:</span> {{ $mostCommentedPost->comments_count ?? 0 }}</p>
    </div>

    <div class="footer">
        <p>Demikian laporan ini dibuat untuk digunakan sebagaimana mestinya.</p>
        <p>Hormat kami,</p>
        <p><strong>Admin KENNGALLERY</strong></p>
    </div>
</body>
</html>
