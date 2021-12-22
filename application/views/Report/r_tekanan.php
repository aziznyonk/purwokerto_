<style>
    h2 {
        margin: auto;
        width: 100vw;
        padding-bottom: 5px;
    }

    .biru {
        background-color: #010189 !important;
        color: white !important;
    }

    table {
        border-collapse: collapse;
    }

    table td {
        min-width: 30px;
        white-space: nowrap;
    }

    .text-right {
        text-align: right;
    }

    @media print {
        body * {
            visibility: hidden;
            -webkit-print-color-adjust: exact !important;
        }

        #section-to-print,
        #section-to-print * {
            visibility: visible;
        }

        #section-to-print {
            position: absolute;
            left: 0;
            top: 0;
        }
    }

    @page {
        size: A4;
        margin-left: 5mm;
        margin-top: 5mm;
    }
</style>

<?php
$bln = 9;
if ($bln == 2) $i = 29;
if (in_array($bln, [1, 3, 5, 7, 8, 10, 12])) $i = 31;
if (in_array($bln, [4, 6, 9, 11])) $i = 30;
function formatKoma($val)
{
    $x = explode('.', $val);
}
?>

<div id="section-to-print">
    <table>
        <thead>
            <tr>
                <td align="center" colspan="<?= $i + 4 ?>">
                    <h2>PERUMDA AIR MINUM TIRTA SATRIA</h2>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="<?= $i + 4 ?>">
                    <h2>CABANG {cabang}</h2>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="<?= $i + 4 ?>">
                    <h2>PEMANTAUAN TEKANAN, JAM LAYANAN, & KUALITAS AIR</h2>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="<?= $i + 4 ?>">
                    <h2>Bulan {bulan} {tahun}</h2>
                </td>
            </tr>
            <tr>
                <td colspan="10">
                    <h3>PENANGGUNG JAWAB JARINGAN : {nama} </h3>
                </td>
            </tr>
        </thead>

    </table>
    <table border="1">
        <thead class="biru">
            <tr>
                <th rowspan="3">No</th>
                <th rowspan="3">Manometer</th>
                <th rowspan="3">Lokasi</th>
                <th colspan="<?= $i ?>">Waktu Pengukuran Manometer</th>
                <th rowspan="3">Rata<sup>2</sup> Tekanan Per- Wilayah</th>
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
            <?php
            $n = 1;
            $totRata = 0;
            foreach ($manometer as $m) :
                $comTekanan = 0;
                $pembagi = 0;
            ?>
                <tr>
                    <td><?= $n ?></td>
                    <td nowrap><?= $m->nama_manometer ?></td>
                    <td nowrap><?= $m->lokasi ?></td>
                    <?php for ($x = 0; $x < $i; $x++) :
                        $tgl = $x + 1;
                        $id_manometer = $m->id_manometer;
                        $find = array_values(array_filter($data, function ($v) use ($tgl, $id_manometer) {
                            $result = null;
                            if ($v->tgl == $tgl && $v->id_manometer == $id_manometer) $result = $v;
                            return $result;
                        }));
                        $tekanan = (count($find) > 0) ? $find[0]->tekanan :  null;
                        $pembagi = (count($find) > 0) ? $pembagi + 1 : $pembagi + 0;
                        $comTekanan = $comTekanan + (float) $tekanan;
                    ?>
                        <td align="right"><?= $tekanan ?></td>
                    <?php
                    endfor;
                    $rata2 = round(($comTekanan / $pembagi), 2);
                    $totRata = round(($totRata + $rata2), 2);
                    ?>
                    <td class="text-right"><?= floatval($rata2) ?></td>
                </tr>
                <?php $n++ ?>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="<?= 3 + $x ?>">Total Rata - Rata Tekanan</th>
                <th class="text-right"><?= round(($totRata / ($n - 1)), 2) ?></th>
            </tr>
        </tfoot>
    </table>
</div>