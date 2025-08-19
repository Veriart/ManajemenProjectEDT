<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Berita Acara Serah Terima (BAST)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 12pt;
            line-height: 1.5;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header img {
            max-height: 80px;
            margin-bottom: 10px;
        }
        h1 {
            font-size: 18pt;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            text-decoration: underline;
        }
        .content {
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table.info {
            margin-bottom: 30px;
        }
        table.info td {
            padding: 5px;
            vertical-align: top;
        }
        table.info td:first-child {
            width: 150px;
        }
        table.tasks {
            border: 1px solid #000;
        }
        table.tasks th, table.tasks td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        table.tasks th {
            background-color: #f2f2f2;
        }
        .signatures {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }
        .signature {
            width: 45%;
            text-align: center;
        }
        .signature-line {
            margin-top: 70px;
            border-top: 1px solid #000;
            padding-top: 5px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 10pt;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('logo/edt.png') }}" alt="Logo">
        <h1>BERITA ACARA SERAH TERIMA (BAST)</h1>
        <p>Nomor: BAST-{{ $project->code }}</p>
    </div>
    
    <div class="content">
        <p>Pada hari ini, {{ now()->format('l') }} tanggal {{ now()->format('d') }} bulan {{ now()->format('F') }} tahun {{ now()->format('Y') }}, yang bertanda tangan di bawah ini:</p>
        
        <table class="info">
            <tr>
                <td>Nama Proyek</td>
                <td>: {{ $project->name }}</td>
            </tr>
            <tr>
                <td>Lokasi Proyek</td>
                <td>: {{ $project->project_location }}</td>
            </tr>
            <tr>
                <td>Klien</td>
                <td>: {{ $project->thirdParty->name }}</td>
            </tr>
            <tr>
                <td>Tanggal Mulai</td>
                <td>: {{ $project->start_date ? $project->start_date->format('d F Y') : '-' }}</td>
            </tr>
            <tr>
                <td>Tanggal Selesai</td>
                <td>: {{ $project->end_date ? $project->end_date->format('d F Y') : '-' }}</td>
            </tr>
        </table>
        
        <p>Dengan ini menyatakan bahwa pekerjaan tersebut di atas telah selesai dilaksanakan dengan baik dan telah diterima oleh pihak kedua. Adapun rincian pekerjaan yang telah dilaksanakan adalah sebagai berikut:</p>
        
        <table class="tasks">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pekerjaan</th>
                    <th>Tanggal</th>
                    <th>Koordinator</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($project->tasks as $index => $task)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->task_date->format('d/m/Y') }}</td>
                    <td>{{ $task->coordinator }}</td>
                    <td>{{ $task->status }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Tidak ada data pekerjaan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <p>Demikian Berita Acara Serah Terima ini dibuat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.</p>
    </div>
    
    <div style="display: flex; justify-content: space-between;">
        <div style="width: 45%; text-align: center;">
            <p>Pihak Pertama,<br>PT. Eka Daya Teknologi</p>
            <div style="margin-top: 70px;">
                <p style="border-top: 1px solid #000; padding-top: 5px;">( _________________________ )</p>
                <p>Direktur</p>
            </div>
        </div>
        
        <div style="width: 45%; text-align: center;">
            <p>Pihak Kedua,<br>{{ $project->thirdParty->name }}</p>
            <div style="margin-top: 70px;">
                <p style="border-top: 1px solid #000; padding-top: 5px;">( _________________________ )</p>
                <p>Penanggung Jawab</p>
            </div>
        </div>
    </div>
    
    <div class="footer">
        <p>PT. Eka Daya Teknologi - {{ now()->format('Y') }}</p>
    </div>
</body>
</html>