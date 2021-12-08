const dg = $('#dg');
const path = window.location.pathname.split('/')
const baseUri = `${window.location.origin}/${path[1]}`

$(document).ready(() => {
    dg.datagrid({
        title: 'Data Master Tekanan',
        url: `${baseUri}/master_tekanan/ListTekanan`,
        columns: [[
            { field: 'id_', title: 'id_', sortable: true },
            { field: 'id_manometer', title: 'ID Manometer', sortable: true, },
            { field: 'nama_manometer', title: 'Manometer', sortable: true },
            { field: 'cabang', title: 'Cabang', sortable: true },
            { field: 'penanggung_jawab', title: 'Penanggung Jawab', sortable: true },
            { field: 'lokasi', title: 'Lokasi' },
            { field: 'tekanan', title: 'tekanan', sortable: true },
            { field: 'koneksi_pipa', title: 'Koneksi Pipa' },
            { field: 'latlng', title: 'Koordinat' },
            {
                field: 'ID', title: 'Action',
                formatter: (value, row, index) => {
                    const btn = `<button class="btn btn-xs btn-warning ico fa fa-edit" onClick="doEdit(${value})"></button>`
                    return btn
                }
            },
        ]],
        rownumbers: true,
        pagination: true,
        toolbar: '#tb',
        resizeHandle: 'both'
    }).resize()

    $('#win').window({
        width: 600,
        height: 400,
        modal: true
    });

    $.fn.datebox.defaults.formatter = function (date) {
        var y = date.getFullYear();
        var m = date.getMonth() + 1;
        var d = date.getDate();
        return y + '-' + m + '-' + d;
    }

    $('#win').window('close');
})

let doSearch = e => {
    dg.datagrid('load', { cari: e })
    $('.easyui-searchbox').textbox('reset')
}

let resetTable = () => {
    $('.easyui-searchbox').textbox('reset')
    dg.datagrid('load', { page: 1, rows: 10 })
}

let doEdit = async (id) => {
    $.getJSON(`${baseUri}/master_tekanan/Search/${id}`, json => {
        if (!json) return
        $('#ID').val(json.ID)
        $('#id_').val(json.id_)
        $('#id_manometer').val(json.id_manometer)
        $('#nama_manometer').val(json.nama_manometer)
        $('#cabang').val(json.cabang)
        $('#penanggung_jawab').val(json.penanggung_jawab)
        $('#lokasi').val(json.lokasi)
        $('#latlng').val(json.latlng)
        $('#koneksi_pipa').val(json.koneksi_pipa)
        $('#win').window('open')
    })
}

$('#frmEdit').on('submit', () => {
    const frmData = $('#frmEdit').serializeArray()
    $.post(`${baseUri}/master_tekanan/Update/${$('#ID').val()}`, frmData, json => {
        if (json.code !== 201) return alert(json.message)
        alert(json.message)
        $('#btnReset').trigger('click')
    }, "json")
    return false
})

$('#btnReset').on('click', () => {
    $('#win').window('close')
    resetTable()
})

let myformatter = (date) => {
    var y = date.getFullYear();
    var m = date.getMonth() + 1;
    var d = date.getDate();
    return y + '-' + (m < 10 ? ('0' + m) : m) + '-' + (d < 10 ? ('0' + d) : d);
}

let myparser = (s) => {
    if (!s) return new Date();
    var ss = (s.split('-'));
    var y = parseInt(ss[0], 10);
    var m = parseInt(ss[1], 10);
    var d = parseInt(ss[2], 10);
    if (!isNaN(y) && !isNaN(m) && !isNaN(d)) {
        return new Date(y, m - 1, d);
    } else {
        return new Date();
    }
}

$.getJSON(`${baseUri}/Cabang`, json => {
    json.map((r) => {
        const str = `<option value='${r.org_code}'>${r.org_name}</option>`
        $('#cabang').append(str)
    })
})

// $('#cabang').on('change', (e) => {
//     const org_code = $('#cabang').val()
//     $('#nipam').find('.listNipam').remove().end()
//     $.getJSON(`${baseUri}/Pegawai/cari/${org_code}`, json => {
//         json.map((r) => {
//             const str = `<option value='${r.nipam}' class='listNipam' data-nama='${r.nama}'>${r.nipam} - ${r.nama}</option>`
//             $('#nipam').append(str)
//         })
//     })
// })

// $('#nipam').on('change', () => {
//     const pj = $('#nipam').find(":selected").text()
//     $('#penanggung_jawab').val(pj)
// })