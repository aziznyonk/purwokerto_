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
        url: `${baseUri}/mbr/getDataPelMbr`,
        rownumbers: true,
        pagination: true,
        toolbar: '#tb',
        resizeHandle: 'both',
        striped: true,
        singleSelect: true,
        columns: [[
            { field: 'ID_', title: "ID Survey" },
            { field: 'nama', title: "Nama" },
            { field: 'alamat', title: "Alamat" },
            { field: 'almt_dipasang', title: "Alamat dipasang" },
            { field: 'telfon', title: "Telfon" },
            { field: 'ktp', title: "KTP" },
            { field: 'rt_biasa', title: "Type" },
            { field: 'daya_listrik', title: "Daya Listrik" },
            { field: 'pekerjaan', title: "Pekerjaan" },
            { field: 'jml_penghuni', title: "Penghuni" },
            { field: 'smber_skrg', title: "Sumber" },
            { field: 'jarak', title: "Jarak" },
            { field: 'lebar_jln', title: "Lebar Jalan" },
            { field: 'jaringan_distri', title: "Distribusi" },
            { field: 'username', title: "Penginput" },
            { field: 'date', title: "Tgl Input" },
            {
                field: 'ID', title: 'Action',
                formatter: (value) => {
                    const btnEdit = `<a href="#" data-toggle="modal" data-target="#editModal" onclick=editData('${value}') class="btn btn-small icon fa fa-pencil"></a>`
                    const btnHapus = `<a onclick="deleteFunction('${value}')" class="btn btn-small text-danger icon fa fa-trash"></a>`
                    return `${btnEdit} ${btnHapus}`
                }
            }
        ]]
    })
})

let doSearchPenginput = e => doSearch({
    'penginput': e
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
    // console.log(req)
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
            url: `${baseUri}/delete_mbr`,
            data: {
                ID: ID
            },
            type: "POST",
            success: function (res) {
                if (res == false) {
                    alert('Failed - Data Gagal Dihapus ' + res);
                } else {
                    alert('Sukses Data Berhasil Dihapus');
                    resetTable()
                }
            },
            error: function (error) {
                alert('sukses ' + error);
            }
        });
    } else {
        alert('Tidak Jadi menhapus data pelanggan MBR ' + ID);
    }
}

let editData = async (data) => {
    $.post(`${baseUri}/mbr/getDataPelId`, {
        'id': data
    }, (json) => {
        $.each(json, (i, d) => {
            $('#ID').val(d.ID)
            $('#nama').val(d.nama)
            $('#alamat').val(d.alamat)
            $('#almt_dipasang').val(d.almt_dipasang)
            $('#ktp').val(d.ktp)
            $('#telfon').val(d.telfon)
            $('#daya_listrik').val(d.daya_listrik).trigger('change')
            $('#rt_biasa').val(d.rt_biasa)
            $('#pekerjaan').val(d.pekerjaan)
            $('#jml_penghuni').val(d.jml_penghuni)
            $('#smber_skrg').val(d.smber_skrg)
            $('#jarak').val(d.jarak)
            $('#lebar_jln').val(d.lebar_jln)
            $('#jaringan_distri').val(d.jaringan_distri)
            $('#latlng').val(d.latlng)
            $('#username').val(d.username)
            $('#ID_').val(d.ID_)

        })
    }, "json")
}

$('#frmEdit').on('submit', e => {
    const formData = $('#frmEdit').serializeArray()
    $.post(`${baseUri}/mbr/update_pelanggan`, formData, json => {
        $('#frmEdit')[0].reset()
        const result = JSON.parse(json)
        alert(result.message)
        $('.close').trigger('click')
        $('#tt').datagrid('reload');
    })
    return false
})