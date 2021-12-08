<style>
    .container {
        max-width: 100vw;
        padding-left: 2vw;
        padding-right: 2vw;
    }

    .title {
        display: grid;
        justify-content: center;
        text-align: center;
        width: 100%;
    }

    .title>h2 {
        margin: auto;
        width: 100vw;
        padding-bottom: 5px;
    }

    .biodata {
        margin-bottom: 1em;
    }

    .content {
        max-width: 100vw;
        margin-bottom: 1em;
        /* overflow-x: auto; */
    }

    .bordered {
        border: 1px solid black;
    }

    .bordered td,
    th {
        border: 1px solid black;
        min-width: 25px;
        padding: 5px;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        text-transform: uppercase;
    }
</style>

<?php
$bln = 9;
if ($bln == 2) $i = 29;
if (in_array($bln, [1, 3, 5, 7, 8, 10, 12])) $i = 31;
if (in_array($bln, [4, 6, 9, 11])) $i = 30;
?>

<div class="container">
    <div class="title">
        <h2>PERUMDA AIR MINUM TIRTA SATRIA</h2>
        <h2>CABANG {cabang}</h2>
        <h2>PEMANTAUAN TEKANAN, JAM LAYANAN, & KUALITAS AIR</h2>
        <h2>Bulan {bulan} {tahun}</h2>
    </div>
    <hr>
    <div class="biodata">
        <h3>PENANGGUNG JAWAB JARINGAN : {nama} </h3>
    </div>

    <div class="content">
        <table border="1" class="bordered">
            <thead style="background-color: #010189; color:white;">
                <tr>
                    <th rowspan="4">No</th>
                    <th rowspan="4">Manometer</th>
                    <th rowspan="4">Lokasi</th>

                </tr>
                <tr>
                    <th colspan="<?= $i ?>">Waktu Pengukuran Manometer</th>
                </tr>
                <tr>
                    <th colspan="<?= $i ?>">Bulan : {bulan} {tahun}</th>
                </tr>
                <tr>
                    <?php for ($x = 0; $x < $i; $x++) : ?>
                        <th><?= $x + 1 ?></th>
                    <?php endfor; ?>
                </tr>
            </thead>
            <tbody>
                <?php $n = 1; ?>
                <?php foreach ($manometer as $m) : ?>
                    <tr>
                        <td><?= $n ?></td>
                        <td nowrap><?= $m->nama_manometer ?></td>
                        <td nowrap><?= $m->lokasi ?></td>
                        <?php for ($x = 0; $x < $i; $x++) {
                            $tgl = $x + 1;
                            $id_manometer = $m->id_manometer;
                            $find = array_values(array_filter($data, function ($v) use ($tgl, $id_manometer) {
                                $result = null;
                                if ($v->tgl == $tgl && $v->id_manometer == $id_manometer) $result = $v;
                                return $result;
                            }));
                            $tekanan = (count($find) > 0) ? $find[0]->tekanan : "";
                        ?>
                            <td><?= $tekanan ?></td>
                        <?php } ?>
                    </tr>
                    <?php $n++ ?>
                <?php endforeach ?>
            </tbody>
        </table>

    </div>
</div>