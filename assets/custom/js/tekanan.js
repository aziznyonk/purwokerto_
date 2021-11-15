
const pathName = window.location.pathname.split('/')
// console.log(pathName)
const baseUri = `${window.location.origin}/${pathName[1]}`

let map;
let openModal = async (lat, long, tekanan) => {
    let warna
    const ijo = "B2EA70"
    const merah = "FF0000"
    if (parseFloat(tekanan) < 0.5) warna = `https://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=•|${merah}`
    else warna = `https://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=•|${ijo}`

    const coordinates = {
        lat: parseFloat(lat),
        lng: parseFloat(long)
    }

    map = new google.maps.Map(document.querySelector(".map-container"), {
        center: coordinates,
        zoom: 11,
    });
    const marker = new google.maps.Marker({
        position: coordinates,
        animation: google.maps.Animation.DROP,
        icon: warna,
        map: map,
    });
}

function initMap() {
    map = new google.maps.Map(document.querySelector(".map-container"), {
        center: {
            lat: -7.431391,
            lng: 9.247833
        },
        zoom: 8,
    });
}

$(function () {
    $('#tt').datagrid({
        view: detailview,
        detailFormatter: function (index, row) {
            return `<div style="padding:2px;position:relative;"><table class="ddv"></table></div>`;
        },
        onExpandRow: function (index, row) {
            var ddv = $(this).datagrid('getRowDetail', index).find('table.ddv');
            ddv.datagrid({
                url: `${baseUri}/tekanan/details_pipa/${row.ID}`,
                fitColumns: true,
                singleSelect: true,
                rownumbers: true,
                loadMsg: '',
                height: 'auto',
                columns: [
                    [{
                        field: 'ID',
                        title: 'ID'
                    },
                    {
                        field: 'gid__2',
                        title: 'GID'
                    },
                    {
                        field: 'lokasi',
                        title: 'Lokasi'
                    },
                    {
                        field: 'cabang',
                        title: 'Cabang'
                    },
                    {
                        field: 'panjang',
                        title: 'Panjang'
                    },
                    {
                        field: 'diameter',
                        title: 'Diameter'
                    },
                    {
                        field: 'keterangan',
                        title: 'Keterangan'
                    },
                    {
                        field: 'nospk',
                        title: 'NomorSPK'
                    },
                    {
                        field: 'pelaksana',
                        title: 'Pelaksana'
                    },
                    {
                        field: 'bahan',
                        title: 'Bahan'
                    },
                    {
                        field: 'statuspipa',
                        title: 'Status'
                    },
                    {
                        field: 'latlng',
                        title: 'Latitude Longitude'
                    },
                    {
                        field: 'kd_manometer',
                        title: 'KodeManometer'
                    },
                    ]
                ],
                onResize: function () {
                    $('#tt').datagrid('fixDetailRowHeight', index);
                },
                onLoadSuccess: function () {
                    setTimeout(function () {
                        $('#tt').datagrid('fixDetailRowHeight', index);
                    }, 0);
                }
            });
            $('#tt').datagrid('fixDetailRowHeight', index)
        }
    })

    $('#tt').datagrid({
        onLoadSuccess: () => {
            const z = document.querySelectorAll('.zoom')
            z.forEach(zz => {
                zz.addEventListener('mouseover', e => {
                    e.target.style.width = "100px"
                    e.target.parentElement.style.width = "100px"
                    $('#tt').datagrid('resize')
                })
                zz.addEventListener('mouseout', e => {
                    e.target.style.width = "50px";
                    $('#tt').datagrid('resize')
                })
            })
        }
    })
})



let edit = (ID) => {
    $.getJSON(`${baseUri}/manometer/getDetailTekanan/${ID}`, (json) => {
        $("#ID").val(json.ID)
        $("#id_manometer").val(json.id_manometer)
        $("#nama_manometer").val(json.nama_manometer)
        $("#lokasi").val(json.lokasi)
        $("#latlng").val(json.latlng)
        $("#kondisi").val(json.kondisi)
        $("#tekanan").val(json.tekanan)
        $("#keterangan").val(json.keterangan)
    })
}

$('#frmEdit').on('submit', e => {
    if (e.isDefaultPrevented()) return false
    const formData = $('#frmEdit').serializeArray()
    $.post(`${baseUri}/manometer/update/${$("#ID").val()}`, formData, (json) => {
        alert(json.message)
        $('#frmEdit')[0].reset()
        $('#closeEdit').trigger('click')
        $('#tt').datagrid('reload')
    }, "json")
    return false;
})

let hapus = (ID) => {
    const x = confirm("Yakin akan Menghapus data Manometer???")
    if (x === true) {
        $.getJSON(`${baseUri}/manometer/delete/${ID}`, json => {
            alert(json.message)
            $('#tt').datagrid('reload')
        })
    }
}