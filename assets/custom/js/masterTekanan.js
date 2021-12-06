const dg = $('#dg');
const path = window.location.pathname.split('/')
const baseUri = `${window.location.origin}/${path[1]}`

$(document).ready(() => {
    dg.datagrid({
        title: 'Data Master Tekanan',
        url: `${baseUri}/master_tekanan/ListTekanan`,
        columns: [[
            // { field: 'id', title: 'ID', sortable: true },
            {
                field: 'username', title: 'Username', sortable: true,
                formatter: (value, row) => {
                    return `${value}, (${row.nama})`
                }
            },
            { field: 'kd_mano', title: 'Manometer', sortable: true },
            { field: 'lokasi_mano', title: 'Lokasi', sortable: true },
            {
                field: 'tgl_input', title: 'Tanggal Input',
                formatter: (value, row) => {
                    return `${value} ${row.jam_input}`;
                }
            },
            { field: 'tekanan', title: 'tekanan', sortable: true },
            {
                field: 'id', title: 'action',
                formatter: (value, row) => {
                    return `<span id="btnEdit" href="#" class="btn btn-xs btn-warning icon fa fa-edit" onclick="doEdit(${value})"></span>`
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

let doSearchMano = e => doSearch({ kd_mano: e })

let doSearchLokasi = e => doSearch({ lokasi_mano: e })

let doSearchNama = e => doSearch({ username: e })

let doSearch = (req) => {
    dg.datagrid('load', req)
    $('.easyui-searchbox').textbox('reset')
}

let resetTable = () => {
    $('.easyui-searchbox').textbox('reset')
    dg.datagrid('load', { page: 1, rows: 10 })
}

let doEdit = async (id) => {
    $.getJSON(`${baseUri}/master_tekanan/Search/${id}`, json => {
        if (!json) return
        $('#id').val(json.id)
        $('#kd_mano').val(json.kd_mano)
        $('#username').val(json.username)
        $('#nama').val(json.nama)
        $('#tgl_input').datebox('setValue', json.tgl_input)
        $('#lokasi_mano').val(json.lokasi_mano)
        $('#tekanan').val(json.tekanan)
        $('#win').window('open')

    })
}

$('#frmEdit').on('submit', () => {
    const frmData = $('#frmEdit').serializeArray()
    $.post(`${baseUri}/master_tekanan/Update/${$('#id').val()}`, frmData, json => {
        if (json.code !== 201) return alert(json.message)
        alert(json.message)
        $('#btnReset').trigger('click')
    }, "json")
    return false
})

$('#btnReset').on('click', () => {
    $('#win').window('close')
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