<html lang="en">  

<head>  
    <meta charset="UTF-8">  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Generate PDF CodeIgniter 4</title>  

</head>  

<body>  
<h2>Data Riwayat Barang Masuk</h2>  

<table border=1 width=80% cellpadding=2 cellspacing=0 style="margin-top: 5px; text-align:center">  
    <thead>    
        <tr bgcolor=silver align=center>  
            <td width="5%">No</td>  
            <td width="25%">Tanggal</td>  
            <td width="20%">Waktu</td>  
            <td width="50%">Barang</td>  
            <td width="20%">Jumlah</td>  
        </tr>
    </thead>    
    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($data['barang'] as $barang): ?>
        <tr bgcolor=silver align=center>
            <td width="5%"><?= $no ++?></td>  
            <td width="25%">
                <?= \Carbon\Carbon::parse($barang['tanggal_masuk'])->format('d-m-Y') ?>
            </td>
            <td width="20%">
                <?= \Carbon\Carbon::parse($barang['tanggal_masuk'])->format('h:i') ?>
            </td>
            <td width="50%">
                <?= $barang['nama_barang'] ?>
            </td>
            <td width="20%">
                <?= $barang['jumlah'] ?>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>  
</body>  

</html>