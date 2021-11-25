<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Pelanggan Reguler</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/bootstrap/css/dataTables.bootstrap.css">
</head>

<body>
    <div id="result" class="container">
        <div class="progress text-center">
            <div id="progress-bar" class="progress-bar text-center" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
            <span id="textProgress"></span>
        </div>
        <pre id="arrData" style="overflow: scroll; height:20vh"></pre>
    </div>

    <script rel="script" type="text/javascript" src="<?= base_url() ?>assets/jquery/jquery.min.js"></script>
    <script rel="script" type="text/javascript" src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script rel="script" type="text/javascript" src="<?= base_url() ?>assets/jquery/jquery.dataTables.js"></script>
    <script rel="script" type="text/javascript" src="<?= base_url() ?>assets/js/fileSaver.js"></script>
    <script>
        let latestID

        const ambilData = async (id = 0, i = 0) => {
            let konten = $('#arrData').html()
            let ar = []
            if (konten) ar = JSON.parse(konten)
            await $.getJSON(`<?= base_url() ?>Kml_pwt/stream?id=${id}`, (json) => {
                $.each(json, (i, d) => {
                    const ll = JSON.parse(d.latlng)[0]
                    const o = {
                        type: "Feature",
                        geometry: {
                            type: "Point",
                            coordinates: [
                                parseFloat(ll.geometry[0]),
                                parseFloat(ll.geometry[1])
                            ]
                        },
                        properties: d
                    }
                    ar.push(o)
                })
                let str = JSON.stringify(ar)
                $('#arrData').html(str)
            })
            const lastIdResult = parseInt(ar.at(-1).properties.ID)
            let ni = proggres(latestID, lastIdResult)
            if (lastIdResult < latestID) return ambilData(lastIdResult, ni)
            proggres(100, 100)
            return makeFinal(ar)
        }

        let proggres = (max, i) => {
            const pb = document.getElementById('progress-bar')
            const textProgress = document.getElementById('textProgress')
            const curr = (i / max) * 100
            pb.style.width = `${curr}%`
            pb.setAttribute('aria-valuenow', `${curr}`)
            if (curr < 100) return textProgress.innerHTML = `Processing ${curr}%`
            return textProgress.innerHTML = `Done ${curr}%`
        }

        let makeFinal = ar => {
            const o = {
                type: "FeatureCollection",
                name: "Marker_Pelanggan",
                features: ar,
                crs: {
                    type: "name",
                    properties: {
                        name: "urn:ogc:def:crs:OGC:1.3:CRS84"
                    }
                }
            }
            const str = JSON.stringify(o)
            saveStaticDataToFile(str)
            window.close()
        }

        function saveStaticDataToFile(str) {
            const blob = new Blob([str], {
                type: "text/plain;charset=utf-8"
            });
            const skrg = new Date()
            const thn = skrg.getFullYear()
            const bln = ((skrg.getMonth() + 1) < 10) ? `0${skrg.getMonth()+1}` : skrg.getMonth() + 1
            const hr = (skrg.getDay() < 10) ? `0${skrg.getDay()}` : skrg.getDay()
            saveAs(blob, `Marker_Pelanggan-${thn}${bln}${hr}.geojson`);
        }

        $(async () => {
            await $.getJSON(`<?= base_url() ?>Kml_pwt/latestID`, (json) => {
                latestID = parseInt(json.ID)
            })
            await ambilData()
        })
    </script>
</body>

</html>