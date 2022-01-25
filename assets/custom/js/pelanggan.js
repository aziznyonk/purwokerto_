const dg = $('#tt')
const path = window.location.pathname.split('/')
const baseUri = `${window.location.origin}/${path[1]}`
const formEdit = $('#frmEdit')
const batal = $('#batal')
const colseEdit = $('#closeEdit')
const tgl = $('#tgl')

$(document).ready(() => {
    dg.datagrid({
        title: 'Data Manometer',
        url: `${baseUri}/pela/getDataPel`,
        columns: [[
            // { field: 'ID', title: 'ID', sortable: true },
            { field: 'nomor_pela', title: 'Nomor Pelanggan', sortable: true },
            { field: 'nama', title: 'Nama', sortable: true },
            { field: 'alamat', title: 'Alamat', sortable: true },
            { field: 'desa_bill', title: 'Kelurahan', sortable: false },
            { field: 'kecamatan', title: 'Kecamatan', sortable: false },
            { field: 'status', title: 'Status', sortable: true },
            { field: 'klasifikasi', title: 'Type', sortable: true },
            { field: 'golongan', title: 'Golongan', sortable: true },
            { field: 'dma', title: 'DMA', sortable: true },
            { field: 'cabang', title: 'Cabang', sortable: false },
            { field: 'zona_baca', title: 'Zona Baca', sortable: false },
            { field: 'keterangan', title: 'Keterangan', sortable: true },
            { field: 'tgl_spk', title: 'Tgl SPK', sortable: false },
            { field: 'tgl_pas', title: 'Tgl Pasang', sortable: false },
            { field: 'keterangan', title: 'Keterangan', sortable: true },
            { field: 'username', title: 'Penginput', sortable: true },
            {
                field: 'latlng', title: 'LatLng', sortable: true,
                formatter: (value) => {
                    const jp = JSON.parse(value)[0]
                    return `${jp.geometry[0]},${jp.geometry[1]}`
                }
            },
            { field: 'tgl_input', title: 'Tgl Input', sortable: true },
            {
                field: 'ID', title: 'Action',
                formatter: (value) => {
                    const btnEdit = `<a href="#" data-toggle="modal" data-target="#editModal" onclick=editData('${value}') class="btn btn-small icon fa fa-pencil"></a>`
                    const btnHapus = `<a onclick="deleteFunction('${value}')" class="btn btn-small text-danger icon fa fa-trash"></a>`
                    return `${btnEdit} ${btnHapus}`
                }
            }
        ]],
        rownumbers: true,
        pagination: true,
        toolbar: '#tb',
        resizeHandle: 'both'
    })
})

let doSearchMano = e => doSearch({
    'nopel': e
})
let doSearchNama = e => doSearch({
    'nama': e
})
let doSearchAlamat = e => doSearch({
    'alamat': e
})
let doSearchSurv = e => doSearch({
    'surv': e
})
let doSearch = (req) => {
    $('#tt').datagrid('load', req)
    $('.easyui-searchbox').textbox('reset')
}

let resetTable = () => {
    $('#tt').datagrid('load', {
        page: 1,
        rows: 10
    })
    $('.easyui-searchbox').textbox('reset')
}

function deleteFunction(ID) {
    if (confirm("Apakah anda yakin untuk menghapus data ini ?!")) {
        $.ajax({
            url: `${baseUri}/delete_pelanggan`,
            data: {
                ID: ID
            },
            type: "POST",
            success: function (res) {
                if (res == false) {
                    alert('Failed - Data Gagal Dihapus ' + res);
                } else {
                    alert('Sukses Data Berhasil Dihapus');
                    $('#tt').datagrid('reload');
                }
            },
            error: function (error) {
                alert('sukses ' + error);
            }
        });
    } else {
        alert('Tidak Jadi menhapus data pelanggan ' + ID);
    }
}

let editData = async (data) => {
    $.post(`${baseUri}/pela/getDataPelId`, {
        'id': data
    }, (json) => {
        $.each(json, (i, d) => {
            $('#ID').val(d.ID)
            $('#nomor_pela').val(d.nomor_pela)
            $('#nama').val(d.nama)
            $('#alamat').val(d.alamat)
            $('#klasifikasi').val(d.klasifikasi)
            $('#cabang').val(d.cabang)
            $('#status').val(d.status).trigger('change')
            $('#latlng').val(d.latlng)
        })
    }, "json")
}

$('#frmEdit').on('submit', e => {
    const formData = $('#frmEdit').serializeArray()
    $.post(`${baseUri}/pela/save_pelanggan`, formData, json => {
        $('#frmEdit')[0].reset()
        const result = JSON.parse(json)
        alert(result.message)
        $('.close').trigger('click')
        $('#tt').datagrid('reload');
    })
    return false
})