<!DOCTYPE html>
<html>
    <body>
        <h1>Pegawai</h1>
        <table border="1" width="100%">
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
            </tr>

            <?php
                $i = 1;
                foreach ($data as $row):
            ?>

            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row->nama; ?></td>
                <td><?php echo $row->jabatan; ?></td>
                <td><?php echo $row->jenis_kelamin; ?></td>
                <td><?php echo $row->tanggal_lahir; ?></td>
            </tr>

            <?php endforeach; ?>

        </table>
    </body>
</html>