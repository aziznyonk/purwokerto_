const dg = $('#tt')
const path = window.location.pathname.split('/')
const baseUri = `${window.location.origin}/${path[1]}`
const formEdit = $('#frmEdit')
const batal = $('#batal')
const colseEdit = $('#closeEdit')
const tgl = $('#tgl')

dg.datagrid({
    title: 'Data Manometer',
    url: `${baseUri}/tekanan/getDataTekanan`,
    columns: [[
        // { field: 'ID', title: 'ID', sortable: true },
        { field: 'id_manometer', title: 'ID Manometer', sortable: true },
        { field: 'nama_manometer', title: 'Nama Manometer', sortable: true },
        { field: 'lokasi', title: 'Lokasi', sortable: true },
        { field: 'kondisi', title: 'Kondisi', sortable: true },
        { field: 'tekanan', title: 'Tekanan', sortable: true },
        { field: 'tgl_baca_s', title: 'Tgl Baca', sortable: true },
        { field: 'nama', title: 'Petugas', sortable: true },
        {
            field: 'latlng', title: 'Koordinat',
            formatter: (value, row) => {
                const latlng = JSON.parse(value)[0]
                const tekanan = row.tekanan
                const link = `<a href="#" onClick="openModal(${latlng.geometry[0]}, ${latlng.geometry[1]}, ${tekanan})" data-toggle="modal" data-target="#myModal">${latlng.geometry[0]},${latlng.geometry[1]}</a>`
                return link
            }
        },
        { field: 'keterangan', title: 'Keterangan' },
        {
            field: 'ID', title: 'Action',
            formatter: (value) => {
                const btnEdit = `<a href="#" onClick="edit(${value})" data-toggle="modal" data-target="#editModal" class="icon fa fa-pencil"></a>`
                const btnHapus = `<a href="#" onclick="hapus(${value})" class="btn btn-small text-danger icon fa fa-trash"></a>`
                return `${btnEdit} ${btnHapus}`
            }
        }
    ]],
    rownumbers: true,
    pagination: true,
    toolbar: '#tb',
    resizeHandle: 'both'
})

dg.datagrid({
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

let map;
let initMap = () => {
    map = new google.maps.Map(document.querySelector(".map-container"), {
        center: {
            lat: -7.431391,
            lng: 9.247833
        },
        zoom: 8,
    });
}

$(document).on('load', () => {
    initMap()
})

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

let batalForm = () => {
    formEdit[0].reset()
    colseEdit.trigger('click')
    dg.datagrid('reload')
}

formEdit.on('submit', e => {
    if (e.isDefaultPrevented()) return false
    const formData = $('#frmEdit').serializeArray()
    $.post(`${baseUri}/manometer/update/${$("#ID").val()}`, formData, (json) => {
        alert(json.message)
        batalForm()
    }, "json")
    return false;
})

batal.on('click', batalForm)

let hapus = (ID) => {
    const x = confirm("Yakin akan Menghapus data Manometer???")
    if (x === true) {
        $.getJSON(`${baseUri}/manometer/delete/${ID}`, json => {
            alert(json.message)
            batalForm()
        })
    }
}

let doSearch = e => {
    let req
    const tgl = $('#tgl').val()
    if (tgl) req = { tgl: $('#tgl').val(), cari: e }
    else req = { cari: e }
    dg.datagrid('load', req)
    $('.easyui-searchbox').textbox('reset')
}

let doSearchUsername = e => {
    if (e === "ALL") return doSearch()
    let req
    const tgl = $('#tgl').val()
    if (tgl) req = { tgl: $('#tgl').val(), cari: e }
    else req = { cari: e }
    dg.datagrid('load', req)
    $('.easyui-searchbox').textbox('reset')
}

let exportExcel = () => {
    const tgl = $('#tgl').val().split('-')
    const username = $('#username').val()
    if (tgl === "" || username === "ALL") return alert('Pilih Tanggal dan Petugas Lebih Dahulu!')
    window.location.href = `${baseUri}/Report/Tekanan/${username}/${tgl[0]}/${tgl[1]}`
}

$.fn.datebox.defaults.formatter = function (date) {
    var y = date.getFullYear();
    var m = date.getMonth() + 1;
    var d = date.getDate();
    return y + '-' + m + '-' + d;
}

$.fn.datebox.defaults.parser = function (s) {
    if (!s) return new Date();
    var ss = s.split('-');
    var y = parseInt(ss[0], 10);
    var m = parseInt(ss[1], 10);
    var d = parseInt(ss[2], 10);
    if (!isNaN(y) && !isNaN(m) && !isNaN(d)) {
        return new Date(y, m - 1, d);
    } else {
        return new Date();
    }
};

tgl.datebox({
    onSelect: e => {
        const nTgl = `${e.getFullYear()}-${e.getMonth() + 1}-${e.getDate()}`
        $('#tgl').val(nTgl)
        dg.datagrid('load', { tgl: nTgl })
        $('.easyui-searchbox').textbox('reset')
    }
})

let resetTable = () => {
    $('.easyui-searchbox').textbox('reset')
    tgl.datebox('setValue', null)
    dg.datagrid('load', { page: 1, rows: 10 })
}