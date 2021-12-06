<style>
    .container {
        width: 100vw;
        padding: 2vw;
    }

    .title {
        display: flex;
        justify-content: center;
    }

    .biodata {
        margin-bottom: 1em;
    }

    .content {
        margin-bottom: 1em;
    }

    .bordered {
        border: 1px solid black;
    }

    .bordered td,
    th {
        border: 1px solid black;
        min-width: 50px;
        padding-left: 5px;
        padding-right: 5px;
    }

    table {
        border-collapse: collapse;
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
        <h2>Laporan Harian Input Tekanan</h2>
    </div>

    <div class="biodata">
        <table>
            <tr>
                <td>Nama</td>
                <td>: <?= $user->nama ?> (<?= $user->nipam ?>)</td>
            </tr>
            <tr>
                <td>Bulan</td>
                <td>: <?= $bulan ?> <?= $tahun ?></td>
            </tr>
        </table>
    </div>

    <div class="content">
        <table border="1" class="bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th nowrap>Manometer</th>
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
                        <td nowrap><?= $m->id_manometer ?> (<?= $m->nama_manometer ?>)</td>
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